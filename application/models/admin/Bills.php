<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bills extends CI_Model {
	function get_scheme_class ($scheme_id , $class_id){
		$this->db->where('scheme_id',$scheme_id);
		$this->db->where('class_id',$class_id);
		return $this->db->get('fees_rel_bill_scheme_class')->row();
	}
}