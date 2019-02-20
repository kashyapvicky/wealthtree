<?php
  Class Faq_model extends CI_Model
  {
  	
    public function get_faqs($where=null)
    {
      $this->db->where($where);
      $this->db->select('ft.name as tab,fq.name as question,fq.id as qs_id,fa.name as answer');
      $this->db->join('faq_question as fq','fq.tab_id=ft.id','left');
      $this->db->join('faq_answer as fa','fa.question_id=fq.id','left');
      $query = $this->db->get('faq_tab as ft');
      return $query->result_array();
    }
    public function get_tabs()
    {
      return $this->db->get('faq_tab')->result_array();
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
    public function  get_qs_to_edit($qs_id)
    {
      $this->db->select('ft.id as tab_id,fq.name as question,fq.id as fq_id,fa.name as answer,fa.id as fa_id');
      $this->db->join('faq_tab as ft','ft.id=fq.tab_id','left');
      $this->db->join('faq_answer as fa','fa.question_id=fq.id','left');
      $this->db->where('fq.id',$qs_id);
      $query = $this->db->get('faq_question as fq');
      return $query->row_array();
    }

      public function update_faqs($tabel,$where,$data)
      {
        $this->db->where($where);
        $this->db->set($data);
        $query = $this->db->update($tabel);
        if($query)
        {
          return 1;
        }
        else
        {
          return 0;
        }
      }
      public function update_tab($tab_id,$name)
      {
        $this->db->where('id',$tab_id);
        $this->db->set('name',$name);
        $query = $this->db->update('faq_tab');
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
