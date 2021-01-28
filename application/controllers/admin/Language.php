<?php 
class Language extends Admin_Controller {
	
	 public function __construct()
    {
        parent::__construct();
		
	   	$this->data['pagetitle'] = lang('language');
        $this->breadcrumbs->unshift(1, lang('language'), 'admin/Language');
    }
	
	function index (){
		$this->data['languages'] = $this->custom_lib->get_all('languages')->result();
		$this->load->library ('upload');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		if ($this->input->post('submit')){
			$this->form_validation->set_rules('name' , 'lang:name' , "required|trim|is_unique[languages.name]");	
			if($this->form_validation->run()){
				$name=$_FILES['file']['name'];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				if ($ext != 'php'){
					$this->data['error'] = 'Uploaded document must be .php file';
					//echo $this->data['error'];die;
				}
				else {	
					$path = site_url('application/language/');
					$language = strtolower($this->input->post('name'));
					$upload_config = array('upload_path' => './application/language/' . $language.'/', 'allowed_types' =>'php');
					mkdir($upload_config['upload_path'].'/', 0777, true);
					$name=$_FILES['file']['name'];
					$tname=$_FILES['file']['tmp_name'];
					$temp = explode(".",$name);
					$newfilename = $language.'_lang' . '.' .end($temp);
					move_uploaded_file($tname,$upload_config['upload_path'] .'/'. $newfilename);
					$save['name'] = $language;
					$save['file'] =  $newfilename;
					$img = $this->custom_lib->upload('language');
					if (!empty ($img['success'])){
						$save['img'] = $img['success'];
					}
					$this->custom_lib->insert('languages',$save);
					redirect ('admin/language');
				}	
			}	
		}
		$this->template->admin_render('admin/language/form', $this->data);
	}
	
	function sample_file(){
		$this->load->helper('download');
		force_download(APPPATH.'language/english/english_lang.php', NULL);
		redirect ('admin/language');
	}
	function user_lang () {
		$this->session->set_userdata('lang',$_POST['lang']);
	} 
	 function delete($id){
	 	$result = $this->custom_lib->get_where('languages','id',$id)->row();
		if (!empty ($result->img)){
			unlink (FCPATH."upload/language/".$result->img);
		}
		$this->load->helper("file"); 
		$path=APPPATH.'language/'.$result->name.'/'.$result->file;
		unlink($path);	
		$path1=APPPATH.'language/'.$result->name;
		rmdir($path1);
		$this->custom_lib->delete_where('languages','id',$id);
		redirect ('admin/language');	
	 }
	
}