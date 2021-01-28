	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Fast_bills extends Fees_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('fast_bills');	
				$this->breadcrumbs->unshift(1, lang('fast_bills'), 'fees/fast_bills');
				$this->load->model(array('admin/Fees_other','admin/session_student_section'));
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_where('fees_fast_bill','session_id',$this->session->userdata('academic_session'))->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('fast_bill');
				$this->template->fees_render('fees/fast_bills/index',$this->data);
				
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'fees/fast_bills/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('fast_bill');
					$save['creat_date'] = date('Y-m-d');
					$save['session_id'] = $this->session->userdata('academic_session');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('fast_bills');
					$this->data['row'] = $this->custom_lib->get_where('fees_fast_bill','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:name', 'required');
					$this->form_validation->set_rules('amount', 'lang:amount', 'required');
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['amount'] = $this->input->post('amount');
						$this->custom_lib->form('fees_fast_bill',$save);
						redirect ('fees/fast_bills');
					}
				}
				$this->template->fees_render('fees/fast_bills/form',$this->data);
			}

			public function delete($id){
				$result = $this->custom_lib->get_where('fess_fast_student','fast_bill_id',$id)->result();
				if (empty ($result)) {
					$this->custom_lib->delete_where('fees_fast_bill','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('fees/fast_bills');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'fees/fast_bills/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_fast_bill_student_applied');
					$this->data['back_url'] = site_url('fees/fast_bills');
					$this->template->fees_render('fees/fast_bills/delete',$this->data);
				}
				
			}
			public function classes($fbill_id){
				$this->breadcrumbs->unshift(2, lang('classes'), 'fees/fast_bills/apply/');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
				$this->template->fees_render('fees/fast_bills/classes',$this->data);
			}
			public function apply_fbill($fbill_id,$section_id){
				$this->breadcrumbs->unshift(2, lang('classes'), 'fees/fast_bills/classes/'.$fbill_id);
				$this->breadcrumbs->unshift(3, lang('apply').' '.lang('fast_bill'), 'fees/fast_bills/apply_fbill');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$section_id);
				$this->data['fbill_id'] = $fbill_id;
				$this->data['section_id'] = $section_id;
				if (!empty ($this->input->post('submit'))){
					if (!empty($this->input->post('student'))){
						foreach ($this->input->post('student') as $index =>$value){
							$save['fast_bill_id']  = $fbill_id;
							$save['student_id'] = $index;
							$save['session_id'] = $this->session->userdata('academic_session');
							$this->custom_lib->insert('fess_fast_student',$save);
						}
					}
					redirect('fees/fast_bills/classes/'.$fbill_id);
				}
				$this->template->fees_render('fees/fast_bills/apply_fbill',$this->data);
			}
			public function remove_fbill($fbill_id,$section_id,$student_id){
				$aval = $this->Fees_other->remove_student_fast_bill($fbill_id,$student_id);
				if ($aval == 1) {
					$this->breadcrumbs->unshift(2, lang('classes'), 'fees/fast_bills/classes/'.$fbill_id);
					$this->breadcrumbs->unshift(3, lang('apply').' '.lang('fast_bill'), 'fees/fast_bills/apply_fbill/'.$fbill_id.'/'.$section_id);
					$this->breadcrumbs->unshift(4, lang('cancel').' '.lang('fast_bill'),'fees/fast_bills/apply_fbill/'.$fbill_id.'/'.$section_id);
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = 'Unable to remove this bill , Payment entery found';
					$this->data['back_url'] =  site_url().'fees/fast_bills/apply_fbill/'.$fbill_id.'/'.$section_id;
					$this->template->fees_render('fees/fast_bills/delete',$this->data);
				}else{
					redirect ('fees/fast_bills/apply_fbill/'.$fbill_id.'/'.$section_id);
				}
			}
		}	
