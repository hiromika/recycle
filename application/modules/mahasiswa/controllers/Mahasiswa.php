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

		public function profile(){
		$data['title'] = 'Profile';
		$data['side'] = 'Profile';
		$data['view'] = 'v_profile';
		$this->db->where('id_users', $this->session->userdata('id_users'));
		$data['user'] = $this->db->get('users')->row_array();
		$this->master($data);	
	}

	public function upPro(){
		$data = $this->input->post();
		if ($data['password'] != null) {
			$object = array(
				'username' 	=> $data['username'],
				'nama'		=> $data['nama'],
				'alamat'	=> $data['alamat'],
				'kota_kab'	=> $data['kota_kab'],
				'telp'		=> $data['telp'],
				'email'		=> $data['email'],
				'nim'		=> $data['nim'],
				'nama_bank'	=> $data['nama_bank'],
				'no_rek'	=> $data['no_rek'],
				'password'	=> md5($data['password']),
			);
		}else{
			$object = array(
				'username' 	=> $data['username'],
				'nama'		=> $data['nama'],
				'alamat'	=> $data['alamat'],
				'kota_kab'	=> $data['kota_kab'],
				'telp'		=> $data['telp'],
				'email'		=> $data['email'],
				'nim'		=> $data['nim'],
				'nama_bank'	=> $data['nama_bank'],
				'no_rek'	=> $data['no_rek'],
			);
		}
		$this->db->where('id_users', $this->session->userdata('id_users'));
		$this->db->update('users', $object);

		redirect('mahasiswa/profile','refresh');
	}

	private function master($data){
		$this->load->view('master/header',$data);
		$this->load->view('master/topbar',$data);
		$this->load->view('master/sidebar', $data);
		$this->load->view($data['view'], $data);
		$this->load->view('master/footer');
	}

	function penjualan(){
		$data['title'] = 'Penjualan';
		$data['side'] = 'penjualan';
		$data['view'] = 'v_penjualan';
				$this->db->select('a.*, b.harga, b.extensi, b.deskripsi, b.nama as nama_p, c.nama as nama_penjual, d.status as sts_t, d.bukti_foto, e.nama as nama_pem, e.alamat as alamat_p, e.kota_kab as kota_kab_p, d.no_resi, d.resi_foto');
		$this->db->from('pembelian a');
		$this->db->join('produk b', 'b.id_produk = a.id_produk', 'left');
		$this->db->join('users c', 'c.id_users = b.id_users', 'left');
		$this->db->join('transaksi d', 'd.id_pem = a.id_pem', 'left');
		$this->db->join('users e', 'e.id_users = a.id_users', 'left');
		$this->db->where('b.id_users', $this->session->userdata('id_users'));
		$this->db->where('a.status >=', 1);
		$this->db->where('d.status >=', 1);
		$this->db->order_by('a.id_pem', 'desc');
		$data['produk'] = $this->db->get()->result_array();
		$this->master($data);	
	}

	function uploadResi(){
		$data = $this->input->post();

		$this->db->where('id_pem', $data['id_pem']);
		$idp = $this->db->get('pembelian')->row_array();

		$path = './bukti_resi';
			$config['upload_path']    = $path;            
			$config['allowed_types']  = 'jpg|png';
			$config['max_size']       = '50000';
			$config['overwrite'] 	  = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('foto')){
				$img_data=$this->upload->data();

				$object = array(
					'resi_foto' => $path.'/'.$img_data['file_name'],
					'no_resi' 	=> $data['no_resi'],
				);
				$this->db->where('id_pem', $data['id_pem']);
				$this->db->update('transaksi', $object);

				$this->db->where('id_pem', $data['id_pem']);
				$this->db->update('pembelian', array('status' => 2));

				$this->db->where('id_produk', $idp['id_produk']);
				$this->db->update('produk', array('status' => 1));

				$file = $img_data['file_name'];
				$origin = realpath('./bukti_resi').'/'.$file;
				$destination = realpath('./thumb').'/'.$file;
				ImageJPEG(ImageCreateFromString(file_get_contents($origin)), $destination, 25);
			}

		redirect($this->session->userdata('level').'/penjualan','refresh');	
	
	}

	public function pembelian(){
		$data['view'] = 'v_pembelian';
		$data['title'] = 'Pembelian';
		$data['side'] = 'Daftar';
		$this->db->select('a.*, b.harga, b.extensi, b.deskripsi, b.nama as nama_p, c.nama as nama_penjual, d.status as sts_t, d.bukti_foto, d.no_resi, d.resi_foto');
		$this->db->from('pembelian a');
		$this->db->join('produk b', 'b.id_produk = a.id_produk', 'left');
		$this->db->join('users c', 'c.id_users = b.id_users', 'left');
		$this->db->join('transaksi d', 'd.id_pem = a.id_pem', 'left');
		$this->db->where('a.id_users', $this->session->userdata('id_users'));
		$this->db->order_by('a.id_pem', 'desc');
		$data['produk'] = $this->db->get()->result_array();

		$this->master($data);	
	}

	public function uploadBukti(){
		$data = $this->input->post();
		$path = './bukti';
			$config['upload_path']    = $path;            
			$config['allowed_types']  = 'jpg|png';
			$config['max_size']       = '50000';
			$config['overwrite'] 	  = TRUE;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('foto')){
				$img_data=$this->upload->data();

				$object = array(
					'bukti_foto' 		=> $path.'/'.$img_data['file_name'],
					'tgl_upload_bukti' 	=> date('Y-m-d H:i:s'),
				);
				$this->db->where('id_pem', $data['id_pem']);
				$this->db->update('transaksi', $object);

				$this->db->where('id_pem', $data['id_pem']);
				$this->db->update('pembelian', array('status' => 1));

				$file = $img_data['file_name'];
				$origin = realpath('./bukti').'/'.$file;
				$destination = realpath('./thumb').'/'.$file;
				ImageJPEG(ImageCreateFromString(file_get_contents($origin)), $destination, 25);
			}

		redirect($this->session->userdata('level').'/pembelian','refresh');	
	
	}

	public function KonPen($idp){
		$this->db->where('id_pem', $idp);
		$this->db->update('pembelian', array('status' => 3));
		
		redirect($this->session->userdata('level').'/pembelian','refresh');	
	}
	
}
?>