<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Staff_class extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = lang('assign_class');	
		$this->breadcrumbs->unshift(1, lang('assign_class'), 'admin/Staff_class');
		$this->load->model(array('admin/Staffs'));
	}
	public function index(){
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['classes'] = $this->Staffs->class_index();
		$this->data['staffs'] = $this->Staffs->Staff_index('2');
		//echo '<pre>';print_r($this->data['satffs']);die;
		$this->template->admin_render('admin/staff_class/index',$this->data);
	}
	public function assign_class(){
		$staff_section = explode (',',$_POST['staff_section']);
		$save['staff_id'] = $staff_section[0];
		$save['section_id'] = $staff_section[1];
		$save['session_id'] = $this->session->userdata('academic_session');
		$insert = $this->Staffs->staff_class($save);
		echo $insert;
	}
	function remove_assigned_section(){
		$this->Staffs->remove_assigned_section($_POST['section_id'],$this->session->userdata('academic_session'));
		echo '0';die;
	}
}	
