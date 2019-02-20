
<section class="partner-organisation-wraper">
	<div class="container">
		<div class="partner-organisation-hder">
			<h1 class="border-center-hding">Partner Organisation</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
		</div>

		<div class="partner-organisation-form">

			<div id="cisfdiv" style="display: block">
				<p>
					<?php 
					if(!empty($organisations))
					{
						foreach ($organisations as $key => $value) {?>
						
							<input type="radio" id="test1" name="radio-group" value="<?php echo $value['id']?>">
							<label for="test1">

					

							<?echo $value['name'];
						}
					}
					?></label>
				</p>
				<p>
					<input type="radio" id="test2" name="radio-group" value="not_in_orgamisation">
					<label for="test2">Not In Above Organisationnn</label>
				</p>

				<div class="formbtn-box1">
					<button onclick="proceed_to_pan()" id="proceed_to_pan_form" value="" class="form-btn">Proceed</button>
				</div>
			</div>

		</div>
		<div id="pan_form" style="display: none">
		<form method="post" action="<?php echo base_url()?>home/check_pan_phone_existence">
			<div class="ph-form-row">
				<label>Enter Your Mobile Number (Registered With Organisation)</label>
				<input type="text" required name="phone_no" class="formfull-row" placeholder="+91-">
			</div>
			<h1 class="border-lr">OR</h1>
			<div class="pan-form-row">
				<label>Enter Your Pan Number</label>
				<input type="text" required name="pan_no" class="formfull-row" placeholder="Permanent Account Number">
			</div>

			<div class="formbtn-box">
				<input type="submit" name="submit" value="Proceed" class="form-btn">
			</div>
		</form>
	</div>
	</div>
	

	<!-- pan phone form-->
	

	<!--/ pan phone form-->
</section>
<script>
	function proceed_to_pan()
	{	 
	//alert('hello');
	$('#pan_form').show();
	$('#cisfdiv').hide();
}
</script>