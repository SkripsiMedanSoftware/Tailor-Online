<?php

/**
 * Xdata
 * 
 * @param  string 	$option
 * @param  integer 	$id
 */
// public function xdata($option = NULL, $id = NULL)
// {
// 	switch ($option) {
// 		case 'add':
// 			if ($this->input->method(TRUE) === 'POST')
// 			{
// 				$this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|max_length[12]');
				
// 				if ($this->form_validation->run() === TRUE)
// 				{
// 					$this->xdata_model->create(array(
// 					));
// 					$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data xdatmessage telah ditambahkan'));
// 					redirect(base_url('admin/xdata'), 'refresh');
// 				}
// 				else
// 				{
// 					$data['page_title'] = 'Tambah XData_Title';
// 					$this->template->admin('xdata/add', $data);
// 				}
// 			}
// 			else
// 			{
// 				$data['page_title'] = 'Tambah XData_Title';
// 				$this->template->admin('xdata/add', $data);
// 			}
// 		break;

// 		case 'update':
// 			$id = $this->xdata_model->view($id);

// 			if (!empty($id))
// 			{
// 				if ($this->input->method(TRUE) === 'POST')
// 				{
// 					$this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|max_length[12]');
					
// 					if ($this->form_validation->run() === TRUE)
// 					{
// 						$this->xdata_model->update(array(), array('id' => $id['id']));
// 						$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data xdatmessage telah diperbaharui'));
// 						redirect(base_url('admin/xdata'), 'refresh');
// 					}
// 					else
// 					{
// 						$data['page_title'] = 'Sunting XData_Title';
// 						$data['xdata'] = $id;
// 						$this->template->admin('xdata/update', $data);
// 					}
// 				}
// 				else
// 				{
// 					$data['page_title'] = 'Sunting XData_Title';
// 					$data['xdata'] = $id;
// 					$this->template->admin('xdata/update', $data);
// 				}
// 			}
// 			else
// 			{
// 				show_404();
// 			}
// 		break;

// 		case 'delete':	
// 			$id = $this->xdata_model->view($id);

// 			if (!empty($id))
// 			{
// 				$this->xdata_model->delete(array('id' => $id['id']));
// 				$this->session->set_flashdata('flash_message', array('status' => 'success', 'message' => 'Data xdatmessage telah dihapus'));
// 				redirect(base_url('admin/xdata'), 'refresh');
// 			}
// 			else
// 			{
// 				show_404();
// 			}
// 		break;

// 		default:
// 			$id = $this->xdata_model->view($id);

// 			if (!empty($id))
// 			{
// 				$data['page_title'] = 'Detail XData_Title';
// 				$data['xdata'] = $id;
// 				$this->template->admin('xdata/view', $data);
// 			}
// 			else
// 			{
// 				$data['page_title'] = 'Daftar XData_Title';
// 				$data['xdata'] = $this->xdata_model->list();
// 				$this->template->admin('xdata/list', $data);
// 			}
// 		break;
// 	}
// }