<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller {
    
	// The default home page checks if not log in, then log in or load the home page
    public function index()
    {
    	$this->load->view('file');
    }
}
/* End of file base.php */
/* Location: ../application/controllers/base.php */