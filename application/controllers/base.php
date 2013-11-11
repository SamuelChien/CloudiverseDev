<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base extends CI_Controller {
    
    /*
     * Constructor, Checks if the site is meant to be under maintenece
     *              and if so, then load the maintainence page
     */
    public function __construct() {
        parent::__construct();
        if ($this->config->item('maintenance')) {
    		$data = array();
    		// A unique identifier for this page (used for CSS styling)
    		$data['body_ID'] = "maintenance-page";
    		// Text that should be placed in the title tag in the head
    		$data['page_title'] = "Site is down";
    		/*
     		*  Add addition CSS stylesheets here!
     		*  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SYTLESHEETS');
     		*/
    		$data['header_CSS_inc'] = array();
    		/*
     		*  Add addition CSS stylesheets here!
     		*  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SCRIPTS');
     		*/
    		$data['header_JS_inc'] = array();
    		// Set this to true if you wish to display the nav bar.
    		$data['header_nav_display'] = False;

   	 	// Load the header file!
    		$this->load->view('i/header', $data);
		$this->load->view('auth/maintenance');
        }
	session_start();
    }
    
    /*
     * The default home page, checks if not log in, then log in or load the home page
     */
    public function index() {
        // Check if user is logged in
        if (!$this->authentication->logged_in()) {
            // if not then call the base/login function
            redirect(base_url('login'));
            die();
        }
        // Load the homepage otherwise
	$data = array();
    	// A unique identifier for this page (used for CSS styling)
    	$data['body_ID'] = "home-page";
    	// Text that should be placed in the title tag in the head
    	$data['page_title'] = "Welcome";
    	/*
    	 *  Add addition CSS stylesheets here!
     	 *  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SYTLESHEETS');
     	 */
    	$data['header_CSS_inc'] = array();
    	/*
    	 *  Add addition CSS stylesheets here!
    	 *  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SCRIPTS');
    	 */
    	$data['header_JS_inc'] = array(
        	'http://code.jquery.com/ui/1.10.3/jquery-ui.js',
        	base_url('asset/js/file-repo.js')
    	);
    	// Set this to true if you wish to display the nav bar.
    	$data['header_nav_display'] = True;

    	// Load the header file!
    	$this->load->view('i/header', $data);
        $this->load->view('home');
    }

    /*
     * Log in page, check if the user is already logged in, then go to home page
     *              If didn't log in, bring to log in page, or if it's a form
     *              then try to do the log in method
     */
    public function login() {
        // if user is already logged in, then go to home page
        if ($this->authentication->logged_in()) {
            redirect(base_url());
	    die();
        }
        
        $results = false;
        // Now, we check for any POST data
        if ($this->input->post()) {
            // If the form type is login then perform the login process
            if ($this->input->post('formtype') == "login") {
                $results = $this->authentication->login(
                    $this->input->post('username'),
                    $this->input->post('password')
                );
            }
            // If the form type is signup, then signup a new user
            elseif ($this->input->post('formtype') == "signup"){
				$this->load->library('form_validation');
				$_SESSION['confirm'] = $this->input->post('password-confirm');
				$this->form_validation->set_rules('password', 'Password', 'callback_passwordCheck');  // Verify if the password and the confirmed password are the same

				if ($this->form_validation->run()) {
					$results = $this->authentication->signup(
						$this->input->post('username'),
						$this->input->post('email'),
						$this->input->post('password'),
						$this->input->post('password-confirm')
					);
				} else {
					$_SESSION['error'] = "Password you entered do not match!";
					redirect(base_url('login'));
				}
            }
            // Login was Successful
            if ($results) {
                redirect(base_url());
            }
        }

        // Once that's done load the login page.

    	$data = array();
    	// A unique identifier for this page (used for CSS styling)
    	$data['body_ID'] = "login-page";
    	// Text that should be placed in the title tag in the head
    	$data['page_title'] = "Login or Sign up";
    	/*
     	*  Add addition CSS stylesheets here!
     	*  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SYTLESHEETS');
     	*/
    	$data['header_CSS_inc'] = array();
    	/*
     	*  Add addition CSS stylesheets here!
     	*  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SCRIPTS');
     	*/
    	$data['header_JS_inc'] = array();
    	// Set this to true if you wish to display the nav bar.
    	$data['header_nav_display'] = False;

    	// Load the header file!
    	$this->load->view('i/header', $data);
        $this->load->view('auth/login');
    }

    /*
     * Logout function; logs off the user by stopping his session
     *                  You call this function by visiting the URL
     *                  baseurl('logout') as defined in config/routes.php
     */
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->sess_create();
        $this->session->set_flashdata('status', 'success');
        $this->session->set_flashdata('message', 'Logout successful.');
        redirect(base_url('login'));
        die();
    }
	
	public function passwordCheck($confirm)
	{
		/*
		 * Validation rule to check the confirm password matches the entered password
		 */
		if($_SESSION['confirm'] == $confirm)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function usernameCheck($username)
	{
		/*
		 * Make sure that the username is unique in the database
		 */
	}
}
/* End of file base.php */
/* Location: ../application/controllers/base.php */