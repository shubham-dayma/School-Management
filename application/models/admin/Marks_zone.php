<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marks_zone extends CI_Model {
	function subject_marks_criteria_form ($save){
		$crieria_aval = $this->get_subject_marks_criteria($save['session_id'],$save['class_id'],$save['subject_id'],$save['exam_id']);
		if (empty ($crieria_aval)){
			$this->db->insert('class_subject_marks_criteria',$save);
		}
		else{
			$this->db->where('session_id',$save['session_id']);
			$this->db->where('class_id',$save['class_id']);
			$this->db->where('subject_id',$save['subject_id']);
			$this->db->where('exam_id',$save['exam_id']);
			$this->db->update('class_subject_marks_criteria',$save);
		}
	}
	function get_subject_marks_criteria($session_id,$class_id,$subject_id,$exam_id){
		$this->db->where('CSMC.session_id',$session_id);
		$this->db->where('CSMC.exam_id',$exam_id);
		$this->db->where('CSMC.class_id',$class_id);
		$this->db->where('CSMC.subject_id',$subject_id);
		$this->db->join('subjects S','S.id = CSMC.subject_id','LEFT');
		$this->db->select('CSMC.* , S.name');
		return $this->db->get('class_subject_marks_criteria CSMC')->row();
	}
	function marks_entery_form($save){
		$marks_aval = $this->get_marks_entery($save['exam_id'],$save['subject_id'],$save['section_id'],$save['student_id']);
		if (!empty($marks_aval)){
			$this->db->where('exam_id',$save['exam_id']);
			$this->db->where('subject_id',$save['subject_id']);
			$this->db->where('section_id',$save['section_id']);
			$this->db->where('student_id',$save['student_id']);
			$this->db->update('enter_marks',$save);
		}else{
			$this->db->insert('enter_marks',$save);
		}
		//$this->student_marksheet($save['student_id'],$save['section_id']);
	}
	
	function get_marks_entery($exam_id,$subject_id,$section_id,$student_id){
		$this->db->where('exam_id',$exam_id);
		$this->db->where('subject_id',$subject_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('student_id',$student_id);
		return $this->db->get('enter_marks')->row();
		
	}
	function get_marks_entery_anual($subject_id,$section_id,$student_id){
		$this->db->where('subject_id',$subject_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('student_id',$student_id);
		$this->db->select ('*,SUM(marks) as optain_marks');
		return $this->db->get('enter_marks')->row();
	}
	function subject_criteria_anuual($session_id,$class_id,$subject_id){
		$this->db->where('SC.session_id',$session_id);
		$this->db->where('SC.class_id',$class_id);
		$this->db->where('SC.subject_id',$subject_id);
		$this->db->join('subjects SD','SD.id = SC.subject_id','LEFT');
		$this->db->select('SUM(SC.max_marks) as max_marks,SUM(SC.min_marks) as min_marks ,SD.id as id , SD.name,SD.subject_code ,SD.add_in_marksheet');
		return $this->db->get('class_subject_marks_criteria SC')->row();
	}
	function get_co_scolastic_marks_entery($subject_id,$section_id,$student_id){
		$this->db->where('subject_id',$subject_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('student_id',$student_id);
		return $this->db->get('enter_co_scolastic_marks')->row();
	}
	function get_marks_entery_class_wise($class_id,$subject_id){
		$this->db->where('S.class_id',$class_id);
		$this->db->where('ECM.subject_id',$subject_id);
		$this->db->join('sections S','S.id = ECM.section_id','LEFT');
		$this->db->select('ECM.*');
		return $this->db->get('enter_co_scolastic_marks ECM')->result();
	}
	function col_scolastic_marks_entery_form($save){
		$marks_aval = $this->get_co_scolastic_marks_entery($save['subject_id'],$save['section_id'],$save['student_id']);
		if (!empty($marks_aval)){
			$this->db->where('subject_id',$save['subject_id']);
			$this->db->where('section_id',$save['section_id']);
			$this->db->where('student_id',$save['student_id']);
			$this->db->update('enter_co_scolastic_marks',$save);
		}else{
			$this->db->insert('enter_co_scolastic_marks',$save);
		}
	}
	function get_marksheet($exam_scheme_id , $url){
		$this->db->where('exam_scheme_id',$exam_scheme_id);
		$this->db->where('url',$url);
		return $this->db->get('marksheets')->row();
	}
	/*-- Student Marksheet --*/
	function student_marksheet($student_id,$section_id){
		$this->load->model('admin/Other');
		$this->db->where('EM.student_id',$student_id);
		$this->db->where('EM.section_id',$section_id);
		$result = $this->db->get('enter_marks EM')->result();
		foreach ($result as $row){
			$section_detail = $this->db->get_where('sections',array('id'=> $row->section_id))->row();
			$criteries[] = $this->get_subject_marks_criteria($this->session->userdata('academic_session'),$section_detail->class_id,$row->subject_id,$row->exam_id);
			
		}
		//echo '<pre>';print_r($result);die;
		$max_marks = 0;
		$min_marks = 0;
		$per_max_marks = 0;
		$per_min_marks = 0;
		if (!empty($criteries)) {
			foreach ($criteries as $criteria) {
				$max_marks = $max_marks + $criteria->max_marks;
				$min_marks = $min_marks + $criteria->min_marks;
				$sub_details = $this->db->get_where('subjects', array('id'=>$criteria->subject_id))->row();
				if($sub_details->add_in_marksheet == 1){
					$per_max_marks = $per_max_marks + $criteria->max_marks;
					$per_min_marks = $per_min_marks + $criteria->min_marks;
				}
			}
		}
		$this->db->where('EM.student_id',$student_id);
		$this->db->where('EM.section_id',$section_id);
		$this->db->select('SUM(EM.marks)as optain_marks');
		$result = $this->db->get('enter_marks EM')->row();
		/*Optain marks to find out percentage*/
		$this->db->where('EM.student_id',$student_id);
		$this->db->where('EM.section_id',$section_id);
		$this->db->where('S.add_in_marksheet',1);
		$this->db->join('subjects S','EM.subject_id = S.id','LEFT');
		$this->db->select('SUM(EM.marks)as optain_marks');
		$per_result = $this->db->get('enter_marks EM')->row();
		//echo '<pre>';print_r($per_result->optain_marks);echo $per_max_marks;
		$marksheet ['session_id'] = $this->session->userdata('academic_session');
		$marksheet ['student_id'] = $student_id;
		$marksheet ['section_id'] = $section_id;
		$marksheet ['class_id'] = @$section_detail->class_id;
		$marksheet ['max_marks'] = $max_marks;
		$marksheet ['min_marks'] = $min_marks;
		$marksheet ['obtain_marks'] = $result->optain_marks;
		$marksheet ['per_max_marks'] = $per_max_marks;
		$marksheet ['per_min_marks'] = $per_min_marks;
		$marksheet ['pre_obtain_marks'] = $per_result->optain_marks;
		if ($marksheet ['max_marks'] != 0) {
			$marksheet ['percentage'] = ($marksheet ['pre_obtain_marks']/$marksheet ['per_max_marks'])*100;
			if (is_nan ($marksheet ['percentage'])){
				$marksheet ['percentage'] = '0';
			}
			$this->db->where('session_id',$marksheet ['session_id']);
			$this->db->where('student_id',$marksheet ['student_id']);
			$stu_marshet = $this->db->get('student_marksheet')->row();
			if (!empty ($stu_marshet)){
				$this->db->where('session_id',$marksheet ['session_id']);
				$this->db->where('student_id',$marksheet ['student_id']);
				$this->db->update('student_marksheet',$marksheet);
			}else{
				$marksheet ['serial_no'] = $this->Other->get_serial_no('marksheet');
				$this->db->insert('student_marksheet',$marksheet);
			}
		}
		$this->student_markseet_class_rank($marksheet ['session_id'],$marksheet ['class_id']);
		$this->student_markseet_section_rank($marksheet ['session_id'],$marksheet ['section_id']);
	}	
	function student_markseet_class_rank($session_id,$class_id){
		$this->db->where('session_id',$session_id);
		$this->db->where('class_id',$class_id);
		$this->db->order_by('percentage','DESC');
		$class_marks = $this->db->get('student_marksheet')->result();
		$i = 1;
		$temp = 0;
		$rank = 0;
		foreach ($class_marks as $class_mark){
			if ($temp == $class_mark->percentage)
			{
				$stu_rank = $rank;
			}
			else {
				$stu_rank = $i;
			}
			$this->db->set('class_rank', $stu_rank);
			$this->db->where('student_id',$class_mark->student_id);
			$this->db->where('class_id',$class_id);
			$this->db->where('session_id',$session_id);
			$this->db->update('student_marksheet');
			$temp = $class_mark->percentage;
			$rank = $i;
			$i++;
		}
	}
	function student_markseet_section_rank($session_id ,$section_id){
		$this->db->where('session_id',$session_id);
		$this->db->where('section_id',$section_id);
		$this->db->order_by('percentage','DESC');
		$section_marks = $this->db->get('student_marksheet')->result();
		$i = 1;
		$temp = 0;
		$rank = 0;
		foreach ($section_marks as $section_mark){
			if ($temp == $section_mark->percentage)
			{
				$stu_rank = $rank;
			}
			else {
				$stu_rank = $i;
			}
			$this->db->set('section_rank', $stu_rank);
			$this->db->where('student_id',$section_mark->student_id);
			$this->db->where('section_id',$section_id);
			$this->db->where('session_id',$session_id);
			$this->db->update('student_marksheet');
			$temp = $section_mark->percentage;
			$rank = $i;
			$i++;
		}
	}
	function get_student_markseet($session_id,$section_id,$student_id){
		$this->db->where('session_id',$session_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('student_id',$student_id);
		return $this->db->get('student_marksheet')->row();
	}
}