<?php
class Home extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{
		$this->load->view('login', array('error' => ' ' ));
	}
	
	function loginCheck()
	{
		$name = $this->input->post('loginName');
		$password = $this->input->post('password');
		if ($name == "utisee" && $password == "abcd")
		{
			redirect(base_url('index.php/upload'));
		} else
		{
			$error = array('error' => "Your password does not match!");
			$this->load->view('login', $error);
		}
	}
}
?>