
<section class="partner-organisation-wraper">
	<div class="container">


		<div class="partner-organisation-form">

			<div id="cisfdiv" style="display: block">

				<div class="partner-organisation-hder">
			<h1 class="border-center-hding">Partner Organisation</h1>
			<p style="text-align: center; margin: 0 auto 20px auto; height: auto; display: table; float: none;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
		</div>

				<p>
					<?php 
					if(!empty($organisations))
					{
						foreach ($organisations as $key => $value) {?>
						
							<input type="radio" id="test1" name="radio-group" value="<?php echo $value['id'];?>">
							<label for="test1">

					

							<?php echo $value['name'];
						}
					}
					?></label>
				</p>
				<p>
					<input type="radio" id="test2" name="radio-group" value="not_in_orgamisation">
					<label for="test2">Not In Above Organisation</label>
				</p>

				<div class="formbtn-box1">
					<button onclick="" id="proceed_to_pan_form" value="" class="form-btn">Proceed</button>
				</div>
			</div>

		</div>
		<div id="pan_form" style="display: none">

			<div class="panPhform-info-header">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
			</div>
		<form method="post" action="<?php echo base_url()?>home/check_pan_phone_existence">
			<div class="ph-form-row">
				<label class="ph-label">Enter Your Mobile Number (Registered With Organisation)</label>
				<input type="number" onKeyPress="if(this.value.length==10) return false;" name="phone_no" class="formfull-row" id="ph-input" autocomplete="off">
			</div>
			<h1 class="border-lr">OR</h1>
			<div class="pan-form-row">
				<label>Enter Your Pan Number</label>
				<input type="text"  name="pan_no" class="formfull-row" placeholder="Permanent Account Number" id="pan_input" autocomplete="off">
			</div>

			<div class="formbtn-box">
				<input type="submit" name="submit" value="Proceed" class="form-btn" id="pan_submit">
			</div>
		</form>
	</div>
	</div>
	

	<!-- pan phone form-->
	

	<!--/ pan phone form-->
</section>
<script>
	$(document).ready(function(){	
	$('#proceed_to_pan_form').click(function(){ 
	if (!$('input[name=radio-group]:checked').val() ) { 
		alert("required");
		return false;
	}
	else if($('#test2').is(':checked'))
	{
		 window.location = "<?php  echo base_url('home/insert_basick_detail'); ?>";
	}
	else{
	$('#pan_form').show();
	$('#cisfdiv').hide();
}
});

$('#pan_submit').click(function(){ 
	if ($('#ph-input').val() == ""  && $('#pan_input').val() == "" ) {
		alert("required");

		return false;
	}
	if ($('#ph-input').val() != ""  || $('#pan_input').val() != "" ) {


	}
});
	
});
</script>