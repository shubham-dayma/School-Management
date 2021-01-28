<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Exam_scheme extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('exam_scheme');	
			$this->breadcrumbs->unshift(1, lang('exam_scheme'), 'admin/exam_scheme');
			$this->load->model(array('admin/Session_exams'));
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_where('exam_schemes','session_id',$this->session->userdata('academic_session'))->result();
			$this->data['delete_msg']  = 'Are You Sure to delete this Exam Scheme';
			$this->template->admin_render('admin/exam_scheme/index',$this->data);
		}
		public function form($id = ''){
			$this->breadcrumbs->unshift(2, lang('form'), 'admin/exam_scheme/form');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['classes'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			if (empty ($id)){
				$this->data['page_sub_title'] = lang('creat').' '.lang('exam_scheme');
				$save['creat_date'] = date('Y-m-d h:i:s');
			}
			if (!empty ($id)){
				$this->data['page_sub_title'] = lang('edit').' '.lang('exam_scheme');
				$this->data['row'] = $this->custom_lib->get_where('exam_schemes','id',$id)->row();
				//print_r($this->data['row']);die;
			}
			
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('name', 'lang:name', 'required');
				if ($this->form_validation->run() == TRUE){
					$save['id'] = $id;
					$save['name'] = $this->input->post('name');
					$save['desc'] = $this->input->post('desc');
					$save['classes'] = json_encode($this->input->post('classes'));
					$save['session_id'] = $this->session->userdata('academic_session');
					$this->custom_lib->form('exam_schemes',$save);
					redirect ('admin/exam_scheme');
				}
			}
			$this->template->admin_render('admin/exam_scheme/form',$this->data);
		}
		public function delete($id){
			$exams = $this->custom_lib->get_where('exams','scheme_id',$id)->result();
			if (empty ($exams)) {
				$this->custom_lib->delete_where('exam_schemes','id',$id);
				$this->session->set_flashdata('danger',lang('record_deleted'));
				redirect ('admin/exam_scheme');
			}
			else {
				$this->breadcrumbs->unshift(2, lang('delete'), 'admin/exam_scheme/delete');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['error_msg'] = lang('delete_exam_exist');
				$this->data['back_url'] = site_url('admin/exam_scheme');
				$this->data['redirect_url'] = site_url('admin/exam_scheme/list_exam/'.$id);
				$this->data['redirect_caption'] = lang('towards_exams');
				$this->template->admin_render('admin/exam_scheme/delete',$this->data);
			}
		}
		public function profile($id){
			$this->breadcrumbs->unshift(2, lang('view'), 'admin/exam_scheme/profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['row'] = $this->custom_lib->get_where('exam_schemes','id',$id)->row();
			$this->data['exams'] = $this->custom_lib->get_where('exams','scheme_id',$id)->result();
			$this->data['classes'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			//echo '<pre>';print_r($this->data['row']);die;
			$this->template->admin_render('admin/exam_scheme/profile',$this->data);
		}
		public function list_exam($scheme_id){
			$this->breadcrumbs->unshift(2, lang('list').' '.lang('exams'), 'admin/exam_scheme/list_exam');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['delete_msg']  = 'Are You Sure to delete this Exam';
			$this->data['result'] = $this->custom_lib->get_where('exams','scheme_id',$scheme_id)->result();
			$this->template->admin_render('admin/exam_scheme/exam_list',$this->data);
		}
		public function exam_form($scheme_id,$id = ''){
			$this->breadcrumbs->unshift(2, lang('list').' '.lang('exams'), 'admin/exam_scheme/list_exam/'.$scheme_id);
			$this->breadcrumbs->unshift(3, lang('form'), 'admin/exam_scheme/form');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			if (empty ($id)){
				$this->data['page_sub_title'] = lang('add').' '.lang('exam');
				$save['creat_date'] = date('Y-m-d h:i:s');
			}
			if (!empty ($id)){
				$this->data['page_sub_title'] = lang('edit').' '.lang('exam');
				$this->data['row'] = $this->custom_lib->get_where('exams','id',$id)->row();
				//print_r($this->data['row']);die;
			}
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('name', 'lang:name', 'required');
				if ($this->form_validation->run() == TRUE){
					$save['id'] = $id;
					$save['name'] = $this->input->post('name');
					$save['from'] = $this->input->post('from');
					$save['to'] = $this->input->post('to');
					$save['to'] = $this->input->post('to');
					$save['caption'] = $this->input->post('caption');
					$save['short_name'] = $this->input->post('short_name');
					$save['scheme_id'] = $scheme_id;
					$this->custom_lib->form('exams',$save);
					redirect ('admin/exam_scheme/list_exam/'.$scheme_id);
				}
			}
			$this->template->admin_render('admin/exam_scheme/exam_form',$this->data);
		}
		public function exam_delete($id){
			$marks = $this->custom_lib->get_where('enter_marks','exam_id',$id)->result();
			$data = $this->custom_lib->get_where('exams','id',$id)->row();
			if (empty($marks)){
				$this->custom_lib->delete_where('exams','id',$id);
				$this->session->set_flashdata('danger',lang('record_deleted'));
				redirect('admin/exam_scheme/list_exam/'.$data->scheme_id);
			}
			else{
				$this->breadcrumbs->unshift(2, lang('exams'), 'admin/exam_scheme/list_exam/'.$data->scheme_id);
				$this->breadcrumbs->unshift(3, lang('delete'), 'admin/country/delete');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['error_msg'] = lang('delete_marks_are_entered_for_this_exam');
				$this->data['back_url'] = site_url('admin/exam_scheme/list_exam/'.$data->scheme_id);
				$this->template->admin_render('admin/exam_scheme/exam_delete',$this->data);			
			}
		}
	}	
