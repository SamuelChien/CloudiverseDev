<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Maintenance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        if (!$this->config->item('maintenance'))
        {
            redirect(base_url());
            die();
        }
    }
    
    public function index()
    {
        $this->load->view('auth/maintenance');
    }
}

/* End of file maintenance.php */
/* Location: ../application/controllers/maintenance.php */