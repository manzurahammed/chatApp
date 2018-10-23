<?php 
class Chat extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('user_info')){
            redirect('welcome');
        }
    }
    public function index(){
        $data = array();
        $ses_data = $this->session->userdata('user_info');
        $data['friends'] = $this->get_friends();
        $data['own'] = $ses_data->user_name;
        $this->load->view('header');
		$this->load->view('chatboard',$data);
		$this->load->view('footer');
    }

    public function get_friends(){
        $ses_data = $this->session->userdata('user_info');
        $query = $this->db->query("SELECT id,user_name FROM users where id <> $ses_data->id");
        if($query->result_id->num_rows>0){
           return  $query->result(); 
        }
        return array();
    }
    public function get_chat(){
        $response = '';
        $friend_id = $this->input->post('friend_id');
        $own_id = $this->input->post('own_id');
        $query = $this->db->query("select from_id,message,date from chat where (from_id=$own_id && to_id=$friend_id) || (from_id=$friend_id && to_id=$own_id) order by id desc limit 3");
        if($query->result_id->num_rows>0){
            foreach($query->result() as $item){
                $cont_dart = ($item->from_id==$own_id)?'darker':'';
                $response .= '<div class="chat-container '.$cont_dart.'">';
                    $response .= "<p>$item->message</p>";
                    $response .= '<span class="time-right">11:00</span>';
                $response .= '</div>';
            }
        }else{
            $response = '<h3>No Message Found</h3>';
        }
        echo $response;
        exit;
    }

    public function  send_chat(){
        $response = '';
        $ses_data = $this->session->userdata('user_info');
        $friend_id = $this->input->post('friend_id');
        $message = $this->input->post('message');
        if($message!=''){
            $query = $this->db->query("insert into chat (from_id,to_id,message) VALUES ('$ses_data->id','$friend_id','$message')");
            $response .= '<div class="chat-container darker">';
                $response .= "<p>$message</p>";
                $response .= '<span class="time-right">11:00</span>';
            $response .= '</div>';
        }
        echo $response;
        exit;
    }
}