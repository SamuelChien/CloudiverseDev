<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base extends CI_Controller {

    /*
     * Constructor, Checks if the site is meant to be under maintenece
     *              and if so, then load the maintainence page
     */
    public function __construct() {
        parent::__construct();
        if ($this->config->item('maintenance')) {
            redirect(base_url('maintenance'));
            $this->load->view('auth/maintenance');
        }
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
        }
        
        $results = false;
        // Now, we check for any POST data
        if ($this->input->post()) {
            // If there was a 'login' varaible, then the login form was sent
            if ($this->input->post('login')) {
                $results = $this->authentication->login(
                    $this->input->post('username'),
                    $this->input->post('password')
                );
            }
            // If there was a 'signup' varaible, then the signup form was sent
            elseif ($this->input->post('signup')){
                $results = $this->authentication->signup(
                    $this->input->post('username'),
                    $this->input->post('email'),
                    $this->input->post('password'),
                    $this->input->post('password-confirm')
                );
            }
            // Login was Successful
            if ($results) {
                redirect(base_url());
            }
        }

        // Once that's done load the login page.
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
}
/* End of file base.php */
/* Location: ../application/controllers/base.php */