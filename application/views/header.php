<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Index</title>
	<!-- css added -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url_custom;?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url_custom;?>css/style.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url_custom;?>css/media.css">
	<link type="text/css" media="print" rel="stylesheet" href="<?php echo base_url_custom;?>css/print.css">
	<link href="<?php echo base_url_custom;?>css/dcalendar.picker1.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="<?php echo base_url_custom;?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php base_url_custom;?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url_custom;?>js/script.js"></script>
	<!-- <script type="text/javascript" src="<?php echo base_url_custom;?>js/sweetalert.min.js"></script> -->
	   <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
</head>
<body>
	<!-- Header start -->
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-3 col-xs-5">
					<div class="logo">
						<a href="<?php echo base_url_custom;?>"><img src="<?php echo base_url_custom;?>images/logo.png" class="img-responsive"></a>
					</div>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="top-header-info">
						<p><span>Housing</span>- Advisory from Conception to Completion</p>
					</div>
					<?php
					$lang = $this->session->userdata('page_lang');

					if($lang=='page_hin')
					{
						$hindi = 'selected';
						$english = '';
					}
					else
					{
						$hindi='';
						$english = 'selected';
					}

					?>
					<!-- <div onclick="myfunction('hin')">Hindi</div>
					<div onclick="destroy_lang_seeson()">English</div> -->

				</div>
				<div class="col-md-3 col-sm-3">
					<div class="top-social-bar">
						<ul>
							<li><a target="blank" href="https://www.facebook.com/WealthTree-Technologies-Pvt-Ltd-686869851669514/" class="facebook"></a></li>
							<li><a href="#" class="g-plus"></a></li>
							<li><a href="#" class="twitter"></a></li>
							<li><a target="blank" href="https://www.instagram.com/pmawas/?hl=en" class="insta"></a></li>
							<li class="side-info"><?php
				if($this->session->tempdata('first_name'))
				{?>
				<span>Welcome <?php echo  $this->session->tempdata('first_name');?></span>|
				<a href="<?php echo base_url('pdf_report/destroy_session');?>" class="toplogoutBtn">Logout</a>
						
				<?php }?></li>
						</ul>
					</div>
				</div>
			</div>
			<a href="javascript:void(0)"class="mobile-trigger">
				<span></span>
			</a>
		</div>
	</header>
	<!-- Header End -->

	<!-- MENU STRAT -->
	<nav class="menu-wraper">
		<div class="container">
			<ul class="menu">

				<?php 
				$url =  base_url(uri_string());

				//if($this->uri->segment(2)=='aboutus'){echo 'active';}die;
				?>
				<?php
				if($this->session->userdata('page_lang')=='page_hin')
				{
					?>
					<li><a class="<?php if($url=='http://13.126.99.14/wealthtree/index.php/' || $url=='http://13.126.99.14/wealthtree/index.php/survey' || $url=='http://13.126.99.14/wealthtree/index.php/survey/second_survey' || $url=='http://13.126.99.14/wealthtree/index.php/pdf_report/landing_page' || $url=='http://13.126.99.14/wealthtree/index.php/survey/report_view'){echo 'active';}?>" href="<?php echo base_url_custom;?>">होम</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='aboutus'){echo 'active';}?>" href="<?php echo base_url();?>home/aboutus">हमारे बारे में</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='faq'){echo 'active';}?>" href="<?php echo base_url();?>home/faq">सामान्य प्रश्न</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='scheme'){echo 'active';}?>" href="<?php echo base_url();?>home/scheme">योजनाएं</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='open_calc'){echo 'active';}?>" href="<?php echo base_url()?>home/open_calc">ईएमआई कैलेंडर</a></li>
				<li><a href="/wealthtree/blog">ब्लॉग</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='contact_us'){echo 'active';}?>" href="<?php echo base_url();?>home/contact_us">हमसे संपर्क करें</a></li>
				<li>
				<div id="language_div">	
					<select onchange="assiagn_lang_session(this.value)" id="selectLang" >
						<option disabled selected value="">Choose Language</option>
						<option <?php echo $hindi; ?> value="hin">Hindi</option>
						<option <?php echo  $english;?> value="eng">English</option>
					</select>
				</div>
				</li>



					<?php
				}
				else
				{
					?>
					<li><a class="<?php if($url=='http://13.126.99.14/wealthtree/index.php/' || $url=='http://13.126.99.14/wealthtree/index.php/survey' || $url=='http://13.126.99.14/wealthtree/index.php/survey/second_survey' || $url=='http://13.126.99.14/wealthtree/index.php/pdf_report/landing_page' || $url=='http://13.126.99.14/wealthtree/index.php/survey/report_view'){echo 'active';}?>" href="<?php echo base_url_custom;?>">HOME</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='aboutus'){echo 'active';}?>" href="<?php echo base_url();?>home/aboutus">ABOUT US</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='faq'){echo 'active';}?>" href="<?php echo base_url();?>home/faq">FAQ</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='scheme'){echo 'active';}?>" href="<?php echo base_url();?>home/scheme">SCHEMES</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='open_calc'){echo 'active';}?>" href="<?php echo base_url()?>home/open_calc">EMI CALCULATOR</a></li>
				<li><a href="/wealthtree/blog">BLOG</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='contact_us'){echo 'active';}?>" href="<?php echo base_url();?>home/contact_us">CONTACT US</a></li>
				<li>	<select onchange="assiagn_lang_session(this.value)" id="selectLang" >
						<option disabled selected value="">Choose Language</option>
						<option <?php echo $hindi; ?> value="hin">Hindi</option>						
						<option <?php echo  $english;?> value="eng">English</option>						

					</select>
				</li>


					<?php
				}

				?>
				
				
			</ul> 
		</div>
	</nav>
	
	<nav class="mobile-menu" id="mobileMenu">
		<ul>	
			<?php
				if($this->session->userdata('page_lang')=='page_hin')
				{
					?>
						<li><a class="<?php if($url=='http://13.126.99.14/wealthtree/index.php/' || $url=='http://13.126.99.14/wealthtree/index.php/survey' || $url=='http://13.126.99.14/wealthtree/index.php/survey/second_survey' || $url=='http://13.126.99.14/wealthtree/index.php/pdf_report/landing_page' || $url=='http://13.126.99.14/wealthtree/index.php/survey/report_view'){echo 'active';}?>" href="<?php echo base_url_custom;?>">होम</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='aboutus'){echo 'active';}?>" href="<?php echo base_url();?>home/aboutus">हमारे बारे में</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='faq'){echo 'active';}?>" href="<?php echo base_url();?>home/faq">सामान्य प्रश्न</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='scheme'){echo 'active';}?>" href="<?php echo base_url();?>home/scheme">योजनाएं</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='open_calc'){echo 'active';}?>" href="<?php echo base_url()?>home/open_calc">ईएमआई कैलेंडर</a></li>
				<li><a href="/wealthtree/blog">ब्लॉग</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='contact_us'){echo 'active';}?>" href="<?php echo base_url();?>home/contact_us">हमसे संपर्क करें</a></li>
				<li>	<select onchange="assiagn_lang_session(this.value)" id="selectLang" >
						<option disabled selected value="">Choose Language</option>
						<option <?php echo $hindi; ?> value="hin">Hindi</option>						
						<option <?php echo  $english;?> value="eng">English</option>						

					</select>
				</li>

					<?php
				}
				else
				{
					?>
					<li><a class="<?php if($url=='http://13.126.99.14/wealthtree/index.php/' || $url=='http://13.126.99.14/wealthtree/index.php/survey' || $url=='http://13.126.99.14/wealthtree/index.php/survey/second_survey' || $url=='http://13.126.99.14/wealthtree/index.php/pdf_report/landing_page' || $url=='http://13.126.99.14/wealthtree/index.php/survey/report_view'){echo 'active';}?>" href="<?php echo base_url_custom;?>">HOME</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='aboutus'){echo 'active';}?>" href="<?php echo base_url();?>home/aboutus">ABOUT US</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='faq'){echo 'active';}?>" href="<?php echo base_url();?>home/faq">FAQ</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='scheme'){echo 'active';}?>" href="<?php echo base_url();?>home/scheme">SCHEMES</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='open_calc'){echo 'active';}?>" href="<?php echo base_url()?>home/open_calc">EMI CALCULATOR</a></li>
				<li><a href="/wealthtree/blog">BLOG</a></li>
				<li><a class="<?php if($this->uri->segment(2)=='contact_us'){echo 'active';}?>" href="<?php echo base_url();?>home/contact_us">CONTACT US</a></li>
				<li>	<select onchange="assiagn_lang_session(this.value)" id="selectLang" >
						<option disabled selected value="">Choose Language</option>
						<option <?php echo $hindi; ?> value="hin">Hindi</option>						
						<option <?php echo  $english;?> value="eng">English</option>						

					</select>
				</li>


					<?php
				}

				?>
				
		</ul>
		<a href="javascript:void(0)" class="hide-trigger">x</a>
	</nav>
	
	<?php  if($this->session->tempdata('first_name'))
	{
		 //echo"Welcome &nbsp;". $this->session->tempdata('first_name');
	}
	?>
	<?php

		$method = $this->router->fetch_method();
		echo "<input type='hidden' id='method_name' value='".$method."'> ";
		// echo $method; die;

	?>
	<!-- MENU END -->
<script type="text/javascript">
function assiagn_lang_session(val)
{
	var language = val;
	$.ajax
		({
			type : "POST",
			url : "<?php echo base_url(); ?>home/generte_session?>",
			dataType : "json",
			data : {"language" : language},
			success : function(data)
			{
				console.log(data);
				if($('#method_name').val()!='report_view')
				{
					location.reload();

				}
				
			},
			error : function(data) {
				alert('Something went wrong');
			}
		});
}


</script>

<script>
if($('#method_name').val()=='report_view')
{
	// alert('hello');
	$('#selectLang').hide();
}
			
</script>