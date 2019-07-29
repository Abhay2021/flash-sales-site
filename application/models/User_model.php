<?php
/**
* 
*/
class User_model extends CI_Model
{

	public function get_user_info($id){
		$query =$this->db->query("SELECT `id`, `username`, `admin`, active  FROM users WHERE id='$id'");
		if($query->num_rows() == 1){
			$userinfo = $query->result();
			//print_r($userinfo);exit;
			return $userinfo;
		}

	}
}
?>