<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subadmin extends MX_Controller {

	function __construct()
    {
		parent::__construct();
		if(!$this->session->userdata('authorized'))
		{
			//echo $this->session->userdata('authorized');die;
			redirect(base_url('admin'));
		}
		$this->load->library('form_validation');
		$this->load->model('subadmin_model');
	}

	public function index()
	{

		$subadmins = $this->subadmin_model->get_admins();
		// echo $this->db->last_query(); die;
		// echo"<pre>";print_r($subadmins);die;
		$data['subadmins'] = $subadmins;
		$data['page']='subadmin_view';
		_layout_admin($data);
		// $this->load->view('dashboard_view');
	}
	public function add_subadmin()					// add and edit subadmins
	{
		 $this->form_validation->set_rules('admin_type', 'Admin Type', 'required'); 
		 $this->form_validation->set_rules('name', 'Name', 'required'); 
		 $this->form_validation->set_rules('mobile', 'Mobile No', 'required'); 
		 $this->form_validation->set_rules('email', 'Email', 'required'); 
		 $this->form_validation->set_rules('password', 'Password', 'required'); 
		// $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

		if ($this->form_validation->run() == TRUE)
		{
			$data=array
			(
				'level'=>$this->input->post('admin_type'),
				'name'=>$this->input->post('name'),
				'mobile_no'=>$this->input->post('mobile'),
				'email'=>$this->input->post('email'),
				'password'=>$this->input->post('password'),

			);
			if($this->input->post('hidden_id'))
			{
				$id = $this->input->post('hidden_id');
				$bool = $this->subadmin_model->update_admin_data($id,$data);
				if($bool)
				{
					$this->session->set_flashdata('insert_succ','Succesfully Added');
					redirect(base_url('subadmin'));
				}
				else
				{
					$this->session->set_flashdate('insert_succ','Error In Adding Data');
				}
			}
			else
			{
				$insert_id = $this->subadmin_model->insert_admin_data($data);
				if($insert_id)
				{
					$this->session->set_flashdata('insert_succ','Succesfully Added');
					redirect(base_url('subadmin'));
				}
				else
				{
					$this->session->set_flashdate('insert_succ','Error In Adding Data');
				}

			}
			
		} 
		if($this->input->get('id'))
		{
			$id = $this->input->get('id');
			$admin_data = $this->subadmin_model->get_admin_data_to_edit($id);
			$data['admin_data'] = $admin_data;
		}
		$data['page']='add_subadmin';
		_layout_admin($data);
	}
	function delete_admin()
	{
		$admin_id = $this->input->get('id');
		$bool = $this->subadmin_model->delete_admin($admin_id);
		if($bool)
		{
			$this->session->set_flashdata('delete_succ','Succesfully Deleted');

		}
		else
		{
			$this->session->set_flashdata('delete_succ','Error In  Deletion');

		}
		redirect('subadmin');
	}
	function view_subadmin()
	{
		$id = $this->input->get('id');
		$admin_data = $this->subadmin_model->get_admin_data_to_edit($id);//used twice
		$data['admin_data'] = $admin_data;
		$data['page']='admin_detail_view';
		_layout_admin($data);

	}

	
}
