<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gdrive extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    // Call this method first by visiting http://SITE_URL/example/request_dropbox
    public function upload()
	{
        //if($this->session->userdata('drive_user_key') == NULL)
        //{
            //$this->load->library('drive');
            //redirect($this->drive->createAuthURL());
        //}
        //redirect(base_url());
	}
    public function download()
    {
        redirect("/login/");
    }
    public key()
    {

    }
}

/* End of file drive.php */
/* Location: ./application/controllers/drive.php */