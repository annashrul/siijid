<?php
/**
 * Created by PhpStorm.
 * User: anash
 * Date: 12/12/2018
 * Time: 00.50
 */

class Fo extends CI_Controller{
	var $API = "" ;
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->output->set_header("Cache-Control: no-store, no-cache, max-age=0, post-check=0, pre-check=0");
		$this->API = "https://masjid.anasrulysf.com/api/get_api/";
	}
	
	public function index(){
		$this->load->view("fo/home");
	}
	public function lokasi(){
		$this->load->view("fo/lokasi");
	}
	public function pengurus($aksi=null){
		if($aksi == "get"){
			$response = json_decode(file_get_contents($this->API.'get'));
//			var_dump($response->data);die();
			$result = "";
			if($response != null){
				foreach($response->data->admin as $row){
					$result .= /** @lang text */
					"<p>".$row->nama_pengurus."</p>";
				}
				
			}else{
				$result .= /** @lang text */
				"<p>data tidak ada</p>";
			}
			$data = [
				"response" => $result
			];
			echo json_encode($data);
		}else{
			$this->load->view("fo/home");
		}
	}
}