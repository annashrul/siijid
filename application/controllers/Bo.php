<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: anash
 * Date: 13/11/2018
 * Time: 04.51
 */

class Bo extends CI_Controller{
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

    /*
     * 11111 11111 11111 11111 11111 11111 11111 11111 // super && ketua
     * 11111 11111 11111 00000 00000 11111 11111 11111 // sekretaris
     * 00000 00000 00000 11111 11111 00000 00000 00000 // bendahara
     */

	public function access_denied($str){
//        if(substr($this->m_website->user_access_data($this->session->hak_akses)->akses,$str,5) == 0){
//            echo "<script>alert('Access Denied'); window.location='".base_url()."auth';</script>";
//        }
    }

    public function setting($action=null){
	    $response=array();
	    if($action=='get_data'){
	        if($this->nama_masjid != null){
	            $response['kondisi']    = true;
	            $response['res_data'] = $this->nama_masjid;
            }else{
	            $response['kondisi'] = false;
            }
            echo json_encode($response);
        }
        elseif ($action == 'simpan'){
	        $data = array(
	            "nama_masjid"=>$_POST['nama_masjid'],
                "alamat_masjid"=>$_POST['alamat'],
                "longitude"=>$_POST['lng'],
                "latitude"=>$_POST['lat'],
                "thn_berdiri"=>$_POST['thn_berdiri']
            );
	        $this->m_crud->update_data("masjid",$data,array("id_masjid"=>$_POST['id']));
	        echo json_encode(array("pesan"=>""));
        }

    }

	public function get_pengurus(){

//	    $level = $this->session->hak_akses;
//	    if($level=='')
//        $read_data = $this->m_crud->join_data("pengurus p","p.nama_pengurus,p.id_pengurus,ua.hak_akses",array(array("type"=>"left","table"=>"user_akun ua")),array("ua.id_pengurus=p.id_pengurus"));
	    echo json_encode(array("getPengurus"=>$this->pengurus));
    }

	public function dashboard(){
		$page = 'dashboard';
		$data = array(
			'page'=>$page,
			'user'=>$this->nama_masjid,
			'isi'=>'bo/pages/'.$page,
        );
		$this->load->view('bo/layout/wrapper',$data);
	}

    public function pengurus($aksi=null){
        $this->access_denied(0);
        $page	= 'pengurus';
        $table	= 'pengurus';
        $where	= null;
        $data 	= array('page'=>$page,'isi'=>'bo/pages/'.$page);
        $id_masjid	= $this->session->id_masjid;
        $response = array();
        $this->session->unset_userdata('search');
        isset($_POST["search"]) ? $this->session->set_userdata('search', array('any' => $_POST['any'])) : null;
        $search = $this->session->search['any'];
        if(isset($search)&&$search!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "nama_pengurus like '%".$search."%' AND pengurus.id_masjid='$this->masjid'";
        }
        $count = $this->m_crud->count_data($table, "id_pengurus", $where == null ? "pengurus.id_masjid='$id_masjid '" : $where);
        if($aksi == "get"){
            $config = array();
            $config["base_url"] 				= "#";
            $config["total_rows"] 			= $count;
            $config["per_page"] 				= 8;
            $config["uri_segment"] 			= 4;
            $config["num_links"] 				= 1;
            $config["use_page_numbers"] = TRUE;
            $config['first_link'] 			= 'First';
            $config['last_link'] 				= 'Last';
            $config['next_link'] 				= /** @lang text */'<i class="md md-navigate-next"></i>';
            $config['prev_link'] 				= /** @lang text */'<i class="md md-navigate-before"></i>';
            $config['full_tag_open'] 		= /** @lang text */'<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close'] 	= /** @lang text */'</ul></nav></div>';
            $config['num_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] 		= /** @lang text */'</span></li>';
            $config['cur_tag_open']	 		= /** @lang text */'<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] 		= /** @lang text */'<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['next_tagl_close'] 	= /** @lang text */'<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close'] 	= /** @lang text */'</span>Next</li>';
            $config['first_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = /** @lang text */'</span></li>';
            $config['last_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['last_tagl_close'] 	= /** @lang text */'</span></li>';
            $this->pagination->initialize($config);
            $hal  	= $this->uri->segment(4);
            $start 	= ($hal - 1) * $config["per_page"];
            $read_data = $this->m_crud->join_data(
                $table, "pengurus.*,nama_masjid,masjid.id_masjid, ua.hak_akses",
                array(array("type"=>"left","table"=>"masjid"),array("type"=>"left","table"=>"user_akun ua")),
                array("masjid.id_masjid=pengurus.id_masjid","ua.id_pengurus=pengurus.id_pengurus"),
                $where == null ? "pengurus.id_masjid='$id_masjid '" : $where,"ua.id_user_akun ASC", null,
                $config["per_page"], $start, null
            );
            $res_index = "";
            if($read_data != null){
                foreach ($read_data as $row):
                    $res_index.=
                        /** @lang text */
                        '
					
					<div class="col-md-6 col-sm-6 col-lg-3">
					<figure class="snip1336" style="padding:0px!important;">
                      <img src="https://cdn2.tstatic.net/jakarta/foto/bank/images/sahara_20180625_210552.jpg" alt="sample87" />
                      <figcaption sytle="height:200px;">
                        <img src="'.base_url().$row["photo_pengurus"].'" alt="profile-sample4" class="profile" style="height:90px!important;width:120px!important;" />
                        <h2 style="color:white;">'.$row["nama_pengurus"].'<span>'.$row["hak_akses"].'</span></h2>
                        <ul>
                        <li style="font-weight:bold;">'.$row["tgl_lahir_pengurus"].'</li>
                        <li style="font-weight:bold;">'.$row["jk_pengurus"].'</li>
                        <li style="font-weight:bold;">'.$row["pendidikan_pengurus"].'</li>
                        <li style="font-weight:bold;">'.$row["no_hp_pengurus"].'</li>
                        </ul>
                        
                        <a href="#" onclick="edit('."'".$row['id_pengurus']."'".')" class="follow">Edit</a>
                        <a href="#" onclick="hapus('."'".$row['id_pengurus']."'".')" class="info">Hapus</a>
                      </figcaption>
                    </figure>
					
					</div>
					';
                endforeach;

            }else{
                $res_index .=
                    /**@lang text */
                    '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 class="text-center">Tidak Ada Data</h3>
				</div>';
            }
            $data = array(
                "pagination_link" => $this->pagination->create_links(),
                "result_project" 	=> $res_index,
                "page"            => $hal
            );
            echo json_encode($data);
        }
        elseif($aksi == "simpan"){
            $this->db->trans_begin();
            $path = 'assets/upload/pengurus';
            $config['upload_path']          = './'.$path;
            $config['allowed_types']        = 'bmp|gif|jpg|jpeg|png';
            $config['max_size']             = 5120;
            $this->load->library('upload', $config);
            $input_file = array('1'=>'file_upload');
            $valid = true;

            foreach($input_file as $row){
                if( (! $this->upload->do_upload($row)) && $_FILES[$row]['name']!=null){
                    $file[$row]['file_name']=null;
                    $file[$row] = $this->upload->data();
                    $valid = false;
                    $data['error_'.$row] = $this->upload->display_errors();
                    break;
                } else{
                    $file[$row] = $this->upload->data();
                    $data[$row] = $file;
                    if($file[$row]['file_name']!=null){
                        $manipulasi['image_library']    = 'gd2';
                        $manipulasi['source_image']     = $file[$row]['full_path'];
                        $manipulasi['maintain_ratio']   = true;
                        $manipulasi['width']            = 500;
                        $manipulasi['new_image']        = $file[$row]['full_path'];
                        $this->load->library('image_lib', $manipulasi);
                        $this->image_lib->resize();
                    }
                }
            }
            if($valid==true) {
                $data_berita = array(
                    'id_masjid'             => $id_masjid,
                    'nama_pengurus'         => $_POST['nama_pengurus'],
                    'pendidikan_pengurus'   => $_POST['pendidikan_pengurus'],
                    'jk_pengurus'           => $_POST['jk_pengurus'],
                    'tgl_lahir_pengurus'    => $_POST['tgl_lahir_pengurus'],
                    'no_hp_pengurus'        => $_POST['no_hp_pengurus'],
                );

                if($_FILES['file_upload']['name']!=null) {
                    $data_berita['photo_pengurus' ] = ($_FILES['file_upload']['name']!=null)?($path.'/'.$file['file_upload']['file_name']):null;
                    if($_POST['file_uploaded']!=null||$_POST['file_uploaded']!=''){
                        unlink($_POST['file_uploaded']);
                    }
                }


                $rplc = str_replace(" ","",strtolower($_POST['nama_pengurus']));
                $akun = str_replace("-","",$rplc);

                if ($_POST['param'] == 'add') {
                    $response['error']  = false;
                    $response['pesan']  = "berhasil di insert ke table pengurus";
                    $this->m_crud->create_data($table, $data_berita);
                    $id_pengurus=$this->db->insert_id();
                    if($id_pengurus){
                        $data_akun = array(
                            "id_masjid"	 	=> $id_masjid,
                            'id_pengurus' 	=> $id_pengurus,
                            'username'  	=> $akun,
                            'password'  	=> $akun,
                            'hak_akses'		=> $_POST['bagian_pengurus'],
                            'akses'         => $this->m_website->cek_level($_POST['bagian_pengurus'])
                        );
                        $this->m_crud->create_data('user_akun',$data_akun);
                        $response['error']  = false;
                        $response['pesan']  = "berhasil di insert ke table user akun";
                    } else {
                        $response['error'] = true;
                        $response['pesan'] = "gagal insert ke table user akun";
                    }

                } else {
                    $id = $_POST['id'];
                    if($_POST['id']){
                        $tbl_pengurus   = $this->m_crud->update_data($table, $data_berita, "id_pengurus='".$id."'");
                        $response['error'] = false;
                        $response['pesan'] = "berhasil di update ke table pengurus";
                        if($tbl_pengurus){
                            $data_akun = array(
                                "id_masjid"	 	=> $id_masjid,
                                'id_pengurus' 	=> $id,
                                'username'  	=> $akun,
                                'password'  	=> $akun,
                                'hak_akses'		=> $_POST['bagian_pengurus'],
                                'akses'         => $this->m_website->cek_level($_POST['bagian_pengurus'])
                            );
                            $this->m_crud->update_data("user_akun", $data_akun, "id_pengurus='".$id."'");
                            $response['error'] = false;
                            $response['pesan'] = "berhasil di update ke table user_akun";

                        }else{
                            $response['error'] = true;
                            $response['pesan'] = "gagal di update ke table pengurus";
                        }

                    }


                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            echo json_encode($response);
        }
        elseif($aksi == "edit"){
            $get_data = $this->m_crud->get_join_data(
                "pengurus p", "p.*,ua.hak_akses",
                array(array("type"=>"left","table"=>"user_akun ua")),
                array("ua.id_pengurus=p.id_pengurus"),
                "p.id_pengurus='".$_POST['id']."'"
            );
            $result = array();

            if ($get_data != null) {
                $result['status'] = true;
                $result['res_data'] = $get_data;
            } else {
                $result['status'] = false;
            }

            echo json_encode($result);
        }
        elseif($aksi == "hapus"){
            $this->db->trans_begin();
            $file = $this->m_crud->get_data($table, 'photo_pengurus', "id_pengurus = '".$_POST['id']."'");
            $delete1 = $this->m_crud->delete_data($table, "id_pengurus = '".$_POST['id']."'");
            $delete2 = $this->m_crud->delete_data("user_akun", "id_pengurus = '".$_POST['id']."'");
            if ($delete1) {
                if($file!=null){
                    unlink($file['photo_pengurus']);
                    $response['error']=false;
                    $response['pesan']="photo berhasil dihapus";
                }
                $response['error']=false;
                $response['pesan']="data pengurus berhasil dihapus";
            } else {
                $response['error']=true;
                $response['pesan']="data pengurus gagal dihapus";
            }

            if($delete2){
                $response['error']=false;
                $response['pesan']="data akun berhasil dihapus";
            }else{
                $response['error']=true;
                $response['pesan']="data akun gagal dihapus";
            }

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else {
                $this->db->trans_commit();
            }
            echo json_encode($response);
        }else{
            $this->load->view('bo/layout/wrapper',$data);
        }
    }
    public function zakat($aksi=null,$hal=1){
        $this->access_denied(5);
        $id_pengurus  = $this->input->post('id_pengurus');
        $nama         = $this->input->post('nama');
        $alamat       = $this->input->post('alamat');
        $jumlah  	  = $this->input->post('jumlah_jiwa');
        $total  	  = str_replace(",","",$this->input->post('total_zakat'));
        $shodaqoh  	  = str_replace(",","",$this->input->post('shodaqoh'));
        $page 		  = 'zakat';
        $data 		  = array('page'=>$page,'isi'=>'bo/pages/'.$page);
        $where		  = "z.id_masjid='".$this->session->id_masjid."'";

        $this->session->unset_userdata('search');
        if(isset($_POST['any'])) {
            $this->session->set_userdata('search', array(
                'any'	    => $_POST['any'],
                'periode'   => $_POST['periode'],
                'bentuk'    => $_POST['bentuk'],
                'jenis'     => $_POST['jenis'],
            ));
        }

        $any 	    = $this->session->search['any'];
        $periode 	= $this->session->search['periode'];
        $bentuk 	= $this->session->search['bentuk'];
        $jenis 	    = $this->session->search['jenis'];

        if(isset($any)&&$any!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "nama like '%".$any."%'";
        }
        if(isset($periode)&&$periode!=null){
            ($where == null) ? null : $where .= " AND ";
            $explode_date = explode(' - ', $periode);
            $tgl_awal 	= $explode_date[0];
            $tgl_akhir 	= $explode_date[1];
            $where.="convert(tgl_bayar,date) between '".$tgl_awal."' and '".$tgl_akhir."' ";
        }
        if(isset($bentuk)&&$bentuk!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "bentuk_zakat='".$bentuk."'";
        }
        if(isset($jenis)&&$jenis!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "jenis_zakat='".$jenis."'";
        }

        if(isset($_POST['to_pdf'])){
            $this->load->library('pdf');

            $report_detail = $this->m_crud->join_data(
                "zakat z", "z.shodaqoh,z.rt,z.rw,z.jenis_zakat,z.nama,z.alamat,z.jumlah_jiwa,z.bentuk_zakat,z.total_zakat,convert(tgl_bayar,date) tgl_bayar,pengurus.nama_pengurus",
                array(array("type"=>"LEFT","table"=>"pengurus"),array("type"=>"LEFT","table"=>"masjid")),
                array("pengurus.id_pengurus=z.id_pengurus", "masjid.id_masjid=z.id_masjid"),
                $where, "id_zakat DESC"
            );

            $output="";
            $output.= "<h3 align='center'>LAPORAN Zakat<br/> MASJID ".$this->nama_masjid['nama_masjid']."<br/><small><i>".$this->nama_masjid['alamat_masjid']."</i></small><br/>$tgl_awal-$tgl_akhir</h3>";
            $output.=$this->m_website->logo().'<div style="margin-bottom: 10px;padding:0px 0px 0px 0px;"></div>';

            if($report_detail != null) {
                $output .= /** @lang text */
                    '
                <table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid black; font-size:11px;">
                <thead>
                <style>.middles{vertical-align:middle;}</style>
                <tr>
                    <th style="border:1px solid black" width="1%" rowspan="3"><center>NO</center></th>
                    <th style="border:1px solid black" width="5%" rowspan="3" class="middle"><center>TGL</center></th>
                    <th style="border:1px solid black" width="5%" rowspan="3" class="middle"><center>AMILIN</center></th>
                    <th style="border:1px solid black" width="40%" colspan="5"><center>MUZAKI</center></th>
                    <th style="border:1px solid black" width="40%" colspan="5"><center>PENERIMAAN ZAKAT</center></th>
                     <th style="border:1px solid black" width="5%" rowspan="3" class="middle"><center>TOTAL</center></th>
                </tr>
                <tr>
                    <th style="border:1px solid black" rowspan="2"><center>NAMA KK</center></th>
                    <th style="border:1px solid black;width:2px" rowspan="2"><center>RT</center></th>
                    <th style="border:1px solid black;width:2px" rowspan="2"><center>RW</center></th>
                    <th style="border:1px solid black" rowspan="2"><center>ALAMAT</center></th>
                    <th style="border:1px solid black;width:2px" rowspan="2"><center>JML JIWA</center></th>
                    <th style="border:1px solid black" colspan="2"><center>FITRAH</center></th>
                    <th style="border:1px solid black" rowspan="2"><center>MAAL</center></th>
                    <th style="border:1px solid black" rowspan="2"><center>FIDYAH</center></th>
                    <th style="border:1px solid black" rowspan="2"><center>INFAQ</center></th>
                </tr>
                <tr>
                 	<th colspan="1" style="border:1px solid black"><center>UANG</center></th>
                    <th colspan="1" style="border:1px solid black"><center>BERAS</center></th>
                </tr>
                
               
                </thead>
                <tbody>';
                $no = 1;
				$totalJiwa=0;$totalUang=0;$totalBeras=0;$totalMaal=0;$totalFidyah=0;$totalShodaqoh=0;$totalSubtotal=0;
                foreach ($report_detail as $row) {
					$decodeNama=json_decode($row["nama"],true);
					$jumlahJiwa=explode( '-' , $row['jumlah_jiwa'] );
					$bentuk = explode( '-' , $row['bentuk_zakat'] );
					$total = explode( '-' , $row['total_zakat'] );
					$bentukFitrah=$bentuk[0]=='kosong'?'-':$bentuk[0];
					$subtotalMaal=number_format($total[1]);
					$subtotalFidyah=number_format($total[2]);
					$beras='';$jmlUang='';
					$subtotal=0;
					if($bentukFitrah=='Beras'){
						$beras=$total[0].' Kg';
						$totalBeras=$totalBeras+$total[0];
					}
					else{
						$uang=$total[0];
						$jmlUang=$total[0]==''?'-':number_format($total[0]);
						$totalUang=$totalUang+$uang;
						$subtotal=$uang+$total[1]+$total[2]+$row['shodaqoh'];
						$totalSubtotal=$totalSubtotal+$subtotal;
					}
					foreach($decodeNama as $key=>$value){$nama=$value[0];}
                	$output.=/** @lang text */'<tr>
						<td style="border:1px solid black"><center>'.$no++.'</center></td>
						<td style="border:1px solid black"><center>'.date("y-m-d",strtotime($row["tgl_bayar"])).'</center></td>
						<td style="border:1px solid black"><center>'.$row["nama_pengurus"].'</center></td>
						<td style="border:1px solid black"><center>'.$nama.'</center></td>
						<td style="border:1px solid black"><center>'.$row["rt"].'</center></td>
						<td style="border:1px solid black"><center>'.$row["rw"].'</center></td>
						<td style="border:1px solid black"><center>'.$row["alamat"].'</center></td>
						<td style="border:1px solid black" align="right">'.count($jumlahJiwa).'</td>
						<td style="border:1px solid black" align="right">'.$jmlUang.'</td>
						<td style="border:1px solid black" align="right">'.$beras.'</td>
						<td style="border:1px solid black" align="right">'.$subtotalMaal.'</td>
						<td style="border:1px solid black" align="right">'.$subtotalFidyah.'</td>
						<td style="border:1px solid black" align="right">'.number_format($row["shodaqoh"]).'</td>
						<td style="border:1px solid black" align="right">'.number_format($subtotal).'</td>
					</tr>';
                	$totalJiwa=$totalJiwa+count($jumlahJiwa);
                	$totalMaal=$totalMaal=$total[1];
                	$totalFidyah=$totalFidyah=$total[2];
                	$totalShodaqoh=$totalShodaqoh+$row['shodaqoh'];
                }
                $total = $this->m_crud->get_data("zakat z","ifnull((select sum(total_zakat) from zakat z where bentuk_zakat='Uang' and $where),0) uang, ifnull((select sum(total_zakat) from zakat z where bentuk_zakat='Beras' and $where),0) beras",null,null,"uang,beras");
				$output.=/** @lang text */'<tr>
					<td colspan="7" style="border:1px solid black"><b>TOTAL</b></td>
					<td colspan="1" style="border:1px solid black" align="right"><b>'.$totalJiwa.'</b></td>
					<td colspan="1" style="border:1px solid black" align="right"><b>'.number_format($totalUang).'</b></td>
					<td colspan="1" style="border:1px solid black" align="right"><b>'.$totalBeras.' Kg</b></td>
					<td colspan="1" style="border:1px solid black" align="right"><b>'.number_format($totalMaal).'</b></td>
					<td colspan="1" style="border:1px solid black" align="right"><b>'.number_format($totalFidyah).'</b></td>
					<td colspan="1" style="border:1px solid black" align="right"><b>'.number_format($totalShodaqoh).'</b></td>
					<td colspan="1" style="border:1px solid black" align="right"><b>'.number_format($totalSubtotal).'</b></td>
				</tr>';
                $output .= /** @lang text */'</tbody>';
                $output .= /** @lang text */'
					</tfoot>
                </table>
                <div>
                    <table width="100%">
                        <thead>
                            <tr>
                                <th width="50%"></th>
                                <th width="50%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center;">
                                    <b><br/><br/><br/><br/><br/>_____________<br/><br/>Ketua</b>
                                </td>
                                <td style="text-align:center;">
                                    <b><br/><br/><br/><br/><br/>_____________<br/><br/>Sekretaris</b>
                                </td>
        
                            </tr>
                        </tbody>
                    </table>
                </div>
                ';

                $file = 'laporan_zakat.pdf';
                $output .= '</tbody></table>';
                $this->pdf->loadHtml($output);
                $this->pdf->render();
                $this->pdf->stream($file, array("Attachment" => 0));
            }
            else{
                echo "<script>alert('Data Tidak Ada'); window.location='".base_url()."bo/kas';</script>";
            }
        }


		if($aksi == "get") {
			$config = array();
			$config["base_url"] 		= "#";
			$config["total_rows"] 		= $this->m_crud->count_data("zakat z", "id_zakat",$where);
			$config["per_page"] 		= 10;
			$config["uri_segment"] 		= 4;
			$config["num_links"] 		= 1;
			$config["use_page_numbers"] = TRUE;
			$config['first_link'] 		= 'First';
			$config['last_link'] 		= 'Last';
			$config['next_link'] 		= /** @lang text */'<i class="md md-navigate-next"></i>';
			$config['prev_link'] 		= /** @lang text */'<i class="md md-navigate-before"></i>';
			$config['full_tag_open'] 	= /** @lang text */'<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close'] 	= /** @lang text */'</ul></nav></div>';
			$config['num_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] 	= /** @lang text */'</span></li>';
			$config['cur_tag_open']	 	= /** @lang text */'<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] 	= /** @lang text */'<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] 	= /** @lang text */'<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] 	= /** @lang text */'</span>Next</li>';
			$config['first_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = /** @lang text */'</span></li>';
			$config['last_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] 	= /** @lang text */'</span></li>';
			$this->pagination->initialize($config);
//			$hal = $this->uri->segment(4);
//            $start 	= ($hal - 1) * $config["per_page"];
			$start = ($hal - 1) * $config["per_page"];
			$read_data = $this->m_crud->join_data(
				"zakat z", "z.shodaqoh,z.rt,z.rw,z.kd_zakat,z.id_zakat,z.jenis_zakat,z.nama,z.alamat,z.jumlah_jiwa,z.bentuk_zakat,z.total_zakat,convert(tgl_bayar,date) tgl_bayar,pengurus.nama_pengurus",
				array(array("type"=>"LEFT","table"=>"pengurus"),array("type"=>"LEFT","table"=>"masjid")),
				array("pengurus.id_pengurus=z.id_pengurus", "masjid.id_masjid=z.id_masjid"),
				$where, "id_zakat DESC", null, $config["per_page"], $start, null
			);
			$res_index = "";
			$res_per_page = "";
			$res_page = "";
			$no = $start+1;
			$uang=0;$beras=0;
			if ($read_data != null) {
				foreach ($read_data as $row):
					$bentuk = explode( '-' , $row['bentuk_zakat'] );
					$total=explode('-',$row['total_zakat']);
					$beras="";$uang='';
					if($bentuk[0]=='Beras'){
						$beras = $total[0].' kg';
					}else{
						$uang = number_format((int)$total[0]+(int)$total[1]+(int)$total[2]+(int)$row['shodaqoh']);
					}


					$res_index .=/** @lang text */
						'<tr>
                        <td>' . $no++ . '</td>
                        <td>
                        <div class="dropdown">
                            <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Pilihan
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#!" onclick="detail('."'".$row['kd_zakat']."'".')">Detail</a></li>
                               
                                <li><a href="#!" onclick="hapus('."'".$row['kd_zakat']."'".')">Hapus</a></li>
                            </ul>
                        </div>
                        </td>
                        <td>' . $row["kd_zakat"] . '</td>
                        <td>' . $row["nama_pengurus"] . '</td>
                        <td>' . $row["rw"] . '</td>
                        <td>' . $row["rt"] . '</td>
                        <td>' . number_format((int)$row["shodaqoh"]) . '</td>';
					$res_index.='<td width="12%">' . $row["alamat"] . '</td>';
					$res_index.='<td align="right">' .$uang . '</td>';
					$res_index.='<td align="right">' .$beras. '</td>';
					$res_index.='<td width="12%">' . longdate_indo($row["tgl_bayar"]) . '</td>
                    </tr>';


				endforeach;

			} else {
				$res_index .=/**@lang text */'<tr><td colspan="11"><h3 class="text-center">Tidak Ada Data</h3></td><tr>';
			}
			$data = array(
				"pagination_link" => $this->pagination->create_links(),
				"result_project"  => $res_index,
				"res_per_page"    => $res_per_page,
				"res_page"        => $res_page,
//				"page"            => $hal
			);
			echo json_encode($data);
		}
        elseif($aksi == "get_param"){
            $get_data = $this->m_crud->get_join_data(
                "zakat z", "z.*,p.nama_pengurus,p.id_pengurus",
                array(array("type"=>"left","table"=>"pengurus p")),
                array("p.id_pengurus=z.id_pengurus"),
                "z.kd_zakat='".$_POST['kd_zakat']."'"
            );

            $data = array("res_data"      => $get_data);
            echo json_encode($data);
        }
        elseif($aksi == "tambah") {
            $this->db->trans_begin();
            $response = array();
            $response["pesan"] = "";
            $kode = $this->m_crud->generate_kode("zakat",date("ym"));
            $data = array(
                "id_masjid" 	=> $this->masjid,
                "id_pengurus"   => $id_pengurus,
                "kd_zakat"      => $_POST['kd_zakat'],
                "nama" 			=> $nama,
                "alamat" 		=> $alamat,
                "jumlah_jiwa"   => $_POST['jumlah_jiwa'],
                "bentuk_zakat"  => $_POST['bentuk_zakat'],
                "jenis_zakat"   => $_POST['jenis_zakat'],
                "total_zakat"   => $total,
                "shodaqoh" 		=> $shodaqoh==""?0:$shodaqoh
            );
            $this->m_crud->insert("zakat", $data);
            if($shodaqoh != ""){
                $data_kas = array(
                    "id_masjid"     => $this->masjid,
                    "id_pengurus"   => $id_pengurus,
                    "kd_kas"        => $_POST['kd_zakat'],
                    "jenis_kas"     => "Kas-Masuk",
                    "kas_in"        => $shodaqoh,
                    "kas_out"       => 0,
                    "keterangan"    => "shodaqoh dari $nama",
                    "tanggal"       => date("Y-m-d"),
                );
                $this->m_crud->insert("kas", $data_kas);
                $data_log=json_encode(array("zakat"=>array($data),"kas"=>array($data_kas)));

            }else{
                $data_log=json_encode(array("zakat"=>array($data),"kas"=>array()));
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $this->m_crud->log("add","zakat,kas",$data_log);
            }
            echo json_encode($response);
        }
        elseif($aksi == "edit") {
            $response = array();
            if ($nama == "") {
                $response["pesan"] = "Nama Tidak Boleh Kosong";
            } elseif ($alamat == "") {
                $response["pesan"] = "Alamat Tidak Boleh Kosong";
            } else {
                $response["pesan"] = "";
                $data = array(
                    "id_masjid" 	=> $this->masjid,
                    "id_pengurus" => $id_pengurus,
                    "nama" 				=> $nama,
                    "alamat"			=> $alamat,
                    "jumlah_jiwa" => $jumlah,
                    "bentuk_zakat"=> $_POST['bentuk_zakat'],
                    "jenis_zakat" => $_POST['jenis_zakat'],
                    "total_zakat" => $total,
                    "shodaqoh" 		=> $shodaqoh==""?0:$shodaqoh
                );
                $this->m_crud->update("zakat", $data,array("kd_zakat" => $_POST['kd_zakat']));
                if($shodaqoh!=""){
                    $data_kas = array(
                        "kas_in" => $shodaqoh
                    );
                    $this->m_crud->update("kas", $data_kas,array("kd_kas" => $_POST['kd_zakat']));
                    $data_log=json_encode(array("zakat"=>array($data),"kas"=>array($data_kas)));

                }else{
                    $data_log=json_encode(array("zakat"=>array($data),"kas"=>array()));
                }
//                $data_log = json_encode(array("zakat"=>array($data),"kas"=>$data_log));
                $this->m_crud->log("update","zakat,kas",$data_log);

            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            echo json_encode($response);
        }
        elseif($aksi == "hapus"){
            $this->db->trans_begin();
            $read_zakat = $this->m_crud->get_data("zakat","*","kd_zakat='".$_POST['kd_zakat']."'");
            $read_kas = $this->m_crud->get_data("kas","*","kd_kas='".$_POST['kd_zakat']."'");
            $this->m_crud->log("delete","zakat,kas",json_encode(array("zakat"=>array($read_zakat),"kas"=>array($read_kas))));
            $this->m_crud->delete("zakat",array("kd_zakat" => $_POST['kd_zakat']));
            $this->m_crud->delete("kas",array("kd_kas" => $_POST['kd_zakat']));
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            echo json_encode(array("pesan"=>"sukses"));
        }
        elseif($aksi == 'print'){
            $get_data = $this->m_crud->get_join_data(
                "zakat z", "z.jenis_zakat,z.nama,z.alamat,z.jumlah_jiwa,z.bentuk_zakat,z.total_zakat,convert(tgl_bayar,date) tgl_bayar,p.nama_pengurus,p.id_pengurus",
                array(array("type"=>"left","table"=>"pengurus p")),
                array("p.id_pengurus=z.id_pengurus"),
                "z.id_zakat='".$_POST['id']."'"
            );
            $result = "";
            $result.= /** @lang text */
                '
            <table class="table">
                <h3 class="text-center">Form Zakat Masjid '.$this->nama_masjid["nama_masjid"].'</h3>
                <tr>
                    <td>Nama</td><td>:</td><td>'.$get_data["nama"].'</td>
                    <td>Alamat</td><td>:</td><td>'.$get_data["alamat"].'</td>
                </tr>
                <tr>
                    <td>Jenis</td><td>:</td><td>'.$get_data["jenis_zakat"].'</td>
                    <td>Bentuk</td><td>:</td><td>'.$get_data["bentuk_zakat"].'</td>
                </tr>
                <tr>
                    <td>Jumlah Jiwa</td><td>:</td><td>'.$get_data["jumlah_jiwa"].'</td>
                    <td>Tanggal</td><td>:</td><td>'.longdate_indo($get_data["tgl_bayar"]).'</td>
                </tr>
                <tr>
                    <td colspan="1">Terbilang</td><td colspan="1">:</td><td colspan="3">'.number_format($get_data["total_zakat"]).' ('.terbilang($get_data["total_zakat"]).' Rupiah)</td>
                    
                </tr>

            </table>
            <div class="col-sm-12 col-xs-12">
                <p class="text-center">&nbsp;</p><br><br>
                <p class="text-center">Penerima</p>
            </div>
            ';

            echo json_encode(array("res_print"=>$result));
        }
        elseif($aksi == 'detail'){
			$read_data=$this->m_crud->get_data(
				"zakat","*","kd_zakat='".$_POST['id']."'"
			);

			$nama='';
			$total='';
			$decodeNama=json_decode($read_data["nama"],true);
			foreach($decodeNama as $value){

				foreach($value as $key=>$rows){
					$nama.=$rows==''?'-':'<li>'.$rows.'</li>';
				}
			}
			$bentuk = explode( '-' , $read_data['bentuk_zakat'] );
			$total = explode( '-' , $read_data['total_zakat'] );
			$bentukFitrah=$bentuk[0]=='kosong'?'-':$bentuk[0];
			$bentukMaal=$bentuk[1]=='kosong'?'-':$bentuk[1];
			$bentukFidyah=$bentuk[2]=='kosong'?'-':$bentuk[2];

			$totalFitrah=$bentukFitrah=='Beras'?$total[0].' Kg':number_format($total[0]);
			$totalMaal=number_format($total[1]);
			$totalFidyah=number_format($total[2]);
			$anggotaMaal=$read_data["anggota_maal"]==''?'-':$read_data["anggota_maal"];
			$anggotaFidyah=$read_data["anggota_fidyah"]==''?'-':$read_data["anggota_fidyah"];

			$jumlahJiwa=explode( '-' , $read_data['jumlah_jiwa'] );

			$result='';
			$result.='
				<tr>
					<td>'.$jumlahJiwa[0].' orang</td>
					<td>'.$jumlahJiwa[1].' orang</td>
					<td>'.$jumlahJiwa[2].' orang</td>
					<td>'.$nama.'</td>
					<td>'.$anggotaMaal.'</td>
					<td>'.$anggotaFidyah.'</td>
					<td>'.$bentukFitrah.'</td>
					<td>'.$bentukMaal.'</td>
					<td>'.$bentukFidyah.'</td>
					<td>'.$totalFitrah.'</td>
					<td>'.$totalMaal.'</td>
					<td>'.$totalFidyah.'</td>
				</tr>
			';

			echo json_encode($result);
		}
        else{
            $this->load->view('bo/layout/wrapper',$data);
        }
    }
    public function jadwal($aksi=null){
        $this->access_denied(10);
        $id_masjid		= $this->session->id_masjid;
        $id_pengurus 	= $this->input->post("id_pengurus");
        $nama_imam      = $this->input->post('nama_imam');
        $uang_transport = str_replace(',', '', $this->input->post('uang_transport'));
        $waktu          = $this->input->post('waktu');
        $getKegitan 	= $this->m_crud->get("nama_kegiatan,id_kegiatan", "kegiatan", "id_masjid=$id_masjid")->result_array();
        $page           = 'jadwal';
        $where	        = "j.id_masjid='".$this->session->id_masjid."'";

        $this->session->unset_userdata('search');



        if(isset($_POST['search'])) {
            $this->session->set_userdata('search', array(
                'any'	    => $_POST['any'],
                'periode'   => $_POST['periode'],
                'kegiatan'  => $_POST['kegiatan'],
            ));
        }

        $any 	    = $this->session->search['any'];
        $periode 	= $this->session->search['periode'];
        $kegiatan 	= $this->session->search['kegiatan'];



        if(isset($any)&&$any!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "j.nama_imam like '%".$any."%' or j.kd_jadwal like '%".$any."%'";
        }
        if(isset($_POST['periode'])&&$_POST['periode']!=null){
            ($where == null) ? null : $where .= " AND ";
            $explode_date = explode(' - ', $_POST['periode']);
            $tgl_awal 	= $explode_date[0];
            $tgl_akhir 	= $explode_date[1];
            $where.="DATE_FORMAT(j.waktu,'%Y-%m') between '".$tgl_awal."' and '".$tgl_akhir."' ";
//            $where.="YEAR(j.waktu)='".date('Y',strtotime($tgl_awal))."' and MONTH(j.waktu)='".date('m',strtotime($tgl_awal))."'";
        }

        if(isset($kegiatan)&&$kegiatan!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "k.id_kegiatan='".$kegiatan."'";
        }

        $data = array('page'=>$page,'isi'=>'bo/pages/'.$page);
        $count=$this->m_crud->count_data_join("jadwal j", "id_jadwal",array(array("type"=>"left","table"=>"kegiatan k")),array("k.id_kegiatan=j.id_kegiatan"), $where);

        if(isset($_POST['to_pdf'])){

            $report_detail = $this->m_crud->join_data(
                "jadwal j", "j.*,k.id_kegiatan,k.nama_kegiatan",
                array(array("type"=>"LEFT","table"=>"pengurus p"),array("type"=>"LEFT","table"=>"masjid m"),array("type"=>"LEFT","table"=>"kegiatan k")),
                array("p.id_pengurus=j.id_pengurus", "m.id_masjid=j.id_masjid","k.id_kegiatan=j.id_kegiatan"),
                $where, "j.id_jadwal DESC"
            );

            $output="";
            $output.= "<h3 align='center'>LAPORAN Jadwal<br/> MASJID ".$this->nama_masjid['nama_masjid']."<br/><small><i>".$this->nama_masjid['alamat_masjid']."</i></small><br/>".$_POST['periode']."</h3>";
            $output.=$this->m_website->logo().'<div style="margin-bottom: 10px;padding:0px 0px 0px 0px;"></div>';
            if($report_detail != null) {
                $output .= /** @lang text */
                    '
                <table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid black; font-size:11px;">
                <thead>
                <style>.middles{vertical-align:middle;}</style>
                <tr>
                    <th style="border:1px solid black" width="1%">No</th>
                    <th style="border:1px solid black" width="10%" class="middle"><center>Nama</center></th>
                    <th style="border:1px solid black" width="11%" class="middle"><center>Kegiatan</center></th>
                    <th style="border:1px solid black" width="4%" class="middle"><center>Uang Transport</center></th>
                    <th style="border:1px solid black" width="5%" class="middle"><center>Tanggal</center></th>
                </tr>
                </thead>
                <tbody>';
                $no = 1;
                foreach ($report_detail as $row) {
                    $output .= /** @lang text */'
                    <tr>
                        <td style="border:1px solid black"><center>' . $no++ . '</center></td>
                        <td style="border:1px solid black"><center>' . $row["nama_imam"] . '</center></td>
                        <td style="border:1px solid black"><center>' . $row["nama_kegiatan"] . '</center></td>
                        <td style="border:1px solid black"><center>' . number_format($row["uang_transport"]) . '</center></td>
                        <td style="border:1px solid black"><center>' . longdate_indo($row["waktu"]) . '</center></td>
                    </tr>';
                }
                $output .= '</tbody>';
                $output .= /** @lang text */'
					</tfoot>
                </table>
                <div>
                    <table width="100%">
                        <thead>
                            <tr>
                                <th width="50%"></th>
                                <th width="50%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center;">
                                    <b><br/><br/><br/><br/><br/>_____________<br/><br/>Ketua</b>
                                </td>
                                <td style="text-align:center;">
                                    <b><br/><br/><br/><br/><br/>_____________<br/><br/>Sekretaris</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                ';

                $file = 'laporan_jadwal.pdf';
                $output .= '</tbody></table>';
                $this->pdf->loadHtml($output);
                $this->pdf->render();
                $this->pdf->stream($file, array("Attachment" => 0));
            }
            else{
                echo "<script>alert('Data Tidak Ada'); window.location='".base_url()."bo/jadwal';</script>";
            }
        }

        if($aksi == "get"){
            $config = array();
            $config["base_url"] 				= "#";
            $config["total_rows"] 			= $count;
            $config["per_page"] 				= 12;
            $config["uri_segment"] 			= 4;
            $config["num_links"] 				= 1;
            $config["use_page_numbers"] = TRUE;
            $config['first_link'] 			= 'First';
            $config['last_link'] 				= 'Last';
            $config['next_link'] 				= /** @lang text */'<i class="md md-navigate-next"></i>';
            $config['prev_link'] 				= /** @lang text */'<i class="md md-navigate-before"></i>';
            $config['full_tag_open'] 		= /** @lang text */'<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close'] 	= /** @lang text */'</ul></nav></div>';
            $config['num_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] 		= /** @lang text */'</span></li>';
            $config['cur_tag_open']	 		= /** @lang text */'<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] 		= /** @lang text */'<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['next_tagl_close'] 	= /** @lang text */'<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close'] 	= /** @lang text */'</span>Next</li>';
            $config['first_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = /** @lang text */'</span></li>';
            $config['last_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['last_tagl_close'] 	= /** @lang text */'</span></li>';
            $this->pagination->initialize($config);
            $hal  	= $this->uri->segment(4);
            $start 	= ($hal - 1) * $config["per_page"];

            $read_data = $this->m_crud->join_data(
                "jadwal j", "j.*,k.id_kegiatan,k.nama_kegiatan",
                array(array("type"=>"LEFT","table"=>"pengurus p"),array("type"=>"LEFT","table"=>"masjid m"),array("type"=>"LEFT","table"=>"kegiatan k")),
                array("p.id_pengurus=j.id_pengurus", "m.id_masjid=j.id_masjid","k.id_kegiatan=j.id_kegiatan"),
                $where, "j.id_jadwal DESC", null, $config["per_page"], $start, null
            );

            $res_index = "";
            $no=0;
            if ($read_data != null) {
                foreach ($read_data as $row):
                    $no++;
                    $res_index .=
                        /** @lang text */
                        '<tr>
						    <td>'.$no.'</td>
						    <td>
                            <div class="dropdown">
                                <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Pilihan
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#!" onclick="showModal('."'".$row['kd_jadwal']."'".')">Edit</a></li>
                                    <li><a href="#!" onclick="hapus('."'".$row['kd_jadwal']."'".')">Hapus</a></li>
                                </ul>
                            </div>
                            </td>
							<td>' . $row["kd_jadwal"] . '</td>
							<td>' . $row["nama_imam"] . '</td>
							<td>' . $row["nama_kegiatan"] . '</td>
							<td>' . number_format($row["uang_transport"]) . '</td>
							<td>' . longdate_indo($row["waktu"]) . '</td>
							
						</tr>';
                endforeach;

            } else {
                $res_index .=
                    /**@lang text */
                    '<tr><td colspan="6"><h3 class="text-center">Tidak Ada Data</h3></td></tr>';
            }
            $data = array(
                "pagination_link" => $this->pagination->create_links(),
                "result_project" 	=> $res_index,
                "page"						=> $hal
            );
            echo json_encode($data);
        }
        elseif($aksi=='get_kegiatan'){
            $data = array("getKegiatan"=>$getKegitan);
            echo json_encode($data);
        }
        elseif($aksi == "get_param"){
            $getId 	= $this->m_crud->join(
                'jadwal.*,pengurus.nama_pengurus,pengurus.id_pengurus,kegiatan.nama_kegiatan,kegiatan.id_kegiatan',
                array('pengurus','kegiatan'),
                array('pengurus.id_pengurus = jadwal.id_pengurus', 'kegiatan.id_kegiatan=jadwal.id_kegiatan'),
                'jadwal',"jadwal.kd_jadwal = '".$_POST['kd_jadwal']."'",NULL,'id_jadwal','ASC'
            )->row_array();
            $data = array(
                "getId"			=> $getId,
            );
            echo json_encode($data);
        }
        elseif($aksi == "tambah"){
            $this->db->trans_begin();
            $response = array();
            $kode = $this->m_crud->generate_kode("jadwal",date("ym")).'-'.$this->nama_masjid['no_masjid'];
//            $kode = $this->m_crud->generate_kode("jadwal",date("ym"));
            if($nama_imam == ""){
                $response['pesan'] = 'Silahkan Isi Field Nama';
            }
            elseif($waktu == ""){
                $response['pesan'] = 'Silahkan Isi Field Tanggal';
            }else{
                $response['pesan'] = '';
                $data = array(
                    'id_masjid'		=> $id_masjid,
                    'id_pengurus'	=> $id_pengurus,
                    'id_kegiatan'	=> $_POST['id_kegiatan'],
                    'kd_jadwal'     => $kode,
                    'nama_imam'   	=> $nama_imam,
                    'uang_transport'=> $uang_transport,
                    'waktu'       	=> $waktu,
                );
                $this->m_crud->insert('jadwal',$data);
                $data_1 = array(
                    "id_pengurus" 	=> $id_pengurus,
                    "id_masjid"		=> $id_masjid,
                    "kd_kas"        => $kode,
                    "jenis_kas" 	=> "Kas-Keluar",
                    "kas_out"		=> $uang_transport,
                    "kas_in"        => 0,
                    "keterangan"	=> "biaya transport ustad/ustadzah $nama_imam",
                    "tanggal"		=> date("Y-m-d"),
                );
                $this->m_crud->insert('kas',$data_1);
                $this->m_crud->log("add","jadwal,kas",json_encode(array("jadwal"=>array($data),"kas"=>array($data_1))));

            }
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else {
                $this->db->trans_commit();
            }
            echo json_encode($response);
        }
        elseif($aksi == "edit"){
            $this->db->trans_begin();
            $response = array();
            if($nama_imam == ""){
                $response['pesan'] = 'nama imam tidak boleh kosong';
            }
            else{
                $response['pesan'] = '';
                $data = array(
                    'id_masjid'		    => $id_masjid,
                    'id_pengurus'	    => $id_pengurus,
                    'id_kegiatan'	    => $_POST['id_kegiatan'],
                    'nama_imam'         => $nama_imam,
                    'uang_transport'    => $uang_transport,
                );
                $where = array('kd_jadwal' => $_POST['kd_jadwal']);
                $this->m_crud->update('jadwal',$data,$where);

                $data_1 = array(
                    "id_pengurus" 	=> $id_pengurus,
                    "jenis_kas" 	=> "Kas-Keluar",
                    "kas_out"		=> $uang_transport,
                    "kas_in"        => 0,
                    "keterangan"	=> "biaya transport ustad/ustadzah $nama_imam",
                    "tanggal"		=> date("Y-m-d"),
                );
                $where = array('kd_kas' => $_POST['kd_jadwal']);
                $this->m_crud->update('kas',$data_1,$where);

                $this->m_crud->log("update","jadwal,kas",json_encode(array("jadwal"=>array($data),"kas"=>array($data_1))));
            }

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else {
                $this->db->trans_commit();
            }
            echo json_encode($response);
        }
        elseif($aksi == "hapus"){
            $this->db->trans_begin();
            $read_jadwal = $this->m_crud->get_data("jadwal","*","kd_jadwal='".$_POST['kd_jadwal']."'");
            $read_kas = $this->m_crud->get_data("kas","*","kd_kas='".$_POST['kd_jadwal']."'");
            $this->m_crud->log("delete","jadwal,kas",json_encode(array("jadwal"=>array($read_jadwal),"kas"=>array($read_kas))));
            $this->m_crud->delete("jadwal",array("kd_jadwal"=>$_POST['kd_jadwal']));
            $this->m_crud->delete("kas",array("kd_kas"=>$_POST['kd_jadwal']));
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else {
                $this->db->trans_commit();
            }
            echo json_encode(array("pesan"=>""));
        }else{
            $this->load->view('bo/layout/wrapper', $data);
        }
    }
    public function project($aksi=null){
        $this->access_denied(15);
        $id_masjid 		= $this->session->id_masjid;
        $page			= 'project';$table=$page;$where="project.id_masjid='$id_masjid'";
        $data 			= array('page'=>$page,'isi'=>'bo/pages/'.$page);
        $id_pengurus    = $this->input->post("id_pengurus");
        $nama       	= $this->input->post("nama_project");
        $keterangan 	= $this->input->post("keterangan_project");
        $tgl_mulai      = $this->input->post("tgl_mulai");
        $tgl_akhir      = $this->input->post("tgl_akhir");
        $status     	= $this->input->post("status_project");
        $biaya     		= str_replace(',', '', $this->input->post('biaya_anggaran'));
        $kas            = str_replace(',', '', $this->input->post('kas'));
        $donatur        = str_replace(',', '', $this->input->post('donatur'));
        $sumbangan      = str_replace(',', '', $this->input->post('sumbangan'));
        $sumber_dana    = str_replace(',', '', $this->input->post('total_sumber_dana'));
        $realisasi      = str_replace(',', '', $this->input->post('total_realisasi'));
        $total_biaya	= str_replace(',', '', $this->input->post('total_biaya_project'));

        $this->session->unset_userdata('search');
        if(isset($_POST['any'])) {
            $this->session->set_userdata('search', array(
                'any'	    => $_POST['any'],
                'periode'   => $_POST['periode'],
                'status'    => $_POST['status'],
            ));
        }

        $any 	    = $this->session->search['any'];
        $periode 	= $this->session->search['periode'];
        $step 	    = $this->session->search['status'];

        if(isset($any)&&$any!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "nama_project like '%".$any."%'";
        }
        if(isset($periode)&&$periode!=null){
            ($where == null) ? null : $where .= " AND ";
            $explode_date = explode(' - ', $periode);
            $tgl_awal 	= $explode_date[0];
            $tgl_akhir 	= $explode_date[1];
            $where.="DATE_FORMAT(tgl_mulai,'%Y-%m') between '".$tgl_awal."' and '".$tgl_akhir."' ";
        }
        if(isset($step)&&$step!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "status_project='".$step."'";
        }

        $count = $this->m_crud->count_data($table, "id_project", $where);

        if(isset($_POST['to_pdf'])){
            $report_detail = $this->m_crud->join_data(
                $table, "project.*,masjid.nama_masjid,masjid.id_masjid,pengurus.nama_pengurus,pengurus.id_pengurus,pengurus.photo_pengurus",
                array(array("type"=>"left","table"=>"pengurus"),array("type"=>"left","table"=>"masjid")),
                array("pengurus.id_pengurus=project.id_pengurus", "masjid.id_masjid=project.id_masjid"),
                $where, "id_project DESC"
            );

            $output="";
            $output.= "<h3 align='center'>LAPORAN PROJECT<br/> MASJID ".$this->nama_masjid['nama_masjid']."<br/><small><i>".$this->nama_masjid['alamat_masjid']."</i></small><br/>$tgl_awal-$tgl_akhir</h3>";
            $output.=$this->m_website->logo().'<div style="margin-bottom: 10px;padding:0px 0px 0px 0px;"></div>';
            if($report_detail != null) {
                $output .= /** @lang text */
                    '
                <table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid black; font-size:11px;">
                <thead>
                <style>.middles{vertical-align:middle;}</style>
                <tr>
                    <th style="border:1px solid black" width="1%" rowspan="2">No</th>
                    <th style="border:1px solid black" width="10%" rowspan="2" class="middle"><center>Nama</center></th>
                    <th style="border:1px solid black" width="11%" colspan="2" class="middle"><center>Tanggal</center></th>
                    <th style="border:1px solid black" width="4%" rowspan="2" class="middle"><center>Status</center></th>
                    <th style="border:1px solid black" width="10%" colspan="3"><center>Sumber Dana</center></th>
                    <th style="border:1px solid black" width="4%" colspan="2" class="middle"><center>Total</center></th>
                </tr>
                <tr>
                    <th style="border:1px solid black" width="5%"><center>Mulai</center></th>
                    <th style="border:1px solid black" width="5%"><center>Selesai</center></th>
                    <th style="border:1px solid black" width="5%"><center>Kas</center></th>
                    <th style="border:1px solid black" width="5%"><center>Donatur</center></th>
                    <th style="border:1px solid black" width="5%"><center>Sumbangan</center></th>
                    <th style="border:1px solid black" width="5%"><center>Sumber dana</center></th>
                    <th style="border:1px solid black" width="5%"><center>Anggaran</center></th>
                </tr>
                
                </thead>
                <tbody>';
                $no = 1;
                foreach ($report_detail as $row) {
                    $output .= /** @lang text */'
                    <tr>
                        <td style="border:1px solid black"><center>' . $no++ . '</center></td>
                        <td style="border:1px solid black"><center>' . $row["nama_project"] . '</center></td>
                        <td style="border:1px solid black"><center>' . $row["tgl_mulai"] . '</center></td>
                        <td style="border:1px solid black"><center>' . $row["tgl_akhir"] . '</center></td>
                        <td style="border:1px solid black"><center>' . $row["status_project"] . '</center></td>
                        <td style="text-align:right;border:1px solid black">' . number_format($row["kas"]) . '</td>
                        <td style="text-align:right;border:1px solid black">' . number_format($row["donatur"]) . '</td>
                        <td style="text-align:right;border:1px solid black">' . number_format($row["sumbangan"]) . '</td>
                        <td style="text-align:right;border:1px solid black">' . number_format($row["total_sumber_dana"]) . '</td>
                        <td style="text-align:right;border:1px solid black">' . number_format($row["total_realisasi"]) . '</td>
                    </tr>';

                }

                $total = $this->m_crud->read_data("project","sum(kas) kas, sum(donatur) donatur, sum(sumbangan) sumbangan, sum(total_sumber_dana) sumber_dana, sum(total_realisasi) realisasi",$where);
                foreach($total as $value){
                    $output.= /** @lang text */
                        '
                        <tr>
                            <td colspan="5">TOTAL</td>
                            <td colspan="1" style="text-align:right;">'.number_format($value["kas"]).'</td>
                            <td colspan="1" style="text-align:right;">'.number_format($value["donatur"]).'</td>
                            <td colspan="1" style="text-align:right;">'.number_format($value["sumbangan"]).'</td>
                            <td colspan="1" style="text-align:right;">'.number_format($value["sumber_dana"]).'</td>
                            <td colspan="1" style="text-align:right;">'.number_format($value["realisasi"]).'</td>
                        </tr>
                    ';
                }
                $output .= '</tbody>';
                $output .= /** @lang text */'
					</tfoot>
                </table>
                <div>
                    <table width="100%">
                        <thead>
                            <tr>
                                <th width="50%"></th>
                                <th width="50%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center;">
                                    <b><br/><br/><br/><br/><br/>_____________<br/><br/>Ketua</b>
                                </td>
                                <td style="text-align:center;">
                                    <b><br/><br/><br/><br/><br/>_____________<br/><br/>Sekretaris</b>
                                </td>
        
                            </tr>
                        </tbody>
                    </table>
                </div>
                ';

                $file = 'laporan_project.pdf';
                $output .= '</tbody></table>';
                $this->pdf->loadHtml($output);
                $this->pdf->render();
                $this->pdf->stream($file, array("Attachment" => 0));
            }
            else{
                echo "<script>alert('Data Tidak Ada'); window.location='".base_url()."bo/kas';</script>";
            }
        }



        if($aksi=="get"){
            $config = array();
            $config["base_url"] 		= "#";
            $config["total_rows"] 		= $count;
            $config["per_page"] 		= 5;
            $config["uri_segment"] 		= 4;
            $config["num_links"] 		= 5;
            $config["use_page_numbers"] = TRUE;
            $config['first_link'] 		= 'First';
            $config['last_link'] 		= 'Last';
            $config['next_link'] 		= /** @lang text */'<i class="md md-navigate-next"></i>';
            $config['prev_link'] 		= /** @lang text */'<i class="md md-navigate-before"></i>';
            $config['full_tag_open'] 	= /** @lang text */'<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close'] 	= /** @lang text */'</ul></nav></div>';
            $config['num_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] 	= /** @lang text */'</span></li>';
            $config['cur_tag_open']	 	= /** @lang text */'<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] 	= /** @lang text */'<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['next_tagl_close'] 	= /** @lang text */'<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close'] 	= /** @lang text */'</span>Next</li>';
            $config['first_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = /** @lang text */'</span></li>';
            $config['last_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['last_tagl_close'] 	= /** @lang text */'</span></li>';
            $this->pagination->initialize($config);
            $hal  	= $this->uri->segment(4);
            $start 	= ($hal - 1) * $config["per_page"];
            $read_data = $this->m_crud->join_data(
                $table, "project.*,masjid.nama_masjid,masjid.id_masjid,pengurus.nama_pengurus,pengurus.id_pengurus,pengurus.photo_pengurus",
                array(array("type"=>"left","table"=>"pengurus"),array("type"=>"left","table"=>"masjid")),
                array("pengurus.id_pengurus=project.id_pengurus", "masjid.id_masjid=project.id_masjid"),
                $where, "id_project DESC", null, $config["per_page"], $start, null
            );
            $res_index = "";
            if($read_data != null){
                foreach ($read_data as $row):
                    $kas = $row["kas"] ? number_format($row["kas"]) : " 0 ";
                    $don = $row["donatur"] ? number_format($row["donatur"]) : " 0 ";
                    $sum = $row["sumbangan"] ? number_format($row["sumbangan"]) : " 0 ";
                    $tot = number_format($row["total_sumber_dana"]);
                    $res_index.=
                        /**@lang text */
                        '<div class="col-md-12 col-sm-12 col-xs-12 image-section" onclick="showModal('."'".$row["kd_project"]."'".')" title="Click Untuk Diedit">
						<img src="'.base_url($row["foto"]).'" id="image-section">
					</div>
					<div class="row user-left-part" style="margin-bottom:10px;">
						<div class="col-md-2 col-sm-3 col-xs-12 user-profil-part pull-left">
							<div class="row">
								<div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
									<img src="'.base_url($row["photo_pengurus"]).'" class="rounded-circle">
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
									<button id="btn-contact" class="btn btn-success btn-block follow">'.$row["nama_pengurus"].'</button>
								</div>
							</div>
						</div>
						<div class="col-md-10 col-sm-10 col-xs-12 pull-right profile-right-section">
							<div class="row profile-right-section-row">
								<div class="col-md-12 profile-header">
								 	<div class="row noPadding">
									 	<div class="col-md-12">
									 		<h3 class="text-project text-center">'.$row["nama_project"].'</h3>
									 	</div>
									 	<div class="row bs-wizard" style="border-bottom:0;">';
                    if($row["status_project"] == "Perencanaan"){
                        $res_index.=
                            /**@lang text */
                            '<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Perencanaan</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step disabled">
												<div class="text-center bs-wizard-stepnum">Disetujui</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step disabled">
												<div class="text-center bs-wizard-stepnum">Dimulai</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step disabled">
												<div class="text-center bs-wizard-stepnum">Selesai</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>';
                    }elseif($row["status_project"] == "Disetujui"){
                        $res_index.=
                            /**@lang text */
                            '<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Perencanaan</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Disetujui</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step disabled">
												<div class="text-center bs-wizard-stepnum">Dimulai</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step disabled">
												<div class="text-center bs-wizard-stepnum">Selesai</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>';
                    }elseif($row["status_project"] == "Dimulai"){
                        $res_index.=
                            /**@lang text */
                            '<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Perencanaan</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Disetujui</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Dimulai</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step disabled">
												<div class="text-center bs-wizard-stepnum">Selesai</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>';
                    }else{
                        $res_index.=
                            /**@lang text */
                            '<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Perencanaan</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Disetujui</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Dimulai</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>
											<div class="col-xs-3 bs-wizard-step complete">
												<div class="text-center bs-wizard-stepnum">Selesai</div>
												<div class="progress"><div class="progress-bar"></div></div>
												<a class="bs-wizard-dot"></a>
												<div class="bs-wizard-info text-center"></div>
											</div>';
                    }
                    $res_index.=
                        /**@lang text */
                        '</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12 profile-header-section1 pull-left">
										<div class="row">
											<div class="col-md-6 col-xs-6"><label>Tanggal Mulai</label></div>
											<div class="col-md-6 col-xs-6"><p>: '.longdate_indo($row["tgl_mulai"]).'</p></div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-6"><label>Tanggal Akhir</label></div>
											<div class="col-md-6 col-xs-6"><p>: '.longdate_indo($row["tgl_akhir"]).'</p></div>
										</div>
										<div class="row">
											<div class="col-md-12"><p style="text-align:justify;"> '.$row["keterangan_project"].'</p></div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6  table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Kas</th><th>Donatur</th><th>Sumbangan</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Rp '.$kas.'</td>
													<td>Rp '.$don.'</td>
													<td>Rp '.$sum.'</td>
												</tr>
											</tbody>
										</table>
										<table class="table">
											<thead>
												<tr>
													<th>Anggaran</th><th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Rp '.number_format($row["biaya_anggaran"]).'</td>
													<td>Rp '.$tot.'</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr/>';
                endforeach;
            }else{ $res_index.=/**@lang text */"<h3 class='text-center'>Data Tidak Ada</h3>";}
            $data = array(
                "pagination_link" => $this->pagination->create_links(),
                "result_project"  => $res_index,
                "page"						=> $hal
            );
            echo json_encode($data);
        }
        elseif($aksi == "get_param"){
            $getId 		    = $this->m_crud->join(
                'project.*,pengurus.nama_pengurus,pengurus.id_pengurus',
                array(array("type"=>"left","table"=>"pengurus")),
                array('pengurus.id_pengurus = project.id_pengurus'),
                'project',"project.kd_project = '".$_POST['kd_project']."'",NULL,'id_project','ASC'
            )->row_array();
            $data = array("get_id" 	=> $getId,);
            echo json_encode($data);
        }
        elseif($aksi=="simpan"){
            $this->db->trans_begin();
            $path = 'assets/upload/project';
            $config['upload_path']          = './'.$path;
            $config['allowed_types']        = 'bmp|gif|jpg|jpeg|png';
            $config['max_size']             = 5120;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $input_file = array('1'=>'file_upload');
            $valid = true;

            foreach($input_file as $row){
                if( (! $this->upload->do_upload($row)) && $_FILES[$row]['name']!=null){
                    $file[$row]['file_name']=null;
                    $file[$row] = $this->upload->data();
                    $valid = false;
                    $data['error_'.$row] = $this->upload->display_errors();
                    break;
                } else{
                    $file[$row] = $this->upload->data();
                    $data[$row] = $file;
                    if($file[$row]['file_name']!=null){
                        $manipulasi['image_library']    = 'gd2';
                        $manipulasi['source_image']     = $file[$row]['full_path'];
                        $manipulasi['maintain_ratio']   = true;
                        $manipulasi['width']            = 500;
                        $manipulasi['new_image']        = $file[$row]['full_path'];
                        $this->load->library('image_lib', $manipulasi);
                        $this->image_lib->resize();
                    }
                }
            }
            if($valid==true) {
                $kode = $this->m_crud->generate_kode("project",date("ym")).'-'.$this->nama_masjid['no_masjid'];
                $data_project = array(
                    'id_masjid'           => $id_masjid,
                    'id_pengurus'         => $id_pengurus,
                    'nama_project'        => $nama,
                    'keterangan_project'  => $keterangan,
                    'tgl_mulai'           => $tgl_mulai,
                    'tgl_akhir'           => $tgl_akhir,
                    'status_project'      => $status,
                    'biaya_anggaran'      => $biaya,
                    'kas'                 => $kas==""?0:$kas,
                    'donatur'             => $donatur,
                    'sumbangan'           => $sumbangan,
                    'total_sumber_dana'   => $sumber_dana,
                    'total_realisasi'     => $realisasi,
                    'total_biaya_project' => $total_biaya,
                );

                if($_FILES['file_upload']['name']!=null) {
                    $data_project['foto' ] = ($_FILES['file_upload']['name']!=null)?($path.'/'.$file['file_upload']['file_name']):null;
                    if($_POST['file_uploaded']!=null||$_POST['file_uploaded']!=''){
                        unlink($_POST['file_uploaded']);
                    }
                }

                $data_kas = array(
                    "id_pengurus" 	=> $id_pengurus,
                    "id_masjid"		=> $id_masjid,
                    "jenis_kas" 	=> "Kas-Keluar",
                    "kas_out"		=> $kas,
                    "kas_in"        => 0,
                    "keterangan"	=> "Project $nama",
                    "tanggal"		=> date("Y-m-d"),
                );

                $data_log = array(
                    "id_masjid"     => $id_masjid,
                    "id_pengurus"   => $this->session->id_pengurus,
                    "keterangan"    => "Project,Kas"
                );

                if ($_POST['param'] == 'add') {
                    $response['error']  = false;
                    $response['pesan']  = "berhasil di insert ke table pengurus";
                    $data_project['kd_project'] = $kode;
                    $data_kas['kd_kas'] = $kode;
                    $this->m_crud->create_data("project", $data_project);
                    if($kas != "" || $kas!=null || $kas!=0) {
                        $this->m_crud->create_data("kas", $data_kas);
                    }

                    $data_log["data"] = json_encode(array("kas"=>array($data_kas),"project"=>array($data_project)));
                    $data_log['aksi'] = 'add';
                    $this->m_crud->create_data("log", $data_log);

                } else {
                    $kode = $_POST['kd_project'];
                    if($kode){
                        $this->m_crud->update_data("project", $data_project, "kd_project='".$kode."'");
                        if($kas!=""||$kas!=null||$kas!=0){
                            $data_kas = array(
                                "id_pengurus" 	=> $id_pengurus,
                                "kas_out"		=> $kas,
                                "keterangan"	=> "Project $nama",
                            );
                            $this->m_crud->update_data("kas",$data_kas,array("kd_kas" => $_POST['kd_project']));
                        }else{
                            $this->m_crud->delete("kas",array("kd_kas"=>$kode));
                        }
                        $response['error'] = false;
                        $response['pesan'] = "berhasil di update ke table pengurus";
                    }

                    $data_log["data"] = json_encode(array("kas"=>array($data_kas),"project"=>array($data_project)));
                    $data_log['aksi'] = 'update';
                    $this->m_crud->create_data("log", $data_log);
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            echo json_encode($response);
        }
        elseif($aksi=="hapus"){

        }else{
            $this->load->view("bo/layout/wrapper",$data);
        }
    }
    public function kas($aksi=null,$hal=1){
        $this->access_denied(20);
        $id_masjid 	= $this->session->id_masjid;
        $input = $this->input->post();
        $page = 'kas';
        $table= $page;
        $where=null;$where_=null;
        $this->session->unset_userdata('search');
        if($this->uri->segment(2)!=$page){

        }
        if(isset($input['search'])) {
            $this->session->set_userdata('search', array(
                'any'	    => $input['any'],
                'periode'   => $input['periode'],
                'option_kas'=> $input['option_kas'],
            ));
        }

        $search 	= $this->session->search['any'];
        $periode 	= $this->session->search['periode'];
        $option 	= $this->session->search['option_kas'];


//        echo $periode;
        if(isset($search)&&$search!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "kd_kas like '%".$search."%'";
        }
        if(isset($option)&&$option!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "jenis_kas='".$option."'";
        }

        if(isset($periode)&&$periode!=null){
            ($where == null) ? null : $where .= " AND ";
            ($where_ == null) ? null : $where_ .= " AND ";
            $explode_date = explode(' - ', $periode);
            $tgl_awal = $explode_date[0];
            $tgl_akhir = $explode_date[1];
            $where.="tanggal between '".$tgl_awal."' and '".$tgl_akhir."' ";
            $where_.="kas.id_masjid='".$id_masjid."' and tanggal between '".$tgl_awal."' and '".$tgl_akhir."' ";
        }else{
            $where_.="kas.id_masjid='".$id_masjid."'";
        }

        $count = $this->m_crud->count_data($table, "id_kas", $where == null ? "id_masjid='$id_masjid '" : $where);

        $data = array('page'=>$page,'isi'=>'bo/pages/'.$page);
        if($aksi=="cetak"){
            if(isset($_POST['to_pdf'])){
                $nama_masjid = $this->nama_masjid;
                $param=" kas.id_masjid='$id_masjid'";
                if($input["option_kas"]) {
                    ($param == null) ? null : $param .= " AND ";
                    $param .= "jenis_kas='".$input["option_kas"]."'";
                }
                if($input["periode"]){
                    ($param == null) ? null : $param .= " AND ";
                    $explode_date = explode(' - ', $input["periode"]);
                    $tgl_awal 	= $explode_date[0];
                    $tgl_akhir 	= $explode_date[1];
                    $param.="tanggal between '".$tgl_awal."' and '".$tgl_akhir."' ";
                }
                $report_detail = $this->m_crud->join_data(
                    $table, "kas.*,masjid.nama_masjid,masjid.id_masjid,pengurus.nama_pengurus,pengurus.id_pengurus,pengurus.photo_pengurus",
                    array(array("type"=>"LEFT","table"=>"pengurus"),array("type"=>"LEFT","table"=>"masjid")),
                    array("pengurus.id_pengurus=kas.id_pengurus", "masjid.id_masjid=kas.id_masjid"),
                    $param,"id_kas asc"
                );


                $report_total = $this->m_crud->read_data("kas","sum(kas_in) masuk,sum(kas_out) keluar,sum(kas_in-kas.kas_out) saldo",$param);

                $output="";
                $output.= "<h3 align='center'>LAPORAN KAS<br/> MASJID ".$nama_masjid['nama_masjid']."<br/><small><i>".$nama_masjid['alamat_masjid']."</i></small><br/>$tgl_awal-$tgl_akhir</h3>";
                $output.=$this->m_website->logo().'<div style="margin-bottom: 10px;padding:0px 0px 0px 0px;"></div>';

                if($report_detail != null) {
                    $output .= /** @lang text */
                        '
					<table width="100%" cellpadding="5" cellspacing="0" style="border:1px solid black; font-size:11px;">
					<thead>
					<tr>
						<th style="border:1px solid black" width="1%"><center>No</center></th>
						<th style="border:1px solid black" width="10%"><center>Jenis</center></th>
						<th style="border:1px solid black" width="10%"><center>Masuk</center></th>
						<th style="border:1px solid black" width="10%"><center>Keluar</center></th>
						<th style="border:1px solid black" width="10%"><center>Saldo</center></th>
						<th style="border:1px solid black" width="50%"><center>Keterangan</center></th>
					</tr>
					</thead>
					<tbody>';
                    $no = 1;
                    $balance = 0;
                    foreach ($report_detail as $row) {
                        $keluar = $row['kas_out']!=0?number_format($row['kas_out']):0;
                        $masuk = $row['kas_in']!=0?number_format($row['kas_in']):0;
                        $balance = ($balance + $row['kas_in'] - $row['kas_out']);
                        $output .= /** @lang text */'
						<tr>
							<td style="border:1px solid black"><center>' . $no++ . '</center></td>
							<td style="border:1px solid black"><center>' . $row["jenis_kas"] . '</center></td>
							<td style="border:1px solid black;text-align: right;">' . $masuk . '</td>
							<td style="border:1px solid black;text-align: right;">' . $keluar . '</td>
							<td style="border:1px solid black;text-align: right;">' . number_format($balance) . '</td>
							<td style="border:1px solid black"><center>' . $row["keterangan"] . '</center></td>
						</tr>';
                    }
                    $output .= '
					</tbody>
					<tfoot>';
                    foreach ($report_total as $total):
                        $output .= /** @lang text */
                            '
                        <tr>
							<td colspan="2">Total</td>
							<td colspan="1" style="text-align: right">' . number_format($total["masuk"]) . '</td>
							<td colspan="1" style="text-align: right">' . number_format($total["keluar"]) . '</td>
							<td colspan="1" style="text-align: right">'.number_format($total["saldo"]).'</td>
							<td colspan="1">&nbsp;</td>
						</tr>
						
						';

                    endforeach;
                    $output .= /** @lang text */'
					</tfoot>
					</table>
					<div>
						<table width="100%">
							<thead>
								<tr>
									<th width="50%"></th>
									<th width="50%"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align:center;">
										<b><br/>Ketua<br/><br/><br/><br/>_____________<br/><br/>'.$this->ketua['nama_pengurus'].'</b>
									</td>
									<td style="text-align:center;">
										<b><br/>Bendahara<br/><br/><br/><br/>_____________<br/><br/>'.$this->bendahara['nama_pengurus'].'</b>
									</td>
			
								</tr>
							</tbody>
						</table>
					</div>
					
					';

                    $file = 'laporan_kas.pdf';
                    $output .= '</tbody></table>';
                    $this->pdf->loadHtml($output);
                    $this->pdf->render();
                    $this->pdf->stream($file, array("Attachment" => 0));
                }
                else{
                    echo "<script>alert('Data Tidak Ada'); window.location='".base_url()."bo/kas';</script>";
                }
            }
            else{
                if(isset($_POST['to_excel'])){
                    $nama_masjid = $this->nama_masjid;
                    $param=" kas.id_masjid='$id_masjid'";
                    if($this->input->post("option_kas")) {
                        ($param == null) ? null : $param .= " AND ";
                        $param .= "jenis_kas='".$this->input->post("option_kas")."'";
                    }
                    if($this->input->post("periode")){
                        ($param == null) ? null : $param .= " AND ";
                        $explode_date = explode(' - ', $this->input->post("periode"));
                        $tgl_awal 	= $explode_date[0];
                        $tgl_akhir 	= $explode_date[1];
                        $param.="tanggal between '".$tgl_awal."' and '".$tgl_akhir."' ";
                    }
                    $result = $this->m_crud->join_data(
                        $table, "kas.*,masjid.nama_masjid,masjid.id_masjid,pengurus.nama_pengurus,pengurus.id_pengurus,pengurus.photo_pengurus",
                        array(array("type"=>"LEFT","table"=>"pengurus"),array("type"=>"LEFT","table"=>"masjid")),
                        array("pengurus.id_pengurus=kas.id_pengurus", "masjid.id_masjid=kas.id_masjid"),
                        $param,"id_kas asc"
                    );

                    $header = array(
                        'merge' => array('A1:E1', 'A2:E2', 'A3:E3'),
                        'auto_size' => true,
                        'font' => array(
                            'A1:A2' => array('bold' => true, 'color' => array('rgb' => '000000'), 'size' => 10, 'name' => 'Verdana'),
                            'A3' => array('bold' => true, 'name' => 'Verdana'),
                            'A5:E5' => array('bold' => true, 'size' => 9, 'name' => 'Verdana')
                        ),
                        'alignment' => array(
                            'A1:A3' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
                            'A5:E5' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                        ),
                        '1' => array('A' => $nama_masjid['nama_masjid']),
                        '2' => array('A' => "LAPORAN KAS"),
                        '3' => array('A' => $tgl_awal."-".$tgl_akhir),
                        '5' => array('A' => 'Jenis', 'B' => 'Keterangan', 'C' => 'Kas Masuk', 'D' => 'Kas Keluar', 'E' => 'Saldo')
                    );
                    $i = 0;
                    $balance=0;
                    foreach ($result as $key => $row) {
                        $keluar = $row['kas_out']!=0?number_format($row['kas_out']):0;
                        $masuk = $row['kas_in']!=0?number_format($row['kas_in']):0;
                        $i++;
                        $balance = ($balance + $row['kas_in'] - $row['kas_out']);
                        $body[$key] = array(
                            $row['jenis_kas'],
                            $row['keterangan'],
                            $masuk,
                            $keluar,
                            number_format($balance),

                        );

                    }

                    array_push($header['merge'], 'A' . ($i + 7) . ':J' . ($i + 7) . '');

                    $header['font']['A' . ($i + 7) . ':E' . ($i + 7) . ''] = array('bold' => true, 'size' => 9, 'name' => 'Verdana');

                    $this->m_export_file->to_excel(str_replace(' ', '_', "LAPORAN_KAS"), $header, $body);
                }
            }
        }


        if($aksi == "get"){
            $config = array();
            $config["base_url"] 		= "#";
            $config["total_rows"] 		= $count;
            $config["per_page"] 		= 30;
            $config["uri_segment"] 		= 4;
            $config["num_links"] 		= 1;
            $config["use_page_numbers"] = TRUE;
            $config['first_link'] 		= 'First';
            $config['last_link'] 		= 'Last';
            $config['next_link'] 		= /** @lang text */'<i class="md md-navigate-next"></i>';
            $config['prev_link'] 		= /** @lang text */'<i class="md md-navigate-before"></i>';
            $config['full_tag_open'] 	= /** @lang text */'<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close'] 	= /** @lang text */'</ul></nav></div>';
            $config['num_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] 	= /** @lang text */'</span></li>';
            $config['cur_tag_open']	 	= /** @lang text */'<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] 	= /** @lang text */'<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['next_tagl_close'] 	= /** @lang text */'<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close'] 	= /** @lang text */'</span>Next</li>';
            $config['first_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = /** @lang text */'</span></li>';
            $config['last_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['last_tagl_close'] 	= /** @lang text */'</span></li>';
            $this->pagination->initialize($config);
            $start 	= ($hal - 1) * $config["per_page"];

            $total = $this->m_crud->get_data("kas","sum(kas_in) masuk,sum(kas_out) keluar,sum(kas_in-kas_out) saldo",$where_);

            $read_data = $this->m_crud->join_data(
                $table, "kas.*,masjid.nama_masjid,masjid.id_masjid,pengurus.nama_pengurus,pengurus.id_pengurus,pengurus.photo_pengurus",
                array(array("type"=>"LEFT","table"=>"pengurus"),array("type"=>"LEFT","table"=>"masjid")),
                array("pengurus.id_pengurus=kas.id_pengurus", "masjid.id_masjid=kas.id_masjid"),
                $where,"id_kas desc", null, $config["per_page"], $start, null
            );

            $res_index = "";
            $res_total_per_page="";
            $res_total="";
            $no = $start+1;
            $saldo_per_page=0;
            $masuk_per_page=0;
            $keluar_per_page=0;
            $balance = 0;
            if ($read_data != null) {
                foreach ($read_data as $row):
                    $balance = ($balance + $row['kas_in'] - $row['kas_out']);
                    $keluar = $row['kas_out']!=0?number_format($row['kas_out']):0;
                    $masuk = $row['kas_in']!=0?number_format($row['kas_in']):0;
                    $res_index .=/** @lang text */
                        '<tr>
						    <td>'.$no++.'</td>
							<td>' . $row["kd_kas"] . '</td>
							<td>' . longdate_indo($row["tanggal"]) . '</td>
							<td>' . $row["jenis_kas"] . '</td>
							<td>' . $row["keterangan"] . '</td>
							<td style="text-align:right">' . $masuk . '</td>
							<td style="text-align:right">' . $keluar . '</td>
							<td style="text-align:right">'.number_format($balance) .'</td>
						</tr>';

                    $masuk_per_page = ($masuk_per_page+$row['kas_in']);
                    $keluar_per_page = $keluar_per_page+$row['kas_out'];
                    $saldo_per_page = $saldo_per_page+($row['kas_in']-$row['kas_out']);
                endforeach;

                $res_total_per_page.='
				    <tr>
				        <td colspan="5" style="font-weight: bold;">TOTAL PER PAGE</td>
				        <td colspan="1" style="font-weight: bold;text-align: right">Rp. '.number_format($masuk_per_page).'</td>
				        <td colspan="1" style="font-weight: bold;text-align: right">Rp. '.number_format($keluar_per_page).'</td>
				        <td colspan="1" style="font-weight: bold;text-align: right">Rp. '.number_format($saldo_per_page).'</td>
                    </tr>
				';
                $res_total.='
                    <tr>
				        <td colspan="5" style="font-weight: bold;">TOTAL</td>
				        <td colspan="1" style="font-weight: bold;text-align: right">Rp. '.number_format($total["masuk"]).'</td>
				        <td colspan="1" style="font-weight: bold;text-align: right">Rp. '.number_format($total["keluar"]).'</td>
				        <td colspan="1" style="font-weight: bold;text-align: right">Rp. '.number_format($total["saldo"]).'</td>
                    </tr>
                ';

            } else {
                $res_index .=/**@lang text */'<tr><td colspan="8"><h3 class="text-center">Tidak Ada Data</h3></td><tr>';
            }
            if (!empty($this)) {
                $data = array(
                    "pagination_link"   => $this->pagination->create_links(),
                    "result_project" 	=> $res_index,
                    "page"			    => $this->uri->segment(4),
                    "total_per_page"    => $res_total_per_page,
                    "total"             => $res_total,

                );
            }
            echo json_encode($data);
        }

        elseif($aksi == "tambah"){
            $response = array();
            $response["pesan"] = "";
            $data_kas = array(
                "id_masjid"		=> $id_masjid,
                "id_pengurus"	=> $input['id_pengurus'],
                "kd_kas"        => $this->m_crud->generate_kode("kas",date("ym")).'-'.$this->nama_masjid['no_masjid'],
                "jenis_kas"		=> $input["jenis_kas"],
                "kas_in"		=> $input["kas_in"],
                "kas_out"		=> $input["kas_out"],
                "tanggal"		=> $input["tanggal"],
                "keterangan"	=> $input["keterangan"],

            );
            $this->m_crud->insert("kas",$data_kas);
            $data_log = array(
                "id_masjid"=>$id_masjid,
                "id_pengurus"=>$this->session->id_pengurus,
                "keterangan"=> "kas",
                "aksi"=>"add",
                "data"=> json_encode(array("kas"=>array($data_kas))),
            );
            $this->m_crud->insert("log",$data_log);
            echo json_encode($response);
        }
        elseif($aksi == "edit"){
            $response = array();
            $response["pesan"] = "";
            $data = array(
                "id_masjid"		=> $id_masjid,
                "id_pengurus"	=> $input['id_pengurus'],
                "jenis_kas"		=> $input["jenis_kas"],
                "kas_in"		=> $input["kas_in"],
                "kas_out"		=> $input["kas_out"],
                "tanggal"		=> $input["tanggal"],
                "keterangan"	=> $input["keterangan"],
            );
            $where = array("id_kas" => $input['id_kas']);
            $this->m_crud->update("kas",$data,$where);
            echo json_encode($response);
        }
        elseif($aksi == "hapus"){
            $where = array("id_kas" => $input['id_kas']);
            $data  = $this->m_crud->delete("kas",$where);
            echo json_encode($data);
        }

        else{
            $this->load->view('bo/layout/wrapper',$data);
        }
    }
	public function kegiatan($aksi=null){
        $this->access_denied(25);
		$page = 'kegiatan';
		$table= $page;
		$id_masjid 	= $this->session->id_masjid;
		$id_pengurus= $this->input->post("id_pengurus");
		$id 		= $this->input->post("id_kegiatan");
		$jenis 		= $this->input->post("nama_kegiatan");
		$getId 		= $this->m_crud->get_where($table,array("id_kegiatan"=>$id))->row_array();
//		$getPengurus 	= $this->m_crud->get("nama_pengurus,id_pengurus", "pengurus", "id_masjid=$id_masjid")->result_array();
		
		
		$where=null;
		isset($_POST["search"]) ? $this->session->set_userdata('search', array('any' => $_POST['any'])) : null;
		$search = $this->session->search['any'];
		if(isset($search)&&$search!=null) {
			($where == null) ? null : $where .= " AND ";
			$where .= "nama_kegiatan like '%".$search."%' AND $table.id_masjid='$id_masjid'";
		}
		$count = $this->m_crud->count_data($table, "id_$table", $where == null ? "$table.id_masjid='$id_masjid '" : $where);
		$data = array('page'=> $page, 'isi'=> 'bo/pages/'.$page);
		if($aksi == "get"){
			$config =array();
			$config["base_url"] 		= "#";
			$config["total_rows"] 		= $count;
			$config["per_page"] 		= 12;
			$config["uri_segment"] 		= 4;
			$config["num_links"] 		= 1;
			$config["use_page_numbers"] = TRUE;
			$config['first_link'] 		= 'First';
			$config['last_link'] 		= 'Last';
			$config['next_link'] 		= /** @lang text */'<i class="md md-navigate-next"></i>';
			$config['prev_link'] 		= /** @lang text */'<i class="md md-navigate-before"></i>';
			$config['full_tag_open'] 	= /** @lang text */'<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close'] 	= /** @lang text */'</ul></nav></div>';
			$config['num_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] 	= /** @lang text */'</span></li>';
			$config['cur_tag_open']	 	= /** @lang text */'<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] 	= /** @lang text */'<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] 	= /** @lang text */'<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] 	= /** @lang text */'</span>Next</li>';
			$config['first_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = /** @lang text */'</span></li>';
			$config['last_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] 	= /** @lang text */'</span></li>';
			$this->pagination->initialize($config);
			$hal  	= $this->uri->segment(4);
			$start 	= ($hal - 1) * $config["per_page"];
			
			$read_data = $this->m_crud->read_data(
				$table, "*", $where == null ? "$table.id_masjid='$id_masjid '" : $where, "id_$table DESC", null, $config["per_page"], $start
			);
			
			$res_index = "";
			if ($read_data != null) {
				foreach ($read_data as $row):
					$res_index.=
						/**@lang text */
						'<div class="col-lg-3">
						<div class="panel panel-border panel-primary">
							<div class="panel-heading"></div>
							<div class="panel-body">
								<div class="col-md-6 noPadding">
									<h3 class="panel-title">'.$row["nama_kegiatan"].'</h3>
								</div>
								<div class="col-md-6 noPadding">
									<h3 class="panel-title" style="float:right">
										<button class="btn btn-primary btn-xs" onclick="edit(\'' . $row['id_kegiatan'] . '\')">
											<i class="fa fa-pencil"></i>
										</button>
										<button class="btn btn-primary btn-xs" onclick="hapus(\'' . $row['id_kegiatan'] . '\')">
											<i class="fa fa-trash"></i>
										</button>
									</h3>
								</div>
							</div>
						</div>
					</div>';
				endforeach;
			}else{
				$res_index .=
					/**@lang text */
					'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 class="text-center">Tidak Ada Data</h3>
				</div>';
			}
			$data = array(
				"pagination_link"=> $this->pagination->create_links(),
				"result_project" => $res_index,
				"page"			 => $hal
            );
			echo json_encode($data);
		}
		elseif($aksi == "isExist"){
			$where = "nama_$table='".$_POST['nama_kegiatan']."'";
			$_POST['param']=='edit'?$where.=" AND nama_$table<>'".$_POST['nama_kegiatan']."'":null;
			$isExist = $this->m_crud->get_data($table, "nama_$table", $where);
			echo $isExist==null?'true':'false';
		}
		elseif($aksi == "simpan"){
			$response=array();
			$new_data = array(
				"id_masjid"=>$id_masjid,
				"nama_$table" => $_POST['nama_kegiatan']
			);
            $data_log = array(
                "id_masjid"=>$id_masjid,
                "id_pengurus"=>$this->session->id_pengurus,
                "keterangan"=> $table
            );

			
			if ($_POST['param'] == 'add') {
				$response['pesan']="";
				$this->m_crud->insert($table, $new_data);
				$data_log['data'] = json_encode(array("kegiatan"=>array($new_data)));
				$data_log['aksi'] = 'add';
                $this->m_crud->insert("log", $data_log);
			} else {
				$response['pesan']="";
				$id = $_POST['id'];
				$this->m_crud->update_data($table, $new_data, "id_$table='".$id."'");
                $data_log['data'] = json_encode(array("kegiatan"=>array($new_data)));
                $data_log['aksi'] = 'update';
                $this->m_crud->insert("log", $data_log);
			}
			
			echo json_encode($response);
			
		}
		elseif($aksi=="edit"){
			$get_data = $this->m_crud->get_data($table, "*", "id_$table='".$_POST['id']."'");
			$result = array();
			if ($get_data != null) {
				$result['status'] = true;
				$result['res_data'] = $get_data;
			} else {
				$result['status'] = false;
			}
			
			echo json_encode($result);
		}
		elseif($aksi == "hapus") {
		    $read_data = $this->m_crud->get_data($table,"*","id_$table = '".$_POST['id']."'");
            $data_log = array(
                "id_masjid"=>$id_masjid,
                "id_pengurus"=>$this->session->id_pengurus,
                "aksi"=>"delete",
                "keterangan"=>$table,
                "data"=>json_encode(array("kegiatan"=>$read_data))
            );
            $this->m_crud->insert("log",$data_log);
			$delete_data = $this->m_crud->delete_data($table, "id_$table = '".$_POST['id']."'");

			echo $delete_data?$status=true:false;
		}
		else{
			$this->load->view('bo/layout/wrapper',$data);
		}
	}
    public function assets($aksi=null){
        $this->access_denied(30);
		$table 	= 'assets';
		$where 	= null;
		$page 	= $table;
		$data = array('page'=>$page,'isi'=>'bo/pages/'.$page);
		$id_masjid 			= $this->session->id_masjid;
		$id_pengurus 		= $this->input->post("id_pengurus");
		$id_kel_assets	= $this->input->post("id_kel_assets");
		$id							= $this->input->post("id_assets");
		$nama						= $this->input->post("nama_assets");
		$tgl_beli				= $this->input->post("tgl_beli_assets");
		$qty						= $this->input->post("qty_assets");
		$harga					= str_replace(',', '', $this->input->post('harga_assets'));
		$umur						= $this->input->post("umur_assets");
		$supplier				= $this->input->post("supplier");
		$getIdAssets 		= $this->m_crud->join(
			'assets.*,pengurus.nama_pengurus,pengurus.id_pengurus,kel_assets.id_kel_assets,kel_assets.nama_kel_assets',
			array(array("type"=>"left","table"=>"pengurus"),array("type"=>"left","table"=>"kel_assets")),
			array('pengurus.id_pengurus = assets.id_pengurus','kel_assets.id_kel_assets=assets.id_kel_assets'),
			'assets',"assets.id_assets = '$id'",NULL,'id_assets','ASC'
		)->row_array();
		
		$this->session->unset_userdata('search');
		isset($_POST["search"]) ? $this->session->set_userdata('search', array('any' => $_POST['any'])) : null;
		$search = $this->session->search['any'];
		if(isset($search)&&$search!=null) {
			($where == null) ? null : $where .= " AND ";
			$where .= "nama_assets like '%".$search."%' AND assets.id_masjid='$id_masjid '";
		}
		$count = $this->m_crud->count_data($table, "id_assets", $where == null ? "assets.id_masjid='$id_masjid '" : $where);
		if($aksi == "get"){
			$config = array();
			$config["base_url"] 				= "#";
			$config["total_rows"] 			= $count;
			$config["per_page"] 				= 12;
			$config["uri_segment"] 			= 4;
			$config["num_links"] 				= 1;
			$config["use_page_numbers"] = TRUE;
			$config['first_link'] 			= 'First';
			$config['last_link'] 				= 'Last';
			$config['next_link'] 				= /** @lang text */'<i class="md md-navigate-next"></i>';
			$config['prev_link'] 				= /** @lang text */'<i class="md md-navigate-before"></i>';
			$config['full_tag_open'] 		= /** @lang text */'<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close'] 	= /** @lang text */'</ul></nav></div>';
			$config['num_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] 		= /** @lang text */'</span></li>';
			$config['cur_tag_open']	 		= /** @lang text */'<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] 		= /** @lang text */'<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] 	= /** @lang text */'<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] 	= /** @lang text */'</span>Next</li>';
			$config['first_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = /** @lang text */'</span></li>';
			$config['last_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] 	= /** @lang text */'</span></li>';
			$this->pagination->initialize($config);
			$hal  	= $this->uri->segment(4);
			$start 	= ($hal - 1) * $config["per_page"];
			$read_data = $this->m_crud->join_data(
				$table, "assets.*,masjid.nama_masjid,masjid.id_masjid,kel_assets.nama_kel_assets,kel_assets.id_kel_assets,pengurus.nama_pengurus",
                array(array("type"=>"LEFT","table"=>"masjid"),array("type"=>"LEFT","table"=>"pengurus"),array("type"=>"LEFT","table"=>"kel_assets")),
				array( "masjid.id_masjid=assets.id_masjid", "pengurus.id_pengurus=assets.id_pengurus","kel_assets.id_kel_assets=assets.id_kel_assets"), $where == null ? "assets.id_masjid='$this->masjid '" : $where, "id_assets DESC", null, $config["per_page"], $start, null
			);
			$res_index = "";
			if ($read_data != null) {
				foreach ($read_data as $row):
					$price 	= rupiah($row['harga_assets'], 0, ',', '.');
					$total 	= rupiah($row['qty_assets'] * $row['harga_assets'], 0, ',', '.');
					$res_index .=
						/**@lang text */
						'<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 wrapper"">
						<div class="thumbnail img-thumb-bg"
							style="background-image: url(' . base_url("assets/upload/assets/" . $row["foto_assets"]) . ');
							border:1px solid white;">
							<div class="overlay"></div>
							<div class="caption"">
								<div class="tag">
									<a class="curdet">' . $row["nama_kel_assets"] . '</a>
									<i
										class="fa fa-eye pull-right curdet" id="idetail"
										title="detail" onclick="detail(' . "'" . $row['id_assets'] . "'" . ')">
									</i>
									<i
										class="fa fa-trash pull-right curdet" id="ihapus"
										style=""
										title="hapus" onclick="hapus(' . "'" . $row['id_assets'] . "'" . ')">
									</i>
								</div>
								<div class="title col-lg-12 noPadding">
									<a class="curdet" onclick="showModal(' . "'" . $row['id_assets'] . "'" . ')">';
					strlen($row["nama_assets"])>10?$res_index.=substr($row["nama_assets"],0,10).' ..':$res_index.=$row["nama_assets"];
					$res_index .=
						/**@lang text */
						'</a>
									<small id="expired">( Ex : ' . $row["umur_assets"] . ' )</small>
								</div>
								<div class="clearfix  col-lg-12 noPadding">
									<span class="meta-data"><a class="curdet">' . $row["nama_pengurus"] . ' </a></span>
								</div>
								<div class="content">
									<table class="table table-striped table-bordered">
										<thead>
										<tr>
											<th style="color:white!important;">Qty</th>
											<th style="color:white!important;">Harga</th>
											<th style="color:white!important;">Total</th>
										</tr>
										</thead>
										<tbody style="background: white;">
											<tr>
												<td>' . $row["qty_assets"] . '</td>
												<td>' . 'Rp. ' . $price . '</td>
												<td>' . 'Rp. ' . $total . '</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>';
				endforeach;
			} else {
				$res_index .=
					/**@lang text */
					'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 class="text-center">Tidak Ada Data</h3>
				</div>';
			}
			$data = array(
				"pagination_link" => $this->pagination->create_links(),
				"result_table" 		=> $res_index,
				"hal"						=> $hal
            );
			echo json_encode($data);
		}
		elseif($aksi == "get_param") {
			$getKelAssets = $this->m_crud->get("nama_kel_assets,id_kel_assets", "kel_assets", "kel_assets.id_masjid=$this->masjid")->result_array();
			$data = array(
				"getKelAssets"	=> $getKelAssets,
				"getPengurus"	 	=> $this->pengurus,
				"getIdAssets" 	=> $getIdAssets,
            );
			echo json_encode($data);
		}
		elseif($aksi == "tambah"){
			$config['upload_path']  = "./assets/upload/assets";
			$config['allowed_types']= 'gif|jpg|png';
			$config['file_name']    = 'Assets_'.str_replace(' ','_',$nama).'_'.date('y-m-d');
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
			$response = array();
			if($nama=="") {
				$response["pesan"] = "Silahkan Isi Field Nama";
			}elseif($qty=="") {
				$response["pesan"] = "Silahkan Isi Field Qty";
			}elseif($harga=="") {
				$response["pesan"] = "Silahkan Isi Field Harga";
			}elseif($supplier=="") {
				$response["pesan"] = "Silahkan Isi Field Nama Supplier";
			}elseif($tgl_beli=="") {
				$response["pesan"] = "Silahkan Isi Field Tanggal Beli";
			}elseif($umur=="") {
				$response["pesan"] = "Silahkan Isi Field Tanggal Expired";
			}else {
				$response["pesan"] = "";
				if ($this->upload->do_upload("foto_assets")) {
					$config = array('upload_data' => $this->upload->data());
					$data_assets = array(
						'id_kel_assets' 	=> $id_kel_assets,
						'id_masjid' 			=> $this->masjid,
						'id_pengurus' 		=> $id_pengurus,
						'nama_assets' 		=> $nama,
						'foto_assets' 		=> $config['upload_data']['file_name'],
						'tgl_beli_assets' => $tgl_beli,
						'qty_assets' 			=> $qty,
						'harga_assets' 		=> $harga,
						'total_assets' 		=> $qty * $harga,
						'umur_assets' 		=> $umur,
						'supplier' 				=> $supplier,
                    );
					$this->m_crud->insert("assets", $data_assets);
                    $data_log = array(
                        "id_masjid"=>$this->masjid,
                        "id_pengurus"=>$this->session->id_pengurus,
                        "aksi"=>"add",
                        "keterangan"=>$table,
                        "data"=>json_encode(array("assets"=>array($data_assets)))
                    );
                    $this->m_crud->create_data("log",$data_log);
				}

			}
			echo json_encode($response);
		}
		elseif($aksi == "edit"){
			$response = array();
			if($nama=="") {
				$response["pesan"] = "Silahkan Isi Field Nama";
			}elseif($qty=="") {
				$response["pesan"] = "Silahkan Isi Field Qty";
			}elseif($harga=="") {
				$response["pesan"] = "Silahkan Isi Field Harga";
			}elseif($supplier=="") {
				$response["pesan"] = "Silahkan Isi Field Nama Supplier";
			}elseif($tgl_beli=="") {
				$response["pesan"] = "Silahkan Isi Field Tanggal Beli";
			}elseif($umur=="") {
				$response["pesan"] = "Silahkan Isi Field Tanggal Expired";
			}else {
				$response["pesan"] = "";
				$config['upload_path']  = "./assets/upload/assets";
				$config['allowed_types']= 'gif|jpg|png';
				$config['file_name']    = 'Assets_'.str_replace(' ','_',$nama).'_'.date('y-m-d');
				$this->load->library('upload', $config);
				if ($this->upload->do_upload("foto_assets")) {
					$config = array('upload_data' => $this->upload->data());
					$getIdAssets != "" ? unlink("./assets/upload/assets/" . $getIdAssets['foto_assets']) : NULL;
					$data_assets = array(
						'id_kel_assets' 	=> $id_kel_assets,
						'id_masjid' 			=> $this->masjid,
						'id_pengurus' 		=> $id_pengurus,
						'nama_assets' 		=> $nama,
						'foto_assets' 		=> $config['upload_data']['file_name'],
						'tgl_beli_assets' => $tgl_beli,
						'qty_assets' 			=> $qty,
						'harga_assets' 		=> $harga,
						'total_assets' 		=> $qty * $harga,
						'umur_assets' 		=> $umur,
						'supplier' 				=> $supplier,
                    );
					$where = array("id_assets" => $id);
					$this->m_crud->update("assets", $data_assets, $where);
				} else {
                    $data_assets = array(
						'id_kel_assets' 	=> $id_kel_assets,
						'id_masjid' 			=> $this->masjid,
						'id_pengurus'	 		=> $id_pengurus,
						'nama_assets' 		=> $nama,
						'tgl_beli_assets' => $tgl_beli,
						'qty_assets' 			=> $qty,
						'harga_assets' 		=> $harga,
						'total_assets' 		=> $qty * $harga,
						'umur_assets' 		=> $umur,
						'supplier' 				=> $supplier,
                    );
					$where = array("id_assets" => $id);
					$this->m_crud->update("assets", $data_assets, $where);
					
				}
                $data_log = array(
                    "id_masjid"=>$this->masjid,
                    "id_pengurus"=>$this->session->id_pengurus,
                    "aksi"=>"update",
                    "keterangan"=>$table,
                    "data"=>json_encode(array("assets"=>array($data_assets)))
                );
                $this->m_crud->create_data("log",$data_log);
			}
			echo json_encode($response);
		}
		elseif($aksi == "hapus"){
		    $read_data = $this->m_crud->get_data("assets","*","id_assets='".$id."'");
            $data_log = array(
                "id_masjid"=>$this->masjid,
                "id_pengurus"=>$this->session->id_pengurus,
                "aksi"=>"delete",
                "keterangan"=>$table,
                "data"=>json_encode(array("assets"=>array($read_data)))
            );
            $this->m_crud->create_data("log",$data_log);
			$getIdAssets != "" ? unlink("./assets/upload/assets/" . $getIdAssets['foto_assets']) : NULL;
			$where 	= array('id_assets' => $id);
			$result = $this->m_crud->delete("assets", $where);
			echo json_encode($result);
		}
		else{
			$this->load->view('bo/layout/wrapper',$data);
		}
	}
	public function kel_assets($aksi=null){
        $this->access_denied(35);
		$table 	= 'kel_assets';
        $id_masjid			= $this->session->id_masjid;
        $where 	= "id_masjid='$id_masjid'";
        $page 	= $table;
        $data = array('page'=>$page,'isi'=>'bo/pages/'.$page);
        $input = $this->input->post();

		$this->session->unset_userdata('search');
		isset($_POST["search"]) ? $this->session->set_userdata('search', array('any' => $_POST['any'])) : null;
		$search = $this->session->search['any'];
		if(isset($search)&&$search!=null) {
			($where == null) ? null : $where .= " AND ";
			$where .= "nama_kel_assets like '%".$search."%'";
		}
		$count = $this->m_crud->count_data($table, "id_kel_assets", $where);
		if($aksi == "get"){
			$config = array();
			$config["base_url"] 				= "#";
			$config["total_rows"] 			= $count;
			$config["per_page"] 				= 1;
			$config["uri_segment"] 			= 4;
			$config["num_links"] 				= 1;
			$config["use_page_numbers"] = TRUE;
			$config['first_link'] 			= 'First';
			$config['last_link'] 				= 'Last';
			$config['next_link'] 				= /** @lang text */'<i class="md md-navigate-next"></i>';
			$config['prev_link'] 				= /** @lang text */'<i class="md md-navigate-before"></i>';
			$config['full_tag_open'] 		= /** @lang text */'<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close'] 	= /** @lang text */'</ul></nav></div>';
			$config['num_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] 		= /** @lang text */'</span></li>';
			$config['cur_tag_open']	 		= /** @lang text */'<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] 		= /** @lang text */'<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] 	= /** @lang text */'<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] 	= /** @lang text */'</span>Next</li>';
			$config['first_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = /** @lang text */'</span></li>';
			$config['last_tag_open'] 		= /** @lang text */'<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] 	= /** @lang text */'</span></li>';
			$this->pagination->initialize($config);
			$hal  	= $this->uri->segment(4);
			$start 	= ($hal - 1) * $config["per_page"];
			$read_data = $this->m_crud->read_data(
				$table, "*",
				$where, "id_kel_assets DESC", null, $config["per_page"], $start, null
			);
			$res_index = "";
			if ($read_data != null) {
				foreach ($read_data as $row):
					$res_index.=
					/**@lang text */
					'<div class="col-lg-4" style="height:200px;">
						<div class="panel panel-border panel-primary">
							<div class="panel-heading">
								<div class="col-md-6 noPadding">
									<h3 class="panel-title">'.$row["nama_kel_assets"].'</h3>
								</div>
								<div class="col-md-6 noPadding">
									<h3 class="panel-title" style="float:right">
										<button class="btn btn-primary btn-xs" onclick="edit('."'".$row['id_kel_assets']."'".')">
											<i class="fa fa-pencil"></i>
										</button>
										<button class="btn btn-primary btn-xs" onclick="hapus('."'".$row['id_kel_assets']."'".')">
											<i class="fa fa-trash"></i>
										</button>
									</h3>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-md-12 noPadding">
									<p>'.$row["keterangan"].'</p>
									<p>
										<i class="md md-event"></i> '.$row["tgl_kel_assets"].',
									</p>
								</div>
							</div>
						</div>
					</div>';
				endforeach;
			}else{
				$res_index .=
				/**@lang text */
				'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3 class="text-center">Tidak Ada Data</h3>
				</div>';
			}
			$data = array(
				"pagination_link" => $this->pagination->create_links(),
				"result_table" 		=> $res_index,
				"page"						=> $hal
            );
			echo json_encode($data);
		}

        elseif($aksi == "isExist"){
            $where = "nama_kel_assets='".$input['nama']."'";
            $input['param']=='edit'?$where.=" AND nama_kel_assets<>'".$input['nama']."'":null;
            $isExist = $this->m_crud->get_data("kel_assets", "nama_kel_assets", $where);
            echo $isExist==null?'true':'false';
        }
        elseif($aksi == "simpan"){
            $response=array();
            $new_data = array(
                "id_masjid"         => $id_masjid,
                "id_pengurus"       => $input['id_pengurus'],
                "nama_kel_assets"   => $input['nama'],
                "keterangan"        => $input['keterangan'],
            );
            if ($input['param'] == 'add') {
                $response['pesan']="";
                $this->m_crud->create_data("kel_assets", $new_data);
                $this->m_crud->log("add","kel assets",json_encode(array("kel_assets"=>array($new_data))));
            } else {
                $response['pesan']="";
                $id = $input['id'];
                $this->m_crud->update_data("kel_assets", $new_data, "id_kel_assets='".$id."'");
                $this->m_crud->log("update","kel assets",json_encode(array("kel_assets"=>array($new_data))));
            }

            echo json_encode($response);

        }
        elseif($aksi=="edit"){
            $get_data = $this->m_crud->get_data("kel_assets", "*", "id_kel_assets='".$input['id']."'");
            $result = array();
            if ($get_data != null) {
                $result['status'] = true;
                $result['res_data'] = $get_data;
            } else {
                $result['status'] = false;
            }

            echo json_encode($result);
        }
        elseif($aksi == "hapus") {
            $get_data = $this->m_crud->get_data("kel_assets", "*", "id_kel_assets='".$input['id']."'");
            $this->m_crud->log("delete","kel assets",json_encode(array("kel_assets"=>array($get_data))));
            $delete_data = $this->m_crud->delete_data($table, "id_kel_assets = '".$input['id']."'");
            echo $delete_data?$status=true:false;
        }
//		elseif($aksi == "tambah"){
//			$response = array();
//			if($nama == ""){
//				$response["pesan"] = "Silahkan Isi Field Nama";
//			}elseif($keterangan == ""){
//				$response["pesan"] = "Silahkan Isi Field Ketarangan";
//			}elseif($getParam["nama_kel_assets"] != null){
//				$response["pesan"] = "Maaf Nama Kelompok Assets ".$getParam["nama_kel_assets"]." Sudah Digunakan";
//			}else{
//				$response["pesan"] = "";
//				$data = array(
//					"id_masjid" => $id_masjid,
//					"id_pengurus" => $id_pengurus,
//					"nama_kel_assets" => $nama,
//					"keterangan" => $keterangan
//                );
//				$this->m_crud->insert("kel_assets",$data);
//			}
//			echo json_encode($response);
//		}
//		elseif($aksi == "edit"){
//			$response["pesan"] = "";
//			$data = array(
//				"id_masjid" => $id_masjid,
//				"id_pengurus" => $id_pengurus,
//				"nama_kel_assets" => $nama,
//				"keterangan" => $keterangan
//            );
//			$where = array("id_kel_assets" => $id);
//			$this->m_crud->update("kel_assets",$data,$where);
//			echo json_encode($response);
//		}
//		elseif($aksi == "hapus"){
//			$where = array("id_kel_assets" => $id);
//			$response = $this->m_crud->delete("kel_assets",$where);
//			echo json_encode($response);
//		}
		else{
			$this->load->view('bo/layout/wrapper',$data);
		}
	}



    public function log($aksi=null,$hal=1){
        $id_masjid 	= $this->session->id_masjid;
        $input = $this->input->post();
        $page = 'log';
        $table= $page;
        $where="l.id_masjid='$id_masjid '";
        $this->session->unset_userdata('search');

        if(isset($input['search'])) {
            $this->session->set_userdata('search', array(
                'any'	    => $input['any'],
                'periode'   => $input['periode'],
            ));
        }

        $search 	= $this->session->search['any'];
        $periode 	= $this->session->search['periode'];

        if(isset($search)&&$search!=null) {
            ($where == null) ? null : $where .= " AND ";
            $where .= "kd_kas like '%".$search."%'";
        }

        if(isset($periode)&&$periode!=null){
            ($where == null) ? null : $where .= " AND ";
            $explode_date = explode(' - ', $periode);
            $tgl_awal = $explode_date[0];
            $tgl_akhir = $explode_date[1];
            $where.="convert(l.tanggal,date) between '".$tgl_awal."' and '".$tgl_akhir."' ";
        }

        $count = $this->m_crud->count_data("log l", "l.id_log", $where);

        $data = array('page'=>$page,'isi'=>'bo/pages/'.$page);
        if($aksi == "get"){
            $config = array();
            $config["base_url"] 		= "#";
            $config["total_rows"] 		= $count;
            $config["per_page"] 		= 10;
            $config["uri_segment"] 		= 4;
            $config["num_links"] 		= 1;
            $config["use_page_numbers"] = TRUE;
            $config['first_link'] 		= 'First';
            $config['last_link'] 		= 'Last';
            $config['next_link'] 		= /** @lang text */'<i class="md md-navigate-next"></i>';
            $config['prev_link'] 		= /** @lang text */'<i class="md md-navigate-before"></i>';
            $config['full_tag_open'] 	= /** @lang text */'<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close'] 	= /** @lang text */'</ul></nav></div>';
            $config['num_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] 	= /** @lang text */'</span></li>';
            $config['cur_tag_open']	 	= /** @lang text */'<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] 	= /** @lang text */'<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['next_tagl_close'] 	= /** @lang text */'<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close'] 	= /** @lang text */'</span>Next</li>';
            $config['first_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = /** @lang text */'</span></li>';
            $config['last_tag_open'] 	= /** @lang text */'<li class="page-item"><span class="page-link">';
            $config['last_tagl_close'] 	= /** @lang text */'</span></li>';
            $this->pagination->initialize($config);
            $start 	= ($hal - 1) * $config["per_page"];

            $read_data = $this->m_crud->join_data(
                "log l", "l.*,p.nama_pengurus",
                array(array("type"=>"LEFT","table"=>"pengurus p")),
                array("p.id_pengurus=l.id_pengurus"),
                $where,"l.tanggal desc", null, $config["per_page"], $start, null
            );

            $res_index = "";
//            $res_data  = "";

            $no = $start+1;
            if ($read_data != null) {
                foreach ($read_data as $row):
                    $res_index .=/** @lang text */
                    '<tr>
                        <td>'.$no++.'</td>
                        <td  style="width: 10%!important;">' . $row["tanggal"] . '</td>
                        <td width="10%">' . $row["nama_pengurus"] . '</td>
                        <td width="5%">' . $row["aksi"] . '</td>
                        <td width="10%">' . $row["keterangan"] . '</td>
                    </tr>';

                endforeach;

            } else {
                $res_index .=/**@lang text */'<tr><td colspan="8"><h3 class="text-center">Tidak Ada Data</h3></td><tr>';
            }
            if (!empty($this)) {
                $data = array(
                    "pagination_link"   => $this->pagination->create_links(),
                    "result_project" 	=> $res_index,

                );
            }
            echo json_encode($data);
        }
        else{
            $this->load->view('bo/layout/wrapper',$data);
        }
    }

}
