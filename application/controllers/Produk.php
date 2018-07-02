<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {
	
	function index(){
		redirect('');
	}

	function detail($id = null){
		$data['produk'] = $this->db->query("SELECT a.*, b.nama kategori, c.nama seller FROM produk a JOIN kategori b USING(id_kategori) JOIN users c USING(id_users) WHERE a.aktif = '1' AND id_produk = '$id' AND c.level = 'mahasiswa'")->result()[0];
		$kategori = $data['produk']->id_kategori;
		$data['kategori'] = $this->db->query("SELECT a.*, b.nama kategori, c.nama seller FROM produk a JOIN kategori b USING(id_kategori) JOIN users c USING(id_users) WHERE a.aktif = '1' AND id_produk != '$id' AND id_kategori = '$kategori'  AND c.level = 'mahasiswa'")->result();
		$data['ulasan'] = $this->db->query("SELECT * FROM ulasan WHERE aktif = '1' AND id_produk = '$id'")->result();
		$this->load->view('produk',$data);
	}

	function ulas($id = null){
		if($id > 0){
			if($this->input->post('submit')){
				$komentar = $this->input->post('komentar');
				$tipe = $this->session->userdata('status');
				if($tipe == 'admin'){
					$user = '0';
				}elseif($tipe == 'mahasiswa'){
					$user = $this->session->userdata('nim');
				}elseif($tipe == 'user'){
					$user = $this->session->userdata('id_users');
				}else{
					redirect("produk/detail/$id#ulasan");
				}

				$data_insert = array(
					'id_produk' => $id,
					'komentar' => $komentar,
					'tipe_user' => $tipe,
					'id_user' => $user,
					'aktif' => '1',
				);
				$this->db->insert('ulasan',$data_insert);
			}
		}
		redirect("produk/detail/$id#ulasan");
	}
}
