<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffs extends CI_Model {
	function class_index(){
		$this->db->where('session_id',$this->session->userdata('academic_session'));	
		$this->db->select('id,name');
		return $this->db->get('classes')->result();
	}
	function staff_index($cat_id = ''){
		if (!empty($cat_id)){
			$this->db->where('staff_category',$cat_id);	
		}
		$this->db->select('id,fname,lname');
		return $this->db->get('staff')->result();
	}
	function remove_staff_role($staff_id , $role_id){
		$this->db->where('staff_id',$staff_id);	
		$this->db->where('role_id',$role_id);		
		return $this->db->delete('rel_staff_role');
	}
	function staff_class($save){
		$assigned = $this->get_staff_class($save['staff_id'],$save['session_id']);
		if (empty($assigned)){
			$this->db->where('section_id',$save['section_id']);	
			$this->db->where('session_id',$save['session_id']);	
			$class_assigned = $this->db->get('rel_staff_class')->row();
			if (empty ($class_assigned)) {
				$this->db->insert('rel_staff_class',$save);
			}
			else{
				$this->db->where('section_id',$save['section_id']);	
				$this->db->where('session_id',$save['session_id']);
				$this->db->update('rel_staff_class',$save);
			}
			return 1;
		}
		else{
			return 0;
		}
	}
	function get_staff_class($staff_id,$session_id){
		$this->db->where('staff_id',$staff_id);	
		$this->db->where('session_id',$session_id);	
		return $this->db->get('rel_staff_class')->row();
	}
	function remove_assigned_section($section_id , $session_id){
		$this->db->where('section_id',$section_id);	
		$this->db->where('session_id',$session_id);	
		return $this->db->delete('rel_staff_class');
	}
	function get_staff_roles($staff_id){
		$this->db->where('SC.staff_id',$staff_id);	
		$this->db->join('role_managment R','R.id = SC.role_id','LEFT');
		$this->db->select('R.*');
		return $this->db->get('rel_staff_role SC')->result();
	}
	function staff_role($role_id , $staff_id){
		$this->db->where('staff_id',$staff_id);
		$this->db->where('role_id',$role_id);
		return $this->db->get('rel_staff_role')->row();
	}
}