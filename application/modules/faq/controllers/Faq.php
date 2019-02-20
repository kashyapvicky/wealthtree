<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MX_Controller {

	function __construct()
    {
		parent::__construct();
		if(!$this->session->userdata('authorized'))
		{
			//echo $this->session->userdata('authorized');die;
			redirect(base_url('admin'));
		}
		$this->load->library('form_validation');
		$this->load->model('faq_model');
	}

	public function index()
	{
		
		$where=array();
		$faqs = $this->faq_model->get_faqs($where);
		/*echo "<pre>";
		print_r($faqs);
		echo "</pre>";
		die('hello');*/
		$tabs = $this->faq_model->get_tabs();
		 // echo"<pre>";print_r($tabs); die;
		$data['tabs'] = $tabs;
		$data['faqs'] = $faqs;
		$data['page'] = 'faq_view';
		_layout_admin($data);
	}

	public function get_tab_data()
	{
		$tab_id = $this->input->post('tab_id');
		$where=array('ft.id'=>$tab_id);
		$data = $this->faq_model->get_faqs($where);
		$output='
		<tr>
		<th><strong>Question In English</strong></th>
		<td><strong>Question In Hindi</strong></td>
		<th><strong>Answrer In English</strong></th>
		<td><strong>Answer In Hindi</strong></td>
		<td><strong>Action</strong></td>
		</tr>
		';
		foreach ($data as $key => $value)
		{
			$output.=
			"
			</tr>
			<th>".$value['question']."</th>
			<td>".$value['question_hin']."</td>
			<th>".$value['answer']."</th>
			<td>".$value['answer_hin']."</td>
			<td>
			";
			if($value['qs_id'])
            {
            	$output.="
			<a href='".base_url('faq/edit_faq?id='.$value['qs_id'].'')."' class='btn btn-info'>Edit</a>
			<a href='".base_url('faq/delete_faq?id='.$value['qs_id'].'')."' class='btn btn-danger' onClick='return doconfirm();'>Delete</a>
			";
			}
			$output.="
			</td>
			</tr>
			";
		}
		echo json_encode($output);
	}
	public function add_question()
	{
		
		$this->form_validation->set_rules('faq_tab','Cateogry','required');
		$this->form_validation->set_rules('question','Question','required');
		$this->form_validation->set_rules('answer','Answer','required');
		$this->form_validation->set_rules('question_hindi','Question In Hindi','required');
		$this->form_validation->set_rules('answer_hindi','Answer In Hindi','required');
		if($this->form_validation->run()==TRUE)
		{
			/*$result=$this->input->post();
		    echo "<pre>";
		    print_r($result);
		    echo "</pre>";
		    die('hello');*/
			$where = array();
			$tab_id = $this->input->post('faq_tab');
			$question = $this->input->post('question');
			$answer = $this->input->post('answer');
			$question_hindi = $this->input->post('question_hindi');
			$answer_hindi = $this->input->post('answer_hindi');
			//$where = array('tab_id'=>$tab_id);
			$tabel='faq_question';
			$data =array('name'=>$question,'name_hin'=>$question_hindi,'tab_id'=>$tab_id);
			$question_id = $this->faq_model->insert_data($tabel,$where,$data);
			//$where = array('question_id',$question_id);
			$tabel='faq_answer';
			$data =array('name'=>$answer,'name_hin'=>$answer_hindi,'question_id'=>$question_id);
			$answer_id = $this->faq_model->insert_data($tabel,$where,$data);
			if($answer_id)
			{
				$this->session->set_flashdata('que_insert','Data Submitted Succesfully');
				redirect('faq');
			}
			else
			{
				$this->session->set_flashdata('que_insert','Error In Data Insertion');

			}

		}
		$tabs = $this->faq_model->get_tabs();
		 // echo"<pre>";print_r($tabs); die;
		$data['tabs'] = $tabs;
		$data['page'] = 'add_faq';
		_layout_admin($data);
	}
	public function add_tab()
	{
		$tab_name = $this->input->post('tab_name');
		$name_hin = $this->input->post('name_hin');
		$where = array();
		$tabel = 'faq_tab';
		$data=array('name'=>$tab_name,'name_hin'=>$name_hin);
		$tab_id = $this->faq_model->insert_data($tabel,$where,$data);
		if($tab_id)
		{
			$this->session->set_flashdata('tab_insert','Succesfully Inserted');
			redirect('faq');
		}
		else
		{
			$this->session->set_flashdata('tab_insert','Error In Insertion');
		}
		redirect('faq');
	}

	public function delete_faq()
	{
		$qs_id = $this->input->get('id');
		$where=array('id'=>$qs_id);
		$tabel='faq_question';
		$bool = $this->faq_model->delete($tabel,$where);
		// echo $this->db->last_query(); die;
		$where=array('question_id'=>$qs_id);
		$tabel='faq_answer';
		$bool = $this->faq_model->delete($tabel,$where);

		if($bool)
		{
			$this->session->set_flashdata('que_delete','Successfully Deleted');

		}
		else
		{
			$this->session->set_flashdata('que_delete','Error In Deletion');

		}
		redirect('faq');
	}
	public function edit_faq()
	{

		$this->form_validation->set_rules('faq_tab','Cateogry','required');
		if($this->form_validation->run()==TRUE)
		{
			$question_id = $this->input->post('qs_id');

			$tab_id = $this->input->post('faq_tab');
			$question = $this->input->post('question');
			$answer = $this->input->post('answer');
			$question_hin = $this->input->post('question_hin');
			$answer_hin = $this->input->post('answer_hin');
			/*echo $tab_id."<br>";
			echo $question."<br>";
			echo $answer."<br>";
			echo $question_hin."<br>";
			echo $answer_hin."<br>";
			die('hello');*/
         	$tabel = 'faq_question';
			$where=array('id'=>$question_id);
			$data = array('name'=>$question,'name_hin'=>$question_hin,'tab_id'=>$tab_id);
			$bool = $this->faq_model->update_faqs($tabel,$where,$data);

			$tabel = 'faq_answer';
			$where=array('question_id'=>$question_id);
			$data = array('name'=>$answer,'name_hin'=>$answer_hin);
			$bool = $this->faq_model->update_faqs($tabel,$where,$data);


			if($bool)
			{
				$this->session->set_flashdata('edit_succ','Succesfully Updated');
				redirect('faq');
			}
			else
			{
				$this->session->set_flashdata('edit_succ','Error In Updation');
			}

		}
		$qs_id= $this->input->get('id'); 
		$details = $this->faq_model->get_qs_to_edit($qs_id);

		// echo"<pre>";print_r($details); die;

		$tabs = $this->faq_model->get_tabs();

		$data['details'] = $details;
		$data['tabs'] = $tabs;
		$data['page'] = 'edit_faq';
		_layout_admin($data);

	}

	public function view_tab()
	{
		$tabs = $this->faq_model->get_tabs();
		 // echo"<pre>";print_r($tabs); die;
		$data['tabs'] = $tabs;
		// print_r($tabs); die;
		$data['page'] = 'tab_view';
		_layout_admin($data);

	}
	public function delete_tab()
	{
		$tab_id = $this->input->get('id');

		$where=array('id'=>$tab_id);
		$tabel='faq_tab';
		$bool = $this->faq_model->delete($tabel,$where);
		if($bool)
		{
			$this->session->set_flashdata('tab_deleted','Succesfully Deleted');
			
		}
		else
		{
			$this->session->set_flashdata('tab_deleted','Error In Deletion');


		}
		redirect('faq');

	}
	public function edit_tab()
	{
		$tab_id = $this->input->post('tab_id');
		$name = $this->input->post('tab_name');
		$name_hin = $this->input->post('name_hin');
		$data = array('name'=>$name,'name_hin'=>$name_hin);
		//print_r($data);
		//die('hello');
		$bool = $this->faq_model->update_tab($tab_id,$data);
		if($bool)
		{
			$this->session->set_flashdata('tab_edited','Succesfully Updated');
			
		}
		else
		{
			$this->session->set_flashdata('tab_deleted','Error In Updation');
		}
		redirect('faq');
	}
}
