<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends CI_Model {
	function get_serial_no ($type){
		if ($type == 'tc') {
			$tcs = $this->db->get('tc_issued')->result();	
			if (empty ($tcs)) {
				return 1;
			}
			$last_serial = end($tcs)->serial_no;
			$new_serial = $last_serial + 1;
			labeltc:
			$this->db->where('serial_no',$new_serial);
			$aval = $this->db->get('tc_issued')->row();
			if (!empty ($aval)){
				$new_serial = $new_serial + 1;
				goto labeltc;
			}
			else{
				return $new_serial;
			}
		}
		if ($type == 'cc') {
			$tcs = $this->db->get('cc_issued')->result();	
			if (empty ($tcs)) {
				return 1;
			}
			$last_serial = end($tcs)->serial_no;
			$new_serial = $last_serial + 1;
			labelcc:
			$this->db->where('serial_no',$new_serial);
			$aval = $this->db->get('cc_issued')->row();
			if (!empty ($aval)){
				$new_serial = $new_serial + 1;
				goto labelcc;
			}
			else{
				return $new_serial;
			}
		}
		if ($type == 'marksheet') {
			$tcs = $this->db->get('student_marksheet')->result();	
			if (empty ($tcs)) {
				return 1;
			}
			$last_serial = end($tcs)->serial_no;
			$new_serial = $last_serial + 1;
			labelms:
			$this->db->where('serial_no',$new_serial);
			$aval = $this->db->get('student_marksheet')->row();
			if (!empty ($aval)){
				$new_serial = $new_serial + 1;
				goto labelms;
			}
			else{
				return $new_serial;
			}
		}
	}
	function remark_form($save){
		$this->db->where('student_id',$save['student_id']);	
		$this->db->where('session_id',$save['session_id']);		
		$aval = $this->db->get('student_remarks')->row();
		if (!empty($aval)){
			$this->db->where('student_id',$save['student_id']);	
			$this->db->where('session_id',$save['session_id']);	
			$this->db->update('student_remarks',$save);
		}else{
			$this->db->insert('student_remarks',$save);
		}
	}
	function get_remark($session_id,$student_id){
		$this->db->where('student_id',$student_id);	
		$this->db->where('session_id',$session_id);		
		return $this->db->get('student_remarks')->row();
	}	
	
}