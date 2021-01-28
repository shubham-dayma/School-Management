	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Co_scolastic_grades extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('co_scolastic_grades');	
				$this->breadcrumbs->unshift(1, lang('co_scolastic_grades'), 'admin/co_scolastic_grades');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('co_scolastic_grades')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('co_scolastic_grade');
				$this->template->admin_render('admin/co_scolastic_grades/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/co_scolastic_grades/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('creat').' '.lang('co_scolastic_grade');
					$save['creat_date'] = date('Y-m-d h:i:s');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('co_scolastic_grade');
					$this->data['row'] = $this->custom_lib->get_where('co_scolastic_grades','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$gardes = $this->custom_lib->get_all('co_scolastic_grades')->result();
					$this->form_validation->set_rules('name', 'lang:name', 'required');
					$this->form_validation->set_rules('marks_from', 'lang:from', 'required|greater_than['.@end ($gardes)->marks_to.']');
					$this->form_validation->set_rules('marks_to', 'lang:to', 'required|greater_than['.$this->input->post('marks_from')	.']');
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['marks_from'] = $this->input->post('marks_from');
						$save['marks_to'] = $this->input->post('marks_to');
						$this->custom_lib->form('co_scolastic_grades',$save);
						redirect ('admin/co_scolastic_grades');
					}
				}
				$this->template->admin_render('admin/co_scolastic_grades/form',$this->data);
			}

			public function delete($id){
				$this->custom_lib->delete_where('co_scolastic_grades','id',$id);
				$this->session->set_flashdata('danger',lang('record_deleted'));
				redirect ('admin/co_scolastic_grades');
			}
			
		}	
