<?php
if(!(empty($this->session->flashdata('phone_empty'))))
{
	echo"<script>alert('".$this->session->flashdata('phone_empty')."')</script>";
}
if(!(empty($this->session->flashdata('Invalid_otp'))))
{
	echo"<script>alert('".$this->session->flashdata('Invalid_otp')."')</script>";
}
if(!(empty($this->session->flashdata('faq_hindi'))))
{
	// echo"hello";die;
	echo"<script>swal('".$this->session->flashdata('faq_hindi')."')</script>";
}
if(!(empty($this->session->flashdata('faq_english'))))
{
	echo"<script>swal('".$this->session->flashdata('faq_english')."')</script>";
}

?>
<section class="home-category-wraper">
	<div class="container">
		<div class="row">
			<aside class="col-md-4 col-sm-5">
				<div class="home-message-wraper">
					<h4 class="border-hding">Message</h4>
					<div class="message-card-box">
						<div class="user-image">
							<img src="<?php echo base_url_custom;?>images/user.png?>" alt="" class="img-responsive">
						</div>
						<div class="user-info">
							<p>The government of India under the able leadership of honorable PM Shri Narendra Modi has emphasised upon an ambitious mission “HOUSING FOR ALL”.</p>

							<p>Schemes under PM Awas yojna have been formulated to assist common man in realising their dream of houses. Though may not be aware, most of you will be eligible for subsidy under the CLSS-subsidy scheme under PMAY(urban). The present desire is to make you aware of the subsidy you may be entitled if you desire to construct or buy a new house. Subsidy may also be available in many of the cases in if you desire to extend your existing house. Participate in the present drive to know your exact entitlement.</p>
						</div>
						<!-- <div class="user-name-box">
							<h4>Peter Doe</h4>
							<p>Designer</p>
						</div> -->
					</div>
				</div>
			</aside>
			<div class="col-md-8 col-sm-7">
				<div class="home-subsidy-box">
					<h2>Know Your Subsidy Entitlements</h2>
					<p><i>Under Credit Linked Subsidy Scheme of PMAY</i></p>
					<p>In Buying/Constructing/Extensions of Houses under Prime Minister Awas Yojna</p>
					<a href="javascript:void(0)" class="subsidybtn">Click here</a>
				</div>
				<div class="get-service-box">
					<h2>Get Services</h2>
					<p>Consultation/Legal Matters/Architectural Engineering/Finance/Others Services</p>
					<a href="javascript:void(0)" class="getservBtn">Click here</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--Category Section End-->

<section class="how-will-work-wraper">
	<div class="container">
		<div class="how-will-work-header">
			<h1 class="border-center-hding">How It Work</h1>
			<p>These steps will help you understand the process Briefly.</p>
		</div>
		<div class="work-category-wraper">
			<div class="work-category-item1">
				<div class="work-category-item-info">
					<h6>Know Your Subsidy Entitlement</h6>
					<p>Take our eligibility survey to know your eligibility under CLSS, also know the maximum amount of subsidy you may be entitled to.</p>
				</div>
				<div class="work-category-item-image">
					<img src="<?php echo base_url_custom;?>images/subsidy1.png?>" alt="" class="img-responsive">
				</div>
			</div>
			<div class="work-category-item2">
				<div class="work-category-item-image">
					<img src="<?php echo base_url_custom;?>images/requirement.png?>" alt="" class="img-responsive">
				</div>
				<div class="work-category-item-info">
					<h6>Select the services in which you need expert assistance</h6>
					<p>Out of many services like Consultation/Legal Matters/Finance/Architechtural Engineering/Aproval Form Authority select which you need and get expert assistance in each area of service.</p>
				</div>
			</div>
			<div class="work-category-item3">
				<div class="work-category-item-info">
					<h6>Pay only for selected Services</h6>
					<p>You pay a very reasonable amount only for services you need.</p>
				</div>
				<div class="work-category-item-image">
					<img src="<?php echo base_url_custom;?>images/customized.png?>" alt="" class="img-responsive">
				</div>
			</div>
			<div class="work-category-item4">
				<div class="work-category-item-image">
					<img src="<?php echo base_url_custom;?>images/loan-subsidy.png?>" alt="" class="img-responsive">
				</div>
				<div class="work-category-item-info">
					<h6>Monitor the state of Services</h6>
					<p>In a later stage you can keep a check on all services status which you have availed</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- How  Will Work Wraper End -->


<!-- phone number popup start -->
<div class="phNopopup-wraper">
	<div class="phNo-box">
		<a href="javascript:void(0)" class="hide-phNopopup"></a>
		<div class="phNopopup-icon"></div>
		<form method="post" action="<?php echo base_url()?>home/send_otp">
			<div class="ph-form-row">
				<label>Enter Your Mobile Number</label>
				<input  required type="number" name="phone_number" class="formfull-row phone_number" id="login-no" autocomplete="off" onKeyPress="if(this.value.length==10) return false;">
			</div>
			<div class="formbtn-box">
				<button onclick="send_otp()" type="submit" name="submit" value="login" class="form-btn" id="login-form">LOGIN</button>
			</div>
		</form>
	</div>
</div>
<!-- phone number popup end -->

<!-- otp popup start -->
<div class="otpPopup-wraper">
	<div class="otpbox">
		<a href="javascript:void(0)" class="hide-phNopopup hide-otppopup"></a>
		<div class="otppopup-icon"></div>
		<form method="post" action="<?php echo base_url();?>home/validate_otp">
			<h6>Verify Your Number</h6>
			<p>We have sent an OTP on your number</p>
			<p id="" class="otpNo">+91-<span id="phone"></span></p>
			<div class="otp-inputbox">
				<input type="text" required name="digit1" class="otp-input" value="" maxlength="1"><span></span>
				<input type="text" required name="digit2" class="otp-input" value="" maxlength="1"><span></span>
				<input type="text" required name="digit3" class="otp-input" value="" maxlength="1"><span></span>
				<input type="text" required name="digit4" class="otp-input" value="" maxlength="1">
			</div>
			<div class="formbtn-box1">
				<button type="submit" name="submit" value="VERIFY" class="form-btn" id="">VERIFY</button>
			</div>
			<a href="#" class="resend-otp">Resend OTP</a>
		</form>
	</div>
</div>
<!-- otp popup end -->


<!-- service phone number popup start -->
<div class="phNopopup-wraper1">
	<div class="phNo-box">
		<a href="javascript:void(0)" class="hide-phNopopup" id="hidephNopopup"></a>
		<div class="phNopopup-icon"></div>
		<form method="post" action="<?php echo base_url()?>home/send_otp">
			<div class="ph-form-row">
				<label>Enter Your Mobile Number</label>
				<input  required type="number" name="phone_number" class="formfull-row phone_number_second_box" id="login-No" autocomplete="off" onKeyPress="if(this.value.length==10) return false;">
			</div>
			<div class="formbtn-box">
				<button onclick="send_otp()" type="submit" name="submit" value="login" class="form-btn" id="loginForm">LOGIN</button>
			</div>
		</form>
	</div>
</div>
<!-- service phone number popup end -->

<!-- service otp popup start -->
<div class="otpPopup-wraper1">
	<div class="otpbox">
		<a href="javascript:void(0)" class="hide-phNopopup" id="hideOtppopup"></a>
		<div class="otppopup-icon"></div>
		<form method="post" action="<?php echo base_url();?>home/validate_otp?second_popup='service'">
			<h6>Verify Your Number</h6>
			<p>We have sent an OTP on your number</p>
			<p id="" class="otpNo">+91-<span id="phone_second_box"></span></p>
			<div class="otp-inputbox">
				<input type="text" required name="digit1" class="otp-input" value="" maxlength="1"><span></span>
				<input type="text" required name="digit2" class="otp-input" value="" maxlength="1"><span></span>
				<input type="text" required name="digit3" class="otp-input" value="" maxlength="1"><span></span>
				<input type="text" required name="digit4" class="otp-input" value="" maxlength="1">
			</div>
			<div class="formbtn-box1">
				<button type="submit" name="submit" value="VERIFY" class="form-btn" id="">VERIFY</button>
			</div>
			<a href="#" class="resend-otp">Resend OTP</a>
		</form>
	</div>
</div>
<!-- service otp popup end -->


<div class="getServ-popup-wraper">
	<div class="getServ-popup">
		<a href="#" class="hide-getServ-popup"></a>
		<div class="getServ-popupIcon"></div>
			<h6>Message</h6>
			<p>You need to know your subsidy entitlement before taking services, click on ‘OK’ button.</p>
			<button type="button" class="ok-btn">okay</button>
	</div>
</div>
<!-- subsidy popup start -->

<!-- subsidy popup   End -->
<script>
function send_otp()
{
	// alert('call');
	// return false;
	var number = $('.phone_number').val();
	//alert(number.length);
	if(number)
	{

		//do nothing
	}
	else
	{
		 var number = $('.phone_number_second_box').val();
	}
	
		$.ajax
		({
			type : "POST",
			url : "<?php echo base_url(); ?>home/send_otp_to_mobile?>",
			dataType : "json",
			data : {"phone_number" : number},
			success : function(data)
			{
				console.log(data);
				
				$("#phone").html(data);
				$("#phone_second_box").html(data);
				//alert(data);
			},
			error : function(data) {
				alert('Something went wrong');
			}
		});
	}

 	

</script>
