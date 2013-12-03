<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	class File extends CI_Model
	{
		public function insertFile ($filename, $filetype, $url)
		{
			$data = array(
			   'filename' => $filename,
			   'filetype' => $filetype,
			   'url' => $url
			);
			$this->db->insert('file', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}
		public function deleteFile($url){
			$this->db->delete('file', array('url' => $url)); 
			return ($this->db->affected_rows() != 1) ? false : true;
		}
		public function deleteFolder($url){
			$this->db->like('url', $url, 'after');
			$this->db->delete('file'); 
			return ($this->db->affected_rows() != 1) ? false : true;			
		}
		public function insertsplitedFiles($fileurl, $part1url, $part2url,$part3url){
   			$this->db->where('url',$fileurl);
			$query = $this->db->get('file');
			$result = $query->result_array();			
			$fileid = $result[0]['id'];

			$data = array(
			   'fileid' => $fileid,
			   'urlone' => $part1url,
			   'urltwo' => $part2url,
			   'urlthree' => $part3url
			);
			$this->db->insert('splitedfiles', $data);
			return ($this->db->affected_rows() != 1) ? false : true;		
		}
		public function deleteSplitedFiles($fileurl){
   			$this->db->where('url',$fileurl);
			$query = $this->db->get('file');
			$result = $query->result_array();
			$fileid = $result[0]['id'];
   			$this->db->where('fileid',$fileid);
			$this->db->delete('splitedfiles');
			return ($this->db->affected_rows() != 1) ? false : true;
		}
		
	}
?>