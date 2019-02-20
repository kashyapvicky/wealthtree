	<section class="home-category-wraper">
		<div class="container">
			<div class="row">
				<aside class="col-md-4 col-sm-5">
					<div class="case-message-wraper">
				<a href="<?php echo base_url('pdf_report/destroy_session');?>" class="logoutBtn">Logout</a>
				<?php //echo print_r($home_user_row); die;?>
						<span>Dear <?php echo $home_user_row['first_name'];?></span>
						<p><?php echo $home_user_row['message'];?></p>

						<p>Get our "Detailed Report" Service.</p>
					</div>
				</aside>
				<div class="col-md-8 col-sm-7">
					<div class="serviceGet-serviceBx">
						<h2>Get Services</h2>
						<div class="getServicebtn-box">
							<div class="getServicebtn">
								<a  cust="#custom-serv1" class="getServicebtn-inner active">Detailed Report</a>
							</div>
							<div class="getServicebtn">
								<a cust="#custom-serv2" class="getServicebtn-inner">General Consultation</a>
							</div>
							<div class="getServicebtn">
								<a  cust="#custom-serv3" class="getServicebtn-inner">Legal Services</a>
							</div>
							<div class="getServicebtn">
								<a  cust="#custom-serv4" class="getServicebtn-inner">Designing Advisory</a>
							</div>
							<div class="getServicebtn">
								<a cust="#custom-serv5" class="getServicebtn-inner">Financial Advisory</a>
							</div>
						</div>

						<div class="getServiceInfo-bx show-serv" id="custom-serv1">
							<img src="<?php echo base_url_custom;?>images/detailed_report.png" alt="">
							<p>Know answers of your survey question and download your customized report.</p>
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf1">Download</a>
						</div>
						<div class="getServiceInfo-bx" id="custom-serv2">
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf">Download Detail Report</a>
							<img src="<?php echo base_url_custom;?>images/general_consultation.png" alt="">
							<p>Talk with our experts to know about housing and the PMAY scheme and how can you be benefitted.</p>
							<?php
							$id = $home_user_row['id'];

							?>
							<p><a href="<?php echo base_url('home/contact_us?u_id='.$id.'')?>">Contact Us</a></p>
						</div>
						<div class="getServiceInfo-bx" id="custom-serv3">
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf">Download Detail Report</a>
							<img src="<?php echo base_url_custom;?>images/legal_services.png" alt="">
							<p>Get property related legal advisory, getting necessary approvals and due procedure done.</p>
							<p>This facility is under Development.</p>
						</div>
						<div class="getServiceInfo-bx" id="custom-serv4">
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf">Download Detail Report</a>
							<img src="<?php echo base_url_custom;?>images/designing_advisory.png" alt="">
							<p>Getting the property material in your name, preparing architectural plan as per Rules and Regulations.</p>
							<p>This facility is under Development.</p>
						</div>
						<div class="getServiceInfo-bx" id="custom-serv5">
							<a href="<?php echo base_url()?>pdf_report/report_page_pdf" class="downloadPdf">Download Detail Report</a>
							<img src="<?php echo base_url_custom;?>images/financial_advisory.png" alt="">
							<p>In getting approval for the loan and advice on availing the best loan amount and tenure.</p>
							<p>This facility is under Development.</p>
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
			<h1 class="border-center-hding">How It Work</h1>
			<p>These steps will help you understand the process Briefly.</p>
		</div>
		<div class="work-category-wraper">
			<div class="work-category-item1">
				<div class="work-category-item-info">
					<h6>Know Your Subsidy Entitlement</h6>
					<p>Take our eligibility survey to know your eligibility under CLSS, also know the maximum amount of subsidy you may be entitled to.</p>
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
					<h6>Select the services in which you need expert assistance</h6>
					<p>Out of many services like Consultation/Legal Matters/Finance/Architechtural Engineering/Aproval Form Authority select which you need and get expert assistance in each area of service.</p>
				</div>
			</div>
			<div class="work-category-item3">
				<div class="work-category-item-info">
					<h6>Pay only for selected Services</h6>
					<p>You pay a very reasonable amount only for services you need.</p>
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
					<h6>Monitor the state of Services</h6>
					<p>In a later stage you can keep a check on all services status which you have availed</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- How  Will Work Wraper End -->
</body>
</html>