<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {
	
	public function index(){}
	public function pemesanan($param){
//		$test = $this->encrypt->decode($param);
//		var_dump($param);die();
		$pemesan = $this->m_crud->join(
			"formulir_pemesanan.*,pengurus.nama_pengurus,masjid.nama_masjid,masjid.alamat_masjid",
			["pengurus","masjid"],
			["pengurus.id_pengurus=formulir_pemesanan.id_pengurus","masjid.id_masjid=formulir_pemesanan.id_masjid"],
			"formulir_pemesanan","no_pemesanan='$param'",NULL,NULL,NULL
		)->row();
		$data = ["pemesan" => $pemesan];
		$this->load->view("bo/cetak/pemesanan",$data);
	}
	
	public function kas(){
	
	}
	
}

/* End of file Print.php */
/* Location: ./application/controllers/bo/Print.php */