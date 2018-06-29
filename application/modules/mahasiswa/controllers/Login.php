<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	
	function index(){
		if ($this->session->userdata('status')=="mahasiswa") {
			redirect('mahasiswa');
		}
		$this->load->view('v_login');
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
				$cek = $this->db->query("SELECT * FROM mahasiswa WHERE nim = '$nim' AND password = '$password' AND aktif = '1'");
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
		redirect('panel/home');
	}
}
