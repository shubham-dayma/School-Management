<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {

    protected $CI;

    public function __construct()
    {	
		$this->CI =& get_instance();
    }


    public function admin_render($content, $data = NULL)
    {	
		if ( !$content)
        {
			return NULL; 
        }
        else
        {
            $template['header']          = $this->CI->load->view('admin/_templates/header', $data, TRUE);
            $template['main_header']     = $this->CI->load->view('admin/_templates/main_header', $data, TRUE);
         	$template['main_sidebar']    = $this->CI->load->view('admin/_templates/main_sidebar', $data, TRUE);
            $template['control_sidebar'] = $this->CI->load->view('admin/_templates/control_sidebar', $data, TRUE);
  			$template['content']         = $this->CI->load->view($content, $data, TRUE);
			$template['footer']          = $this->CI->load->view('admin/_templates/footer', $data, TRUE);
			return $this->CI->load->view('admin/_templates/template', $template);
        }
	}


	public function staff_render($content, $data = NULL)
    {
        if ( ! $content)
        {
            return NULL;
        }
        else
        {	
			$template['header']          = $this->CI->load->view('staff/_templates/header', $data, TRUE);
            $template['main_header']     = $this->CI->load->view('staff/_templates/main_header', $data, TRUE);
         	$template['main_sidebar']    = $this->CI->load->view('staff/_templates/main_sidebar', $data, TRUE);
            $template['control_sidebar'] = $this->CI->load->view('staff/_templates/control_sidebar', $data, TRUE);
  			$template['content']         = $this->CI->load->view($content, $data, TRUE);
			$template['footer']          = $this->CI->load->view('staff/_templates/footer', $data, TRUE);
			return $this->CI->load->view('staff/_templates/template', $template);
        }
	}
	
	public function fees_render($content, $data = NULL)
    {
        if ( ! $content)
        {
            return NULL;
        }
        else
        {	
			$template['header']          = $this->CI->load->view('fees/_templates/header', $data, TRUE);
            $template['main_header']     = $this->CI->load->view('fees/_templates/main_header', $data, TRUE);
         	$template['main_sidebar']    = $this->CI->load->view('fees/_templates/main_sidebar', $data, TRUE);
            $template['control_sidebar'] = $this->CI->load->view('fees/_templates/control_sidebar', $data, TRUE);
  			$template['content']         = $this->CI->load->view($content, $data, TRUE);
			$template['footer']          = $this->CI->load->view('fees/_templates/footer', $data, TRUE);
			return $this->CI->load->view('fees/_templates/template', $template);
        }
	}
	
}