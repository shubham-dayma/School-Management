	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Grade_scheme extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('grade').' '.lang('scheme');	
				$this->breadcrumbs->unshift(1, lang('grade').' '.lang('scheme'), 'admin/grade_scheme');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_where('non_co_scolastic_grade_schemes','session_id',$this->session->userdata('academic_session'))->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('scheme');
				$this->template->admin_render('admin/non_co_scolastic_grade_schemes/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/grade_scheme/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['classes'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('scheme');
					$save['creat_date'] = date('Y-m-d h:i:s');
					$save['session_id'] = $this->session->userdata('academic_session');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('scheme');
					$this->data['row'] = $this->custom_lib->get_where('non_co_scolastic_grade_schemes','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:name', 'required');
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['classes'] = json_encode($this->input->post('classes'));
						$this->custom_lib->form('non_co_scolastic_grade_schemes',$save);
						redirect ('admin/grade_scheme');
					}
				}
				$this->template->admin_render('admin/non_co_scolastic_grade_schemes/form',$this->data);
			}

			public function delete($id){
				$grades = $this->custom_lib->get_where('non_co_scolastic_grades','scheme_id',$id)->result();
				if (empty($grades)){
					$this->custom_lib->delete_where('non_co_scolastic_grade_schemes','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/grade_scheme');
				}
				else{
					$this->breadcrumbs->unshift(3, lang('delete'), 'admin/grade_scheme/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_grades_exist');
					$this->data['back_url'] = site_url('admin/grade_scheme');
					$this->data['redirect_url'] = site_url('admin/grade_scheme/grades/'.$id);
					$this->data['redirect_caption'] = lang('towards_gardes');
					$this->template->admin_render('admin/non_co_scolastic_grade_schemes/delete',$this->data);	
				}
			}
			
			public function grades($scheme_id){
				$this->data['page_title'] = lang('grades');
				$this->breadcrumbs->unshift(2, lang('grades'), 'admin/grade_scheme/grades/'.$scheme_id);
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['delete_msg'] = lang('delete_msg').' '.lang('grade');;
				$this->data['result'] = $this->custom_lib->get_where('non_co_scolastic_grades','scheme_id',$scheme_id)->result();
				$this->data['scheme_id'] = $scheme_id;
				$this->template->admin_render('admin/non_co_scolastic_grade_schemes/grade_index',$this->data);	
			}
			public function form_grade($scheme_id , $id = ''){
				$this->data['page_title'] = lang('grades');
				$this->breadcrumbs->unshift(2, lang('grades'), 'admin/grade_scheme/grades/'.$scheme_id);
				$this->breadcrumbs->unshift(3, lang('form'), 'admin/grade_scheme/form_grade/'.$scheme_id);
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['scheme_id'] = $scheme_id;
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('grade');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('grade');
					$this->data['row'] = $this->custom_lib->get_where('non_co_scolastic_grades','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$gardes = $this->custom_lib->get_all('non_co_scolastic_grades')->result();
					$this->form_validation->set_rules('name', 'lang:name', 'required');
					$this->form_validation->set_rules('marks_from', 'lang:from', 'required|greater_than['.@end ($gardes)->marks_to.']');
					$this->form_validation->set_rules('marks_to', 'lang:to', 'required|greater_than['.$this->input->post('marks_from')	.']');
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['scheme_id'] = $scheme_id;
						$save['name'] = $this->input->post('name');
						$save['marks_from'] = $this->input->post('marks_from');
						$save['marks_to'] = $this->input->post('marks_to');
						$this->custom_lib->form('non_co_scolastic_grades',$save);
						redirect ('admin/grade_scheme/grades/'.$scheme_id);
					}
				}
				$this->template->admin_render('admin/non_co_scolastic_grade_schemes/grade_form',$this->data);
			}
			public function delete_grade($id){
				$this->load->library('user_agent');
				$this->custom_lib->delete_where('non_co_scolastic_grades','id',$id);
				$this->session->set_flashdata('danger',lang('record_deleted'));
				redirect ($this->agent->referrer());
			}
		}	
