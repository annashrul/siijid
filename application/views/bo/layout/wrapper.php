<?php
$where="";
$id_pengurus = $this->session->userdata("id_pengurus");
$id_masjid = $this->session->userdata("id_masjid");
if($id_pengurus&&$id_pengurus!=null) {
	($where == null) ? null : $where .= " AND ";
	$where .= "pengurus.id_pengurus='".$id_pengurus."'";
}
if($id_masjid&&$id_masjid!=null) {
	($where == null) ? null : $where .= " AND ";
	$where .= "masjid.id_masjid='".$id_masjid."'";
}
$user = $this->m_crud->join(
	"user_akun.*,masjid.*,pengurus.nama_pengurus",
	array("masjid","pengurus"),
	array("masjid.id_masjid=user_akun.id_masjid","pengurus.id_pengurus=user_akun.id_pengurus"),
	"user_akun",$where
)->row();
if($this->session->username=="") {
    redirect('auth');
}
include 'header.php';
include 'top_menu.php';
include 'side_menu.php';
include 'content.php';
include 'footer.php';
?>
