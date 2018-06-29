<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="admin") {
			redirect('admin/login');
		}
	}

	function index(){
		$data['view'] = 'v_produk';
		$data['title'] = 'Produk';
		$data['side'] = 'index';
		$data['produk'] = $this->db->query('SELECT a.*, kategori.nama kategori, users.nama mahasiswa FROM produk a JOIN kategori USING(id_kategori) JOIN users USING(id_users) WHERE users.level = "mahasiswa"')->result();
		$this->master($data);
	}
	function tambah(){
		$data['view'] = 'v_produk_add';
		$data['title'] = 'Produk';
		$data['side'] = 'tambah';
		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE aktif = '1'")->result();
		$data['mahasiswa'] = $this->db->query("SELECT * FROM users WHERE aktif = '1' AND level = 'mahasiswa'")->result();
		$this->master($data);
	}
	function add(){
		if($this->input->post('submit')){
			$id_kategori = $this->input->post('kategori');
			$nim = $this->input->post('nim');
			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$harga = $this->input->post('harga');
			$aktif = $this->input->post('status');
			$iklan = $this->input->post('iklan');
			
			$data_insert = array(
				'id_kategori' => $id_kategori,
				'id_users' => $nim,
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'harga' => $harga,
				'aktif' => $aktif,
				'iklan' => $iklan,
			);
			$this->db->insert('produk',$data_insert);
			$id = $this->db->insert_id();

			$path = realpath('./produk');
			$config['upload_path']    = $path;            
			$config['allowed_types']  = 'jpg|png';
			$config['max_size']       = '50000';
			$config['file_name']      = $id;
			$config['overwrite'] 	  = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('foto')){
				$img_data=$this->upload->data();
				$file = array('extensi' => $img_data['file_ext'] , );
				$this->db->where('id_produk',$id);
				$this->db->update('produk',$file);

				$file = $id.$img_data['file_ext'];
				$origin = realpath('./produk').'/'.$file;
				$destination = realpath('./thumb').'/'.$file;
				ImageJPEG(ImageCreateFromString(file_get_contents($origin)), $destination, 25);
			}

			redirect('admin/produk');
		}else{
			redirect('admin');
		}
	}
	function edit($id = null){
		if(strlen($id) > 0){
			$data['view'] = 'v_produk_edit';
			$data['title'] = 'Produk';
			$data['side'] = 'index';
			$data['produk'] = $this->db->query("SELECT * FROM produk WHERE id_produk = '$id'")->result()[0];
			$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE aktif = '1'")->result();
			$data['mahasiswa'] = $this->db->query("SELECT * FROM users WHERE aktif = '1' AND level = 'mahasiswa'")->result();
			$this->master($data);
		}else{
			redirect('admin');
		}
	}
	function update(){
		if($this->input->post('submit')){
			$id_kategori = $this->input->post('kategori');
			$nim = $this->input->post('nim');
			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$harga = $this->input->post('harga');
			$aktif = $this->input->post('status');
			$iklan = $this->input->post('iklan');
			$id_produk = $this->input->post('id');
			
			$data_update = array(
				'id_kategori' => $id_kategori,
				'id_users' => $nim,
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'harga' => $harga,
				'aktif' => $aktif,
				'iklan' => $iklan,
			);
			$this->db->where('id_produk',$id_produk);
			$this->db->update('produk',$data_update);

			$path = realpath('./produk');
			$config['upload_path']    = $path;            
			$config['allowed_types']  = 'jpg|png';
			$config['max_size']       = '50000';
			$config['file_name']      = $id_produk;
			$config['overwrite'] 	  = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('foto')){
				$img_data=$this->upload->data();
				$file = array('extensi' => $img_data['file_ext'] , );
				$this->db->where('id_produk',$id_produk);
				$this->db->update('produk',$file);

				$file = $id_produk.$img_data['file_ext'];
				$origin = realpath('./produk').'/'.$file;
				$destination = realpath('./thumb').'/'.$file;
				ImageJPEG(ImageCreateFromString(file_get_contents($origin)), $destination, 25);
			}
			
			redirect('admin/produk');
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

		$this->db->where('id_produk', $id);
		$this->db->delete('produk');

		redirect('admin/produk');
	}
}
