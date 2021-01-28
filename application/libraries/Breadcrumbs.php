<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// inspired from the source >> https://github.com/nobuti/Codeigniter-breadcrumbs
class Breadcrumbs {

    protected $CI;

    private $breadcrumbs = array();

    public function __construct()
    {	
		$this->CI =& get_instance();

        $this->breadcrumb_open         = '<ol class="breadcrumb">';
		$this->breadcrumb_close        = '</ol>';
		$this->breadcrumb_el_open      = '<li>';
		$this->breadcrumb_el_close     = '</li>';
		$this->breadcrumb_el_first     = '<i class="fa fa-dashboard"></i>';
		$this->breadcrumb_el_last_open = '<li class="active">';
    }

	function push($id, $page, $url)
    {
		if (!$page OR !$url) return;

		$url = site_url($url);

		$this->breadcrumbs[$url] = array('id' => $id, 'page' => $page, 'href' => $url);
	}


	function unshift($id, $page, $url)
	{
		if (!$page OR !$url) return;

		$url = site_url($url);

		array_unshift($this->breadcrumbs, array('id' => $id, 'page' => $page, 'href' => $url));
	}


	function show()
	{
		if ($this->breadcrumbs)
        {
			$output = $this->breadcrumb_open ."\n";

            //usort($this->breadcrumbs, $this->array_sorter('id'));
			array_multisort($this->breadcrumbs);
			foreach ($this->breadcrumbs as $key => $value)
            {
				$keys = array_keys($this->breadcrumbs);
				
                if (reset($keys) == $key)
                {
					$output.= "\t\t\t". $this->breadcrumb_el_open .'<a href="'. $value['href'] .'">'. $this->breadcrumb_el_first .' '. $value['page'] .'</a> '. $this->breadcrumb_el_close ."\n";
				}
                elseif (end($keys) == $key)
                {
					$output.= "\t\t\t". $this->breadcrumb_el_last_open . $value['page'] . $this->breadcrumb_el_close ."\n";
				}
                else
                {
					$output.= "\t\t\t". $this->breadcrumb_el_open .'<a href="'. $value['href'] .'">'. $value['page'] .'</a> '. $this->breadcrumb_el_close ."\n";
				}
            }

			return $output. "\t\t\t". $this->breadcrumb_close ."\n";
		}

		return NULL;
	}

}
