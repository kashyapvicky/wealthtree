<?php
  Class Api_model extends CI_Model
  {
    public function check_survey_status($phone_number)
    {

      $this->db->select('u.id,u.first_name as name,u.survey_status,ubs.is_completed,u.income');
      $this->db->join('user_basick_survey as ubs','ubs.user_id=u.id','left');
      $this->db->where('u.phone_number',$phone_number);
      $this->db->or_where('u.phone_number_2',$phone_number);
      $query = $this->db->get('users as u');
      return $query->row_array();
    }

    public function get_detail_if_pan_exist($pan_number)
    {
      $this->db->select('*');
      $this->db->where('pan_number',$pan_number);
      $query = $this->db->get('users');
      return $query->row_array();
    }

    public function update_basic_data($phone_number_2,$id)
    {
      $this->db->where('id',$id);
      $this->db->set('phone_number_2',$phone_number_2);
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
    public function insert_basic_data($data)
    {
      $this->db->insert('users',$data);
      return $this->db->insert_id();
    }
    public function is_exist_phone_number($phone_number,$pan_number)
    {
      $this->db->select('id');
      $this->db->where('phone_number',$phone_number);
      $this->db->or_where('phone_number_2',$phone_number);
      $this->db->or_where('pan_number',$pan_number);
      $query = $this->db->get('users');
      return $query->row_array();
    }
    public function get_data($tabel,$column=null,$where=null,$flag=null)
    {
      if($flag == 'result_array_with_id')
      {
        $this->db->where($where);
        return $this->db->get($tabel)->result_array();
      }
      elseif($flag == 'result_array_not_id')
      {
        return $this->db->get($tabel)->result_array(); 
      }
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
    public function insert_first_survey_data($data)
    {
      $this->db->insert('user_basick_survey',$data);
      return $this->db->insert_id();
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
    public function que_ans_list($lang=null)
    {
      if($lang=='hin')
      {
        $this->db->select('q.id,q.name_hin as name,ans.op_a_hin as op_a,ans.op_b_hin as op_b,ans.op_c_hin as op_c,ans.op_d_hin as op_d');

      }
      else
      {
        $this->db->select('q.id,q.name,ans.op_a,ans.op_b,ans.op_c,ans.op_d');
        
      }
      $this->db->join('options as ans','ans.qn_id=q.id','left');
      $query = $this->db->get('questions as q');
      return $query->result_array();
    }
    public function insert_second_survey_data($data,$flag)
    {
      $this->db->insert($flag,$data);
      return $this->db->insert_id();
    }
    public function get_user_detail($user_id)
    {
      $this->db->where('id',$user_id);
      $this->db->select('id,first_name');
      $query = $this->db->get('users');
      return $query->result_array();
    }
    public function update_survey_data($user_id)
    {
      $this->db->where('id',$user_id);
      $this->db->set('survey_status',5);
      $this->db->update('users');
    }
    public function insert_query($data)
    {
      $this->db->insert('queries',$data);
      return $this->db->insert_id();
    }
    public function get_faq()
    {
      $this->db->select('ft.name as tab,fq.name as question,fa.name as answer');
      $this->db->join('faq_question as fq','fq.tab_id=ft.id','left');
      $this->db->join('faq_answer as fa','fa.question_id=fq.id','left');
      $query = $this->db->get('faq_tab as ft');
      return $query->result_array();
    }
    public  function get_case_number_with_salary($user_id)
    {
      $this->db->select('u.income,u.case_number,ubs.independent_wife,u.first_name');
      $this->db->join('user_basick_survey as ubs','ubs.user_id=u.id','left');
      $this->db->where('u.id',$user_id);
      $query = $this->db->get('users as u');
      return $query->row_array();
    }
    public function get_sibling_income_if_any($user_id)
    {
      $this->db->select_sum('salary');
      $this->db->where('user_id',28);
      $this->db->where('age<',18);
      $query =  $this->db->get('independent_income');
      $row =  $query->row_array();
      // print_r($row); die;
      return $row['salary'];
    }
    public function get_faq_tabs($lang=null)
    {
      return $this->db->get('faq_tab')->result_array();
    }
    public function get_question_answer($tab_id,$lang=null)
    {
      if($lang=='hin')
      {
        // echo"dfsdfsd";die;
        $this->db->select('fq.name_hin as question,fa.name_hin as answer');
      }
      else
      {

        $this->db->select('fq.name as question,fa.name as answer');
      }
      $this->db->join('faq_answer as fa','fa.question_id=fq.id','left');
      $this->db->where('fq.tab_id',$tab_id);
      $query = $this->db->get('faq_question as fq');
      return $query->result_array();

      // print_r( $query->result_array());
    }
    public function check_user_existence($user_id)
    {
      $this->db->where('id',$user_id);
      $query = $this->db->get('users');
      return $query->row_array();
    }
    public  function get_case_number_for_pdf_with_salary($user_id)
    {
      $this->db->select('u.income,u.dob,u.email,u.case_number,ubs.independent_wife,ubs.pakka_house,ubs.what_you_want,u.pan_number,u.first_name,m.status as moza_status,m.govt_list as moza_govt,m.notification as moza_notification,t.status as town_status,t.govt_list as town_govt,t.notification as town_notification,org.name as org');
      $this->db->join('user_basick_survey as ubs','ubs.user_id=u.id','left');
      $this->db->join('organisations  as org','org.id=u.org','left');
      $this->db->join('states as st','st.id=ubs.state_id','left');
      $this->db->join('cities as ct','ct.id=ubs.district_id','left');
      $this->db->join('town as t','t.id=ubs.town_id','left');
      $this->db->join('moza  as m','m.id=ubs.moza_id','left');
      $this->db->where('u.id',$user_id);
      $query = $this->db->get('users as u');
      return $query->row_array();
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
    public function insert_cause_number($user_id,$case_number)
    {
      $this->db->where('id',$user_id);
      $this->db->set('case_number',$case_number);
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
    public function get_user_info($user_id)
    {
      $this->db->where('id',$user_id);
      $this->db->select('id,first_name,phone_number,email');
      $query = $this->db->get('users');
      return $query->result_array();
    }

  }

?>