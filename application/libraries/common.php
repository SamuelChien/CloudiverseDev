<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/************************************************************
 *
 * CLOUDIVERSE INC.
 * www.cloudiverse.com
 *
 * Copyright 2013. All Rights Reserved.
 * This file may not be redistributed in whole or part.
 *
 * Application: Cloudiverse Web App
 *
 ************************************************************/

class Common
{
    /**
     * Get a random generated ID for graph
     *
     * @param   string  $valid_chars   -   Default 'abcdefghhijklmnopqrstuvwxyz123456789123456789'
     * @param   int  $length           -   Default 20 characters
     *
     * @return  $random_string (string)
     *
     */
    function getRandomID($valid_chars='abcdefghhijklmnopqrstuvwxyz123456789123456789', $length=20)
    {
        // start with an empty random string
        $random_string = "";
        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);
        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++)
        {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);
            
            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick-1];
            
            // add the randomly-chosen char onto the end of our string so far
            $random_string .= $random_char;
        }
        
        // return our finished random string
        return $random_string;
    }
    
    /**
     * Convert time from one timezone to another
     *
     * @param   string  $time     -   Time you want to convert
     * @param   string  $fromTz   -   Timezone of the source time
     * @param   string  $toTz     -   Timezone you wish to convert to
     *
     * @return  time (string)
     *
     */
    function convertTime($time, $fromTz = 'GMT', $toTz = 'PST')
    {
        $date = new DateTime($time, new DateTimeZone($fromTz));
        $date->setTimezone(new DateTimeZone($toTz));
        $time = $date->format('Y-m-d H:i:s');
        return $time;
    }
    
    /**
     * Send an email alerting of an event
     *
     * @param   string  $subject  -   Subject of email message
     * @param   string  $body     -   Contents of email message
     * @param   string  $file     -   File of error (optional)
     * @param   string  $line     -   Line number of error (optional)
     * @param   bool    $html     -   HTML Message (Bool)
     *
     * @return  null
     *
     * Example Error Message Code
     * $error_code = "Error:405";
     * $subject = '[' . config_item('system_name') . ']: Authentication Login Fail';
     * $message = config_item('system_name') . " was unable to log in.  The message is below: \n{$error_code}";
     * $this->common->alert($subject, $message, __FILE__, __LINE__);
     *
     */
    function alert($subject, $body, $file = null, $line = null, $html = false)
    {
        $CI =& get_instance();
        $to = $CI->config->item('system_email'); 
        $systemName = $CI->config->item('system_name');
        $subject = "[{$systemName}]: " . $subject;
        $from = "From: {$systemName} <{$to}>\r\n";
        
        if ($html !== false){
            $from .= 'MIME-Version: 1.0' . "\r\n";
            $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        }
        
        if (!empty($file) && !empty($line)){
            $body = $body . "\n\nFile:{$file}\nLine: {$line}\nSent From: " . $this->getIP() . "\nClient IP: " . $_SERVER['REMOTE_ADDR'];
        }
        
        else {
            $body = $body . "\n\nSent From: " . $this->getIP();
        }
        
        error_log('Subject: ' . $subject);
        error_log('Message: ' . $body);
        
        mail($to, $subject, $body, $from);
        
    }
    
    /**
     * Send an email alerting of an event and die
     *
     * @param   string  $subject  -   Subject of email message
     * @param   string  $body     -   Contents of email message
     * @param   string  $file     -   File of error (optional)
     * @param   string  $line     -   Line number of error (optional)
     * @param   bool    $html     -   HTML Message (Bool)
     *
     * @return  null
     *
     */
    function alertAndDie($subject, $body, $file = null, $line = null, $html = false)
    {
        $this->alert($subject, $body, $file, $line, $html);
        die();
    }
    
    /**
     * Generate a universally unique identifier
     * 
     * @param   string   $table    -   Table to check to see if UUID already exists
     * @param   int      $length   -   Length of of UUID, defaults to 6
     * 
     * @return  string
     */
    function uuid($table = 'mfi_requests', $length = 6){
        
        // Connect to the database
        $conn = $this->database();
        
        $uuid = '';
        
        // Set characters
        // Numbers are listed twice in order to even out
        // the distribution. The number 0 is left out to
        // provide more clarity against the letter O.
        $ch = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            . '123456789123456789';
            
        // Length of character list
        $chlen = strlen($ch) - 1;
        
        $unique = false;
        
        while (!$unique){
        
            // Clear out previous iterations
            $uuid = '';
            
            // Generate random string
            for ($i = 0; $i < $length; $i = strlen($uuid)){
                
                // Select random character from list
                $random = $ch[mt_rand(0, $chlen)];
                
                // Make sure the same two characters don't appear next to each other
                if ($random !== substr($uuid, -1)){
                    $uuid .= $random;
                    $i++;
                }
            }
            
            // Run against "bad" words
            if ($this->_no_bad_words($uuid)){
                
                // Verify uniqueness
                $query = mysql_query("SELECT * FROM {$table} WHERE receipt = '{$uuid}' LIMIT 1");
                            
                if (mysql_num_rows($query) == 0){
                    $unique = true;
                    break;
                }
            }
        }
        
        // Close MySQL Connection
        mysql_close($conn);
        
        // Return UUID
        return $uuid;
    }
    
    /**
     * Get IP Address of local server
     *
     * @return  string
     *
     */
    function getIP()
    {
        exec("ifconfig | grep \"inet \" | grep -v 127.0.0.1 | cut -d\\  -f2", $output, $retval);
        $ips = implode("\n", $output);
        if ($ips == '')
        {
            $ips = 'UNKNOWN';
        }
        
        return $ips;
    }
    
    /**
     * Remotely execute a command or script
     *
     * @param   string  $command    -   Command to be executed on remote machine
     * @param   string  $user       -   User to execute the command under (Must have SSH key installed)
     * @param   string  $address    -   Address of server to execute command on
     *
     * @return  bool                -   True on success, false on failure
     *
     */
    function remoteExec($command, $user, $address){
        $val = system("ssh $user@$address \"$command\"", $ret_val);
        
        if($ret_val !== 0){
            return false;
        }
        return true;
    }
    
    /**
     * Compress remote directory
     *
     * @param   string      $directory  -   Directory to compress
     * @param   string      $user       -   User with permissions to directory
     * @param   string      $address    -   Address of server containing directory
     *
     * @return  bool
     *
     */
    function compressDirectory($directory, $user, $address)
    {
        $results = $this->remoteExec("tar cjPf {$directory}.tar.bz2 {$directory}", $user, $address);
        
        if(!$results)
        {
            return false;
        }
        
        return true;
    }
    
    /**
     * Remove a remote directory
     *
     * @param   string      $directory  -   Directory to recursively remove
     * @param   string      $user       -   User with permissions to remove directory
     * @param   string      $address    -   Address of server containing directory
     *
     * @return  bool
     *
     */
    function removeDirectory($directory, $user, $address)
    {
        $results = $this->remoteExec("rm -rf {$directory}", $user, $address);
        
        if(!$results)
        {
            return false;
        }
        
        return true;
    }
    
    /**
     * Secure copy file or directory from localhost to remote server
     *
     * @param   string      $src        -   Location of file or directory to copy
     * @param   string      $system     -   System to copy file or directory to
     * @param   string      $dest       -   Destination on remote server
     * @param   int         $port       -   SSH port if different from default
     * @param   bool        $recursive  -   Copy directory/file recursively (Defaults to false)
     *
     * @return  bool
     *
     */
    function scpToRemote($src, $system, $dest, $port = false, $recursive = false)
    {
        $scp = "scp";
        
        if ($recursive)
        {
            $scp = $scp . ' -r';
        }
        
        if (!empty($port) && is_numeric($port)){
            $scp = $scp . " -P {$port}";
        }
        
        $scp = $scp . " {$src} {$system}:{$dest}";
        
        system($scp, $results);
        
        if ($results !== 0)
        {
            return false;
        }
        
        return true;
    }
    
    /**
     * Secure copy file or directory from remote server to localhost
     *
     * @param   string     $src         -   Location on remote server of file or directory
     * @param   string     $system      -   System to copy file or directory from
     * @param   string     $dest        -   Destination on local server
     * @param   int        $port        -   SSH port if different from default
     * @param   bool       $recursive   -   Copy directory/file recursively (Defaults to false)
     *
     * @return  bool
     *
     */
    function scpFromRemote($src, $system, $dest, $port = false, $recursive = false)
    {
        $scp = "scp";
        
        if ($recursive)
        {
            $scp = $scp . ' -r';
        }
        
        if (!empty($port) && is_numeric($port))
        {
            $scp = $scp . " -P {$port}";
        }
        
        $scp = $scp . " {$system}:{$src} {$dest}";
        
        system($scp, $results);
        
        if ($results !== 0)
        {
            return false;
        }
        
        return true;
    }
    
    /**
     * Check for bad words
     * 
     * @param   string  $haystack
     * 
     * @return  bool
     */
    function _no_bad_words($haystack){
        
        $needle = array(
            'anus', 'arse', 'ass', 'bag', 'bait', 'bimbo', 'bitch', 'bite', 'blow', 'bollo', 'boner', 'boob', 'butt', 'chinc', 'chink', 'chode', 'clit', 'cock', 'coon', 'cum', 'cunt', 'damn', 'dick', 'dike', 'dildo', 'dooch', 'douche', 'dumb', 'dyke', 'fag', 'fck', 'fcuk', 'flame', 'fuck', 'fuk', 'gay', 'hate', 'hoe', 'hole', 'hump', 'jap', 'lips', 'lord', 'love', 'mofo', 'munch', 'nigg', 'paki', 'penis', 'piss', 'poon', 'porn', 'prick', 'pussy', 'queef', 'queer', 'renob', 'rimjob', 'ruski', 'sex', 'shit', 'skank', 'skeet', 'skull', 'slit', 'slow', 'slut', 'spic', 'spik', 'tard', 'teet', 'tit', 'twat', 'twit', 'vagina', 'vaj', 'wad', 'wank', 'weed', 'whore', 'wit'
        );
        
        $regex = '/' . implode('|', array_map('preg_quote', $needle)) . '/i';
        
        return (preg_match($regex, $haystack) === 0);
    }
}

/* End of file common.php */
/* Location: ../application/libraries/common.php */