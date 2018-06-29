<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="mahasiswa") {
			redirect('mahasiswa/login');
		}
	}

	function index(){
		redirect('');
		// $data['view'] = 'v_mahasiswa';
		// $this->master($data);
	}

	function profile(){
		$data['title'] = 'Profile';
		$data['side'] = 'profile';
		$data['view'] = 'v_profile';
		$this->master($data);
	}

	private function master($data){
		$this->load->view('master/header');
		$this->load->view('master/topbar');
		$this->load->view('master/sidebar', $data);
		$this->load->view($data['view'], $data);
		$this->load->view('master/footer');
	}
}
?>