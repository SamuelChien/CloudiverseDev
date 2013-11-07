<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base extends CI_Controller {
    
//This function is called when maintenance is on
    public function __construct()
    {
        parent::__construct();
        
        if ($this->config->item('maintenance'))
        {
            redirect(base_url('maintenance'));
            die();
        }
    }
    
// The default home page checks if not log in, then log in or load the home page
    public function index()
    {
        // If not log in, go to log in page
        if (!$this->authentication->logged_in())
        {
            redirect(base_url('login'));
            die();
        }
        else
        {
            // load chooser view
            $this->load->view('home');
        }
    }

/*
 * Log in page, check if it's already logged in, then go to home page
 *              If didn't log in, bring to log in page, or if it's a form
 *              then try to do the log in method
 */
    public function login()
    {
        // if already log in, then go to home page
        if ($this->authentication->logged_in())
        {
            redirect(base_url());
            die();
        }
        
        // if it's a form then try log in
        if ($this->input->post('login'))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            if (!empty($username) && !empty($password))
            {
                $results = $this->authentication->login($username, $password);
                
                // Login Successful
                if ($results)
                {                    
                    redirect(base_url());
                }
            }
            
            // Setting Error Message
            $this->session->set_flashdata('status', 'error');
            $this->session->set_flashdata('message', 'You do not have sufficient access privileges.');
            redirect(base_url('login'));
            die();
        }
        // if it's not a form, then bring to log in view
        else
        {
            $this->load->view('auth/login');
        }
    }
	
    public function signup()
    {
           $this->load->view('auth/login');
    }


    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->sess_create();
        $this->session->set_flashdata('status', 'success');
        $this->session->set_flashdata('message', 'Logout successful.');
        redirect(base_url('login'));
        die();
    }
}
/* End of file base.php */
/* Location: ../application/controllers/base.php */