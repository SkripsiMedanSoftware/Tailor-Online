<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Payment
 * @category Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Payment extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		\Midtrans\Config::$serverKey = $this->config->item('serverKey');
		\Midtrans\Config::$isProduction = $this->config->item('isProduction');
		\Midtrans\Config::$isSanitized = $this->config->item('isSanitized');
		\Midtrans\Config::$is3ds = $this->config->item('is3ds');
		\Midtrans\Config::$overrideNotifUrl = base_url('payment');
	}

	public function index()
	{
		$notif = new \Midtrans\Notification();

		$transaction = $notif->transaction_status;
		$fraud = $notif->fraud_status;

		error_log("Order ID $notif->order_id: "."transaction status = $transaction, fraud staus = $fraud");

		echo "<pre>";
		print_r ($transaction);
		echo "</pre>";

		if ($transaction == 'capture') {
		    if ($fraud == 'challenge') {
		      // TODO Set payment status in merchant's database to 'challenge'
		    }
		    else if ($fraud == 'accept') {
		      // TODO Set payment status in merchant's database to 'success'
		    }
		}
		else if ($transaction == 'cancel') {
		    if ($fraud == 'challenge') {
		      // TODO Set payment status in merchant's database to 'failure'
		    }
		    else if ($fraud == 'accept') {
		      // TODO Set payment status in merchant's database to 'failure'
		    }
		}
		else if ($transaction == 'deny') {
		      // TODO Set payment status in merchant's database to 'failure'
		}
	}

	/**
	 * Snap
	 */
	public function snap_token($pesanan_id = NULL)
	{
		\Midtrans\Config::$serverKey = $this->config->item('serverKey');
		\Midtrans\Config::$isProduction = $this->config->item('isProduction');
		\Midtrans\Config::$isSanitized = $this->config->item('isSanitized');
		\Midtrans\Config::$is3ds = $this->config->item('is3ds');

		$pesanan = $this->pesanan_model->view($pesanan_id);

		if (!empty($pesanan))
		{
			try {
				$params = array(
					'transaction_details' => array(
						'order_id' => $pesanan['uid'],
						'gross_amount' => $pesanan['harga']
					),
					'customer_details' => array(
						'first_name' => aktif_sesi()['nama_lengkap'],
						'email' => aktif_sesi()['email'],
						'phone' => aktif_sesi()['seluler']
					)
				);
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 'success',
					'data' => \Midtrans\Snap::getSnapToken($params)
				)));
			} catch (Exception $e) {

				$transaction = \Midtrans\Transaction::status($pesanan['uid']);

				$this->pesanan_model->update(array('status_pembayaran' => $transaction->transaction_status), array('uid' => $pesanan['uid']));
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 'failed',
					'midtrans_code' => $e->getCode()
				)));
			}
		}
		else
		{
			$this->output->set_content_type('application/json')->set_output(json_encode(array(
				'status' => 'failed',
				'message' => 'transaction_not_found'
			)));
		}
	}

	/**
	 * Cek status
	 * 
	 * @param  string $transation_id
	 */
	public function cek_status($transation_id = NULL)
	{
		try {
			$this->output->set_content_type('application/json')->set_output(json_encode(\Midtrans\Transaction::status($transation_id)));
		} catch (Exception $e) {
			switch ($e->getCode())
			{
				case 404:
					$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'failed', 'message' => 'transaction_not_found')));
				break;
				
				default:
				break;
			}
		}
	}

	public function finish()
	{
		$order_id = $this->input->get('order_id');
		$status_code = $this->input->get('status_code');
		$transaction_status = $this->input->get('transaction_status');

		try {
			
			$transaction = \Midtrans\Transaction::status($this->input->get('order_id'));

			switch ($transaction->payment_type) {
				case 'cstore':
					switch ($transaction->transaction_status) {
						case 'pending':
						break;
						
						default:
						break;
					}
				break;

				case 'credit_card':
					switch ($transaction->fraud_status) {
						case 'accept':
						break;
						
						default:
						break;
					}
				break;
				
				default:
				break;
			}

			$this->pesanan_model->update(array('status_pembayaran' => $transaction_status), array('uid' => $order_id));
			$data['transaction'] = $transaction;
			$data['page_title'] = 'Pembayaran Selesai';
			$this->template->site('payment_finish', $data);
		} catch (Exception $e) {
			switch ($e->getCode())
			{
				case 404:
					echo('arg1');
				break;
				
				default:
				break;
			}
		}

		// switch ($transaction->payment_type) {
		// 	case 'credit_card':
		// 	break;
			
		// 	default:
		// 	break;
		// }
		
		// switch ($transaction->transaction_status) {
		// 	case 'capture':
		// 		if ($transaction->fraud_status == 'accept')
		// 		{

		// 		}
		// 		elseif ($transaction->fraud_status == 'challenge')
		// 		{

		// 		}
		// 	break;
			
		// 	default:
		// 	break;
		// }
	}

	public function unfinish()
	{

	}

	public function error()
	{

	}
}

/* End of file Payment.php */
/* Location : ./application/controllers/Payment.php */