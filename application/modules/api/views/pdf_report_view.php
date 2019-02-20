<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	</style>
</head>
<body style="margin: 0; padding: 0;">
	<section class="detailed-reportForm-wraper">
		<div class="container" style="padding: 0 20px;">
			<div style="width: 100%; float: left; clear: both;">
				<div style="width:50%; float: left;">
				<img src="<?php echo base_url_custom;?>images/logo.png" class="img-responsive" style="max-width: 80px;">
				</div>
				<p style="width:50%; float:left; text-align: right; padding-top:15px;">Date: <span><?php echo $user_info_row['timestamp']; ?></span></p>
			</div>
			<h2 style="font-size: 22px; text-align: center; margin: 12px 0 0px;">PMAY-CLSS(Urban) Eligibility Advice</h2>
			<div class="reportForm-bx" style="padding: 15px 0 0;">
				<div class="reportForm" style="width: 50%;float: left; margin: 0 0 17px;">
					<span><b>Name-</b></span><span> <?php echo $user_info_row['first_name']?></span>
				</div>
				<div class="reportForm" style="width: 50%;float: left; margin: 0 0 17px;">
					<span><b>PAN-</b></span><span> <?php echo $user_info_row['pan_number']?></span>
				</div>

				<div class="reportForm" style="width: 50%;float: left; margin: 0 0 0;">
					<span><b>DOB-</b></span><span> <?php echo $user_info_row['dob']?></span>
				</div>
				<div class="reportForm" style="width: 50%;float: left; margin: 0 0 0;">
					<span><b>Email-</b></span><span> <?php echo $user_info_row['email']?></span>
				</div>

			</div>

			<div class="detailed-reportInfo">
				<p style="margin:9px 0;">Organisation-<?php echo $user_info_row['organisation']?> (<?php echo $user_info_row['sector']?>) </p>

				<p>“This report is based on the answers of the eligibility survey which you gave on pmawas.com” -</p>
				<ul>
					<li style="margin:9px 0;">Your preferred location to construct/purchase a house-</li>
				</ul>
			</div>

			<div class="reportForm-bx">
				<div class="reportForm-col3">
					<span><b>State-</b></span><span><?php echo @$user_info_row['state']?></span>
				</div>
				<div class="reportForm-col3">
					<span><b>District-</b></span><span><?php echo @$user_info_row['district']?></span>
				</div>
				<div class="reportForm-col3">
					<span><b>Town-</b></span><span><?php if(!empty($user_info_row['town']))
						{
							 echo @$user_info_row['town'];
							 $town_notification = $user_info_row['town_notification'];
						}
						else
						{
							$moza_notification = $user_info_row['moza_notification'];
							 echo @$user_info_row['moza'];
						}?></span>
				</div>
			</div>

			<div class="detailed-reportInfo">
				<ul>
					<li>Total family income according to this scheme-      <?php echo $this->session->flashdata('total_family_income');?>/-</li>
					<?php if(!empty($user_info_row['pakka_house']))
					{?>
						<li>You owe a pucca house <?php echo $user_info_row['pakka_house'];

						if(!empty($user_info_row['what_you_want']))
						{	?> &nbsp;<?php
							if($user_info_row['what_you_want']==1)
							{

								echo "And you wish to construct";
							}
							elseif ($user_info_row['what_you_want']==2)
							{
								echo "And you wish to Purchase";
							}
							elseif ($user_info_row['what_you_want']==3)
							{
								echo "And you wish to add more room in existing house";
							}
						}

						?> 
						</li>

					<?php } else {?>
					<li>You do not owe pucca house.</li>
					<?php }?>
				</ul>
				<div class="h-line text-center" style="width: 50%; float: left; border-bottom:1px solid #000; text-align: center; margin: 0 auto; margin-bottom: 12px; margin-top:8px;"></div>
			</div>

			<div class="detailReport-msg">
				<span class="dName">Dear <?php echo $user_info_row['first_name']?> ,</span>
				<?php if($this->session->flashdata('first'))
				{?>
				<div class="detailed-msgInnerbx" id="detailedMsg-case1">
					<p>As per the information given by you,you are eligible for government subsidy under CLSS of PMAY(U) for an amount of upto Rs. <?php echo $this->session->flashdata('XXXX');?> lakhs.
					Your prefered location falls in the list of eligible places mentioned by ministry available on mohua.gov.in/
	`				</p>

					<p>This amount of subsidy also depends upon the amount you propose to borrow(principle amount of loan) and the number of years for which you propose to borrow the amount(Tenure of amount). To know the exact amount, go to <u><a href="<?php echo base_url()?>home/open_calc">emi calculator</a></u>.
					</p>
				</div>
				<?php }
				elseif($this->session->flashdata('second'))
				{?>
				<div class="detailed-msgInnerbx" id="detailedMsg-case2">
					<p>As per the information given by you, you are not eligible for any subsidy under CLSS of PMAY(Urban).</p>

					<span>Due to any following reasons-</span>
					<ul>
						<li>Your mentioned place doesnot exist in our database.</li>
						<li>Total family income greater than 18 lakhs</li>
						<li>You owe a pucca house</li>
					</ul>
				</div>

				<?php }
				elseif($this->session->flashdata('third_no'))
				{?>
				<div class="detailed-msgInnerbx" id="detailedMsg-case3-no">
					<p>In our database, as per the terms and conditions for subsidy under PMAY(Urban) your place of choice is eligible for government subsidy under CLSS of PMAY(U) for an amount of upto Rs. <?php echo $this->session->flashdata('XXXX');?> lakhs.</p>

					<p>The location you have selected for construction/purchase of house is covered under PMAY(U) as per the  Map notification<u> <?php if(!empty($town_notification)){echo $town_notification;}else{echo $moza_notification;}?> </u> Dated <u>
						<?php if(!empty($user_info_row['town_dated'])){echo $user_info_row['town_dated'];}else{echo $user_info_row['moza_dated'];}?> </u> issued by ministry of housing and urban affairs.
					However the name of this location doesnot appear on the website of the Ministry of Housing and urban affairs but according to us, your location is a notified planning area under map notification <u> <?php if(!empty($town_notification)){echo $town_notification;}else{echo $moza_notification;}?> </u> Dated <u> <?php if(!empty($user_info_row['town_dated'])){echo $user_info_row['town_dated'];}else{echo $user_info_row['moza_dated'];}?> </u> by the court of <?php echo $user_info_row['state'] ?></p>

					<p>However the name of this location doesnot appear on the website of the Ministry of Housing and urban affairs but according to us, your location is a notified planning area under map notification <u> <?php if(!empty($town_notification)){echo $town_notification;}else{echo $moza_notification;}?> </u> Dated <u> <?php if(!empty($user_info_row['town_dated'])){echo $user_info_row['town_dated'];}else{echo $user_info_row['moza_dated'];}?> </u> by the court of <?php echo $user_info_row['state'] ?></p>

					<p><i>You may refer to these map notification while claiming your subsidy on loan from PLI(Banks/Housing finance companies).</i></p>

					<p> This amount of subsidy also depends upon the amount you propose to borrow(principle amount of loan) and the number of years for which you propose to borrow the amount(Tenure of amount). To know the exact amount, go to <u> emi calculator</u>.</p>
				</div>
				<?php }
				elseif($this->session->flashdata('third_other'))
				{?>

				<div class="detailed-msgInnerbx" id="detailedMsg-case3-others">
					<P>In our database, as per the terms and conditions for subsidy under PMAY(Urban) your place of choice is eligible for government subsidy under CLSS of PMAY(U) for an amount of upto Rs. <?php echo $this->session->flashdata('XXXX');?> lakhs.</P>

					<P>The location you have selected for construction/purchase of house is covered under PMAY(U) as per this secondary source notification  <u><?php if(!empty($town_notification)){echo $town_notification;}else{echo $moza_notification;}?></u> Dated <u><?php if(!empty($user_info_row['town_dated'])){echo $user_info_row['town_dated'];}else{echo $user_info_row['moza_dated'];}?></u>issued by ministry of housing and urban affairs.</P>

					<p>However the name of this location doesnot appear on the website of the Ministry of Housing and urban affairs but according to us, your location is a notified planning area under secondary source notification <u> <?php if(!empty($town_notification)){echo $town_notification;}else{echo $moza_notification;}?> </u> Dated <u> <?php if(!empty($user_info_row['town_dated'])){echo $user_info_row['town_dated'];}else{echo $user_info_row['moza_dated'];}?> </u> by the court of <?php echo $user_info_row['state'] ?> (selected state name).
					</P>

					<p>You may refer to these map notification while claiming your subsidy on loan from PLI(Banks/Housing finance companies).</p>

					<p>This amount of subsidy also depends upon the amount you propose to borrow(principle amount of loan) and the number of years for which you propose to borrow the amount(Tenure of amount). To know the exact amount, go to <u>emi calculator</u>.</p>
				</div>

				<?php }
				elseif($this->session->flashdata('third_yes'))
				{?>
				<div class="detailed-msgInnerbx" id="detailedMsg-case3-yes">
					<p>In our database, as per the terms and conditions for subsidy under PMAY(Urban) your place of choice is eligible for subsidy government subsidy under CLSS of PMAY(U) for an amount of upto Rs. <?php echo $this->session->flashdata('XXXX');?> lakhs. 
					</p>

					<p>The location you have selected for construction/purchase of house is covered under PMAY(U) as per the notification  <u> <?php if(!empty($town_notification)){echo $town_notification;}else{echo $moza_notification;}?></u> Dated <u> <?php if(!empty($user_info_row['town_dated'])){echo $user_info_row['town_dated'];}else{echo $user_info_row['moza_dated'];}?> </u> issued by ministry of housing and urban affairs.</p>

					<p>However the name of this location doesnot appear on the website of the Ministry of Housing and urban affairs but according to us, your location is a notified planning area under notification <u> <?php if(!empty($town_notification)){echo $town_notification;}else{echo $moza_notification;}?> </u> Dated <u> <?php if(!empty($user_info_row['town_dated'])){echo $user_info_row['town_dated'];}else{echo $user_info_row['moza_dated'];}?> </u> by the court of <?php echo $user_info_row['state'] ?> (selected state name).</p>

					<p>You may refer to these notification while claiming your subsidy on loan from PLI(Banks/Housing finance companies).</p>

					<p>This amount of subsidy also depends upon the amount you propose to borrow(principle amount of loan) and the number of years for which you propose to borrow the amount(Tenure of amount). To know the exact amount, go to <u>emi calculator</u>.</p>
				</div>
				<?php }
				elseif($this->session->flashdata('fourth'))
				{?>
				<div class="detailed-msgInnerbx" id="detailedMsg-case4">
					<p>As per the information given by you, you are not eligible for any subsidy under CLSS of PMAY(Urban).
					</p>

					<p>Your eligibility may change if you choose to construct/purchase a house at another location which is coming under PMAY(U).</p>
				</div>
				<?php }
				else
				{
					echo"Your Session Is Out Go To Homepage For More Detail";
				}
				?>


			</div>

			<div class="termsCondition-wrap">
			<?php
			if(empty($this->session->flashdata('second')))
			{
				if($this->session->flashdata('ews'))
				{
			?>
				<div id="ews" class="termsCondition-bx">

					<span>Terms and conditoin-</span>

					<ul>

					<li>You or any member of your family should not have availed assistance from central government under any of housing schemes earlier.</li>

					<li>The eligible amount indicated is maximum subsidy available to you on the basis of your family income. To subsidy varies on basis of borrowed amount and tenure(number of years) of loan. To know impact of these two <a href="<?php echo base_url()?>home/open_calc">click here</a>.
					</li>

					<li>Carpet Area-Under EWS normally should not be more than 30 Sq. Metre however in you can construct larger house but your subsidy will be restricted to only 30 sq. metre of carpet area. For extension of the house the carpet area limit of 30 sq. metre has to be adhered. To know more DOWNLOAD APP.</li>

					<li>The constructed houses should be in confirmative with building norms and standard. To know more, download App.</li>

					<li>Registration-House should be registered in name of female head of household or in joint name of male head and his wife. Only in cases where no adult female member in the family the house can be in name of male member of family. </li>

					<li>The constructed house should have water supply, electricity, drainage and sanitation.</li>
					</ul>
				</div>
				<?php }
				elseif ($this->session->flashdata('lig')) 
				{?>

				<div id="lig" class="termsCondition-bx">
					<span>Terms and conditoin-</span>
						<ul>
						<li>You or any member of your family should not have availed assistance from central government under any of housing schemes earlier.</li>
						<li>The eligible amount indicated is maximum subsidy available to you on the basis of your family income. To subsidy varies on basis of borrowed amount and tenure(number of years) of loan. To know impact of these two click here.</li>
						<li>Carpet Area-Under LIG normally should not be more than 60 Sq. metre however in you can construct larger house but your subsidy will be restricted to only 60 sq. metre of carpet area. For extension of the house the carpet area limit of 60 sq. metre has to be adhered. To know more DOWNLOAD APP.</li>
						<li>The constructed houses should be in confirmative with building norms and standard. To know more DOWNLOAD APP.</li>
						<li>Registration-House should be registered in name of female head of household or in joint name of male head and his wife. Only in cases where no adult female member in the family the house can be in name of male member of family. </li>
						<li>The constructed house should have water supply, electricity, drainage and sanitation.</li>
						</ul>

				</div>
				<?php }
				elseif ($this->session->flashdata('mig_1'))
				{?>

				<div id="mig_1" class="termsCondition-bx">
					<span>Terms and conditoin-</span>
					<ul>
						<li>You or any member of your family should not have availed assistance from central government under any of housing schemes earlier.</li>
						<li>The eligible amount indicated is maximum subsidy available to you on the basis of your family income. To subsidy varies on basis of borrowed amount and tenure(number of years) of loan. To know impact of these two click here.</li>
						<li>The carpet area of the constructed house under MIG-1, should not be more than 160 sq. metre. To know more DOWNLOAD APP.</li>
						<li>The constructed houses should be in confirmative with building norms and standard. To know more, download App.</li>
						<li>The constructed house should have water supply, electricity, drainage and sanitation.</li>
					</ul>
					
				</div>
				<?php }
				elseif ($this->session->flashdata('mig_2'))
				{?>
				<div id="mig_2" class="termsCondition-bx">
					<span>Terms and conditoin-</span>
						<ul style="margin-bottom: 4px;">
							<li>You or any member of your family should not have availed assistance from central government under any of housing schemes earlier.</li>
							<li>The eligible amount indicated is maximum subsidy available to you on the basis of your family income. To subsidy varies on basis of borrowed amount and tenure(number of years) of loan. To know impact of these two click here.</li>
							<li>The carpet area of the constructed house under MIG-2, should not be more than 200 sq. metre.To know more DOWNLOAD APP.</li>
							<li>The constructed houses should be in confirmative with building norms and standard. To know more, download App.</li>
							<li>The constructed house should have water supply, electricity, drainage and sanitation.</li>
						</ul>
				</div>
				<?php }
				else
				{
					echo"Your Session Is Out Go To Homepage For More Details";
				}
			}
				?>

				<p>For furthur details mail to - <a href="mailto:mokshitaluthra@pmawas.com">mokshitaluthra@pmawas.com</a></p>
			</div>

		</div>
	</section>
</body>
</html>

