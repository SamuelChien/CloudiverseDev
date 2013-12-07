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
		// Select user from database cloudiverse where uname = $username, password = $password
		$this->db->select('uname, password');
		$this->db->from('users');
		$this->db->where('uname', $username);
		$this->db->where('password', $password);

		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			// username and password match the database
			$session = array (
				'username'  =>  $username,
				'logged_in' =>  true,
			);
			$this->session->set_userdata($session);
			return $username;
		}
        return false;
    }

    /*
     * Signup function, returns True if the user could be created
     */
    public function signup($username, $email, $password){
        /*
		 * Returns true if the user is successfully added to database
		 */
        $data = array(
		   'uname' => $username,
		   'password' => $password,
		   'email' => $email
		);
		$this->db->insert('users', $data);

		return ($this->db->affected_rows() != 1) ? false : true;
    }
}
/* End of file authentication.php */
/* Location: ../application/models/authentication.php */