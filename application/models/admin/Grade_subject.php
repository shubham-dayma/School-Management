<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grade_subject extends CI_Model {
	function get_subject_on_class($class_id , $subject_id){
		$this->db->like('subjects','"'.$subject_id.'"');
		$this->db->where('class_id',$class_id);		
		return $this->db->get('rel_class_co_scolastic_subjects')->row();
		//print_r($this->db->get('exam_schemes')->row());die;
	}
		
}