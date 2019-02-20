<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('home_model');
	}
	public function index()
	{

		
		 // echo $this->session->userdata('page_lang'); 
		if($this->session->tempdata('survet_completed'))
		{
			redirect(base_url('pdf_report/landing_page'));
		}
		else
		{
			if($this->session->userdata('is_authenticated'))
			{

				$phone_number = $this->session->userdata('phone_number');
				if($phone_number)
				{
					$row = $this->home_model->check_phone_number($phone_number);
					if($row)
					{
						$row = $this->home_model->check_survey_status($phone_number,$row['id']);
						$survey_status = $row['survey_status'];
						if((int) $survey_status == 5)
						{
							$this->session->set_tempdata('user_id',$row['id'],3000);
							$this->session->set_tempdata('first_name', $row['first_name'],3000);
							redirect('pdf_report/landing_page');
						}
						
						else
						{
							
							$basick_survey_row = $this->home_model->check_basick_survey($row['id']);
							$basick_complete_status = $basick_survey_row['is_completed'];

							if((int)$basick_complete_status == 2)
							{

								$this->session->set_tempdata('user_id',$row['id'],3000);
								$this->session->set_tempdata('first_name', $row['first_name'],3000);
								redirect('survey/second_survey');
							}
							else
							{ 
								//echo"<script>alert('here')<script/>";die;
								$this->session->set_tempdata('user_id', $row['id'],3000);
								$this->session->set_tempdata('first_name', $row['first_name'],3000);
								//$this->session->set_userdata('user_id',$insert_id);
								redirect('survey');
							}
						}
					}
					else
					{
							$data['page']='home_view';
							_layout($data);	
					}

				}
				else
				{

					
					
						$data['page']='home_view';
						_layout($data);
						
					
				}
			}
			else
			{
				
					//echo $this->session->userdata('lang'); die;
						
					$data['page']='home_view';
					_layout($data);
					
				

			}

		}
	}
	public function send_otp_to_mobile()
	{
		$this->session->unset_userdata('otp');
		$phone_number = $this->input->post('phone_number');
		
		$this->session->set_userdata('phone_number',$phone_number);
		echo $phone_number;
		// $curl = curl_init();
		// $random_otp = rand(1234,5678);
		// $this->session->set_userdata('otp',$random_otp);
		// $message ="Use ".$random_otp. " as OTP to verify your mobile number with Wealthtree";
		// curl_setopt_array($curl, array(
		// //CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?authkey='223476ACc6mYfF5b585094'&message='".$message."'&sender='Menoss'&mobile='".$mobile_no."'&otp=$random_otp",
		// CURLOPT_URL =>"http://control.msg91.com/api/sendotp.php?authkey=239403An18Qs255baa2af1&message=$message&sender=pmawas&mobile=$phone_number&otp=$random_otp",
		// CURLOPT_RETURNTRANSFER => true,
		// CURLOPT_ENCODING => "",
		// CURLOPT_MAXREDIRS => 10,
		// CURLOPT_TIMEOUT => 30,
		// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// CURLOPT_CUSTOMREQUEST => "POST",
		// CURLOPT_POSTFIELDS => "",
		// CURLOPT_SSL_VERIFYHOST => 0,
		// CURLOPT_SSL_VERIFYPEER => 0,
		// ));
		// $response = curl_exec($curl);
		// // echo $response;die;
		// $err = curl_error($curl);

		// curl_close($curl);

		// if ($err) {
		// echo "cURL Error #:" . $err;
		// } 
	}
	public function validate_otp()
	{
		$otp = $this->session->userdata('otp');
		 $otp=1234;
		$first_digit = $this->input->post('digit1');
		$second_digit = $this->input->post('digit2');
		$third_digit = $this->input->post('digit3');
		$fourth_digit = $this->input->post('digit4');
		$otp_entered = "".$first_digit.""+"".$second_digit.""+"".$third_digit.""+"".$fourth_digit."";
		// echo $otp_entered;
		// echo"<br>";
		// echo $otp;
		// die;
		if($otp ==1234)
		{
			$this->session->set_userdata('is_authenticated',1);
			if($this->input->get('second_popup'))
			{
				$this->session->set_flashdata('subsidy_ent','know your subsidy Entitlements First');
			}
			redirect('home/after_validation');
		}
		else
		{	$this->session->unset_userdata('otp');
			$this->session->set_flashdata('Invalid_otp','YOU ENTERED A INVALID OTP');
		}
		redirect(base_url());
	}
	public function after_validation()
	{
		// echo"there"; die;

		$phone_number = $this->session->userdata('phone_number');
		$row = $this->home_model->check_phone_number($phone_number);
		if($row)
		{
			$row = $this->home_model->check_survey_status($phone_number,$row['id']);
			$survey_status = $row['survey_status'];
			if((int) $survey_status == 5)
			{
				$this->session->set_tempdata('user_id',$row['id'],3000);
				$this->session->set_tempdata('first_name', $row['first_name'],3000);
				redirect('pdf_report/landing_page');
			}
			// elseif((int)$survey_status >= 0 && (int)$survey_status < 3 )
			// {
			else
			{
				if($this->session->flashdata('subsidy_ent'))
				{
					echo"<script>alert('know your Subsidy Entitlements first')";
				}
				$basick_survey_row = $this->home_model->check_basick_survey($row['id']);
				$basick_complete_status = $basick_survey_row['is_completed'];

				if((int)$basick_complete_status == 2)
				{
					$this->session->set_tempdata('user_id',$row['id'],3000);
					$this->session->set_tempdata('first_name', $row['first_name'],3000);
					redirect('survey/second_survey');
				}
				else
				{ 
					//echo"<script>alert('here')<script/>";die;

					$this->session->set_tempdata('user_id', $row['id'],3000);
					$this->session->set_tempdata('first_name', $row['first_name'],3000);
					//$this->session->set_userdata('user_id',$insert_id);
					redirect('survey');
				}
			}
		}
		else
		{
			if($this->session->flashdata('subsidy_ent'))
			{
				$this->session->unset_userdata('first_name');
				echo"<script>alert('know your Subsidy Entitlements first');
				window.location.href='home/insert_basick_detail'
				</script>";
			}
			else
			{
				$this->session->unset_userdata('first_name');
				redirect('home/insert_basick_detail');
			}
			//echo"hello";die;
			// $org_array = $this->home_model->get_organisations();
			// $data['organisations'] = $org_array;
			// $data['page'] = 'organisation';
			// _layout($data);
		}

	}
	public function check_pan_phone_existence()
	{
		$phone_number = $this->input->post('phone_no');
		$pan_number = $this->input->post('pan_no');

		$row = $this->home_model->check_pan_phone($phone_number,$pan_number);
		if($row)
		{
			 $row = $this->home_model->check_survey_status_with_pan_phone($phone_number,$pan_number);
			 $survey_status = $row['survey_status'];
			if((int) $survey_status == 5)
			{
				$data['msg'] = 'Your Survey Is Already Completed';
			 	$data['page'] = 'success';
				_layout($data);
			}
			elseif((int)$survey_status >= 0 && (int)$survey_status < 3 )
			{
				//echo"<script>alert('o to 4')</script>>";
				$basick_survey_row = $this->home_model->check_basick_survey($row['id']);
				$basick_complete_status = $basick_survey_row['is_completed'];

				if((int)$basick_complete_status == 2)
				{
					$this->session->set_tempdata('user_id',$row['id'],3000);
					$this->session->set_tempdata('first_name', $row['first_name'],3000);
					redirect('survey/second_survey');
				}
				else
				{ 

					$this->session->set_tempdata('user_id',$row['id'],3000);
					$this->session->set_tempdata('first_name', $row['first_name'],3000);
					//$this->session->set_userdata('user_id',$insert_id);
					redirect('survey');

					// $org_array = $this->home_model->get_organisations();
					// $data['organisations'] = $org_array;
					// $data['page'] = 'organisation';
					// _layout($data);
				}
			}
			else
			{
				$data['msg'] = 'Exceed Attempt Limit, Contact To Support Center';
			 	$data['page'] = 'success';
				_layout($data);
			}
		}
		else
		{
			redirect('home/insert_basick_detail');
		}

	}
	public function insert_basick_detail()
	{

		//code to update data
		if($this->input->post('hidden_id'))
		{
			//print_r($_POST); die;
			$id = $this->input->post('hidden_id');
			$phone_number_2 = $this->session->userdata('phone_number');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email = $this->input->post('email');
			$pan_number = $this->input->post('pan_number');
			$dob = $this->input->post('dob');
			// $gender = $this->input->post('gender');
			$working = $this->input->post('working');
			$income = $this->input->post('income');
			$middle_name = $this->input->post('middle_name');
			//$income = $this->input->post('income');
			$org = $this->input->post('org');
			$psu = $this->input->post('psu');
			$date = str_replace('/', '-', $dob);
			$dob_date =  date('Y-m-d', strtotime($date)); 
			//echo $dob_date; die;
			$data = array(
			'first_name'=>$first_name,
			'last_name'=>$last_name,
			'email'=>$email,
			'dob'=>$dob_date,
			'phone_number_2'=>$phone_number_2,
			'gender'=>$gender,
			'working'=>$working,
			'income'=>$income,
			'org'=>$org,
			'psu'=>$psu,
			'pan_number'=>$pan_number,
			'user_type'=>'website',
			'middle_name'=>$middle_name
			);
			$bool = $this->home_model->update_basic_data($data,$id);
			if($bool)
			{
				$user_row = $this->home_model->is_survey_completed($id);
				$complete_status = $user_row['survey_status'];
				if($complete_status == 5)
				{
					$this->session->set_tempdata('user_id',$id,3000);
					$this->session->set_tempdata('first_name',$first_name,3000);
					redirect('pdf_report/landing_page');
				}
				else
				{
					$basick_survey_row = $this->home_model->check_basick_survey($id);
					$basick_complete_status = $basick_survey_row['is_completed'];

					if((int)$basick_complete_status == 2)
					{
						$this->session->set_tempdata('user_id',$id,3000);
						$this->session->set_tempdata('first_name', $user_row['first_name'],3000);
						redirect('survey/second_survey');
					}
					else
					{ 
					//echo"<script>alert('here')<script/>";die;

						$this->session->set_tempdata('user_id', $id,3000);
						$this->session->set_tempdata('first_name', $user_row['first_name'],3000);
						//$this->session->set_userdata('user_id',$insert_id);
						redirect('survey');
					}

				}
					//here
					// $this->session->set_tempdata('user_id', $id,3000);
					// $this->session->set_tempdata('first_name', $first_name,3000);
					// //$this->session->set_userdata('user_id',$insert_id);
					// redirect('survey');
			}
			else
			{
				$this->sesssion->set_flashdata('basick_error','Error In Insertion');
			}
		}// code to update data end here
		//code to insert data
		else
		{
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			//$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
			$this->form_validation->set_rules('pan_number', 'Pan Number', 'required');
			//$this->form_validation->set_rules('gender', 'Gender', 'required');
			//$this->form_validation->set_rules('working', 'Working', 'required');
			$this->form_validation->set_rules('income', 'Income', 'required');
			//$this->form_validation->set_rules('org', 'Organisation', 'required');
			//$this->form_validation->set_rules('psu', 'PSU', 'required');
			if ($this->form_validation->run() == TRUE)
			{ 
				$phone_number = $this->session->userdata('phone_number');
				$first_name = $this->input->post('first_name');
				$last_name = $this->input->post('last_name');
				$email = $this->input->post('email');
				$pan_number = $this->input->post('pan_number');
				$dob = $this->input->post('dob');
				$gender = $this->input->post('gender');
				$working = $this->input->post('working');
				$income = $this->input->post('income');
				$middle_name = $this->input->post('middle_name');
				//$income = $this->input->post('income');
				$org = $this->input->post('org');
				$psu = $this->input->post('psu');
				$date = str_replace('/', '-', $dob);
				$dob_date =  date('Y-m-d', strtotime($date)); 
				//echo $dob_date; die;
				$data = array(
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'email'=>$email,
				'dob'=>$dob_date,
				'phone_number'=>$phone_number,
				'gender'=>$gender,
				'working'=>$working,
				'income'=>$income,
				'org'=>$org,
				'psu'=>$psu,
				'pan_number'=>$pan_number,
				'user_type'=>'website',
				'middle_name'=>$middle_name
				);
				$insert_id = $this->home_model->insert_basic_data($data);
				if($insert_id)
				{
					$this->session->set_tempdata('user_id', $insert_id,3000);
					//$this->session->set_userdata('user_id',$insert_id);
					$this->session->set_tempdata('first_name',$first_name,3000);
					redirect('survey');
				}
				else{
					$this->sesssion->set_flashdata('basick_error','Error In Insertion');
				}

			} 
		}	
		$org_array = $this->home_model->get_organisations();
		$sector_array = $this->home_model->get_org_sectors(); 
		$data['organisation_for_basick_details']=$org_array;
		$data['sectors'] = $sector_array;
		$data['page']='basick_detail';
		_layout($data);
	}


	public function get_data_if_pan_exist()
	{
		$pan_number = $this->input->post('pan_number');
		$row = $this->home_model->data_if_pan_exist($pan_number);
		if($row)
		{
			echo json_encode($row);
		}
		else
		{
			echo json_encode(1);
		}
	}



	public function open_calc()
	{
		$user_id = $this->session->tempdata('user_id');
		if($user_id)
		{
			$total_salary = $this->home_model->get_total_income($user_id);
			//echo $user_id; 
			//echo"<pre>";print_r($total_salary);
			 $self_income = $total_salary[0]['income'];
			 //echo "<br>";
			    $wife_income = $total_salary[0]['independent_wife'];
			   //echo "<br>";

			$sibling_salary = 0;
			foreach ($total_salary as $key => $value)
			{
				$sibling_salary+= $value['salary'];	
			}
			//echo"sb" .$sibling_salary;
			$total_income = $self_income + $wife_income + $sibling_salary;
			$data['total_income'] = $total_income;
		}
		$data['page']='calc';
		_layout($data);
	}
	public function calculate()
	{
		error_reporting(E_ERROR | E_PARSE);
		//echo json_encode('200');
		$loan_amount = $this->input->post('loan_amount');
		$tenure = $this->input->post('tenure');
		$income = $this->input->post('income');
		$income = $income*12;

		// $loan_amount =2000000;
		// $tenure = 21;
		// $income = 123213123;

		// $output = array(
		// 	'loan_amount'=>$loan_amount,
		// 	'tenure'=>$tenure,
		// 	'income'=>$income);
		// echo json_encode($output);
		//$subsidyinterest = 0;
		if($income<=600000)
		{
			$subsidyinterest=6.5;
		}
		else if($income > 600000 && $income<= 1200000)
		{
			$subsidyinterest=4;
		}
		else if($income > 1200000 && $income<= 1800000)
		{
			$subsidyinterest=3;
		}
		else
		{
			$subsidyinterest=0;
		}
		//echo $subsidyinterest;
		$r = $subsidyinterest/(12*100);
		// echo"<br>";
		// echo $r;

		$subsidy = 0;
		if($loan_amount>600000 && $subsidyinterest==6.5){
			$loanbalance=600000;
		}
		else if($loan_amount>900000 && $subsidyinterest==4){
			$loanbalance=900000;
		}
		else if($loan_amount>1200000 && $subsidyinterest==3){
			$loanbalance=1200000;
		}
		else
		{
			$loanbalance = $loan_amount;
		}

		if($tenure<=20){
		 $EMIS = $loanbalance*$r*pow((1+$r),($tenure*12))/((pow((1+$r),($tenure*12)))-1);
		}
		else
		{
			$EMIS = $loanbalance*$r*pow((1+$r),(20*12))/((pow((1+$r),(20*12)))-1);
		}

		if($tenure<=20 && $income<1800001)
		{
			for($i=1;$i<=($tenure*12);$i++)
			{
				$interestcomp=$loanbalance*$r;
				$principlecomp=$EMIS-$interestcomp;
				$loanbalance=$loanbalance-$principlecomp;
				$netpresentvalue=$interestcomp/pow(1.0075,$i);
				$subsidy=$subsidy+$netpresentvalue;
			}

		}

		if($tenure>20 && $income<1800001){
			for($i=1;$i<=(20*12);$i++)
			{
				$interestcomp=$loanbalance*$r;
				$principlecomp=$EMIS-$interestcomp;
				$loanbalance=$loanbalance-$principlecomp;
				$netpresentvalue=$interestcomp/pow(1.0075,$i);
				$subsidy=$subsidy+$netpresentvalue;

			} 
		}
		//echo $subsidy;
		$bankinterestrate=13;
		$rbank= $bankinterestrate/(12*100);
		$EMI= ($loan_amount-$subsidy)*$rbank*pow((1+$rbank),($tenure*12))/((pow((1+$rbank),($tenure*12)))-1);
		//this is pmay scheme emi

		//echo "<br>";
		//echo $EMI;
		$EMIBank= $loan_amount*$rbank*pow((1+$rbank),($tenure*12))/((pow((1+$rbank),($tenure*12)))-1);
		$pmay_in_t_year = $EMI*$tenure*12;
		$without_pmay_in_t_year = $EMIBank*$tenure*12;
		$total_saving = $without_pmay_in_t_year-$pmay_in_t_year;


		// for percentage
		$both_emis_dif = $EMIBank-$EMI;
		$percentage = $both_emis_dif/$EMIBank*100;


		//echo $EMIBank;
		$output = array(
			'subsidy'=>(int)$subsidy,
			'emi'=>(int)$EMI,
			'EMIBank'=>(int)$EMIBank,
			'pmay_in_t_year'=>(int)$pmay_in_t_year,
			'without_pmay_in_t_year'=>(int)$without_pmay_in_t_year,
			'percentage'=>(int)$percentage,
			'total_saving'=>(int)$total_saving);
		echo json_encode($output);
	}
	public function aboutus()
	{

		$data['page']='aboutus';
		_layout($data);
	}
	public function faq()
	{
		if($this->session->tempdata('user_id'))
		{
				$user_id = $this->session->tempdata('user_id');
				$row = $this->home_model->get_survey_status_by_user_id($user_id);
				$survey_status = $row['survey_status'];
				if($survey_status==5)
				{
					if($this->session->userdata('page_lang')=='page_hin')
					{
						$lang = 'hindi';
					}
					else
					{
						$lang = 'english';
					}
					$faq_content = $this->home_model->get_faq_page_content($lang);
					
					$arr = [];
					foreach ($faq_content as $key => $value) {
						//echo"<pre>";print_r($value);die;
						$arr[$value['tab_id']][$key]['qes_id'] = $value['qes_id'];
						$arr[$value['tab_id']][$key]['qes_name'] = $value['qes_name'];
						$arr[$value['tab_id']][$key]['ans_name'] = $value['ans_name'];
						$arr[$value['tab_id']][$key]['ans_id'] = $value['ans_id'];
					}
					// echo"<pre>";print_r($arr);die;
					// $each_tab_array = array_column($faq_content, 'tab_id');
					//  $each_tab_id = array_unique($each_tab_array);
					// $question_ans =  $this->home_model->get_question_answer_by_tab_id($each_tab_id);
					// echo"<pre>";print_r($question_ans);die;
					// foreach ($faq_content as $key => $value)
					// {
					// 	foreach ($value['tab_id'] as $key => $value)
					// 	{
							
					// 	}
						
					// }

					$tabs = $this->home_model->get_tab($lang);
					$data['tabs'] = $tabs;
					$data['content'] = $arr;
					$data['page']='faq';
					_layout($data);
				}
				else
				{
					// echo "hello"; die;
					if($this->session->userdata('page_lang')=='page_hin')
					{
						echo ("<script LANGUAGE='JavaScript'>
						window.alert('आपको  FAQs तक पहुँचने से पहले अपने PMAY CLSS (U) पात्रता को जानना होगा');
						window.location.href='home';
						</script>");
					}
					else
					{

						echo ("<script LANGUAGE='JavaScript'>
						window.alert('You need to know your PMAY CLSS(U) eligibility first before accessing its FAQ’s');
						window.location.href='home';
						</script>");
					}

					// 	echo $this->session->set_flashdata('faq_english',' You need to know your PMAY CLSS(U) eligibility first before accessing its FAQ’s');
					// 	redirect('home');
					// }
					// redirect(base_url_custom);
				}
		}
		else
		{
			if($this->session->userdata('page_lang')=='page_hin')
			{
				$this->session->set_flashdata('faq_hindi','आपको  FAQs तक पहुँचने से पहले अपने PMAY CLSS (U) पात्रता को जानना होगा');
				redirect('home');

			}
			else
			{

				echo $this->session->set_flashdata('faq_english',' You need to know your PMAY CLSS(U) eligibility first before accessing its FAQ’s');
				redirect('home');
			}
		}

		
	}
	
	public function contact_us()
	{

		if($this->input->get('u_id'))
		{
			$user_id = $this->input->get('u_id');
			$user_row = $this->home_model->get_user_data($user_id);
			$data['user_info'] = $user_row;
		}
		$data['page']='contact_us';
		_layout($data);
	}
	public function scheme()
	{

		$data['page']='scheme';
		_layout($data);
	}
	public function send_mail()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$message = $this->input->post('message');
		$reciever = 'vicky@ripenapps.com';

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
		$this->email->from($email, 'Alexa');
		$this->email->to($reciever);
		$this->email->subject('User Inquiry');
		// $message = "click on the link below to reset your password";
		// $message .=  "<br>";
		// $message .="<a href = ".base_url()."admin/confirm_password?id=$id>Link</a>";
		$this->email->message($message);  
		if($this->email->send())
		{
		//echo "<script>alert('Email Sent Succesfully')</script></>";
			$this->session->set_flashdata('email','Email Sent Succcesfully');

		}
		else{
			$this->session->set_flashdata('email','Error While Sending Email');

			//echo "<script>alert('Error in Sending Email')</script></>";
		}
		redirect('home/contact_us');
	}
	public function get_questions()
	{
		$name = $this->input->post('name');
		if(!empty($name))
		{
			$questions = $this->home_model->get_like_question($name);	
			$output='';
			if(!empty($questions))
			{
				foreach ($questions as $key => $value)
				{
					$output.='<span onclick="get_it_answer(this.id);" id="'.$value['id'].'_'.$value['tab_id'].'">'.$value['name'].'</span><br><br>';
					$output.='<span onclick="get_it_answer(this.id);" id="'.$value['id'].'_'.$value['tab_id'].'">'.$value['answer'].'</span><br><br>';
					//id=qnId_tabId
				}
			}
			else
			{
				$output='';
				$output.='<span>NO Record Found</span>';
			}
		}
		else
		{
			$output='';
			$output.='<span>NO Record Found</span>';
		}

		echo json_encode($output);
	}

	public function insert_query()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$query = $this->input->post('message');

		$data=array
		(
			'name'=>$name,
			'email'=>$email,
			'phone_number'=>$phone,
			'query'=>$query,
			'generated_on'=>date('y-m-d')

		);
		$insert_id = $this->home_model->insert_query($data);
		if($insert_id)
		{
			$this->session->set_flashdata('query','Your query is submitted succesfully');
		}
		else
		{
			$this->session->set_flashdata('query','Your query is not  submitted,Try Again Later');
		}
		redirect('home/contact_us');
	}

	public function generte_session()
	{
		$langg = $this->input->post('language');
		if($langg=='hin')
		{
			$this->session->set_userdata('page_lang','page_hin');
		}
		else
		{
			$this->session->set_userdata('page_lang','page_eng');

		}
		echo  json_encode(1);
	}
}
