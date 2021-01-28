	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Graded_subjects extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('co_scolastic').' '.lang('subjects');	
				$this->breadcrumbs->unshift(1, lang('co_scolastic').' '.lang('subjects'), 'admin/graded_subjects');
				$this->load->model(array('admin/Grade_subject','admin/Marks_zone'));
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('co_scolastic_subjects')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('co_scolastic').' '.lang('subjects');
				$this->template->admin_render('admin/co_scolastic_subjects/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/graded_subjects/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('co_scolastic').' '.lang('subject');
					$save['creat_date'] = date('Y-m-d');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('co_scolastic').' '.lang('subject');
					$this->data['row'] = $this->custom_lib->get_where('co_scolastic_subjects','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:name', 'required');
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['desc'] = $this->input->post('desc');
						$this->custom_lib->form('co_scolastic_subjects',$save);
						redirect ('admin/graded_subjects');
					}
				}
				$this->template->admin_render('admin/co_scolastic_subjects/form',$this->data);
			}

			public function delete($id){
				$applied = $this->custom_lib->field_like('rel_class_co_scolastic_subjects','subjects','"'.$id.'"')->result();
				if (empty ($applied)) {
					$this->custom_lib->delete_where('co_scolastic_subjects','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/graded_subjects');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'admin/graded_subjects/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_subjects_are_applied_exist_error');
					$this->data['back_url'] = site_url('admin/graded_subjects');
					$this->data['redirect_url'] = site_url('admin/graded_subjects/list_classes');
					$this->data['redirect_caption'] = lang('towards_class_list');
					$this->template->admin_render('admin/co_scolastic_subjects/delete',$this->data);
				}
			}
			public function profile($id){
				$this->breadcrumbs->unshift(2, lang('view'), 'admin/graded_subjects/profile');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['row'] = $this->custom_lib->get_where('co_scolastic_subjects','id',$id)->row();
				$this->template->admin_render('admin/co_scolastic_subjects/profile',$this->data);
			}
			public function list_classes(){
				$this->breadcrumbs->unshift(2, lang('classes'),'admin/graded_subjects/list_classes');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['page_sub_title'] = lang('classes');
				$this->data['result'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
				$this->template->admin_render('admin/co_scolastic_subjects/classes_list',$this->data);
			}
			public function apply_subjects($class_id){
				$this->breadcrumbs->unshift(2, lang('classes'),'admin/graded_subjects/list_classes');
				$this->breadcrumbs->unshift(3, lang('classes'),'admin/graded_subjects/apply_classes');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['page_sub_title'] = lang('apply_subjects');
				$this->data['result'] = $this->custom_lib->get_all('co_scolastic_subjects')->result();
				$this->data['class_subjects'] = $this->custom_lib->get_where('rel_class_co_scolastic_subjects','class_id',$class_id)->row();
				//print_r($this->data['class_subjects']);die;
				$this->data['marks_entered'] = '';
				if ($this->input->post('submit')){
					$save['id'] = $this->data['class_subjects']->id;
					$save['class_id'] = $class_id;
					$save['subjects'] = json_encode($this->input->post('subjects'));
					$this->custom_lib->form('rel_class_co_scolastic_subjects',$save);
					redirect ('admin/graded_subjects/list_classes');
				}
				$this->template->admin_render('admin/co_scolastic_subjects/apply_subjects',$this->data);
			}
			public function check_marks_entery(){
				//$tes = $this->Grade_subject->get_subject_on_class($_POST['class_id'],$_POST['subject_id']);
				$sections = $this->Marks_zone->get_marks_entery_class_wise($_POST['class_id'],$_POST['subject_id']);
 				if (!empty($sections)) {
					echo '0';
					die;
				}
				else{
					echo '1';
					die;
				}
				
			}
		}	
