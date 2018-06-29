<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="admin") {
			redirect('admin/login');
		}
	}

	function index(){
		$data['view'] = 'v_kategori';
		$data['title'] = 'Kategori';
		$data['side'] = 'index';
		$data['kategori'] = $this->db->query('SELECT * FROM kategori')->result();
		$this->master($data);
	}
	function tambah(){
		$data['view'] = 'v_kategori_add';
		$data['title'] = 'Kategori';
		$data['side'] = 'tambah';
		$this->master($data);
	}
	function add(){
		if($this->input->post('submit')){
			$nama = $this->input->post('nama');
			$aktif = $this->input->post('status');
			
			$data_insert = array(
				'nama' => $nama,
				'aktif' => $aktif
			);
			$this->db->insert('kategori',$data_insert);
			$id = $this->db->insert_id();

			$path = realpath('./kategori');
			$config['upload_path']    = $path;            
			$config['allowed_types']  = 'jpg|png';
			$config['max_size']       = '50000';
			$config['file_name']      = $id;
			$config['overwrite'] 	  = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('foto')){
				$img_data=$this->upload->data();
				$file = array('extensi' => $img_data['file_ext'] , );
				$this->db->where('id_kategori',$id);
				$this->db->update('kategori',$file);
			}
			redirect('admin/kategori');
		}else{
			redirect('admin');
		}
	}
	function edit($id = null){
		if($id > 0){
			$data['view'] = 'v_kategori_edit';
			$data['title'] = 'Kategori';
			$data['side'] = 'index';
			$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE id_kategori = '$id'")->result()[0];
			$this->master($data);
		}else{
			redirect('admin');
		}
	}
	function update(){
		if($this->input->post('submit')){
			$id_kategori = $this->input->post('id');
			$nama = $this->input->post('nama');
			$aktif = $this->input->post('status');
			
			$data_update = array(
				'nama' => $nama,
				'aktif' => $aktif
			);
			$this->db->where('id_kategori',$id_kategori);
			$this->db->update('kategori',$data_update);

			$path = realpath('./kategori');
			$config['upload_path']    = $path;            
			$config['allowed_types']  = 'jpg|png';
			$config['max_size']       = '50000';
			$config['file_name']      = $id_kategori;
			$config['overwrite'] 	  = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('foto')){
				$img_data=$this->upload->data();
				$file = array('extensi' => $img_data['file_ext'] , );
				$this->db->where('id_kategori',$id_kategori);
				$this->db->update('kategori',$file);
			}
			redirect('admin/kategori');
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
		$this->db->where('id_kategori', $id);
		$this->db->delete('kategori');
		redirect('admin/kategori');
	}
}
