<?php
echo $this->session->flashdata('phone_empty');
echo $this->session->flashdata('Invalid_otp');
?>
<section class="home-category-wraper">
	<div class="container">
		<div class="row">
			<aside class="col-md-4 col-sm-5">
				<div class="home-message-wraper">
					<h4 class="border-hding">Message</h4>
					<div class="message-card-box">
						<div class="user-image">
							<img src="images/user.png" alt="" class="img-responsive">
						</div>
						<div class="user-info">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>
						</div>
						<div class="user-name-box">
							<h4>Peter Doe</h4>
							<p>Designer</p>
						</div>
					</div>
				</div>
			</aside>
			<div class="col-md-8 col-sm-7">
				<div class="home-subsidy-box">
					<h2>Know Your Subsidy Entitlements</h2>
					<p>In Buying/Constructing/Extensions of Houses under Prime Minister Awas Yojna</p>
					<a href="javascript:void(0)" class="subsidybtn">Click here</a>
				</div>
				<div class="get-service-box">
					<h2>Get Services</h2>
					<p>For Buying/Construction of Houses</p>
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
			<h1 class="border-center-hding">How It Will Work</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
		</div>
		<div class="work-category-wraper">
			<div class="work-category-item1">
				<div class="work-category-item-info">
					<h6>Know Your Subsidy Entitlement</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
				</div>
				<div class="work-category-item-image">
					<img src="images/Subsidy-icon.png" alt="" class="img-responsive">
				</div>
			</div>
			<div class="work-category-item2">
				<div class="work-category-item-image">
					<img src="images/Subsidy-icon.png" alt="" class="img-responsive">
				</div>
				<div class="work-category-item-info">
					<h6>Know Your Subsidy Entitlement</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
				</div>
			</div>
			<div class="work-category-item3">
				<div class="work-category-item-info">
					<h6>Know Your Subsidy Entitlement</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
				</div>
				<div class="work-category-item-image">
					<img src="images/Subsidy-icon.png" alt="" class="img-responsive">
				</div>
			</div>
			<div class="work-category-item4">
				<div class="work-category-item-image">
					<img src="images/Subsidy-icon.png" alt="" class="img-responsive">
				</div>
				<div class="work-category-item-info">
					<h6>Know Your Subsidy Entitlement</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
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
				<input required type="text" name="phone_number" class="formfull-row phone_number" placeholder="+91-" id="login-no">
			</div>
			<div class="formbtn-box">
				<button onclick="send_otp()" type="submit" name="submit" value="login" class="form-btn" id="login-form">Submit</button>
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
				<input type="text" name="digit1" class="otp-input" value="" maxlength="1" required><span></span>
				<input type="text" name="digit2" class="otp-input" value="" maxlength="1" required><span></span>
				<input type="text" name="digit3" class="otp-input" value="" maxlength="1" required><span></span>
				<input type="text" name="digit4" class="otp-input" value="" maxlength="1" required>
			</div>
			<div class="formbtn-box1">
				<button type="submit" name="submit" value="VERIFY" class="form-btn" id="">VERIFY</button>
			</div>
			<a href="#" class="resend-otp">Resend OTP</a>
		</form>
	</div>
</div>
<!-- otp popup end -->
<script>
function send_otp()
{
	var number = $('.phone_number').val();


	$.ajax
	({
		type : "POST",
		url : "<?php echo base_url(); ?>home/send_otp_to_mobile?>",
		dataType : "json",
		data : {"phone_number" : number},
		success : function(data)
		{
			
			$("#phone").html(data);
			//alert(data);
		},
		error : function(data) {
			alert('Something went wrong');
		}
	});
}
 	
 function validate_otp()
 {

 }

</script>