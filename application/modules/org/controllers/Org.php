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
	public function top_towns()
	{

		$moza = $this->org_model->get_top_moza();
		$top_mozas_id = array();
		foreach ($moza as $key => $value)
		{
			if($value['moza_id']!=0 && $value['moza_count'] >=30)
			{
				array_push($top_mozas_id, $value['moza_id']);
			}
		}
		// print_r($top_mozas_id);die;
		$town = $this->org_model->get_top_town();

		$top_towns_id = array();
		foreach ($town as $key => $value)
		{
			if($value['town_id']!=0 && $value['town_count'] >=30)
			{
				array_push($top_towns_id, $value['town_id']);
			}
		}
		$tabel ='moza';
		//$where_in=array('id'=>$top_mozas_id);
		$mozas_names=array();
		if(!empty($top_mozas_id))
		{

			$mozas_names = $this->org_model->get_top_name($tabel,$top_mozas_id);
			// $data['moza'] = $mozas_names
		}
		//echo $this->db->last_query(); die;
		//echo"<pre>";print_r($mozas_names); die;
		$tabel='town';
		$town_name=array();
		if(!empty($top_towns_id))
		{
			$town_name = $this->org_model->get_top_name($tabel,$top_towns_id);
			//$data['town'] = $town_name;
		}

		$top_locations = array_merge($mozas_names,$town_name);
		$data['locations'] = $top_locations;
		//echo"<pre>";print_r($top_locations); die;
		$data['page'] = 'top_town';
		_layout_admin($data);
	}
}
