	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Heads extends Fees_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('fee_heads');	
				$this->breadcrumbs->unshift(1, lang('fee_heads'), 'fees/heads');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('fees_heads')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('fee_head');
				$this->template->fees_render('fees/heads/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'fees/heads/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('fee_head');
					$save['creat_date'] = date('Y-m-d');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('fee_head');
					$this->data['row'] = $this->custom_lib->get_where('fees_heads','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:name', 'required');
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$this->custom_lib->form('fees_heads',$save);
						redirect ('fees/heads');
					}
				}
				$this->template->fees_render('fees/heads/form',$this->data);
			}

			public function delete($id){
				$result = $this->custom_lib->get_where('fees_pay_group_heads','head_id',$id)->result();
				if (empty ($result)) {
					$this->custom_lib->delete_where('fees_heads','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('fees/heads');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'fees/heads/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_head_payment_exist');
					$this->data['back_url'] = site_url('fees/heads');
					$this->template->fees_render('fees/heads/delete',$this->data);
				}
				
			}
			
		}	
