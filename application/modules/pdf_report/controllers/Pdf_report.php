<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_report extends MX_Controller {

	function __construct()
	{
		//echo CI_VERSION; die;
		//echo phpversion(); die;
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('pdf_report_model');
		if(empty($this->session->tempdata('user_id')))
		{


			//echo"<script>alert('not found')</script>";die;
			if(!$this->input->get('auth_user'))
			{
				//die('yahi gaya h');
				//redirect(base_url_custom);
				
			}
		}
		// else
		// {
			// $user_id = $this->session->tempdata('user_id');
			// $this->survey_model->update_survey_status_by_1($user_id);
			//echo"<script>alert('updated here')</script>";
		//}
	}

	public function index()
	{
		$user_id = $this->session->tempdata('user_id');
		echo "hello my testing";
		echo $user_id;
	}
	public function report_page_pdf()
	{
		$user_id = $this->session->tempdata('user_id');
		//die($user_id); 
		if(empty($user_id))
		{
			//echo"hello";die;
			$user_id = $this->input->get('auth_user');
			$this->session->set_flashdata('for_mob_pdf_user_id',$user_id);
			//echo $user_id; die;
		}
		//$user_id=5;
		$total_salary = $this->pdf_report_model->check_salary_total_count($user_id);
		//echo $this->db->last_query(); die;

		$username = $total_salary['first_name'];
		$this->session->set_flashdata('username',$username);
			//echo $user_id; 
		// echo $this->db->last_query(); die;
		 	//echo"<pre>";print_r($total_salary);die;

		$self_income = $total_salary['income'];
		//echo $self_income; die;
			 //echo "<br>";
		$wife_income = $total_salary['independent_wife'];
			   //echo "<br>";

		// $sibling_salary = 0;
		// foreach ($total_salary as $key => $value)
		// {
		// 	$sibling_salary+= $value['salary'];	
		// }
		$sibling_salary = $this->pdf_report_model->get_sibling_income_if_any($user_id);
		// print_r($sibling_salary); die;
			//echo"sb" .(int)$sibling_salary;die;
		$total_income = $self_income + $wife_income + (int)$sibling_salary;
		//echo $total_income; die;
		$total_annual_income = $total_income*12;
		// echo $total_annual_income; die;
		$this->session->set_flashdata('total_family_income',$total_annual_income);



		if($total_annual_income<=300000)
		{
			$this->session->set_flashdata('XXXX','2.67');
			$this->session->set_flashdata('ews','they are ews');
		}
		elseif($total_annual_income > 300000 && $total_annual_income <=600000)
		{
			$this->session->set_flashdata('XXXX','2.67');
			$this->session->set_flashdata('lig','they are lig');
		}
		elseif($total_annual_income > 600000 && $total_annual_income <=1200000)
		{
			$this->session->set_flashdata('XXXX','2.36');
			$this->session->set_flashdata('mig_1','they are mig_1');
		}
		elseif($total_annual_income >1200000 && $total_annual_income <=1800000)
		{
			$this->session->set_flashdata('XXXX','2.30');
			$this->session->set_flashdata('mig_2','they are mig_2');
		}
		else
		{
			$this->session->set_flashdata('XXXX','2.30');
			$this->session->set_flashdata('no_terms','do not show any terms and condition');
		}


		// to get details of the basick survey for report

		$basick_survey_row = $this->pdf_report_model->get_basick_survey_details($user_id);
		//print_r($basick_survey_row); die;
		$town_id = $basick_survey_row['town_id'];
		$moza_id = $basick_survey_row['moza_id'];
		$pakka_house = $basick_survey_row['pakka_house'];
		$what_you_want = $basick_survey_row['what_you_want']; 
		if(!empty($town_id))
		{
			//echo "helloo";die;

			$town_row = $this->pdf_report_model->get_town_data($town_id);
			//print_r($town_row); die;
			// check this town exist(status=1) in sheet or manually(status =2) added by user by its status
			$town_status = $town_row['status'];
			$notification = $town_row['notification'];
			if($town_status==1)
			{
				// the case when town exist in sheet status =1;
				$govt_list = $town_row['govt_list'];
				if($govt_list=='yes')
				{
					// exist in sheet and also in goverment list
					if($total_annual_income <=1800000)
					{
						if($total_annual_income <=600000)
						{
							if(!empty($pakka_house))
							{
								if($what_you_want==1 || $what_you_want==2)
								{
									// echo "2nd cause ";die('this 1');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('pdf_report/report_view');
								}
								else
								{
									//echo "1nd cause ";die;
									$this->session->set_flashdata('first','this_is_1_cause');
									redirect('pdf_report/report_view');
								}
							}
							else
							{
								// when pakka house is null or no choosen by user
								//echo "1nd cause ";die;
								$this->session->set_flashdata('first','this_is_1_cause');
								redirect('pdf_report/report_view');
							}
						}
						else
						{
							//when salary is less than 18 lac but greter than 6 lac
							if(!empty($pakka_house))
							{
								// echo "2nd cause ";die('this 2');
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('pdf_report/report_view');
							}
							else
							{
								// echo "1nd cause ";die;
								$this->session->set_flashdata('first','this_is_1_cause');
								redirect('pdf_report/report_view');
							}
						}
					}
					else
					{
						// echo "2nd cause ";die('this 3');
						// when total annual income is greater then 18 lac
						$this->session->set_flashdata('second','this_is_2_cause');
						redirect('pdf_report/report_view');

					}
				}
				else
				{
					//exist in sheet but not in goverment list
					if($notification=='yes')
					{
						//echo"notification yes";die;
						//echo $total_annual_income; die;
						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										// echo "2nd cause ";die('this 4');
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('pdf_report/report_view');
									}
									else
									{
										// echo "3nd cause ";die;
										$this->session->set_flashdata('third_yes','this_is_3_yes_cause');
										redirect('pdf_report/report_view');
									}
								}
								else
								{
									// echo "3d cause ";die;
									// when pakka house is null or no choosen by user
									//echo"before third_yes session";die;
									$this->session->set_flashdata('third_yes','this_is_3_yes_cause');
									redirect('pdf_report/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									// echo "2nd cause ";die('this 4');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('pdf_report/report_view');
								}
								else
								{
									// echo "3nd cause ";die;
									$this->session->set_flashdata('third_yes','this_is_3_yes_cause');
									redirect('pdf_report/report_view');
								}
							}
						}
						else
						{
						// when total annual income is greater then 18 lac
							// echo "2nd cause ";die('this 5');
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('pdf_report/report_view');

						}
					}// notification yes ends here
					elseif($notification=='no')
					{
						//pdf map word cause but its flow is as same as its if part

						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										// echo "2nd cause ";die('this 6');
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('pdf_report/report_view');
									}
									else
									{
										//echo "3nd cause ";die('this 7');
										$this->session->set_flashdata('third_no','this_is_3_no_cause');
										redirect('pdf_report/report_view');
									}
								}
								else
								{
									//echo "3nd cause ";die;
								// when pakka house is null or no choosen by user
									$this->session->set_flashdata('third_no','this_is_3_no_cause');
									redirect('pdf_report/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									//echo "2nd cause ";die('this 8');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('pdf_report/report_view');
								}
								else
								{
									//echo "3nd cause ";die;
									$this->session->set_flashdata('third_no','this_is_3_no_cause');
									redirect('pdf_report/report_view');
								}
							}
						}
						else
						{
							//echo "3nd cause ";die;
						// when total annual income is greater then 18 lac
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('pdf_report/report_view');
						}

					}//third no ends here
					else
					{
						//when notification is 'others'
						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										// echo "2nd cause ";die('this 6');
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('pdf_report/report_view');
									}
									else
									{
										//echo "3nd cause ";die('this 7');
										$this->session->set_flashdata('third_other','this_is_3_other_cause');
										redirect('pdf_report/report_view');
									}
								}
								else
								{
									//echo "3nd cause ";die;
								// when pakka house is null or no choosen by user
									$this->session->set_flashdata('third_other','this_is_3_other_cause');
									redirect('pdf_report/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									//echo "2nd cause ";die('this 8');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('pdf_report/report_view');
								}
								else
								{
									//echo "3nd cause ";die;
									$this->session->set_flashdata('third_other','this_is_3_other_cause');
									redirect('pdf_report/report_view');
								}
							}
						}
						else
						{
							//echo "3nd cause ";die;
						// when total annual income is greater then 18 lac
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('pdf_report/report_view');
						}
					}


				}
			}
			else
			{

				if($total_annual_income <=1800000)
				{
					if($total_annual_income <=600000)
					{
						if(!empty($pakka_house))
						{
							if($what_you_want==1 || $what_you_want==2)
							{
								//echo "2nd cause ";die('this 9');
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('pdf_report/report_view');
							}
							else
							{
									//echo $user_id;
									//echo $total_annual_income;
									//echo "2nd cause ";die('this 10');
								//in flow chart this is 2 or 4
								$this->session->set_flashdata('fourth','this_is_2_cause');
								redirect('pdf_report/report_view');
							}
						}
						else
						{
								//echo "4nd cause ";die;
								// when pakka house is null or no choosen by user
								//ask to change location cause
							$this->session->set_flashdata('fourth','this_is_4_cause');
							redirect('pdf_report/report_view');
						}
					}
					else
					{
							//when salary is less than 18 lac but greter than 6 lac
						if(!empty($pakka_house))
						{
							//echo "2nd cause ";die('this 11');
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('pdf_report/report_view');
						}
						else
						{
							//ask to change location cause


							//echo "4nd cause ";die;	
							$this->session->set_flashdata('fourth','this_is_4_cause');
							redirect('pdf_report/report_view');
						}
					}
				}
				else
				{
					// when total annual income is greater then 18 lac
					
					//echo "2nd cause ";die('this 12');
					$this->session->set_flashdata('second','this_is_2_cause');
					redirect('pdf_report/report_view');
				}
				//the case when town is manually added status =2;
			}
			
		}//if not empty town id block ends here
		elseif (!empty($moza_id))
		{
			$moza_row = $this->pdf_report_model->get_moza_data($moza_id);
			//$town_row = $this->survey_model->get_town_data($town_id);
			// check this town exist(status=1) in sheet or manually(status =2) added by user by its status
			$moza_status = $moza_row['status'];
			$notification = $moza_row['notification'];
			if($moza_status==1)
			{
				// the case when town exist in sheet status =1;
				$govt_list = $moza_row['govt_list'];
				if($govt_list=='yes')
				{
					// exist in sheet and also in goverment list
					if($total_annual_income <=1800000)
					{
						if($total_annual_income <=600000)
						{
							if(!empty($pakka_house))
							{
								if($what_you_want==1 || $what_you_want==2)
								{
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('pdf_report/report_view');
								}
								else
								{
									$this->session->set_flashdata('first','this_is_1_cause');
									redirect('pdf_report/report_view');
								}
							}
							else
							{
								// when pakka house is null or no choosen by user
								$this->session->set_flashdata('first','this_is_1_cause');
								redirect('pdf_report/report_view');
							}
						}
						else
						{
							//when salary is less than 18 lac but greter than 6 lac
							if(!empty($pakka_house))
							{
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('pdf_report/report_view');
							}
							else
							{
								$this->session->set_flashdata('first','this_is_1_cause');
								redirect('pdf_report/report_view');
							}
						}
					}
					else
					{
						// when total annual income is greater then 18 lac
						$this->session->set_flashdata('second','this_is_2_cause');
						redirect('pdf_report/report_view');

					}
				}
				else
				{
										//exist in sheet but not in goverment list
					if($notification=='yes')
					{
						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										// echo "2nd cause ";die('this 4');
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('pdf_report/report_view');
									}
									else
									{
										// echo "3nd cause ";die;
										$this->session->set_flashdata('third_yes','this_is_3_yes_cause');
										redirect('pdf_report/report_view');
									}
								}
								else
								{
									// echo "3d cause ";die;
									// when pakka house is null or no choosen by user
									$this->session->set_flashdata('third_yes','this_is_3_yes_cause');
									redirect('pdf_report/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									// echo "2nd cause ";die('this 4');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('pdf_report/report_view');
								}
								else
								{
									// echo "3nd cause ";die;
									$this->session->set_flashdata('third_yes','this_is_3_yes_cause');
									redirect('pdf_report/report_view');
								}
							}
						}
						else
						{
						// when total annual income is greater then 18 lac
							// echo "2nd cause ";die('this 5');
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('pdf_report/report_view');

						}
					}// notification yes ends here
					elseif($notification=='no')
					{
						//pdf map word cause but its flow is as same as its if part

						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										// echo "2nd cause ";die('this 6');
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('pdf_report/report_view');
									}
									else
									{
										//echo "3nd cause ";die('this 7');
										$this->session->set_flashdata('third_no','this_is_3_no_cause');
										redirect('pdf_report/report_view');
									}
								}
								else
								{
									//echo "3nd cause ";die;
								// when pakka house is null or no choosen by user
									$this->session->set_flashdata('third_no','this_is_3_no_cause');
									redirect('pdf_report/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									//echo "2nd cause ";die('this 8');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('pdf_report/report_view');
								}
								else
								{
									//echo "3nd cause ";die;
									$this->session->set_flashdata('third_no','this_is_3_no_cause');
									redirect('pdf_report/report_view');
								}
							}
						}
						else
						{
							//echo "3nd cause ";die;
						// when total annual income is greater then 18 lac
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('pdf_report/report_view');
						}

					}//third no ends here
					else
					{
						//when notification is 'others'
						if($total_annual_income <=1800000)
						{
							if($total_annual_income <=600000)
							{
								if(!empty($pakka_house))
								{
									if($what_you_want==1 || $what_you_want==2)
									{
										// echo "2nd cause ";die('this 6');
										$this->session->set_flashdata('second','this_is_2_cause');
										redirect('pdf_report/report_view');
									}
									else
									{
										//echo "3nd cause ";die('this 7');
										$this->session->set_flashdata('third_other','this_is_3_other_cause');
										redirect('pdf_report/report_view');
									}
								}
								else
								{
									//echo "3nd cause ";die;
								// when pakka house is null or no choosen by user
									$this->session->set_flashdata('third_other','this_is_3_other_cause');
									redirect('pdf_report/report_view');
								}
							}
							else
							{
							//when salary is less than 18 lac but greter than 6 lac
								if(!empty($pakka_house))
								{
									//echo "2nd cause ";die('this 8');
									$this->session->set_flashdata('second','this_is_2_cause');
									redirect('pdf_report/report_view');
								}
								else
								{
									//echo "3nd cause ";die;
									$this->session->set_flashdata('third_other','this_is_3_other_cause');
									redirect('pdf_report/report_view');
								}
							}
						}
						else
						{
							//echo "3nd cause ";die;
						// when total annual income is greater then 18 lac
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('pdf_report/report_view');
						}
					}
				}
			}
			else
			{

				if($total_annual_income <=1800000)
				{
					if($total_annual_income <=600000)
					{
						if(!empty($pakka_house))
						{
							if($what_you_want==1 || $what_you_want==2)
							{
								$this->session->set_flashdata('second','this_is_2_cause');
								redirect('pdf_report/report_view');
							}
							else
							{
								//in flow chart this is 2 or 4
								$this->session->set_flashdata('fourth','this_is_4_cause');
								redirect('pdf_report/report_view');
							}
						}
						else
						{

								// when pakka house is null or no choosen by user
								//ask to change location cause
							$this->session->set_flashdata('fourth','this_is_4_cause');
							redirect('pdf_report/report_view');
						}
					}
					else
					{
							//when salary is less than 18 lac but greter than 6 lac
						if(!empty($pakka_house))
						{
							$this->session->set_flashdata('second','this_is_2_cause');
							redirect('pdf_report/report_view');
						}
						else
						{
							//ask to change location cause



							$this->session->set_flashdata('fourth','this_is_4_cause');
							redirect('pdf_report/report_view');
						}
					}
				}
				else
				{
						// when total annual income is greater then 18 lac
					$this->session->set_flashdata('second','this_is_2_cause');
					redirect('pdf_report/report_view');
				}
				//the case when town is manually added status =2;
			}
		}
		else
		{
			echo"Error...!both moza and town does not exist";die;
		}
		// if(($total_income*12) > 1800000)
		// 	//if('10000' == '1800000')
		// {
		// 		//echo "asdfa".$total_income; die;
		// 	$this->session->set_flashdata('eligible','You are not elligible for the survey');
		// 		//$data['eligible'] = "YOU ARE NOT ELIGIBLE FOR THE SURVEY ";
		// }
		// 	//echo "jbh"; die;
		// $this->session->set_flashdata('survey','Your Survey Is Completed Succesfully');
	}
	
	public function report_view()
	{
		//echo phpversion(); die;
	// 	error_reporting(E_ALL);
	// 	ini_set('display_errors', 1);
		$this->load->library('m_pdf');
		 //$this->load->library('pdf');
		$user_id = $this->session->tempdata('user_id');
		if(empty($user_id))
		{
			$user_id = $this->session->flashdata('for_mob_pdf_user_id');
			//echo $user_id;
			
		}
		$user_info_row = $this->pdf_report_model->get_user_info($user_id);
		$data['user_info_row'] = $user_info_row;
		// echo"<pre>";print_r($user_info_row); die;
  		//$this->pdf->load_view('common/template');
		$html=$this->load->view('pdf_report_view',$data,'true');

		//$this->generate_pdf($x);
		//load mPDF library
		//load mPDF library
		//now pass the data//
		 // $this->data['title']="MY PDF TITLE 1.";
		 // $this->data['description']="";
		 // $this->data['description']=$this->official_copies;
		 //now pass the data //
 
		
		//$html=$this->load->view('pdf_output',$this->data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
 	 
		//this the the PDF filename that user will get to download
		//require(APPPATH.'/libraries/REST_Controller.php')
		 $path =  base_url_custom;
		 //echo $path; die;
		// $this_path =  $path."application/third_party";
		include(APPPATH.'third_party/mpdf/mpdf.php'); // including mpdf.php
		$mpdf=new mPDF();
		//$mpdf=new mPDF("en", "A4", "15");
		$pdf = $this->m_pdf->load();
		$stylesheet = file_get_contents($path.'css/pdf.css'); 
		//$stylesheet = '<style>'.file_get_contents($path'css/pdf.css');.'</style>';
		//echo $stylesheet; die;
		//die('hello');
		//header('Content-Type: text/html; charset=ISO-8859-1');
		// $this->mpdf->AddPage('L', // L - landscape, P - portrait
  //           '', '', '', '',
  //           30, // margin_left
  //           30, // margin right
  //           30, // margin top
  //           30, // margin bottom
  //           18, // margin header
  //           12); // margin footer
		 //$stylesheet1 = htmlentities('<style>'.$stylesheet.'<style/>');
		// print_r($stylesheet1); die;
		//$stylesheet1="<style>".$stylesheet."</style>";
		//print_r($stylesheet1); die;
		 $mpdf->WriteHTML($stylesheet,1);

		$pdfFilePath ="mypdfName-".time()."-download.pdf";
 
		
		//actually, you can pass mPDF parameter on this load() function
		//generate the PDF!
		$pdf->WriteHTML($html,2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		// $tpdf->WriteHTML(($html)->render(),2);
		$pdf->Output($pdfFilePath, "D");
		 


		//$html = $this->output->get_output();
		//$html = $this->load->view('pdf_report_view');
	




  // $this->pdf->render();
  // $this->pdf->stream("pdf_report_view.pdf");

		// $this->load->view('pdf_report_view',$data);
		// //$this->load->view('welcome_message');

		// //Get output html
		// $html = $this->output->get_output();

		// // Load pdf library
		

		// // Load HTML content
		// $this->dompdf->loadHtml($html);

		// // (Optional) Setup the paper size and orientation
		// $this->dompdf->setPaper('A4', 'landscape');

		// // Render the HTML as PDF
		// $this->dompdf->render();

		// // Output the generated PDF (1 = download and 0 = preview)
		// $this->dompdf->stream("detailed_report.pdf", array("Attachment"=>0));
	}
	public function generate_pdf($x)
	{
		$data['html']=$x;
		$this->load->view('demo',$data);
	}
	public function landing_page()
	{
		$user_id = $this->session->tempdata('user_id');
		$home_user_row = $this->pdf_report_model->get_homepage_data($user_id);
		$data['home_user_row']=$home_user_row;
		$data['page']='landing';
		_layout($data);
	}
	public function destroy_session()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
