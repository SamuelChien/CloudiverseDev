<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example extends CI_Controller
{
    public function __construct()
    {
    	parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }
    // Call this method first by visiting http://SITE_URL/example/request_google_drive
    public function request_google_drive()
    {
        $this->load->library('drive');
        redirect($this->drive->createAuthURL());
    }

    public function request_dropbox()
	{
		$params['key']    = $this->config->item('dropbox_key');;
		$params['secret'] = $this->config->item('dropbox_secret');;
		
		$this->load->library('dropbox', $params);
		$data = $this->dropbox->get_request_token(site_url("example/access_dropbox"));
		$this->session->set_userdata('token_secret', $data['token_secret']);
		redirect($data['redirect']);
	}


    //This method should not be called directly, it will be called after 
    //the user approves your application and dropbox redirects to it
    public function access_google_drive()
    {
        $google_drive_auth_key =  $this->input->get('code', TRUE);
        $this->session->set_userdata('google_drive_auth_key', $google_drive_auth_key);
        redirect('example/test_google_drive');
    }

	public function access_dropbox()
	{
		$params['key']    = $this->config->item('dropbox_key');
		$params['secret'] = $this->config->item('dropbox_secret');;
		
		$this->load->library('dropbox', $params);
		
		$oauth = $this->dropbox->get_access_token($this->session->userdata('token_secret'));
		
		$this->session->set_userdata('oauth_token', $oauth['oauth_token']);
		$this->session->set_userdata('oauth_token_secret', $oauth['oauth_token_secret']);
        redirect('example/test_dropbox');
	}

    //Once your application is approved you can proceed to load the library
    //with the access token data stored in the session. If you see your account
    //information printed out then you have successfully authenticated with
    //google drive and can use the library to interact with your account.
    public function test_google_drive()
    {
        $auth_key = $this->session->userdata('google_drive_auth_key');
        $this->load->library('drive');
        $this->drive->authentication($auth_key);

        //$localPath = 'asset/css/style.css';
        //$serverPath = "test.css";
        //$this->drive->uploadFile($localPath, $serverPath);

        $localPath = $_SERVER['DOCUMENT_ROOT'].'/asset/files/niu.txt';
        $serverPath = "test.css";
        $this->drive->downloadFile($localPath, $serverPath);

        $data['key'] = $auth_key;
        $this->load->view('test', $data);
    }
	public function test_dropbox()
	{
		$params['key']    = $this->config->item('dropbox_key');;
		$params['secret'] = $this->config->item('dropbox_secret');;
		$params['access'] = array('oauth_token'=>urlencode($this->session->userdata('oauth_token')),
								  'oauth_token_secret'=>urlencode($this->session->userdata('oauth_token_secret')));
		
		$this->load->library('dropbox', $params);
        /*
        $error = $this->dropbox->add('', 'asset/css/style.css');
        if(!isset($error->revision))
        {
            $error_code = "";
            if(isset($error->error))
            {
                $error_code = $error->error;
            }
            $subject = '[' . config_item('system_name') . ']: Dropbox Add Failed';
            $message = config_item('system_name') . " was unable to add file to Dropbox.  The message is below: \n{$error_code}";
            $this->common->alert($subject, $message, __FILE__, __LINE__);
        }
        */
        
        //$error = $this->dropbox->get($_SERVER['DOCUMENT_ROOT'].'/asset/files/niadfasdfasdfasdfu.txt', 'style.css');
    
        $this->load->view('auth/login');
	}
}

/* End of file example.php */
/* Location: ./application/controllers/welcome.php */