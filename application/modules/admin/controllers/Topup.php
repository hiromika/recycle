<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="admin") {
			redirect('admin/login');
		}
	}

	function index(){
		// $data['view'] = 'v_topup';
		// $data['title'] = 'Topup';
		// $data['side'] = 'index';
		// $data['topup'] = $this->db->query('SELECT * FROM topup')->result();
		// $this->master($data);
		redirect('admin/topup/konfirmasi');
	}
	function konfirmasi(){
		$data['view'] = 'v_topup_konfirmasi';
		$data['title'] = 'Topup';
		$data['side'] = 'konfirmasi';
		$data['topup'] = $this->db->query("SELECT topup.*, users.nama FROM topup join users using(id_users) WHERE validasi = '0' AND users.level ='mahasiswa' ")->result();
		$this->master($data);
	}
	function konfirmasi_users(){
		redirect('admin');
		// $data['view'] = 'v_topup_users_konfirmasi';
		// $data['title'] = 'Topup';
		// $data['side'] = 'konfirmasi users';
		// $data['topup'] = $this->db->query("SELECT a.*, b.nama FROM topup_user a join users b using(id_users) WHERE validasi = '0'")->result();
		// $this->master($data);
	}
	function tambah(){
		$data['view'] = 'v_topup_add';
		$data['title'] = 'Topup';
		$data['side'] = 'tambah mahasiswa';
		$data['mahasiswa'] = $this->db->query('SELECT * FROM users WHERE level = "mahasiswa"')->result();
		$this->master($data);
	}
	function add(){
		if($this->input->post('submit')){
			$nim = $this->input->post('nim');
			$keterangan = $this->input->post('keterangan');
			$jumlah = $this->input->post('jumlah');
			
			$data_insert = array(
				'nim' => $nim,
				'keterangan' => $keterangan,
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

			redirect('admin/topup');
		}else{
			redirect('admin');
		}
	}

	function addSaldo(){
		$data = $this->input->post();

		$obj = array(
			'id_users' 		=> $data['id_users'],
			'jumlah'		=> $data['jumlah'],
			'keterangan' 	=> $data['keterangan'],
			'validasi'		=> '1'
		);
		$this->db->insert('topup', $obj);

		if ($data['sts'] == 3) {
			redirect('admin/users/detail/'.$data['id_users'],'refresh');
		}else{
			redirect('admin/mahasiswa/detail/'.$data['id_users'],'refresh');
			
		}

	}
	
	function editSaldo(){
		$data = $this->input->post();

		$obj = array(
			'jumlah'		=> $data['jumlah'],
			'keterangan' 	=> $data['keterangan'],
			'validasi'		=> $data['validasi']
		);
		$this->db->where('id_topup', $data['id_topup']);
		$this->db->update('topup', $obj);

		if ($data['sts'] == 3) {
			redirect('admin/users/detail/'.$data['id_users'],'refresh');
		}else{
			redirect('admin/mahasiswa/detail/'.$data['id_users'],'refresh');
		}

	}

	function doDelete($id,$id_users,$sts){


		$this->db->where('id_topup', $id);
		$this->db->delete('topup');
		if ($sts == 3) {
			redirect('admin/users/detail/'.$id_users,'refresh');
		}else{
			redirect('admin/mahasiswa/detail/'.$id_users,'refresh');
		}
	}

	function validasi($id = null){
		if($id > 0){
			
			$data_update = array(
				'validasi' => '1'
			);
			$this->db->where('id_topup',$id);
			$this->db->update('topup',$data_update);
			redirect('admin/topup');
		}else{
			redirect('admin');
		}
	}

	function tambah_users(){
		redirect('admin');
		// $data['view'] = 'v_topup_users_add';
		// $data['title'] = 'Topup';
		// $data['side'] = 'tambah users';
		// $data['users'] = $this->db->query('SELECT * FROM users')->result();
		// $this->master($data);
	}
	function add_users(){
		redirect('admin');
		// if($this->input->post('submit')){
		// 	$id_users = $this->input->post('id_users');
		// 	$keterangan = $this->input->post('keterangan');
		// 	$jumlah = $this->input->post('jumlah');
			
		// 	$data_insert = array(
		// 		'id_users' => $id_users,
		// 		'keterangan' => $keterangan,
		// 		'jumlah' => $jumlah,
		// 		'validasi' => '0',
		// 	);
		// 	$this->db->insert('topup_user',$data_insert);
		// 	$id = $this->db->insert_id();

		// 	$path = realpath('./bukti_users');
		// 	$config['upload_path']    = $path;            
		// 	$config['allowed_types']  = 'jpg|png';
		// 	$config['max_size']       = '50000';
		// 	$config['file_name']      = $id;
		// 	$config['overwrite'] 	  = TRUE;
		// 	$this->load->library('upload', $config);
		// 	if($this->upload->do_upload('bukti')){
		// 		$img_data=$this->upload->data();
		// 		$file = array('extensi' => $img_data['file_ext'] , );
		// 		$this->db->where('id_topup_user',$id);
		// 		$this->db->update('topup_user',$file);
		// 	}

		// 	redirect('admin/topup');
		// }else{
		// 	redirect('admin');
		// }
	}
	
	function validasi_users($id = null){
		redirect('admin');
		// if($id > 0){
			
		// 	$data_update = array(
		// 		'validasi' => '1'
		// 	);
		// 	$this->db->where('id_topup_user',$id);
		// 	$this->db->update('topup_user',$data_update);
		// 	redirect('admin/topup');
		// }else{
		// 	redirect('admin');
		// }
	}

	private function master($data){
		$this->load->view('master/header', $data);
		$this->load->view('master/topbar');
		$this->load->view('master/sidebar', $data);
		$this->load->view($data['view'], $data);
		$this->load->view('master/footer');
	}
}
