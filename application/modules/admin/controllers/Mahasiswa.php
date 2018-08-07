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
				'nim'		=> $nim,
				'nama' 		=> $nama,
				'aktif' 	=> $aktif,
				'level'		=> 'mahasiswa',
				'password'	=> md5($username),

			);
			$this->db->insert('users',$data_insert);
			$id = $this->db->insert_id();
			$path = realpath('./ktm');
			$config['upload_path']    = $path;            
			$config['allowed_types']  = 'jpg|png';
			$config['max_size']       = '50000';
			$config['file_name']      = $id;
			$config['overwrite'] 	  = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('ktm')){
				$img_data=$this->upload->data();
				$file = array('extensi' => $img_data['file_ext'] , );
				$this->db->where('id_users',$id);
				$this->db->update('users',$file);
			}
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
			$data['mahasiswa'] = $this->db->query("SELECT a.*, SUM(jumlah) as jum FROM users a LEFT JOIN topup b USING(id_users) WHERE a.id_users = '$id'")->result()[0];
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
			$jum = $this->input->post('jumlah');

			$get = $this->db->query("SELECT SUM(jumlah) as jum FROM topup WHERE id_users = '$id_users'")->row_array();
			
			if ($jum > $get['jum']) {
				$saldo = $jum - $get['jum'];
				$object = array(
				 'id_users' 	=> $id_users,
				 'keterangan'	=> 'Edit by admin',
				 'jumlah'		=> $saldo,
				 'validasi'		=> '1'
				);
				$this->db->insert('topup', $object);

				$data_update = array(
					'nim' => $nim,
					'nama' => $nama,
					'aktif' => $aktif
				);
				$this->db->where('id_users',$id_users);
				$this->db->update('users',$data_update);

				$path = realpath('./ktm');
				$config['upload_path']    = $path;            
				$config['allowed_types']  = 'jpg|png';
				$config['max_size']       = '50000';
				$config['file_name']      = $id_users;
				$config['overwrite'] 	  = TRUE;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('ktm')){
					$img_data=$this->upload->data();
					$file = array('extensi' => $img_data['file_ext'] , );
					$this->db->where('id_users',$id_users);
					$this->db->update('users',$file);
					redirect('admin/mahasiswa');
				}
				
				redirect('admin/mahasiswa');

			
			}elseif ($jum < $get['jum']) {
				$saldo = $get['jum']- $jum;
				$object = array(
				 'id_users' 	=> $id_users,
				 'keterangan'	=> 'Edit by admin',
				 'jumlah'		=> '-'.$saldo,
				 'validasi'		=> '1'
				);
				$this->db->insert('topup', $object);

				$data_update = array(
					'nim' => $nim,
					'nama' => $nama,
					'aktif' => $aktif
				);
				$this->db->where('id_users',$id_users);
				$this->db->update('users',$data_update);

				$path = realpath('./ktm');
				$config['upload_path']    = $path;            
				$config['allowed_types']  = 'jpg|png';
				$config['max_size']       = '50000';
				$config['file_name']      = $id_users;
				$config['overwrite'] 	  = TRUE;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('ktm')){
					$img_data=$this->upload->data();
					$file = array('extensi' => $img_data['file_ext'] , );
					$this->db->where('id_users',$id_users);
					$this->db->update('users',$file);
					redirect('admin/mahasiswa');
				}
			
				redirect('admin/mahasiswa');
				
			}
			
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
