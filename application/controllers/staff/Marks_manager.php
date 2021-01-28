<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Marks_manager extends Staff_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('marks_manager');		
			$this->breadcrumbs->unshift(1, lang('marks_manager'), 'staff/marks_manager');
			$this->load->model(array('admin/Staffs','admin/Marks_zone','admin/session_student_section','admin/attendance'));
			/*--Validating User Role--*/
			$valid_user = $this->Staffs->staff_role(1,$this->session->userdata('user_id'));
			if (empty ($valid_user)){
				redirect ('staff');
			}
		}
		public function index(){
			$this->data['page_title'] = lang('my_role');	
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['roles'] = $this->Staffs->get_staff_roles($this->session->userdata('user_id'));	
			$this->data['result'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result(); 
			//echo'<pre>';print_r($this->data['roles']);die;
			$this->template->staff_render('staff/marks_manager/index',$this->data);
		}
		public function marks_criteria($class_id) {
			$this->breadcrumbs->unshift(2, lang('subjects'), 'staff/marks_manager/marks_criteria');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['class_detail'] = $this->custom_lib->get_where('classes','id',$class_id)->row(); 
			$exam_scheme = $this->custom_lib->field_like('exam_schemes','classes','"'.$class_id.'"')->row();
			if (!empty($exam_scheme)) {
				$this->data['exams'] = $this->custom_lib->get_where('exams','scheme_id',$exam_scheme->id)->result();
			}
			//echo '<pre>';print_r($this->data['exams']);die;
			if ($this->input->post('submit')){
				//echo '<pre>';print_r($_POST);die;
				$i=0;
				foreach ($this->input->post('subject_id') as $subject_id){
					$save['exam_id'] = $this->input->post('exam');
					$save['session_id'] = $this->session->userdata('academic_session');
					$save['class_id'] = $class_id;
					$save['subject_id'] = $subject_id;
					$save['max_marks'] = $this->input->post('max')[$i];
					$save['min_marks'] = $this->input->post('min')[$i];
					$this->Marks_zone->subject_marks_criteria_form($save);
					$i++;
				}
				$this->session->set_flashdata('success',lang('marks_crieria_set'));
				redirect ('staff/marks_manager');
			}
			$this->template->staff_render('staff/marks_manager/class_subjects',$this->data);
		}
		public function class_section ($class_id){
			$this->breadcrumbs->unshift(2, lang('sections'), 'staff/marks_manager/class_section');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['class_detail'] = $this->custom_lib->get_where('classes','id',$class_id)->row(); 
			$this->data['result'] = $this->custom_lib->get_where('sections','class_id',$class_id)->result();
			$this->template->staff_render('staff/marks_manager/class_section',$this->data);
		}
		public function section_subject($section_id){
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row();
			$exam_scheme = $this->custom_lib->field_like('exam_schemes','classes','"'.$this->data['section_detail']->class_id.'"')->row();
			$this->data['exams'] = $this->custom_lib->get_where('exams','scheme_id',@$exam_scheme->id)->result(); 
			$class_co_subjects = $this->custom_lib->get_where('rel_class_co_scolastic_subjects','class_id',$this->data['section_detail']->class_id)->row();
			$this->data['co_scolastic_subjects'] = json_decode(@$class_co_subjects->subjects);
			$this->data['marksheets'] = $this->custom_lib->get_where('marksheets','	exam_scheme_id',@$exam_scheme->id)->result();
			//echo'<pre>';print_r($this->data['exams']);die;
			$this->breadcrumbs->unshift(2, lang('sections'), 'staff/marks_manager/class_section/'.$this->data['section_detail']->class_id);
			$this->breadcrumbs->unshift(3, lang('subjects'), 'staff/marks_manager/section_subject');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->template->staff_render('staff/marks_manager/section_subject',$this->data);
		}
		public function enter_marks($section_id,$subject_id,$exam_id){
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row(); 
			$this->data['subject_detail'] = $this->custom_lib->get_where('subjects','id',$subject_id)->row(); 
			$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$section_id);
			$this->data['marks_crieia'] = $this->Marks_zone->get_subject_marks_criteria($this->session->userdata('academic_session'),$this->data['section_detail']->class_id,$subject_id,$exam_id);
			if (empty($this->data['marks_crieia'])){
				redirect ('staff/marks_manager/section_subject/'.$section_id);
			}
			//echo '<pre>';print_r($this->data['marks_crieia']);die;
			if (!empty($this->input->post('submit'))){
				if (!empty($this->input->post('student_id'))) {
					$i = 0;
					foreach ($this->input->post('student_id') as $student_id){
						$save['exam_id'] = $exam_id;
						$save['subject_id'] = $subject_id;
						$save['section_id'] = $section_id;
						$save['student_id'] = $student_id;
						if ($this->input->post('attendance')[$i] != 0){
							$save['attendence'] = $this->input->post('attendance')[$i];
							$save['marks'] = '';
							$this->Marks_zone->marks_entery_form($save);
						}
						if ($this->input->post('marks')[$i] != '' && $this->input->post('attendance')[$i] == 0){
							$save['attendence'] = $this->input->post('attendance')[$i];
							$save['marks'] = $this->input->post('marks')[$i];
							$this->Marks_zone->marks_entery_form($save);
						}
						$i++;
					}
				}
				redirect ('staff/marks_manager/section_subject/'.$section_id);
			}
			$this->breadcrumbs->unshift(2, lang('sections'), 'staff/marks_manager/class_section/'.$this->data['section_detail']->class_id);
			$this->breadcrumbs->unshift(3, lang('subjects'), 'staff/marks_manager/section_subject/'.$section_id);
			$this->breadcrumbs->unshift(4, lang('enter_marks'), 'staff/marks_manager/enter_marks/'.$section_id.'/'.$subject_id);
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->template->staff_render('staff/marks_manager/enter_marks',$this->data);
		}
		public function co_scolastic_marks($section_id,$subject_id){
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row();
			$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$section_id);
			$this->data['gardes'] = $this->custom_lib->get_all('co_scolastic_grades')->result();	
	   		$this->data['subject_detail'] = $this->custom_lib->get_where('co_scolastic_subjects','id',$subject_id)->row();
	   		//echo '<pre>';print_r($this->data['gardes']);die;
			if (!empty($this->input->post('submit'))){
				if (!empty($this->input->post('student_id'))) {
					$i = 0;
					foreach ($this->input->post('student_id') as $student_id){
						$save['subject_id'] = $subject_id;
						$save['section_id'] = $section_id;
						$save['student_id'] = $student_id;
						if ($this->input->post('attendance')[$i] != 0){
							$save['attendence'] = $this->input->post('attendance')[$i];
							$save['marks'] = '';
							$save['grade'] = '';
							$this->Marks_zone->col_scolastic_marks_entery_form($save);
						}
						if ($this->input->post('marks')[$i] != '' && $this->input->post('attendance')[$i] == 0){
							$save['attendence'] = $this->input->post('attendance')[$i];
							$save['marks'] = $this->input->post('marks')[$i];
							$save['grade'] =  $this->input->post('marks')[$i];
							$this->Marks_zone->col_scolastic_marks_entery_form($save);
						}
						$i++;
					}
				}
				redirect ('staff/marks_manager/section_subject/'.$section_id);
			}
			$this->breadcrumbs->unshift(2, lang('sections'), 'staff/marks_manager/class_section/'.$this->data['section_detail']->class_id);
			$this->breadcrumbs->unshift(3, lang('subjects'), 'staff/marks_manager/section_subject/'.$section_id);
			$this->breadcrumbs->unshift(4, lang('enter_marks'), 'staff/marks_manager/co_scolastic_marks/'.$section_id.'/'.$subject_id);
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->template->staff_render('staff/marks_manager/co_scolastic_marks',$this->data);
		}
		public function print_marksheet($section_id,$marksheet_id){
			$this->data['sessions'] = $this->custom_lib->get_all('academic_session')->result();
			if ($this->input->post('submit')){
				$this->data['promoted_class'] = $this->input->post('promoted_class');
				$this->data['students'] = $this->session_student_section->search_student($this->input->post('enrol_no'),$this->input->post('fname'),$section_id);
				if (!empty ($this->data['students'])){
					foreach ($this->data['students'] as $student){
						$this->Marks_zone->student_marksheet($student->id,$section_id);
					}
				}
				$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$section_id)->row(); 
				$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row();
				$this->data['marksheet'] = $this->custom_lib->get_where('marksheets','id',$marksheet_id)->row();
				$this->data['grades'] = $this->custom_lib->get_where('non_co_scolastic_grades','scheme_id',$this->data['marksheet']->grade_scheme_id)->result();
				/*--Marks Criteria--*/
				$subject_ids = json_decode($this->data['section_detail']->subjects);
				$max_marks = 0;
				$min_marks = 0;
				if (!empty ($subject_ids)) { 
					foreach ($subject_ids as $subject_id){
						$subjects = $this->Marks_zone->subject_criteria_anuual($this->session->userdata('academic_session'),$this->data['class']->id, $subject_id);	
						$this->data['subjects'][]  = $subjects;
					}
				}	
			}
			$this->load->view('staff/marks_manager/print_marksheet',$this->data);
		}	   
		public function print_marksheet_one_to_fifth($section_id,$marksheet_id){
			$this->data['sessions'] = $this->custom_lib->get_all('academic_session')->result();
			if ($this->input->post('submit')){
				$this->data['promoted_class'] = $this->input->post('promoted_class');
				$this->data['students'] = $this->session_student_section->search_student($this->input->post('enrol_no'),$this->input->post('fname'),$section_id);
				if (!empty ($this->data['students'])){
					foreach ($this->data['students'] as $student){
						$this->Marks_zone->student_marksheet($student->id,$section_id);
					}
				}
				$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$section_id)->row(); 
				$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row();
				$this->data['marksheet'] = $this->custom_lib->get_where('marksheets','id',$marksheet_id)->row();
				$this->data['grades'] = $this->custom_lib->get_where('non_co_scolastic_grades','scheme_id',$this->data['marksheet']->grade_scheme_id)->result();
				/*--Marks Criteria--*/
				$subject_ids = json_decode($this->data['section_detail']->subjects);
				$max_marks = 0;
				$min_marks = 0;
				if (!empty ($subject_ids)) { 
					foreach ($subject_ids as $subject_id){
						$subjects = $this->Marks_zone->subject_criteria_anuual($this->session->userdata('academic_session'),$this->data['class']->id, $subject_id);	
						$this->data['subjects'][]  = $subjects;
					}
				}	
			}
			$this->load->view('staff/marks_manager/print_marksheet_one_to_fifth',$this->data);
		}	   
		
		public function tabsheet_1($section_id){
			$this->data['students'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$section_id);
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$section_id)->row(); 
			$exam_scheme = $this->custom_lib->field_like('exam_schemes','classes','"'.$this->data['section_detail']->class_id.'"')->row();
			$this->data['exams'] = $this->custom_lib->get_where('exams','scheme_id',@$exam_scheme->id)->result(); 
			$this->data['subject_ids'] = json_decode($this->data['section_detail']->subjects);
			//echo '<pre>';print_r($this->data['students']);die;
			$this->load->view('staff/tabsheets/tabsheet_1',$this->data);
		}
		public function ajax_session_class(){
			$classes = $this->custom_lib->get_where('classes','session_id',$_POST['session_id'])->result();
			if (!empty ($classes)) { 
				foreach ($classes as $class) {
					echo '<option value="'.$class->name.'">'.$class->name.'</option>';
				}
			}
			else{
				echo '<option value="">'.lang('no_class_found').'</option>';
			}
			die;
		}
	}	
