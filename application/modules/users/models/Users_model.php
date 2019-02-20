<?php
  Class Users_model extends CI_Model
  {
  	public function admin_credentials($email,$password)
    {

      $this->db->select('*');
      $this->db->where('email',$email);
      $this->db->where('password',$password);
      $query = $this->db->get('admin');
      return $query->row_array();
    }
    public function get_all_users()
    {
      $this->db->select('users.*,ubs.is_completed,org.name as org');
      $this->db->join('user_basick_survey as ubs','ubs.user_id=users.id','left');
      $this->db->join('organisations as org','org.id=users.org','left');
      $this->db->group_by('users.id');
      $query = $this->db->get('users');
      return $query->result_array();
    }
    public function get_all_counts()
    {
      $this->db->select('count(id) as total_user,count(CASE WHEN users.case_number = 1 OR users.case_number=3 then 1 ELSE NULL END) as eligible,count(CASE WHEN users.case_number=2 OR users.case_number=4 then 1 ELSE NULL END) as not_eligible');
      $query = $this->db->get('users');
      return $query->row_array();
    }
    public function get_user_info($user_id)
    {

      $this->db->select('u.*,org.name as org,psu.name as psu,ubs.independent_wife as wife_income,st.name as state,ct.name as district,m.name as moza,t.name as town');
      $this->db->join('organisations as org','org.id=u.org','left');
      $this->db->join('organisation_sector as psu','psu.id=u.psu','left');
     // $this->db->join('independent_income as ind_inc','ind_inc.user_id=u.id','left');
      $this->db->join('user_basick_survey as ubs','ubs.user_id=u.id','left');
      $this->db->join('states as st','st.id=ubs.state_id','left');
      $this->db->join('cities as ct','ct.id=ubs.district_id','left');
      $this->db->join('town as t','t.id=ubs.town_id','left');
      $this->db->join('moza as m','m.id=ubs.moza_id','left');

     // $this->db->where('ind_inc.age',17);
      $this->db->where('u.id',$user_id);
      $query = $this->db->get('users as u');
      return $query->row_array();
    }
    public function get_first_survey_details($user_id)
    {
      $this->db->select('u.id as user_id,ubs.pakka_house,ubs.what_you_want,states.name as state,cities.name as district,town.name as town,nearest_city.name as nearest_city,moza.name as moza,u.first_name');
      $this->db->join('user_basick_survey as ubs','ubs.user_id=u.id','left');
      $this->db->join('states','states.id=ubs.state_id','left');
      $this->db->join('cities','cities.id=ubs.district_id','left');
      $this->db->join('town','town.id=ubs.town_id','left');
      $this->db->join('nearest_city','nearest_city.id=ubs.ncity_id','left');
      $this->db->join('moza','moza.id=ubs.ncity_id','left');
      $this->db->where('u.id',$user_id);
      $query = $this->db->get('users as u');
      return $query->row_array();
    }
    public function user_second_survey_details($user_id)
    {
      $this->db->select('qn_id');
      $this->db->where('user_id',$user_id);
      $query = $this->db->get('op_a');
      $options['op_a'] =  $query->result_array();

      $this->db->select('qn_id');
      $this->db->where('user_id',$user_id);
      $query = $this->db->get('op_b');
      $options['op_b'] =  $query->result_array();

      $this->db->select('qn_id');
      $this->db->where('user_id',$user_id);
      $query = $this->db->get('op_c');
      $options['op_c'] =  $query->result_array();

      $this->db->select('qn_id');
      $this->db->where('user_id',$user_id);
      $query = $this->db->get('op_d');
      $options['op_d'] =  $query->result_array();
      return $options;
    }
    public function get_question_answer($qn_ids,$column_name)
    {
      $this->db->select('qn.name,options.'.$column_name.'');
      $this->db->join('questions as qn','qn.id=options.qn_id');
      $this->db->where_in('qn_id',$qn_ids);
      $query = $this->db->get('options');
      return $query->result_array();

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
        // $this->db->join('organisations as org','org.id=users.org','left');
        return $this->db->get($tabel)->result_array(); 
      }
    }
    public function filterd_user($where)
    {
       // echo $place; die;
      // print_r($or_where); die;
      $this->db->where($where);
      $this->db->select('u.id,u.first_name,u.email,u.survey_status,u.case_number,u.date_modified,ubs.is_completed,org.name as org');
    
     $this->db->join('organisations as org','org.id=u.org','left');
     // if($ubs)
     // {

     //  $this->db->join('user_basick_survey as ubs','ubs.user_id=u.id');
      
     // }
     // else
     // {
      $this->db->join('user_basick_survey as ubs','ubs.user_id=u.id','left');
     // }
     // if($place)
     // {

       $this->db->join('town as t','t.id=ubs.town_id','left');
       $this->db->join('moza as m','m.id=ubs.moza_id','left');
     // }
     $this->db->group_by('u.id');
     $query = $this->db->get('users as u');
     return   $query->result_array();
       // echo $this->db->last_query(); die;
    // echo "<pre>"; print_r($result); die;
    }
    public function del_user($tabel,$where)
    {
      //echo"hello";die;
      $this->db->where($where);
      $query = $this->db->delete($tabel);
      if($query)
      {
        return 1;
      }
      else
      {
        return 0;
      }
    }
    public function delete_dataa($tabel,$where)
    {
     // echo"sfdvdsdsffd";die;
      $this->db->where($where);
      $query = $this->db->delete($tabel);
      if($query)
      {
        return 1;
      }
      else
      {
        return 0;
      }
    }
    public function updte_data($tabel,$where,$set)
    {
      $this->db->where($where);
      $this->db->set($set);
     $query =  $this->db->update($tabel);
     if($query)
     {
      return 1;
     }
     else
     {
      return 0;
     }
    }
    public function get_chideren_detail($user_id)
    {
      $this->db->where('user_id',$user_id);
      $query = $this->db->get('independent_income');
      return $query->result_array();


    }
    public function get_sibling_income($user_id)
    {
      $this->db->where('user_id',$user_id);
      $this->db->where('ind_inc.age',17);
      $this->db->select('ind_inc.id,sum(ind_inc.salary) as sib_income');
      $query  = $this->db->get('independent_income as ind_inc');
      return $query->row_array();

    }



  }

 ?> 
