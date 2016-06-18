<?php 
defined('BASEPATH') or die('Restricted Access');

class Template
{
	private $ci ;
	private $title = 'Dashboard' ;
	private $user_name='';
	private $page_title;
	private $css_files = array();
	private $hjs_files = array();
	private $hjss_files = array();
	private $js_script = array();
	private $js_files = array();
	public function __construct()
	{
		$this->ci =& get_instance();
	}
	public function loadview($template_name , $view_name,$view_data=array(),$template_data=array())
	{
		if($this->ci->ion_auth->logged_in())
		{
			$template_data['user_name']  = $this->ci->ion_auth->user()->row()->username;
			$template_data['first_name'] = $this->ci->ion_auth->user()->row()->first_name;
			$template_data['last_name']  = $this->ci->ion_auth->user()->row()->last_name;
		}
		else{
			$template_data['user_name']='';
		}
		$template_data['active_controller'] = $this->ci->uri->segment(2);
		$template_data['title'] = $this->title;
		$template_data['main_content'] = $this->ci->load->view($view_name,$view_data,true);
		$template_data['page_title'] = $this->page_title;
		$template_data['css_files'] = $this->css_files;
		$template_data['hjs_files'] = $this->hjs_files;
		$template_data['hjss_files'] = $this->hjss_files;
		$template_data['js_script'] = $this->js_script;
		$template_data['js_files'] = $this->js_files;
		$this->ci->load->view($template_name,$template_data);
	}
	public function add_css($css)
	{
		$this->css_files[]=$css;
	}
	
	public function add_hjs($js)
	{
		$this->hjs_files[]=$js;
	}
	
	public function add_hjss($js)
	{
		$this->hjss_files[]=$js;
	}
	
	public function add_js_script($js_script)
	{
		$this->js_script[]=$js_script;
	}
	
	public function add_js($js)
	{
		$this->js_files[]=$js;
	}
	
	public function set_title($title)
	{
		$this->title = $title ; 
	}
	public function page_title($page_title)
	{
		$this->page_title = $page_title;
	}
}