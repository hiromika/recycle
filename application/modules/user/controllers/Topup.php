<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')!="user") {
			redirect('user/login');
		}
		redirect('');
	}

	function index(){
		// $data['view'] = 'v_topup';
		// $data['title'] = 'Topup';
		// $data['side'] = 'index';
		// $data['topup'] = $this->db->query('SELECT * FROM topup')->result();
		// $this->master($data);
		redirect('user/topup/history');
	}
	function history(){
		$username = $this->session->userdata('username');
		if(strlen($username) > 0){
			$data['view'] = 'v_history_topup';
			$data['title'] = 'Topup';
			$data['side'] = 'history';
			$data['history'] = $this->db->query("SELECT * FROM topup WHERE username = '$username'")->result();
			$this->master($data);
		}else{
			redirect('user');
		}
	}
	function detail_history($id = null){
		$username = $this->session->userdata('username');
		if(strlen($id) > 0){
			$data['view'] = 'v_history_topup_detail';
			$data['title'] = 'Topup';
			$data['side'] = 'history';
			$data['detail'] = $this->db->query("SELECT a.*, b.nama FROM topup a JOIN users b USING(username) WHERE id_topup = '$id' AND username = '$username'")->result()[0];
			$this->master($data);
		}else{
			redirect('user');
		}
	}
	function tambah(){
		$data['view'] = 'v_topup_add';
		$data['title'] = 'Topup';
		$data['side'] = 'tambah';
		$this->master($data);
	}
	function add(){
		if($this->input->post('submit')){
			$username = $this->session->userdata('username');
			$keterangan = $this->input->post('keterangan');
			$jumlah = $this->input->post('jumlah');
			
			$data_insert = array(
				'username' => $username,
				'keterangan' => $keterangan,
				'jumlah' => $jumlah,
				'validasi' => '1',
			);
			$this->db->insert('topup',$data_insert);
			$id = $this->db->insert_id();

			$path = realpath('./bukti');
			$config['upload_path']    = $path;            
			$config['allowed_types']  = 'jpg|png';
			$config['max_size']       = '50000';
			$config['file_name']      = $id;
			$config['overwrite'] 	  = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('bukti')){
				$img_data=$this->upload->data();
				$file = array('extensi' => $img_data['file_ext'] , );
				$this->db->where('id_topup',$id);
				$this->db->update('topup',$file);
			}

			redirect('user/topup');
		}else{
			redirect('user');
		}
	}
	function edit($id = null){
		if(strlen($id) > 0){
			$data['view'] = 'v_topup_edit';
			$data['title'] = 'Topup';
			$data['side'] = 'index';
			$data['topup'] = $this->db->query("SELECT * FROM topup WHERE username = '$id'")->result()[0];
			$this->master($data);
		}else{
			redirect('user');
		}
	}

	private function master($data){
		$this->load->view('master/header', $data);
		$this->load->view('master/topbar');
		$this->load->view('master/sidebar', $data);
		$this->load->view($data['view'], $data);
		$this->load->view('master/footer');
	}
}
