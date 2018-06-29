<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_panel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}
	

	function doLogin($data){

		$this->db->where('username', $data['username']);
		$this->db->where('password', md5($data['password']));
		$this->db->where('aktif', '1');
		return $this->db->get('users')->row_array();

	}


}

/* End of file model_panel.php */
/* Location: ./application/models/model_panel.php */