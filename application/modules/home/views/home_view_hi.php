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
					<h4 class="border-hding">संदेश</h4>
					<div class="message-card-box">
						<div class="user-image">
							<img src="<?php echo base_url_custom;?>images/user.png?>" alt="" class="img-responsive">
						</div>
						<div class="user-info">
							<p>माननीय पीएम श्री नरेन्द्र मोदी के कुशल नेतृत्व में भारत सरकार ने एक महत्वाकांक्षी मिशन "होसिंग फॉर ऑल" पर जोर दिया है।</p>

							<p>पीएम आवास योजना के तहत योजनाएं बनाई गई हैं ताकि आम लोगों को उनके घरों के सपने को साकार करने में सहायता मिल सके। हो सकता है कि आपको जानकारी न हो, लेकिन आप में से अधिकांश पीएमएवाई (शहरी) के तहत सीएलएसएस-सब्सिडी योजना के तहत सब्सिडी के लिए पात्र होंगे। वर्तमान इच्छा यह है कि यदि आप एक नए घर का निर्माण करना चाहते हैं या खरीदना चाहते हैं तो आप सब्सिडी के बारे में जानते हैं। यदि आप अपने मौजूदा घर का विस्तार करना चाहते हैं तो कई मामलों में सब्सिडी भी उपलब्ध हो सकती है। अपनी सही पात्रता जानने के लिए वर्तमान ड्राइव में भाग लें।</p>
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
					<h2>अपनी सब्सिडी की प्रविष्टियां जानें</h2>
					<p><i>पीएमएवाई की क्रेडिट लिंक्ड सब्सिडी योजना के तहत</i></p>
					<p>प्रधानमंत्री आवास योजना के तहत घरों की खरीद / निर्माण / विस्तार में</p>
					<a href="javascript:void(0)" class="subsidybtn">यहां क्लिक करे</a>
				</div>
				<div class="get-service-box">
					<h2>सेवाएँ प्राप्त करें</h2>
					<p>परामर्श / कानूनी मामले / आर्किटेक्चरल  इंजीनियरिंग / वित्त / अन्य सेवाएँ</p>
					<a href="javascript:void(0)" class="getservBtn">यहां क्लिक करे</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--Category Section End-->

<section class="how-will-work-wraper">
	<div class="container">
		<div class="how-will-work-header">
			<h1 class="border-center-hding">यह कैसे कार्य करता है</h1>
			<p>ये चरण आपको प्रक्रिया को संक्षेप में समझने में मदद करेंगे।</p>
		</div>
		<div class="work-category-wraper">
			<div class="work-category-item1">
				<div class="work-category-item-info">
					<h6>अपनी सब्सिडी पता करें</h6>
					<p>सीएलएसएस के तहत अपनी पात्रता जानने के लिए हमारी पात्रता सर्वेक्षण लें, साथ ही अधिकतम सब्सिडी का भी पता करें जिसके आप हकदार हो सकते हैं।</p>
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
					<h6>उन सेवाओं का चयन करें जिनमें आपको विशेषज्ञ सहायता की आवश्यकता है</h6>
					<p>परामर्श / कानूनी मामलों / वित्त / वास्तुकला इंजीनियरिंग / प्राधिकरण से अनुमोदन जैसी कई सेवाओं का चयन करें जिनकी आपको आवश्यकता है और सेवा के प्रत्येक क्षेत्र में विशेषज्ञ सहायता प्राप्त करें।</p>
				</div>
			</div>
			<div class="work-category-item3">
				<div class="work-category-item-info">
					<h6>केवल चयनित सेवाओं के लिए भुगतान करें</h6>
					<p>आप केवल उन सेवाओं के लिए एक बहुत ही उचित राशि का भुगतान करते हैं जिनकी आपको आवश्यकता है।</p>
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
					<h6>सेवाओं की स्थिति की निगरानी करें</h6>
					<p>बाद के चरण में आप उन सभी सेवाओं की स्थिति पर नज़र रख सकते हैं, जिनका आपने लाभ उठाया है</p>
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
				<label>अपना मोबाइल नंबर दर्ज करें</label>
				<input  required type="number" name="phone_number" class="formfull-row phone_number" id="login-no" autocomplete="off" onKeyPress="if(this.value.length==10) return false;">
			</div>
			<div class="formbtn-box">
				<button onclick="send_otp()" type="submit" name="submit" value="login" class="form-btn" id="login-form">लॉग इन करें</button>
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
			<h6>अपना नंबर सत्यापित करें</h6>
			<p>हमने आपके नंबर पर एक OTP भेजा है</p>
			<p id="" class="otpNo">+91-<span id="phone"></span></p>
			<div class="otp-inputbox">
				<input type="text" required name="digit1" class="otp-input" value="" maxlength="1"><span></span>
				<input type="text" required name="digit2" class="otp-input" value="" maxlength="1"><span></span>
				<input type="text" required name="digit3" class="otp-input" value="" maxlength="1"><span></span>
				<input type="text" required name="digit4" class="otp-input" value="" maxlength="1">
			</div>
			<div class="formbtn-box1">
				<button type="submit" name="submit" value="VERIFY" class="form-btn" id="">सत्यापित करें</button>
			</div>
			<a href="#" class="resend-otp">OTP को फिर से भेजें</a>
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
