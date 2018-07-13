<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_panel','_model');

		$key = "54b6d245ff2d26cc361062984d9d3f6d";
		$url = "http://api.rajaongkir.com/starter/";
	}
	
	function home($id_kategori = null){
		$data['kategori'] = $this->db->query('SELECT * FROM kategori')->result_array();

		$banner = $this->db->query("SELECT id_produk, b.nama kategori, c.nama user, a.nama, deskripsi, harga, a.extensi FROM produk a JOIN kategori b USING(id_kategori) JOIN users c USING(id_users) WHERE a.aktif = '1' AND a.iklan = 2  AND a.status = 0 ORDER BY rand() LIMIT 5")->result_array();

		$daftar = $this->kategori($id_kategori);

		$data['banner'] = $banner;
		$data['daftar'] = $daftar;
		$this->load->view('home',$data);
	}



	function about(){
		$data['kategori'] = $this->db->query('SELECT * FROM kategori')->result_array();
		$this->load->view('about',$data);
	}
	function contact(){
		$data['kategori'] = $this->db->query('SELECT * FROM kategori')->result_array();
		$this->load->view('contact',$data);
	}
	function services(){
		$data['kategori'] = $this->db->query('SELECT * FROM kategori')->result_array();
		$this->load->view('services',$data);
	}




	private function kategori($id_kategori = null){
		
		if ($id_kategori == 0) {
			$this->db->select('*, a.nama as produk_name, a.id_users as users, a.extensi as ext');
			$this->db->from('produk a');
			$this->db->join('kategori b', 'b.id_kategori = a.id_kategori', 'left');
			$this->db->join('users c', 'c.id_users = a.id_users', 'left');
			$this->db->where('a.aktif', 1);
			$this->db->where('a.iklan', 2);
			$this->db->where('a.status', 0);
			return	$this->db->get()->result_array();
		}else{
			$this->db->select('*, a.nama as produk_name, a.id_users as users, a.extensi as ext');
			$this->db->from('produk a');
			$this->db->join('kategori b', 'b.id_kategori = a.id_kategori', 'left');
			$this->db->join('users c', 'c.id_users = a.id_users', 'left');
			$this->db->where('a.aktif', 1);
			$this->db->where('a.status', 0);
			$this->db->where('b.id_kategori', $id_kategori);
			return	$this->db->get()->result_array();
		}

	}

	function search(){
		$post = $this->input->post();
		$data['kategori'] = $this->db->query('SELECT * FROM kategori')->result_array();

		$banner = $this->db->query("SELECT id_produk, b.nama kategori, c.nama user, a.nama, deskripsi, harga, a.extensi FROM produk a JOIN kategori b USING(id_kategori) JOIN users c USING(id_users) WHERE a.aktif = '1' AND a.iklan = 2  AND a.status = 0 ORDER BY rand() LIMIT 5")->result_array();

		if ($post['kategori'] == 0) {
			$this->db->select('*, a.nama as produk_name, a.id_users as users, a.extensi as ext');
			$this->db->from('produk a');
			$this->db->join('kategori b', 'b.id_kategori = a.id_kategori', 'left');
			$this->db->join('users c', 'c.id_users = a.id_users', 'left');
			$this->db->where('a.aktif', 1);
			$this->db->where('a.status', 0);
			$this->db->like('a.nama', $post['cari'], 'BOTH');
		$daftar = 	$this->db->get()->result_array();
		}else{
			$this->db->select('*, a.nama as produk_name, a.id_users as users, a.extensi as ext');
			$this->db->from('produk a');
			$this->db->join('kategori b', 'b.id_kategori = a.id_kategori', 'left');
			$this->db->join('users c', 'c.id_users = a.id_users', 'left');
			$this->db->where('a.aktif', 1);
			$this->db->where('a.status', 0);
			$this->db->where('a.id_kategori', $post['kategori']);
			$this->db->like('a.nama', $post['cari'], 'BOTH');
		$daftar = 	$this->db->get()->result_array();
		}

		$data['banner'] = $banner;
		$data['daftar'] = $daftar;
		$this->load->view('home',$data);
	}


	public function detail($idp){

			$this->db->select('*, a.nama as produk_name, a.id_users as users, a.extensi as ext, b.nama as k_name');
			$this->db->from('produk a');
			$this->db->join('kategori b', 'b.id_kategori = a.id_kategori', 'left');
			$this->db->join('users c', 'c.id_users = a.id_users', 'left');
			$this->db->where('a.id_produk', $idp);
		$data['produk'] = $this->db->get()->row_array();
		
		if ($data['produk']['iklan'] == 2) {
			$ip = $this->input->ip_address();

			$this->db->where('ip_address', $ip);
			$this->db->where('id_produk', $idp);
			$this->db->where('tgl !=', date('Y-m-d'));
			$get = $this->db->get('ppc');

			if ($get->num_rows() == 0) {
				$id_users = $data['produk']['users'];
				$sal = $this->db->query("SELECT SUM(jumlah) as jum FROM topup WHERE id_users = '$id_users'")->row_array();
				if ($sal['jum'] >= 500) {
						$object = array(
						 'id_users' 	=> $data['produk']['users'],
						 'keterangan'	=> 'Iklan klik',
						 'jumlah'		=> '-500',
						 'validasi'		=> '1',
						 'ppc_produk'	=> $idp
						);
						$this->db->insert('topup', $object);	
				}else{
					$this->db->where('id_users', $id_users);
					$this->db->update('produk', array('iklan' => 0));
				}

				$this->db->insert('ppc', array('ip_address'=> $ip, 'id_produk' => $idp));

			}			
		}

			$this->db->select('a.kota_kab');
			$this->db->from('users a');
			$this->db->join('produk b', 'b.id_users = a.id_users', 'left');
			$this->db->where('b.id_produk', $idp);
		$getasal = $this->db->get()->row_array();

		$data['kategori'] = $this->db->query('SELECT * FROM kategori')->result_array();

		$data['asal']   = $getasal['kota_kab'];
		
		$data['tujuan'] = $this->session->userdata('kota_kab');

			$this->db->where('id_users', $this->session->userdata('id_users'));
		$data['user'] = $this->db->get('users')->row_array();

		$this->load->view('produk',$data);
	}

	public function beli(){
		$data = $this->input->post();
		$ex = explode(",", $data['service']);
		$obj = array(
			'id_users' 		=> $data['id_users'],
			'id_produk'		=> $data['id_produk'],
			'jumlah'		=> $data['jumlah'],
			'subtotal'		=> $data['subtotal'],
			'jenis_paket'	=> $ex[0],
			'harga_paket'	=> $ex[1],
			'catatan'		=> $data['catatan'],
			'status'		=> 0,
		);
		$in = $this->db->insert('pembelian', $obj);
		$id = $this->db->insert_id();

		if ($in) {
			echo json_encode(array('result' => true, 
				'id_pem' 	=> $id, 
				'subtot' 	=> 'Rp.'.number_format($data['subtotal'],0,',','.'), 
				'jml' 		=> $data['jumlah'], 
				'paket' 	=> 'JNE '.$ex[0].' : Rp.'.$ex[1], 
				'ctt' 		=> $data['catatan'] ));
		}else{
			echo json_encode(array('result' => true,));
		}

	}

	public function metode(){
		$data = $this->input->post();

		$this->db->insert('transaksi', array('id_pem' => $data['id_pem']));

		$object = array(
			'metode' => $data['metode'], 
		);
		$this->db->where('id_pem', $data['id_pem']);
		$do = $this->db->update('pembelian', $object);

		if ($do) {
			redirect($this->session->userdata('level').'/pembelian','refresh');
		}else{
			redirect('','refresh');
		}
	}

	function login(){

		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules('username','Username','trim|required|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			echo '<script type="text/javascript">'; 
			echo 'alert("Cek username dan password anda");';
			echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
			echo '</script>';
		}else{
			$post = $this->input->post(); 
			$data = $this->_model->doLogin($post);

			if($data){
				$data_session = array(
					'id_users' 	=> $data['id_users'],
					'username' 	=> $data['username'],
					'nama' 		=> $data['nama'],
					'level' 	=> $data['level'],
					'kota_kab'  => $data['kota_kab']
				);
				$this->session->set_userdata($data_session);

				if ($data['level'] == 'admin') {
					redirect('admin');
				}elseif ($data['level'] == 'mahasiswa'){
					redirect('mahasiswa');
				}else{
					redirect('user');
				}

			}else{
				echo '<script type="text/javascript">'; 
				echo 'alert("Invalid login");';
				echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
				echo '</script>';
			}
		}
		
	}


	function signup(){
		if($this->input->post('submit')){
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('username','Username','trim|required|xss_clean');
			$this->form_validation->set_rules('nama','Nama','trim|required|xss_clean');
			$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				echo '<script type="text/javascript">'; 
				echo 'alert("Cek username dan password anda");';
				echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
				echo '</script>';
			}else{
				$username = $this->input->post('username', TRUE);
				$nama = $this->input->post('nama', TRUE);
				$email = $this->input->post('email', TRUE);
				$password = md5($this->input->post('password', TRUE));
				$level = $this->input->post('level', TRUE);
				$cek = $this->db->query("SELECT * FROM users WHERE username = '$username'");
				if($cek->num_rows() == 0){

					if ($level == "2") {
						$lv = 'mahasiswa';
						$data_insert = array(
						'username' => $username,
						'nim'	=> $this->input->post('nim', TRUE),
						'nama' => $nama,
						'email' => $email,
						'extensi' => '',
						'password' => $password,
						'aktif' => '0',
						'level'	=> $lv,
						'nama_bank'	=> $this->input->post('bank', TRUE),
						'no_rek'	=> $this->input->post('norek', TRUE)
						);
						$path = realpath('./ktm');
					}else{
						$lv = 'user';
						$data_insert = array(
						'username' => $username,
						'nama' => $nama,
						'email' => $email,
						'extensi' => '',
						'password' => $password,
						'aktif' => '0',
						'level'	=> $lv,
						);
						$path = realpath('./ktp');
					}					

					$this->db->insert('users',$data_insert);

					$id = $this->db->insert_id();

					
					$config['upload_path']    = $path;            
					$config['allowed_types']  = 'jpg|png';
					$config['max_size']       = '50000';
					$config['file_name']      = $id;
					$config['overwrite'] 	  = TRUE;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('foto')){

						$img_data=$this->upload->data();
						$file = array('extensi' => $img_data['file_ext'],);
						$this->db->where('username',$id);
						$this->db->update('users',$file);
					}

					$data_session = array(
						'id_users' 	=> $id,
						'username' 	=> $username,
						'nama' 		=> $nama,
						'level' 	=> $lv,
					);
					$this->session->set_userdata($data_session);

					if ($lv == 'admin') {
						redirect('admin');
					}elseif ($lv == 'mahasiswa'){
						redirect('mahasiswa');
					}else{
						redirect('user');
					}

				}else{
					echo '<script type="text/javascript">'; 
					echo 'alert("Username sudah digunakan");';
					echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
					echo '</script>';
				}
			}
		}else{
			echo '<script type="text/javascript">'; 
			echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
			echo '</script>';
		}
	}


	

}
