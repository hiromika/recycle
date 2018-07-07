<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="mahasiswa") {
			redirect('mahasiswa/login');
		}
	}

	function index(){
		// $data['view'] = 'v_topup';
		// $data['title'] = 'Topup';
		// $data['side'] = 'index';
		// $data['topup'] = $this->db->query('SELECT * FROM topup')->result();
		// $this->master($data);
		redirect('mahasiswa/topup/history');
	}
	function history(){
		$id_users = $this->session->userdata('id_users');
		if(strlen($id_users) > 0){
			$data['view'] = 'v_history_topup';
			$data['title'] = 'Topup';
			$data['side'] = 'history';
			$data['history'] = $this->db->query("SELECT * FROM topup WHERE id_users = '$id_users'")->result();
			$this->master($data);
		}else{
			redirect('mahasiswa');
		}
	}
	function detail_history($id = null){
		$id_users = $this->session->userdata('id_users');
		if(strlen($id) > 0){
			$data['view'] = 'v_history_topup_detail';
			$data['title'] = 'Topup';
			$data['side'] = 'history';
			$data['detail'] = $this->db->query("SELECT a.*, b.nama, b.nim FROM topup a JOIN users b USING(id_users) WHERE id_topup = '$id' AND id_users = '$id_users'")->result()[0];
			$this->master($data);
		}else{
			redirect('mahasiswa');
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
			$id_users = $this->session->userdata('id_users');
			$jumlah = $this->input->post('jumlah');
			
			$data_insert = array(
				'id_users' => $id_users,
				'keterangan' => 'TopUp',
				'jumlah' => $jumlah,
				'validasi' => '0',
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

			redirect('mahasiswa/topup');
		}else{
			redirect('mahasiswa');
		}
	}
	function edit($id = null){
		if(strlen($id) > 0){
			$data['view'] = 'v_topup_edit';
			$data['title'] = 'Topup';
			$data['side'] = 'index';
			$data['topup'] = $this->db->query("SELECT * FROM topup WHERE id_users = '$id'")->result()[0];
			$this->master($data);
		}else{
			redirect('mahasiswa');
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

?>