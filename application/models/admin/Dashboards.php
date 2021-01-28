<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends CI_Model {
	function get_session_fees_recieved($session_id){
		$this->db->where('recipt_status',0);
		$this->db->where('session_id',$session_id);
		$this->db->select('SUM(total_pay) as amount');
		return $this->db->get('fees_pay')->row();
	}
	function get_session_discount_given($session_id){
		$this->db->where('FPD.recipt_status',0);
		$this->db->where('FP.session_id',$session_id);
		$this->db->join('fees_pay FP','FP.recipt_no = FPD.recipt_no','LEFT');
		$this->db->select('SUM(discount) as amount');
		return $this->db->get('fees_pay_difference FPD')->row();
	}
	function get_dated_fees_recieved($date){
		$this->db->where('recipt_status',0);
		$this->db->where('recipt_date',$date);
		$this->db->select('SUM(total_pay) as amount');
		return $this->db->get('fees_pay')->row();
	}
	function get_between_dates_fees_recieved($start_date,$end_date){
		$this->db->where('recipt_status',0);
		$this->db->where('recipt_date >=',$start_date);
		$this->db->where('recipt_date <=',$end_date);
		$this->db->select('SUM(total_pay) as amount');
		return $this->db->get('fees_pay')->row();
	}
	function get_month_fees_recieved($month,$year){
		$this->db->where('recipt_status',0);
		$this->db->where('MONTH(recipt_date)',$month);
		$this->db->where('YEAR(recipt_date)',$year);
		$this->db->select('SUM(total_pay) as amount');
		return $this->db->get('fees_pay')->row();
	}
	function get_dated_all_recipt($session_id, $date){
		//$this->db->where('FP.recipt_status',0);
		$this->db->where('FP.recipt_date',$date);
		$this->db->where('SSS.session_id',$session_id);
		$this->db->group_by('FP.recipt_no');
		$this->db->join('students S','S.id = FP.student_id','LEFT');
		$this->db->join('sess_student_section SSS','S.id = SSS.student_id','LEFT');
		$this->db->join ('sections Se','Se.id = SSS.section_id','LEFT');
		$this->db->join('classes C','C.id = Se.class_id','Left');
		$this->db->select('SSS.roll_no,Se.name as section,C.name as class,S.id as stu_id,S.fname,S.mname,S.lname,S.f_name,S.enrol_no,FP.recipt_no,FP.total_pay,FP.recipt_date,FP.recipt_status,FP.recipt_no');
		$this->db->select('(select SUM(total_pay) from fees_pay where recipt_no = FP.recipt_no)as sum_amount');
		return $this->db->get('fees_pay FP')->result();
	}
	function get_student_count_class_wise($class_id, $gender = ''){
		if (!empty($gender)){
			if ($gender == 'M') {
				$this->db->where('S.gender',0);
			}
			else{
				$this->db->where('S.gender',1);
			}
		}
		$this->db->where('Se.class_id',$class_id);
		$this->db->join('sections Se','Se.id = SSS.section_id','LEFT');
		$this->db->join('students S','S.id = SSS.student_id','LEFT');	
		$this->db->select('COUNT(SSS.student_id) as stu_count');
		return $this->db->get('sess_student_section SSS')->row();
	}
	function new_admissions_session_wise ($session_id){
		$this->db->where('S.session_id',$session_id);
		$this->db->where('SSS.session_id',$session_id);
		$this->db->join('sess_student_section SSS','S.id = SSS.student_id','LEFT');
		$this->db->join('sections Se','Se.id = SSS.section_id','LEFT');
		$this->db->join('classes C','C.id = Se.class_id','LEFT');
		$this->db->select('S.id as stu_id , S.admit_date,S.fname,S.lname,S.mname,S.enrol_no,S.F_name,C.name as class_name,Se.name as section_name,S.session_id');
		return $this->db->get('students S')->result();
	}
}