<?php
  Class Pdf_report_model extends CI_Model
  {
  	public function get_states()
  	{
  		$this->db->select('*');
  		$this->db->where('country_id',101);
  		$query = $this->db->get('states');
  		return $query->result_array();
  	}
  	public function get_city_by_state_id($state_id)
  	{
  		$this->db->select('*');
  		$this->db->where('state_id',$state_id);
  		$query = $this->db->get('cities');
  		return $query->result_array();
  	}
  	public function insert_son($age,$salary,$user_id)
  	{
  		$data = array(
  			'user_id'=>$user_id,
  			'name'=>'son',
  			'age'=>$age,
  			'salary'=>$salary,

  		);
  		$this->db->insert('independent_income',$data);
  	}
  	public function insert_daughter($age,$salary,$user_id)
  	{
  		$data = array(
  			'user_id'=>$user_id,
  			'name'=>'daughter',
  			'age'=>$age,
  			'salary'=>$salary,

  		);
  		$this->db->insert('independent_income',$data);
  		return $this->db->insert_id();
  	}
  	public function insert_basick_survey_data($data)
  	{
  		$this->db->insert('user_basick_survey',$data);
  		return $this->db->insert_id();
  	}
  	public function get_question_and_option()
  	{
  		$this->db->select('qn.name qn_name,qn.id as qn_id,options.op_a,options.op_b,options.op_c,options.op_d');
  		$this->db->join('options','options.qn_id=qn.id','left');
  		$query = $this->db->get('questions as qn');
  		return $query->result_array();
  	}
  	public function op_a_data($data)
  	{
  		$this->db->insert('op_a',$data);
  		return $this->db->insert_id();
  	}
  	public function op_b_data($data)
  	{
  		$this->db->insert('op_b',$data);
  		return $this->db->insert_id();
  	}

  	public function insert_options($option_a_array,$option_b_array,$option_c_array,$option_d_array)
  	{

  		$this->db->trans_start();
  		if(!empty($option_a_array))
  		{
  		$this->db->insert('op_a',$option_a_array);
  		}
  		if(!empty($option_b_array))
  		{
  			$this->db->insert('op_b',$option_b_array);
  		}
  		if(!empty($option_c_array))
  		{
  		$this->db->insert('op_c',$option_c_array);
  		}
  		if(!empty($option_d_array))
  		{
  			$this->db->insert('op_d',$option_d_array);
  		}
  		$this->db->trans_complete();
  		if ($this->db->trans_status() === FALSE)
		{
        	echo"<script>alert('trans_error')</script>";die;
		}
		else
		{
			$this->db->set('is_survey',4);
			$this->db->where('id',$user_id);
			$query = $this->db->update('users');
			if($query)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}

  	}
  	public function insert_op_a($data)
  	{
  		$this->db->insert('op_a',$data);
  		return $this->db->insert_id();
  	}
  	public function insert_op_b($data)
  	{
  		$this->db->insert('op_b',$data);
  		return $this->db->insert_id();
  	}
  	public function insert_op_c($data)
  	{
  		$this->db->insert('op_c',$data);
  		return $this->db->insert_id();
  	}
  	public function insert_op_d($data)
  	{
  		$this->db->insert('op_d',$data);
  		return $this->db->insert_id();
  	}
  	public function update_survey_status($user_id)
  	{
		$this->db->set('survey_status',5);
		$this->db->where('id',$user_id);
		$query = $this->db->update('users');
		if($query)
		{
			return 1;
		}
		else
		{
			return 0;
		}
  	}
    public function update_survey_status_by_1($user_id)
    {
        $this->db->where('id',$user_id);
        $this->db->set('survey_status', 'survey_status+1', FALSE);
        $query = $this->db->update('users');
        if($query)
        {
          return 1;
        }
        else
        {
          return 0;
        }
    }
    public function check_salary_total_count($user_id)
    {
      $this->db->select('u.income,ubs.independent_wife,u.first_name');
      $this->db->join('user_basick_survey as ubs','ubs.user_id=u.id','left');
      // $this->db->join('independent_income as in','in.user_id=u.id','left');
      // $this->db->where('in.age <',18);
      //$this->db->or_where('in.age',Null);
      $this->db->where('u.id',$user_id);
      $query = $this->db->get('users as u');
      return $query->row_array();
    }
    public function get_sibling_income_if_any($user_id)
    {
      $this->db->select_sum('salary');
      $this->db->where('user_id',$user_id);
      $this->db->where('age<',18);
     $query =  $this->db->get('independent_income');
     $row =  $query->row_array();
    // print_r($row); die;
     return $row['salary'];
    }
    public function insert_town_data($data)
    {
      $this->db->insert('town',$data);
      return $this->db->insert_id();
    }
    public function insert_moza_data($data)
    {
      $this->db->insert('moza',$data);
      return $this->db->insert_id();
    }
    public function check_town_already_exist($town_name)
    {
      $this->db->select('id');
      $this->db->where('name',$town_name);
      $query = $this->db->get('town');
      return $query->row_array();
    }
    public function check_moza_already_exist($moza_name)
    {
      $this->db->select('id');
      $this->db->where('name',$moza_name);
      $query = $this->db->get('moza');
      return $query->row_array();
    }
    public function get_town_by_city_id($city_id)
    {
      $this->db->select('*');
      $this->db->where('city_id',$city_id);
      $this->db->where('status',1);
      $query = $this->db->get('town');
      return $query->result_array();
    }
    public function get_nearest_city_for_popup($state_id)
    {
      $this->db->select('*');
      $this->db->where('state_id',$state_id);
     $query =  $this->db->get('nearest_city');
     return $query->result_array();
    }
    public function get_moza_by_nearser_city_id($ncity_id)
    {
      $this->db->select('*');
      $this->db->where('ncity_id',$ncity_id);
      $query = $this->db->get('moza');
      return $query->result_array();

    }
    public function get_user_income($user_id)
    {
      $this->db->select('income');
      $this->db->where('id',$user_id);
     $query =  $this->db->get('users');
     return $query->row_array();
    }
    public function get_basick_survey_details($user_id)
    {
      $this->db->where('user_id',$user_id);
      $this->db->select('*');
     $query =  $this->db->get('user_basick_survey');
     return $query->row_array();
    }
    public function get_town_data($town_id)
    {
      $this->db->where('id',$town_id);
      $this->db->select('*');
     $query =  $this->db->get('town');
     return $query->row_array();
    }
    public function get_moza_data($moza_id)
    {
      $this->db->where('id',$moza_id);
      $this->db->select('*');
     $query =  $this->db->get('moza');
     return $query->row_array();
    }
    public function get_user_info($user_id)
    {
      $this->db->select('u.id,u.first_name,u.middle_name,u.dob,u.phone_number,u.pan_number,u.email,ubs.pakka_house,ubs.what_you_want,ubs.timestamp,org.name as organisation,os.name as sector,st.name as state,ct.name as district,mz.name as moza,mz.notification_no as moza_notification,mz.dated as moza_dated,tn.name as town,tn.notification_no as town_notification,tn.dated as town_dated');
      $this->db->join('user_basick_survey as ubs','ubs.user_id=u.id','left');
      $this->db->join('organisations as org','org.id=u.org','left');
      $this->db->join('organisation_sector as os','os.id=u.psu','left');
      $this->db->join('states as st','st.id=ubs.state_id','left');
      $this->db->join('cities as ct','ct.id=ubs.district_id','left');
      $this->db->join('moza as mz','mz.id=ubs.moza_id','left');
      $this->db->join('town as tn','tn.id=ubs.town_id','left');
      $this->db->where('u.id',$user_id);
      $query = $this->db->get('users as u');
      return $query->row_array();



    }
    public function get_homepage_data($user_id)
    {
      $this->db->select('*');
      $this->db->where('id',$user_id);
      $query = $this->db->get('users');
      return $query->row_array();
    }

  }


 ?> 
