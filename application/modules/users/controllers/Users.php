<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {

	function __construct()
    {
		parent::__construct();
		if(!$this->session->userdata('authorized'))
		{
			//echo $this->session->userdata('authorized');die;
			redirect(base_url('admin'));
		}
		$this->load->library('form_validation');
		$this->load->model('users_model');
	}

	public function index()
	{


		if(!empty($_POST))
		{
			$survey = $this->input->post('survey');
			$org = $this->input->post('org');
			$case = $this->input->post('case');
			$place = $this->input->post('place');
			 $where='';
			if(!empty($survey))
			{

				if($survey==1)
				{
					$where = 'ubs.is_completed=2 and u.survey_status !=5 ';
					//$where = array('ubs.is_completed'=>2,'u.survey_status !='=>5);
					$ubs=1;
				}
				else
				{
					// condition when both survey is completed
					$where='u.survey_status=5';
					// $where = array('u.survey_status'=>5);
					$ubs=0;
				}
			}
			 if(!empty($org))
			 {	
			 	if($where)
			 	{
			 		$where.=' and u.org='.$org.'';
			 		
			 	}
			 	else
			 	{
			 		$where.='u.org='.$org.'';
			 	}
			 	// $where['u.org']=$org;
			 }
			 if(!empty($case))
			 {
			 	if($where)
			 	{
			 		$where.=' and u.case_number='.$case.'';
			 		
			 	}
			 	else
			 	{
			 		$where.='u.case_number='.$case.'';
			 	}
			 	// $where['u.case_number']=$case;
			 }
			 if(!empty($place))
			 {
			 	 // echo $place;die;
			 	
			 	if($place==1)//exist in database
			 	{
			 		
			 		// $where['t.status']=1;
			 		// $where['OR m.status']=1;
			 		if($where)
			 		{
			 			$where.=' and (m.status=1 or t.status=1)';
			 			
			 		}
			 		else
			 		{
			 			$where.='m.status=1 or t.status=1';
			 		}
			 		// $or_where=array('m.status'=>1);
			 		// $or_where['t.status']=1;
			 		// $where['m.status']=1;
			 	}
			 	else//does not exist in database
			 	{
			 		
			 		if($where)
			 		{

			 			$where.=' and (m.status=2 or t.status=2)';	
			 			
			 		}
			 		else
			 		{
			 			$where.='m.status=2 or t.status=2';
			 		}
			 		// $or_where=array('m.status'=>2);
			 		// $or_where['t.status']=2;
			 		//echo"222";die;
			 		// $where['t.status']=2;
			 		// $where['OR m.status']=1;
			 		// $or_where=array('m.status'=>2);
			 		// $where['m.moza']=2;
			 	}
			 }
			 // echo $place;die;
			
				$users =  $this->users_model->filterd_user($where);
				// echo "<pre>";print_r($users); die;
				    // echo $this->db->last_query(); die;
				$counts_data = $this->users_model->get_all_counts();
				$tabel='organisations';
				$column=array();
				$where=array();
				$flag='result_array_not_id';
				$org = $this->users_model->get_data($tabel,$column,$where,$flag);
				$data['org'] =$org;

				$data['counts'] = $counts_data;
				$data['page']='users_view';
				$data['users'] = $users;
				_layout_admin($data);


		}
		else
		{

			$tabel='organisations';
	        $column=array();
	        $where=array();
	        $flag='result_array_not_id';
	        $org = $this->users_model->get_data($tabel,$column,$where,$flag);
	        // $tabel='organisation_sector';
	        // $psu = $this->users_model->get_data($tabel,$column,$where,$flag);
			$users = $this->users_model->get_all_users();
			$counts_data = $this->users_model->get_all_counts();
			// echo"<pre>";print_r($counts_data); die;
			$data['org'] =$org;
			$data['counts'] = $counts_data;
			$data['page']='users_view';
			$data['users'] = $users;
			_layout_admin($data);
			// $this->load->view('dashboard_view');
		}






	}
	
	public function view_user_detail()
	{
		$user_id = $this->input->get('id');
		$user_info = $this->users_model->get_user_info($user_id);

		//echo $this->db->last_query(); die;

		$childeren_details = $this->users_model->get_chideren_detail($user_id);
		$sib_income = $this->users_model->get_sibling_income($user_id);
		//echo $this->db->last_query(); die;
		 //echo"<pre>";print_r($sib_income);die;
		if($sib_income)
		{
			//echo"hello"; die;
			$data['sib_income'] = $sib_income;
		}
		$data['user_info'] = $user_info;
		$data['childeren_details'] = $childeren_details;
		$data['page']='user_details';
		_layout_admin($data);
	}

	public function view_survey()
	{
		$user_id = $this->input->get('id');
		$user_second_survey_details = $this->users_model->user_second_survey_details($user_id);
		//echo"<pre>";print_r($user_second_survey_details); die;
		if(!empty($user_second_survey_details))
		{


			foreach ($user_second_survey_details as $key => $value)
			{
				$column_name = $key;
				$questions_ids[$column_name] = array_column($user_second_survey_details[$column_name], 'qn_id');
				
			}

			if(!empty($questions_ids))
			{

				foreach ($questions_ids as $key => $value)
				{
					$question_id_array = $questions_ids[$key];
					if(!empty($question_id_array))
					{
						$result_array[$key] = $this->users_model->get_question_answer($question_id_array,$key);
						
					}
				}
				if(!empty($result_array))
				{

					$data['second_survey_answers'] = $result_array;
				}
			}
		}
		$user_fist_survey_details = $this->users_model->get_first_survey_details($user_id);
		 // echo"<pre>";print_r($user_fist_survey_details); die;
		$data['page'] = 'survey_details';
		$data['answers'] = $user_fist_survey_details;
		_layout_admin($data);
	}
	public function get_organisation()
	{
		$tabel='organisations';
        $column=array();
        $where=array();
        $flag='result_array_not_id';
        $org = $this->api_model->get_data($tabel,$column,$where,$flag);
	}

	public function delete_user()
	{
		//echo"hello";die;
		$user_id = $this->input->get('id');
		$where = array('id'=>$user_id);
		$tabel = 'users';
		//echo $user_id; die;
		$bool = $this->users_model->del_user($tabel,$where);
		if($bool)
		{
			$this->session->set_flashdata('user_deleted','User Deleted Successfully');
		}
		else
		{
			$this->session->set_flashdata('user_deleted','Error In Deletion');

		}
		redirect(base_url('users'));

	}
	public function delete_survey()
	{
		$user_id = $this->input->get('id');
		
		$where = array('user_id'=>$user_id);
		$tabel='user_basick_survey';
		$bool = $this->users_model->delete_dataa($tabel,$where);
		$tabel='op_a';
		$bool = $this->users_model->delete_dataa($tabel,$where);
		$tabel='op_b';
		$bool = $this->users_model->delete_dataa($tabel,$where);
		$tabel='op_c';
		$bool = $this->users_model->delete_dataa($tabel,$where);
		$tabel='op_d';
		$bool = $this->users_model->delete_dataa($tabel,$where);
		$tabel='independent_income';
		$bool = $this->users_model->delete_dataa($tabel,$where);
		$where = array('id'=>$user_id);
		$tabel = 'users';
		$set=array('survey_status'=>0);
		$bool = $this->users_model->updte_data($tabel,$where,$set);
		//echo $this->db->last_query(); die;
		if($bool)
		{
			$this->session->set_flashdata('survey_deleted','Survey Deleted Successfully');
		}
		else
		{
			$this->session->set_flashdata('survey_deleted','Error In Survey Deletion');

		}
		redirect('users');
	}
}
