<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller {
	
	function index(){
		if ($this->session->userdata('status')=="mahasiswa") {
			redirect('mahasiswa');
		}
		$this->load->view('v_signup');
	}
	function add(){
		if($this->input->post('submit')){
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('nim','NIM','trim|required|xss_clean');
			$this->form_validation->set_rules('nama','Nama','trim|required|xss_clean');
			$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				echo '<script type="text/javascript">'; 
				echo 'alert("Cek username dan password anda");';
				echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
				echo '</script>';
			}else{
				$nim = $this->input->post('nim', TRUE);
				$nama = $this->input->post('nama', TRUE);
				$password = md5($this->input->post('password', TRUE));
				$cek = $this->db->query("SELECT * FROM mahasiswa WHERE nim = '$nim'");
				if($cek->num_rows() == 0){
					$data_insert = array(
						'nim' => $nim,
						'nama' => $nama,
						'extensi' => '',
						'password' => $password,
						'aktif' => '0'
					);
					$this->db->insert('mahasiswa',$data_insert);
					$id = $this->db->insert_id();

					$path = realpath('./ktm');
					$config['upload_path']    = $path;            
					$config['allowed_types']  = 'jpg|png';
					$config['max_size']       = '50000';
					$config['file_name']      = $id;
					$config['overwrite'] 	  = TRUE;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('foto')){
						$img_data=$this->upload->data();
						$file = array('extensi' => $img_data['file_ext'] , );
						$this->db->where('nim',$id);
						$this->db->update('mahasiswa',$file);
					}
					redirect('');
				}else{
					echo '<script type="text/javascript">'; 
					echo 'alert("NIM sudah digunakan");';
					echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
					echo '</script>';
				}
			}
		}else{
			redirect('mahasiswa');
		}
	}
	function auth(){
		if ($this->session->userdata('status')=="mahasiswa") {
			redirect('mahasiswa');
		}else{
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('nim','NIM','trim|required|xss_clean');
			$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				echo '<script type="text/javascript">'; 
				echo 'alert("Cek username dan password anda");';
				echo 'window.location.href = "'.$_SERVER['HTTP_REFERER'].'";';
				echo '</script>';
			}else{
				$nim = $this->input->post('nim', TRUE);
				$password = md5($this->input->post('password', TRUE));
				$cek = $this->db->query("SELECT * FROM mahasiswa WHERE nim = '$nim' AND password = '$password'");
				if($cek->num_rows() == 1){
					$data = $cek->result();
					$data_session = array(
						'nim' => $data[0]->nim,
						'nama' => $data[0]->nama,
						'status' => "mahasiswa"
					);

					$this->session->set_userdata($data_session);
					redirect('mahasiswa');

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
		redirect('mahasiswa/login');
	}
}
