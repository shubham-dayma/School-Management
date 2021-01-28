<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Model {
	function form($save){
		$this->db->where('student_id',$save['student_id']);	
		$this->db->where('session_id',$save['session_id']);		
		$aval = $this->db->get('student_attendance')->row();
		if (!empty($aval)){
			$this->db->where('student_id',$save['student_id']);	
			$this->db->where('session_id',$save['session_id']);	
			$this->db->update('student_attendance',$save);
		}else{
			$this->db->insert('student_attendance',$save);
		}
	}
	function get_attendance($session_id,$student_id){
		$this->db->where('student_id',$student_id);	
		$this->db->where('session_id',$session_id);		
		return $this->db->get('student_attendance')->row();
	}	
}