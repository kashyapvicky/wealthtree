<?php
  Class Dashboard_model extends CI_Model
  {
  	public function admin_credentials($email,$password)
    {

      $this->db->select('*');
      $this->db->where('email',$email);
      $this->db->where('password',$password);
      $query = $this->db->get('admin');
      return $query->row_array();
    }

    public function get_stat()
    {
      $total_user = $this->db->count_all('users');

      $this->db->where('level',2);
      $level1 = $this->db->count_all_results('admin');


      $this->db->where('level',3);
      $level2 = $this->db->count_all_results('admin');


      $queries = $this->db->count_all('queries');

      $questions = $this->db->count_all('faq_question');

      $data=array('total_user'=>$total_user,
        'level1'=>$level1,
        'level2'=>$level2,
        'queries'=>$queries,
        'questions'=>$questions

    );
      return $data;

    }
  }

 ?> 
