<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('level')!="admin") {
			redirect('admin/login');
		}
	}

	function index(){
		redirect('admin/produk');
		// $data['view'] = 'v_admin';
		// $this->master($data);
	}

	private function master($data){
		$this->load->view('master/header',$data);
		$this->load->view('master/topbar',$data);
		$this->load->view('master/sidebar', $data);
		$this->load->view($data['view'], $data);
		$this->load->view('master/footer');
	}

	public function transaksi(){
		$data['view'] = 'v_transaksi';
		$data['title'] = 'Transaksi';
		$data['side'] = 'List';
		$this->db->select('a.*, b.harga, b.extensi, b.deskripsi, b.nama as nama_p, c.nama as nama_penjual, d.status as sts_t, d.bukti_foto, e.nama as nama_pem');
		$this->db->from('pembelian a');
		$this->db->join('produk b', 'b.id_produk = a.id_produk', 'left');
		$this->db->join('users c', 'c.id_users = b.id_users', 'left');
		$this->db->join('transaksi d', 'd.id_pem = a.id_pem', 'left');
		$this->db->join('users e', 'e.id_users = a.id_users', 'left');
		$this->db->where('a.status >', 0 );
		$this->db->order_by('a.id_pem', 'desc');
		$data['produk'] = $this->db->get()->result_array();

		$this->master($data);
	}

	public function KonPem($idp){
		$this->db->where('id_pem', $idp);
		$this->db->update('transaksi', array('status' => 1));

		redirect('admin/transaksi','refresh');		
	}

	public function KonPen($idp){
		$this->db->where('id_pem', $idp);
		$this->db->update('transaksi', array('status' => 2));

		redirect('admin/transaksi','refresh');		
	}
}
