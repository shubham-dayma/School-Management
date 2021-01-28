<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Counter extends Fees_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model(array('admin/session_student_section','admin/Fees_other'));	
			$this->breadcrumbs->unshift(1, lang('fees_counter'), 'fees/counter');
			$this->data['page_title'] = lang('fees_counter');		
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['students'] = array();
			if ($this->input->post('submit')){
				$this->data['students'] = $this->session_student_section->search_student_fees($this->input->post('enrol_no'),$this->input->post('name'),$this->session->userdata('academic_session'));
			}
			$this->template->fees_render('fees/counter/index',$this->data);
		}
		public function payment($student_id){
			$this->breadcrumbs->unshift(2, lang('payment'), 'fees/counter/payment');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['student'] = $this->session_student_section->get_student_short_data($this->session->userdata('academic_session'),$student_id);
			$this->data['groups'] = $this->Fees_other->get_student_groups($student_id,$this->session->userdata('academic_session'));
			$this->data['fbills'] = $this->Fees_other->get_student_fbills($student_id,$this->session->userdata('academic_session'));
			if (!empty ($this->data['student']->siblings) &&  $this->data['student']->siblings != 'null'){
				$siblings = json_decode($this->data['student']->siblings);
				foreach ($siblings as $sibling){
					$this->data['stu_siblings'][] = $this->session_student_section->get_student_short_data($this->session->userdata('academic_session'),$sibling);
				}
			}
			if ($this->input->post('submit')){
				$recipt_no = $this->Fees_other->genrate_recipt_no();
				$heads = $this->input->post('head');
				$adjust_wallet = $this->input->post('adjust_excess');
				/*--Student Selection--*/
				if (!empty($this->input->post('student_id'))){
					foreach ($this->input->post('student_id') as $student_id){
						/*--Looking for any Fast bill--*/
						if (!empty($this->input->post('fbill')[$student_id])){
							foreach ($this->input->post('fbill')[$student_id] as $index=>$value){
								$fbill_details = $this->custom_lib->get_where('fees_fast_bill','id',$index)->row();  
								$fbill_paid = $this->Fees_other->get_paid_student_fast_bill($index,$student_id);
								$fast_due = $fbill_details->amount - $fbill_paid->amount;
								$fast_save['recipt_no'] = $recipt_no;
								$fast_save['recipt_date'] = $this->input->post('date');
								$fast_save['date'] = date('Y-m-d h:i:s');
								$fast_save['recipt_status'] = 0;
								$fast_save['student_id'] = $student_id;
								$fast_save['session_id'] = $this->session->userdata('academic_session');
								$fast_save['fast_bill_id'] = $index;
								/*--Incase paid less amount and define diff as discount then due amount will be created and discount entery will took place
									else will check for diff type..is that is "adjuct_excess" then total_due and amount entered differenace wll be calculated
									if  adjuct_excess_amount is higher than diff_amount then adjuct_excess_amount will be reduce by diff_amount 
									if  adjuct_excess_amount is equal or smaller than diff_amount then adjuct_excess_amount will be enterd as amount to db
									and adjuct_excess_amount will be 0; 
								--*/
								if ($this->input->post('diff_type')[$student_id] != 'discount'){
									if ($fast_due > $value) {
										if ($this->input->post('diff_type')[$student_id] == 'adjust_excess'){
											$fpay_diff = $fast_due - $value;
											if ($fpay_diff < $adjust_wallet[$student_id]){
													$adjust_wallet[$student_id] = $adjust_wallet[$student_id] - $fpay_diff;
													$fast_save['amount'] = $value + $fpay_diff;
												}
												else{
													$fast_save['amount'] = $value + $adjust_wallet[$student_id];
													$adjust_wallet[$student_id] = 0;
												}
										
										}
										else{
											$fast_save['amount'] = $value;
										}
									}
									else{
										$fast_save['amount'] = $value;
									}
								}
								else{
									$fast_save['amount'] = $fast_due;
								}
								$this->custom_lib->insert('fees_pay_fast_bills',$fast_save);
							}
						}
						/*--Checking for any group entery selection--*/
						if (!empty ($this->input->post('groups')[$student_id])){
							foreach ($this->input->post('groups')[$student_id] as $groups){
								/*--Query Has run to check amount for heads for individual groups--*/
								$group_heads = $this->custom_lib->get_where('fees_group_heads','group_id',$groups)->result();
								foreach ($group_heads as $group_head){
									$paid_amount = $this->Fees_other->get_paid_group_head($groups,$group_head->head_id,$student_id);
									/*--In this foreach $amount will be tread as due amount for that particular head and also for paricular group--*/
									$amount = $group_head->amount - $paid_amount->paid_head;
									$save['recipt_no'] = $recipt_no;
									$save['recipt_date'] = $this->input->post('date');
									$save['date'] = date('Y-m-d h:i:s');
									$save['recipt_status'] = 0;
									$save['student_id'] = $student_id;
									$save['group_id'] = $groups;
									$save['head_id'] = $group_head->head_id;
									/*--Checking for head amount entery for respctive group--*/
									if (isset($heads[$student_id][$group_head->head_id])) {
										if ($this->input->post('diff_type')[$student_id] != 'discount'){
											/*--if Enter amount for head is higher than respective group's head amount than enter amount will be reduce by
												respective group's head amount (as this group's head amount will be next enterd amount for respctive group's head's due_amount )
												 and due_amount for that group's head will be concider as entered amount.
												Note :- This is done for multiple selection of groups
											 --*/
											if ($heads[$student_id][$group_head->head_id] > $amount){
												$heads[$student_id][$group_head->head_id] = $heads[$student_id][$group_head->head_id] - $amount;
												$save['amount'] = $amount;
											}
											else{
												$pay_amount = $heads[$student_id][$group_head->head_id];
												/*-- if diff_type is selected as adjust_excess then due_amount and entered_amount diff will be calulated and 
													if diff_amount is lower than adjust_excess_amount then adjust_excess_amount will be reduced with diff_amount and
													diff_amount will be treated as amount to be entered in db.
													if adjust_excess_amount is lower than diff_amount then adjust_excess_amount will be treated as amount to be entered in db.
													and adjust_excess_amount will be set to 0;
												--*/
												if ($this->input->post('diff_type')[$student_id] == 'adjust_excess'){
													$head_pay_diff = $amount - $heads[$student_id][$group_head->head_id];
													if ($head_pay_diff < $adjust_wallet[$student_id]){
														$adjust_wallet[$student_id] = $adjust_wallet[$student_id] - $head_pay_diff;
														$pay_amount = $heads[$student_id][$group_head->head_id] + $head_pay_diff;
													}
													else{
														$pay_amount = $heads[$student_id][$group_head->head_id] + $adjust_wallet[$student_id];
														$adjust_wallet[$student_id] = 0;
													}
												}
												$save['amount'] = $pay_amount;
												/*--Eneterd amount is made 0 because entered amount is smaller or equal to respective group's head due_amount,
													so at its next entery respective group's head's due_amount will be 0.
												 --*/
												$heads[$student_id][$group_head->head_id] = 0;
											}
										/*--Incase diff_type is paylater or not discount--*/	
										}else{
											$save['amount'] = $amount;
										}	
										$this->custom_lib->insert('fees_pay_group_heads',$save);
									}	
								}
							}	
						}
						if (!empty($this->input->post('diff_type')[$student_id])) {
							if ($this->input->post('diff_type')[$student_id] == 'adjust_excess'){
								$save_diff ['recipt_no'] = $recipt_no;
								$save_diff ['recipt_date'] = $this->input->post('date');
								$save_diff ['student_id'] = $student_id;
								$save_diff['date'] = date('Y-m-d h:i:s');
								$save_diff['recipt_status'] = 0;
								$save_diff['excess_return'] = $this->input->post('adjust_excess')[$student_id];
								$this->custom_lib->insert('fees_pay_difference',$save_diff);
							}
							if ($this->input->post('diff_type')[$student_id] == 'discount'){
								$save_diff ['recipt_no'] = $recipt_no;
								$save_diff ['recipt_date'] = $this->input->post('date');
								$save_diff ['student_id'] = $student_id;
								$save_diff['date'] = date('Y-m-d h:i:s');
								$save_diff['recipt_status'] = 0;
								$save_diff['discount'] = abs($this->input->post('difference')[$student_id]);
								$this->custom_lib->insert('fees_pay_difference',$save_diff);
							}
						}
						if (empty($this->input->post('diff_type')[$student_id])){
							if (!empty ($this->input->post('wallet')[$student_id])){
								$save_diff ['recipt_no'] = $recipt_no;
								$save_diff ['recipt_date'] = $this->input->post('date');
								$save_diff ['student_id'] = $student_id;
								$save_diff['date'] = date('Y-m-d h:i:s');
								$save_diff['recipt_status'] = 0;
								$save_diff['excess_recieved'] = $this->input->post('wallet')[$student_id];
								$this->custom_lib->insert('fees_pay_difference',$save_diff);
							}
						}
						if (isset($this->input->post('stu_paid')[$student_id])){	
							$save_base['recipt_no'] = $recipt_no;
							$save_base['student_id'] = $student_id;
							$save_base['session_id'] = $this->session->userdata('academic_session');
							$save_base['total_pay'] = $this->input->post('stu_paid')[$student_id];
							$save_base['recipt_date']  = $this->input->post('date');
							$save_base['desc'] = $this->input->post('desc');
							$save_base['recipt_status'] = 0;
							$save_base['date'] = date('Y-m-d h:i:s');
							$this->custom_lib->insert('fees_pay',$save_base);
						}	
					}
				}
				redirect ('fees/recipt/print/'.$recipt_no);
			}
			$this->template->fees_render('fees/counter/payment',$this->data);
		}
		function ajax_sibling_window(){
			$student = $this->session_student_section->get_student_short_data($this->session->userdata('academic_session'),$_POST['sib_id']);
			$groups = $this->Fees_other->get_student_groups($_POST['sib_id'],$this->session->userdata('academic_session'));
			$fbills = $this->Fees_other->get_student_fbills($_POST['sib_id'],$this->session->userdata('academic_session'));
			if (!empty ($student->s_img)) {	
				$img = $student->s_img;
			}
			else {
				$img = ($student->gender == 0) ? 'm_002.png' : 'f_005.png';
			}
			echo '<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="box box-danger">
							<i class = "fa fa-trash remove_sib" style = "padding: 8px;"></i>
							<div class="box-header with-border">
								<div class="col-md-3">
									<img src="'.site_url('upload/users/'.$img).'" class="img-responsive" style="width:120px; height:120px;">
								</div>
								<div class="col-md-6">
									<input type="hidden" name = "student_id[]" value = "'.$student->id.'">
									<div class="row">
										<label class="col-md-5">'.lang('enrol_no').' : </label>
										<label class="col-md-6">'.ucwords($student->enrol_no).'</label>
									</div>
									<div class="row">
										<label class="col-md-5">'.lang('name').': </label>
										<label class="col-md-6">'.ucwords($student->fname).' '.$student->mname.' '.$student->lname .'</label>
									</div>
									<div class="row">
										<label class="col-md-5">'.lang('father').' '.lang('name').': </label>
										<label class="col-md-6">'.ucwords($student->f_name) .'</label>
									</div>
									<div class="row">
										<label class="col-md-5">'.lang('class').': </label>
										<label class="col-md-6">'.ucwords($student->class_name).' '.$student->section_name .'</label>
									</div>
								</div>
							</div>
							<div class="box-body stu_'.$student->id.'">';
			echo			'<div>
									<button type="button" class="btn btn-danger btn-flat pull-right pay" style="margin-bottom:8px;" value = "'.$student->id.'" >'.lang('pay').'</button>
									</div>
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th></th>
												<th>'.lang('effective_date').'</th>
												<th>'.lang('groups').'</th>
												<th>'.lang('amount').'</th>
											</tr>
										</thead>
										<tbody>';
				if (!empty($fbills)) { foreach ($fbills as $fbill) { 
					$fast_due_amount = $fbill->fbill_amount - $fbill->paid_fast_bill;
					$fast_due_amount = ($fast_due_amount == 0) ? 'Nill' : $fast_due_amount;
					$fast_checkbox = ($fast_due_amount != 'Nill') ? '<input type="checkbox" name = "fast['.$student->id.'][]" class="check flat_check fast" value="'.$fbill->fbill_id.'">' :	''; 	
				echo					 	'<tr>
												<td>'.$fast_checkbox.'</td>
												<td></td>
												<td>'.$fbill->fbill_name.'</td>
												<td>'.$fast_due_amount.'</td>
											</tr>';
				}}						
																
				if (!empty ($groups))  {foreach ($groups as $group) {
						$due_amount = $group->amount - $group->amount_recieved ;
						$due_amount = ($due_amount == 0) ? 'Nill' : $due_amount;
						$checkbox = ($due_amount != 'Nill') ? '<input type="checkbox" name = "groups['.$student->id.'][]" class="check flat_check groups" value="'.$group->id.'">' :					''; 
						echo				'<tr>
												<td>'.$checkbox.'</td>
												<td>'.$group->effective_date.'</td>
												<td>'.$group->name.'</td>
												<td>'.$due_amount.'</td>
											</tr>';
				}}							
				echo					'</tbody>
									</table>';
			 	echo 	   '</div>			
						</div>
					</div>	
					<div class="col-md-6 col-sm-6 col-xs-12 heads_'.$student->id.'">
						
					</div>			
				</div>';
		}
		public function ajax_payment_window(){
			$student_id  = $_POST['stu_id']; 
			if (!empty($_POST['groups'])) {
				$heads = $this->Fees_other->get_bulk_group_head_amounts($_POST['groups']);
			}
			$excess = $this->Fees_other->get_student_excess($_POST['stu_id']);
			$wallet_bal = $excess->recieved - $excess->withdral;
			$total_due = 0;
			//echo '<pre>';print_r();die;
			echo '<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">'.lang('wallet').': '.$wallet_bal.'</h3>
						<input type = "hidden" class="wallet_bal" value="'.$wallet_bal.'">
					</div>
					<div class="box-body">';
			if (!empty($_POST['fasts'])) { foreach ($_POST['fasts'] as $fbill){
				$fast_bill = $this->custom_lib->get_where('fees_fast_bill','id',$fbill)->row();
				$fast_paid = $this->Fees_other->get_paid_student_fast_bill($fbill,$student_id);
				$fast_due = $fast_bill->amount - $fast_paid->amount;
				$total_due = $fast_due + $total_due; 
				if ($fast_due != 0) { 
					echo '<div class="row">
								<label class="col-md-4">'.$fast_bill->name.' - '.$fast_due.'</label>
									<div class="col-md-4" >	
										<input type="number" step = "0.02" name="fbill['.$student_id.']['.$fast_bill->id.']" class="form-control head_amount"  value="'.$fast_due.'" data-value = "'.$fast_due.'"   > 
										</div>
								</div>';
				}
			}}
			if (!empty ($heads)) { foreach ($heads as $head) {
					$paid_amount = $this->Fees_other->get_paid_head($_POST['groups'],$head->head_id,$student_id);
					$head_due = $head->amount - $paid_amount->paid_head;
					$total_due = $head_due + $total_due;  
					if ($head_due != 0) { 
						echo '<div class="row">
								<label class="col-md-4">'.$head->name.' - '.$head_due.'</label>
									<div class="col-md-4" >	
										<input type="number" step = "0.02" name="head['.$student_id.']['.$head->head_id.']" class="form-control head_amount"  value="'.$head_due.'" data-value = "'.$head_due.'"   > 
										</div>
								</div>';
						}	
			}}
			echo			'<div class="row wallet">
								<label class="col-md-4">'.lang('wallet').'</label>
								<div class="col-md-4" style="margin-top:5px" >	
									<input type="number" step = 0.02  name="wallet['.$student_id.']" class="form-control wallet_amount"  value="" > 
								</div>
							</div>
							<div class="row">
								<label class="col-md-4">'.lang('total_due').'</label>
								<div class="col-md-4" style="margin-top:5px" >	
									<input type="text" disabled="disabled" name="difference" class="form-control total_due"  value="'.$total_due.'" > 
								</div>
							</div>
							<div class="row">
								<label class="col-md-4">'.lang('total_paid').'</label>
								<div class="col-md-4" style="margin-top:5px" >	
									<input type="number" step = "0.02" readonly name="stu_paid['.$student_id.']" class="form-control total_paid"  value="'.$total_due.'" > 
								</div>
							</div>
							<div class = "difference_div" >
								
							</div>		
						</div>
					</div>';
			die;
		}
		
	}	
	