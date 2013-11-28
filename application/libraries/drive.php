<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

class Drive {
    public function __construct($params)
    {
        $CI =& get_instance();
    }
    public function createAuthURL()
    {
		$client = new Google_Client();
		// Get your credentials from the console
		$client->setClientId($this->CI->config->item('drive_key'));
		$client->setClientSecret($this->CI->config->item('drive_secret'));
		$client->setRedirectUri($this->CI->config->item('base_url').'/drive/key');
		$client->setScopes(array('https://www.googleapis.com/auth/drive'));
		return $client->createAuthUrl();
    }
}

/* End of file Someclass.php */