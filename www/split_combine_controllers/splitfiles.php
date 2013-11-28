<?php

class Splitfiles extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');			
	}

	function index() 				//initialize data
	{
		redirect(base_url("index.php/splitfiles/spliting_file"));
	}
	function tobinary($data){
	
	}
	
	public function spliting_file(){
		$spliting_file_path= $this->session->userdata('split_filepath');
		$split_filename= $this->session->userdata('split_filename');
		$split_filename=strtr($split_filename,".","_");
		$content_Data = file_get_contents($spliting_file_path);
		$value = unpack('H*', $content_Data);			// Unpack as a hexadecimal string
		ini_set('memory_limit', '-1');			// set to be unlimited memory available
		$value = str_split($value[1], 1);		// Output binary representation
		$binary_result = '';								
		foreach ($value as $hex)
		{
			$binary = str_pad(base_convert($hex, 16, 2), 4, '0', STR_PAD_LEFT);
			$binary_result .= $binary;						// Append binary number
		}
		$thirdth =  round(strlen($binary_result)/3);
		$part1 = substr($binary_result, 0, $thirdth);
		$part2 = substr($binary_result, $thirdth, -$thirdth);
		$part3 = substr($binary_result, -$thirdth,strlen($binary_result));
		$part1url = "./uploads/divided/" . $split_filename . "part1";
		$part2url = "./uploads/divided/" . $split_filename . "part2";
		$part3url = "./uploads/divided/" . $split_filename . "part3";
		file_put_contents ($part1url,$part1);	
		file_put_contents ($part2url,$part2);	
		file_put_contents ($part3url,$part3);	

		$data['filename'] = $split_filename;
		$this->file->insertsplitedFiles($spliting_file_path,$part1url, $part2url,$part3url); 
		$this->load->view('split_success',$data);
	}
	function combine_file(){
		$filename= $this->session->userdata('combine_filename');
		$array = explode('.',$filename);
		$filetype = $array[sizeof($array)-1];
		$combine_filename=strtr($filename,".","_");
		$part1_path ="./uploads/divided/". $combine_filename . "part1";
		$part2_path ="./uploads/divided/". $combine_filename . "part2";
		$part3_path ="./uploads/divided/". $combine_filename . "part3";
		if(!file_exists($part1_path)){
			$this->session->set_userdata('error_message', array('error' =>  $combine_filename . ' file has not been divided!'));	//Create error message
			redirect(base_url("index.php/upload/show_files"));	
		}
		$part1_bin = file_get_contents($part1_path);
		$part2_bin = file_get_contents($part2_path);
		$part3_bin = file_get_contents($part3_path);
		
		file_put_contents ( "./uploads/divided/finalfile" ,$part1_bin);
		file_put_contents (	"./uploads/divided/finalfile" ,$part2_bin, FILE_APPEND);	
		file_put_contents ( "./uploads/divided/finalfile" ,$part3_bin, FILE_APPEND);	
		
		$final_binary_file = file_get_contents("./uploads/divided/finalfile");
		$content = $this->convert_from_binary($final_binary_file);		
		file_put_contents ( "./uploads/combined_file/" . $filename ,$content);
		$data['filename'] = $combine_filename;
		$this->file->insertFile($filename, $filetype, "./uploads/combined_file/" . $filename); //url: e.g. "./uploads/folder/TextSample";
		unlink("./uploads/divided/finalfile");			
		$this->load->view('combine_success',$data);
	 }
	 function convert_from_binary($input){
		ini_set('memory_limit', '-1');			// set to be unlimited memory available
		// Pack into a string
		$input = str_split($input, 4);
		$output = '';
		foreach ($input as $value)
		{
		$output .= base_convert($value, 2, 16);
		}
		$output = pack('H*', $output);	
		return $output;
	}	
}
?>


