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
            base_url('asset/js/foundation/foundation.joyride.js'),
            'http://code.jquery.com/ui/1.10.3/jquery-ui.js',
            base_url('asset/js/fileCanvas.js')
        );
        // Set this to true if you wish to display the nav bar.
        $data['header_nav_display'] = True;
        
        // Load the header file!
        $this->load->view('i/header', $data);
        $this->load->view('home', $data);
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
								// Check the captcha
								if ($this->input->post('captcha-input') != $_SESSION['captcha'] || $this->input->post('captcha-input')=="") {
										$_SESSION['errorMessage'] = "Captcha you entered is not correct!";
										$_SESSION['errorLoginCaptcha'] = true;
										redirect(base_url('login'));
								}
								
								// Captcha correct, check the user password and username
												$results = $this->authentication->login(
														$this->input->post('username'),
														$this->input->post('password')
												);
								
								// If login is unsuccessful, stay in the login page
								if ($results == false) {
										// Set these variables so that we show the errors on the logign page properly with CSS.
										$_SESSION['errorMessage'] = "Username or password you entered did not match!";
										$_SESSION['errorLoginUsername'] = true;
										$_SESSION['errorLoginPassword'] = true;
										redirect(base_url('login'));
								}
								else{
									$_SESSION['user'] = $results;  // use to display the username on header
									redirect(base_url());
								}
            }

            // If the form type is signup, then signup a new user
            elseif ($this->input->post('formtype') == "signup"){
				// Check username availability
				$this->db->select('uname');
				$query = $this->db->get('users');
				foreach ($query->result() as $user)
				{
					if ($user->uname == $this->input->post('username')) {
						// If the username is not available redirect the user to login page and display error message
						$_SESSION['errorMessage'] = "User name unavailable!!";
						redirect(base_url('login'));
					}
				}
				// Verify if the password and the confirmed password are the same
				$this->load->library('form_validation');
				$_SESSION['confirm'] = $this->input->post('password-confirm');
				$this->form_validation->set_rules('password', 'Password', 'callback_passwordCheck');

				if ($this->form_validation->run()) {
					// If the password match, sign-up the user to database
					$results = $this->authentication->signup(
						$this->input->post('username'),
						$this->input->post('email'),
						$this->input->post('password')
					);
				} else {
					$_SESSION['errorMessage'] = "Password you entered does not match!";
					redirect(base_url('login'));
				}
            }
            // Signup was Successful
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
    	$data['header_JS_inc'] = array(
				base_url()."asset/js/foundation.min.js");
    	// Set this to true if you wish to display the nav bar.
    	$data['header_nav_display'] = False;

    	// Load the header file!
				// Generate a captcha
		$this->load->helper('captcha');
		$vals = array(
			'word' => '',
			'img_path' => './captcha/',
			'img_url' => base_url() . 'captcha/',
			'font_path' => base_url('asset/font/font'),
			'img_width' => 150,
			'img_height' => 30,
			'expiration' => 7200
		);
		$captcha = create_captcha($vals);
		$_SESSION['captcha'] = $captcha['word'];
		echo $captcha['word'];
		$data['captcha'] = $captcha['image'];
    $this->load->view('i/header', $data);
    $this->load->view('auth/login', $data);
    //$this->load->view('i/header', $data); // Login page doesn't need a footer.
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
}
/* End of file base.php */
/* Location: ../application/controllers/base.php */
