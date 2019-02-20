	<section class="home-category-wraper">
		<div class="container">
			<div class="row">
				<aside class="col-md-4 col-sm-5">
					<div class="case-message-wraper">
				<a href="<?php echo base_url('pdf_report/destroy_session');?>" class="logoutBtn">लॉग आउट</a>
				<?php //echo print_r($home_user_row); die;?>
						<span>प्रिय  <?php echo $home_user_row['first_name'];?></span>
						<p><?php echo $home_user_row['message_hin'];?></p>

						<p>हमारी "विस्तृत रिपोर्ट" सेवा प्राप्त करें।</p>
					</div>
				</aside>
				<div class="col-md-8 col-sm-7">
					<div class="serviceGet-serviceBx">
						<h2>सेवाएँ प्राप्त करें</h2>
						<div class="getServicebtn-box">
							<div class="getServicebtn">
								<a  cust="#custom-serv1" class="getServicebtn-inner active">विस्तृत रिपोर्ट</a>
							</div>
							<div class="getServicebtn">
								<a cust="#custom-serv2" class="getServicebtn-inner">सामान्य परामर्श</a>
							</div>
							<div class="getServicebtn">
								<a  cust="#custom-serv3" class="getServicebtn-inner">कानूनी सेवा</a>
							</div>
							<div class="getServicebtn">
								<a  cust="#custom-serv4" class="getServicebtn-inner">डिजाइनिंग एडवाइजरी</a>
							</div>
							<div class="getServicebtn">
								<a cust="#custom-serv5" class="getServicebtn-inner">वित्तीय सलाहकार</a>
							</div>
						</div>

						<div class="getServiceInfo-bx show-serv" id="custom-serv1">
							<img src="<?php echo base_url_custom;?>images/detailed_report.png" alt="">
							<p>अपने सर्वेक्षण प्रश्न के उत्तर जानें और अपनी अनुकूलित रिपोर्ट डाउनलोड करें।</p>
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf1">डाउनलोड</a>
						</div>
						<div class="getServiceInfo-bx" id="custom-serv2">
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf">डिटेल रिपोर्ट डाउनलोड करें</a>
							<img src="<?php echo base_url_custom;?>images/general_consultation.png" alt="">
							<p>आवास और पीएमएवाई योजना के बारे में जानने के लिए हमारे विशेषज्ञों के साथ बात करें और आप कैसे लाभान्वित हो सकते हैं।</p>
							<?php
							$id = $home_user_row['id'];

							?>
							<p><a href="<?php echo base_url('home/contact_us?u_id='.$id.'')?>">हमसे संपर्क करें</a></p>
						</div>
						<div class="getServiceInfo-bx" id="custom-serv3">
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf">डिटेल रिपोर्ट डाउनलोड करें</a>
							<img src="<?php echo base_url_custom;?>images/legal_services.png" alt="">
							<p>संपत्ति संबंधी कानूनी सलाह प्राप्त करें, आवश्यक अनुमोदन और उचित प्रक्रिया पूरी करें।</p>
							<p>यह सुविधा विकास के अंतर्गत है।</p>
						</div>
						<div class="getServiceInfo-bx" id="custom-serv4">
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf">डिटेल रिपोर्ट डाउनलोड करें</a>
							<img src="<?php echo base_url_custom;?>images/designing_advisory.png" alt="">
							<p>अपने नाम पर संपत्ति सामग्री प्राप्त करना, नियम और विनियमों के अनुसार वास्तु योजना तैयार करना।</p>
							<p>यह सुविधा विकास के अंतर्गत है।</p>
						</div>
						<div class="getServiceInfo-bx" id="custom-serv5">
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf">डिटेल रिपोर्ट डाउनलोड करें</a>
							<img src="<?php echo base_url_custom;?>images/financial_advisory.png" alt="">
							<p>ऋण के लिए अनुमोदन प्राप्त करने और सर्वोत्तम ऋण राशि और कार्यकाल का लाभ उठाने की सलाह पर।</p>
							<p>यह सुविधा विकास के अंतर्गत है।</p>
						</div>

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
					<img src="<?php echo base_url_custom;?>images/subsidy1.png" alt="" class="img-responsive">
				</div>
			</div>
			<div class="work-category-item2">
				<div class="work-category-item-image">
					<img src="<?php echo base_url_custom;?>images/requirement.png" alt="" class="img-responsive">
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
					<img src="<?php echo base_url_custom;?>images/customized.png" alt="" class="img-responsive">
				</div>
			</div>
			<div class="work-category-item4">
				<div class="work-category-item-image">
					<img src="<?php echo base_url_custom;?>images/loan-subsidy.png" alt="" class="img-responsive">
				</div>
				<div class="work-category-item-info">
					<h6>सेवाओं की स्थिति की निगरानी करेंs</h6>
					<p>बाद के चरण में आप उन सभी सेवाओं की स्थिति पर नज़र रख सकते हैं, जिनका आपने लाभ उठाया है</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- How  Will Work Wraper End -->
</body>
</html>