<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="mahasiswa") {
			redirect('');
		}
	}

	function index(){
		$id_users = $this->session->userdata('id_users');
		$data['view'] = 'v_produk';
		$data['title'] = 'Produk';
		$data['side'] = 'index';
		$data['produk'] = $this->db->query("SELECT a.*, kategori.nama kategori FROM produk a 
			JOIN kategori USING(id_kategori) WHERE a.id_users = '$id_users'")->result();
		$this->master($data);
	}
	function tambah(){
		$data['view'] = 'v_produk_add';
		$data['title'] = 'Produk';
		$data['side'] = 'tambah';
		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE aktif = '1'")->result();
		$this->master($data);
	}
	function add(){
		if($this->input->post('submit')){
			$id_kategori = $this->input->post('kategori');
			$id_users = $this->session->userdata('id_users');
			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$harga = $this->input->post('harga');
			$aktif = $this->input->post('status');
			
			$data_insert = array(
				'id_kategori' => $id_kategori,
				'id_users' => $id_users,
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'harga' => $harga,
				'aktif' => $aktif
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

			redirect('mahasiswa/produk');
		}else{
			redirect('mahasiswa');
		}
	}

	function edit($id = null){
		if(strlen($id) > 0){
			$id_users = $this->session->userdata('id_users');
			$produk = $this->db->query("SELECT * FROM produk WHERE id_produk = '$id' AND id_users = '$id_users'")->row_array();

			if(count($produk) > 0){

				$data['view'] = 'v_produk_edit';
				$data['title'] = 'Produk';
				$data['side'] = 'index';
				$data['produk'] = $produk;
				$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE aktif = '1'")->result_array();
				$this->master($data);

			}else{
				
				redirect('mahasiswa');	

			}
		}else{
				
				redirect('mahasiswa/produk');

		}
	}

	function update(){
				$id_kategori = $this->input->post('kategori');
				$nama = $this->input->post('nama');
				$deskripsi = $this->input->post('deskripsi');
				$harga = $this->input->post('harga');

				$aktif = $this->input->post('status');
				$id_produk = $this->input->post('id');
				
		if($this->input->post('submit')){
			$id_users = $this->session->userdata('id_users');
			$produk = $this->db->query("SELECT * FROM produk WHERE id_produk = '$id_produk' AND id_users = '$id_users'")->result();
			if(count($produk) == 1){
				
				$data_update = array(
					'id_kategori' => $id_kategori,
					'nama' => $nama,
					'deskripsi' => $deskripsi,
					'harga' => $harga,
					'aktif' => $aktif
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
			}
			redirect('mahasiswa/produk/edit/'.$id_produk);
		} else{
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