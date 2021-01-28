
 <?php 
class Custom_lib
{
	/*	-- Guidlines --
		23.public function printr ($data) --> return structure data also includes die;
		28.public function form ($table_name, $data) --> return $id;
		45.public function insert ($table_name , $data) --> insert data,return id;
		54.public function get_all ($table_name) --> return all data within table;
		61.public function get_where ($table_name , $field_name, $value) --> return records with sql where clause;
		71.public function delete_where($table_name ,$field_name ,$value ) --> deletes records with sql where clause;
		80.public function field_like($table_name ,$field_name ,$value ) --> return records with sql like clause;
		89.public function slug ($table_name ,$field_name ,$slug_string ) --> Only removes special charachter from string.To generate the slug you have to call this
																					  only function;
		96.public function genrate_slug ($table_name, $field_name, $str, $i ) --> Search the string and return actual slug newly made;
		117.public function upload ($path, $file = 'img' , $types ='gif|jpg|png'  , $size = '' , $width = '' , $height = '') --> return uploaded file (image);
		139.public function user_exist () -->returns user_logged or not;
		147.public function hash_password ($password) --> return hashed password string and salt;
		161.public function verfiy_password ($input, $salt, $db_pass) --> return 1 (verifed) or 0 (! verfed);
	*/
	public function __construct()
	{
		
	}
	public function printr ($data){
		echo '<pre>';
		print_r($data);
		die;
	}
	public function form ($table_name = '',$data = ''){
		if (empty ($table_name) || empty ($data)){
			echo 'Specify TABLE_NAME in parameter ONE and UPLOADING_DATA in parameter TWO';
			die;
		}
		$CI =& get_instance();
		if (!empty ($data['id'])) {
			$CI->db->where('id', $data['id']);
			$CI->db->update($table_name,$data);
			$CI->session->set_flashdata('success',lang('record_updated'));
			return $data['id'];
		}
		else {
			$CI->db->insert($table_name,$data);
			$CI->session->set_flashdata('success',lang('record_inserted'));
			return $CI->db->insert_id();
		}
	}
	public function insert ($table_name , $data){
		if (empty ($table_name) || empty ($data)){
			echo 'Specify TABLE_NAME in parameter ONE and UPLOADING_DATA in parameter TWO';
			die;
		}
		$CI =& get_instance();
		$CI->db->insert($table_name,$data);
		return $CI->db->insert_id();
	}
	public function update ($table_name = '',$field = '' , $value = '' ,$data = ''){
		
		if (empty ($table_name) || empty ($field) || empty ($value) || empty ($data) ){
			echo 'Specify TABLE_NAME in parameter ONE and FIELD_NAME in parameter TWO and VALUE in parameter THREE and UPDATE DATA in parameter FOUR';
			die;
		}
		$CI =& get_instance();
		$CI->db->where($field, $value);
		$CI->db->update($table_name,$data);
		return 1;
	}
	
	public function get_all ($table_name){
		if (empty ($table_name)){
			echo 'Specify TABLE_NAME in parameter ONE';
			die;
		}
		$CI =& get_instance();
		return $CI->db->get($table_name);
	}
	public function get_where ($table_name = '',$field_name = '',$value = ''){
		if (empty ($table_name) || empty ($field_name) || empty ($value)){
			if ($value != 0) {
				echo 'Specify TABLE_NAME in parameter ONE and FIELD_NAME in parameter TWO and VALUE in parameter THREE';
				die;
			}
		}
		$CI =& get_instance();
		$CI->db->where ($field_name,$value);
		return $CI->db->get($table_name);
	}
	public function delete_where($table_name = '',$field_name = '',$value = ""){
		if (empty ($table_name) || empty ($field_name) || empty ($value)){
			echo 'Specify TABLE_NAME in parameter ONE and FIELD_NAME in parameter TWO and VALUE in parameter THREE';
			die;
		}
		$CI =& get_instance();
		$CI->db->delete($table_name, array($field_name => $value));
		return 1;
	}
	public function field_like($table_name = '',$field_name = '',$value = ''){
		if (empty ($table_name) || empty ($field_name) || empty ($value)){
			echo 'Specify TABLE_NAME in parameter ONE and FIELD_NAME in parameter TWO and VALUE in parameter THREE';
			die;
		}
		$CI =& get_instance();
		$CI->db->like($field_name,$value); 
	 	return $CI->db->get($table_name);
	}
	public function slug ($table_name = '',$field_name = '',$slug_string = ''){
		if (empty ($table_name) || empty ($field_name) || empty ($slug_string)){
			echo 'Specify TABLE_NAME in parameter ONE and FIELD_NAME in parameter TWO and SLUG_STRING in parameter THREE';
			die;
		}
		$CI =& get_instance();
		$CI->load->helper('string');
		$str = $slug_string;
		$str = strtolower($str);
		$str = ltrim($str);
		$str = rtrim($str);
		$str = str_replace(' ', '-' ,$str);
		$str = preg_replace('/[^A-Za-z0-9\-]/','', $str);
		$str = reduce_double_slashes($str);
		return $this->genrate_slug($table_name, $field_name, $str , 1);
	}
	public function genrate_slug ($table_name, $field_name, $str, $i){
		$result =$this->field_like($table_name, $field_name, $str)->row();
		if(empty ($result)){
			return $str;
		}
		else {
			$i++;
			$str = preg_replace('/[0-9]+/', '', $str);
			$str = $str.$i;
			return $this->genrate_slug($table_name, $field_name, $str, $i);
		}	
	}
	public function upload ($path, $file = 'img' , $types ='gif|jpg|png'  , $size = '' , $width = '' , $height = ''){
	  	$result ['error'] = '';
		$result ['success'] = '';
		$CI =& get_instance();
        $CI->load->library('upload');
		$config['upload_path']      = './upload/'.$path;
		$config['allowed_types']    = $types;
        $config['max_size']         = $size;
        $config['max_width']        = $width;
        $config['max_height']       = $height;
        $config['file_ext_tolower'] = TRUE;
		$CI->upload->initialize($config);
		if ( ! $CI->upload->do_upload($file)){
           	 $result ['error'] = $CI->upload->display_errors(); 
			 return  $result;
		}
		else {
			$data1 = array('upload_data' => $CI->upload->data());
			$result ['success'] =  $data1['upload_data']['file_name'];
			return  $result;
		}
	}
	public function user_exist (){
		if ($this->session->has_userdata('user_id')){
			return 1;
		}
		else {
			return 0;
		}
	}
	public function hash_password ($password){
		//string hash_pbkdf2 ( string $algo , string $password , string $salt , int $iterations [, int $length = 0 [, bool $raw_output = false ]] )
		//$algo -> Name of selected hashing algorithm (i.e. md5, sha256, haval160,4, etc..)
		//$salt -> This value should be generated randomly.
		//$iterations -> The number of internal iterations to perform for the derivation.
		//$length -> lenghth of password.
		//$raw_output ->When set to TRUE, outputs raw binary data. FALSE outputs lowercase hexits.
		$CI =& get_instance();
		$CI->load->helper('string');
		$iterations = 1000;
		$salt = random_string('alnum',16);
		$hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
		$data['salt'] = $salt;
		$data['password'] = $hash;
		return $data;
	}
	public function verfiy_password ($input, $salt, $db_pass){
		$iterations = 1000;
		$hash = hash_pbkdf2("sha256", $input, $salt, $iterations, 20);
		if ($hash == $db_pass){
			return 1;
		}
		else {
			return 0;
		}	
	}
	public function make_mail($recipient ,$subject ,$message ,$attached_file = '') {	
			$CI =& get_instance();
			$settings = $this->get_all('smtp_settings')->row();
			$g_setting = $this->get_all('g_setting')->row();
			if(empty($settings->host) || empty($settings->username) || empty($settings->password) || empty($settings->port) || empty($settings->email)){
				$CI->session->set_flashdata('error', "SMTP Settings Required");
				redirect('admin/setting/mail');
			}
			$config = array(
    					'smtp_host' => $settings->host,
    					'smtp_port' => $settings->port,
    					'smtp_user' => $settings->username,
    					'smtp_pass' => $settings->password,
    					'crlf' 		=> "\r\n",    							
    					'protocol'	=> 'smtp',
			);	
			$config['useragent'] = $g_setting->owner_name;
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;
			$CI->load->library('email',$config);
			$CI->email->from($settings->email, $g_setting->owner_name);
			$CI->email->to($recipient);
			$CI->email->subject($subject);
			$CI->email->message($message);
			if(isset($attached_file)){ 
			   	$CI->email->attach($attached_file);
				    }
				$CI->email->send();
			
		//echo $CI->email->print_debugger();;die;
    	}
		
}
?>