<?php
  Class Subadmin_model extends CI_Model
  {
  	public function insert_admin_data($data)
    {
      $this->db->insert('admin',$data);
      return $this->db->insert_id();
    }
    public function get_admins()
    {
      $this->db->select('*');
      $this->db->where('level',2);
      $this->db->or_where('level',3);
      $query = $this->db->get('admin');
      return $query->result_array();
    }

    public function get_admin_data_to_edit($id)
    {
      $this->db->select('*');
      $this->db->where('id',$id);
      $query = $this->db->get('admin');
      return $query->row_array();
    }
    public function update_admin_data($id,$data)
    {
      $this->db->where('id',$id);
      $query = $this->db->update('admin',$data);
      //echo $this->db->last_query(); die;
      if($query)
      {
        return 1;
      }
      else{
        return 0;
      }

    }
    public function delete_admin($id)
    {
      $this->db->where('id',$id);
      $query = $this->db->delete('admin');
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
