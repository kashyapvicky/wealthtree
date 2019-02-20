<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Org extends MX_Controller {

	function __construct()
    {
		parent::__construct();
		if(!$this->session->userdata('authorized'))
		{
			//echo $this->session->userdata('authorized');die;
			redirect(base_url('admin'));
		}
		$this->load->library('form_validation');
		$this->load->model('org_model');
	}

	public function index()
	{
		
		$where=array();
		// $faqs = $this->faq_model->get_faqs($where);
		$tabel='organisations';
		$where=array();
		$org  = $this->org_model->get_data($tabel,$where);
		 // echo"<pre>";print_r($tabs); die;
		$data['org'] = $org;
		$data['page'] = 'org_view';
		_layout_admin($data);
	}
	public function add_org()
	{
		$org_name = $this->input->post('org_name');
		$where = array();
		$tabel = 'organisations';
		$data=array('name'=>$org_name);
		$tab_id = $this->org_model->insert_data($tabel,$where,$data);
		if($tab_id)
		{
			$this->session->set_flashdata('org_insert','Succesfully Inserted');
			redirect('org');
		}
		else
		{
			$this->session->set_flashdata('org_insert','Error In Insertion');
		}
		redirect('org');
	}
	public function delete_org()
	{
		$org_id = $this->input->get('id');
		$where=array('id'=>$org_id);
		$tabel='organisations';
		$bool = $this->org_model->delete($tabel,$where);
		// echo $this->db->last_query(); die;

		if($bool)
		{
			$this->session->set_flashdata('org_delete','Successfully Deleted');

		}
		else
		{
			$this->session->set_flashdata('org_delete','Error In Deletion');

		}
		redirect('org');
	}
	public function edit_org()
	{
		$org_id = $this->input->post('org_id');
		$name = $this->input->post('org_name');

		$bool = $this->org_model->update_org($org_id,$name);
		if($bool)
		{
			$this->session->set_flashdata('org_edited','Succesfully Updated');
			
		}
		else
		{
			$this->session->set_flashdata('org_edited','Error In Updation');
		}
		redirect('org');
	}
}
