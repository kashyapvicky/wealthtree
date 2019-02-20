<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function index()
	{
		//echo "cxv"; die;
			 // $data['page']='admin_login';
			 // _layout_admin($data);
		$this->load->view('admin_login');
	}
	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required'); 
		$email = $this->input->post('email');
		//echo $email ; die;
		$password = $this->input->post('password');

		$admin_detail = $this->admin_model->admin_credentials($email,$password);
		//echo $this->db->last_query(); die;
		
			if($admin_detail)
			{
				// print_r($admin_detail);die;
				$this->session->set_userdata('session_data',$admin_detail);
				 // print_r($this->session->userdata('session_data'));	die;
				$this->session->set_userdata(array('authorized' => 1));
				if($admin_detail['level']==1)
				{
					redirect(base_url('dashboard'));
				}
				else
				{
					redirect(base_url('query'));
				}
			}
			else
			{
				$this->session->set_flashdata('item','Invalid Credentials');
			}
			
		
		redirect(base_url('admin'));
	}
	public function logout()
	{
		$this->session->unset_userdata('authorized');
		redirect(base_url('admin'));
	}
	public function forget_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'required'); 
			
         if($this->form_validation->run() == true)
         { 
         	$email = $this->input->post('email');
         	$row = $this->admin_model->chek_email($email);
         	if($row)
         	{
	     		$message='';
	     		$email='veee.kay258@gmail.com';
	  			//$message = $this->load->view('mail_template',$data,'true');
	            $this->load->library('email');
	            $config['protocol']    = 'smtp';
	            $config['smtp_host']    = 'smtp.gmail.com';
	            $config['smtp_port']    = '567';
	            $config['smtp_timeout'] = '7';
	            $config['smtp_user']    = 'veee.kay258@gmail.com';
	            //$config['smtp_pass']    = 'Heyudude@0';
	            $config['charset']    = 'utf-8';
	            $config['newline']    = "\r\n";
	            $config['mailtype'] = 'html'; // or html
	            $config['validation'] = TRUE; // bool whether to validate email or not      
	            $this->load->library('email', $config);
	            $this->email->from('vicky@ripenapps.com','vicky');
	            $this->email->to($email);
	            $this->email->subject('Password Reset Link');
	             $message .="<a href = ".base_url()."admin/reset_password?id=".$row['id'].">Click Here To Reset Your Password</a>";
	             //echo $message; die;
	            $this->email->message($message);  
	            $this->email->set_mailtype("html");
	            if($this->email->send())
	            {
	            	$this->session->set_flashdata('link_sent','Password Reset link Sent To Your Email Address');
	            }
	            else
	            {
	            	$this->session->set_flashdata('link_sent','Error In Sending Email');
	            }

	            redirect('admin');
         	}
         	else
         	{
         		$this->session->set_flashdata('email_not_found','Email Not Exist');
         	}
         } 
     

		$this->load->view('forget_password_view');

	}
	public function reset_password()
	{
		//echo"hello";die;

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('id', 'ID', '');
		$this->form_validation->set_rules('cnf_password', 'confirm password', 'required|matches[password]');
		//echo validation_error();
		if($this->form_validation->run() == TRUE)
		{ 

			$id = $this->input->post('id');
			$password = $this->input->post('password');
			$bool = $this->admin_model->update_password($id,$password);
			//echo $this->db->last_query(); die;
			if($bool)
			{
				$this->session->set_flashdata('password_changed','Password Updated Succesfully');
				redirect('admin');
			}
			else
			{
				$this->session->set_flashdata('password_changed','Error In Password Updation');
				redirect('admin');

			}
		}
		$id = $this->input->get('id');
		$data['id'] = $id;
		 $this->load->view('reset_password',$data);

	}

}
