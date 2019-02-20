<!-- <script type="text/javascript" src="<?php echo base_url_custom;?>js/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url_custom;?>js/script.js"></script> -->
<!-- <script type="text/javascript" src="<?php base_url_custom;?>js/bootstrap.min.js"></script> -->
<!-- <script>alert();</script> -->
<!-- <script>$("#case2").show();</script> -->

<section class="report-wraper">
	<div class="container">
		<a href="javascript:void()" class="print_btn" onclick="window.print();">Print</a>
		<div class="top-reportbx">
			<span>Dear <?php echo $this->session->flashdata('username');?>,</span>
			<div id="case1" class="report-case">
				<p class="indentext">As per the information given by you,you are eligible for government subsidy under CLSS of PMAY(U) for an amount of upto Rs. <?php echo $this->session->flashdata('XXXX');?> lakhs.</p>
				<p>This amount of subsidy also depends upon the amount you propose to borrow(principle amount of loan) and the number of years for which you propose to borrow the amount(Tenure of amount). To know the exact amount, go to emi calculator.</p>
			</div>
			<div id="case2" class="report-case case2">
				<p class="indentext">As per the information given by you, you are not eligible for any subsidy under CLSS of PMAY(Urban).</p>
			</div>
			<div id="case3" class="report-case">
				<p class="indentext">In our database, as per the terms and conditions for subsidy under PMAY(Urban) your place of choice is eligible for government subsidy under CLSS of PMAY(U) for an amount of upto Rs. <?php echo $this->session->flashdata('XXXX');?> lakhs. Get our “Detailed Report” Service for proof.</p>

				<p>This amount of subsidy also depends upon the amount you propose to borrow(principle amount of loan) and the number of years for which you propose to borrow the amount(Tenure of amount). To know the exact amount, go to emi calculator.</p>

			</div>
			<div id="case4" class="report-case">
				<p class="indentext">As per the information given by you, you are not eligible for any subsidy under CLSS of PMAY(Urban).</p>

				<p>Your eligibility may change if you choose to construct/purchase a house at another location which is coming under PMAY(U). Contact Us for this to give survey again.</p>
			</div>

			<div id="ews" class="termsCondition-bx">

				<span>Terms and conditoin-</span>

				<ul>

					<li>You or any member of your family should not have availed assistance from central government under any of housing schemes earlier.</li>

					<li>The eligible amount indicated is maximum subsidy available to you on the basis of your family income. To subsidy varies on basis of borrowed amount and tenure(number of years) of loan. To know impact of these two click here.
					</li>

					<li>Carpet Area-Under EWS normally should not be more than 30 Sq. Metre however in you can construct larger house but your subsidy will be restricted to only 30 sq. metre of carpet area. For extension of the house the carpet area limit of 30 sq. metre has to be adhered. To know more DOWNLOAD APP.</li>

					<li>The constructed houses should be in confirmative with building norms and standard. To know more, download App.</li>

					<li>Registration-House should be registered in name of female head of household or in joint name of male head and his wife. Only in cases where no adult female member in the family the house can be in name of male member of family. </li>

					<li>The constructed house should have water supply, electricity, drainage and sanitation.</li>
				</ul>
			</div>
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
			<div id="mig_2" class="termsCondition-bx">
				<span>Terms and conditoin-</span>
				<ul>
					<li>You or any member of your family should not have availed assistance from central government under any of housing schemes earlier.</li>
					<li>The eligible amount indicated is maximum subsidy available to you on the basis of your family income. To subsidy varies on basis of borrowed amount and tenure(number of years) of loan. To know impact of these two click here.</li>
					<li>The carpet area of the constructed house under MIG-2, should not be more than 200 sq. metre.To know more DOWNLOAD APP.</li>
					<li>The constructed houses should be in confirmative with building norms and standard. To know more, download App.</li>
					<li>The constructed house should have water supply, electricity, drainage and sanitation.</li>
				</ul>
			</div>

		</div>

		<!--Choose Our service buton wrap start here-->
		<div class="chooseOur-servicebx">
			<div class="chooseSerBtn-boxWraper">
				<div class="chooseSerBtn-bx">
					<a class="chooseSer-btn" href="<?php echo base_url()?>pdf_report/landing_page" data-placement="bottom" data-toggle="tooltip" title="Get report of your survey answers and eligiility status">Download Detailed Report</a>
				</div>
				<!-- <div class="chooseSerBtn-bx">
					<a class="chooseSer-btn disabled" href="javascript:void(0)" data-placement="top" data-toggle="tooltip" title="Hooray!">Detailed Report</a>
				</div>
				<div class="chooseSerBtn-bx">
					<a class="chooseSer-btn disabled" href="javascript:void(0)" data-placement="top" data-toggle="tooltip" title="Hooray!">Detailed Report</a>
				</div>
				<div class="chooseSerBtn-bx">
					<a class="chooseSer-btn disabled" href="javascript:void(0)" data-placement="top" data-toggle="tooltip" title="Hooray!">Detailed Report</a>
				</div> -->

			</div>
		</div>
		<!--Choose Our service buton wrap end here-->
	</div>
</section>
<!-- js added -->


<script>
// $(document).ready(function(){
//     $('[data-toggle="tooltip"]').tooltip();   
// });
//document.getElementById('case2').style.display = "block";

</script>
<!-- <script>$('#case2').show();</script> -->
<!-- <script>$("#case2").show();</script> -->

<?php 
$flag = 1;
$user_id = $this->session->tempdata('user_id');
$column='message';
 $subsidy_amount =  $this->session->flashdata('XXXX');
if($this->session->flashdata('second'))
{
	$notification_eng='As per the information given by you, you are not eligible for any subsidy under CLSS of PMAY(Urban)';
	$notification_hin='आपके द्वारा दी गई जानकारी के अनुसार, आप PMAY (शहरी) के CLSS के तहत किसी भी सब्सिडी के लिए पात्र नहीं हैं।';
	saveNotification($notification_eng,$notification_hin,$user_id,$column);
	$flag = 2;
	echo"<script>$('#case2').show();</script>";
	
	
}
elseif($this->session->flashdata('first'))
{
	$notification_eng='As per the information given by you,you are eligible for government subsidy under CLSS of PMAY(U) for an amount of upto Rs. '.$subsidy_amount.' lakhs.';
	$notification_hin='आपके द्वारा दी गई जानकारी के अनुसार, आप '.$subsidy_amount.' लाख रुपये तक की राशि के लिए PMAY (U) के CLSS के तहत सरकारी सब्सिडी के लिए पात्र हैं।';
	saveNotification($notification_eng,$notification_hin,$user_id,$column);
	echo"<script>$('#case1').show();</script>";
}
elseif($this->session->flashdata('third'))
{
	$notification_eng='In our database, as per the terms and conditions for subsidy under PMAY(Urban) your place of choice is eligible for government subsidy under CLSS of PMAY(U) for an amount of upto Rs. '.$subsidy_amount.' lakhs. Get our “Detailed Report” Service for proof';
	$notification_hin='हमारे डेटाबेस में, PMAY (शहरी) के तहत सब्सिडी के लिए नियमों और शर्तों के अनुसार, आपकी पसंद का स्थान '.$subsidy_amount.' लाख रुपये तक की राशि के लिए PMAY (U) के CLSS के तहत सरकारी सब्सिडी के लिए पात्र है। सबूत के लिए हमारी "विस्तृत रिपोर्ट" सेवा प्राप्त करें।';
	saveNotification($notification_eng,$notification_hin,$user_id,$column);
	echo"<script>$('#case3').show();</script>";
}
elseif($this->session->flashdata('fourth'))
{
	
	$notification_eng='As per the information given by you, you are not eligible for any subsidy under CLSS of PMAY(Urban)';
	$notification_hin='आपके द्वारा दी गई जानकारी के अनुसार, आप PMAY (शहरी) के CLSS के तहत किसी भी सब्सिडी के लिए पात्र नहीं हैं।';
	saveNotification($notification_eng,$notification_hin,$user_id,$column);
}
else
{
	echo "no cause found";	
}

if($flag==1)
{
	if($this->session->flashdata('ews'))
	{
		
		echo"<script>$('#ews').show();</script>";
		
	}
	elseif($this->session->flashdata('lig'))
	{
		echo"<script>$('#lig').show();</script>";
	}
	elseif($this->session->flashdata('mig_1'))
	{
		echo"<script>$('#mig_1').show();</script>";
	}
	elseif($this->session->flashdata('mig_2'))
	{
		echo"<script>$('#mig_2').show();</script>";
	}
	else
	{
		echo "No terms and condition found";
	}
}

?>