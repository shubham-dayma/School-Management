	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Bill_scheme extends Fees_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('bill_schemes');	
				$this->load->model(array ('admin/Bills','admin/Fees_other'));
				$this->breadcrumbs->unshift(1, lang('bill_schemes'), 'fees/bill_scheme');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_where('fees_bill_scheme','session_id',$this->session->userdata('academic_session'))->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('bill_scheme');
				$this->template->fees_render('fees/bill_scheme/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'fees/bill_scheme/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['classes'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('bill_scheme');
					$save['creat_date'] = date('Y-m-d');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('bill_scheme');
					$this->data['row'] = $this->custom_lib->get_where('fees_bill_scheme','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:name', 'required');
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['session_id'] = $this->session->userdata('academic_session');
						$save['desc'] = $this->input->post('desc');
						$scheme_id	= $this->custom_lib->form('fees_bill_scheme',$save);
						$this->custom_lib->delete_where('fees_rel_bill_scheme_class','scheme_id',$scheme_id);
						if (!empty ($this->input->post('classes'))) {
							foreach ($this->input->post('classes') as $class){
								$rel['scheme_id'] = $scheme_id;
								$rel['class_id'] = $class;
								$this->custom_lib->insert('fees_rel_bill_scheme_class',$rel);
							}
						}
						redirect ('fees/bill_scheme');
					}
				}
				$this->template->fees_render('fees/bill_scheme/form',$this->data);
			}

			public function delete($id){
				$row = $this->custom_lib->get_where ('fees_scheme_groups','scheme_id',$id)->result();
				if (empty ($row)) {
					$this->custom_lib->delete_where('fees_bill_scheme','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('fees/bill_scheme');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'fees/bill_scheme/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_groups_exist_error');
					$this->data['back_url'] = site_url('fees/bill_scheme');
					$this->template->fees_render('fees/bill_scheme/delete',$this->data);
				}
				
			}
			public function profile($id){
				$this->breadcrumbs->unshift(2, lang('view'), 'fees/bill_scheme/profile');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['row'] = $this->custom_lib->get_where('fees_bill_scheme','id',$id)->row();
				$this->template->fees_render('fees/bill_scheme/profile',$this->data);
			}
			public function groups($scheme_id){
				$this->breadcrumbs->unshift(2, lang('groups'), 'fees/bill_scheme/groups/'.$scheme_id);
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('group');
				$this->data['result'] = $this->custom_lib->get_where('fees_scheme_groups','scheme_id',$scheme_id)->result();
				$this->data['scheme_id'] = $scheme_id;
				$this->template->fees_render('fees/bill_scheme/groups',$this->data);
			}
			public function add_group($scheme_id,$id = ''){
				$this->data['page_title'] = lang('groups');	
				$this->breadcrumbs->unshift(2, lang('groups'), 'fees/bill_scheme/groups/'.$scheme_id);
				$this->breadcrumbs->unshift(3, lang('add').' '.lang('groups'), 'fees/bill_scheme/add_group');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['scheme_id'] = $scheme_id;
				$this->data['heads'] = $this->custom_lib->get_all('fees_heads')->result();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('group');
					$save['creat_date'] = date('Y-m-d');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('group');
					$this->data['row'] = $this->custom_lib->get_where('fees_scheme_groups','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:name', 'required');
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['scheme_id'] = $scheme_id;
						$save['amount'] = array_sum($_POST['head_amount']);
						$save['name'] = $this->input->post('name');
						$save['effective_date'] = $this->input->post('effective_date');
						$group_id = $this->custom_lib->form('fees_scheme_groups',$save);
						$this->custom_lib->delete_where('fees_group_heads','group_id',$group_id);
						if (!empty ($this->data['heads'])) {
							foreach ($this->data['heads'] as $head){
								if (!empty($this->input->post('head_amount')[$head->id])) {
									$rel['group_id'] = $group_id;
									$rel['head_id'] = $head->id;
									$rel['amount'] = $this->input->post('head_amount')[$head->id];
									$this->db->insert('fees_group_heads',$rel);
								}
							}
						}
						if (empty($id)){
							$students_scheme = $this->Fees_other->get_scheme_groups($scheme_id);
							if (!empty ($students_scheme)) {
								foreach ($students_scheme as $student){
									$stu_group['group_id'] = $group_id;
									$stu_group['student_id'] = $student->student_id;
									$stu_group['bill_scheme_id'] = $scheme_id;
									$stu_group['session_id'] = $student->session_id;
									$this->custom_lib->insert('fees_rel_bill_groups_student',$stu_group);
								}	
							}
						}
						redirect ('fees/bill_scheme/groups/'.$scheme_id);
					}
				}	
				$this->template->fees_render('fees/bill_scheme/add_group',$this->data);
			}
			public function group_delete($scheme_id,$group_id){
				$row = $this->custom_lib->get_where ('fees_rel_bill_groups_student','group_id',$group_id)->result();
				if (empty ($row)) {
					$this->custom_lib->delete_where('fees_scheme_groups','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('fees/bill_scheme/groups/'.$scheme_id);
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'fees/bill_scheme/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_groups_applied_error');
					$this->data['back_url'] = site_url('fees/bill_scheme/groups/'.$scheme_id);
					$this->template->fees_render('fees/bill_scheme/delete',$this->data);
				}
			}
		}	
