<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

class Drive {
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->service = NULL;
    }
    public function createAuthURL()
    {
		$client = new Google_Client();
		// Get your credentials from the console
		$client->setClientId($this->CI->config->item('drive_key'));
		$client->setClientSecret($this->CI->config->item('drive_secret'));
		$client->setRedirectUri($this->CI->config->item('base_url').'example/access_google_drive');
		$client->setScopes(array('https://www.googleapis.com/auth/drive'));
		return $client->createAuthUrl();
    }

    public function authentication($authCode){
        $client = new Google_Client();
        $client->setClientId($this->CI->config->item('drive_key'));
        $client->setClientSecret($this->CI->config->item('drive_secret'));
        $client->setRedirectUri($this->CI->config->item('base_url').'example/access_google_drive');
        $client->setScopes(array('https://www.googleapis.com/auth/drive'));
        $this->service = new Google_DriveService($client);
        
        $accessToken = $client->authenticate($authCode);
        $client->setAccessToken($accessToken);
    }

    public function uploadFile($localPath, $serverPath) {
        $file = new Google_DriveFile();
        $file->setTitle($serverPath);
        $file->setDescription('A test document');
        $file->setMimeType('text/plain');

        $data = file_get_contents($localPath);
        $createdFile = $this->service->files->insert($file, array(
              'data' => $data,
              'mimeType' => 'text/plain',
            ));
    }
    
    public function downloadFile($localPath, $serverPath) { 
        $fileContent = "";
        $fileContent = $this->downloadFileByFileItem($this->retrieveFilesIDByFileName($serverPath));
        $f = fopen($localPath, "w+b");
        fwrite($f, $fileContent);
        fclose($f);
        return true;
    }
    
    public function downloadFileByFileItem($fileID) {
        $file = $this->service->files->get($fileID);
        $downloadUrl = $file["downloadUrl"];
        if ($downloadUrl) {
            $request = new Google_HttpRequest($downloadUrl, 'GET', null, null);
            $httpRequest = Google_Client::$io->authenticatedRequest($request);
            if ($httpRequest->getResponseHttpCode() == 200) {
                return $httpRequest->getResponseBody();
            } else {
                    // An error occurred.
                    return null;
            }
        } else {
            // The file doesn't have any content stored on Drive.
                return null;
        }
    }
    
    public function retrieveFilesIDByFileName($name) {
        $result = array();
        $pageToken = NULL;

        try {
            $parameters = array();
            if ($pageToken) {
                $parameters['pageToken'] = $pageToken;
            }
            $fileHugeArray = $this->service->files->listFiles($parameters);
        }catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
            $pageToken = NULL;
        }
        
        $fileArray = $fileHugeArray['items'];
        $fileID = "null";
        foreach($fileArray as $file)
        {
            if($file["title"] == $name)
            {
                $fileID = $file["id"];
                return $fileID;
            }
        }
        
        return $fileID;
    }
}

/* End of file Someclass.php */