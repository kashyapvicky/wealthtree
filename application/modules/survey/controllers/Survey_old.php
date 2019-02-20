<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('survey_model');
		if(empty($this->session->tempdata('user_id')))
		{
			//echo"<script>alert('not found')</script>";die;
			redirect(base_url_custom);
		}
		// else
		// {
			// $user_id = $this->session->tempdata('user_id');
			// $this->survey_model->update_survey_status_by_1($user_id);
			//echo"<script>alert('updated here')</script>";
		//}
	}

	public function index()
	{
		$user_id = $this->session->tempdata('user_id');
		$income_row = $user_salary = $this->survey_model->get_user_income($user_id);
		$income =  $income_row['income'];
		$states = $this->survey_model->get_states();
		//print_r($states); die;
		$data['income'] = $income;
		$data['states']=$states;
		$data['page']='survey_view';
		_layout($data);
	}
	public function get_city()
	{
		$state_id = $this->input->post('id');
		//echo $country_id;
		//$state_array = $this->website_model->get_state_by_country_id(1);
		//print_r($state_array);
		$city_array = $this->survey_model->get_city_by_state_id($state_id);
		$output='';
		 $output ='<option value="0" disabled selected="">Select Your District</option>';
		foreach ($city_array as $key => $value) {

			$output.="


			<option value='".$value['id']."'>".$value['name']."</option>";
		}
		//print_r($output);
		echo json_encode($output);
	}
	public function get_town()
	{
		$c_id = $this->input->post('id');
		//echo $country_id;
		//$state_array = $this->website_model->get_state_by_country_id(1);
		//print_r($state_array);
		$town_array = $this->survey_model->get_town_by_city_id($c_id);
		$output='';
		$output ='<option value="" disabled selected="">Choose A City</option>';
		foreach ($town_array as $key => $value)
		{

			$output.="
			<option value='".$value['id']."'>".$value['name']."</option>";
		}
		$output.="<option value='others'>Others(Fill your town name)</option>";
		//print_r($output);
		echo json_encode($output);
	}
	public function survey_data()
	{
		//echo "<pre>";print_r($_POST); die;
		//empty($this->session->tempdata('user_id')
		$user_id = $this->session->tempdata('user_id');
		//echo $user_id; die;
		$state_id = $this->input->post('state_id');
		$district_id = $this->input->post('district_id');
		$place = $this->input->post('place');
		$sub_place = $this->input->post('sub_place');
		$is_pakka = $this->input->post('is_pakka');
		//$no_pakka = $this->input->post('no_pakka');
		$pakka_name = $this->input->post('pakka');
		//$family = $this->input->post('family');
		$independent_wife = $this->input->post('independent_wife');
		$other_town = $this->input->post('town');

		// hidden fields values

		$ncity_id = $this->input->post('ncity_id');
		$moza_id = $this->input->post('moza_id');
		$what_you_want = $this->input->post('what_want');


		$survey_data = array(
			'user_id'=>$user_id,
			'state_id'=>$state_id,
			'district_id'=>$district_id,
			'place'=>$place,
			'sub_place'=>$sub_place,
			'pakka_house'=>$pakka_name,
			'what_you_want'=>$what_you_want,
			'independent_wife'=>$independent_wife,
			'town_id'=>$other_town,
			'ncity_id'=>$ncity_id,
			'moza_id'=>$moza_id,
			'is_completed'=>2,
		);

		$insert_id = $this->survey_model->insert_basick_survey_data($survey_data);

		if($insert_id)
		{

			$son = $this->input->post('son');
			$daughter = $this->input->post('daughter');
			//echo "<pre>"; print_r($son['salary']); die;
			// 			echo"<pre>";print_r($son); die;
			// array_filter($son);
			// print_r(count(array_filter($son['salary']))); die;
			if(count(array_filter($son['salary']))>0)
			{
				//echo "son";
				//print_r($son); die;
				for($i = 0; $i<count($son['age']); $i++)
				{
					$age = $son['age'][$i];
					$salary = $son['salary'][$i];

					// echo $age; 
					// echo"<br>";
					// echo $salary;
					// echo"<br>";
					$this->survey_model->insert_son($age,$salary,$user_id);
				}
			}
			if(count(array_filter($daughter['salary']))>0)
			{
				//echo"daughter";
				//print_r($daughter); die;
				$bool = '';
				for($i = 0; $i<count($daughter['age']); $i++)
				{
					$age = $daughter['age'][$i];
					$salary = $daughter['salary'][$i];
					$bool = $this->survey_model->insert_daughter($age,$salary,$user_id);
				}
				if($bool)
				{
					redirect('survey/second_survey');
				}
			}
		}
		else
		{
			echo"<script>alert('error in insertion')</script>";
		}
		redirect('survey/second_survey');

	}
	public function second_survey()
	{
		$user_id = $this->session->tempdata('user_id');
		//$this->survey_model->update_survey_status_by_1($user_id);
		$question_option_array = $this->survey_model->get_question_and_option();
		//echo "<pre>";print_r($question_option_array); die;
		$data['questions_option'] = $question_option_array;
		$data['page']='second_survey';
		_layout($data);
	}
	public function insert_second_survey_data()
	{
		$user_id = $this->session->userdata('user_id');
		//echo"<pre>";print_r($_POST); die;
		$option_a_array = array();
		$option_b_array = array();
		$option_c_array = array();
		$option_d_array = array();
		foreach ($_POST as $key => $value) 
		{

			if($value == 'op_a')
			{
				$option_a_array[] = array(
					'qn_id'=>$key,
					'user_id'=>$user_id

				);


			}
			elseif($value == 'op_b')
			{
				$option_b_array[] = array(
					'qn_id'=>$key,
					'user_id'=>$user_id

				);
			}
			elseif($value == 'op_c')
			{
				$option_c_array[] = array(
					'qn_id'=>$key,
					'user_id'=>$user_id
				);
			}
			else
			{
				
				$option_d_array[] = array(
					'qn_id'=>$key,
					'user_id'=>$user_id
				);
			}
		}
		//echo"<pre>";print_r($option_a_array);die;
		if(!empty($option_a_array))
		{
			foreach ($option_a_array as $key => $value)
			{
				$data = array('qn_id'=>$value['qn_id'],'user_id'=>$user_id);
				$this->survey_model->insert_op_a($data);
				
			}
		}
		if(!empty($option_b_array))
		{
			foreach ($option_b_array as $key => $value)
			{
				$data = array('qn_id'=>$value['qn_id'],'user_id'=>$user_id);
				$this->survey_model->insert_op_b($data);
				
			}
		}
		if(!empty($option_c_array))
		{
			foreach ($option_c_array as $key => $value)
			{
				$data = array('qn_id'=>$value['qn_id'],'user_id'=>$user_id);
				$this->survey_model->insert_op_c($data);
				
			}
		}
		if(!empty($option_d_array))
		{
			foreach ($option_d_array as $key => $value)
			{
				$data = array('qn_id'=>$value['qn_id'],'user_id'=>$user_id);
				$this->survey_model->insert_op_d($data);
				
			}
		}

		$bool = $this->survey_model->update_survey_status($user_id);
		if($bool)
		{
			$this->report_page($user_id);
		}
		else
		{
			$this->session->set_flashdata('survey','Something Went Wrong');
		}
		redirect('survey/success_page');
		
	}
      /*  public function insert_second_survey_data()
	{
		$user_id = $this->session->userdata('user_id');
		$bool = $this->survey_model->check_if_data_already_submitted($user_id);
		if($bool)
		{
			$this->report_page($user_id);
		}
		else{
		     //echo"<pre>";print_r($_POST); die;
		$option_a_array = array();
		$option_b_array = array();
		$option_c_array = array();
		$option_d_array = array();
		foreach ($_POST as $key => $value) 
		{

			if($value == 'op_a')
			{
				$option_a_array[] = array(
					'qn_id'=>$key,
					'user_id'=>$user_id

				);


			}
			elseif($value == 'op_b')
			{
				$option_b_array[] = array(
					'qn_id'=>$key,
					'user_id'=>$user_id

				);
			}
			elseif($value == 'op_c')
			{
				$option_c_array[] = array(
					'qn_id'=>$key,
					'user_id'=>$user_id
				);
			}
			else
			{
				
				$option_d_array[] = array(
					'qn_id'=>$key,
					'user_id'=>$user_id
				);
			}
		}
		//echo"<pre>";print_r($option_a_array);die;
		if(!empty($option_a_array))
		{
			foreach ($option_a_array as $key => $value)
			{
				$data = array('qn_id'=>$value['qn_id'],'user_id'=>$user_id);
				$this->survey_model->insert_op_a($data);
				
			}
		}
		if(!empty($option_b_array))
		{
			foreach ($option_b_array as $key => $value)
			{
				$data = array('qn_id'=>$value['qn_id'],'user_id'=>$user_id);
				$this->survey_model->insert_op_b($data);
				
			}
		}
		if(!empty($option_c_array))
		{
			foreach ($option_c_array as $key => $value)
			{
				$data = array('qn_id'=>$value['qn_id'],'user_id'=>$user_id);
				$this->survey_model->insert_op_c($data);
				
			}
		}
		if(!empty($option_d_array))
		{
			foreach ($option_d_array as $key => $value)
			{
				$data = array('qn_id'=>$value['qn_id'],'user_id'=>$user_id);
				$this->survey_model->insert_op_d($data);
				
			}
		}

		$bool = $this->survey_model->update_survey_status($user_id);
		if($bool)
		{
			$this->report_page($user_id);
		}
		else
		{
			$this->session->set_flashdata('survey','Something Went Wrong');
		}
		redirect('survey/success_page');
	  }
		
		
		
		
		
		
	}*/


	public function report_page($user_id)
	{
		$this->session->set_flashdata('survet_completed',$user_id);

		$total_salary = $this->survey_model->check_salary_total_count($user_id);
		$username = $total_salary['first_name'];
		$this->session->set_flashdata('username',$username);
			//echo $user_id; 
		// echo $this->db->last_query(); die;
		 	//echo"<pre>";print_r($total_salary);die;

		$self_income = $total_salary['income'];
		//echo $self_income; die;
			 //echo "<br>";
		$wife_income = $total_salary['independent_wife'];
			   //echo "<br>";

		// $sibling_salary = 0;
		// foreach ($total_salary as $key => $value)
		// {
		// 	$sibling_salary+= $value['salary'];	
		// }
		$sibling_salary = $this->survey_model->get_sibling_income_if_any($user_id);
		//print_r($sibling_salary); die;
			//echo"sb" .(int)$sibling_salary;die;
		$total_income = $self_income + $wife_income + (int)$sibling_salary;
		//echo $total_income; die;
		$total_annual_income = $total_income*12;

		if($total_annual_income<=300000)
		{
			$this->session->set_flashdata('XXXX','2.67');
			$this->session->set_flashdata('ews','they are ews');
		}
		elseif($total_annual_income > 300000 && $total_annual_income <=600000)
		{
			$this->session->set_flashdata('XXXX','2.67');
			$this->session->set_flashdata('lig','they are lig');
		}
		elseif($total_annual_income > 600000 && $total_annual_income <=1200000)
		{
			$this->session->set_flashdata('XXXX','2.36');
			$this->session->set_flashdata('mig_1','they are mig_1');
		}
		elseif($total_annual_income >1200000 && $total_annual_income <=1800000)
		{
			$this->session->set_flashdata('XXXX','2.30');
			$this->session->set_flashdata('mig_2','they are mig_2');
		}
		else
		{
			$this->session->set_flashdata('XXXX','2.30');
			$this->session->set_flashdata('no_terms','do not show any terms and condition');
		}


		// to get details of the basick survey for report

		$basick_survey_row = $this->survey_model->get_basick_survey_details($user_id);
		//print_r($basick_survey_row); die;
		$town_id = $basick_survey_row['town_id'];
		$moza_id = $basick_survey_row['moza_id'];
		$pakka_house = $basick_survey_row['pakka_house'];
		$what_you_want = $basick_survey_row['what_you_want'];
		if(!empty($town_id))
		{

			$town_row = $this->survey_model->get_town_data($town_id);
			// check this town exist(status=1) in sheet or manually(status =2) added by user by its status
			$town_status = $town_row['status'];
			$notification = $town_row['notification'];
			if($town_status==1)
			{
				// the case when town exist in sheet status =1;
				$govt_list = $town_row['govt_list'];
				if($govt_list=='yes')
				{
					// exist in sheet and also in goverment list
					if($total_annual_income <=1800000)
					{
						if($total_annual_income <=600000)
						{
							if(!empty($pakka_house))
							{
								if($what_you_want==1 || $what_you_want==2)
								{
									// echo "2nd cause ";die('this 1');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('survey/report_view');
								}
								else
								{
									//echo "1nd cause ";die;
									$this->session->set_flashdata('first','this_is_1_cause');
									redirect('survey/report_view');
								}
							}
							else
							{
								// when pakka house is null or no choosen by user
								//echo "1nd cause ";die;
								$this->session->set_flashdata('first','this_is_1_cause');
								redirect('survey/report_view');
							}
						}
						else
						{
							//when salary is less than 18 lac but greter than 6 lac
							if(!empty($pakka_house))
							{
								// echo "2nd cause ";die('this 2');
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('survey/report_view');
							}
							else
							{
								// echo "1nd cause ";die;
								$this->session->set_flashdata('first','this_is_1_cause');
								redirect('survey/report_view');
							}
						}
					}
					else
					{
						// echo "2nd cause ";die('this 3');
						// when total annual income is greater then 18 lac
						$this->session->set_flashdata('second','this_is_2_cause');
						redirect('survey/report_view');

					}
				}
				else
				{
					//exist in sheet but not in goverment list
					if($notification=='yes')
					{
						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										// echo "2nd cause ";die('this 4');
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('survey/report_view');
									}
									else
									{
										// echo "3nd cause ";die;
										$this->session->set_flashdata('third','this_is_3_cause');
										redirect('survey/report_view');
									}
								}
								else
								{
									// echo "3d cause ";die;
									// when pakka house is null or no choosen by user
									$this->session->set_flashdata('third','this_is_3_cause');
									redirect('survey/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									// echo "2nd cause ";die('this 4');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('survey/report_view');
								}
								else
								{
									// echo "3nd cause ";die;
									$this->session->set_flashdata('third','this_is_3_cause');
									redirect('survey/report_view');
								}
							}
						}
						else
						{
						// when total annual income is greater then 18 lac
							// echo "2nd cause ";die('this 5');
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('survey/report_view');

						}
					}
					else
					{
						//pdf map word cause but its flow is as same as its if part

						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										// echo "2nd cause ";die('this 6');
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('survey/report_view');
									}
									else
									{
										//echo "3nd cause ";die('this 7');
										$this->session->set_flashdata('third','this_is_3_cause');
										redirect('survey/report_view');
									}
								}
								else
								{
									//echo "3nd cause ";die;
								// when pakka house is null or no choosen by user
									$this->session->set_flashdata('third','this_is_3_cause');
									redirect('survey/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									//echo "2nd cause ";die('this 8');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('survey/report_view');
								}
								else
								{
									//echo "3nd cause ";die;
									$this->session->set_flashdata('third','this_is_3_cause');
									redirect('survey/report_view');
								}
							}
						}
						else
						{
							//echo "3nd cause ";die;
						// when total annual income is greater then 18 lac
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('survey/report_view');
						}

					}


				}
			}
			else
			{
				if($total_annual_income <=1800000)
				{
					if($total_annual_income <=600000)
					{
						if(!empty($pakka_house))
						{
							if($what_you_want==1 || $what_you_want==2)
							{
								//echo "2nd cause ";die('this 9');
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('survey/report_view');
							}
							else
							{
									//echo $user_id;
									//echo $total_annual_income;
									//echo "2nd cause ";die('this 10');
								//in flow chart this is 2 or 4
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('survey/report_view');
							}
						}
						else
						{
								//echo "4nd cause ";die;
								// when pakka house is null or no choosen by user
								//ask to change location cause
							$this->session->set_flashdata('fourth','this_is_4_cause');
							redirect('survey/report_view');
						}
					}
					else
					{
							//when salary is less than 18 lac but greter than 6 lac
						if(!empty($pakka_house))
						{
							//echo "2nd cause ";die('this 11');
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('survey/report_view');
						}
						else
						{
							//ask to change location cause


							//echo "4nd cause ";die;	
							$this->session->set_flashdata('fourth','this_is_4_cause');
							redirect('survey/report_view');
						}
					}
				}
				else
				{
					// when total annual income is greater then 18 lac
						
					//echo "2nd cause ";die('this 12');
					$this->session->set_flashdata('second','this_is_2_cause');
					redirect('survey/report_view');
				}
				//the case when town is manually added status =2;
			}
			
		}//if not empty town id block ends here
		elseif (!empty($moza_id))
		{
			$moza_row = $this->survey_model->get_moza_data($moza_id);
			//$town_row = $this->survey_model->get_town_data($town_id);
			// check this town exist(status=1) in sheet or manually(status =2) added by user by its status
			$moza_status = $moza_row['status'];
			$notification = $moza_row['notification'];
			if($moza_status==1)
			{
				// the case when town exist in sheet status =1;
				$govt_list = $moza_row['govt_list'];
				if($govt_list=='yes')
				{
					// exist in sheet and also in goverment list
					if($total_annual_income <=1800000)
					{
						if($total_annual_income <=600000)
						{
							if(!empty($pakka_house))
							{
								if($what_you_want==1 || $what_you_want==2)
								{
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('survey/report_view');
								}
								else
								{
									$this->session->set_flashdata('first','this_is_1_cause');
									redirect('survey/report_view');
								}
							}
							else
							{
								// when pakka house is null or no choosen by user
								$this->session->set_flashdata('first','this_is_1_cause');
								redirect('survey/report_view');
							}
						}
						else
						{
							//when salary is less than 18 lac but greter than 6 lac
							if(!empty($pakka_house))
							{
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('survey/report_view');
							}
							else
							{
								$this->session->set_flashdata('first','this_is_1_cause');
								redirect('survey/report_view');
							}
						}
					}
					else
					{
						// when total annual income is greater then 18 lac
						$this->session->set_flashdata('second','this_is_2_cause');
						redirect('survey/report_view');

					}
				}
				else
				{
					//exist in sheet but not in goverment list
					if($notification=='yes')
					{
						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('survey/report_view');
									}
									else
									{
										$this->session->set_flashdata('third','this_is_3_cause');
										redirect('survey/report_view');
									}
								}
								else
								{
								// when pakka house is null or no choosen by user
									$this->session->set_flashdata('third','this_is_3_cause');
									redirect('survey/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('survey/report_view');
								}
								else
								{
									$this->session->set_flashdata('third','this_is_3_cause');
									redirect('survey/report_view');
								}
							}
						}
						else
						{
						// when total annual income is greater then 18 lac
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('survey/report_view');

						}
					}
					else
					{
						//pdf map word cause but its flow is as same as its if part

						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('survey/report_view');
									}
									else
									{
										$this->session->set_flashdata('third','this_is_3_cause');
										redirect('survey/report_view');
									}
								}
								else
								{
								// when pakka house is null or no choosen by user
									$this->session->set_flashdata('third','this_is_3_cause');
									redirect('survey/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('survey/report_view');
								}
								else
								{
									$this->session->set_flashdata('third','this_is_3_cause');
									redirect('survey/report_view');
								}
							}
						}
						else
						{
						// when total annual income is greater then 18 lac
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('survey/report_view');
						}

					}


				}
			}
			else
			{

				if($total_annual_income <=1800000)
				{
					if($total_annual_income <=600000)
					{
						if(!empty($pakka_house))
						{
							if($what_you_want==1 || $what_you_want==2)
							{
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('survey/report_view');
							}
							else
							{
								//in flow chart this is 2 or 4
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('survey/report_view');
							}
						}
						else
						{

								// when pakka house is null or no choosen by user
								//ask to change location cause
							$this->session->set_flashdata('fourth','this_is_4_cause');
							redirect('survey/report_view');
						}
					}
					else
					{
							//when salary is less than 18 lac but greter than 6 lac
						if(!empty($pakka_house))
						{
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('survey/report_view');
						}
						else
						{
							//ask to change location cause



							$this->session->set_flashdata('fourth','this_is_4_cause');
							redirect('survey/report_view');
						}
					}
				}
				else
				{
						// when total annual income is greater then 18 lac
					$this->session->set_flashdata('second','this_is_2_cause');
					redirect('survey/report_view');
				}
				//the case when town is manually added status =2;
			}
		}
		else
		{
			echo"Error...!both moza and town does not exist";die;
		}
		// if(($total_income*12) > 1800000)
		// 	//if('10000' == '1800000')
		// {
		// 		//echo "asdfa".$total_income; die;
		// 	$this->session->set_flashdata('eligible','You are not elligible for the survey');
		// 		//$data['eligible'] = "YOU ARE NOT ELIGIBLE FOR THE SURVEY ";
		// }
		// 	//echo "jbh"; die;
		// $this->session->set_flashdata('survey','Your Survey Is Completed Succesfully');
	}
	public function success_page()
	{
		$data['msg']='Your Survey Is Completed ';
		$data['page'] = 'success';
		_layout($data);
	}
	public function report_view()
	{
		$user_id = $this->session->flashdata('survet_completed');
		if($this->session->flashdata('first'))
		{
			$this->survey_model->insert_case_number(1,$user_id);
		}
		elseif($this->session->flashdata('second'))
		{
			$this->survey_model->insert_case_number(2,$user_id);
		}
		elseif($this->session->flashdata('third'))
		{
			$this->survey_model->insert_case_number(3,$user_id);
		}
		elseif($this->session->flashdata('fourth'))
		{
			$this->survey_model->insert_case_number(4,$user_id);
		}
		$data['page'] = 'report_page';
		_layout($data);
	}
	public function town_data()
	{

		$state_id = $this->input->post('state_id');
		//$state_id = 1;
		$city_id = $this->input->post('city_id');
		//$city_id = 2;
		$town =$this->input->post('town');

		//echo strtolower($town);
		$town_name = ucfirst(strtolower($town));
		$row = $this->survey_model->check_town_already_exist($town_name);
		if($row)
		{
			$output = array(
				'flag'=>5,
			);
			echo json_encode($output);
		}
		else
		{

			//$town ='test';
			if(!empty($state_id) || !empty($city_id) || !empty($town))
			{
				$data = array(
					'name'=>$town_name,
					'city_id'=>$city_id,
					'state_id'=>$state_id,
					'status'=>2,
				);
				$insert_id = $this->survey_model->insert_town_data($data);
				$town_option='';
				if($insert_id)
				{
					$town_option.='
					<option value="'.$insert_id.'"  selected>'.$town_name.'</option>';
					$output = array(
						'option'=>$insert_id,
						'name'=>$town

					);
					echo json_encode($output);
				}
			}
			//print_r($_POST);die;
		}
	}
	public function moza_data()
	{

		$ncity_id = $this->input->post('ncity_id');
		//$city_id = 2;
		$moza_name =$this->input->post('moza_name');

		//echo strtolower($town);
		$moza_name = ucfirst(strtolower($moza_name));
		$row = $this->survey_model->check_moza_already_exist($moza_name);
		if($row)
		{
			$output = array(
				'flag'=>5,
			);
			echo json_encode($output);
		}
		else
		{

			//$town ='test';
			if(!empty($ncity_id) || !empty($moza_name))
			{
				$data = array(
					'name'=>$moza_name,
					'ncity_id'=>$ncity_id,
					'status'=>2,
				);
				$insert_id = $this->survey_model->insert_moza_data($data);
				// $town_option='';
				// if($insert_id)
				// {
				// 	$town_option.='
			 // 			<option value="'.$insert_id.'"  selected>'.$town_name.'</option>';
				// 	$output = array(
				// 		'option'=>$town_option,
				// 		'name'=>$town

				// 	);
				// 	echo json_encode($output);
				// }
				$output = array
				(
					'moza_id'=>$insert_id,
					'ncity_id'=>$ncity_id
				);
				echo json_encode($output);
			}
			//print_r($_POST);die;
		}
	}
	public function get_nearest_city()
	{
		$state_id = $this->input->post('id');
		if($state_id == 29)
		{
			$state_name = '<option disabled selected>Odisha</option>';
		}
		else
		{
			$state_name = '<option disabled selected>West Bengal</option>';
		}
		$ncity_array = $this->survey_model->get_nearest_city_for_popup($state_id);

		$output='';
		foreach ($ncity_array as $key => $value) {

			$output.="


			<option value='".$value['id']."'>".$value['name']."</option>";
		}
		//print_r($output);
		$data=array(
			'option'=>$output,
			'sname'=>$state_name
		);
		echo json_encode($data);
	}

	public function get_moza()
	{
		$ncity_id = $this->input->post('id');
		$moza_array = $this->survey_model->get_moza_by_nearser_city_id($ncity_id);
		$output='';
		foreach ($moza_array as $key => $value) {

			$output.="


			<option value='".$value['id']."'>".$value['name']."</option>";
		}
		$output.="<option value='moza_others'>Others</option>";
		//print_r($output);
		$data=array(
			'option'=>$output,
			//'sname'=>$state_name
		);
		echo json_encode($data);
	}
	public function get_town_names()
	{
		$alphabets = $this->input->post('town_alphbets');
		$city_id = $this->input->post('city_id');
		 // $city_id = 42;
		 // $alphabets='go';
		$result = $this->survey_model->get_town_names($alphabets,$city_id);
		 // 	echo $this->db->last_query(); die;
		$output ='';
		foreach ($result as $key => $value)
		{
			$output.="
			<span id=".$value['id']."  onclick=get_this_name(this.id); class='forhover'>".$value['name']."
			</span>";

			
		}
		$output .="<span id='others'  onclick=get_this_name(this.id); class='forhover'>Others(Fill your town name)
			</span>";
			$response = array(
				'span_html'=>$output,
				'db_result'=>$result
			); 
		echo  json_encode($response);
	}
	public function get_town_name_for_field()
	{
		$town_id = $this->input->post('id');
		// $town_id=1;

		$row = $this->survey_model->town_for_field($town_id);
		$output = array(
			"id"=>$row['id'],
			"name"=>$row['name']

		);
		echo json_encode($output);
	}
	
	public function check_town_name_exist_or_not()
	{
		$town_name = $this->input->post('town_name');
		$city_id = $this->input->post('city_id');
		$row = $this->survey_model->check_town_exist($town_name,$city_id);
		// echo $this->db->last_query(); die;
		if(!empty($row))
		{
			echo json_encode($row);
		}
		else
		{
			echo json_encode('0');
		}
	}
}
