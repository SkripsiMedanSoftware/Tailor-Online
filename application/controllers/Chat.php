<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Chat
 * @category Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class Chat extends CI_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get chat message
	 * 
	 * @param  integer $room_id
	 * @param  integer $limit
	 * @param  integer $offset
	 */
	public function messages($room_id = NULL, $limit = 10, $offset = 0)
	{
		$chat_room = $this->chat_room_model->view($room_id);

		if (!empty($chat_room))
		{
			$messages = $this->chat_message_model->get_where(array('chat_room' => $chat_room['id']));
			$this->output->set_content_type('application/json')->set_output(json_encode(array(
				'status' => 'success',
				'data' => array(
					'chat_room' => $chat_room,
					'messages' => $messages
				))
			));
		}
		else
		{
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'failed', 'message' => 'chat_room_not_found')));
		}
	}

	/**
	 * Send message to chat room
	 * 
	 * @param  integer $room_id
	 */
	public function send_message($room_id = NULL)
	{
		if ($this->input->method(TRUE) === 'POST')
		{
			$chat_room = $this->chat_room_model->view($room_id);

			if (!empty($chat_room))
			{
				$messages = $this->chat_message_model->get_where(array('chat_room' => $chat_room['id']));
				$this->output->set_content_type('application/json')->set_output(json_encode(array(
					'status' => 'success',
					'data' => array(
						'chat_room' => $chat_room,
						'messages' => $messages
					))
				));
			}
			else
			{
				$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'failed', 'message' => 'chat_room_not_found')));
			}
		}
		else
		{

		}
	}
}

/* End of file Chat.php */
/* Location : ./application/controllers/Chat.php */