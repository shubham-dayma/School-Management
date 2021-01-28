<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_student_section extends CI_Model {

	function form($save){
		$this->db->where('session_id',$save['session_id']);
		$this->db->where('student_id',$save['student_id']);
		$record = $this->db->get('sess_student_section')->row();
		if (!empty ($record)){
			$this->db->where('session_id',$save['session_id']);
			$this->db->where('student_id',$save['student_id']);
			$this->db->update('sess_student_section',$save);
			return $record->id;
		}
		else{
			$this->db->insert('sess_student_section',$save);
			return $this->db->insert_id();
		}
	}
	function get_student_section_session($session_id,$student_id = '',$section_id = ''){
		if (!empty ($student_id)){
			$this->db->where('SSS.student_id',$student_id);
		}
		if (!empty ($section_id)){
			$this->db->where('SSS.section_id',$section_id);
		}
		$this->db->join('students S','S.id = SSS.student_id' , 'LEFT');
		$this->db->join('sections Se','Se.id = SSS.section_id' , 'LEFT');
		$this->db->select('S.*,SSS.*,Se.class_id as class_id,Se.name as section_name,Se.id as section_id,S.id as id');
		$this->db->where('SSS.session_id',$session_id);
		return $this->db->get('sess_student_section SSS');
	}
	function get_student_short_data($session_id,$student_id){
		$this->db->where('SSS.student_id',$student_id);
		$this->db->join('students S','S.id = SSS.student_id' , 'LEFT');
		$this->db->join('sections Se','Se.id = SSS.section_id' , 'LEFT');
		$this->db->join('classes CL','Se.class_id = CL.id' , 'LEFT');
		$this->db->select('S.fname,S.mname,S.lname,Se.class_id as class_id,Se.name as section_name,Se.id as section_id,S.id as id ,S.enrol_no,S.s_img,S.siblings,S.gender,CL.name as class_name ,S.f_name');
		$this->db->where('SSS.session_id',$session_id);
		return $this->db->get('sess_student_section SSS')->row();
	}
	function get_student_section_session_index($session_id,$section_id){
		$this->db->order_by('SSS.roll_no');
		$this->db->where('SSS.section_id',$section_id);
		$this->db->join('students S','S.id = SSS.student_id' , 'LEFT');
		$this->db->join('sections Se','Se.id = SSS.section_id' , 'LEFT');
		$this->db->where('SSS.session_id',$session_id);
		$this->db->select('S.enrol_no,S.fname,S.lname,S.f_name,SSS.roll_no,S.id,Se.class_id,S.s_academic_status as academic_status');
		return $this->db->get('sess_student_section SSS')->result();
	}
	function get_enrol_no(){
		$students = $this->db->get('students')->result();
		if (empty ($students)){
			return $this->as->enrol_no_prefix.'1';
		}
		$last_student  = end($students)->enrol_no;
		preg_match_all('!\d+!', $last_student, $matches);
		$incre = $matches[0][0] + 1;
		$enrol_gen = $this->as->enrol_no_prefix.$incre;
		label:
		$this->db->where('enrol_no',$enrol_gen);
		$student_access = $this->db->get('students')->row();
		if (!empty ($student_access)){
			preg_match_all('!\d+!', $enrol_gen, $matches);
			$incre = $matches[0][0] + 1;
			$enrol_gen = $this->as->enrol_no_prefix.$incre;
			goto label;
		}
		else{
			return $enrol_gen;
		}
	}
	function dynamic_columns($session_id,$rows , $section_id){
		$this->db->where('SSS.session_id',$session_id);
		$this->db->where('S.s_academic_status',1);
		$this->db->order_by('SSS.roll_no','ASC');
		if (!empty ($section_id)) {
			$this->db->where('SSS.section_id',$section_id);
		}
		$this->db->join('students S','S.id = SSS.student_id' , 'LEFT');
		$this->db->join('nationalities N','N.id = S.nationality' , 'LEFT');
		$this->db->join('religions R','R.id = S.religion' , 'LEFT');
		$this->db->join('castes C','C.id = S.cast' , 'LEFT');
		$this->db->join('categories CAT','CAT.id = S.category' , 'LEFT');
		$this->db->join('titles T','T.id = S.title' , 'LEFT');
		$this->db->join('countries CONT','CONT.id = S.country' , 'LEFT');
		$this->db->join('states STATE','STATE.id = S.state' , 'LEFT');
		$this->db->join('cities CITY','CITY.id = S.city' , 'LEFT');
		$this->db->join('sections CS','CS.id = SSS.section_id' , 'LEFT');
		$this->db->join('classes CC','CC.id = CS.class_id' , 'LEFT');
		$this->db->join('sections AS','AS.id = S.admit_section' , 'LEFT');
		$this->db->join('classes AC','AC.id = S.admit_class' , 'LEFT');
		foreach ($rows as $row) {
			$this->db->select($row);
		}
		return $this->db->get('sess_student_section SSS')->result();	
		//echo '<pre>';print_r($this->db->get('sess_student_section SSS')->result());die;
	}
	function genrate_roll($session_id , $section_id){
		//echo '<pre>';print_r($this->as->auto_roll_criteria);die;
		$this->db->where('SSS.section_id',$section_id);
		$this->db->join('students S','S.id = SSS.student_id' , 'LEFT');
		$this->db->join('sections Se','Se.id = SSS.section_id' , 'LEFT');
		$this->db->where('SSS.session_id',$session_id);
		$this->db->where('S.s_academic_status',1);
		if ($this->as->auto_roll_criteria == 1){
			$this->db->order_by('S.fname');
		}
		if ($this->as->auto_roll_criteria == 2){
			$this->db->order_by('S.lname');
		}
		if ($this->as->auto_roll_criteria == 3){
			$this->db->order_by('S.admit_date');
		}
		$this->db->select('S.id,S.enrol_no,S.fname,S.lname,S.admit_date');
		$students = $this->db->get('sess_student_section SSS')->result();
		//echo '<pre>';print_r($students);die;
		$i = 0;
		foreach ($students as $student){
			$i++;
			$this->db->set('roll_no', $i);
			$this->db->where('student_id', $student->id);
			$this->db->where('session_id',$session_id);
			$this->db->where('section_id',$section_id);
			$this->db->update('sess_student_section');
		}
		//echo '<pre>';print_r($students);die;
	}
	function search_student($enrol_no = '', $student_name = '', $section_id = ''){
		if (!empty ($enrol_no)) {
			$this->db->where('S.enrol_no',$enrol_no);
		}
		if (!empty ($student_name)) {
			$this->db->like('S.fname',$student_name);
		}
		if (!empty ($section_id)){
			$this->db->where('SSS.section_id',$section_id);
		}
		$this->db->join('sess_student_section SSS','SSS.student_id = S.id','Left');
		$this->db->select('S.id,S.fname,S.mname,S.lname,SSS.section_id,S.enrol_no,S.f_name,S.m_name,S.s_img,S.dob');
		return $this->db->get('students S')->result();
	}
	function search_student_fees($enrol_no = '', $student_name = '', $session_id){
		if (!empty ($enrol_no)) {
			$this->db->where('S.enrol_no',$enrol_no);
		}
		if (!empty ($student_name)) {
			$this->db->like('S.fname',$student_name);
		}
		$this->db->where('SSS.session_id',$session_id);
		$this->db->join('sess_student_section SSS','SSS.student_id = S.id','Left');
		$this->db->select('S.id,S.fname,S.mname,S.lname,SSS.section_id,S.enrol_no,S.f_name,S.m_name,S.s_img,S.dob');
		return $this->db->get('students S')->result();
	}
	function get_non_promoted_student($current_session , $new_session , $section_id){
		$student_in_current_sessions = $this->get_student_section_session_index( $current_session, $section_id);
		//echo '<pre>';print_r($student_in_current_sessions);die;
		$students = array();
		if (!empty ($student_in_current_sessions)) {
			foreach ($student_in_current_sessions as $student_in_current_session){
				$this->db->where('session_id',$new_session);
				$this->db->where('student_id',$student_in_current_session->id);
				$record = $this->db->get('sess_student_section')->row();	
				if (empty ($record)){
					$students[] = $student_in_current_session;  
				}
			}
		}
 		return $students;
	}
}