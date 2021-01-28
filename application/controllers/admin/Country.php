	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Country extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();	
				$this->breadcrumbs->unshift(1, lang('country'), 'admin/country');
			}
			public function index(){
				$this->data['page_title'] = lang('country');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('countries')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('country');
				$this->template->admin_render('admin/country/index',$this->data);
			}
			public function form($id = ''){
				$this->data['page_title'] = lang('country');
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/country/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('country');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('country');
					$this->data['row'] = $this->custom_lib->get_where('countries','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:country', 'required');
					$this->form_validation->set_rules('sortname', 'lang:sort_name', 'required');
					if (empty ($id)){
					$this->form_validation->set_rules('name', 'lang:country', 'required|is_unique[countries.name]');
					$this->form_validation->set_rules('sortname', 'lang:sort_name', 'required|is_unique[countries.sortname]');
					}
					
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['sortname'] = $this->input->post('sortname');
						$this->custom_lib->form('countries',$save);
						redirect ('admin/country');
					}
				}
				$this->template->admin_render('admin/country/form',$this->data);
			}

			public function state($id)
			{
				$this->data['page_title'] = lang('state');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_where('states','country_id',$id)->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('state');
				$this->template->admin_render('admin/country/state',$this->data);
			}
			public function new_state($id){
				$this->data['page_title'] = lang('state');
				$this->breadcrumbs->unshift(2, lang('state'), 'admin/country/new_state');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['page_sub_title'] = lang('add').' '.lang('state');
				$this->data['row'] = $this->custom_lib->get_where('countries','id',$id)->row();
					//print_r($this->data['row']);die;
			
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:state', 'required');
					if ($this->form_validation->run() == TRUE){
						$save['country_id'] = $id;
						$save['name'] = $this->input->post('name');
						$this->custom_lib->form('states',$save);
						redirect ('admin/country');
					}
				}
				$this->template->admin_render('admin/country/new_state',$this->data);
			}
			public function form_state($id = ''){
				$this->data['page_title'] = lang('state');
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/country/form_state');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('state');
					$this->data['row'] = $this->custom_lib->get_where('states','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:country', 'required');
					
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						
						$this->custom_lib->form('states',$save);

						redirect ('admin/country/state/'.$this->data['row']->country_id);
					}
				}
				$this->template->admin_render('admin/country/form_state',$this->data);
			}

			public function city($id)
			{
				$this->data['page_title'] = lang('city');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_where('cities','state_id',$id)->result();
				$this->data['country_result'] = $this->custom_lib->get_where('states','id',$id)->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('city');
				$this->template->admin_render('admin/country/city',$this->data);
			}
			public function new_city($id){
				$this->data['page_title'] = lang('city');
				$this->breadcrumbs->unshift(2, lang('city'), 'admin/country/new_state');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['page_sub_title'] = lang('add').' '.lang('city');
				$this->data['row'] = $this->custom_lib->get_where('states','id',$id)->row();
					//print_r($this->data['row']);die;
			
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:city', 'required');
					if ($this->form_validation->run() == TRUE){
						$save['state_id'] = $id;
						$save['name'] = $this->input->post('name');
						$this->custom_lib->form('cities',$save);
						redirect ('admin/country/state/'.$this->data['row']->country_id);
					}
				}
				$this->template->admin_render('admin/country/new_city',$this->data);
			}
			public function form_city($id = ''){
				$this->data['page_title'] = lang('city');
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/country/form_city');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();

				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('city');
					$this->data['row'] = $this->custom_lib->get_where('cities','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:city', 'required');
					
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						
						$this->custom_lib->form('cities',$save);
						redirect ('admin/country/city/'.$this->data['row']->state_id);
					}
				}
				$this->template->admin_render('admin/country/form_city',$this->data);
			}

			public function delete($type,$redirect_id,$id){
				if($type == 3)
				{
					$this->data['page_title'] = lang('delete').' '.lang('city');
					if(!empty($id))
					{
						$student = $this->custom_lib->get_where ('students','city',$id)->result();
						if (empty ($student)) 
						{
							
							if(!empty($redirect_id))
							{
								$this->custom_lib->delete_where('cities','id',$id);
								$this->session->set_flashdata('danger',lang('record_deleted'));
								redirect ('admin/country/city/'.$redirect_id);
							}	
						}
						else 
						{
							$this->breadcrumbs->unshift(2, lang('delete'), 'admin/country/delete');
							$this->data['breadcrumb'] = $this->breadcrumbs->show();
							$this->data['error_msg'] = lang('delete_city_exist_error');
							$this->data['back_url'] = site_url('admin/country/city/'.$redirect_id);
							$this->data['redirect_url'] = site_url('admin/student/sections');
							$this->data['redirect_caption'] = lang('back_to_student');
							$this->template->admin_render('admin/country/delete',$this->data);
						}
					}
				}

				if($type == 2)
				{
					$this->data['page_title'] = lang('delete').' '.lang('state');
					if(!empty($id))
					{
						$student = $this->custom_lib->get_where ('students','state',$id)->result();
						$cities = $this->custom_lib->get_where ('cities','state_id',$id)->result();
						if (empty ($student) and empty($cities)) 
						{
							if(!empty($redirect_id))
							{
								$this->custom_lib->delete_where('states','id',$id);
								$this->session->set_flashdata('danger',lang('record_deleted'));
								redirect ('admin/country/state/'.$redirect_id);
							}	
						}
						else 
						{
							$this->breadcrumbs->unshift(2, lang('delete'), 'admin/country/delete');
							$this->data['breadcrumb'] = $this->breadcrumbs->show();
							if(!empty($student))
							{
								$this->data['error_msg'] = lang('delete_state_exist_error');
								$this->data['back_url'] = site_url('admin/country/state/'.$redirect_id);
								$this->data['redirect_url'] = site_url('admin/student/sections');
								$this->data['redirect_caption'] = lang('back_to_student');
							}
							if(!empty($cities))
							{
								$this->data['error_msg'] = lang('delete_state_city_exist_error');
								$this->data['back_url'] = site_url('admin/country/state/'.$redirect_id);
								$this->data['redirect_url'] = site_url('admin/country/city/'.$id);
								$this->data['redirect_caption'] = lang('back_to_cities');
							}
							$this->template->admin_render('admin/country/delete',$this->data);
						}
					}
				}
				if($type == 1)
				{
					$this->data['page_title'] = lang('delete').' '.lang('country');
					if(!empty($id))
					{
						$student = $this->custom_lib->get_where ('students','country',$id)->result();
						$states = $this->custom_lib->get_where ('states','country_id',$id)->result();
						if (empty ($student) and empty($states)) 
						{
							$this->custom_lib->delete_where('countries','id',$id);
							$this->session->set_flashdata('danger',lang('record_deleted'));
							redirect ('admin/country');
						}	
						
						else 
						{
							$this->breadcrumbs->unshift(2, lang('delete'), 'admin/country/delete');
							$this->data['breadcrumb'] = $this->breadcrumbs->show();
							if(!empty($student))
							{
								$this->data['error_msg'] = lang('delete_country_exist_error');
								$this->data['back_url'] = site_url('admin/country');
								$this->data['redirect_url'] = site_url('admin/student/sections');
								$this->data['redirect_caption'] = lang('back_to_student');
							}
							if(!empty($states))
							{
								$this->data['error_msg'] = lang('delete_country_state_exist_error');
								$this->data['back_url'] = site_url('admin/country');
								$this->data['redirect_url'] = site_url('admin/country/state/'.$id);
								$this->data['redirect_caption'] = lang('back_to_states');
							}
							$this->template->admin_render('admin/country/delete',$this->data);
						}
					}
				}
				
			} 
			
		}	
