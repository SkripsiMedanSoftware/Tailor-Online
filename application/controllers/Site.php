<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Site
 * @category Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Site extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
	}

	public function index()
	{
		$data['page_title'] = 'Home';
		$this->template->site('home', $data);
	}

	public function pesan()
	{
		$data['page_title'] = 'Pesan Baju';
		$this->template->site('pesan', $data);
	}

	public function upload_design()
	{
		$config['upload_path'] = './uploads/desain_pesanan/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		if ($this->input->method(TRUE) === 'POST')
		{
			$desain = array();

			$jumlah_desain = count($_FILES['desain']['name']);

			if ($jumlah_desain > 0 && !empty($_FILES['desain']['name'][0]))
			{
				for ($i = 0; $i < $jumlah_desain; $i++)
				{
					if (!empty($_FILES['desain']['name'][$i])) {

						$_FILES['file']['name'] = $_FILES['desain']['name'][$i];
						$_FILES['file']['type'] = $_FILES['desain']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['desain']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['desain']['error'][$i];
						$_FILES['file']['size'] = $_FILES['desain']['size'][$i];

						if ($this->upload->do_upload('file')) {
							$desain[$i] = $this->upload->data();
						}
					}
				}

				$this->session->set_userdata('desain_pesanan', $desain);
			}
			else
			{
				$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Silahkan unggah desain milik anda'));
			}

			redirect(base_url('site/pesan'), 'refresh');
		}
		else
		{
			show_404();
		}
	}

	/**
	 * Cek harga
	 */
	public function cek_harga()
	{
		$this->form_validation->set_rules('bahan', 'Bahan', 'trim|required');
		$this->form_validation->set_rules('ukuran', 'Ukuran', 'trim|required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|integer|required');

		if ($this->form_validation->run() === TRUE)
		{
			$harga_satuan = $this->db->get_where('harga_per_ukuran', array(
				'bahan' => $this->input->post('bahan'),
				'ukuran' => $this->input->post('ukuran')
			))->row_array();

			if (!empty($harga_satuan))
			{
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 'success',
					'data' => $harga_satuan
				)));
			}
			else
			{
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 'failed'
				)));
			}
		}
		else
		{
			$this->output->set_content_type('application/json')->set_output(json_encode(array(
				'status' => 'validation_errors',
				'data' => $this->form_validation->error_array()
			)));
		}
	}

	/**
	 * Keranjang belanja
	 * 
	 * @param  string $option
	 * @param  string $row_id
	 */
	public function keranjang($option = NULL, $row_id = NULL)
	{
		switch ($option) {
			case 'add':
			$this->form_validation->set_rules('bahan', 'Bahan', 'trim|required');
			$this->form_validation->set_rules('ukuran', 'Ukuran', 'trim|required');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|integer|required');

			if ($this->form_validation->run() === TRUE)
			{
				$harga 	= 0;
				$bahan 	= $this->bahan_baju_model->view($this->input->post('bahan'));
				$ukuran = $this->ukuran_baju_model->view($this->input->post('ukuran'));
				$id 	= sha1($bahan['jenis'].'-'.$bahan['warna'].$this->input->post('ukuran'));

				$harga_satuan = $this->db->get_where('harga_per_ukuran', array(
					'bahan' => $this->input->post('bahan'),
					'ukuran' => $this->input->post('ukuran')
				))->row_array();

				if (!empty($harga_satuan))
				{
					$harga = $harga_satuan['harga'];
				}

				$data = array(
					'id'		=> $id,
					'qty'		=> $this->input->post('jumlah'),
					'price'		=> $harga,
					'name'		=> $bahan['jenis'].'-'.$bahan['warna'],
					'options' 	=> array(
						'bahan' 	=> $bahan['jenis'],
						'warna' 	=> $bahan['warna'],
						'ukuran' 	=> $ukuran['nama'],
						'data' => array(
							'bahan' => $bahan['id'],
							'ukuran' => $ukuran['id']
						)
					)
				);

				$this->cart->insert($data);
				redirect(base_url('site/pesan'), 'refresh');
			}
			else
			{
				$data['page_title'] = 'Pesan Baju';
				$this->template->site('pesan', $data);
			}
			break;

			case 'delete':
				$this->cart->remove($row_id);
				redirect(base_url('site/pesan'), 'refresh');
			break;

			case 'truncate':
				$this->cart->destroy();
				$this->session->unset_userdata('desain_pesanan');
				redirect(base_url('site/pesan'), 'refresh');
			break;

			case 'process':
				if (!empty(aktif_sesi()))
				{
					$cart_contents = $this->cart->contents();

					if (!empty($cart_contents))
					{
						$this->form_validation->set_rules('metode_pembayaran', 'Metode Pembayaran', 'trim|in_list[midtrans,cod]|required');
						
						if ($this->form_validation->run() == TRUE)
						{
							$pesanan = $this->pesanan_model->create(array(
								'id_customer' => aktif_sesi()['id'],
								'uid' => random_string('alnum', 6),
								'tanggal_pemesanan' => unix_to_human(now()),
								'catatan' => $this->input->post('catatan'),
								'harga' => $this->cart->total(),
								'status' => 'menunggu-konfirmasi',
								'status_pembayaran' => 'belum-dibayar',
								'metode_pembayaran'	=> $this->input->post('metode_pembayaran')
							));

							foreach ($this->session->userdata('desain_pesanan') as $desain) {
								$this->desain_pesanan_model->create(array(
									'pesanan' => $pesanan,
									'foto' => 'uploads/desain_pesanan/'.$desain['file_name']
								));	
							}

							foreach ($cart_contents as $cart) {
								$this->detail_pesanan_model->create(array(
									'pesanan' => $pesanan,
									'bahan' => $cart['options']['data']['bahan'],
									'ukuran' => $cart['options']['data']['ukuran'],
									'jumlah' => $cart['qty'],
									'subtotal' => $cart['subtotal']
								));
							}

							$this->cart->destroy();
							$this->session->unset_userdata('desain_pesanan');

							redirect(base_url('site/tagihan/'.$pesanan), 'refresh');
						}
						else
						{
							$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Pilih metode pembayaran!'));
							redirect(base_url('site/pesan'), 'refresh');
						}
					}
					else
					{
						$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Keranjang anda kosong!'));
						redirect(base_url('site/pesan'), 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Anda harus masuk/mendaftar sebagai member terlebih dahulu!'));
					redirect(base_url('site/masuk?redirect='.urlencode(base_url('site/pesan'))), 'refresh');
				}
			break;
			
			default:
				show_404();
			break;
		}
	}

	/**
	 * User account
	 */
	public function akun()
	{
		$this->template->site('akun');
	}

	/**
	 * Tagihan
	 * 
	 * @param  integer $pesanan_id
	 */
	public function tagihan($pesanan_id = NULL, $options = NULL)
	{
		if (!empty($pesanan_id))
		{
			$pesanan = $this->pesanan_model->view($pesanan_id);

			if (!empty($pesanan))
			{
				switch ($options) {
					case 'batalkan':
						if (!in_array($pesanan['status'], ['dalam-proses', 'selesai']) and $pesanan['status'] !== 'dibatalkan')
						{
							$this->pesanan_model->update(array('status' => 'dibatalkan'), array('id' => $pesanan['id']));
							$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Pesanan telah dibatalkan'));
						}
						else
						{
							$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Anda tidak dapat membatalkan pesanan'));
						}
						redirect(base_url('site/tagihan'), 'refresh');
					break;

					case 'detail':
						// $data['page_title'] = 'Detail Tagihan';
						// $data['pesanan'] = $pesanan;
						// $this->template->site('tagihan_detail', $data);
					break;
					
					default:
						$data['page_title'] = 'Detail Tagihan';
						$data['pesanan'] = $pesanan;
						$this->template->site('tagihan_detail', $data);
					break;
				}
			}
			else
			{
				show_404();
			}
		}
		else
		{
			$data['page_title'] = 'Tagihan';
			$data['pesanan'] = $this->pesanan_model->get_where(array('id_customer' => aktif_sesi()['id']));
			$this->template->site('tagihan', $data);
		}
	}

	/**
	 * Masuk
	 */
	public function masuk()
	{
		if ($this->input->method(TRUE) === 'POST')
		{
			$this->form_validation->set_rules('identity', 'Email/Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() === TRUE)
			{
				$masuk = $this->pengguna_model->masuk($this->input->post('identity'), $this->input->post('password'));

				if (!empty($masuk))
				{
					if ($masuk['status'] == 'aktif')
					{
						$this->session->set_userdata('pengguna', $masuk['id']);

						if (!empty($this->input->get('redirect')))
						{
							redirect(urldecode($this->input->get('redirect')), 'refresh');
						}
						else
						{
							if ($masuk['role'] == 'admin')
							{
								redirect(base_url('admin'), 'refresh');
							}
							else
							{
								redirect(base_url('site'), 'refresh');
							}	
						}
					}
					else
					{
						$status = ($masuk['status'] == 'non-aktif')?'non-aktifkan':'blokir';
						$this->session->set_userdata('masuk', 'Maaf akun anda telah di'.$status.' silahkan hubungi admin untuk keterangan lebih lanjut');
						redirect(base_url('pengguna'), 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('flash_message', array('status' => 'danger', 'message' => 'Email / Kata Sandi yang digunakan tidak sesuai!'));
					redirect(base_url('site/masuk'), 'refresh');
				}
			}
			else
			{
				$data['page_title'] = 'Masuk';
				$this->template->site('masuk', $data);
			}
		}
		else
		{
			$data['page_title'] = 'Masuk';
			$this->template->site('masuk', $data);
		}
	}

	/**
	 * Mendaftar
	 */
	public function mendaftar()
	{
		if ($this->input->method(TRUE) === 'POST')
		{
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('seluler', 'Seluler', 'trim|max_length[16]|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|is_unique[pengguna.username]|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE)
			{
				$this->pengguna_model->create(array(
					'role' => 'customer',
					'email' => $this->input->post('email'),
					'seluler' => $this->input->post('seluler'),
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'alamat' => $this->input->post('alamat'),
					'status' => 'aktif'
				));

				$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Registrasi berhasil! sekarang anda bisa masuk'));
				redirect(base_url('site/masuk'), 'refresh');
			}
			else
			{
				$data['page_title'] = 'Mendaftar';
				$this->template->site('daftar', $data);
			}
		}
		else
		{
			$data['page_title'] = 'Mendaftar';
			$this->template->site('daftar', $data);
		}
	}

	/**
	 * Keluar
	 */
	public function keluar()
	{
		$this->session->unset_userdata('pengguna');
		redirect(base_url('site'), 'refresh');
	}
}

/* End of file Site.php */
/* Location : ./application/controllers/Site.php */