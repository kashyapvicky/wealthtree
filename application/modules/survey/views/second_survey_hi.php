<section class="construct-quebox">
	<div class="container">
		<div class="wealth-tab">
			<!-- <form> -->
				<ul class="tab-list">
					<li><a href="javascript:void(0)" class="tab tab-ac1">अपनी पात्रता की जाँच करें</a></li>
					<li><a href="javascript:void(0)" class="tab tab-ac2 active">प्रिफरेंस </a></li>
				</ul>

				<div class="tab-content show" id="tab2">
					<!-- progress bar  -->
						<div id="myProgress">
						<div id="myBar">10%</div>
						</div>
					<!-- /progress bar -->
					<form method="post" action="<?php echo base_url()?>survey/insert_second_survey_data" id="forsubmit">
						<?php 
						// print_r(array_keys($questions_option,'op_a'));die;
						$counter = 1;
						$count =  count($questions_option);
						foreach ($questions_option as $key => $value) {
							$label_input_id_link = array_keys($value);

						// echo"<pre>";print_r($label_input_id_link); die;

							if($counter ==1)
							{
								echo"<div id='".$value['qn_id']."'>";
							}
							else
							{
								echo"<div id='".$value['qn_id']."' style='display: none'>";
							}
							?>
							<div class="retirement-box">
								<h1 class="border-center-hding">
									<?php
									$question =  $value['qn_name'];
									echo $question;
									?>

								</h1>
								<!-- <input type="hidden" name="qn_id[]" value="<?php echo $value['qn_id'] ?>"> -->
							</div>
							<div class="after-retbox">
								<div class="row">
									<div class="col-md-12 col-sm-12 form-group bd-radio">
										<input type="radio" id="<?php echo $label_input_id_link['2'].$counter?>" onclick="myfunction(<?php echo $value['qn_id'];?>)"  name="<?php echo $value['qn_id'] ?>" value="op_a">
										<label for="<?php echo $label_input_id_link['2'].$counter?>"><?php echo $value['op_a'];?></label>
									</div>
									<div class="col-md-12 col-sm-12 form-group bd-radio">
										<input type="radio" id="<?php echo $label_input_id_link['3'].$counter?>" onclick="myfunction('<?php echo $value['qn_id']?>')"  name="<?php echo $value['qn_id'] ?>" value="op_b">
										<label for="<?php echo $label_input_id_link['3'].$counter?>"><?php echo $value['op_b']?></label>
									</div>
									<div class="col-md-12 col-sm-12 form-group bd-radio">
										<input type="radio" id="<?php echo $label_input_id_link['4'].$counter?>" onclick="myfunction('<?php echo $value['qn_id']?>')" name="<?php echo $value['qn_id'] ?>" value="op_c">
										<label for="<?php echo $label_input_id_link['4'].$counter?>"><?php echo $value['op_c']?></label>
									</div>
									<div class="col-md-12 col-sm-12 form-group bd-radio">
										<input type="radio" id="<?php echo $label_input_id_link['5'].$counter?>" onclick="myfunction('<?php echo $value['qn_id']?>')"  name="<?php echo $value['qn_id'] ?>" value="op_d">
										<label for="<?php echo $label_input_id_link['5'].$counter?>"><?php echo $value['op_d']?></label>

									</div>
								</div>

								<!-- <a href="javascript:void(0)" id="next4" class="next-btn">next</a> -->


							</div>
						</div>
						
						<?php
						$counter++;

					}

					?>
					<div class="formbtn-box formbtn-boxex1" id="submit_btn" style="display:none">
						<button class="form-btn">सबमिट </button>
					</div>
				</form>
			</div>
		</div>

	</section>

	<script>
		//var counter=1;
		var progress =10;
		function myfunction(val)
		{
			<?php $count =  count($questions_option); ?>
			var last_qn_number = <?php echo $count;?>;
			console.log(last_qn_number);
			//console.log(counter);
			//counter++;
			test = val;
			//console.log(test);
			var n1 = parseInt(test);
			var r = n1 + 1;
			//console.log(r);
			setTimeout(function() 
			{
				if ($('input[name='+test+']:checked').val())
				{
					if(test < last_qn_number)
					{
						$('#'+ test).hide();
						$('#'+r).fadeIn(1000);
						progress = progress+10;
						console.log(progress);
						$('#myBar').text(test*10+'%');
						$('#myBar').css('width',test*10+'%');

					}
					else
					{
						$('#myBar').text(test*10+'%');
						$('#myBar').css('width',test*10+'%');
						$('#submit_btn').show();
					}
				}	   
			},
			500);	
		}
		// function submit_form(val)
		// {
		// 	alert('hello');
		// 	 var form_count = val;
		// 	if(counter == form_count)
		// 	{
		// 		alert('hello');
		// 	}
		// }

	</script>
	<script>

	// function submit_form()
	// {
	// 	document.getElementById('forsubmit').submit();
	// }
</script>
<script>
$('#myBar').text('0%');
$('#myBar').css('width','');
</script>