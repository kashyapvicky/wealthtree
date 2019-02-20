<?php
  Class Org_model extends CI_Model
  {
  	
    public function get_data($tabel,$where)
    {
      return $this->db->get($tabel)->result_array();
    }
    public function insert_data($tabel,$where=null,$data)
    {
      $this->db->where($where);
      $this->db->insert($tabel,$data);
      return $this->db->insert_id();
    }
    public function delete($tabel,$where)
    {
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

    public function update_org($org_id,$name)
    {
      $this->db->where('id',$org_id);
      $this->db->set('name',$name);
      $query = $this->db->update('organisations');
      if($query)
      {
        return 1;
      }
      else
      {
        return 0;
      }
    }
    public function get_top_moza()
    {
      $this->db->select('moza_id,count(moza_id) as moza_count');
      $this->db->where('moza_id!=',0);
      $this->db->or_where('moza_id!=',NULL);
      $this->db->group_by('moza_id');
     $query =  $this->db->get('user_basick_survey');
     return $query->result_array();
    }
    public function get_top_town()
    {
      $this->db->select('town_id,count(town_id) as town_count');
      $this->db->where('town_id!=',0);
      $this->db->or_where('town_id!=',NULL);
      $this->db->group_by('town_id');
     $query =  $this->db->get('user_basick_survey');
     return $query->result_array();
    }
    public function get_top_name($tabel,$where_in)
    {
      //$this->db->select('name as moza');
      $this->db->where_in('id',$where_in);
     $query =  $this->db->get($tabel);
     return $query->result_array();
    }
  }
   
 ?> 
