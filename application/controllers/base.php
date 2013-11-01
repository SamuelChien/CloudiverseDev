<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        if ($this->config->item('maintenance'))
        {
            redirect(base_url('maintenance'));
            die();
        }
    }
    
    public function index()
    {

        if (!$this->authentication->logged_in())
        {
            //redirect(base_url('login'));
            redirect(base_url('index.php/login'));
            die();
        }
        else
        {
            // load chooser view
            $this->load->view('welcome_message');
        }
    }
    public function login()
    {
        if ($this->authentication->logged_in())
        {
            redirect(base_url());
            die();
        }
        
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
        else
        {
            $data = array();
            $data['title'] = 'Login';
            $this->load->view('auth/login', $data);
        }
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