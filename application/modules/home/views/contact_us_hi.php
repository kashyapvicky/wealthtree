	<section class="contactus-wraper">
		<div class="container">
			<div class="contactus-infobx">
				<h2>संदेश छोड़े</h2>
				<p>सर्वेक्षण, पीएमएवाई योजना और हमारी सेवाओं के बारे में हमसे अपना सवाल पूछें</p>

				<div class="contact-addressbx">
					<div class="contact-address">
						<span>ईमेल:</span><a href="mailto:info@pmawas.com">info@pmawas.com</a>
					</div>

					<div class="contact-address">
						<span>पता:</span><b>L-25, साउथ एक्स्टेंशन पार्ट II, नई दिल्ली (110049)</b>
					</div>
				</div>

			</div>
			<div class="conatct-formbx">
				<div class="contactForm">

					<?php echo $this->session->flashdata('email');?>
					<font color="red">
					<?php echo $this->session->flashdata('query');?>
					</font>
					<form method="post" name="form1" action="<?php base_url()?>home/insert_query" id="myForm">
						<div class="form-row">
							<input type="text" name="name" placeholder="आपका नाम*" autocomplete="off" data-msg-required="कृपया हमें अपना नाम बताएं।" value="<?php if(!empty($user_info)){echo $user_info['first_name'];}?>" required="">
						</div>
						<div class="form-row">
							<input type="email" value="<?php if(!empty($user_info)){echo $user_info['email'];}?>" name="email" placeholder="ईमेल*" autocomplete="off" >
						</div>
						<div class="form-row">
							<input type="text" name="phone" value="<?php if(!empty($user_info)){echo $user_info['phone_number'];}?>" placeholder="फ़ोन नंबर*" autocomplete="off"  required="">
						</div>
						<div class="form-row">
							<textarea name="message" rows="4" cols="3" placeholder="अपना सवाल पूछें*" autocomplete="off" required="" data-msg-required="कृपया अपना संदेश लिखें"></textarea>
						</div>
						<div class="conatactus-captcha">
							<div>कैप्चा क्या है<span><input type="text" name="" id="sum1" value="<?php echo rand(0,9)?>"></span> <span>+</span> <span><input type="text" name="" id="sum2" value="<?php echo rand(0,9)?>"></span> <span>=</span> <input type="number" name="captcha" id="captcha_result" placeholder="उत्तर" autocomplete="off"></div>
						</div>

						<input type="submit" id="submit_form" name="submit" class="contactus-submit" value="सबमिट">
					</form>
				</div>
			</div>
		</div>
	</section>
	
	<!-- js added -->
	<!-- <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url_custom;?>js/validate.js"></script>

<script type="text/javascript">

$(document).ready(function () {

    $('#myForm').validate({ // initialize the plugin
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email : true
            },
            phone: {
            	required: true
            },
            message: {
            	required: true
            }
        }
    });

});
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
        else
        {
        	 $(':input[type="submit"]').prop('disabled', true);
        }
     });
 });
</script>

</body>
</html>