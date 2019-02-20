<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	function __construct()
    {
		parent::__construct();
		if(!$this->session->userdata('authorized'))
		{
			//echo $this->session->userdata('authorized');die;
			redirect(base_url('admin'));
		}
		$this->load->library('form_validation');
		$this->load->model('dashboard_model');
	}

	public function index()
	{
		// echo"here";die;

		$stats = $this->dashboard_model->get_stat();

		//print_r($stats); die;
		$data['stat'] = $stats;
		$data['page']='dashboard_view';
		_layout_admin($data);
		// $this->load->view('dashboard_view');
	}
	

}
