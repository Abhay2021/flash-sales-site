<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller { 

    public function __construct()	
	{
        parent::__construct();	
        $this->load->library('form_validation');
	
	}	


public function index(){
    if($this->session->user && $this->session->logged_in && $this->session->id){
        $id = $this->session->id;
        $status = true;
    }
    else{ $status = false;
       // echo "Access Denied !unauthorized access";
       redirect("admin/login");
    }
    if($status && $id){
        $user_deals = $this->db->query("SELECT  `deals_id`, `quantity` FROM `orders` WHERE `user_id`= $id");
        $array = $user_deals->result_array();
        $deals_ids = array_column($array,"deals_id");
        $this->data['deals_ids'] = $deals_ids;

        date_default_timezone_set('Asia/Kolkata');
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime(' -1 day'));
        $time = date('H');
        $day = date('a');//am or pm
        //echo " $today $time $day $yesterday";exit;
        if($time>=10){
            $deals = $this->db->query("SELECT * FROM `deals` WHERE publish_date = '$today' AND publish=1 ");
        }else{
            $deals = $this->db->query("SELECT * FROM `deals` WHERE publish_date = '$yesterday' AND publish=1 "); 
        }
        //print_r($this->db->last_query());exit;
       //print_r($deals->result());exit;
        $this->data['deals'] = $deals->result();
        $this->load->view('header');
        $this->load->view('deals',$this->data);
        $this->load->view('footer');
    }else{ 
        echo "Access Denied !unauthorized access";
    }

   
}

public function dashboard(){
    if($this->session->user && $this->session->logged_in && $this->session->id){
        $id = $this->session->id;
        $status = true;
    }
    else{ $status = false;
        echo "Access Denied !unauthorized access";
    }
    if($status && $id){
        $deals = $this->db->query("SELECT deals.* FROM deals INNER JOIN orders ON deals.id = orders.deals_id AND orders.user_id= '$id'");
       // print_r($deals->result());exit;
        $this->data['deals'] = $deals->result();
        $count = $this->db->query("SELECT count(`id`) as total_visit FROM `orders` WHERE user_id='$id'");
       // print_r($this->db->last_query());exit;
        $total_visit = $count->result();
        $this->data['user_discount'] = $total_visit[0]->total_visit-1;
        $this->load->view('header');
        $this->load->view('user/dashboard',$this->data);
        $this->load->view('footer');
    }

   
}

public function buy($id){ //$id = deals id
                 $uid =  $this->session->id; //user id
                $data = array('table'=>'orders',
                            'val'=>array(
                                'user_id'=>$uid,
                                'deals_id'=>$id,
                                'quantity'=>'1',
                                'status'=>'1'
                            ));
                $this->db->insert($data['table'],$data['val']);
                $deals_id = $this->db->insert_id();
            if($deals_id){
                $this->db->query("UPDATE `deals` SET remaining_quantity = remaining_quantity-1 WHERE `id`= '$id'");
                $this->session->set_flashdata('orders', 'order created successfully');
                redirect("user/dashboard/$uid","refresh");
            }else{
                $this->session->set_flashdata('error0', 'Oops! something went wrong please try again');
            }
    
}

public function logout(){
    $this->session->sess_destroy();
    $message='logout successfully';
    $message=urlencode($message);
    redirect('admin/login_user?message='."$message");
}
    
   
}


