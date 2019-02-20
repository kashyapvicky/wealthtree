<!-- <style type="text/css">
 #submit_form.disabled:hover {
    cursor:not-allowed
 }	

</style> -->
<?php echo $this->session->flashdata('basick_error');?>
<section class="basicdetail-wraper">
	<div class="partner-organisation-hder">
		<h1 class="border-center-hding">Enter Your Basic Details</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
	</div>
	<div class="container">
		<div class="basic-formWraper">
			<div class="row">
				<form method="post" action="<?php echo base_url()?>home/insert_basick_detail">
					<div class="col-md-6 col-sm-6">
						<div class="first-namebx">
							<label>First Name</label>
							<input required  type="text" name="first_name" class="formfull-row" placeholder="Enter Your First Name">
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="first-namebx last-namebx">
							<label>Last Name</label>
							<input required type="text" name="last_name" class="formfull-row" placeholder="Enter Your Last Name">
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="first-namebx email-bx">
							<label>Email</label>
							<input required type="email" name="email" class="formfull-row" placeholder="Enter Your Email">
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="first-namebx dob-bx">
							<label>Date Of Birth</label>
							<input required  type="date" name="dob" class="formfull-row" placeholder="DD / MM / YYYY">
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="pan-form-row basic-panform-row">
							<label>Enter Your Pan Number</label>
							<input required type="text" name="pan_number" class="formfull-row" placeholder="Enter Your Pan Number">
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="genderbox">
							<label>Gender</label>
							<div class="row">
								<div class="col-md-4 col-sm-4 bd-radio">
									<input type="radio" id="test4" name="gender" checked>
									<label for="test4">Male</label>
								</div>
								<div class="col-md-4 col-sm-4 bd-radio">
									<input type="radio" id="test5" name="gender">
									<label for="test5">Female</label>
								</div>
								<div class="col-md-4 col-sm-4 bd-radio">
									<input type="radio" id="test6" name="gender">
									<label for="test6">Transgender</label>
								</div>
							</div>
						</div>

						<div class="workingbox">
							<div class="row">
								<div class="col-md-5 bd-radio">
									<input type="radio" id="test7" name="working" checked="">
									<label for="test7">Self Working</label>
								</div>
								<div class="col-md-5 bd-radio">
									<input type="radio" id="test8" name="working">
									<label for="test8">Salaried</label>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12 col-sm-12">
						<div class="salary-box">
							<label>Income / Salary (Monthly)</label>
							<input required  type="text" name="income" class="formfull-row" placeholder="Enter Your Income / Salary">
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="slect-row">
							<select name="org" required class="formfull-row">
								<option>Organisations</option>
							</select>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="slect-row">
							<select name="psu" required class="formfull-row">
								<option>Public Sector Undertakings (PSU)</option>
							</select>
						</div>
					</div>

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
						<input type="submit" id="submit_form" name="submit" value="SUBMIT" class="form-btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
$(document).ready(function() {
	var n1 = parseInt($('#sum1').val());
	var n2 = parseInt($('#sum2').val());
	 var r = n1 + n2;
	 console.log(r);
     $('#submit_form').prop('disabled',true);
     $('#captcha_result').keyup(function() {
     	
        if($('#captcha_result').val() == r) {
           $(':input[type="submit"]').prop('disabled', false);
        }
     });
 });
</script>