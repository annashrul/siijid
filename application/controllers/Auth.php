<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: anash
 * Date: 11/6/2018
 * Time: 6:55 AM
 */

class Auth extends CI_Controller
{
	public function index(){
		$data = ["title" => 'Masjid GBI RW 08'];
		$this->load->view("bo/auth",$data);
	}

	public function isUsernameExists(){
		$username = $this->input->post("username");
		$result = $this->m_crud->get_where("user_akun",["username" => $username])->num_rows();
		echo $result;
	}
	public function login(){
		$response 	= ['error' => false];
		$username 	= $this->input->post("username");
		$password 	= $this->input->post("password");
		$query 		= $this->m_crud->get_where('user_akun',[
			'username'		=> $username,
			'password'		=> $password,
		])->row_array();

		if ($query) {
			$response['message'] = '';
			$session = [
				'id_pengurus'  	=> $query['id_pengurus'],
				'id_masjid' 	=> $query['id_masjid'],
				'hak_akses' 	=> $query['hak_akses'],
				'username' 		=> $username,
			];
			$this->session->set_userdata($session);
//			$this->m_crud->update_data("pengurus","last_active=now()","id_pengurus='" . $query['id_pengurus'] . "'");
		} else {
			$response['error'] 	= true;
			$response['message']= 'username dan password tidak cocok';
		}
		echo json_encode($response);
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function forgot_password(){
		$username   = $this->input->post("username");
		$query      = $this->m_crud->get_where("user_akun", array("username" => $username))->row_array();
		echo json_encode($query);
	}
}