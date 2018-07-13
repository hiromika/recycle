<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="user") {
				echo '<script type="text/javascript">'; 
				echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
				echo '</script>';
		}
		date_default_timezone_set('Asia/Jakarta');
	}

	function index(){
		redirect('');
		// $data['view'] = 'v_user';
		// $this->master($data);
	}

	private function master($data){
		$this->load->view('master/header',$data);
		$this->load->view('master/topbar',$data);
		$this->load->view('master/sidebar', $data);
		$this->load->view($data['view'], $data);
		$this->load->view('master/footer',$data);
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
			);
		}
		$this->db->where('id_users', $this->session->userdata('id_users'));
		$this->db->update('users', $object);

		redirect('user/profile','refresh');
	}
}

// stat pembelian
// 0 = belom dibayar;
// 1 = sudah dibayar;
// 2 = barang di kirim penjual;
// 3 = barang sampe;
// 4 = selesai

// stat transaksi
// 0 = blm di konfirmasi admin
// 1 = sudah di konfirmasi admin
// 2 = di teruskan kepenjual




