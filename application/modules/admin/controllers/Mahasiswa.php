<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="admin") {
			redirect('admin/login');
		}
	}

	function index(){
		$data['view'] = 'v_mahasiswa';
		$data['title'] = 'Mahasiswa';
		$data['side'] = 'index';
		$data['mahasiswa'] = $this->db->query("SELECT a.id_users, a.nim, a.nama, COALESCE(SUM(case when b.validasi = '1' then b.jumlah end),0) saldo, a.aktif FROM users a LEFT JOIN topup b USING(id_users) WHERE level = 'mahasiswa' GROUP BY a.id_users, a.nama, a.aktif")->result();
		$this->master($data);
	}
	function detail($id_users = null){

		if(strlen($id_users) > 0){
			$data['id_users'] = $id_users;
			$data['view'] = 'v_mahasiswa_history_topup';
			$data['title'] = 'Mahasiswa';
			$data['side'] = 'index';
			$data['history'] = $this->db->query("SELECT * FROM topup WHERE id_users = '$id_users'")->result();
			$data['mhs']  =  $this->db->query("SELECT * FROM users WHERE id_users = '$id_users'")->row_array();
			$data['totsaldo'] = $this->db->query("SELECT SUM(jumlah) AS saldo FROM topup WHERE id_users = '$id_users' AND validasi = '1'")->row_array();
			$this->master($data);
		}else{
			redirect('admin');
		}
	}
	function detail_history($id = null){
		if(strlen($id) > 0){
			$data['view'] = 'v_mahasiswa_history_topup_detail';
			$data['title'] = 'Mahasiswa';
			$data['side'] = 'index';
			$data['detail'] = $this->db->query("SELECT *, b.nama FROM topup a JOIN users b USING(id_users) WHERE id_topup = '$id'")->result()[0];
			$this->master($data);
		}else{
			redirect('admin');
		}
	}
	function tambah(){
		$data['view'] = 'v_mahasiswa_add';
		$data['title'] = 'Mahasiswa';
		$data['side'] = 'tambah';
		$this->master($data);
	}
	function add(){
		if($this->input->post('submit')){
			$nim = $this->input->post('nim');
			$nama = $this->input->post('nama');
			$aktif = $this->input->post('status');
			
			$data_insert = array(
				'nim'	=> $nim,
				'nama' => $nama,
				'aktif' => $aktif,
				'level'	=> 'mahasiswa'
			);
			$this->db->insert('users',$data_insert);
			redirect('admin/mahasiswa');
		}else{
			redirect('admin');
		}
	}
	function edit($id = null){
		if(strlen($id) > 0){
			$data['view'] = 'v_mahasiswa_edit';
			$data['title'] = 'Mahasiswa';
			$data['side'] = 'index';
			$data['mahasiswa'] = $this->db->query("SELECT * FROM users WHERE id_users = '$id'")->result()[0];
			$this->master($data);
		}else{
			redirect('admin');
		}
	}
	function update(){
		if($this->input->post('submit')){
			$id_users = $this->input->post('id_users');
			$nim = $this->input->post('nim');
			$nama = $this->input->post('nama');
			$aktif = $this->input->post('status');
			
			$data_update = array(
				'nim' => $nim,
				'nama' => $nama,
				'aktif' => $aktif
			);
			$this->db->where('id_users',$id_users);
			$this->db->update('users',$data_update);
			redirect('admin/mahasiswa');
		}else{
			redirect('admin');
		}
	}

	private function master($data){
		$this->load->view('master/header', $data);
		$this->load->view('master/topbar');
		$this->load->view('master/sidebar', $data);
		$this->load->view($data['view'], $data);
		$this->load->view('master/footer');
	}

	function doDelete($id){
		$this->db->where('id_users', $id);
		$this->db->delete('users');
		redirect('admin/mahasiswa');
	}
}
