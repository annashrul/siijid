<?php


class Laporan extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->output->set_header("Cache-Control: no-store, no-cache, max-age=0, post-check=0, pre-check=0");
		if($this->session->username==""){
			redirect("auth/logout");
		}
		$this->masjid 	= $this->session->id_masjid;
		$this->pengurus = $this->m_crud->get("nama_pengurus,id_pengurus", "pengurus", "id_masjid=$this->masjid")->result_array();
		$this->nama_masjid = $this->m_crud->get("*", "masjid", "id_masjid=$this->masjid")->row_array();
		$this->ketua = $this->db->query("select p.nama_pengurus,ua.hak_akses from user_akun ua left join pengurus p on p.id_pengurus=ua.id_pengurus where ua.id_masjid='".$this->masjid."' and ua.hak_akses='ketua'")->row_array();
		$this->bendahara = $this->db->query("select p.nama_pengurus,ua.hak_akses from user_akun ua left join pengurus p on p.id_pengurus=ua.id_pengurus where ua.id_masjid='".$this->masjid."' and ua.hak_akses='bendahara'")->row_array();
//	    var_dump($this->ketua['nama_pengurus']);die();
	}

	public function zakat($aksi=null,$hal=1){
		$page 		  = 'l_zakat';
		$data 		  = array('page'=>$page,'isi'=>'bo/laporan/zakat');
		if($aksi=='get'){

		}
		else{
			$this->load->view('bo/layout/wrapper',$data);
		}
	}
}
