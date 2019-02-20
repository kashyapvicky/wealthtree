
<!-- Footer Start -->
<footer class="footer">
	<div class="container">
		<div class="footer-menu-wraper">
			<div class="footer-logo">
				<a href="<?php echo base_url_custom;?>">
				<img src="<?php echo base_url_custom;?>images/logo-footer.png" alt="" class="img-responsive">
				</a>
			</div>
			<div class="footer-menu">
				<ul>
					<?php
				if($this->session->userdata('page_lang')=='page_hin')
				{
					?>
					<li><a href="<?php echo base_url_custom;?>">होम</a></li>
				<li><a  href="<?php echo base_url();?>home/aboutus">हमारे बारे में</a></li>
				<li><a href="<?php echo base_url();?>home/faq">सामान्य प्रश्न</a></li>
				<li><a href="<?php echo base_url();?>home/scheme">योजनाएं</a></li>
				<li><a href="<?php echo base_url()?>home/open_calc">ईएमआई कैलेंडर</a></li>
				<li><a href="/wealthtree/blog">ब्लॉग</a></li>
				<li><a href="<?php echo base_url();?>home/contact_us">हमसे संपर्क करें</a></li>


				<?php
				}
				else
				{
					?>

					<li><a href="<?php echo base_url_custom;?>">HOME</a></li>
				<li><a class=" href="<?php echo base_url();?>home/aboutus">ABOUT US</a></li>
				<li><a href="<?php echo base_url();?>home/faq">FAQ</a></li>
				<li><a href="<?php echo base_url();?>home/scheme">SCHEMES</a></li>
				<li><a href="<?php echo base_url()?>home/open_calc">EMI CALCULATOR</a></li>
				<li><a href="/wealthtree/blog">BLOG</a></li>
				<li><a href="<?php echo base_url();?>home/contact_us">CONTACT US</a></li>

					<?php
				}

				?>
				</ul>
			</div>
		</div>
		<div class="footer-social-wraper">
			<div class="footer-social-box">
				<div class="top-social-bar footer-social-bar">
					<h6 class="border-hding">Lets Get Social</h6>
					<ul>
						<li><a href="https://www.facebook.com/WealthTree-Technologies-Pvt-Ltd-686869851669514/" class="facebook" target="_blank"></a></li>
						<li><a href="#" class="g-plus" target="_blank"></a></li>
						<li><a href="#" class="twitter" target="_blank"></a></li>
						<li><a href="https://www.instagram.com/pmawas/?hl=en" class="insta" target="_blank"></a></li>
					</ul>
				</div>
				<div class="copy-right-wraper">
					<p>© Copyright 2018 company - All Rights Reservedd.</p>
				</div>
			</div>
		</div>
		
	</footer>


	


	
</body>
</html>
