<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Myrole extends Staff_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('my_role');		
			$this->load->model(array('admin/Staffs'));
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['roles'] = $this->Staffs->get_staff_roles($this->session->userdata('user_id'));	
			//echo'<pre>';print_r($this->data['roles']);die;
			if (!empty ($this->data['roles'])){
				redirect('staff/'.$this->data['roles'][0]->controller);	
			}
			else{
				$this->template->staff_render('staff/myrole/index',$this->data);
			}
		}
	}	
