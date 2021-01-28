<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Utilites extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model('admin/session_student_section');
			$this->breadcrumbs->unshift(1, lang('pramote/demote'), 'admin/utilites');
			$this->data['page_title'] = lang('setting');	
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['current_session'] = $this->custom_lib->get_where('academic_session','id',$this->session->userdata('academic_session'))->row();
			$this->data['current_session_classes'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			$this->data['sessions'] = $this->custom_lib->get_all('academic_session')->result();
			if (!empty ($this->input->post('save'))){
				$this->form_validation->set_rules('pd_session_id', 'lang:session', 'required');
				$this->form_validation->set_rules('pd_section_id', 'New class', 'required');
				$this->form_validation->set_rules('student_id[]', 'lang:student', 'required',array('required'=> 'Please select the students'));
				if ($this->form_validation->run() == TRUE){
					//echo '<pre>';print_r($_POST);die;
					foreach ($this->input->post('student_id') as $student) {
						$save['session_id'] = $this->input->post('pd_session_id');
						$save['section_id'] = $this->input->post('pd_section_id');
						$save['student_id'] = $student;
						$this->session_student_section->form($save);
					}
					redirect ('admin/utilites');
				}
			}
			
			if (!empty ($this->input->post('section_id'))){
				$this->data['students'] = $this->session_student_section->get_non_promoted_student($this->session->userdata('academic_session'),$_POST['pd_session_id'],$this->input->post('section_id'));
				$this->data['new_session_classes'] = $this->custom_lib->get_where('classes','session_id',$this->input->post('pd_session_id'))->result();
			}
			$this->template->admin_render('admin/utilites/index',$this->data);
		}
		public function session_sections_ajax(){
			$classes = $this->custom_lib->get_where('classes','session_id',$_POST['pd_session_id'])->result();
			if (!empty ($classes)){
				foreach ($classes as $class){
					$sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
					if (!empty ($sections)){
						foreach ($sections as $section){
							echo '<option value="'.$section->id.'">'.$class->name.' '.$section->name.'</option>';
						}
					}
				}
			}
			die;
		}
		public function db_backup (){
			$this->breadcrumbs->unshift(2, lang('db_backup'), 'admin/utilites/db_backup');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			if ($this->input->post('submit')){
				$this->load->dbutil();
				$prefs = array(     
				'format'      => 'zip',             
				'filename'    => 'db_backup.sql'
				);
				$backup =& $this->dbutil->backup($prefs); 
				$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
				$this->load->helper('download');
				force_download($db_name, $backup);
				$this->session->set_flashdata('success',lang('backup_downloaded'));
			}
			$this->template->admin_render('admin/utilites/db_backup',$this->data);
		}
		public function change_password(){
			$this->breadcrumbs->unshift(2, lang('change_password'), 'admin/utilites/change_password');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['modules'] = $this->custom_lib->get_where('staff','staff_category',0)->result();
			if ($this->input->post('save')){
				foreach ($this->data['modules'] as $module){
					if (!empty ($this->input->post('password')[$module->id])){
						$hash = $this->custom_lib->hash_password($this->input->post('password')[$module->id]);
						$save['salt']  = $hash['salt'];
						$save['password']  = $hash['password'];
						$this->custom_lib->update('staff','id',$module->id,$save);
					}
				}
				$this->session->set_flashdata('success',lang('password_changed'));
				redirect ('admin/utilites/change_password');
			}
			$this->template->admin_render('admin/utilites/change_password',$this->data);
		}
		public function import_new_session(){
			$this->breadcrumbs->unshift(2, lang('import_data_new_session'), 'admin/utilites/import_new_session');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['current_session'] = $this->custom_lib->get_where('academic_session','id',$this->session->userdata('academic_session'))->row();
			$this->data['sessions'] = $this->custom_lib->get_all('academic_session')->result();
			if (!empty ($this->input->post('save'))){
				$this->form_validation->set_rules('pd_session_id', 'lang:session', 'required');
				if ($this->form_validation->run() == TRUE){
					//echo '<pre>';print_r($_POST);die;
					$classes = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
					$exam_schemes = $this->custom_lib->get_where('exam_schemes','session_id',$this->session->userdata('academic_session'))->result();
					$non_grades = $this->custom_lib->get_where('non_co_scolastic_grade_schemes','session_id',$this->session->userdata('academic_session'))->result();
					//echo '<pre>';print_r($non_grades);die;
					if (!empty($classes)) {
						foreach ($classes as $class){
							$new_class['name'] = $class->name;
							$new_class['desc'] = $class->desc;
							$new_class['subjects'] = $class->subjects;
							$new_class['session_id'] = $this->input->post('pd_session_id');
							$new_class['creat_date'] = date('Y-m-d h:i:s');
							$cl_id = $this->custom_lib->insert('classes',$new_class);
							$sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
							if (!empty($sections)) {
								foreach ($sections as $section){
									$new_section['name'] = $section->name;
									$new_section['class_id'] = $cl_id;
									$new_section['session_id'] = $this->input->post('pd_session_id');
									$new_section['desc'] = $section->desc;
									$new_section['subjects'] = $section->subjects;
									$new_section['creat_date'] = date('Y-m-d h:i:s');
									$this->custom_lib->insert('sections',$new_section);
								}
							}
						}
					}
					if (!empty($exam_schemes)) {
						foreach ($exam_schemes as $exam_scheme){
							$new_e_schemep['name'] =  $exam_scheme->name;
							$new_e_schemep['desc'] =  $exam_scheme->desc;
							$new_e_schemep['session_id'] =  $this->input->post('pd_session_id');
							$new_e_schemep['creat_date'] = date('Y-m-d h:i:s');
							$sceheme_id = $this->custom_lib->insert('exam_schemes',$new_e_schemep);
							$exams = $this->custom_lib->get_where('exams','scheme_id',$exam_scheme->id)->result();
							if (!empty($exams)){
								foreach ($exams as $exam){
									$new_exam['name'] = $exam->name;
									$new_exam['caption'] = $exam->caption;
									$new_exam['short_name'] = $exam->short_name;
									$new_exam['scheme_id'] = $sceheme_id;
									$new_exam['creat_date'] = date('Y-m-d');
									$this->custom_lib->insert('exams',$new_exam);
								}
							}
						}
					}
					if (!empty($non_grades)){
						foreach ($non_grades as $non_grade){
							$new_e_scheme['name'] = $non_grade->name;
							$new_e_scheme['session_id'] =  $this->input->post('pd_session_id');
							$new_e_scheme['creat_date'] = date('Y-m-d h:i:s');
							$grad_sch_id = $this->custom_lib->insert('non_co_scolastic_grade_schemes',$new_e_scheme);
							$non_co_grades = $this->custom_lib->get_where('non_co_scolastic_grades','scheme_id',$non_grade->id)->result();
							if (!empty($non_co_grades)) {
								foreach ($non_co_grades as $non_co_grade) {
									$new_non_co_grade['scheme_id'] = $this->input->post('pd_session_id');
									$new_non_co_grade['name'] = $non_co_grade->name;
									$new_non_co_grade['marks_from'] = $non_co_grade->marks_from;
									$new_non_co_grade['marks_to'] = $non_co_grade->marks_to;
									$this->custom_lib->insert('non_co_scolastic_grades',$new_non_co_grade);
								}
							}
						}
					}
				}
			}	
			$this->template->admin_render('admin/utilites/import_new_session',$this->data);
		}
	}	
