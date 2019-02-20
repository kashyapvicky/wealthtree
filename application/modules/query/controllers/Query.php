<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class query extends MX_Controller {

	function __construct()
    {
		parent::__construct();
		if(!$this->session->userdata('authorized'))
		{
			//echo $this->session->userdata('authorized');die;
			redirect(base_url('admin'));
		}
		$this->load->library('form_validation');
		$this->load->model('query_model');
	}

	public function index()
	{

		$where=array();
		$session_data = $this->session->userdata('session_data');
		if($session_data['level']==1)
		{
			$where=array();
		}
		else
		{
			$where=array('assiagn_to'=>$session_data['id'],'status'=>1);//1=>not responded,2=>responded
			
		}

		$tabel ='queries';
		$flag='result_array';
		$column=array();
		$queries = $this->query_model->get_data($tabel,$column,$where,$flag);
		
		$data['queries'] = $queries;
		$data['page']='query_view';
		_layout_admin($data);
		// $this->load->view('dashboard_view');
	}
	public function view_query()
	{
		$query_id = $this->input->get('id');
		$tabel ='queries';
		$flag='row_array';
		$column=array();
		$where=array('id'=>$query_id);
		$query_data = $this->query_model->get_data($tabel,$column,$where,$flag);

		// print_r($query_data); die;
		
		$admin_list = $this->query_model->get_admin_list();

		 foreach ($admin_list as $key => $value)
		 {
		 	if($value['level']==2)
		 	{
		 		$level_1[] =$value; 
		 	}
		 	else
		 	{
		 		$level_2[] =$value; 
		 	}
		 }
		 
		 // echo"<pre>"; print_r($level_1); 
		 // echo"<pre>"; print_r($level_2); die;
		// echo $this->db->last_query(); die;
		if(!empty($level_1))
		{

			$data['level_1'] = $level_1;
		}
		if(!empty($level_2))
		{

			$data['level_2'] = $level_2;
		}
		$data['query_data'] =$query_data;
		$data['page']='assign_query_view';
		_layout_admin($data);

	}
	public function assign_query()
	{
		// echo"</pre>";
		// print_r($_POST);
		// die;

		$query_id = $this->input->post('query_id');
		$admin_id = $this->input->post('admin_id');

		$bool = $this->query_model->assign_admin_to_query($query_id,$admin_id);
		if($bool)
		{
			$this->session->set_flashdata('query_assigned','Query Assiagned Succesfully');
			redirect('query/assigned_view?id='.$query_id.'');
		}
		else
		{
			$this->session->set_flashdata('query_assigned','Query Not Assiagned');
			redirect('query/view_query');
		}
	}

	function assigned_view()
	{
		 $query_id = $this->input->get('id');
		// // echo $query_id;  die;
		// $tabel ='queries';
		// $flag='row_array';
		// $column=array();
		// $where=array('id'=>$query_id);
		// $query_data = $this->query_model->get_data($tabel,$column,$where,$flag);
		$query_data = $this->query_model->get_assigned_query_data($query_id);
		$data['query_data'] = $query_data;
		$data['page']='assigned_view';
		_layout_admin($data);
	}
	function query_solution()
	{

		$this->form_validation->set_rules('solution','Query Solution','required');
		if($this->form_validation->run()==true)
		{
			 $solution = $this->input->post('solution');
			 $query_id = $this->input->post('hidden_id');
			 $status = $this->input->post('status');
			 $data = array(
			 	'solution'=>$solution,
			 	'query_id'=>$query_id,
			 	'status'=>$status
			);
			 $tabel='query_solution';
			$insert_id = $this->query_model->insert_data($tabel,$data);
			if($insert_id)
			{
				$this->query_model->update_query_as_responded($query_id);
				// echo $this->db->last_query(); die;
				$this->session->set_flashdata('solution_updated','Solution Updated Succesfully');
				redirect('query');
			}
			else
			{
				$this->session->set_flashdata('solution_updated','Error In Insertion');
			}
		}

		$query_id = $this->input->get('id');
		// echo $query_id; die;
		$query_data = $this->query_model->get_assigned_query_data($query_id);
		// print_r($query_data); die;
		$data['query_data'] = $query_data;
		$data['page']='query_solution';
		_layout_admin($data);

	}
	
}
