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
  }
   
 ?> 
