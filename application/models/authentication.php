<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Authentication extends CI_Model
{

    /*
     * logged_in(), returns True iff the user is currently logged in
     */        
    public function logged_in()
    {
        if ($this->session->userdata('logged_in'))
            return true;
        return false;
    }

    /*
     * login function, returns True if the user could be logged in
     */    
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
    
    /*
     * Signup function, returns True if the user could be created
     */
    public function signup($username, $email, $password, $password_conf){
        // User Registration Goes here
        return true;
    }
}
/* End of file authentication.php */
/* Location: ../application/models/authentication.php */