<?php
  Class Admin_model extends CI_Model
  {
  	public function admin_credentials($email,$password)
    {

      $this->db->select('*');
      $this->db->where('email',$email);
      $this->db->where('password',$password);
      $query = $this->db->get('admin');
      return $query->row_array();
    }
    public function chek_email($email)
    {
      $this->db->select('*');
      $this->db->where('email',$email);
      $query = $this->db->get('admin');
      return $query->row_array();

    }
    public function  update_password($id,$password)
    {
      $this->db->where('id',$id);
      $this->db->set('password',$password);
      $query = $this->db->update('admin');
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
