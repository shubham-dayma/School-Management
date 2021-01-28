	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Student_import extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('caste');	
				$this->breadcrumbs->unshift(1, lang('caste'), 'admin/caste');
				set_time_limit(600000);
			}
			public function index(){
				$CI =& get_instance();
				if (!empty ($this->input->post('submit'))){
					$file = $_FILES['excel']['tmp_name'];
					//load the excel library
					$this->load->library('excel');
					//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
					$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
					//Set to read only
					$objReader->setReadDataOnly(true); 		  
					//Load excel file
					$objPHPExcel=$objReader->load($file);		 
					$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
					$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
					//loop from first data untill last data
					echo '<pre>';
					for($i=2;$i<=$totalrows;$i++)
					{
					  $j = 0;		
					  $title = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();			
					  $fname = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $mname = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $lname = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $gender = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $dob = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $c_address = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $p_address = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $s_mobile = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $s_email = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $enrol_no = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $registration_no = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $admit_class = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $admit_section = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $admit_date = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $leaving_date = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $nationality = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $religion = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $cast = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $category = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $adhar_card_no = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $mother_tounge = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $f_name = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $f_email = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $f_mobile = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $f_edu_qulification = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $f_work_place = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $f_gov_servent = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $f_annual_income = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $m_name = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $m_email = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $m_mobile = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $m_edu_qulification = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $m_work_place = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $m_gov_servent = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $m_annual_income = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $g_name = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $g_email = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $g_mobile = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $g_edu_qulification = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue(); 
					  $g_work_place = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $g_gov_servent = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $g_annual_income = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $country = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $state = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $city = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $pin_code = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $reason_of_leaving = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $current_class = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					  $current_section = $objWorksheet->getCellByColumnAndRow($j++,$i)->getValue();
					
				if (!empty ($fname) && !empty ($f_name) && !empty ($m_name) ) {	 
					 $data_user ['gender'] = ($gender == 'BOY') ? '0' : '1'; 
					 if (!empty($title)) {
					  		$title_detail = $this->custom_lib->field_like('titles','name',$title)->row();
					  		if (empty ($title_detail)){
								$title1['for_gender'] = $data_user ['gender'];
								$title1['name'] = $title;
								$title1['creat_date'] = date('Y-m-d');
								$data_user ['title'] = $this->custom_lib->insert('titles',$title1);
							}
							else{
								$data_user ['title'] = $title_detail->id;
							}
					  }
					  
					  $data_user ['fname'] = $fname;
					  $data_user ['mname'] = (!empty ($mname)) ? $mname : '';
					  $data_user ['lname'] = (!empty ($lname)) ? $lname : '';
					  $data_user ['dob'] = date('Y-m-d',strtotime($dob));
					  $data_user ['c_address'] = (!empty($c_address)) ? $c_address :'';
					  $data_user ['p_address'] = (!empty($p_address)) ? $p_address : '';
					  $data_user ['s_mobile'] = (!empty ($s_mobile)) ? $s_mobile : '';
					  $data_user ['s_email'] = (!empty ($s_email)) ? $s_email : '';
					  $data_user ['enrol_no'] = (!empty ($enrol_no)) ? $enrol_no : '';
					  $data_user ['registration_no'] = (!empty ($registration_no)) ? $registration_no : '';
					  if (!empty($admit_class)){
					  	 $class_detail = $this->custom_lib->field_like('classes','name',$admit_class)->row();
						 //print_r($class_detail);die;
					  		if (empty ($class_detail)){
								$class['name'] = $admit_class;
								$class['creat_date'] = date('Y-m-d h:i:s');
								$data_user ['admit_class'] = $this->custom_lib->insert('classes',$class);
							}
							else{
								$data_user ['admit_class'] = $class_detail->id;
							}	
					  }
					  if (!empty($admit_section)) {
					  	$CI->db->where('class_id',$data_user ['admit_class']);
						$CI->db->like('name',$admit_section);
						$section_detail = $CI->db->get('sections')->row();
						if (empty($section_detail)){
							$section['name'] = $admit_section;
							$section['class_id'] = $data_user ['admit_class'];
							$section['creat_date'] = date('Y-m-d h:i:s');
							$data_user ['admit_section'] = $this->custom_lib->insert('sections',$section);
						}
						else{
							$data_user ['admit_section'] = $section_detail->id;
						}
					  }
					  $data_user ['admit_date'] = date('Y-m-d',strtotime($admit_date));
					  $data_user ['leaving_date'] = (!empty($leaving_date)) ? $leaving_date : '';
					  
					  if (!empty($nationality)) {
					  	$nationality_detail = $this->custom_lib->field_like('nationalities','name',$nationality)->row();
					  	if (empty($nationality_detail)){
							$nat['name'] = $nationality;
							$nat['creat_date'] = date('Y-m-d h:i:s');
							$data_user ['nationality'] = $this->custom_lib->insert('nationalities',$nat);
						}
						else{
							 $data_user ['nationality'] = $nationality_detail->id;
						}
					  }
					  
					  if (!empty($religion)) {
					  	$religion_detail = $this->custom_lib->field_like('religions','name',$religion)->row();
					  	if (empty($religion_detail)){
							$rel['name'] = $religion;
							$rel['creat_date'] = date('Y-m-d h:i:s');
							$data_user ['religion'] = $this->custom_lib->insert('religions',$rel);
						}
						else{
							 $data_user ['religion'] = $religion_detail->id;
						}
					  }
					  
					  if (!empty($cast)) {
					  	$cas_detail = $this->custom_lib->field_like('castes','name',$cast)->row();
					  	if (empty($cas_detail)){
							$cas['name'] = $cast;
							$cas['creat_date'] = date('Y-m-d h:i:s');
							$data_user ['cast'] = $this->custom_lib->insert('castes',$cas);
						}
						else{
							 $data_user ['cast'] = $cas_detail->id;
						}
					  }
					 
					  if (!empty($category)) {
					  	$cat_detail = $this->custom_lib->field_like('categories','name',$category)->row();
					  	if (empty($cat_detail)){
							$cas['name'] = $category;
							$cas['creat_date'] = date('Y-m-d h:i:s');
							$data_user ['category'] = $this->custom_lib->insert('categories',$cas);
						}
						else{
							 $data_user ['category'] = $cat_detail->id;
						}
					  }
					  $data_user ['adhar_card_no'] = (!empty($adhar_card_no)) ? $adhar_card_no :'';
					  $data_user ['mother_tounge'] = $mother_tounge;
					  $data_user ['f_name'] = $f_name;
					  $data_user ['f_email'] = (!empty ($f_email)) ? $f_email : '';
					  $data_user ['f_mobile'] = (!empty ($f_mobile)) ? $f_mobile :'';
					  $data_user ['f_edu_qulification'] = (!empty ($f_edu_qulification)) ? $f_edu_qulification : '' ;
					  $data_user ['f_work_place'] = (!empty ($f_work_place)) ? $f_work_place : '';
					  $data_user ['f_gov_servent'] = (!empty ($f_gov_servent)) ? $f_gov_servent : '0';
					  $data_user ['f_annual_income'] = (!empty ($f_annual_income)) ? $f_annual_income : '';
					  $data_user ['m_name'] = $m_name;
					  $data_user ['m_email'] = (!empty ($m_email)) ? $m_email : '';
					  $data_user ['m_mobile'] = (!empty ($m_mobile)) ? $m_mobile :'';
					  $data_user ['m_edu_qulification'] = (!empty ($m_edu_qulification)) ? $m_edu_qulification : '' ;
					  $data_user ['m_work_place'] = (!empty ($m_work_place)) ? $m_work_place : '';
					  $data_user ['m_gov_servent'] = (!empty ($m_gov_servent)) ? $m_gov_servent : '0';
					  $data_user ['m_annual_income'] = (!empty ($m_annual_income)) ? $m_annual_income : '';
					  $data_user ['g_name'] = (!empty ($g_name)) ? $g_name : '';
					  $data_user ['g_email'] = (!empty ($g_email)) ? $g_email : '';
					  $data_user ['g_mobile'] = (!empty ($g_mobile)) ? $g_mobile :'';
					  $data_user ['g_edu_qulification'] = (!empty ($g_edu_qulification)) ? $g_edu_qulification : '' ;
					  $data_user ['g_work_place'] = (!empty ($g_work_place)) ? $g_work_place : '';
					  $data_user ['g_gov_servent'] = (!empty ($g_gov_servent)) ? $g_gov_servent : '0';
					  $data_user ['g_annual_income'] = (!empty ($g_annual_income)) ? $g_annual_income : '';
					  if(!empty($country)) {
					  	$country_detail = $this->custom_lib->field_like('countries','name',$country)->row();
					  	$data_user ['country'] = $country_detail->id;
					  }
					  if(!empty($state)) {
					  	$state_detail = $this->custom_lib->field_like('states','name',$state)->row();
					  	$data_user ['state'] = $state_detail->id;
					  }
					  if(!empty($city)) {
					  	$CI->db->like('name',$city);
						$CI->db->where('state_id');
						$city_detail = $CI->db->get('cities')->row();
						if (!empty ($city_detail)) {
							$data_user ['city'] = $city_detail->id;
					  	}
					  }
					 
					  $data_user ['pin_code'] = (!empty($pin_code)) ? $pin_code : '';
					  $data_user ['reason_of_leaving'] = (!empty($reason_of_leaving )) ? $reason_of_leaving : '';
					  $data_user['s_academic_status'] = 1;
					  $student_id = $this->custom_lib->insert('students',$data_user);	
					  /*Current Details*/
					  if (!empty ($current_class) && !empty($current_section)){
					  	$CI->db->like('name',$current_class);
						$CI->db->where('session_id',$this->session->userdata('academic_session'));
					  	$class_detail = $CI->db->get('classes')->row();
					  	if (empty($class_detail)){
							$cl['name'] = $current_class;
							$cl['session_id'] = $this->session->userdata('academic_session');
							$cl['creat_date'] = date('Y-m-d h:i:s');
							$class_id = $this->custom_lib->insert('classes',$cl);
							
						}
						else{
							$class_id = $class_detail->id;
						}
						$CI->db->like('name',$current_section);
						$CI->db->where('class_id',$class_id);
						$section_detail = $CI->db->get('sections')->row();
						if (empty($section_detail)){
							$ses['name'] = $current_section;
							$ses['class_id'] = $class_id;
							$ses['session_id'] = $this->session->userdata('academic_session');
							$ses['creat_date'] = date('Y-m-d h:i:s');
							$current_data['section_id'] = $this->custom_lib->insert('sections',$ses);
						}
						$current_data['student_id'] = $student_id;
					  	$current_data['session_id'] = $this->session->userdata('academic_session');
					  	$sss_id = $this->custom_lib->insert('sess_student_section',$current_data);
					  	echo $i.' '.$data_user ['fname'].'</br>';
					  }
				}	  
					 // print_r($data_user['fname']);	 
					}
					die;
				}
				$this->load->view('admin/students/import');
			}
		}	
