<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('directory');
		$this->load->helper("file"); 
		$this->load->library('session');			
	}

	function index() 				//initialize data
	{
		$this->session->set_userdata('error_message', array('error' => ' ' ));
		$this->session->set_userdata('currentfolder', './uploads/'); 		
		redirect(base_url("index.php/upload/show_files"));
	}
	
	function show_files(){
		$current = $this->session->userdata('currentfolder');					//Get current directory path
		$error_message = $this->session->userdata('error_message');				//Get error message sent from do_upload
		echo $current;
		if($this->input->post('Combine_File')!=""){
			if($current=="./uploads/combined_file/" ||$current=="./uploads/divided/" ){//If no folder name is entered, create error message
				$this->session->set_userdata('error_message', array('error' => 'You have no permission to combine files in this folder!!' ));
				redirect(base_url("index.php/upload/show_files"));						//Reload controller	
			}		
			if(($combine_file =$this->input->post('choose_file'))!="" && sizeof($combine_file)==1 && ($dir_group=$this->input->post('choose_dir'))==""){
				$this->session->set_userdata('combine_filename',$combine_file[0]);
				redirect(base_url("index.php/splitfiles/combine_file"));			
			}else{																//If no files are selected or more than one file is selected, create error message
				$this->session->set_userdata('error_message', array('error' => 'Please choose one file!!' ));
				redirect(base_url("index.php/upload/show_files"));						//Reload controller
			}
		}
		if($this->input->post('Split_File')!=""){
			if($current=="./uploads/combined_file/" ||$current=="./uploads/divided/" ){//If no folder name is entered, create error message
				$this->session->set_userdata('error_message', array('error' => 'You have no permission to split files in this folder!!' ));
				redirect(base_url("index.php/upload/show_files"));						//Reload controller	
			}
			if(($split_file =$this->input->post('choose_file'))!="" && sizeof($split_file)==1 && ($dir_group=$this->input->post('choose_dir'))==""){
				$this->session->set_userdata('split_filename',$split_file[0]);
				$this->session->set_userdata('split_filepath', $current . $split_file[0]);
				redirect(base_url("index.php/splitfiles"));			
			}else{																//If no files are selected or more than one file is selected, create error message
				$this->session->set_userdata('error_message', array('error' => 'Please choose one file!!' ));
				redirect(base_url("index.php/upload/show_files"));						//Reload controller
			}
		}
		if($this->input->post('New_Folder')!=""){									//If create Folder Button is pressed
			if(($newdirname=$this->input->post("newdir_name"))!=""){				//If new folder name not empty redirect to create folder
				$this->session->set_userdata('newdir',$newdirname);
				redirect(base_url("index.php/upload/create_folder"));			
			}else{																	//If no folder name is entered, create error message
				$this->session->set_userdata('error_message', array('error' => 'You did not enter any folder name!' ));
				redirect(base_url("index.php/upload/show_files"));						//Reload controller			
			}
		}

		if($this->input->post('Delete')!=""){									//Delete Button is pressed
			if($current=="./uploads/divided/" || $current == "./uploads/combined_file/"){
				$this->session->set_userdata('error_message', array('error' => 'You have no permission to delete files in this folder!!' ));
				redirect(base_url("index.php/upload/show_files"));						//Reload controller	
			}				
			if(($files_group =$this->input->post('choose_file'))!=""){			//If  some files are selected, redirect to delete file
				$this->session->set_userdata('files_group', $files_group);
				redirect(base_url("index.php/upload/delete_files"));			
			} 
			if(($dir_group=$this->input->post('choose_dir'))!=""){				//If some directories are selected redirect to delete dir
				$this->session->set_userdata('dir_group', $dir_group);
				redirect(base_url("index.php/upload/delete_dir"));							
			}else{																//If no files are selected, create error message
				$this->session->set_userdata('error_message', array('error' => 'You did not select any files or folders!!' ));
				redirect(base_url("index.php/upload/show_files"));						//Reload controller
			}
		}
		if($this->input->post()){
			if($this->input->post('parent_dir')!=""){			//If parent directory is chosen and it's not ./uploads/, cut the current path and change current directory path
				if($current != "./uploads/"){
					$array = explode('/',$current);
					$current = $array[0] . '/';
					for($i=1; $i< sizeof($array)-2; $i++){
						$current = $current .  $array[$i] . '/';
					}
					$this->session->set_userdata('currentfolder',  $current);		
				}		
			}
		 	if($this->input->post('dir_name')!=""){								//If subdirectories are chosen, change current directory path
				$this->session->set_userdata('currentfolder',$current . $this->input->post('dir_name') . "/");
				$current = $current . $this->input->post('dir_name') . "/";
			}
			$data['visibility'] = "hidden"; 			
			$data['map'] = directory_map($current);									//Get current directory (has moved) content
			$this->session->set_userdata('error_message', array('error' => ' ' ));	//Empty error message
			$this->load->view('displayfiles', $data);								//Load views 
			$this->load->view('upload_form', array('error' => ' ' ));	
			redirect(base_url("index.php/upload/show_files"));						//Reload controller
		}
		$data['map'] = directory_map($current);	
		$data['current'] =$current;								//Display current directory content
		$this->load->view('displayfiles', $data);
		$this->load->view('upload_form', $error_message);	
	}

	function do_upload()
	{
		$current = $this->session->userdata('currentfolder');						//Get current directory path
		// File types
		$pictures = 'gif|jpg|png';
		$microsoft = 'doc|cls|ppt|xls|docx|ppt';
		$adobe = 'pdf';
		$text = 'txt|text';
		$web = 'html|js|php|css';
		$config['upload_path'] = $current;
		$config['allowed_types'] = $pictures . '|' . $microsoft . '|' . $adobe . '|' . $web . '|' . $text;
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);
		if ( (!$this->upload->do_upload()) && ($this->input->post('upload')!=""))	//If upload button is pressed and cannnot upload
		{
			$error = array('error' => $this->upload->display_errors());				//Get error message
			$this->session->set_userdata('error_message', $error);					
			redirect(base_url("index.php/upload/show_files"));						//Load show_files controller
		}
		else
		{
			$this->session->set_userdata('error_message', array('error' => ' ' ));
			$data = array('upload_data' => $this->upload->data());
			$data['current'] = $current;
			$this->file->insertFile($data['upload_data']['file_name'], $data['upload_data']['file_type'], $current . $data['upload_data']['file_name']); //url: e.g. "./uploads/folder/TextSample";
			$this->load->view('upload_success', $data);
		}
	}	
	
	
	function delete_files(){	
		$current = $this->session->userdata('currentfolder');		//Get current directorypath
		$files_group=$this->session->userdata('files_group'); 		//Get files that are selected
		$data['delete_items'] = array();									//Create an array and store the files name in it for displaying file name in delete_success view
		$error_occur = false;
		foreach ($files_group as $iterm => $value){
			array_push($data['delete_items'], $current . $value);
			$split_filename=strtr($value,".","_");
			if(file_exists("./uploads/divided/" . $split_filename . "part1")){
				unlink("./uploads/divided/" . $split_filename . "part1");
				unlink("./uploads/divided/" . $split_filename . "part2");
				unlink("./uploads/divided/" . $split_filename . "part3");
				if(!$this->file->deleteSplitedFiles($current . $value)){
					$error_occur = true; 
				}
			}
			if(!$error_occur &&!$this->file->deleteFile($current . $value)){		//If database does not have the file show error message
				$error_occur = true;
			}
			if($error_occur){
				$this->session->set_userdata('error_message', array('error' => 'Delete '. $current . $value .' unsuccessful!'));	//Create error message
				redirect(base_url("index.php/upload/show_files"));						//Load show_files controller
			}
			unlink($current . $value);			
		}
		$this->load->view('delete_success', $data);					//If deleting succeeds, Load delete_success view 
	}

	function delete_dir(){
		$current = $this->session->userdata('currentfolder');//Get current directory path
		$dir_group = $this->session->userdata('dir_group'); //Get directories that are selected
		$data['delete_items'] = array();//Create an array and store the directories' names in it for displaying file name in delete_success view
		foreach ($dir_group as $item => $value){
			array_push($data['delete_items'], $current . $value);
			if($current . $value == "./uploads/combined_file" || $current . $value == "./uploads/divided"){
				$this->session->set_userdata('error_message', array('error' => 'You have no permission to delete this folder!'));	//Create error message
				redirect(base_url("index.php/upload/show_files"));						//Load show_files controller				
			}
			$this->file->deleteFolder($current . $value);//Delete folder content in database
			delete_files($current . $value, true);//delete all files in that folder
			rmdir($current . $value);//Remove directory			
		}
		$this->load->view('delete_success', $data);//Load delete_success view 
	}
	function create_folder(){
		$current = $this->session->userdata('currentfolder');						//Get Current directory path
		$newdirname=$this->session->userdata('newdir');								//Get new directory name
		$newdirname=strtr($newdirname," ","_");										//Translate space to "_" to avoid mistakes
		if(!mkdir($current . $newdirname)){											//Check if already exists, show error message, if not, create folder
			$this->session->set_userdata('error_message', array('error' => 'The Folder exists in current directory!'));	//Create error message
			redirect(base_url("index.php/upload/show_files"));						//Load show_files
		}
		$data['foldername'] = $current .$newdirname;								
		$this->load->view('create_success',$data);									//Load create_success view
	}
}
?>