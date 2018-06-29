<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iklan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('level')!="mahasiswa") {
			redirect('mahasiswa/login');
		}
	}

	public function index(){
		$id_users = $this->session->userdata('id_users');
		$data['view'] = 'v_iklan';
		$data['title'] = 'Produk';
		$data['side'] = 'index';
		$data['iklan'] = '';
		$this->master($data);
	}

	private function master($data){
		$this->load->view('master/header', $data);
		$this->load->view('master/topbar');
		$this->load->view('master/sidebar', $data);
		$this->load->view($data['view'], $data);
		$this->load->view('master/footer');
	}
}

/* End of file Iklan.php */
/* Location: ./application/modules/mahasiswa/controllers/Iklan.php */