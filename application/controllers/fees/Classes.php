	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Classes extends Fees_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('classes');	
				$this->load->model(array('admin/Fees_other','admin/session_student_section'));
				$this->breadcrumbs->unshift(1, lang('classes'), 'fees/classes');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
				$this->template->fees_render('fees/classes/index',$this->data);
			}
			public function apply_scheme($section_id){
				$this->breadcrumbs->unshift(2, lang('apply').' '.lang('bill_scheme'), 'fees/apply_scheme');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$section_details = $this->custom_lib->get_where('sections','id',$section_id)->row();
				$this->data['bill_schemes'] = $this->Fees_other->get_class_scheme($section_details->class_id);
				$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$section_id);
				if (!empty ($this->input->post('submit'))){
					if (!empty($this->input->post('bill_scheme'))) {
						$groups = $this->custom_lib->get_where('fees_scheme_groups','scheme_id',$this->input->post('bill_scheme'))->result();
						if (!empty ($this->data['result'])) {
							foreach ($this->data['result'] as $student){
								if (!empty($this->input->post('student')[$student->id])){
									if (!empty ($groups)){
										foreach ($groups as $group){
											$save['group_id'] = $group->id;
											$save['student_id'] = $student->id;
											$save['bill_scheme_id'] = $this->input->post('bill_scheme');
											$save['session_id'] = $this->session->userdata('academic_session');
											$this->custom_lib->insert('fees_rel_bill_groups_student',$save);
										}
									}
								}
							}
						}
					}	
				}
				
				$this->template->fees_render('fees/classes/apply_scheme',$this->data);
			}
			public function cancel_bill($student_id){
				$student_detail = $this->session_student_section->get_student_short_data($this->session->userdata('academic_session'),$student_id);
				$this->breadcrumbs->unshift(2, lang('apply').' '.lang('bill_scheme'), 'fees/classes/apply_scheme/'.$student_detail->section_id);
				$this->breadcrumbs->unshift(3, lang('cancel_bill'), 'fees/cancel_bill');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['section_id'] = $student_detail->section_id;
				$this->data['result'] = $this->Fees_other->get_student_groups($student_id,$this->session->userdata('academic_session'));
				if (!empty ($this->input->post('submit'))){
					//echo '<pre>';print_r($_POST);die;
					if (!empty($this->data['result'])){
						foreach ($this->data['result'] as $row){
							if(!empty($this->input->post('group')[$row->group_id])){
								$this->Fees_other->delete_student_bill_group($row->group_id,$student_id,$this->session->userdata('academic_session'));
							}
						}
					}
					redirect ('fees/classes/apply_scheme/'.$student_detail->section_id);
				}
				//echo '<pre>';print_r($this->data['result']);die;
				$this->template->fees_render('fees/classes/cancel_bill',$this->data);
			}
		}	
