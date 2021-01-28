<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Staff_role extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = lang('role_managment');	
		$this->breadcrumbs->unshift(1, lang('role_managment'), 'admin/Staff_role');
		$this->load->model(array('admin/Staffs'));
	}
	public function index($rol_id){
		if (!empty ($this->input->get('staff_cat'))){
			$this->data['staffs'] = $this->Staffs->staff_index($this->input->get('staff_cat'));
			$this->data['a_staff_cat'] =  $this->input->get('staff_cat');
		}
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['roles'] = $this->custom_lib->get_all('role_managment')->result();
		$this->data['staff_categories'] = $this->custom_lib->get_all('staff_category')->result();
		$this->data['staff_roles'] = $this->custom_lib->get_where('rel_staff_role','role_id',$rol_id)->result();
		//print_r($this->data['staff_roles']);die;
		$this->template->admin_render('admin/staff_role/index',$this->data);
	}
	function remove_staff_role(){
		//print_r($_POST);die;
		$this->Staffs->remove_staff_role($_POST['staff_id'],$_POST['role_id']);
	}
	function add_staff_role(){
		//print_r($_POST['staff_id']);die;
		if (!empty ($_POST['staff_id'])) {
			$save['role_id'] = $_POST['role_id'];	
			$save['staff_id'] = $_POST['staff_id'];
			//print_r($save);die;
			$this->custom_lib->insert('rel_staff_role',$save);
		}
	}
}	
