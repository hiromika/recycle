<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	
	function index(){
		if ($this->session->userdata('status')=="user") {
			redirect('user');
		}
		$this->load->view('v_login');
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
				$cek = $this->db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password' AND aktif = '1'");
				if($cek->num_rows() == 1){
					$data = $cek->result();
					$data_session = array(
						'id_users' => $data[0]->id_users,
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
		redirect('panel/home');
	}
}
