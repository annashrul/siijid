<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function get_dashboard(){
	    $where = "id_masjid='".$this->session->id_masjid."'";
	    $where_= "id_masjid='".$this->session->id_masjid."'";
        $this->session->unset_userdata('search');
        if(isset($_POST['periode'])) {
            $this->session->set_userdata('search', array(
                'periode'   => $_POST['periode'],
            ));
        }
        $periode 	= $this->session->search['periode'];

        if(isset($periode)&&$periode!=null){
            ($where == null) ? null : $where .= " AND ";
            ($where_ == null) ? null : $where_ .= " AND ";
            $explode_date = explode(' - ', $periode);
            $tgl_awal 	= $explode_date[0];
            $tgl_akhir 	= $explode_date[1];
            $where.="convert(tgl_bayar,date) between '".$tgl_awal."' and '".$tgl_akhir."' ";
            $where_.="convert(tanggal,date) between '".$tgl_awal."' and '".$tgl_akhir."' ";
        }else{
            ($where == null) ? null : $where .= " AND ";
            ($where_ == null) ? null : $where_ .= " AND ";
            $where .="YEAR(tgl_bayar)=YEAR(CURDATE())";
            $where_.="YEAR(tanggal)=YEAR(CURDATE())";

        }
        $label = [];
        $data = [];
        $label1 = [];
        $label2 = [];
        $data1 = [];
        $data2 = [];

        $read_data = $this->m_crud->read_data("kas","month(tanggal) bulan,sum(kas_in-kas_out) saldo",$where_,null,"month(tanggal)");
        $read_data1 = $this->m_crud->read_data("zakat","jenis_zakat,sum(total_zakat) total", "bentuk_zakat='Uang' and $where",null,"jenis_zakat");
        $read_data2 = $this->m_crud->read_data("zakat","jenis_zakat,sum(total_zakat) total", "bentuk_zakat='Beras' and $where ",null,"jenis_zakat"
        );
        foreach($read_data as $row){
            array_push($label, medium_bulan($row['bulan']));
            array_push($data, $row['saldo']);
        }
        foreach ($read_data1 as $row1) {
            array_push($label1, $row1['jenis_zakat']);
            array_push($data1, $row1['total']);
        }
        foreach ($read_data2 as $row2) {
            array_push($label2, $row2['jenis_zakat']);
            array_push($data2, $row2['total']);
        }
        echo json_encode(array(
            "report_kas" => array(
                "label"  => $label,
                "data"   => $data
            ),
            "report_zakat" => array(
                "label"    => $label1,
                "data"     => $data1,
                "label2"   => $label2,
                "data2"    => $data2
            ),
        ));
    }

	public function set_session_date($session_name_, $value_) {
		$value = base64_decode($value_);
		$session_name = base64_decode($session_name_);
		$this->session->set_userdata('search', array($session_name=>$value));
	}
	public function get_session_date($type) {
		$field = 'field-date';
		$date = $this->session->search[$field];

		
		$explode_date = explode(' - ', $date);
		$get_date_1 = explode('/', $explode_date[0]);
		$get_date_2 = explode('/', $explode_date[1]);

		$date1 = $get_date_1[1].'-'.$get_date_1[2].'-'.$get_date_1[0];
		$date2 = $get_date_2[1].'-'.$get_date_2[2].'-'.$get_date_2[0];

		if (isset($date) && $date!=null) {
			if ($type == 'startDate') {
				echo $date1;
			} else {
				echo $date2;
			}
		} else {
			echo date('m/d/Y');
		}
	}
	
}
