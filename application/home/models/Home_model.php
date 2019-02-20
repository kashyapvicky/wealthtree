<?php
  Class Home_model extends CI_Model
  {
  	public function check_phone_number($phone_number)
  	{
  		$this->db->select('*');
  		$this->db->where('phone_number',$phone_number);
  		$this->db->or_where('phone_number_2',$phone_number);
  		$query=$this->db->get('users');
  		return $query->row_array();
  	}
  	public function check_survey_status($phone_number,$id)
  	{
  		$this->db->select('survey_status,id,first_name');
  		$this->db->where('phone_number',$phone_number);
  		$this->db->or_where('id',$id);
  		$query = $this->db->get('users');
  		return $query->row_array();
  	}
	public function get_survey_status_by_user_id($id)
  	{
  		$this->db->select('survey_status');
  		$this->db->where('id',$id);
  		$query = $this->db->get('users');
  		return $query->row_array();
  	}
  	public function check_survey_status_with_pan_phone($phone_number,$pan_number)
  	{
  		$this->db->select('survey_status,id');
  		$this->db->where('phone_number',$phone_number);
  		$this->db->or_where('pan_number',$pan_number);
  		$query = $this->db->get('users');
  		return $query->row_array();
  	}
	public function check_pan_phone($phone_number,$pan_number)
	{
		$this->db->select('*');
		$this->db->where('phone_number',$phone_number);
		$this->db->or_where('pan_number',$pan_number);
		$query = $this->db->get('users');
		return $query->row_array();
	}
	public function insert_basic_data($data)
	{
		$this->db->insert('users',$data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	public function update_basic_data($data,$id)
	{
		// $this->db->insert('users',$data);
		// $insert_id = $this->db->insert_id();
		// return  $insert_id;
		$this->db->where('id',$id);
		$query = $this->db->update('users',$data);
		if($query)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function get_organisations()
	{
		$this->db->select('*');
		$query = $this->db->get('organisations');
		return $query->result_array();
	}
	public function check_basick_survey($user_id)
	{
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('user_basick_survey');
		return $query->row_array();
	}
	public function get_org_sectors()
	{
		$this->db->select('*');
		$query = $this->db->get('organisation_sector');
		return $query->result_array();
	}
	public function get_total_income($user_id)
	{
		$this->db->select('u.income,ubs.independent_wife,in.salary');
		$this->db->join('user_basick_survey as ubs','ubs.user_id=u.id','left');
		$this->db->join('independent_income as in','in.user_id=u.id','left');
		//$this->db->where('in.age <',18);
		$this->db->where('u.id',$user_id);
		$query = $this->db->get('users as u');
		return $query->result_array();
	}
	public function data_if_pan_exist($pan_number)
	{
		$this->db->select('*');
		$this->db->where('pan_number',$pan_number);
		$query = $this->db->get('users');
		return $query->row_array();
	}
	public function is_survey_completed($id)
	{
		$this->db->select('survey_status,first_name');
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->row_array();
	}
	public function get_faq_page_content()
	{
		$this->db->select('ft.id as tab_id,ft.name as tab_name,qes.id as qes_id,qes.name as qes_name,ans.id as ans_id, ans.name as ans_name');
		$this->db->join('faq_question as qes','qes.tab_id=ft.id','left');
		$this->db->join('faq_answer as ans','ans.question_id=qes.id','left');
		$query = $this->db->get('faq_tab as ft');
		return $query->result_array();
	}
	public function get_question_answer_by_tab_id($tabs_id)
	{
		$this->db->select('que.name as que_name,que.tab_id,que.id as que_id,ans.name as ans_name,ans.id as ans_id');
		$this->db->join('faq_answer as ans','ans.question_id=que.id','left');
		$this->db->where_in('que.tab_id',$tabs_id);
		$query = $this->db->get('faq_question as que');
		return $query->result_array();
	}
	public function get_like_question($name)
	{
		$this->db->select('faq_question.*,faq_answer.name as answer');
		$this->db->join('faq_answer','faq_answer.question_id=faq_question.id','left');
		$this->db->like('faq_question.name',$name,'both');
		$this->db->or_like('faq_answer.name',$name,'both');
		$query = $this->db->get('faq_question');
		return $query->result_array();
	}

  }

 ?> 
