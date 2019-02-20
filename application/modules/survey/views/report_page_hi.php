<!-- <script type="text/javascript" src="<?php echo base_url_custom;?>js/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url_custom;?>js/script.js"></script> -->
<!-- <script type="text/javascript" src="<?php base_url_custom;?>js/bootstrap.min.js"></script> -->
<!-- <script>alert();</script> -->
<!-- <script>$("#case2").show();</script> -->


<section class="report-wraper">
	<div class="container">
		<a href="javascript:void()" class="print_btn" onclick="window.print();">Print</a>
		<div class="top-reportbx">
			<span>प्रिय <?php echo $this->session->flashdata('username');?>,</span>
			<div id="case1" class="report-case">
				<p class="indentext">आपके द्वारा दी गई जानकारी के अनुसार, आप <?php echo $this->session->flashdata('XXXX');?> लाख रुपये तक की राशि के लिए PMAY (U) के CLSS के तहत सरकारी सब्सिडी के लिए पात्र हैं।</p>
				<p>सब्सिडी की यह राशि उस राशि पर भी निर्भर करती है, जिस पर आप उधार देने का प्रस्ताव करते हैं (ऋण की राशि) और वर्षों की संख्या जिसके लिए आप राशि उधार लेने का प्रस्ताव करते हैं (राशि का कार्यकाल)। सटीक राशि जानने के लिए, ईएमआई कैलकुलेटर पर जाएं।</p>
			</div>
			<div id="case2" class="report-case case2">
				<p class="indentext">आपके द्वारा दी गई जानकारी के अनुसार, आप PMAY (शहरी) के CLSS के तहत किसी भी सब्सिडी के लिए पात्र नहीं हैं।</p>
			</div>
			<div id="case3" class="report-case">
				<p class="indentext">हमारे डेटाबेस में, PMAY (शहरी) के तहत सब्सिडी के लिए नियमों और शर्तों के अनुसार, आपकी पसंद का स्थान <?php echo $this->session->flashdata('XXXX');?> लाख रुपये तक की राशि के लिए PMAY (U) के CLSS के तहत सरकारी सब्सिडी के लिए पात्र है। सबूत के लिए हमारी "विस्तृत रिपोर्ट" सेवा प्राप्त करें।</p>

				<p>सब्सिडी की यह राशि उस राशि पर भी निर्भर करती है, जिस पर आप उधार देने का प्रस्ताव करते हैं (ऋण की राशि) और वर्षों की संख्या जिसके लिए आप राशि उधार लेने का प्रस्ताव करते हैं (राशि का कार्यकाल)। सटीक राशि जानने के लिए, ईएमआई कैलकुलेटर पर जाएं।</p>

			</div>
			<div id="case4" class="report-case">
				<p class="indentext">आपके द्वारा दी गई जानकारी के अनुसार, आप PMAY (शहरी) के CLSS के तहत किसी भी सब्सिडी के लिए पात्र नहीं हैं।</p>

				<p>यदि आप पीएमएवाई (यू) के तहत आने वाले किसी अन्य स्थान पर घर बनाने / खरीदने के लिए चुनते हैं तो आपकी पात्रता बदल सकती है। इसके लिए हमसे फिर से संपर्क करें।</p>
			</div>

			<div id="ews" class="termsCondition-bx">

				<span>नियम व शर्तें-</span>

				<ul>

					<li>आपको या आपके परिवार के किसी भी सदस्य को पहले किसी भी आवासीय योजना के तहत केंद्र सरकार से सहायता नहीं लेनी चाहिए थी।</li>

					<li>इंगित की गई योग्य राशि आपके परिवार की आय के आधार पर आपके लिए उपलब्ध अधिकतम सब्सिडी है। सब्सिडी के लिए ऋण की राशि और कार्यकाल (वर्षों की संख्या) के आधार पर भिन्न होता है। इन दोनों के प्रभाव को जानने के लिए यहां क्लिक करें।
					</li>

					<li>कारपेट एरिया-अंडर ईडब्ल्यूएस सामान्य रूप से 30 वर्गमीटर से अधिक नहीं होना चाहिए। मीटर भले ही आप बड़े घर का निर्माण कर सकते हैं लेकिन आपकी सब्सिडी केवल 30 वर्ग मीटर के कालीन क्षेत्र तक ही सीमित रहेगी। घर के विस्तार के लिए 30 वर्ग मीटर के कालीन क्षेत्र की सीमा का पालन करना होगा। अधिक जानने के लिए, ऐप डाउनलोड करें।</li>

					<li>निर्मित मकान भवन के मानदंडों और मानक के साथ पुष्टिकारक होने चाहिए। अधिक जानने के लिए, ऐप डाउनलोड करें।</li>

					<li>पंजीकरण-घर को महिला मुखिया के नाम या पुरुष मुखिया और उसकी पत्नी के संयुक्त नाम से पंजीकृत किया जाना चाहिए। केवल उन मामलों में जहां परिवार में कोई वयस्क महिला सदस्य परिवार के पुरुष सदस्य के नाम पर नहीं हो सकती है।</li>

					<li>निर्मित घर में पानी की आपूर्ति, बिजली, जल निकासी और स्वच्छता होनी चाहिए।</li>
				</ul>
			</div>
			<div id="lig" class="termsCondition-bx">
				<span>नियम व शर्तें-</span>
				<ul>
					<li> आपको या आपके परिवार के किसी भी सदस्य को पहले किसी भी आवासीय योजना के तहत केंद्र सरकार से सहायता नहीं लेनी चाहिए थी।</li>
					<li>इंगित की गई योग्य राशि आपके परिवार की आय के आधार पर आपके लिए उपलब्ध अधिकतम सब्सिडी है। सब्सिडी के लिए ऋण की राशि और कार्यकाल (वर्षों की संख्या) के आधार पर भिन्न होता है। इन दोनों के प्रभाव को जानने के लिए यहां क्लिक करें।</li>
					<li>कार्पेट एरिया-अंडर एलआईजी आमतौर पर 60 वर्गमीटर से अधिक नहीं होना चाहिए। मीटर हालांकि, आप बड़े घर का निर्माण कर सकते हैं, लेकिन आपकी सब्सिडी केवल 60 वर्ग मीटर के कालीन क्षेत्र तक ही सीमित रहेगी। घर के विस्तार के लिए 60 वर्ग मीटर के कालीन क्षेत्र की सीमा का पालन करना होगा। अधिक जानने के लिए, ऐप डाउनलोड करें।</li>
					<li>निर्मित मकान भवन के मानदंडों और मानक के साथ पुष्टिकारक होने चाहिए। अधिक जानने के लिए, ऐप डाउनलोड करें।</li>
					<li>पंजीकरण-घर को महिला मुखिया के नाम या पुरुष मुखिया और उसकी पत्नी के संयुक्त नाम से पंजीकृत किया जाना चाहिए। केवल उन मामलों में जहां परिवार में कोई वयस्क महिला सदस्य परिवार के पुरुष सदस्य के नाम पर नहीं हो सकती है।</li>
					<li>निर्मित घर में पानी की आपूर्ति, बिजली, जल निकासी और स्वच्छता होनी चाहिए।</li>
				</ul>

			</div>
			<div id="mig_1" class="termsCondition-bx">
				<span>नियम व शर्तें-</span>
				<ul>
					<li>आपको या आपके परिवार के किसी भी सदस्य को पहले किसी भी आवासीय योजना के तहत केंद्र सरकार से सहायता नहीं लेनी चाहिए थी।</li>
					<li>इंगित की गई योग्य राशि आपके परिवार की आय के आधार पर आपके लिए उपलब्ध अधिकतम सब्सिडी है। सब्सिडी के लिए ऋण की राशि और कार्यकाल (वर्षों की संख्या) के आधार पर भिन्न होता है। इन दोनों के प्रभाव को जानने के लिए यहां क्लिक करें।</li>
					<li>एमआईजी -1 के तहत निर्मित घर का कालीन क्षेत्र, 160 वर्ग मीटर से अधिक नहीं होना चाहिए। अधिक जानने के लिए, ऐप डाउनलोड करें।</li>
					<li>निर्मित मकान भवन के मानदंडों और मानक के साथ पुष्टिकारक होने चाहिए। अधिक जानने के लिए, ऐप डाउनलोड करें।</li>
					<li>निर्मित घर में पानी की आपूर्ति, बिजली, जल निकासी और स्वच्छता होनी चाहिए।</li>
				</ul>

			</div>
			<div id="mig_2" class="termsCondition-bx">
				<span>नियम व शर्तें-</span>
				<ul>
					<li>आपको या आपके परिवार के किसी भी सदस्य को पहले किसी भी आवासीय योजना के तहत केंद्र सरकार से सहायता नहीं लेनी चाहिए थी।</li>
					<li>इंगित की गई योग्य राशि आपके परिवार की आय के आधार पर आपके लिए उपलब्ध अधिकतम सब्सिडी है। सब्सिडी के लिए ऋण की राशि और कार्यकाल (वर्षों की संख्या) के आधार पर भिन्न होता है। इन दोनों के प्रभाव को जानने के लिए यहां क्लिक करें।</li>
					<li>एमआईजी -2 के तहत निर्मित घर का कालीन क्षेत्र, 200 वर्ग मीटर से अधिक नहीं होना चाहिए। अधिक जानने के लिए, ऐप डाउनलोड करें।</li>
					<li>निर्मित मकान भवन के मानदंडों और मानक के साथ पुष्टिकारक होने चाहिए। अधिक जानने के लिए, ऐप डाउनलोड करें।</li>
					<li>निर्मित घर में पानी की आपूर्ति, बिजली, जल निकासी और स्वच्छता होनी चाहिए।</li>
				</ul>
			</div>

		</div>

		<!--Choose Our service buton wrap start here-->
		<div class="chooseOur-servicebx">
			<div class="chooseSerBtn-boxWraper">
				<div class="chooseSerBtn-bx">
					<a class="chooseSer-btn" href="<?php echo base_url()?>pdf_report/landing_page" data-placement="bottom" data-toggle="tooltip" title="Get report of your survey answers and eligiility status">विस्तृत रिपोर्ट डाउनलोड करें</a>
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
$column='message_hin';
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