<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function logged_in()
    {
        if ($this->session->userdata('logged_in'))
        {
            return true;
        }
        return false;
    }
    
    public function login($username, $password)
    {
        if($username == "Apple" || $username == "Orange"){
            // Getting User Info
            $session = array (
                'username'  =>  $username,
                'fname'     =>  "Samuel",
                'lname'     =>  "Chien",
                'email'     =>  "tchien@apple.com",
                'logged_in' =>  true,
            );
            
            // Set Session Data
            $this->session->set_userdata($session);
            return true;
        }
        return false;
    }

}
// END