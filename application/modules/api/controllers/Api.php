<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require(APPPATH.'/libraries/REST_Controller.php');


class Api extends MY_Controller
{
   
	function __construct()
    {
        parent::__construct();
		$this->load->model('api_model');
		$this->load->model('responseconstant');
		$postData =  file_get_contents('php://input');
       
		$postDataArray = json_decode($postData);
       	if(!empty($postDataArray->method))
       	{           
            $method = $postDataArray->method;
            if(!empty($postDataArray->app_key))
            {
                 $checkAppKey = $this->checkAppKey($postDataArray->app_key);
                if (!$checkAppKey)
                {
                    $Code = ResponseConstant::UNSUCESS;
                    $rescode = ResponseConstant::HEADER_UNAUTHORIZED;
                    $Message = ResponseConstant::message('HEADER_UNAUTHORIZED');
                    $this->sendResponse($Code,$rescode,$Message); //return data                                 
                }
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::APPKEY_NOT_FOUND;
                $Message = ResponseConstant::message('APPKEY_NOT_FOUND');
                $this->sendResponse($Code,$Message); // return data    
            }
        }
        else
        { 
            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::METHOD_NOT_FOUND;
            $Message = ResponseConstant::message('METHOD_NOT_FOUND');
            $this->sendResponse($Code,$Message); // return data      
        }
        switch($method)
        { 
            case 'generate_otp':
            $this->generate_otp($postDataArray);
            break;
            case 'survey_status':
            $this->survey_status($postDataArray);
            break;
            case 'is_pan_exist':
            $this->is_pan_exist($postDataArray);
            break;
             case 'insert_basic_details':
            $this->insert_basic_details($postDataArray);
            break;
             case 'state_list':
            $this->state_list($postDataArray);
            break;
            case 'district_list':
            $this->district_list($postDataArray);
            break;
            case 'town_list':
            $this->town_list($postDataArray);
            break;
            case 'nearest_city_list':
            $this->nearest_city_list($postDataArray);
            break;
            case 'get_moza':
            $this->get_moza($postDataArray);
            break;
            case 'add_town':
            $this->add_town($postDataArray);
            break;
            case 'add_moza':
            $this->add_moza($postDataArray);
            break;
            case 'first_survey_data':
            $this->first_survey_data($postDataArray);
            break;
            case 'get_que_ans':
            $this->get_que_ans($postDataArray);
            break;
            case 'second_survey_data':
            $this->second_survey_data($postDataArray);
            break;
            case 'get_organisation':
            $this->get_organisation($postDataArray);
            break;
            case 'get_psu':
            $this->get_psu($postDataArray);
            break;
            case 'calculate_subsidy':
            $this->calculate_subsidy($postDataArray);
            break;
            case 'insert_query':
            $this->insert_query($postDataArray);
            break;
            case 'faq':
            $this->faq($postDataArray);
            break;
            case 'get_case_number_and_salary':
            $this->get_case_number_and_salary($postDataArray);
            break;
            case 'pdf_data':
            $this->pdf_data($postDataArray);
            break;
            case 'to_insert_case_number':
            $this->to_insert_case_number($postDataArray);
            break;
            case 'contact_page_data':
            $this->contact_page_data($postDataArray);
            break;

            // case 'get_id_by_number':
            // $this->get_id_by_number($postDataArray);
            // break;
        }
    }
    public function generate_otp($postDataArray)
    {
    	$phone_number = (isset($postDataArray->phone_number) && !empty($postDataArray->phone_number)) ? $postDataArray->phone_number: '';

		if(empty($phone_number))
		{

			$Code = ResponseConstant::UNSUCCESS;
			$rescode = ResponseConstant::UNSUCCESS;
			$Message = ResponseConstant::message('REQUIRED_PARAMETER');
			$this->sendResponse($Code,$rescode,$Message);
		}
		else
		{
           // echo $phone_number; die;
            // $curl = curl_init();
            // $random_otp = rand(1234,5678);
            // $this->session->set_userdata('otp',$random_otp);
            // $message ="Use ".$random_otp. " as OTP to verify your mobile number with Wealthtree";
            // curl_setopt_array($curl, array(
            // CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?authkey='223476ACc6mYfF5b585094'&message='".$message."'&sender='Menoss'&mobile='".$phone_number."'&otp=$random_otp",
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
            //$response = curl_exec($curl);
            // echo $response;die;
            //$err = curl_error($curl);
            //curl_close($curl);

            // if ($err)
            // {
            //     echo "cURL Error #:" . $err;
            //     $Code = ResponseConstant::UNSUCCESS;
            //     $rescode = ResponseConstant::UNSUCCESS;
            //     $Message ='Curl Error';
            //     $this->sendResponse($Code,$rescode,$Message);
            // }
            //else
           // {
                $data = array('otp'=>1234);
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message ='OTP SENT';
                $this->sendResponse($Code,$rescode,$Message,array($data)); 
           // } 
			// $row_array = $this->cleaner_api_model->validate_login_cleaner($phone_number,$password);
			// if($row_array)
			// {
			// 	$Code = ResponseConstant::SUCCESS;
			// 	$rescode = ResponseConstant::SUCCESS;
			// 	$Message ='Login Successfully';
			// 	$this->sendResponse($Code,$rescode,$Message,array($row_array));	
			// }
			// else
			// {
			// 	$Code = ResponseConstant::UNSUCCESS;
			// 	$rescode = ResponseConstant::UNSUCCESS;
			// 	$Message ='INVALID CREDENTIALS';
			// 	$this->sendResponse($Code,$rescode,$Message);
			// }
		}
    }
    public function survey_status($postDataArray)
    {
        $phone_number = (isset($postDataArray->phone_number) && !empty($postDataArray->phone_number)) ? $postDataArray->phone_number: '';
        if(empty($phone_number))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {
            $row = $this->api_model->check_survey_status($phone_number);
            // echo $this->db->last_query(); die;
           // print_r($row);die;
            if($row)
            {
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message ='SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,array($row));
                
            }
            else
            {
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'USER DOES NOT GIVE ANY SURVEY';
                $this->sendResponse($Code,$rescode,$Message);
            }
        }
    }

    public function is_pan_exist($postDataArray)
    {
         $pan_number = (isset($postDataArray->pan_number) && !empty($postDataArray->pan_number)) ? $postDataArray->pan_number: '';
        if(empty($pan_number))
        {
            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {   
            $user_detail_row=$this->api_model->get_detail_if_pan_exist($pan_number);
            // print_r($user_detail_row);die;
            if($user_detail_row)
            {
                $user_detail_row['dob']=date("d/m/Y", strtotime($user_detail_row['dob']));
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message ='SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,array($user_detail_row));
            }
            else
            {
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'PAN NUMBER NOT EXIST';
                $this->sendResponse($Code,$rescode,$Message);
            }
        }
    }
    public function insert_basic_details($postDataArray)
    {
        $user_id = (isset($postDataArray->user_id) && !empty($postDataArray->user_id)) ? $postDataArray->user_id: '';
        if(!empty($user_id))
        {
            //print_r($_POST); die;
            $id = $user_id;
            $phone_number_2 = (isset($postDataArray->phone_number_2) && !empty($postDataArray->phone_number_2)) ? $postDataArray->phone_number_2: '';
            //echo $user_id; die;
            // $first_name = (isset($postDataArray->first_name) && !empty($postDataArray->first_name)) ? $postDataArray->first_name: '';
            // $last_name = (isset($postDataArray->last_name) && !empty($postDataArray->last_name)) ? $postDataArray->last_name: '';
            // $email = (isset($postDataArray->email) && !empty($postDataArray->email)) ? $postDataArray->email: '';
            // $email = (isset($postDataArray->email) && !empty($postDataArray->email)) ? $postDataArray->email: '';
            // $email = (isset($postDataArray->email) && !empty($postDataArray->email)) ? $postDataArray->email: '';
            // $email = (isset($postDataArray->email) && !empty($postDataArray->email)) ? $postDataArray->email: '';
            // $email = (isset($postDataArray->email) && !empty($postDataArray->email)) ? $postDataArray->email: '';
           
           
            // $pan_number = $this->input->post('pan_number');
            // $dob = $this->input->post('dob');
            // // $gender = $this->input->post('gender');
            // $working = $this->input->post('working');
            // $income = $this->input->post('income');
            // $middle_name = $this->input->post('middle_name');
            // //$income = $this->input->post('income');
            // $org = $this->input->post('org');
            // $psu = $this->input->post('psu');
            // $date = str_replace('/', '-', $dob);
            // $dob_date =  date('Y-m-d', strtotime($date)); 
            // //echo $dob_date; die;
            // $data = array(
            // 'first_name'=>$first_name,
            // 'last_name'=>$last_name,
            // 'email'=>$email,
            // 'dob'=>$dob_date,
            // 'phone_number_2'=>$phone_number_2,
            // 'gender'=>$gender,
            // 'working'=>$working,
            // 'income'=>$income,
            // 'org'=>$org,
            // 'psu'=>$psu,
            // 'pan_number'=>$pan_number,
            // 'user_type'=>'website',
            // 'middle_name'=>$middle_name
            // );
            $bool = $this->api_model->update_basic_data($phone_number_2,$id);
            if($bool)
            {
                $row = $this->api_model->check_survey_status($phone_number_2);
                // echo $this->db->last_query(); die;
                /// $data = array('user_id'=>$id);
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message ="INFORMATION UPDATED";
                $this->sendResponse($Code,$rescode,$Message,array($row));
            }
            else
            {
                 $data = array('user_id'=>$id);
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message ='ERROR IN UPDATION';
               $this->sendResponse($Code,$rescode,$Message,$data);
            }
        }// code to update data end here
        //code to insert data
        else
        {
           
            $phone_number = (isset($postDataArray->phone_number) && !empty($postDataArray->phone_number)) ? $postDataArray->phone_number: '';

            $first_name = (isset($postDataArray->first_name) && !empty($postDataArray->first_name)) ? $postDataArray->first_name: '';
            $middle_name = (isset($postDataArray->middle_name) && !empty($postDataArray->middle_name)) ? $postDataArray->middle_name: '';
            $last_name = (isset($postDataArray->last_name) && !empty($postDataArray->last_name)) ? $postDataArray->last_name: '';
            $email = (isset($postDataArray->email) && !empty($postDataArray->email)) ? $postDataArray->email: '';
            $pan_number = (isset($postDataArray->pan_number) && !empty($postDataArray->pan_number)) ? $postDataArray->pan_number: '';
            $dob = (isset($postDataArray->dob) && !empty($postDataArray->dob)) ? $postDataArray->dob: '';
            $gender = (isset($postDataArray->gender) && !empty($postDataArray->gender)) ? $postDataArray->gender: '';
            $working = (isset($postDataArray->working) && !empty($postDataArray->working)) ? $postDataArray->working: '';
            $income = (isset($postDataArray->income) && !empty($postDataArray->income)) ? $postDataArray->income: '';
            $org = (isset($postDataArray->org) && !empty($postDataArray->org)) ? $postDataArray->org: '';
            $psu = (isset($postDataArray->psu) && !empty($postDataArray->psu)) ? $postDataArray->psu: '';
            $date = str_replace('/', '-', $dob);
            $dob_date =  date('Y-m-d', strtotime($date));

            if(empty($phone_number) || empty($first_name) || empty($last_name) || empty($pan_number) || empty($dob_date) || empty($income) )
            {
            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
            }
            else
            {
                $row = $this->api_model->is_exist_phone_number($phone_number,$pan_number);
                if($row)
                {
                    $Code = ResponseConstant::UNSUCCESS;
                    $rescode = ResponseConstant::UNSUCCESS;
                    $Message ='PHONE OR PAN NUMBER ALREADY EXIST';
                    $this->sendResponse($Code,$rescode,$Message);

                }
                else
                {
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
                    'user_type'=>'Mobile',
                    'middle_name'=>$middle_name
                    );
                    $insert_id = $this->api_model->insert_basic_data($data);
                    if($insert_id)
                    {
                        $data = array('id'=>$insert_id,'income'=>$income,'survey_status'=>'0','is_completed'=>null);
                        $Code = ResponseConstant::SUCCESS;
                        $rescode = ResponseConstant::SUCCESS;
                        $Message ='SUCCESFULL';
                        $this->sendResponse($Code,$rescode,$Message,array($data));
                    }
                    else
                    {
                        $Code = ResponseConstant::UNSUCCESS;
                        $rescode = ResponseConstant::UNSUCCESS;
                        $Message ='ERROR IN INSERTION';
                        $this->sendResponse($Code,$rescode,$Message);
                    }
                }

                //echo $dob_date; die;
               
            }
            
        }   
    }
    public function state_list($postDataArray)
    {
        $tabel ='states';
        $column=array();
        $where=array();
        $flag='result_array_not_id';
        $states = $this->api_model->get_data($tabel,$column,$where,$flag);
        if(!empty($states))
        {
            $Code = ResponseConstant::SUCCESS;
            $rescode = ResponseConstant::SUCCESS;
            $Message ='SUCCESFULL';
            $this->sendResponse($Code,$rescode,$Message,$states);
        }
        else
        {
            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message ='NO STATE FOUND';
            $this->sendResponse($Code,$rescode,$Message);
        }
    }
    public function district_list($postDataArray)
    {
        $state_id = (isset($postDataArray->state_id) && !empty($postDataArray->state_id)) ? $postDataArray->state_id: '';
        if(empty($state_id))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {

            $tabel ='cities';
            $column=array();
            $where=array('state_id'=>$state_id);
            $flag='result_array_with_id';
            $cities = $this->api_model->get_data($tabel,$column,$where,$flag);
            //echo $cities['id'];die;
            if(!empty($cities))
            {
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message ='SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,$cities);
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message ='NO DISTRICT FOUND';
                $this->sendResponse($Code,$rescode,$Message);
            }
        }
    }
    public function town_list($postDataArray)
    {
        $district_id = (isset($postDataArray->district_id) && !empty($postDataArray->district_id)) ? $postDataArray->district_id: '';
        if(empty($district_id))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {
            $tabel ='town';
            $column=array();
            $where=array('city_id'=>$district_id);
            $flag='result_array_with_id';
            $town = $this->api_model->get_data($tabel,$column,$where,$flag);
            //echo $cities['id'];die;
            if(!empty($town))
            {
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message ='SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,$town);
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message ='NO TOWN FOUND';
                $this->sendResponse($Code,$rescode,$Message);
            }
        }
    }
    public function nearest_city_list($postDataArray)
    {
        $state_id = (isset($postDataArray->state_id) && !empty($postDataArray->state_id)) ? $postDataArray->state_id: '';
        if(empty($state_id))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {
            $tabel ='nearest_city';
            $column=array();
            $where=array('state_id'=>$state_id);
            $flag='result_array_with_id';
            $ncity = $this->api_model->get_data($tabel,$column,$where,$flag); 
            //echo $cities['id'];die;
            if(!empty($ncity))
            {
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message ='SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,$ncity);
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message ='NO STATE FOUND';
                $this->sendResponse($Code,$rescode,$Message);
            }
        }
    }
    public function get_moza($postDataArray)
    {
        $ncity_id = (isset($postDataArray->ncity_id) && !empty($postDataArray->ncity_id)) ? $postDataArray->ncity_id: '';
        if(empty($ncity_id))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {
            $tabel ='moza';
            $column=array();
            $where=array('ncity_id'=>$ncity_id);
            $flag='result_array_with_id';
            $moza = $this->api_model->get_data($tabel,$column,$where,$flag); 
            //echo $cities['id'];die;
            if(!empty($moza))
            {
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message ='SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,$moza);
            }
            else
            {
                $Code = 1;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message ='NO MOZA FOUND';
                $this->sendResponse($Code,$rescode,$Message);
            }
        }
    }
    public function add_town($postDataArray)
    {
        $state_id = (isset($postDataArray->state_id) && !empty($postDataArray->state_id)) ? $postDataArray->state_id: '';
        $city_id = (isset($postDataArray->city_id) && !empty($postDataArray->city_id)) ? $postDataArray->city_id: '';
        $town = (isset($postDataArray->town) && !empty($postDataArray->town)) ? $postDataArray->town: '';

        //echo strtolower($town);
        if(empty($state_id) || empty($city_id) || empty($town))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {

            $town_name = ucfirst(strtolower($town));
            $row = $this->api_model->check_town_already_exist($town_name);
            if($row)
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'TOWN ALREADY EXIST';
                $this->sendResponse($Code,$rescode,$Message);
            }
            else
            {
                //$town ='test';
                $data = array(
                    'name'=>$town_name,
                    'city_id'=>$city_id,
                    'state_id'=>$state_id,
                    'status'=>2,
                );
                $insert_id = $this->api_model->insert_town_data($data);
                if($insert_id)
                {
                    $array=array('town_id'=>$insert_id);
                    $Code = ResponseConstant::SUCCESS;
                    $rescode = ResponseConstant::SUCCESS;
                    $Message = 'SUCCESFULL';
                    $this->sendResponse($Code,$rescode,$Message,array($array)); 
                }
            }
        }
    }

    public function add_moza($postDataArray)
    {
        $ncity_id = (isset($postDataArray->ncity_id) && !empty($postDataArray->ncity_id)) ? $postDataArray->ncity_id: '';
        $moza_name = (isset($postDataArray->moza_name) && !empty($postDataArray->moza_name)) ? $postDataArray->moza_name: '';
         //echo strtolower($town);
        if(empty($ncity_id) || empty($moza_name))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {

            $moza_name = ucfirst(strtolower($moza_name));
            $row = $this->api_model->check_moza_already_exist($moza_name);
            if($row)
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'MOZA ALREADY EXIST';
                $this->sendResponse($Code,$rescode,$Message);
            }
            else
            {
                //$town ='test';
               $data = array(
                    'name'=>$moza_name,
                    'ncity_id'=>$ncity_id,
                    'status'=>2,
                );
                $insert_id = $this->api_model->insert_moza_data($data);
                if($insert_id)
                {
                    $array=array('moza_id'=>$insert_id);
                    $Code = ResponseConstant::SUCCESS;
                    $rescode = ResponseConstant::SUCCESS;
                    $Message = 'SUCCESFULL';
                    $this->sendResponse($Code,$rescode,$Message,array($array)); 
                }
            }
        }
        
    }

    public function first_survey_data($postDataArray)
    {
        //echo"hello";die;
        $user_id = (isset($postDataArray->user_id) && !empty($postDataArray->user_id)) ? $postDataArray->user_id: '';
        $state_id = (isset($postDataArray->state_id) && !empty($postDataArray->state_id)) ? $postDataArray->state_id: '';
        $district_id = (isset($postDataArray->district_id) && !empty($postDataArray->district_id)) ? $postDataArray->district_id: '';


        $town_id = (isset($postDataArray->town_id) && !empty($postDataArray->town_id)) ? $postDataArray->town_id: '';
        $ncity_id = (isset($postDataArray->ncity_id) && !empty($postDataArray->ncity_id)) ? $postDataArray->ncity_id: '';
        $moza_id = (isset($postDataArray->moza_id) && !empty($postDataArray->moza_id)) ? $postDataArray->moza_id: '';


        $is_pakka = (isset($postDataArray->is_pakka) && !empty($postDataArray->is_pakka)) ? $postDataArray->is_pakka: '';
        $pakka = (isset($postDataArray->pakka) && !empty($postDataArray->pakka)) ? $postDataArray->pakka: '';

        $what_want = (isset($postDataArray->what_want) && !empty($postDataArray->what_want)) ? $postDataArray->what_want: '';
        
        
        $independent_wife = (isset($postDataArray->independent_wife) && !empty($postDataArray->independent_wife)) ? $postDataArray->independent_wife: '';
       $son = (isset($postDataArray->son) && !empty($postDataArray->son)) ? $postDataArray->son: '';
      
            $son = (array)$son;
       
        //print_r($son); die;
        (array)$daughter = (isset($postDataArray->daughter) && !empty($postDataArray->daughter)) ? $postDataArray->daughter: '';
        $daughter = (array)$daughter;



        if(empty($user_id) || empty($state_id) || empty($district_id) || (empty($moza_id) && empty($town_id)))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {
            $survey_data = array(
            'user_id'=>$user_id,
            'state_id'=>$state_id,
            'district_id'=>$district_id,
            'pakka_house'=>$pakka,
            'what_you_want'=>$what_want,
            'independent_wife'=>$independent_wife,
            'town_id'=>$town_id,
            'ncity_id'=>$ncity_id,
            'moza_id'=>$moza_id,
            'is_completed'=>2,
            );

            $insert_id = $this->api_model->insert_first_survey_data($survey_data);
            if($insert_id)
            {
                  $response =array('user_id'=>$user_id); 
               //$response = $this->api_model->get_user_detail($user_id);
                 //echo"<pre>";print_r($son);
                // print_r($daughter);
                // echo $son[0]->age;die;
                 //echo"<pre>";print_r($son);die;
                if(!empty(array_filter($son)))
                {

                    foreach ($son as $key => $value)
                    {
                        $age =  $value->age; 
                        $salary = $value->salary;
                        $this->api_model->insert_son($age,$salary,$user_id);
                    }
                }
                if(!empty(array_filter($daughter)))
                {

                    foreach ($daughter as $d_key => $d_value)
                    {
                        $age =  $value->age; 
                        $salary = $value->salary;
                        $this->api_model->insert_daughter($age,$salary,$user_id);
                    }
                }


                //echo "<pre>"; print_r($son['salary']); die;
                //          echo"<pre>";print_r($son); die;
                // array_filter($son);
                // print_r(count(array_filter($son['salary']))); die;
                // if(count(array_filter((array)$son['salary']))>0)
                // {
                    
                //     $salaryofson = $son['salary'];

                //     $ageofson = $son['age'];

                //     foreach($ageofson as $key => $value)
                //     {
                        
                //           //  echo $key; die;
                //         $age = $value;
                //         $salary =$salaryofson->$key;
                //         $this->api_model->insert_son($age,$salary,$user_id);
                                                
                //     }
                // }
                // if(count(array_filter((array)$daughter['salary']))>0)
                // {
                //     $salaryofdaughter = $daughter['salary'];
                //     $ageofdaughter = $daughter['age'];
                //     //print_r($ageofdaughter); die;
                //     $bool = '';
                //     foreach($ageofdaughter as $key => $value)
                //     {
                //         $age = $value;
                //         $salary =$salaryofdaughter->$key;
                //         $this->api_model->insert_daughter($age,$salary,$user_id);
                //         //echo $this->db->last_query(); die;
                //     }
                //     if($bool)
                //     {
                //         $Code = ResponseConstant::SUCCESS;
                //         $rescode = ResponseConstant::SUCCESS;
                //         $Message = 'SUCCESFULL';
                //         $this->sendResponse($Code,$rescode,$Message,array($response));
                //     }
                // }
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message = 'SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,array($response));
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'ERROR IN INSERTION';
                $this->sendResponse($Code,$rescode,$Message);

            }
        }
    }

    public function get_que_ans($postDataArray)
    {
        $lang = (isset($postDataArray->lang) && !empty($postDataArray->lang)) ? $postDataArray->lang: '';
        $result = $this->api_model->que_ans_list($lang);
        // echo "<pre>";print_r($result); die;
        if($result)
        {
            $Code = ResponseConstant::SUCCESS;
            $rescode = ResponseConstant::SUCCESS;
            $Message = 'SUCCESFULL';
            $this->sendResponse($Code,$rescode,$Message,$result);
        }
        else
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = 'ERROR IN FETCHING DATA';
            $this->sendResponse($Code,$rescode,$Message);
        }
    }

    public function second_survey_data($postDataArray)
    {
        $user_id = (isset($postDataArray->user_id) && !empty($postDataArray->user_id)) ? $postDataArray->user_id: '';
        $answers = (isset($postDataArray->answers) && !empty($postDataArray->answers)) ? $postDataArray->answers: '';


       // $answers = json_decode($answers);
        if(empty($user_id) || empty($answers))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {
            if(!empty($answers))
            {
               // echo"<pre>"; print_r($answers); die;
                foreach ($answers as $key => $value)
                {
                    if($value->option=='op_a')
                    {
                        $flag='op_a';
                    }
                    elseif($value->option=='op_b')
                    {
                        $flag='op_b';
                    }
                    elseif($value->option=='op_c')
                    {
                        $flag='op_c';
                    }
                    else
                    {
                        $flag='op_d';
                    }
                     $qn_id = $value->qn_id;
                     $data=array(
                        'qn_id'=>$qn_id,
                        'user_id'=>$user_id
                     );
                    $insert_id =  $this->api_model->insert_second_survey_data($data,$flag);
                }

                if($insert_id)
                {
                    // $data = array('user_id'=>$user_id);
                    $this->api_model->update_survey_data($user_id);
                    $data = $this->api_model->get_user_detail($user_id);
                    $Code = ResponseConstant::SUCCESS;
                    $rescode = ResponseConstant::SUCCESS;
                    $Message = 'SUCCESFULL';
                    $this->sendResponse($Code,$rescode,$Message,$data);
                }
                else
                {
                    $Code = ResponseConstant::UNSUCCESS;
                    $rescode = ResponseConstant::UNSUCCESS;
                    $Message = 'ERROR IN INSERTION';
                    $this->sendResponse($Code,$rescode,$Message,$result);
                }
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'ANSWERS NOT FOUND';
                $this->sendResponse($Code,$rescode,$Message);
            }

        }

    }
    public function get_organisation($postDataArray)
    {
        $tabel='organisations';
        $column=array();
        $where=array();
        $flag='result_array_not_id';
        $org = $this->api_model->get_data($tabel,$column,$where,$flag);
        if($org)
        {
            $Code = ResponseConstant::SUCCESS;
            $rescode = ResponseConstant::SUCCESS;
            $Message = 'SUCCESFULL';
            $this->sendResponse($Code,$rescode,$Message,$org);
        }
        else
        {
            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = 'ORGANISATION NOT FOUND';
            $this->sendResponse($Code,$rescode,$Message);
        }
    }

     public function get_psu($postDataArray)
    {
        $tabel='organisation_sector';
        $column=array();
        $where=array();
        $flag='result_array_not_id';
        $org = $this->api_model->get_data($tabel,$column,$where,$flag);
        if($org)
        {
            $Code = ResponseConstant::SUCCESS;
            $rescode = ResponseConstant::SUCCESS;
            $Message = 'SUCCESFULL';
            $this->sendResponse($Code,$rescode,$Message,$org);
        }
        else
        {
            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = 'ORGANISATION NOT FOUND';
            $this->sendResponse($Code,$rescode,$Message);
        }
    }

    public function calculate_subsidy($postDataArray)
    {
        // echo"hello";die;
        error_reporting(E_ERROR | E_PARSE);
        $loan_amount = (isset($postDataArray->loan_amount) && !empty($postDataArray->loan_amount)) ? $postDataArray->loan_amount: '';
        $tenure = (isset($postDataArray->tenure) && !empty($postDataArray->tenure)) ? $postDataArray->tenure: '';
        $income = (isset($postDataArray->income) && !empty($postDataArray->income)) ? $postDataArray->income: '';
        $income = $income*12;
       // $answers = json_decode($answers);
        if(empty($loan_amount) || empty($tenure) || empty($income) )
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {


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
            $output = array
            (
                'subsidy'=>(int)$subsidy,
                'emi'=>(int)$EMI,
                'EMIBank'=>(int)$EMIBank,
                'pmay_in_t_year'=>(int)$pmay_in_t_year,
                'without_pmay_in_t_year'=>(int)$without_pmay_in_t_year,
                'percentage'=>(int)$percentage,
                'total_saving'=>(int)$total_saving
            );

            if($output)
            {

                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message = 'SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,array($output));
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'ERROR IN CALCULATING SUBSIDY';
                $this->sendResponse($Code,$rescode,$Message);

            }
            
            
        }




    }

    public function insert_query($postDataArray)
    {
        // echo"hello";die;
        // $name = $this->input->post('name');
        // $email = $this->input->post('email');
        // $phone = $this->input->post('phone');
        // $query = $this->input->post('message');

        $name = (isset($postDataArray->name) && !empty($postDataArray->name)) ? $postDataArray->name: '';
        $email = (isset($postDataArray->email) && !empty($postDataArray->email)) ? $postDataArray->email: '';
        $phone = (isset($postDataArray->phone) && !empty($postDataArray->phone)) ? $postDataArray->phone: '';
        $query = (isset($postDataArray->query) && !empty($postDataArray->query)) ? $postDataArray->query: '';
        
        // die;
        if(empty($name) || empty($email) || empty($phone) || empty($query) )
        {
            // echo"hello";die;

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {

            $data=array
            (
                'name'=>$name,
                'email'=>$email,
                'phone_number'=>$phone,
                'query'=>$query,
                'generated_on'=>date('y-m-d')

            );
            $insert_id = $this->api_model->insert_query($data);
            if($insert_id)
            {
                $data=array('query_id'=>$insert_id);
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message = 'SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,array($data));
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'ERROR IN INSERTION';
                $this->sendResponse($Code,$rescode,$Message);
                
            }
        }
    }


    public function faq($postDataArray)
    {

        $lang = (isset($postDataArray->lang) && !empty($postDataArray->lang)) ? $postDataArray->lang: '';
        // echo $lang; die;
       $tabs =  $this->api_model->get_faq_tabs($lang);
        // echo"<pre>";print_r($tabs); die;

       foreach ($tabs as $key => $value)
       {
         // echo $value['name'];die;
        if($lang=='hin')
        {
            $response[$key]['tab_name']=$value['name_hin'];
            $response[$key]['tab_value'] = $this->api_model->get_question_answer($value['id'],$lang);
        }
        else
        {
            // echo"hehbe";die;

            $response[$key]['tab_name']=$value['name'];
            $response[$key]['tab_value'] = $this->api_model->get_question_answer($value['id']);
        }
       }
        if($response)
        {
            // $response = array_values($response[]);
            $Code = ResponseConstant::SUCCESS;
            $rescode = ResponseConstant::SUCCESS;
            $Message = 'SUCCESFULL';
            $this->sendResponse($Code,$rescode,$Message,$response);

        }
        else
        {
            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = 'FAQ NOT FOUND';
            $this->sendResponse($Code,$rescode,$Message);

        }
    }

    public function get_case_number_and_salary($postDataArray)
    {
         $user_id = (isset($postDataArray->user_id) && !empty($postDataArray->user_id)) ? $postDataArray->user_id: '';

        if(empty($user_id))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {
            $row = $this->api_model->check_user_existence($user_id);
            if($row)
            {

                $salary_row  =  $this->api_model->get_case_number_with_salary($user_id);
                $self_income = $salary_row['income'];
                $wife_income = $salary_row['independent_wife'];
                $case_number = $salary_row['case_number'];

                $first_name = $salary_row['first_name'];


                $sibling_salary = $this->api_model->get_sibling_income_if_any($user_id);
                $total_income = $self_income + $wife_income + (int)$sibling_salary;
                $total_annual_income = $total_income*12;

                $response=array('case_number'=>$case_number,'total_annual_income'=>$total_annual_income,'first_name'=>$first_name);
                if($response)
                {

                    $Code = ResponseConstant::SUCCESS;
                    $rescode = ResponseConstant::SUCCESS;
                    $Message = 'SUCCESSFULL';
                    $this->sendResponse($Code,$rescode,$Message,array($response));
                }
                else
                {
                    $Code = ResponseConstant::UNSUCCESS;
                    $rescode = ResponseConstant::UNSUCCESS;
                    $Message = 'ERROR IN GETTING DATA';
                    $this->sendResponse($Code,$rescode,$Message);
                }
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'USER NOT EXIST ';
                $this->sendResponse($Code,$rescode,$Message);

            }
        }            
       
       // $answers = json_decode($answers);
    }


    public function pdf_data($postDataArray)
    {
        $user_id = (isset($postDataArray->user_id) && !empty($postDataArray->user_id)) ? $postDataArray->user_id: '';

        if(empty($user_id))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {
            $row = $this->api_model->check_user_existence($user_id);
            if($row)
            {

                $salary_row  =  $this->api_model->get_case_number_for_pdf_with_salary($user_id);
                $self_income = $salary_row['income'];
                $wife_income = $salary_row['independent_wife'];
                $case_number = $salary_row['case_number'];

                $moza_status = $salary_row['moza_status'];
                $town_status = $salary_row['town_status'];
                $town_govt = $salary_row['town_govt'];
                $moza_govt = $salary_row['moza_govt'];
                $town_notification = $salary_row['town_notification'];
                $moza_notification = $salary_row['moza_notification'];


                $sibling_salary = $this->api_model->get_sibling_income_if_any($user_id);
                $total_income = $self_income + $wife_income + (int)$sibling_salary;
                $total_annual_income = $total_income*12;
                $salary_row['total_annual_income'] = $total_annual_income;
                // $response=array('case_number'=>$case_number,'moza_status'=>$moza_status,'town_status'=>$town_status,'town_govt'=>$town_govt,'moza_govt'=>$moza_govt,'town_notification'=>$town_notification,'moza_notification'=>$moza_notification,'total_annual_income'=>$total_annual_income);
                if($salary_row)
                {

                    $Code = ResponseConstant::SUCCESS;
                    $rescode = ResponseConstant::SUCCESS;
                    $Message = 'SUCCESSFULL';
                    $this->sendResponse($Code,$rescode,$Message,array($salary_row));
                }
                else
                {
                    $Code = ResponseConstant::UNSUCCESS;
                    $rescode = ResponseConstant::UNSUCCESS;
                    $Message = 'ERROR IN GETTING DATA';
                    $this->sendResponse($Code,$rescode,$Message);
                }
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'USER NOT EXIST ';
                $this->sendResponse($Code,$rescode,$Message);

            }
        }

    }
    public function to_insert_case_number($postDataArray)
    {
        // echo"dfgdf";die;
        $user_id = (isset($postDataArray->user_id) && !empty($postDataArray->user_id)) ? $postDataArray->user_id: ''; 
        if(empty($user_id))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {

        

            $total_salary = $this->api_model->check_salary_total_count($user_id);
            $self_income = $total_salary['income'];
            $wife_income = $total_salary['independent_wife'];
            $sibling_salary = $this->api_model->get_sibling_income_if_any($user_id);
            $total_income = $self_income + $wife_income + (int)$sibling_salary;
            $total_annual_income = $total_income*12;

            


            // to get details of the basick survey for report

            $basick_survey_row = $this->api_model->get_basick_survey_details($user_id);
            //print_r($basick_survey_row); die;
            $town_id = $basick_survey_row['town_id'];
            $moza_id = $basick_survey_row['moza_id'];
            $pakka_house = $basick_survey_row['pakka_house'];
            $what_you_want = $basick_survey_row['what_you_want'];
            if(!empty($town_id))
            {


                $town_row = $this->api_model->get_town_data($town_id);
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
                                        
                                        $this->api_model->insert_cause_number($user_id,2);
                                        // $this->session->set_flashdata('second','this_is_2_cause');
                                        // redirect('survey/report_view');
                                    }
                                    else
                                    {
                                        //echo "1nd cause ";die;
                                         $this->api_model->insert_cause_number($user_id,1);
                                        // $this->session->set_flashdata('first','this_is_1_cause');
                                        // redirect('survey/report_view');
                                    }
                                }
                                else
                                {
                                    // when pakka house is null or no choosen by user
                                    //echo "1nd cause ";die;
                                    $this->api_model->insert_cause_number($user_id,1);
                                    // $this->session->set_flashdata('first','this_is_1_cause');
                                    // redirect('survey/report_view');
                                }
                            }
                            else
                            {
                                //when salary is less than 18 lac but greter than 6 lac
                                if(!empty($pakka_house))
                                {
                                    // echo "2nd cause ";die('this 2');
                                    $this->api_model->insert_cause_number($user_id,2);
                                    // $this->session->set_flashdata('second','this_is_2_cause');
                                    // redirect('survey/report_view');
                                }
                                else
                                {
                                    // echo "1nd cause ";die;
                                    $this->api_model->insert_cause_number($user_id,1);

                                    // $this->session->set_flashdata('first','this_is_1_cause');
                                    // redirect('survey/report_view');
                                }
                            }
                        }
                        else
                        {
                            // echo"ergerg";die;
                            // echo "2nd cause ";die('this 3');
                            // when total annual income is greater then 18 lac
                                    $this->api_model->insert_cause_number($user_id,2);

                            // $this->session->set_flashdata('second','this_is_2_cause');
                            // redirect('survey/report_view');

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
                                            $this->api_model->insert_cause_number($user_id,2);

                                            // $this->session->set_flashdata('second','this_is_2_cause');
                                            // redirect('survey/report_view');
                                        }
                                        else
                                        {
                                            // echo "3nd cause ";die;
                                            $this->api_model->insert_cause_number($user_id,3);

                                            // $this->session->set_flashdata('third','this_is_3_cause');
                                            // redirect('survey/report_view');
                                        }
                                    }
                                    else
                                    {
                                        // echo "3d cause ";die;
                                        // when pakka house is null or no choosen by user
                                            $this->api_model->insert_cause_number($user_id,3);

                                        // $this->session->set_flashdata('third','this_is_3_cause');
                                        // redirect('survey/report_view');
                                    }
                                }
                                else
                                {
                                //when salary is less than 18 lac but greter than 6 lac
                                    if(!empty($pakka_house))
                                    {
                                        // echo "2nd cause ";die('this 4');
                                            $this->api_model->insert_cause_number($user_id,2);

                                        // $this->session->set_flashdata('second','this_is_2_cause');
                                        // redirect('survey/report_view');
                                    }
                                    else
                                    {
                                        // echo "3nd cause ";die;
                                            $this->api_model->insert_cause_number($user_id,3);

                                        // $this->session->set_flashdata('third','this_is_3_cause');
                                        // redirect('survey/report_view');
                                    }
                                }
                            }
                            else
                            {
                            // when total annual income is greater then 18 lac
                                // echo "2nd cause ";die('this 5');
                                            $this->api_model->insert_cause_number($user_id,2);

                                // $this->session->set_flashdata('second','this_is_2_cause');
                                // redirect('survey/report_view');

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
                                            $this->api_model->insert_cause_number($user_id,2);

                                            // $this->session->set_flashdata('second','this_is_2_cause');
                                            // redirect('survey/report_view');
                                        }
                                        else
                                        {
                                            //echo "3nd cause ";die('this 7');
                                            $this->api_model->insert_cause_number($user_id,3);

                                            // $this->session->set_flashdata('third','this_is_3_cause');
                                            // redirect('survey/report_view');
                                        }
                                    }
                                    else
                                    {
                                        //echo "3nd cause ";die;
                                    // when pakka house is null or no choosen by user
                                            $this->api_model->insert_cause_number($user_id,3);

                                        // $this->session->set_flashdata('third','this_is_3_cause');
                                        // redirect('survey/report_view');
                                    }
                                }
                                else
                                {
                                //when salary is less than 18 lac but greter than 6 lac
                                    if(!empty($pakka_house))
                                    {
                                        //echo "2nd cause ";die('this 8');
                                            $this->api_model->insert_cause_number($user_id,2);

                                        // $this->session->set_flashdata('second','this_is_2_cause');
                                        // redirect('survey/report_view');
                                    }
                                    else
                                    {
                                        //echo "3nd cause ";die;
                                            $this->api_model->insert_cause_number($user_id,3);

                                        // $this->session->set_flashdata('third','this_is_3_cause');
                                        // redirect('survey/report_view');
                                    }
                                }
                            }
                            else
                            {
                                //echo "3nd cause ";die;
                            // when total annual income is greater then 18 lac
                                            $this->api_model->insert_cause_number($user_id,2);

                                // $this->session->set_flashdata('second','this_is_2_cause');
                                // redirect('survey/report_view');
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
                                            $this->api_model->insert_cause_number($user_id,2);

                                    // $this->session->set_flashdata('second','this_is_2_cause');
                                    // redirect('survey/report_view');
                                }
                                else
                                {
                                        //echo $user_id;
                                        //echo $total_annual_income;
                                        //echo "2nd cause ";die('this 10');
                                    //in flow chart this is 2 or 4
                                            $this->api_model->insert_cause_number($user_id,4);

                                    // $this->session->set_flashdata('second','this_is_2_cause');
                                    // redirect('survey/report_view');
                                }
                            }
                            else
                            {
                                    //echo "4nd cause ";die;
                                    // when pakka house is null or no choosen by user
                                    //ask to change location cause
                                            $this->api_model->insert_cause_number($user_id,4);

                                // $this->session->set_flashdata('fourth','this_is_4_cause');
                                //redirect('survey/report_view');
                            }
                        }
                        else
                        {
                                //when salary is less than 18 lac but greter than 6 lac
                            if(!empty($pakka_house))
                            {
                                //echo "2nd cause ";die('this 11');
                                            $this->api_model->insert_cause_number($user_id,2);

                                // $this->session->set_flashdata('second','this_is_2_cause');
                                // redirect('survey/report_view');
                            }
                            else
                            {
                                //ask to change location cause


                                //echo "4nd cause ";die;    
                                            $this->api_model->insert_cause_number($user_id,4);

                                // $this->session->set_flashdata('fourth','this_is_4_cause');
                                // redirect('survey/report_view');
                            }
                        }
                    }
                    else
                    {
                        // when total annual income is greater then 18 lac
                            
                        //echo "2nd cause ";die('this 12');
                                            $this->api_model->insert_cause_number($user_id,2);

                        // $this->session->set_flashdata('second','this_is_2_cause');
                        // redirect('survey/report_view');
                    }
                    //the case when town is manually added status =2;
                }
                
            }//if not empty town id block ends here
            elseif (!empty($moza_id))
            {
                $moza_row = $this->api_model->get_moza_data($moza_id);
                //$town_row = $this->api_model->get_town_data($town_id);
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
                                            $this->api_model->insert_cause_number($user_id,2);
                                        
                                        // 
                                        $this->session->set_flashdata('second','this_is_2_cause');
                                        // redirect('survey/report_view');
                                    }
                                    else
                                    {
                                            $this->api_model->insert_cause_number($user_id,1);

                                        // $this->session->set_flashdata('first','this_is_1_cause');
                                        // redirect('survey/report_view');
                                    }
                                }
                                else
                                {
                                            $this->api_model->insert_cause_number($user_id,1);

                                    // when pakka house is null or no choosen by user
                                    // $this->session->set_flashdata('first','this_is_1_cause');
                                    // redirect('survey/report_view');
                                }
                            }
                            else
                            {
                                //when salary is less than 18 lac but greter than 6 lac
                                if(!empty($pakka_house))
                                {
                                            $this->api_model->insert_cause_number($user_id,2);

                                    // $this->session->set_flashdata('second','this_is_2_cause');
                                    // redirect('survey/report_view');
                                }
                                else
                                {
                                            $this->api_model->insert_cause_number($user_id,1);

                                    // $this->session->set_flashdata('first','this_is_1_cause');
                                    // redirect('survey/report_view');
                                }
                            }
                        }
                        else
                        {
                            // when total annual income is greater then 18 lac
                                            $this->api_model->insert_cause_number($user_id,2);

                            // $this->session->set_flashdata('second','this_is_2_cause');
                            // redirect('survey/report_view');

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
                                            $this->api_model->insert_cause_number($user_id,2);

                                            // $this->session->set_flashdata('second','this_is_2_cause');
                                            // redirect('survey/report_view');
                                        }
                                        else
                                        {
                                            $this->api_model->insert_cause_number($user_id,3);

                                            // $this->session->set_flashdata('third','this_is_3_cause');
                                            // redirect('survey/report_view');
                                        }
                                    }
                                    else
                                    {
                                    // when pakka house is null or no choosen by user
                                            $this->api_model->insert_cause_number($user_id,3);

                                        // $this->session->set_flashdata('third','this_is_3_cause');
                                        // redirect('survey/report_view');
                                    }
                                }
                                else
                                {
                                //when salary is less than 18 lac but greter than 6 lac
                                    if(!empty($pakka_house))
                                    {
                                            $this->api_model->insert_cause_number($user_id,2);

                                        // $this->session->set_flashdata('second','this_is_2_cause');
                                        // redirect('survey/report_view');
                                    }
                                    else
                                    {
                                            $this->api_model->insert_cause_number($user_id,3);

                                        //$this->session->set_flashdata('third','this_is_3_cause');
                                        //redirect('survey/report_view');
                                    }
                                }
                            }
                            else
                            {
                            // when total annual income is greater then 18 lac
                                            $this->api_model->insert_cause_number($user_id,2);

                                //$this->session->set_flashdata('second','this_is_2_cause');
                                //redirect('survey/report_view');

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
                                            $this->api_model->insert_cause_number($user_id,2);

                                            //$this->session->set_flashdata('second','this_is_2_cause');
                                            //redirect('survey/report_view');
                                        }
                                        else
                                        {
                                            $this->api_model->insert_cause_number($user_id,3);

                                            // $this->session->set_flashdata('third','this_is_3_cause');
                                            // redirect('survey/report_view');
                                        }
                                    }
                                    else
                                    {
                                    // when pakka house is null or no choosen by user
                                            $this->api_model->insert_cause_number($user_id,3);

                                       // $this->session->set_flashdata('third','this_is_3_cause');
                                        //redirect('survey/report_view');
                                    }
                                }
                                else
                                {
                                //when salary is less than 18 lac but greter than 6 lac
                                    if(!empty($pakka_house))
                                    {
                                            $this->api_model->insert_cause_number($user_id,2);

                                        // $this->session->set_flashdata('second','this_is_2_cause');
                                        // redirect('survey/report_view');
                                    }
                                    else
                                    {
                                            $this->api_model->insert_cause_number($user_id,3);

                                        // $this->session->set_flashdata('third','this_is_3_cause');
                                        // redirect('survey/report_view');
                                    }
                                }
                            }
                            else
                            {
                            // when total annual income is greater then 18 lac
                                            $this->api_model->insert_cause_number($user_id,2);

                                // $this->session->set_flashdata('second','this_is_2_cause');
                                // redirect('survey/report_view');
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
                                            $this->api_model->insert_cause_number($user_id,2);

                                   /// $this->session->set_flashdata('second','this_is_2_cause');
                                    //redirect('survey/report_view');
                                }
                                else
                                {
                                    //in flow chart this is 2 or 4
                                            $this->api_model->insert_cause_number($user_id,4);

                                    //$this->session->set_flashdata('second','this_is_2_cause');
                                    //redirect('survey/report_view');
                                }
                            }
                            else
                            {

                                    // when pakka house is null or no choosen by user
                                    //ask to change location cause
                                            $this->api_model->insert_cause_number($user_id,2);

                                //$this->session->set_flashdata('fourth','this_is_4_cause');
                                //redirect('survey/report_view');
                            }
                        }
                        else
                        {
                                //when salary is less than 18 lac but greter than 6 lac
                            if(!empty($pakka_house))
                            {
                                            $this->api_model->insert_cause_number($user_id,2);

                                //$this->session->set_flashdata('second','this_is_2_cause');
                                //redirect('survey/report_view');
                            }
                            else
                            {
                                //ask to change location cause


                                            $this->api_model->insert_cause_number($user_id,4);

                                //$this->session->set_flashdata('fourth','this_is_4_cause');
                                //redirect('survey/report_view');
                            }
                        }
                    }
                    else
                    {
                            // when total annual income is greater then 18 lac
                                            $this->api_model->insert_cause_number($user_id,2);

                        //$this->session->set_flashdata('second','this_is_2_cause');
                        //redirect('survey/report_view');
                    }
                    //the case when town is manually added status =2;
                }
                $data=array('user_id'=>$user_id);
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message = 'SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,array($data));
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'TOWN OR MOZA NOT FOUND';
                $this->sendResponse($Code,$rescode,$Message);
            }
                $data=array('user_id'=>$user_id);
                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message = 'SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,array($data));
            // if(($total_income*12) > 1800000)
            //  //if('10000' == '1800000')
            // {
            //      //echo "asdfa".$total_income; die;
            //  $this->session->set_flashdata('eligible','You are not elligible for the survey');
            //      //$data['eligible'] = "YOU ARE NOT ELIGIBLE FOR THE SURVEY ";
            // }
            //  //echo "jbh"; die;
            // $this->session->set_flashdata('survey','Your Survey Is Completed Succesfully');
        }

    }
    public function contact_page_data($postDataArray)
    {
        $user_id = (isset($postDataArray->user_id) && !empty($postDataArray->user_id)) ? $postDataArray->user_id: ''; 
        if(empty($user_id))
        {

            $Code = ResponseConstant::UNSUCCESS;
            $rescode = ResponseConstant::UNSUCCESS;
            $Message = ResponseConstant::message('REQUIRED_PARAMETER');
            $this->sendResponse($Code,$rescode,$Message);
        }
        else
        {

            $response = $this->api_model->get_user_info($user_id);
            // echo $this->db->last_query(); die;
            if($response)
            {

                $Code = ResponseConstant::SUCCESS;
                $rescode = ResponseConstant::SUCCESS;
                $Message = 'SUCCESFULL';
                $this->sendResponse($Code,$rescode,$Message,$response);
            }
            else
            {
                $Code = ResponseConstant::UNSUCCESS;
                $rescode = ResponseConstant::UNSUCCESS;
                $Message = 'USER ID DOES NOT EXIST';
                $this->sendResponse($Code,$rescode,$Message);

            }
        }
    }
}
			