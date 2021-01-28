	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Reports extends Fees_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model(array('admin/fees_other'));
			$this->data['page_title'] = lang('reports');	
			$this->breadcrumbs->unshift(1, lang('reports'), 'fees/reports');
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->template->fees_render('fees/reports/index',$this->data);
		}
		public function group_wise_student_fees_report(){
			$this->breadcrumbs->unshift(2, lang('group_wise_student_fees_report'), 'fees/group_wise_student_fees_report');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['schemes']  = $this->custom_lib->get_where('fees_bill_scheme','session_id',$this->session->userdata('academic_session'))->result();
			$this->data['classes']  = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			if (!empty($this->input->post('submit'))) {
				$section_id = ($_POST['section_id'] == 'ALL') ? '' : $_POST['section_id'];
				$this->data['bill_groups'] = $this->custom_lib->get_where('fees_scheme_groups','scheme_id',$_POST['scheme_id'])->result();
				$this->data['bill_students'] = $this->fees_other->get_student_scheme($this->session->userdata('academic_session'), $_POST['scheme_id'] ,$section_id); 
				//echo '<pre>';print_r($this->data['bill_groups']);die;
			}
			$this->template->fees_render('fees/reports/group_wise_student_fees_report',$this->data);
		}
		public function fast_bill_applied_student_report(){
			$this->breadcrumbs->unshift(2, lang('fast_bill_applied_student_report'), 'fees/fast_bill_applied_student_report');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['fbills'] = $this->custom_lib->get_where('fees_fast_bill','session_id',$this->session->userdata('academic_session'))->result();
			$this->data['classes']  = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			if (!empty($this->input->post('submit'))) {
				$section_id = ($_POST['section_id'] == 'ALL') ? '' : $_POST['section_id'];
				$this->data['students'] = $this->fees_other->get_fast_bill_appiled_student($this->session->userdata('academic_session'), $_POST['fbill_id'] ,$section_id);
				//echo '<pre>';print_r($this->data['students']);die;
			}	
			$this->template->fees_render('fees/reports/fast_bill_applied_report',$this->data);
		}
		function date_wise_recipt_report(){
			$this->breadcrumbs->unshift(2, lang('date_wise_recipt_report'), 'fees/date_wise_recipt_report');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			if ($this->input->post('submit')){
				$this->data['recipts'] = $this->fees_other->get_recipt_between_dates($this->session->userdata('academic_session'),$this->input->post('start_date'),$this->input->post('end_date'));
				//echo '<pre>';print_r($this->data['recipts']);die;
			}
			$this->template->fees_render('fees/reports/date_wise_recipt_report',$this->data);
		}
	}	
