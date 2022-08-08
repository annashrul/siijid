<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: User
 * Date: 03/12/2018
 * Time: 16:50
 * @property  m_crud
 */

class Api extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->output->set_header("Cache-Control: no-store, no-cache, max-age=0, post-check=0, pre-check=0");
		header('Content-Type: application/json');
		$this->masjid 	= $this->session->id_masjid;
		$this->pengurus = $this->m_crud->get("nama_pengurus,id_pengurus", "pengurus", "id_masjid=$this->masjid")->result_array();
		$this->path = "http://192.168.100.151/masjid/assets/upload/";
        $this->nama_masjid = $this->m_crud->get("no_masjid,nama_masjid,alamat_masjid", "masjid", "id_masjid=$this->masjid")->row_array();

    }



    public function showMuzaki(){
		$result='';
		$countCol=0;
		for($i=0;$i<$_POST['col'];$i++){
			$countCol=$i;
			$anggota=$i+1;
			$result.='
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Anggota '.$anggota.'</label>
						<input type="text" name="anggota'.$i.'" id="anggota'.$i.'" class="form-control">
					</div>
				</div>
			';
		}
		echo json_encode(array('result'=>$result,'countCol'=>$countCol));
	}



	public function saveZakat(){
		$this->db->trans_begin();
		$anggota=array();
		if($_POST['jumlah_jiwa']=='0'){
			$anggota=array('');
		}else{
			for($i=0;$i<$_POST['colMuzaki']+1;$i++){
				$anggota[]=$_POST['anggota'.$i];
			}
		}

		$response = array();

		$kode = $this->m_crud->generate_kode("zakat",date("ym")).'-'.$this->nama_masjid['no_masjid'];
		$jns='';
		$jumlahJiwa='';$jumlahJiwaFitrah=$_POST['colMuzaki']+1;
		$bentukZakat='';
		if($_POST['jns_fitrah']&&$_POST['jns_maal']&&$_POST['jns_fidyah']){
			$jns = $_POST['jns_fitrah'].'-'.$_POST['jns_maal'].'-'.$_POST['jns_fidyah'];
			$jumlahJiwa = $jumlahJiwaFitrah.'-'.'1'.'-'.'1';
			$bentukZakat=$_POST['bentuk_zakat'].'-'.$_POST['bentuk_zakat_maal'].'-'.$_POST['bentuk_zakat_fidyah'];
		}elseif ($_POST['jns_fitrah']&&$_POST['jns_maal']){
			$jns = $_POST['jns_fitrah'].'-'.$_POST['jns_maal'];
			$jumlahJiwa = $jumlahJiwaFitrah.'-'.'1-0';
			$bentukZakat=$_POST['bentuk_zakat'].'-'.$_POST['bentuk_zakat_maal'].'-'.'-';
		}
		elseif ($_POST['jns_fitrah']&&$_POST['jns_fidyah']){
			$jns = $_POST['jns_fitrah'].'-'.$_POST['jns_fidyah'];
			$jumlahJiwa = $jumlahJiwaFitrah.'-'.'0-1';
			$bentukZakat=$_POST['bentuk_zakat'].'-'.'kosong'.'-'.$_POST['bentuk_zakat_fidyah'];
		}
		elseif ($_POST['jns_maal']&&$_POST['jns_fidyah']){
			$jns = $_POST['jns_maal'].'-'.$_POST['jns_fidyah'];
			$jumlahJiwa = '0-'.'0'.'-1';
			$bentukZakat='kosong'.'-'.$_POST['bentuk_zakat_maal'].'-'.$_POST['bentuk_zakat_fidyah'];
		}
		elseif ($_POST['jns_fitrah']){
			$jns = $_POST['jns_fitrah'];
			$jumlahJiwa = $jumlahJiwaFitrah.'-'.'0-0';
			$bentukZakat=$_POST['bentuk_zakat'].'-'.'kosong'.'-'.'kosong';
		}
		elseif ($_POST['jns_maal']){
			$jns = $_POST['jns_maal'];
			$jumlahJiwa = '0-'.'1-0';
			$bentukZakat='kosong'.'-'.$_POST['bentuk_zakat_maal'].'-'.'kosong';
		}
		elseif ($_POST['jns_fidyah']){
			$jns = $_POST['jns_fidyah'];
			$jumlahJiwa = '0-'.'0-1';
			$bentukZakat='kosong'.'-'.'kosong'.'-'.$_POST['bentuk_zakat_fidyah'];
		}
		$totFitrah=str_replace(",","",$this->input->post('total'));
		$totMaal=str_replace(",","",$this->input->post('total_maal'));
		$totFidyah=str_replace(",","",$this->input->post('total_fidyah'));
		$data = array(
			"id_masjid" 	=> $this->masjid,
			"id_pengurus"   => $_POST['id_pengurus'],
			"kd_zakat"      => $kode,
			"nama" 			=> json_encode(array('anggota'=>$anggota)),
			"anggota_maal" 	=> $_POST['nama_maal'],
			"anggota_fidyah"=> $_POST['nama_fidyah'],
			"alamat" 		=> $_POST['alamat'],
			"jumlah_jiwa"   => $jumlahJiwa,
			"bentuk_zakat"  => $bentukZakat,
			"jenis_zakat"   => $jns,
			"total_zakat"   => $totFitrah.'-'.$totMaal.'-'.$totFidyah,
			"shodaqoh" 		=> $_POST['shodaqoh']==""?0:str_replace(",","",$this->input->post('shodaqoh')),
			"jml_hari" 		=> $_POST['jumlah_hari']==""?0:$_POST['jumlah_hari'],
			"rt"=>$_POST['rt'],
			"rw"=>$_POST['rw'],
			"tgl_bayar"=>$_POST['tanggal'],
		);
		$this->db->insert("zakat", $data);
		if($_POST['shodaqoh'] != "" || $_POST['shodaqoh']!='0'){
			$data_kas = array(
				"id_masjid"     => $this->masjid,
				"id_pengurus"   => $_POST['id_pengurus'],
				"kd_kas"        => $kode,
				"jenis_kas"     => "Kas-Masuk",
				"kas_in"        => str_replace(",","",$this->input->post('shodaqoh')),
				"kas_out"       => 0,
				"keterangan"    => "shodaqoh dari hamba allah",
				"tanggal"       => date("Y-m-d"),
			);
			$this->m_crud->insert("kas", $data_kas);
			$data_log=json_encode(array("zakat"=>array($data),"kas"=>array($data_kas)));

		}else{
			$data_log=json_encode(array("zakat"=>array($data),"kas"=>array()));
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$response["status"] = "failed";
		} else {
			$this->db->trans_commit();
			$this->m_crud->log("add","zakat,kas",$data_log);
			$response["status"] = "success";
		}
		echo json_encode($response);
	}

	public function logout(){
		$this->session->sess_destroy();
	}
	public function access_denied(){
		echo json_encode(array("pesan"=>"Anda Tidak Mempunyai Akses Masuk"));
	}

	public function nota_zakat(){
	    $response=array();
	    $getData = $this->m_crud->get_data("zakat","*","kd_zakat='".$_POST['kd_zakat']."'");
	    if($getData!=null){
	        $response['kondisi'] = true;
	        $response['result'] = array(
	            'title'     => $this->nama_masjid['nama_masjid'],
                'sub_title' => $this->nama_masjid['alamat_masjid'],
                "tanggal"   => $getData['tgl_bayar'],
                "kd_zakat"  => $getData['kd_zakat'],
                "nama"      => $getData['nama'],
                "jenis"     => $getData['jenis_zakat'],
                "bentuk"    => $getData['bentuk_zakat'],
                "jiwa"      => $getData['jumlah_jiwa'],
                "total"     => number_format($getData['total_zakat'])
            );
        }else{
            $response['kondisi'] = false;
        }
        echo json_encode($response);
    }

	public function get_pengurus($id_masjid=""){
		$table = "pengurus";
		$result=array();
		$where = null;
		$where.= $id_masjid!=""?"p.id_masjid='$id_masjid'":"";
		$get_data = $this->m_crud->join_data(
			"pengurus p", "p.*,ua.hak_akses",
			array(array("type"=>"LEFT","table"=>"user_akun ua")),
			array("p.id_pengurus=ua.id_pengurus"),
			$where
		);

		foreach($get_data as $row=>$value){
			$result[]= array(
				"id_$table" 		=> $value["id_$table"],
				"nama_$table"		=> $value["nama_$table"],
				"jk_$table"			=> $value["jk_$table"],
				"tgl_lahir_$table"	=> $value["tgl_lahir_$table"],
				"pendidikan_$table"	=> $value["pendidikan_$table"],
				"no_hp_$table"		=> $value["no_hp_$table"],
				"photo_$table"		=> base_url().$value["photo_$table"],
                "hak_akses"         => $value['hak_akses']
			);
		}
		echo json_encode($result);
	}

	public function get_tahun_zakat($id_masjid=""){
		$result = array();
		$where= $id_masjid!=""?"id_masjid='$id_masjid'":"";
		$get_data = $this->m_crud->read_data("zakat","tgl_bayar",$where,null,"YEAR(tgl_bayar)");
		foreach($get_data as $row){
			$result[]=array("tahun"=>(int)date("Y",strtotime($row["tgl_bayar"])));
		}
		echo json_encode($result);
	}

    public function get_jumlah_zakat($id_masjid=""){
	    $result = array();
        $tahun = $this->input->post("tahun");
        $where= $id_masjid!="" ? "zakat.id_masjid='$id_masjid'":"";
        $where.=$tahun?" and YEAR(tgl_bayar)='".$tahun."'":" and YEAR(tgl_bayar)=YEAR(CURDATE())";
        $fitrah = "ifnull((select sum(total_zakat) from zakat where jenis_zakat='Fitrah' and bentuk_zakat='uang' and $where),0) fitrah";
        $fidyah = "ifnull((select sum(total_zakat) from zakat where jenis_zakat='Fidyah' and bentuk_zakat='uang' and $where),0) fidyah";
        $maal   = "ifnull((select sum(total_zakat) from zakat where jenis_zakat='Mall' and bentuk_zakat='uang' and $where),0) maal";
        $uang   = "ifnull((select sum(total_zakat) from zakat where bentuk_zakat='uang' and $where),0) uang";
        $beras  = "ifnull((select sum(total_zakat) from zakat where bentuk_zakat='beras' and $where),0) beras";
        $get_data = $this->m_crud->read_data(
            "zakat",$fitrah.",".$fidyah.",".$maal.",".$uang.",".$beras."",
            $where,null,"fitrah,fidyah,maal,uang,beras"
        );
        foreach($get_data as $row){
            $result[] = array(
                "fitrah"=> number_format($row['fitrah']),
                "fidyah"=> number_format($row['fidyah']),
                "maal"  => number_format($row['maal']),
                "uang"  => number_format($row['uang']),
                "beras" => $row['beras']." Kg",
            );
        }
        echo json_encode($result);
    }

	public function get_zakat($id_masjid=""){
		$result		= array();
        $table = "zakat";
		$where= $id_masjid!=""?"$table.id_masjid='$id_masjid'":"";
		$group_by = "jenis_zakat";
		$tahun = $this->input->post("tahun");
		$where.=$tahun?" and YEAR(tgl_bayar)='".$tahun."'":" and YEAR(tgl_bayar)=YEAR(CURDATE())";

		$get_data = $this->m_crud->join_data(
			$table, "count(jumlah_jiwa) jumlah_jiwa, YEAR(tgl_bayar) tahun, jenis_zakat, masjid.nama_masjid,masjid.id_masjid",
			array(array("type"=>"LEFT","table"=>"masjid")),
			array("masjid.id_masjid=$table.id_masjid"),
			$where,null,$group_by
		);
		foreach ($get_data as $value) {
			$result[]=array(
				"jumlah_jiwa" => (int)$value["jumlah_jiwa"],
				"jenis_zakat"=> $value["jenis_zakat"]
			);
		}


		echo json_encode($result);
	}

	public function get_assets($id_masjid=""){
		$result=array();

		$where = $id_masjid!=""?"m.id_masjid='$id_masjid'":"";
		$get_data = $this->m_crud->join_data(
			"assets a", "a.*,m.nama_masjid,m.id_masjid,ka.nama_kel_assets",
			["masjid m","kel_assets ka"],
			["m.id_masjid=a.id_masjid","ka.id_kel_assets=a.id_kel_assets"],
			$where
		);

		foreach($get_data as $row=>$value){
			$result[]= array(
				"id_assets"		=> $value['id_assets'],
				"id_kel_assets"	=> $value['id_kel_assets'],
				"id_masjid"		=> $value['id_masjid'],
				"id_pengurus"	=> $value['id_pengurus'],
				"nama_assets" 	=> $value['nama_assets'],
				"tgl_beli_assets" => $value['tgl_beli_assets'],
				"qty_assets" 	=> number_format($value['qty_assets']),
				"harga_assets" 	=> number_format($value['harga_assets']),
				"total_assets" 	=> number_format($value['total_assets']),
				"umur_assets" 	=> $value['umur_assets'],
				"supplier" 		=> $value['supplier'],
				"foto_assets" 	=> base_url()."assets/upload/assets/".$value['foto_assets'],
				"nama_kel_assets"	=> $value['nama_kel_assets']
			);
		}
		echo json_encode($result,JSON_PRETTY_PRINT);

	}

	public function get_project($id_masjid=""){

		$result=array();
		$where = $id_masjid!=""?"p.id_masjid='$id_masjid'":"";
		$read_data = $this->m_crud->join_data(
			"project p", "p.*,m.id_masjid,pr.nama_pengurus,photo_pengurus",
			["masjid m","pengurus pr"],
			["m.id_masjid=p.id_masjid","pr.id_pengurus=p.id_pengurus"],
			$where
		);
		foreach($read_data as $row){
			$status = $row["status_project"];
			$value = null;$color=null;$percent=null;
			if($status=="Perencanaan"){
				$value.="0.25";
				$color.="Colors.red";
				$percent.="25%";
			}elseif($status=="Disetujui"){
				$value.="0.50";
				$color.="Colors.warning";
				$percent.="50%";
			}elseif($status=="Dimulai"){
				$value.="0.75";
				$color.="Colors.green";
				$percent.="75%";
			}else{
				$value.="1.0";
				$color.="Colors.blue";
				$percent.="100%";
			}
			$result[]=array(
				"id_project" => $row["id_project"],
				"id_masjid"	=> $row["id_masjid"],
				"nama_pengurus"	=> $row["nama_pengurus"],
				"nama_project"	=> strtolower($row["nama_project"]),
				"keterangan_project"	=> $row["keterangan_project"],
				"tgl_mulai"	=> $row["tgl_mulai"],
				"status_project" => $row["status_project"],
				"kas" 		=> number_format($row["kas"]),
				"donatur"	=> number_format($row["donatur"]),
				"sumbangan"	=> number_format($row["sumbangan"]),
				"biaya_anggaran" => number_format($row["biaya_anggaran"]),
				"total_realisasi" => number_format($row["total_realisasi"]),
				"total_sumber_dana" => number_format($row["total_sumber_dana"]),
				"foto"	=> base_url().$row["foto"],
				"value"	=> $value,
				"warna"	=> $color,
				"persen"=> $percent,
				"photo_pengurus"=> base_url().$row["photo_pengurus"],
			);
		}

		echo json_encode($result);

	}

	public function get_kegiatan($id_masjid=""){
        $result = array();
        $where= $id_masjid!=""?"id_masjid='$id_masjid'":"";
        $get_data = $this->m_crud->read_data("kegiatan","id_kegiatan,nama_kegiatan",$where);
        foreach($get_data as $row){
            $result[]=array(
                "id_kegiatan"   =>(int)$row['id_kegiatan'],
                "nama_kegiatan" =>$row['nama_kegiatan']
            );
        }
        echo json_encode($result);
    }

    public function get_tahun_jadwal($id_masjid=""){
        $result = array();
        $where= $id_masjid!=""?"id_masjid='$id_masjid'":"";
        $get_data = $this->m_crud->read_data("jadwal","YEAR(waktu) tahun",$where,null,"YEAR(waktu)");
        foreach($get_data as $row){
            $result[]=array(
                "tahun" => (int)$row["tahun"],
            );
        }
        echo json_encode($result);
    }

    public function get_bulan_jadwal($id_masjid=""){
        $result = array();
        $where= $id_masjid!=""?"id_masjid='$id_masjid'":"";
        $get_data = $this->m_crud->read_data("jadwal","MONTH(waktu) bulan",$where,null,"MONTH(waktu)");
        foreach($get_data as $row){
            $result[]=array(
                "bulan" => (int)$row["bulan"],
                "nama"  => bulan($row["bulan"])
            );
        }
        echo json_encode($result);
    }

	public function get_jadwal($id_masjid=""){
        $result = array();
        $where= $id_masjid!=""?"id_masjid='$id_masjid'":"";
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $kegiatan = $this->input->post('kegiatan');
        if($tahun){
            ($where == null) ? null : $where .= " AND ";
            $where.=" YEAR(waktu)='".$tahun."'";
        }else{
            ($where == null) ? null : $where .= " AND ";
            $where.=" YEAR(waktu)=YEAR(CURDATE())";
        }
        if($bulan){
            ($where == null) ? null : $where .= " AND ";
            $where.=" MONTH(waktu)='".$bulan."'";
        }else{
            ($where == null) ? null : $where .= " AND ";
            $where.=" MONTH(waktu)=MONTH(CURDATE())";
        }
        if($kegiatan==''){
//            ($where == null) ? null : $where .= " AND ";
            $where.=null;
        }else{
            ($where == null) ? null : $where .= " AND ";
            $where.=" j.id_kegiatan='".$kegiatan."'";
        }
        $get_data = $this->m_crud->read_data("jadwal j","j.*",$where);

        foreach($get_data as $row){
            $result[]=array(
                "nama_imam"     => $row['nama_imam'],
                "uang_transport"=> number_format($row['uang_transport']),
                "tanggal"   => longdate_indo($row['waktu']),
            );
        }
        echo json_encode($result);
	}

    public function get_tahun_kas($id_masjid=""){
        $result = array();
        $where= $id_masjid!=""?"id_masjid='$id_masjid'":"";
        $get_data = $this->m_crud->read_data("kas","tanggal",$where,null,"YEAR(tanggal)");
        foreach($get_data as $row){
            $result[]=array("tahun"=>(int)date("Y",strtotime($row["tanggal"])));
        }
        echo json_encode($result);
    }

	public function get_kas($id_masjid=""){
		$result = array();
        $where = $id_masjid!=""?"id_masjid='$id_masjid'":"";
        $tahun = $this->input->post("tahun");
        $where.=$tahun?" and YEAR(tanggal)='".$tahun."'":" and YEAR(tanggal)=YEAR(CURDATE())";
		$get_data = $this->m_crud->read_data("kas","*",$where);
		$balance = 0;
		foreach($get_data as $row){
            $balance = ($balance + $row['kas_in'] - $row['kas_out']);
			$result[]=array(
			    "id_kas"        => $row['id_kas'],
			    "id_masjid"     => $row['id_masjid'],
			    "id_pengurus"   => $row['id_pengurus'],
			    "kd_kas"        => $row['kd_kas'],
			    "jenis_kas" =>$row['jenis_kas'],
			    "keterangan"=> $row['keterangan'],
			    "kas_in"    => number_format($row['kas_in']),
                "kas_out"   => number_format($row['kas_out']),
                "saldo"     => number_format($balance),
                "tanggal"   => $row['tanggal']
            );
		}

		echo json_encode($result);
	}

	public function registrasi_masjid(){
		$this->db->trans_begin();
		$result 	= array();
		$masjid 	= $this->m_crud->get("no_masjid","masjid",NULL,NULL,"id_masjid","DESC")->result();
		$no_urut 	= "";
		count((array)$masjid) > 0 ? $no_urut .= $masjid[0]->no_masjid+1 : $no_urut .= 1;
		$input	= $this->input->post();
		$exist  = $this->db->query(
			"select * from masjid where nama_masjid='".$input["nama_masjid"]."' and alamat_masjid like '%".$input['alamat_masjid']."%'"
		)->row_array();
		if($exist){
			$result["value"] 	= 2;
			$result["message"] 	= "masjid sudah terdaftar";
		}else{
			$data_masjid = [
				"nama_masjid"	=> strtoupper($input["nama_masjid"]),
				"alamat_masjid"	=> $input["alamat_masjid"],
				"no_masjid"		=> $no_urut,
			];
			$insert_masjid = $this->m_crud->insert("masjid",$data_masjid);
			$id_masjid = $this->db->insert_id();
			if($insert_masjid){
				$rplc = str_replace(" ","",strtolower($input["nama_masjid"]));
				$akun = str_replace("-","",$rplc);
				$data_pengurus = [
					'id_masjid' => $id_masjid,
					'username'  => $akun,
					'password'  => $akun,
					"hak_akses"	=> "super",
                    "akses"     => "1111111111111111111111111111111111111111"
				];
				$insert_akun = $this->m_crud->insert('user_akun',$data_pengurus);
				if($insert_akun){
					$result['id']		= $id_masjid;
					$result["value"] 	= 1;
					$result["message"] 	= "Registrasi Masjid Berhasil";
					$result["akun_user"]= $akun;
				}else{
					$result["value"] 	= 0;
					$result["message"] 	= "Registrasi Masjid Gagal";
				}

			}else{
				$result["value"] 	= 0;
				$result["message"] 	= "Registrasi Masjid Gagal";
			}

		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else {
			$this->db->trans_commit();
		}

		echo json_encode($result);
	}

	public function login_masjid(){
		$result = array();
		$input	= $this->input->post();
		$exist  = $this->m_crud->join("ua.username,ua.password,m.id_masjid id, m.nama_masjid, m.alamat_masjid","masjid m","m.id_masjid=ua.id_masjid","user_akun ua","ua.username='".$input['username']."' and ua.password='".$input['password']."'")->row_array();
		if($exist){
			$result["value"] 	= 1;
			$result["username"]	= $exist['username'];
			$result["id"] 		= $exist['id'];
			$result["nama"] 	= $exist['nama_masjid'];
			$result["alamat"] 	= $exist['alamat_masjid'];
			$result["message"] 	= "Login Berhasil";

		}else{
			$result["value"] 	= 0;
			$result["message"] 	= "Username Atau Password Salah";
		}
		echo json_encode($result);
	}




	public function api_sholat(){
		echo date('Y-m-d H:i:s');die();
		header('Content-Type: application/json');
		$urlApi = "https://api.pray.zone/v2/times/today.json?longitude=107.61861&latitude=-6.90389&elevation=333";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlApi);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		$decodeData = json_decode($output);
		curl_close($ch);
		$data = $decodeData->results->datetime;
		$push=array();
		foreach($data as $row){
			$push['shubuh']=$row->times->Fajr;
			$push['dzuhur']=$row->times->Dhuhr;
			$push['ashar']=$row->times->Asr;
			$push['magrib']=$row->times->Maghrib;
			$push['isya']=$row->times->Isha;
		}

		echo json_encode($push);

	}

	public function jadwal_sholat(){
		$urlApi = 'http://api.aladhan.com/v1/calendarByCity'; //Url API
		$urlApi .='?city=bandung'; // Ambil kota dari form submit
		$urlApi .='&country=ID';   // Negara set default Indonesia
		$urlApi .='&method=11';    // method ke aplikasi
		$urlApi .='&month='.date('m'); // Ambil bulan dari form submit
		$urlApi .='&year='.date('Y');  // Ambil tahun dari form submit
		$ch = curl_init(); //set curl
		curl_setopt($ch, CURLOPT_URL, $urlApi);  // Ambil Data dari API Url
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		$decodeData = json_decode($output); // decode data json dari api
		curl_close($ch);
		$dayNow = ltrim(date('d'),"0") - 1; //hapus 0 di depan untuk mencocokan array hari dari $decodeData dan mengurangi hari karena di array di mulai dari 0
		$data['shubuh'] 	= ($decodeData->code == 200 ? $decodeData->data[$dayNow]->timings->Fajr : "Tidak Tersedia");
		$data['dzuhur'] 	= ($decodeData->code == 200 ? $decodeData->data[$dayNow]->timings->Dhuhr : "Tidak Tersedia");
		$data['ashar'] 		= ($decodeData->code == 200 ? $decodeData->data[$dayNow]->timings->Asr : "Tidak Tersedia");
		$data['magrib'] 	= ($decodeData->code == 200 ? $decodeData->data[$dayNow]->timings->Maghrib : "Tidak Tersedia");
		$data['isya'] 		= ($decodeData->code == 200 ? $decodeData->data[$dayNow]->timings->Isha : "Tidak Tersedia");
		$data['lokasi'] 	= 'bandung';
		$data['hijriah'] 	= ($decodeData->code == 200 ? $decodeData->data[$dayNow]->date->hijri->date : "Tidak Tersedia");
		$push=array();
		$array = array(
			"shubuh" 	=> $data['shubuh'],
			"dzuhur" 	=> $data['dzuhur'],
			"ashar" 	=> $data['ashar'],
			"magrib" 	=> $data['magrib'],
			"isya" 		=> $data['isya'],
		);
		array_push($push,$array);

		$value = array();
		foreach($push as $row){
			$value[] = $row;
		}
		echo json_encode($value);
//		header('Content-Type: application/json');

	}


	public function group_by($key, $data) {
		$result = [];
		foreach($data as $val) {
			if(array_key_exists($key, $val)){
				$result[$val[$key]][] = $val;
			}else{
				$result[""][] = $val;
			}
		}

		return $result;
	}

}
