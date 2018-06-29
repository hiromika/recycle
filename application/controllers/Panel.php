<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_panel','_model');
	}
	
	function home($id_kategori = null){
		$data['kategori'] = $this->db->query('SELECT * FROM kategori')->result_array();

		$banner = $this->db->query("SELECT id_produk, b.nama kategori, c.nama user, a.nama, deskripsi, harga, a.extensi FROM produk a JOIN kategori b USING(id_kategori) JOIN users c USING(id_users) WHERE a.aktif = '1' ORDER BY rand() LIMIT 5")->result_array();

		$daftar = $this->kategori($id_kategori);

		$data['banner'] = $banner;
		$data['daftar'] = $daftar;
		$this->load->view('home',$data);
	}


	private function kategori($id_kategori = null){
		
		if ($id_kategori == 0) {
			$this->db->select('*, a.nama as produk_name, a.id_users as users, a.extensi as ext');
			$this->db->from('produk a');
			$this->db->join('kategori b', 'b.id_kategori = a.id_kategori', 'left');
			$this->db->join('users c', 'c.id_users = a.id_users', 'left');
		return	$this->db->get()->result_array();
		}else{
			$this->db->select('*, a.nama as produk_name, a.id_users as users, a.extensi as ext');
			$this->db->from('produk a');
			$this->db->join('kategori b', 'b.id_kategori = a.id_kategori', 'left');
			$this->db->join('users c', 'c.id_users = a.id_users', 'left');
			$this->db->where('b.id_kategori', $id_kategori);
			return	$this->db->get()->result_array();
		}

	}

	public function detail($idp){
		$data['kategori'] = $this->db->query('SELECT * FROM kategori')->result_array();

		$this->db->select('*, a.nama as produk_name, a.id_users as users, a.extensi as ext, b.nama as k_name');
			$this->db->from('produk a');
			$this->db->join('kategori b', 'b.id_kategori = a.id_kategori', 'left');
			$this->db->join('users c', 'c.id_users = a.id_users', 'left');
			$this->db->where('a.id_produk', $idp);
		$data['produk'] = $this->db->get()->row_array();
		
		$this->load->view('produk',$data);
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
