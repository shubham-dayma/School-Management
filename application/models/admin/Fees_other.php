<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fees_other extends CI_Model {
	function get_group_head($group_id,$head_id){
		$this->db->where('group_id',$group_id);
		$this->db->where('head_id',$head_id);
		return $this->db->get('fees_group_heads')->row();
	}
	function get_class_scheme($class_id){
		$this->db->where('BC.class_id',$class_id);
		$this->db->join('fees_bill_scheme S','S.id = BC.scheme_id','LEFT');
		return $this->db->get('fees_rel_bill_scheme_class BC')->result();
	}
	function get_scheme_groups($scheme_id){
		$this->db->where('bill_scheme_id',$scheme_id);	
		$this->db->group_by('student_id');
		return $this->db->get('fees_rel_bill_groups_student')->result();
	}
	function get_student_scheme($session_id, $scheme_id , $section_id = ''){
		$this->db->where('BGS.session_id',$session_id);
		$this->db->where('BGS.bill_scheme_id',$scheme_id);
		if (!empty ($section_id)){
			$this->db->where('SSS.section_id',$section_id);
			$this->db->order_by('SSS.roll_no','ASC');
		}
		$this->db->join('students S','S.id = BGS.student_id','LEFT');
		$this->db->join('sess_student_section SSS','S.id = SSS.student_id','LEFT');
		$this->db->group_by('BGS.student_id');
		$this->db->select('S.fname,S.mname,S.lname,S.enrol_no,S.id as stu_id,BGS.bill_scheme_id');
		return $this->db->get('fees_rel_bill_groups_student BGS')->result();
	}
	function get_student_groups($student_id,$session_id){
		$this->db->where('BGS.session_id',$session_id);
		$this->db->where('BGS.student_id',$student_id);
		$this->db->join('fees_scheme_groups SG','SG.id = BGS.group_id','LEFT');
		$this->db->select('(select SUM(PH.amount) from fees_pay_group_heads PH where PH.student_id = BGS.student_id AND PH.group_id = BGS.group_id AND PH.recipt_status = 0 ) as amount_recieved,SG.*,BGS.*,BGS.group_id as id');
		return $this->db->get('fees_rel_bill_groups_student BGS')->result();
	}
	function report_get_student_group_paid($stu_id,$group_id){
		$this->db->where('FPGH.recipt_status',0);
		$this->db->where('FPGH.student_id',$stu_id);
		$this->db->where('FPGH.group_id',$group_id);
		$this->db->join('fees_pay_difference FPD','FPD.recipt_no = FPGH.recipt_no','LEFT');
		$this->db->select('SUM(FPGH.amount) as cansol_amount,SUM(FPD.discount) as discount');
		$result = $this->db->get('fees_pay_group_heads FPGH')->row();
		return $result;
	}
	function cansol_student_differnece($session_id,$stu_id){
		$this->db->where('FP.recipt_status',0);
		$this->db->where('FP.session_id',$session_id);
		$this->db->where('FPD.student_id',$stu_id);
		$this->db->join('fees_pay FP','FP.recipt_no = FPD.recipt_no','LEFT');
		$this->db->select('SUM(FPD.discount) as net_discount , SUM(FPD.excess_recieved) as net_excess_recieved, SUM(FPD.excess_return) as net_excess_return');
		$result = $this->db->get('fees_pay_difference FPD')->row();
		//echo '<pre>';print_r($result);die;
		return $result;
	}
	function delete_student_bill_group($group_id,$student_id,$session_id){
		$this->db->where('session_id',$session_id);
		$this->db->where('student_id',$student_id);
		$this->db->where('group_id',$group_id);
		$this->db->delete('fees_rel_bill_groups_student');
	}
	function get_student_fast_bill($fbill_id,$student_id,$session_id){
		$this->db->where('fast_bill_id',$fbill_id);
		$this->db->where('student_id',$student_id);
		$this->db->where('session_id',$session_id);
		return $this->db->get('fess_fast_student')->row();
	}
	function get_student_fbills($student_id,$session_id){
		$this->db->where('FBS.student_id',$student_id);
		$this->db->where('FBS.session_id',$session_id);
		$this->db->join('fees_fast_bill FB','FB.id = FBS.fast_bill_id','LEFT');
		$this->db->select('FB.name as fbill_name,FB.amount as fbill_amount,FB.id as fbill_id');
		$this->db->select('(select SUM(amount) from fees_pay_fast_bills where student_id = FBS.student_id AND fast_bill_id = FBS.fast_bill_id AND recipt_status = 0 ) as paid_fast_bill');
		return $this->db->get('fess_fast_student FBS')->result();
	}
	function remove_student_fast_bill($fbill_id,$student_id){
		$this->db->where('student_id',$student_id);
		$this->db->where('fast_bill_id',$fbill_id);
		$aval = $this->db->get('fees_pay_fast_bills')->result();
		if (empty($aval)) {
			$this->db->where('fast_bill_id',$fbill_id);
			$this->db->where('student_id',$student_id);
			$this->db->delete('fess_fast_student');
			return 0;
		}
		else{
			return 1;
		}
	}
	function get_paid_student_fast_bill($fbill_id,$student_id){
		$this->db->where('recipt_status',0);
		$this->db->where('fast_bill_id',$fbill_id);
		$this->db->where('student_id',$student_id);
		$this->db->select('Sum(amount) as amount');
		return $this->db->get('fees_pay_fast_bills')->row();
	}
	function get_bulk_group_head_amounts ($groups){
		$this->db->where_in('FGH.group_id',$groups);
		$this->db->join('fees_heads H','FGH.head_id = H.id','LEFT');
		$this->db->group_by('FGH.head_id');
		$this->db->select('FGH.head_id,SUM(FGH.amount) as amount,H.name');
		return $this->db->get('fees_group_heads FGH')->result();
	}
	function get_paid_student_groups($stu_id,$group_id){
		$this->db->where('student_id',$stu_id);
		$this->db->where('group_id',$group_id);
		return $this->db->get('fees_pay_group_heads')->result();
	}
	function get_paid_head($groups,$head_id,$stu_id){
		$this->db->where_in('PH.group_id',$groups);
		$this->db->where('PH.student_id',$stu_id);
		$this->db->where('PH.head_id',$head_id);
		$this->db->where('PH.recipt_status',0);
		$this->db->select('SUM(PH.amount) as paid_head');
		return $this->db->get('fees_pay_group_heads PH')->row();	
	}
	function get_paid_group_head($group_id,$head_id,$student_id){
		$this->db->where('PH.group_id',$group_id);
		$this->db->where('PH.student_id',$student_id);
		$this->db->where('PH.head_id',$head_id);
		$this->db->where('PH.recipt_status',0);
		$this->db->select('SUM(PH.amount) as paid_head');
		return $this->db->get('fees_pay_group_heads PH')->row();
	}
	function get_student_excess($stu_id){
		$this->db->where('student_id',$stu_id);
		$this->db->where('student_id',$stu_id);
		$this->db->where('recipt_status',0);
		$this->db->select('Sum(excess_recieved) as recieved, Sum(excess_return) as withdral');
		return $this->db->get('fees_pay_difference')->row();
	}
	function search_recipt($recipt_no = '',$enrol_no = '',$fname = ''){
		if (!empty($recipt_no)){
			$this->db->where('FP.recipt_no',$recipt_no);
		}
		if (!empty($enrol_no)){
			$this->db->where('S.enrol_no',$enrol_no);
		}
		if (!empty($fname)){
			$this->db->like('S.fname',$fname);
		}	
		$this->db->order_by('FP.date','DESC');
		$this->db->group_by('recipt_no');
		$this->db->select('S.fname,S.mname,S.lname,S.f_name,FP.recipt_no,S.f_name,FP.recipt_date,S.enrol_no');
		$this->db->join('students S','S.id = FP.student_id','LEFT');
		return $this->db->get('fees_pay FP')->result();
	}
	function print_recipt_head_details($recipt_no){
		$this->db->where('PH.recipt_no',$recipt_no);
		$this->db->join('students S','PH.student_id = S.id','LEFT');
		$this->db->join('fees_heads H','PH.head_id = H.id','LEFT');
		$this->db->join('fees_scheme_groups G','G.id = PH.group_id','LEFT');
		
		$this->db->select('(select name from classes where id = (select class_id from sections where id =(select section_id from sess_student_section where session_id = (select FP.session_id from fees_pay FP where FP.recipt_no = PH.recipt_no and FP.student_id = PH.student_id) AND student_id = S.id))) as class_name');
		
		$this->db->select('G.name as group_name,PH.amount,PH.student_id as student_id,PH.head_id as head_id,S.fname,S.mname,S.lname,H.name as head_name');
		return $this->db->get('fees_pay_group_heads PH')->result();
	}
	function print_recipt_difference($recipt_no){
		$this->db->where('recipt_no',$recipt_no);
		$this->db->select('SUM(excess_recieved) as excess_recieved,SUM(excess_return) as excess_return,SUM(discount) as discount');
		return $this->db->get('fees_pay_difference')->row();
	}
	function print_recipt_base($recipt_no){
		$this->db->where('FP.recipt_no',$recipt_no);
		$this->db->group_by('FP.recipt_no');
		$this->db->join('students S','S.id = FP.student_id','LEFT');
		$this->db->select('SUM(FP.total_pay) as total_pay,FP.recipt_date,FP.desc,FP.recipt_status,FP.recipt_no,S.f_name,S.lname');
		return $this->db->get('fees_pay FP')->row();
	}
	function print_recipt_fast_bill ($recipt_no){
		$this->db->where('FPFB.recipt_no',$recipt_no);
		$this->db->join('students S','FPFB.student_id = S.id','LEFT');
		$this->db->join('fees_fast_bill FFB','FFB.id = FPFB.fast_bill_id','LEFT');
		$this->db->select('(select name from classes where id = (select class_id from sections where id =(select section_id from sess_student_section where session_id = (select FP.session_id from fees_pay FP where FP.recipt_no = FPFB.recipt_no and FP.student_id = FPFB.student_id) AND student_id = S.id))) as class_name');
		$this->db->select('FPFB.amount as paid_amount , FFB.name as fbill_name,S.fname,S.mname,S.lname,S.id as student_id');
		return $this->db->get('fees_pay_fast_bills FPFB')->result();
	}
	function cancel_recipt($recipt_no){
		$save['recipt_status'] = 1;
		$this->db->where('recipt_no',$recipt_no);
		$this->db->update('fees_pay_difference',$save);
		$this->db->where('recipt_no',$recipt_no);
		$this->db->update('fees_pay',$save);
		$this->db->where('recipt_no',$recipt_no);
		$this->db->update('fees_pay_group_heads',$save);
		$this->db->where('recipt_no',$recipt_no);
		$this->db->update('fees_pay_fast_bills',$save);
	}
	function genrate_recipt_no(){
		$rpt = $this->db->get('fees_pay')->result();	
		if (empty ($rpt)) {
			return 1;
		}
		$last_serial = end($rpt)->recipt_no;
		$new_serial = $last_serial + 1;
		labeltc:
		$this->db->where('recipt_no',$new_serial);
		$aval = $this->db->get('fees_pay')->row();
		if (!empty ($aval)){
			$new_serial = $new_serial + 1;
			goto labeltc;
		}
		else{
			return $new_serial;
		}
	}
	function get_fast_bill_appiled_student($session_id,$fbill_id,$section_id){
		$this->db->where('SSS.session_id',$session_id);
		if (!empty($section_id)){
			$this->db->where('SSS.section_id',$section_id);
		}
		$this->db->where('FFS.fast_bill_id',$fbill_id);
		$this->db->join('students S','S.id = FFS.student_id','LEFT');
		$this->db->join('sess_student_section SSS','S.id = SSS.student_id','LEFT');
		$this->db->join ('sections Se','Se.id = SSS.section_id','LEFT');
		$this->db->join('classes C','C.id = Se.class_id','Left');
		$this->db->select('SSS.roll_no,Se.name as section,C.name as class,S.id as stu_id,S.fname,S.mname,S.lname,S.f_name,S.enrol_no');
		$this->db->select('(select SUM(amount) from fees_pay_fast_bills where student_id = S.id AND fast_bill_id = '.$fbill_id.' AND session_id = '.$session_id.' AND recipt_status = 0) as payment_recieved ');
		return $this->db->get('fess_fast_student FFS')->result();
	}
	function get_recipt_between_dates($session_id,$start_date,$end_date){
		$this->db->where('FP.recipt_status',0);
		$this->db->where('FP.recipt_date >=',$start_date);
		$this->db->where('FP.recipt_date <=',$end_date);
		$this->db->where('SSS.session_id',$session_id);
		$this->db->order_by('FP.recipt_date');
		$this->db->join('students S','S.id = FP.student_id','LEFT');
		$this->db->join('sess_student_section SSS','S.id = SSS.student_id','LEFT');
		$this->db->join ('sections Se','Se.id = SSS.section_id','LEFT');
		$this->db->join('classes C','C.id = Se.class_id','Left');
		$this->db->select('SSS.roll_no,Se.name as section,C.name as class,S.id as stu_id,S.fname,S.mname,S.lname,S.f_name,S.enrol_no,FP.recipt_no,FP.total_pay,FP.recipt_date');
		return $this->db->get('fees_pay FP')->result();
	
	}
}