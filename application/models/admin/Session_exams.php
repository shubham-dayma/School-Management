<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_exams extends CI_Model {
	function class_available($scheme_id , $class_id){
		$this->db->like('classes','"'.$class_id.'"');
		$this->db->where('id !=',$scheme_id);		
		return $this->db->get('exam_schemes')->row();
		//print_r($this->db->get('exam_schemes')->row());die;
	}
	
}