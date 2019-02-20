<?php
  Class Query_model extends CI_Model
  {
  	public function get_data($tabel=null,$column=null,$where=null,$flag=null)
  	{
  		//echo $flag; die;
  		if($flag=='result_array')
  		{
  			//echo"reult";die;

  			$this->db->where($where);
	  		$query = $this->db->get($tabel);
	  		return $query->result_array();
  		}
  		elseif($flag=='row_array')
  		{
  			//echo"row";die;
  			$this->db->where($where);
  			$this->db->select('*');
  			$query = $this->db->get($tabel);
  			return $query->row_array();

  		}
  	}
  	public function get_admin_list()
  	{

  		$this->db->where('level',2);
  		$this->db->or_where('level',3);
  		$query = $this->db->get('admin');
  		return $query->result_array();

  	}
    public function assign_admin_to_query($query_id,$admin_id)
    {
      $this->db->where('id',$query_id);
      $this->db->set('assiagn_to',$admin_id);
      $this->db->set('assigned_on',date('y-m-d'));
      $query = $this->db->update('queries');
      if($query)
      {
        return 1;
      }
      else
      {
        return 0;
      }
    }
    public function get_assigned_query_data($query_id)
    {
      $this->db->where('qr.id',$query_id);
      $this->db->select('qr.name,qr.assigned_on,qr.generated_on,qs.solution,qr.id,qr.email,qr.phone_number,qr.query,qr.timestamp,adm.name as admin,adm.level,qs.status');
      $this->db->join('admin as adm','adm.id=qr.assiagn_to','left');
      $this->db->join('query_solution as qs','qs.query_id=qr.id','left');
      $query = $this->db->get('queries as qr');
      return $query->row_array();
    }
    public function insert_data($tabel=null,$data)
    {
      $this->db->insert($tabel,$data);
      return $this->db->insert_id();
    }
    public function update_query_as_responded($query_id)
    {
      $this->db->where('id',$query_id);
      $this->db->set('status',2);
      $this->db->update('queries');
    }
  }

 ?> 
