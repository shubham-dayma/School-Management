<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Recipt extends Fees_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('search').' '.lang('recipt');	
			$this->load->model(array('admin/Fees_other'));	
			$this->breadcrumbs->unshift(1,lang('search').' '.lang('recipt'), 'fees/counter/index');
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['students'] = array();
			if ($this->input->post('submit')){
				$this->data['students'] = $this->Fees_other->search_recipt($this->input->post('recipt_no'),$this->input->post('enrol_no'),$this->input->post('name'),$this->session->userdata('academic_session'));
				
			}
			$this->template->fees_render('fees/recipt/index',$this->data);
		}
		public function print($recipt_no){
			$this->data['page_sub_title'] = lang('print').' '.lang('recipt');
			$this->breadcrumbs->unshift(2,lang('print').' '.lang('recipt'), 'fees/counter/index');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['head_details'] = $this->Fees_other->print_recipt_head_details($recipt_no); 
			$this->data['difference_details'] = $this->Fees_other->print_recipt_difference($recipt_no);
			$this->data['fast_bills'] = $this->Fees_other->print_recipt_fast_bill($recipt_no);
			$this->data['base_details'] = $this->Fees_other->print_recipt_base($recipt_no);
			//echo '<pre>';print_r($this->data['fast_bills']);die;
			$this->template->fees_render('fees/recipt/print',$this->data);
		}
		public function cancel($recipt_no){
			$this->Fees_other->cancel_recipt($recipt_no);
			redirect('fees/recipt/print/'.$recipt_no);
		}
	}	
