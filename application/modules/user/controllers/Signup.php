<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller {
	
	function index(){
		if ($this->session->userdata('status')=="user") {
			redirect('user');
		}
		$this->load->view('v_signup');
	}
	function add(){
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
				$password = md5($this->input->post('password', TRUE));
				$cek = $this->db->query("SELECT * FROM users WHERE username = '$username'");
				if($cek->num_rows() == 0){
					$data_insert = array(
						'username' => $username,
						'nama' => $nama,
						'extensi' => '',
						'password' => $password,
						'aktif' => '0'
					);
					$this->db->insert('users',$data_insert);
					$id = $this->db->insert_id();

					$path = realpath('./ktp');
					$config['upload_path']    = $path;            
					$config['allowed_types']  = 'jpg|png';
					$config['max_size']       = '50000';
					$config['file_name']      = $id;
					$config['overwrite'] 	  = TRUE;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('foto')){
						$img_data=$this->upload->data();
						$file = array('extensi' => $img_data['file_ext'] , );
						$this->db->where('username',$id);
						$this->db->update('users',$file);
					}
					redirect('');
				}else{
					echo '<script type="text/javascript">'; 
					echo 'alert("Username sudah digunakan");';
					echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
					echo '</script>';
				}
			}
		}else{
			redirect('user');
		}
	}
	function auth(){
		if ($this->session->userdata('status')=="user") {
			redirect('user');
		}else{
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
				$username = $this->input->post('username', TRUE);
				$password = md5($this->input->post('password', TRUE));
				$cek = $this->db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
				if($cek->num_rows() == 1){
					$data = $cek->result();
					$data_session = array(
						'username' => $data[0]->username,
						'nama' => $data[0]->nama,
						'status' => "user"
					);

					$this->session->set_userdata($data_session);
					redirect('user');

				}else{
					echo '<script type="text/javascript">'; 
					echo 'alert("Invalid login");';
					echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
					echo '</script>';
				}
			}
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('user/login');
	}
}
