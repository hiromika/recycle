<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="3") {
				echo '<script type="text/javascript">'; 
				echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
				echo '</script>';
		}
		redirect('');
	}

	function index(){
		redirect('');
		// $data['view'] = 'v_user';
		// $this->master($data);
	}

	private function master($data){
		$this->load->view('master/header');
		$this->load->view('master/topbar');
		$this->load->view('master/sidebar', $data);
		$this->load->view($data['view'], $data);
		$this->load->view('master/footer');
	}
}
