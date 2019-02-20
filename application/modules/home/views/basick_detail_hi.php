<!-- <style type="text/css">
 #submit_form.disabled:hover {
    cursor:not-allowed
 }	

</style> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
    	maxDate: "-0",
    	minDate: new Date(1960, 1 - 1, 1),
    	yearRange: "1980:2020",
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>
<?php echo $this->session->flashdata('basick_error');?>
<?php echo  validation_errors();?>
<section class="basicdetail-wraper">
	<div class="partner-organisation-hder">
		<h1 class="border-center-hding">अपना मूल विवरण दर्ज करें</h1>
	</div>
	<div class="container">
		<div class="basic-formWraper">
			<div class="row">
				<form method="post" action="<?php echo base_url()?>home/insert_basick_detail">
					<input type="hidden" id="hidden_id" name="hidden_id">
					<div class="col-md-6 col-sm-6">
						<div class="pan-form-row basic-panform-row">
							<label>पैन नंबर<sup>*</sup></label>
							<input type="text" onblur="is_exist();" name="pan_number" id="pan_number" class="formfull-row" placeholder="अपना पैन नंबर डालें" autocomplete="off" required>
						</div>
					</div>					
					<div class="col-md-6 col-sm-6">
						<div class="first-namebx">
							<label>पहला नाम<sup>*</sup></label>
							<input type="text" name="first_name" id="first_name" class="formfull-row" placeholder="अपना पहला नाम दर्ज करें" autocomplete="off" required>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="first-namebx email-bx">
							<label>मध्य नाम</label>
							<input type="text" name="middle_name" id="middle_name" class="formfull-row" placeholder="अपना मध्य नाम दर्ज करें" autocomplete="off" >
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="first-namebx last-namebx">
							<label>अंतिम नाम<sup>*</sup></label>
							<input type="text" name="last_name" id="last_name" class="formfull-row" placeholder="अपना अंतिम नाम दर्ज करें" autocomplete="off" required>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="first-namebx dob-bx">
							<label>जन्म तिथि<sup>*</sup></label>
							<input type="text" name="dob" class="formfull-row" placeholder="DD / MM / YYYY" id="datepicker" autocomplete="off" required />
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="first-namebx email-bx">
							<label>ईमेल</label>
							<input type="email" name="email" id="email" class="formfull-row" placeholder="अपना ईमेल दर्ज करें" autocomplete="off" >
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="genderbox">
							<label>लिंग</label>
							<div class="row">
								<div class="col-md-4 col-sm-4 bd-radio">
									<input type="radio" id="test4" value="male" name="gender">
									<label for="test4">पुरुष</label>
								</div>
								<div class="col-md-4 col-sm-4 bd-radio">
									<input type="radio" id="test5" value="female" name="gender">
									<label for="test5">महिला</label>
								</div>
								<div class="col-md-4 col-sm-4 bd-radio">
									<input type="radio" id="test6" value="transgender" name="gender">
									<label for="test6">ट्रांसजेंडर</label>
								</div>
							</div>
						</div>

						<!-- <div class="workingbox">
							<label>Occupation</label>
							<div class="row">
								<div class="col-md-4 bd-radio">
									<input type="radio" id="test7" name="working" value="working" checked="">
									<label for="test7">Self Working</label>
								</div>
								<div class="col-md-4 bd-radio">
									<input type="radio" id="test8" value="salaried" name="working">
									<label for="test8">Salaried</label>
								</div>
							</div>
						</div> -->
					</div>
 					

 					<div class="col-md-12 col-sm-12">
						<div class="salary-box">
							<label>आय / वेतन (मासिक)<sup>*</sup></label>
							<input type="number" name="income" id="income" class="formfull-row" placeholder="अपनी आय / वेतन दर्ज करें" required autocomplete="off">
						</div>
					</div>

					
					<div class="col-md-6 col-sm-6">
							<div class="slect-row">
								<select name="org" id="org" class="formfull-row">
									<option disabled selected value="">संगठनों<sup></sup></option>
									<?php
									if(!empty($organisation_for_basick_details))
									{
										foreach ($organisation_for_basick_details as $key => $value)
										{
											echo"<option value='".$value['id']."'>".$value['name']."";
										}
									}
									?>
								</select>
							</div>
					</div>

					<div class="col-md-6 col-sm-6">
						<div class="slect-row">
							<select name="psu" id="psu"  class="formfull-row">
								<option disabled selected value="">सार्वजनिक क्षेत्र के उपक्रम (PSU)<sup></sup></option>
								<?php
								if(!empty($sectors))
								{
									foreach ($sectors as $key => $value)
									{

										echo"<option value='".$value['id']."' >".$value['name']."</option>";
									}
								}
								?>
							</select>
						</div>
					</div>



					<!-- <div class="salaryChangeBox" style="display: none">
						<div class="col-md-6 col-sm-6">
							<div class="slect-row">
								<select name="org" id="org" class="formfull-row">
									<option disabled selected value="">Organisations</option>
									<?php
									if(!empty($organisation_for_basick_details))
									{
										foreach ($organisation_for_basick_details as $key => $value)
										{
											echo"<option value='".$value['id']."'>".$value['name']."";
										}
									}
									?>
								</select>
							</div>
						</div>
						 <div class="col-md-6 col-sm-6">
							<div class="slect-row">
								<select name="psu" id="psu"  class="formfull-row">
									<option disabled selected value="">Public Sector Undertakings (PSU)</option>
									<?php
									if(!empty($sectors))
									{
										foreach ($sectors as $key => $value)
										{

											echo"<option value='".$value['id']."' >".$value['name']."</option>";
										}
									}
									?>
								</select>
							</div>
						</div> 
					</div>  -->




					<!-- <div class="col-md-12">
						<div class="captcha-box">
							<label>Enter Captcha</label>
							<div class="captcha-input-box">
								<div><input type="text" name="sum1" id="sum1" value="<?php echo rand(0,9)?>" class="captcha"><span>+</span></div>
								<div><input type="text" name="sum2" id="sum2" value="<?php echo rand(0,9)?>" class="captcha"><span>=</span></div>
								<div><input type="text" id="captcha_result" name="captcha_result" value="" class="captcha"></div>
							</div>
						</div>
					</div> -->
					<div class="formbtn-box">
						<input type="submit" id="submit_form" name="submit" value="सबमिट " class="form-btn">
					</div>
				</form>
			</div>
			<p style="width: 100%; float: left; clear: both; font-size: 19px; position: relative; left: 0%; padding: 0 0px 0 24px;"><span style="color: red; font-size: 60px; position: absolute; top: -17px; left: 0;">*</span>खेत अनिवार्य हैं</p>
		</div>
	</div>
</section>
	<script src="<?php echo base_url_custom;?>js/dcalendar.picker1.js"></script>
<script>
// $(document).ready(function() {
// 	var n1 = parseInt($('#sum1').val());
// 	var n2 = parseInt($('#sum2').val());
// 	 var r = n1 + n2;
// 	 console.log(r);
//      $('#submit_form').prop('disabled',true);
//      $('#captcha_result').keyup(function() {
     	
//         if($('#captcha_result').val() == r) {
//            $(':input[type="submit"]').prop('disabled', false);
//         }
//      });
//  });
</script>

<script>
$('#datedemo').dcalendarpicker();
$('#calendar-demo').dcalendar(); //creates the calendar
</script>

<!-- 
<script>
if($('#test8').is(':checked'))
{
	alert('hello sir');
	// $('#org_and_psu').show();
}
</script>
<script>
if($('#org_and_psu').css('display')=='none')
{
	//alert('hello');
	document.getElementById("org_select").required = false;
	document.getElementById("psu_select").required = false;
	// $('#org_select').removeAttr('required');​​​​​
	// $('#psu_select').removeAttr('required');​​​​​
}	
</script> -->
<script>

$('.salaryChangeBox').hide();
$("input[name=working]:radio").click(function () {
if ($('input[name=working]:checked').val() == "working") {
       	$('.salaryChangeBox').hide();
       	$('#org').removeAttr('required');
       	$('#psu').removeAttr('required');
}
else if ($('input[name=working]:checked').val() == "salaried") {
       $('.salaryChangeBox').show();
       $('#org').prop('required',true);
       $('#psu').prop('required',true);
    
 }
});
</script>

<script>

	// function to check pan number existed in database or not
function is_exist()
{
	//alert('onblur function');
	var pan_number = $("#pan_number").val();
	$.ajax({
	type: "POST",
	url: "<?php echo base_url(); ?>" + "home/get_data_if_pan_exist",
	dataType: "json",
	data: {pan_number:pan_number},
	success: function(data){
			// $("#subsidy_pmay").val(data.subsidy);
			// $("#emi").val(data.emi);
			// $("#percentage").val(data.percentage);
			// $("#total_saving").val(data.total_saving);
			// $("#without_pmay_id").val(data.EMIBank);
			// $("#pmay_in_t_year").val(data.pmay_in_t_year);
			// $("#without_pmay_in_t_year").val(data.without_pmay_in_t_year);
			// $("#subsidy_without_pmay").val(0);
			//alert(data.id);
			if(data ==1)
			{

				console.log('pan number is new');
				$("#first_name").val('');
				$('#first_name').prop('readonly',false);
				$("#middle_name").val('');
				$('#middle_name').prop('readonly', false);
				$("#last_name").val('');
				$('#last_name').prop('readonly', false);
				$("#datedemo").val('');
				$('#datedemo').prop('readonly', false);
				$("#email").val('');
				$('#email').prop('readonly', false);
				$("#income").val('');
				$('#income').prop('readonly', false);
				$("#org").val('');
				$("#org").prop('readonly', false);
				$("#psu").val('');
				$("#psu").prop('readonly', false);
			}
			else
			{


				if(data.id)
				{
					$("#hidden_id").val(data.id);
					//$("#hidden_id").prop('disabled', true);
				}
				if(data.first_name)
				{
					$("#first_name").val(data.first_name);
					$('#first_name').prop('readonly', true);
				}
				if(data.middle_name)
				{
					$("#middle_name").val(data.middle_name);
					$('#middle_name').prop('readonly', true);
				}
				if(data.last_name)
				{
					$("#last_name").val(data.last_name);
					$('#last_name').prop('readonly', true);
				}
				if(data.dob)
				{
					$("#datedemo").val(data.dob);
					$('#datedemo').prop('readonly', true);
				}
				if(data.email)
				{
					$("#email").val(data.email);
					$('#email').prop('readonly', true);
				}
				// if(data.gender)
				// {
				// 	$("nameemail").val(data.gender);
				// 	$("#email").prop('disabled', true);
				// }
				if(data.income)
				{
					$("#income").val(data.income);
					$('#income').prop('readonly', true);
				}
				if(data.org)
				{
					$("#org").val(data.org);

					$("select :selected").each(function(){
					$(this).parent().data("default", this);
					});

					$("select").change(function(e) {
					$($(this).data("default")).prop("selected", true);
					});
					//$('#org').prop('readonly', true);
				}
				if(data.psu)
				{
					$("#psu").val(data.psu);
					$("select :selected").each(function(){
					$(this).parent().data("default", this);
					});

					$("select").change(function(e) {
					$($(this).data("default")).prop("selected", true);
					});
					//$('#psu').prop('readonly', true);
				}
			}
			

            console.log(data);
        },
		error : function(data) {
			alert('Something went wrong');
		}
    });
}
</script>
<script>
	$('#pan_number').change(function (event) 
	{     
		 var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
		 var txtpan = $(this).val(); 
		 if (txtpan.length == 10 )
		 { 
			  if( txtpan.match(regExp) )
			  {
			  	 var res = txtpan.charAt(3);
			  	 if(res== 'p' || res=='P')
			  	 {
			  		console.log('pan format is valid');	
			  	 }
			  	 else
			  	 {
					alert('Pan Card Holder Not A Person');
					$('#pan_number').val('');
					$("#pan_number").focus();
					event.preventDefault();
			  	 } 
			   // alert('PAN match found');
			  }
			  else 
			  {
			   alert('Not a valid PAN number');
			   $('#pan_number').val('');
			   $("#pan_number").focus();
			   event.preventDefault(); 
			  } 
		 } 
		 else 
		 { 
		       alert('Please enter 10 digits for a valid PAN number');
		       $('#pan_number').val('');
		        $("#pan_number").focus();
		       event.preventDefault(); 
		 } 
	});
</script>