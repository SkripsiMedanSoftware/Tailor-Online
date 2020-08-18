<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Admin
 * @category Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Admin extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		if (empty(aktif_sesi()) && aktif_sesi()['role'] !== 'admin') {
			redirect(base_url(), 'refresh');
		}
	}

	public function index()
	{
		$this->template->admin('home');
	}

	/**
	 * Pesanan
	 * 
	 * @param  string $option
	 * @param  integer $id
	 */
	public function pesanan($option = NULL, $id = NULL)
	{
		switch ($option) {
			case 'update':
				$id = $this->pesanan_model->view($id);
				if (!empty($id))
				{
					if ($this->input->method(TRUE) === 'POST')
					{
						$this->form_validation->set_rules('estimasi_pengerjaan', 'Estimasi Pengerjaan', 'trim|integer|required');
						$this->form_validation->set_rules('status', 'Status Pesanan', 'trim|in_list[dibatalkan,menunggu-konfirmasi,diterima,ditolak,dalam-proses,selesai]|required');
						$this->form_validation->set_rules('harga', 'Harga', 'trim|integer|required');
						$this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'trim|in_list[belum-dibayar,pending,lunas]|required');

						if ($this->form_validation->run() == TRUE)
						{
							$this->pesanan_model->update(array(
								'estimasi_pengerjaan' => $this->input->post('estimasi_pengerjaan'),
								'harga' => $this->input->post('harga'),
								'status' => $this->input->post('status'),
								'status_pembayaran' => $this->input->post('status_pembayaran')
							), array('id' => $id['id']));

							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data pesanan berhasil diperbaharui'));
							redirect(base_url('admin/pesanan') ,'refresh');
						}
						else
						{
							$data['pesanan'] = $id;
							$data['page_title'] = 'Sunting Data Pesanan';
							$this->template->admin('pesanan/update', $data);
						}
					}
					else
					{
						$data['pesanan'] = $id;
						$data['page_title'] = 'Sunting Data Pesanan';
						$this->template->admin('pesanan/update', $data);
					}
				}
				else
				{
					show_404();
				}
			break;

			case 'delete':
				$id = $this->pesanan_model->view($id);

				if (!empty($id))
				{
					$this->pesanan_model->delete(array('id' => $id['id']));
					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data pesanan berhasil dihapus'));
					redirect(base_url('admin/pesanan') ,'refresh');
				}
				else
				{
					$this->session->set_flashdata('flash_message', array('status' => 'danger', 'message' => 'Data pesanan tidak ditemukan'));
					redirect(base_url('admin/pesanan') ,'refresh');
				}
			break;
			
			default:
				$id = $this->pesanan_model->view($id);

				if (!empty($id))
				{
					$data['page_title'] = 'Detail Data Pesanan';
					$data['pesanan'] = $id;
					$this->template->admin('pesanan/view', $data);
				}
				else
				{
					$data['page_title'] = 'Daftar Data Pesanan';
					$data['pesanan'] = $this->pesanan_model->list();
					$this->template->admin('pesanan/list', $data);
				}
			break;
		}
	}

	/**
	 * Update status pesanan
	 */
	public function update_status_pesanan($id = NULL, $status = '')
	{
		if (!empty($id) && !empty($status))
		{
			$this->pesanan_model->update(array('status' => $status), array('id' => $id));
			redirect(base_url('admin/pesanan'), 'refresh');
		}
		else
		{
			show_404();
		}
	}

	/**
	 * Chat
	 */
	public function chat()
	{
		$this->template->admin('chat');
	}

	/**
	 * Web Slider
	 * 
	 * @param  string $option
	 * @param  integer $id
	 */
	public function web_slider($option = NULL, $id = NULL)
	{
		$config['upload_path'] = './uploads/web_slider/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		switch ($option)
		{
			case 'add':
				if ($this->input->method(TRUE) == 'POST')
				{
					$this->form_validation->set_rules('judul', 'Judul', 'trim|required');

					if ($this->form_validation->run() == TRUE)
					{
						$image = NULL;

						if (!empty($_FILES['image']['name'])) 
						{
							if ($this->upload->do_upload('image')) {
								$image = 'uploads/web_slider/'.$this->upload->data()['file_name'];
							}
						}

						$this->web_slider_model->create(array(
							'judul' => $this->input->post('judul'),
							'konten' => $this->input->post('konten'),
							'tombol_teks' => $this->input->post('tombol_teks'),
							'tombol_link' => $this->input->post('tombol_link'),
							'image' => $image
						));

						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data web slider berhasil ditambahkan'));
						redirect(base_url('admin/web_slider'), 'refresh');
					}
					else
					{
						$data['page_title'] = 'Tambah Slider';
						$this->template->admin('web_slider/add', $data);
					}
				}
				else
				{
					$data['page_title'] = 'Tambah Slider';
					$this->template->admin('web_slider/add', $data);
				}
			break;

			case 'update':
				$id = $this->web_slider_model->view($id);

				if (!empty($id))
				{
					if ($this->input->method(TRUE) == 'POST')
					{
						$this->form_validation->set_rules('judul', 'Judul', 'trim|required');

						if ($this->form_validation->run() == TRUE)
						{
							$image = NULL;

							if (!empty($_FILES['image']['name'])) 
							{
								if ($this->upload->do_upload('image')) {
									$image = 'uploads/web_slider/'.$this->upload->data()['file_name'];
								}
							}

							$this->web_slider_model->update(array(
								'judul' => $this->input->post('judul'),
								'konten' => $this->input->post('konten'),
								'tombol_teks' => $this->input->post('tombol_teks'),
								'tombol_link' => $this->input->post('tombol_link'),
								'image' => $image
							), array('id' => $id['id']));
						}
						else
						{

						}
					}
					else
					{
						
					}
				}
				else
				{
					show_404();
				}
			break;

			case 'delete':
				$id = $this->web_slider_model->view($id);

				if (!empty($id))
				{
					$this->web_slider_model->delete(array('id' => $id['id']));
					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data web slider berhasil dihapus'));
					redirect(base_url('admin/web_slider') ,'refresh');
				}
				else
				{
					$this->session->set_flashdata('flash_message', array('status' => 'danger', 'message' => 'Data web slider tidak ditemukan'));
					redirect(base_url('admin/web_slider') ,'refresh');
				}
			break;
			
			default:
				$id = $this->web_slider_model->view($id);

				if (!empty($id))
				{
					$data['page_title'] = 'Web Slider';
					$data['web_slider'] = $id;
					$this->template->admin('web_slider/list', $data);
				}
				else
				{
					$data['page_title'] = 'Web Slider';
					$data['web_slider'] = $this->web_slider_model->list();
					$this->template->admin('web_slider/list', $data);
				}
			break;
		}
	}

	/**
	 * Katalog
	 * 
	 * @param  string 	$option
	 * @param  integer 	$id
	 */
	public function katalog_produk($option = NULL, $id = NULL)
	{
		$config['upload_path'] = './uploads/katalog_produk/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		switch ($option) {
			case 'add':
				if ($this->input->method(TRUE) === 'POST')
				{
					$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
					$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');
					$this->form_validation->set_rules('tanggal_pemesanan', 'Tanggal Pemesanan', 'trim|required');
					$this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'trim|required');
					$this->form_validation->set_rules('status', 'Status', 'trim|in_list[publish,draft]');

					if ($this->form_validation->run() === TRUE)
					{
						$tanggal_pemesanan = explode('/', $this->input->post('tanggal_pemesanan'));
						$tanggal_selesai = explode('/', $this->input->post('tanggal_selesai'));

						$katalog = $this->katalog_produk_model->create(array(
							'nama' => $this->input->post('nama'),
							'deskripsi' => $this->input->post('deskripsi'),
							'tanggal_pemesanan' => $tanggal_pemesanan[2].'-'.$tanggal_pemesanan[1].'-'.$tanggal_pemesanan[0],
							'tanggal_selesai' => $tanggal_selesai[2].'-'.$tanggal_selesai[1].'-'.$tanggal_selesai[0]
						));

						$foto = array();

						$jumlah_foto = count($_FILES['foto']['name']);

						for ($i = 0; $i < $jumlah_foto; $i++)
						{
							if (!empty($_FILES['foto']['name'][$i])) {

								$_FILES['file']['name'] = $_FILES['foto']['name'][$i];
								$_FILES['file']['type'] = $_FILES['foto']['type'][$i];
								$_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
								$_FILES['file']['error'] = $_FILES['foto']['error'][$i];
								$_FILES['file']['size'] = $_FILES['foto']['size'][$i];

								if ($this->upload->do_upload('file')) {

									$foto[$i] = $this->upload->data();

									$this->foto_katalog_model->create(array(
										'id_katalog' => $katalog,
										'foto' => $this->upload->data()['file_name']
									));
								}
							}
						}

						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data katalog produk telah ditambahkan'));
						redirect(base_url('admin/katalog_produk'), 'refresh');
					}
					else
					{
						$data['page_title'] = 'Tambah Data Katalog Produk';
						$this->template->admin('katalog_produk/add', $data);
					}
				}
				else
				{
					$data['page_title'] = 'Tambah Data Katalog Produk';
					$this->template->admin('katalog_produk/add', $data);
				}
			break;

			case 'update':
				$id = $this->katalog_produk_model->view($id);

				if (!empty($id))
				{
					if ($this->input->method(TRUE) === 'POST')
					{
						$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
						$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');
						$this->form_validation->set_rules('tanggal_pemesanan', 'Tanggal Pemesanan', 'trim|required');
						$this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'trim|required');
						$this->form_validation->set_rules('status', 'Status', 'trim|in_list[publish,draft]');

						if ($this->form_validation->run() === TRUE)
						{
							$tanggal_pemesanan = explode('/', $this->input->post('tanggal_pemesanan'));
							$tanggal_selesai = explode('/', $this->input->post('tanggal_selesai'));

							$this->katalog_produk_model->update(array(
								'nama' => $this->input->post('nama'),
								'deskripsi' => $this->input->post('deskripsi'),
								'tanggal_pemesanan' => $tanggal_pemesanan[2].'-'.$tanggal_pemesanan[1].'-'.$tanggal_pemesanan[0],
								'tanggal_selesai' => $tanggal_selesai[2].'-'.$tanggal_selesai[1].'-'.$tanggal_selesai[0]
							), array('id' => $id['id']));
							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data katalog produk telah diperbaharui'));
							redirect(base_url('admin/katalog_produk'), 'refresh');
						}
						else
						{
							$data['page_title'] = 'Sunting Data Katalog Produk';
							$data['katalog_produk'] = $id;
							$this->template->admin('katalog_produk/update', $data);
						}
					}
					else
					{
						$data['page_title'] = 'Sunting Data Katalog Produk';
						$data['katalog_produk'] = $id;
						$this->template->admin('katalog_produk/update', $data);
					}
				}
				else
				{
					show_404();
				}
			break;

			case 'delete':	
				$id = $this->katalog_produk_model->view($id);

				if (!empty($id))
				{
					$this->katalog_produk_model->delete(array('id' => $id['id']));
					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data katalog produk telah dihapus'));
					redirect(base_url('admin/katalog_produk'), 'refresh');
				}
				else
				{
					show_404();
				}
			break;

			default:
				$id = $this->katalog_produk_model->view($id);

				if (!empty($id))
				{
					$data['page_title'] = 'Detail Katalog Produk';
					$data['katalog_produk'] = $id;
					$this->template->admin('katalog_produk/view', $data);
				}
				else
				{
					$data['page_title'] = 'Daftar Katalog Produk';
					$data['katalog_produk'] = $this->katalog_produk_model->list();
					$this->template->admin('katalog_produk/list', $data);
				}
			break;
		}
	}

	/**
	 * Bahan Baju
	 * 
	 * @param  string 	$option
	 * @param  integer 	$id
	 */
	public function bahan_baju($option = NULL, $id = NULL)
	{
		switch ($option) {
			case 'add':
				if ($this->input->method(TRUE) === 'POST')
				{
					$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
					$this->form_validation->set_rules('warna', 'Warna', 'trim|required');
					
					if ($this->form_validation->run() === TRUE)
					{
						$this->bahan_baju_model->create(array(
							'jenis' => $this->input->post('jenis'),
							'warna' => $this->input->post('warna')
						));
						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data bahan baju telah ditambahkan'));
						redirect(base_url('admin/bahan_baju'), 'refresh');
					}
					else
					{
						$data['page_title'] = 'Tambah Data Bahan Baju';
						$this->template->admin('bahan_baju/add', $data);
					}
				}
				else
				{
					$data['page_title'] = 'Tambah Data Bahan Baju';
					$this->template->admin('bahan_baju/add', $data);
				}
			break;

			case 'update':
				$id = $this->bahan_baju_model->view($id);

				if (!empty($id))
				{
					if ($this->input->method(TRUE) === 'POST')
					{
						$this->form_validation->set_rules('jenis', 'Jenis', 'trim|required');
						$this->form_validation->set_rules('warna', 'Warna', 'trim|required');
						
						if ($this->form_validation->run() === TRUE)
						{
							$this->bahan_baju_model->update(array(
								'jenis' => $this->input->post('jenis'),
								'warna' => $this->input->post('warna')
							), array('id' => $id['id']));
							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data bahan baju telah diperbaharui'));
							redirect(base_url('admin/bahan_baju'), 'refresh');
						}
						else
						{
							$data['page_title'] = 'Sunting Data Bahan Baju';
							$data['bahan_baju'] = $id;
							$this->template->admin('bahan_baju/update', $data);
						}
					}
					else
					{
						$data['page_title'] = 'Sunting Data Bahan Baju';
						$data['bahan_baju'] = $id;
						$this->template->admin('bahan_baju/update', $data);
					}
				}
				else
				{
					show_404();
				}
			break;

			case 'delete':	
				$id = $this->bahan_baju_model->view($id);

				if (!empty($id))
				{
					$this->bahan_baju_model->delete(array('id' => $id['id']));
					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data bahan baju telah dihapus'));
					redirect(base_url('admin/bahan_baju'), 'refresh');
				}
				else
				{
					show_404();
				}
			break;

			default:
				$id = $this->bahan_baju_model->view($id);

				if (!empty($id))
				{
					$data['page_title'] = 'Detail Bahan Baju';
					$data['bahan_baju'] = $id;
					$this->template->admin('bahan_baju/view', $data);
				}
				else
				{
					$data['page_title'] = 'Daftar Bahan Baju';
					$data['bahan_baju'] = $this->bahan_baju_model->list();
					$this->template->admin('bahan_baju/list', $data);
				}
			break;
		}
	}

	/**
	 * Ukuran Baju
	 * 
	 * @param  string 	$option
	 * @param  integer 	$id
	 */
	public function ukuran_baju($option = NULL, $id = NULL)
	{
		switch ($option) {
			case 'add':
				if ($this->input->method(TRUE) === 'POST')
				{
					$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
					
					if ($this->form_validation->run() === TRUE)
					{
						$this->ukuran_baju_model->create(array(
							'nama' => $this->input->post('nama')
						));
						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data ukuran baju telah ditambahkan'));
						redirect(base_url('admin/ukuran_baju'), 'refresh');
					}
					else
					{
						$data['page_title'] = 'Tambah Data Ukuran Baju';
						$this->template->admin('ukuran_baju/add', $data);
					}
				}
				else
				{
					$data['page_title'] = 'Tambah Data Ukuran Baju';
					$this->template->admin('ukuran_baju/add', $data);
				}
			break;

			case 'update':
				$id = $this->ukuran_baju_model->view($id);

				if (!empty($id))
				{
					if ($this->input->method(TRUE) === 'POST')
					{
						$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
						
						if ($this->form_validation->run() === TRUE)
						{
							$this->ukuran_baju_model->update(array(
								'nama' => $this->input->post('nama')
							), array('id' => $id['id']));
							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data ukuran baju telah diperbaharui'));
							redirect(base_url('admin/ukuran_baju'), 'refresh');
						}
						else
						{
							$data['page_title'] = 'Sunting Data Ukuran Baju';
							$data['ukuran_baju'] = $id;
							$this->template->admin('ukuran_baju/update', $data);
						}
					}
					else
					{
						$data['page_title'] = 'Sunting Data Ukuran Baju';
						$data['ukuran_baju'] = $id;
						$this->template->admin('ukuran_baju/update', $data);
					}
				}
				else
				{
					show_404();
				}
			break;

			case 'delete':	
				$id = $this->ukuran_baju_model->view($id);

				if (!empty($id))
				{
					$this->ukuran_baju_model->delete(array('id' => $id['id']));
					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data ukuran baju telah dihapus'));
					redirect(base_url('admin/ukuran_baju'), 'refresh');
				}
				else
				{
					show_404();
				}
			break;

			default:
				$id = $this->ukuran_baju_model->view($id);

				if (!empty($id))
				{
					$data['page_title'] = 'Detail Ukuran Baju';
					$data['ukuran_baju'] = $id;
					$this->template->admin('ukuran_baju/view', $data);
				}
				else
				{
					$data['page_title'] = 'Daftar Ukuran Baju';
					$data['ukuran_baju'] = $this->ukuran_baju_model->list();
					$this->template->admin('ukuran_baju/list', $data);
				}
			break;
		}
	}

	public function harga_bahan($option = NULL, $id = NULL)
	{
		switch ($option) {
			case 'add':
				if ($this->input->method(TRUE) === 'POST')
				{
					$this->form_validation->set_rules('ukuran', 'Ukuran', 'trim|integer|required');
					$this->form_validation->set_rules('harga', 'Harga', 'trim|numeric|required');

					if ($this->form_validation->run() == TRUE)
					{
						$harga_bahan = $this->harga_per_ukuran_model->get_where(array(
							'bahan' => $id,
							'ukuran' => $this->input->post('ukuran')
						));

						if (empty($harga_bahan))
						{
							$this->harga_per_ukuran_model->create(array(
								'bahan' => $id,
								'ukuran' => $this->input->post('ukuran'),
								'harga' => $this->input->post('harga')
							));

							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data harga bahan berhasil ditambahkan'));
							redirect(base_url('admin/harga_bahan/view/'.$id), 'refresh');
						}
						else
						{
							$this->session->set_flashdata('flash_message', array('status' => 'warning', 'message' => 'Data harga bahan sudah tersedia'));
							redirect(base_url('admin/harga_bahan/view/'.$id), 'refresh');
						}
					}
					else
					{
						$data['page_title'] = 'Tambah Harga Bahan';
						$this->template->admin('harga_bahan/add', $data);
					}
				}
				else
				{
					$data['page_title'] = 'Tambah Harga Bahan';
					$this->template->admin('harga_bahan/add', $data);
				}
			break;

			case 'update':
				$id = $this->harga_per_ukuran_model->view($id);
				if (!empty($id))
				{
					if ($this->input->method(TRUE) === 'POST')
					{
						$this->form_validation->set_rules('ukuran', 'Ukuran', 'trim|integer|required');
						$this->form_validation->set_rules('harga', 'Harga', 'trim|numeric|required');

						if ($this->form_validation->run() == TRUE)
						{
							$this->harga_per_ukuran_model->update(array(
								'bahan' => $id['bahan'],
								'ukuran' => $this->input->post('ukuran'),
								'harga' => $this->input->post('harga')
							), array('id' => $id['id']));

							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data harga bahan berhasil diperbaharui'));
							redirect(base_url('admin/harga_bahan/view/'.$id['bahan']), 'refresh');
						}
						else
						{
							$data['harga_bahan'] = $id;
							$data['page_title'] = 'Perbaharui Harga Bahan';
							$this->template->admin('harga_bahan/add', $data);
						}
					}
					else
					{
						$data['harga_bahan'] = $id;
						$data['page_title'] = 'Perbaharui Harga Bahan';
						$this->template->admin('harga_bahan/update', $data);
					}
				}
				else
				{
					show_404();
				}
			break;

			case 'delete':
				$harga_bahan = $this->harga_per_ukuran_model->view($id);
				if (!empty($harga_bahan))
				{
					$this->harga_per_ukuran_model->delete(array('id' => $harga_bahan['id']));
					redirect(base_url('admin/harga_bahan/view/'.$harga_bahan['bahan']), 'refresh');
				}
				else
				{
					redirect(base_url('admin/harga_bahan/view/'.$harga_bahan['bahan']), 'refresh');
				}
			break;

			default:
				$bahan = $this->bahan_baju_model->view($id);
				if (!empty($bahan))
				{
					$id = $this->harga_per_ukuran_model->get_where(array('bahan' => $bahan['id']));
					$data['harga_bahan'] = $id;
					$data['page_title'] = 'Harga Bahan '.$bahan['jenis'].'-'.$bahan['warna'];
					$this->template->admin('harga_bahan/list', $data);
				}
				else
				{
					echo('arg1');
				}
			break;
		}
	}

	/**
	 * Pengguna
	 * 
	 * @param  string $option
	 * @param  integer $id
	 */
	public function pengguna($option = NULL, $id = NULL)
	{
		$config['upload_path'] = './uploads/foto_pengguna/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		switch ($option) {
			case 'add':
				if ($this->input->method(TRUE) === 'POST')
				{
					$this->form_validation->set_rules('role', 'Role', 'trim|required');
					$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
					$this->form_validation->set_rules('seluler', 'Seluler', 'trim');
					$this->form_validation->set_rules('username', 'Username', 'trim|is_unique[pengguna.username]');
					$this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required');
					$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
					$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
					$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[aktif,non-aktif,blokir]');
					
					if ($this->form_validation->run() === TRUE)
					{
						$foto = NULL;

						if (!empty($_FILES['foto']['name'])) 
						{
							if ($this->upload->do_upload('foto')) {
								$foto = 'uploads/foto_pengguna/'.$this->upload->data()['file_name'];
							}
						}

						$this->pengguna_model->create(array(
							'role' => $this->input->post('role'),
							'email' => $this->input->post('email'),
							'seluler' => $this->input->post('seluler'),
							'username' => $this->input->post('username'),
							'password' => md5($this->input->post('password')),
							'nama_lengkap' => $this->input->post('nama_lengkap'),
							'foto' => $foto,
							'alamat' => $this->input->post('alamat'),
							'status' => $this->input->post('status')
						));
						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data pengguna telah ditambahkan'));
						redirect(base_url('admin/pengguna'), 'refresh');
					}
					else
					{
						$data['page_title'] = 'Tambah Data Pengguna';
						$this->template->admin('pengguna/add', $data);
					}
				}
				else
				{
					$data['page_title'] = 'Tambah Data Pengguna';
					$this->template->admin('pengguna/add', $data);
				}
			break;

			case 'update':
				$id = $this->pengguna_model->view($id);

				if (!empty($id))
				{
					if ($this->input->method(TRUE) === 'POST')
					{
						$this->form_validation->set_rules('role', 'Role', 'trim|required');
						$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
						$this->form_validation->set_rules('seluler', 'Seluler', 'trim');
						$this->form_validation->set_rules('username', 'Username', 'trim');
						$this->form_validation->set_rules('password', 'Kata Sandi', 'trim');
						$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
						$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
						$this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[aktif,non-aktif,blokir]');
						
						if ($this->form_validation->run() === TRUE)
						{
							$foto = $id['foto'];

							if (!empty($_FILES['foto']['name'])) 
							{
								if ($this->upload->do_upload('foto')) {
									$foto = 'uploads/foto_pengguna/'.$this->upload->data()['file_name'];
								}
							}

							$this->pengguna_model->update(array(
								'role' => $this->input->post('role'),
								'email' => $this->input->post('email'),
								'seluler' => $this->input->post('seluler'),
								'username' => $this->input->post('username'),
								'password' =>  (!empty($this->input->post('password')))?md5($this->input->post('password')):$id['password'],
								'nama_lengkap' => $this->input->post('nama_lengkap'),
								'foto' => $foto,
								'alamat' => $this->input->post('alamat'),
								'status' => $this->input->post('status')
							), array('id' => $id['id']));
							$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data pengguna telah diperbaharui'));
							redirect(base_url('admin/pengguna'), 'refresh');
						}
						else
						{
							$data['page_title'] = 'Sunting Data Pengguna';
							$data['pengguna'] = $id;
							$this->template->admin('pengguna/update', $data);
						}
					}
					else
					{
						$data['page_title'] = 'Sunting Data Pengguna';
						$data['pengguna'] = $id;
						$this->template->admin('pengguna/update', $data);
					}
				}
				else
				{
					show_404();
				}
			break;

			case 'delete':	
				$id = $this->pengguna_model->view($id);

				if (!empty($id))
				{
					$this->pengguna_model->delete(array('id' => $id['id']));
					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data pengguna telah dihapus'));
					redirect(base_url('admin/pengguna'), 'refresh');
				}
				else
				{
					show_404();
				}
			break;

			default:
				$id = $this->pengguna_model->view($id);

				if (!empty($id))
				{
					$data['page_title'] = 'Detail Pengguna';
					$data['pengguna'] = $id;
					$this->template->admin('pengguna/view', $data);
				}
				else
				{
					$data['page_title'] = 'Daftar Pengguna';
					$data['pengguna'] = $this->pengguna_model->list();
					$this->template->admin('pengguna/list', $data);
				}
			break;
		}
	}

	/**
	 * Logout
	 */
	public function keluar()
	{
		session_destroy();
		redirect(base_url(), 'refresh');
	}
}

/* End of file Admin.php */
/* Location : ./application/controllers/Admin.php */