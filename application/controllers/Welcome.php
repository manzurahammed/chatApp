<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
        if($this->session->has_userdata('user_info')){
            redirect('chat');
        }
	}
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}
	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username!='' && $password!=''){
			$password = md5($password);
			$query = $this->db->query("SELECT id,user_name FROM users where user_name='$username' && password = '$password' limit 1");
			if($query->result_id->num_rows>0){
				$user = current($query->result());
				$this->session->set_userdata('user_info',$user);
				redirect('chat');
			}
		}
		redirect('welcome');
	}
	
	public function chat_send(){
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		echo json_encode(array('my_name'=>$firstName.' '.$lastName));
		exit;
	}
	public function send_chat(){
        $response = array('statuse'=>false);
        $ses_data = $this->session->userdata('user_info');
        $friend_id = $this->input->post('friend_id');
        $message = $this->input->post('message');
        $own_id = $this->input->post('own_id');
        if($message!=''){
            $query = $this->db->query("insert into chat (from_id,to_id,message) VALUES ('$own_id','$friend_id','$message')");
            if($query){
				$response = array('statuse'=>true);
			}
        }
        echo json_encode($response);
        exit;
    }
}
