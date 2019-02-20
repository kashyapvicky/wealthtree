	<section class="contactus-wraper">
		<div class="container">
			<div class="contactus-infobx">
				<h2>Leave Us A Message</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

				<div class="contact-addressbx">
					<div class="contact-address">
						<span>Email:</span><a href="mailto:info@pmawas.com">info@pmawas.com</a>
					</div>

					<div class="contact-address">
						<span>Address:</span><b>L-25, South Extention Part II, New Delhi(110049)</b>
					</div>
				</div>

			</div>
			<div class="conatct-formbx">
				<div class="contactForm">
					<?php echo $this->session->flashdata('email');?>
					<form method="post" name="form1" action="<?php base_url()?>home/send_mail" id="myForm">
						<div class="form-row">
							<input type="text" name="name" placeholder="Your Name*" autocomplete="off" data-msg-required="Please tell us your name." required="">
						</div>
						<div class="form-row">
							<input type="email" name="email" placeholder="Email" autocomplete="off" >
						</div>
						<div class="form-row">
							<input type="text" name="phone" placeholder="Phone Number*" autocomplete="off" required="" required="">
						</div>
						<div class="form-row">
							<textarea name="message" rows="4" cols="3" placeholder="Your Message*" autocomplete="off" required="" data-msg-required="Please Enter Your Message"></textarea>
						</div>
						<div class="conatactus-captcha">
							<div>Captcha what is <span><input type="text" name="" id="sum1" value="<?php echo rand(0,9)?>"></span> <span>+</span> <span><input type="text" name="" id="sum2" value="<?php echo rand(0,9)?>"></span> <span>=</span> <input type="number" name="captcha" id="captcha_result" placeholder="Answer" autocomplete="off"></div>
						</div>

						<input type="submit" id="submit_form" name="submit" class="contactus-submit">
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
                required: false,
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
     });
 });
</script>

</body>
</html>