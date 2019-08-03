<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller { 

    public function __construct()	
	{
        parent::__construct();	
        $this->load->library('form_validation');
	}	

public function dashboard(){
    if($this->session->admin && $this->session->logged_in && $this->session->id){
        $status = true;
    }
    else{ $status = false;
        echo "Access Denied !unauthorized access";
    }
    if($status){
        $deals = $this->db->query('SELECT * FROM `deals`');
        $this->data['deals'] = $deals->result();
        $this->load->view('header');
        $this->load->view('admin/dashboard',$this->data);
        $this->load->view('footer');
    }else{
        echo "Access Denied !unauthorized access";
    }
}
public function get_all_user(){
    if($this->session->admin && $this->session->logged_in && $this->session->id){
      $user =  $this->db->query("SELECT * FROM `users`");
      $this->data['user'] = $user->result();
      $this->load->view('header');
      $this->load->view('admin/user',$this->data);
      $this->load->view('footer');
    }
    else{ $status = false;
        echo "Access Denied !unauthorized access";
    } 
}

public function add_deals(){
    if($this->session->admin && $this->session->logged_in && $this->session->id){
        $date = $this->db->query('SELECT `id`, `publish_date` FROM `deals` WHERE `publish` = 1'); 
        $array = $date->result_array();
        $arr = array_column($array,"publish_date");
       // print_r($arr);exit;
        $this->data['date'] = $arr;
        $this->load->view('header');
        $this->load->view('admin/deals_add',$this->data);
        $this->load->view('footer');
    }else{
        echo "Access Denied !unauthorized access";
    }
   
}

public function logout(){
    $this->session->sess_destroy();
    echo "logout successfully";
}

public function save_deals(){
   // print_r($_POST);exit;
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');
    $this->form_validation->set_rules('price', 'price', 'required');
    $this->form_validation->set_rules('discount', 'discount', 'required');
    $this->form_validation->set_rules('quantity', 'quantity', 'required');
    $this->form_validation->set_rules('date', 'date', 'required');
    //$this->form_validation->set_rules('image', 'Image', 'required');
    
    if ($this->form_validation->run() == FALSE)
    {
        $this->session->set_flashdata('error', 'required fields are missing');
        redirect('admin/add_deals');
    }
    else
    { // echo "hello";exit;
            
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $price = $this->input->post('price');
            $discount = $this->input->post('discount');
            $quantity = $this->input->post('quantity');
            $date = $this->input->post('date');

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2097152';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
                if (!is_dir('uploads'))
                {   $old_mask = umask(0);
                    mkdir('uploads', 0777, true);
                    umask($old_mask);
                }
                if ( ! $this->upload->do_upload('image'))
                {
                // $this->session->set_flashdata('image error', 'required images are missing');
                }
                else
                {
                    $img = array('upload_data' => $this->upload->data());
                    $image = $img['upload_data']['file_name']; 
                            
                }

                $data = array('table'=>'deals',
                            'val'=>array(
                                'title'=>$title,
                                'description'=>$description,
                                'price'=>$price,
                                'discounted_price'=>$discount,
                                'quantity'=>$quantity,
                                'remaining_quantity'=>$quantity,
                                'publish_date'=>$date,
                                'image'=>$image,
                                'publish'=>'1'
                            ));
                $this->db->insert($data['table'],$data['val']);
                $deals_id = $this->db->insert_id();
            if($deals_id){
                $this->session->set_flashdata('error', 'Deal created successfully');
                redirect('admin/dashboard','refresh');
            }else{
                $this->session->set_flashdata('error', 'Oops! something went wrong please try again');
            }
    }
}
    
public function save_user(){
    // print_r($_POST);exit;
     $this->form_validation->set_rules('username', 'Username', 'required');
     $this->form_validation->set_rules('email', 'email', 'required');
     $this->form_validation->set_rules('password', 'Password', 'required');
     
     if ($this->form_validation->run() == FALSE)
     {
         $this->session->set_flashdata('error', 'required fields are missing');
         redirect('admin/register_user');
     }
     else
     { // echo "hello";exit;
             
             $username = $this->input->post('username');
             $email = $this->input->post('email');
             $password = $this->input->post('password');
             $password = password_hash($password, PASSWORD_BCRYPT,[12]);
 
             $config['upload_path'] = './uploads/user';
             $config['allowed_types'] = 'gif|jpg|png';
             $config['max_size'] = '2097152';
             $this->load->library('upload', $config);
            // $this->upload->initialize($config);
                 if (!is_dir('uploads/user'))
                 {   $old_mask = umask(0);
                     mkdir('uploads/user', 0777, true);
                     umask($old_mask);
                 }
                 if ( ! $this->upload->do_upload('image'))
                 {  
                 $this->session->set_flashdata('error', 'required images are missing');
                 redirect('admin/register_user');
                 }
                 else
                 {
                     $img = array('upload_data' => $this->upload->data());
                     $image = $img['upload_data']['file_name']; 
                             
                 }
 
                 $data = array('table'=>'users',
                             'val'=>array(
                                 'username'=>$username,
                                 'email'=>$email,
                                 'password'=>$password,
                                 'image'=>$image,
                                 'active'=>'1'
                             ));
                 $this->db->insert($data['table'],$data['val']);
                 $user_id = $this->db->insert_id();
             if($user_id){
                 $this->session->set_flashdata('error', 'user created successfully');
                 redirect('admin/login_user','refresh');
             }else{
                 $this->session->set_flashdata('error', 'Oops! something went wrong please try again');
             }
     }
 }

 public function register_user(){
    if($this->session->admin && $this->session->logged_in && $this->session->id){
    $this->load->view('header');
    $this->load->view('register');
    $this->load->view('footer');
    }else{
        redirect('admin/login_user');
    }

 }

 public function login_user(){
    $this->load->view('header');
    $this->load->view('login');
    $this->load->view('footer');

 }

 public function login(){

    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    
    if ($this->form_validation->run() == FALSE)
    {
        $this->session->set_flashdata('error', 'required fields are missing');

    }
    else
    { 
        $email = $this->input->post('email');
        $password = $this->input->post('password');
       $user = $this->db->query("SELECT `id`,`password`,`admin` FROM `users` WHERE `email`='$email'");
       $user_info = $user->row(0);
       if(password_verify($password,$user_info->password)){
            if($user_info->admin==1){
                $admin = array(
                    'admin'  => TRUE,
                    'id'     => $user_info->id,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($admin);
                redirect('admin/dashboard');
            }else{
                $user0 = array(
                    'user'  => TRUE,
                    'id'     => $user_info->id,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($user0);
                redirect('user/dashboard');
            }
        
       }

    }
 }
    
}


