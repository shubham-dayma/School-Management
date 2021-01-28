<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


	class Student extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('students');	
			$this->load->model(array ('admin/session_student_section'));	
		}
		public function sections($section_id = ''){
			$this->breadcrumbs->unshift(1, lang('student'), 'admin/student/sections');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['classes'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			$this->data['active_tab'] = '';
			if (!empty($section_id)) {
				$this->data['students'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$section_id);
				$this->data['active_tab'] = $section_id;
			}
			else{
				if (!empty($this->data['classes'])) {
					$sections = $this->custom_lib->get_where('sections','class_id',$this->data['classes'][0]->id)->result();
					if (!empty ($sections)) {
						$this->data['students'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$sections[0]->id);
						$this->data['active_tab'] = $sections[0]->id;
					}else{
						$this->data['students'] =array();
					}
				}
				else{
					$this->data['students'] =array();
				}
			}
			//echo '<pre>';print_r(array_slice ($this->data['classes'],0,1));
			//echo '<pre>';print_r($this->data['students']);die;
			$this->template->admin_render('admin/students/index',$this->data);
		}
		public function form($id = ''){
			$this->breadcrumbs->unshift(2, lang('form'),'admin/sections/form');
			$this->data['classes'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			$this->data['countries'] = $this->custom_lib->get_all('countries')->result();
			$this->data['nationalities'] = $this->custom_lib->get_all('nationalities')->result();
			$this->data['castes'] = $this->custom_lib->get_all('castes')->result();
			$this->data['religions'] = $this->custom_lib->get_all('religions')->result();
			$this->data['categories'] = $this->custom_lib->get_all('categories')->result();
			//echo '<pre>';print_r($this->setting->country);die;
			if (empty ($id)){
				$this->data['page_sub_title'] = lang('add').' '.lang('student');
				$save['created'] = date('Y-m-d');
				$this->data['active_section'] = @$_GET['cs'];
				$this->data['states'] = $this->custom_lib->get_where('states','country_id',$this->setting->country)->result();
				$this->data['cities'] = $this->custom_lib->get_where('cities','state_id',$this->setting->state)->result();
				$this->data['titles'] = $this->custom_lib->get_where('titles','for_gender',0)->result();
				$this->breadcrumbs->unshift(1, lang('student'), 'admin/student/sections/'.$this->data['active_section']);
			}
			if (!empty ($id)){
				$this->data['page_sub_title'] = lang('edit').' '.lang('student');
				$this->data['row'] = $this->session_student_section->get_student_section_session($this->session->userdata('academic_session'),$id)->row();
				$this->data['active_section'] = $this->data['row']->section_id;
			$this->data['states'] = $this->custom_lib->get_where('states','country_id',$this->data['row']->country)->result();
				$this->data['cities'] = $this->custom_lib->get_where('cities','state_id',$this->data['row']->state)->result();
				$this->data['titles'] = $this->custom_lib->get_where('titles','for_gender',$this->data['row']->gender)->result();
				$this->breadcrumbs->unshift(1, lang('student'), 'admin/student/sections/'.$this->data['active_section']);
			}
			if ($this->input->post('submit')){

				//STUDENT DETAILS FIELD
				$this->form_validation->set_rules('class_section', 'lang:class_section', 'required');
				$this->form_validation->set_rules('fname', 'lang:fname', 'required');
				$this->form_validation->set_rules('lname', 'lang:lname', 'required');
				if (empty ($id)) {
				$this->form_validation->set_rules('s_email', 'lang:student_email', 'is_unique[students.s_email]|valid_email');
				}
				$this->form_validation->set_rules('s_mobile', 'lang:mobile_no', 'regex_match[/^[0-9]{10}$/]'); 
				$this->form_validation->set_rules('dob', 'lang:dob', 'required');
				$this->form_validation->set_rules('admit_date', 'lang:admit_date', 'required');
				$this->form_validation->set_rules('c_address', 'lang:c_address', 'required');
				$this->form_validation->set_rules('p_address', 'lang:p_address', 'required');
				$this->form_validation->set_rules('pincode', 'lang:pincode', 'numeric');

				//FATHER DETAILS
				$this->form_validation->set_rules('f_name', 'lang:father_name', 'required');
					if (empty ($id)) { 
				$this->form_validation->set_rules('f_email', 'lang:father_email', 'valid_email'); }
				$this->form_validation->set_rules('f_mobile', 'lang:mobile_no', 'required|regex_match[/^[0-9]{10}$/]');
				//MOTHER DETAILS
				$this->form_validation->set_rules('m_name', 'lang:mother_name', 'required');
					if (empty ($id)) {
				$this->form_validation->set_rules('m_email', 'lang:mother_email', 'valid_email'); }
				$this->form_validation->set_rules('m_mobile', 'lang:mobile_no', 'regex_match[/^[0-9]{10}$/]');
				//GUARDIANS DETAILS 
				$this->form_validation->set_rules('g_select', 'lang:guardian', 'required');	
				if($this->input->post('g_select') == 2 )
				{
				$this->form_validation->set_rules('g_name', 'lang:guardian_name', 'required');	
				if (empty ($id)) {
				$this->form_validation->set_rules('g_email', 'lang:guardian_email', 'valid_email'); }
				$this->form_validation->set_rules('g_mobile', 'lang:mobile_no', 'required|regex_match[/^[0-9]{10}$/]');
				}

				if ($this->form_validation->run() == TRUE){
					if (empty ($id)){
						$class_sec = explode (',',$this->input->post('class_section'));
						$save['admit_class'] = $class_sec[0];
						$save['admit_section'] = $class_sec[1]; 
						$save['session_id'] = $this->session->userdata('academic_session');
					}
					$save['id'] = $id;
					$save['f_gov_servent'] = '';
					$save['m_gov_servent'] = '';
					$save['g_gov_servent'] = '';
					$save['title'] = $this->input->post('title');
					$save['fname'] = $this->input->post('fname');
					$save['mname'] = $this->input->post('mname');
					$save['lname'] = $this->input->post('lname');
					$save['gender'] = $this->input->post('gender');
					$save['dob'] = $this->input->post('dob');
					$save['c_address'] = $this->input->post('c_address');
					$save['p_address'] = $this->input->post('p_address');
					$save['s_email'] = $this->input->post('s_email');
					$save['s_mobile'] = $this->input->post('s_mobile');
					$save['enrol_no'] = $this->input->post('enrol_no');
					$save['adhar_card_no'] = $this->input->post('adhar_card_no');
					$save['mother_tounge'] = $this->input->post('mother_tounge');
					if($this->as->auto_roll_no == 0){ 
						$save['registration_no'] = $this->input->post('registration_no');
					}
					else{
						$save['registration_no'] = $this->input->post('enrol_no');
					}
					$save['admit_date'] = $this->input->post('admit_date');
					$save['nationality'] = $this->input->post('nationality');
					$save['religion'] = $this->input->post('religion');
					$save['cast'] = $this->input->post('cast');
					$save['category'] = $this->input->post('category');
					$save['f_name'] = $this->input->post('f_name');
					$save['f_email'] = $this->input->post('f_email');
					$save['f_mobile'] = $this->input->post('f_mobile');
					$save['f_edu_qulification'] = $this->input->post('f_edu_qulification');
					$save['f_work_place'] = $this->input->post('f_work_place');

					if (!empty ($this->input->post('f_gov_servent'))){
					$save['f_gov_servent'] = $this->input->post('f_gov_servent');
					}
					$save['f_annual_income'] = $this->input->post('f_annual_income');

					$save['m_name'] = $this->input->post('m_name');
					$save['m_email'] = $this->input->post('m_email');
					$save['m_mobile'] = $this->input->post('m_mobile');
					$save['m_edu_qulification'] = $this->input->post('m_edu_qulification');
					$save['m_work_place'] = $this->input->post('m_work_place');
					if (!empty ($this->input->post('m_gov_servent'))){
						$save['m_gov_servent'] = $this->input->post('m_gov_servent');
					}
					$save['m_annual_income'] = $this->input->post('m_annual_income');

					$save['g_select'] = $this->input->post('g_select');
					
					// OTHER AS GUARDIAN
					if($save['g_select'] == 2)
					{
						$save['g_name'] = $this->input->post('g_name');
						$save['g_email'] = $this->input->post('g_email');
						$save['g_mobile'] = $this->input->post('g_mobile');
						$save['g_edu_qulification'] = $this->input->post('g_edu_qulification');
						$save['g_work_place'] = $this->input->post('g_work_place');
						if (!empty ($this->input->post('g_gov_servent'))){
							$save['g_gov_servent'] = $this->input->post('g_gov_servent');
						}
						$save['g_annual_income'] = $this->input->post('g_annual_income');
						$g_upload = $this->custom_lib->upload('students/gardian','g_img');

					}
					$save['country'] = $this->input->post('country');
					$save['state'] = $this->input->post('state');
					$save['city'] = $this->input->post('city');
					$save['pin_code'] = $this->input->post('pincode');
					$save['s_academic_status'] = 1;
					$save['s_login_status'] = 1; 
					$save['updated'] = date('Y-m-d');
					$s_upload = $this->custom_lib->upload('students/student','s_img');
					if (!empty ($s_upload['success'])){
						if (!empty ($this->data['row'])){
							if (!empty ($this->data['row']->s_img)) {
								unlink (FCPATH.'upload/students/student/'.$this->data['row']->s_img);
							}
						}
						$save['s_img'] = $s_upload['success'];
					}
					$f_upload = $this->custom_lib->upload('students/father','f_img');
					if (!empty ($f_upload['success'])){
						if (!empty ($this->data['row'])){
							if (!empty ($this->data['row']->f_img)) {
								unlink (FCPATH.'upload/students/father/'.$this->data['row']->f_img);
							}
						}
						$save['f_img'] = $f_upload['success'];
					}
					$m_upload = $this->custom_lib->upload('students/mother','m_img');
					if (!empty ($m_upload['success'])){
						if (!empty ($this->data['row'])){
							if (!empty ($this->data['row']->m_img)) {
								unlink (FCPATH.'upload/students/mother/'.$this->data['row']->m_img);
							}
						}
						$save['m_img'] = $m_upload['success'];
					}
					if (!empty ($g_upload['success'])){
						if (!empty ($this->data['row'])){
							if (!empty ($this->data['row']->g_img)) {
								unlink (FCPATH.'upload/students/gardian/'.$this->data['row']->g_img);
							}
						}
						$save['g_img'] = $g_upload['success'];
					}
						
					$sess_stu['student_id'] = $this->custom_lib->form('students' ,$save);	
					$class_sec = explode (',',$this->input->post('class_section'));
					$sess_stu['section_id'] = $class_sec[1]; 
					$sess_stu['session_id'] = $this->session->userdata('academic_session');
					if($this->as->auto_roll_no == 0){ 
						$sess_stu['roll_no'] = $this->input->post('roll_no');
					}
					$this->session_student_section->form($sess_stu);
					$siblings = $this->input->post('siblings');
					$siblings[] = $sess_stu['student_id'] ;
					foreach ($siblings as $sibling){
						$sibles = array_diff ($siblings,array($sibling));
						foreach ($sibles  as $sibl){
							$data[] = $sibl;
						}
						$add_siblings['siblings'] = json_encode($data);
						$data = '';
						$this->custom_lib->update('students','id',$sibling,$add_siblings);	
					}
					redirect ('admin/student/sections/'.$sess_stu['section_id']);
				}	
			}
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->template->admin_render('admin/students/form',$this->data);
		}

		public function delete($id){
			
		} 
		public function profile($id){
			$this->data['row'] = $this->session_student_section->get_student_section_session($this->session->userdata('academic_session'),$id)->row();
			//echo '<pre>';print_r($this->data['row']);die;
			$this->data['current_class'] = $this->custom_lib->get_where('classes','id',$this->data['row']->class_id)->row();
			$this->data['admit_class'] = $this->custom_lib->get_where('classes','id',$this->data['row']->admit_class)->row();
			$this->data['admit_section'] = $this->custom_lib->get_where('sections','id',$this->data['row']->admit_section)->row();
			$this->data['nationality'] = $this->custom_lib->get_where('nationalities','id',$this->data['row']->nationality)->row();
			$this->data['religion'] = $this->custom_lib->get_where('religions','id',$this->data['row']->religion)->row();
			$this->data['cast'] = $this->custom_lib->get_where('castes','id',$this->data['row']->cast)->row();
			$this->data['category'] = $this->custom_lib->get_where('categories','id',$this->data['row']->category)->row();
			$this->data['country'] = $this->custom_lib->get_where('countries','id',$this->data['row']->country)->row();
			$this->data['state'] = $this->custom_lib->get_where('states','id',$this->data['row']->state)->row();
			$this->data['city'] = $this->custom_lib->get_where('cities','id',$this->data['row']->city)->row();
			//echo '<pre>';print_r($this->data['row']);die;
			$this->breadcrumbs->unshift(1, lang('student'), 'admin/student/sections/'.$this->data['row']->section_id);
			$this->breadcrumbs->unshift(2, lang('view'), 'admin/sections/profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->template->admin_render('admin/students/profile',$this->data);
		}
		public function genrate_roll($section_id){
			if ($this->as->auto_roll_no == 0){
				redirect ('admin/student/sections');
			}
			$this->session_student_section->genrate_roll($this->session->userdata('academic_session'),$section_id);
			redirect ('admin/student/sections/'.$section_id);
		}
		
		function ajax_title(){
			$titles = array();
			if ($this->input->post('gender_title') == 0 ){
				$titles = $this->custom_lib->get_where('titles','for_gender',0)->result();
			}
			else {
				$titles = $this->custom_lib->get_where('titles','for_gender',1)->result();
			}
			//print_r($titles);die;
			foreach ($titles as $title){
				echo '<option value='.$title->id.'>'.ucwords ($title->name).'</option>';
			}
			die;
		}
		function ajax_get_section_student(){
			$students = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$_POST['section_id']);
			echo '<option>'.lang('select_student').'</option>';
			if (!empty ($students)) {
				foreach ($students as $student){
					echo '<option value="'.$student->id.'">'.ucwords($student->fname.' '.$student->lname).'</option>';
				}
			}
			die;
		}
	}	
