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
        echo "Access Denied !unauthorized access"; exit;
    }
    if($status){
        $deals = $this->db->query('SELECT * FROM `deals`');
        $this->data['deals'] = $deals->result();
        $this->load->view('header');
        $this->load->view('admin/dashboard',$this->data);
        $this->load->view('footer');
    }else{
        echo "Access Denied !unauthorized access"; exit;
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
    $message='logout successfully';
    $message=urlencode($message);
    redirect('admin/login_user?message='."$message");
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
        $this->session->set_flashdata('error', validation_errors());
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
                 $this->session->set_flashdata('error', 'required images are missing');
                 redirect('admin/add_deals');
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
    
public function save_user($id=null){
    // print_r($_POST);exit;
     $this->form_validation->set_rules('username', 'Username', 'required');
     $this->form_validation->set_rules('email', 'email', 'required');
     if(!$id){
        $this->form_validation->set_rules('password', 'Password', 'required');   
    }
     
     if ($this->form_validation->run() == FALSE)
     {
         $this->session->set_flashdata('error', validation_errors());
         redirect('admin/register_user');
     }
     else
     { // echo "hello";exit;
             
             $username = $this->input->post('username');
             $email = $this->input->post('email');
             $password = $this->input->post('password');
             
             $image =null;
             if($_FILES['image']['name'])
             {
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
            }
                 $data = array('table'=>'users',
                             'val'=>array(
                                 'username'=>$username,
                                 'email'=>$email
                                 //,'password'=>$password,
                                // 'image'=>$image,
                                // 'active'=>'1'
                             ));
            if($password){
                 $password = password_hash($password, PASSWORD_BCRYPT,[12]);
                 $data['val']['password']=$password;
             }
            if($image){
                $data['val']['image']=$image;
            }
            if($id){
                $this->db->where('id',$id);
                $this->db->update($data['table'],$data['val']);   
                $this->session->set_flashdata('error', 'user updated successfully');
                    redirect('admin/get_all_user','refresh'); 
            }else{
                $data['val']['active']='1';
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
 }

 public function register_user($uid=null){
    if($this->session->admin && $this->session->logged_in && $this->session->id){
        if($uid){
            $user =  $this->db->query("SELECT * FROM `users` WHERE id='$uid'");
            $info = $user->row(0);
            $this->data['user'] = $info;
        }else{ $this->data['a'] = ''; }
    $this->load->view('header');
    $this->load->view('register',$this->data);
    $this->load->view('footer');
    }else{
        redirect('admin/login_user');
    }

 }

 public function login_user(){
     if(isset($_GET['message'])){$this->data['message'] = $_GET['message'];}
     else{$this->data['message'] = '';}
    $this->load->view('header');
    $this->load->view('login',$this->data);
    $this->load->view('footer');

 }

 public function login(){
        $ip =$_SERVER["REMOTE_ADDR"];
        $login_attempts=array( 'table'=>'login_attempts',
                                'val'=>array(
                                    'ip'=>$ip
                                    ));
        $this->db->insert($login_attempts['table'],$login_attempts['val']);                    
        $query =  $this->db->query("Select count(id) as total_attempts FROM login_attempts WHERE ip LIKE '$ip' AND login_time > (now()-interval 10 minute)");
         $log_attempts= $query->row(0);
         if($log_attempts && $log_attempts->total_attempts>3)
         {
            $this->session->set_flashdata('error', "Please try agian after 10 minutes. Login attempts exceed it's maximum limit");
            redirect('admin/login_user');
         }
    $this->form_validation->set_rules('email', 'email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    
    if ($this->form_validation->run() == FALSE)
    {
        $this->session->set_flashdata('error', validation_errors());
        redirect('admin/login_user');
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
        
       }else{
         

        $this->session->set_flashdata('error', 'Wrong Username or Password');
        redirect('admin/login_user');
       }

    }
 }

 public function user_status(){
    $uid = $this->input->post('id');
    $status = $this->input->post('status');
   // print_r($_POST); exit;
    if($uid){
        if($status=='0'){
            $this->db->query("UPDATE `users` SET `active`='0' WHERE id='$uid'");
            $data = array('msg'=>'Activate');
        }else{
            $this->db->query("UPDATE `users` SET `active`='1' WHERE id='$uid'");
            $data = array('msg'=>'Deactivate'); 
        }
        echo json_encode($data);
    }else{
        echo "something went wrong";
    }
 }
    
}


