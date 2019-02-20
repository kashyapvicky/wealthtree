

	<section class="aboutus-wraper">
		<div class="container">
			<div class="aboutus-inner-wrap">
				<div class="aboutus-infoBx">
					<p>House is one of the biggest investment that we make in our life time. For this one time investment you need guidance at every level from conception till its completion. We wish to act as single point service provider at each and every stage in constructing or buying a house. </p>
				</div>
				<div class="abouts-infoImg">

					<img src="<?php echo base_url_custom;?>/images/aboutus.png" alt="" class="img-responsive">
				</div>
			</div>

			<div class="investmentBox-wraper">
				<p>Investment Advisory:</p>
				<div class="investment-advisory-box">Where to buy/construct</div>
				<div class="investment-advisory-box">When to buy/construct</div>
				<div class="investment-advisory-box">What to buy/construct</div>
				<div class="investment-advisory-box">How should I buy/construct</div>
			</div>
		</div>
	</section>

<section class="aboutus-tab-wraper">

			<h2>Our Services</h2>
			<p>The aim is to make you realize the dream of owning a house by being your single point advisory from-conception to completion</p>
			<div class="aboutus-tab-bx">
				<!-- <div class="aboutus-tabImg">
					<img src="<?php echo base_url_custom;?>images/preview.gif" alt="" class="img-responsive">
				</div> -->
				<div class="aboutus-tabs">
					<div class="aboutTab"><a href="javascript:void(0)" class="dot">Legal</a></div>
					<div class="aboutTab"><a href="javascript:void(0)" class="dot">Designing</a></div>
					<div class="aboutTab"><a href="javascript:void(0)" class="dot">Approval</a></div>
					<div class="aboutTab"><a href="javascript:void(0)" class="dot">Supervision</a></div>
					<div class="aboutTab"><a href="javascript:void(0)" class="dot">Financial</a></div>
				</div>
				<div class="aboutus-tab-content" id="about-tab1">
					<h6>Legal Advisory:</h6>
					<ul>
						<li>In getting you legal advice on the property related documents.</li>
						<li>In completing your land related documents</li>
						<li>In getting all thel necessary approvals.</li>
						<li>In getting all due procudure done.</li>
					</ul>
				</div>
				<div class="aboutus-tab-content" id="about-tab2">
					<h6>Designing Advisory:</h6>
					<ul>
						<li>Getting the property material in your name.</li>
						<li>Preparing architectural plan as per Rules and Regulations.</li>
						<li>Preparing structural designs as per Rules and Regulations.</li>
					</ul>
				</div>
				<div class="aboutus-tab-content" id="about-tab3">
					<h6>Approval Services: </h6>
					<ul>
						<li>In getting approvals for construction from appropriate authority.</li>
					</ul>
				</div>
				<div class="aboutus-tab-content" id="about-tab4">
					<h6>Supervision</h6>
					<ul>
						<li>Supervising construction for completion.</li>
					</ul>
				</div>
				<div class="aboutus-tab-content" id="about-tab5">
					<h6>Financial Advisory:</h6>
					<ul>
						<li> In getting approval of loan.</li>
					</ul>
				</div>
			</div>

	</section>

	<section class="state-wraper">
		<div class="container">
			<p class="state-hdng">These services at initial stage shall be provided only in <span>4 states:</span></p>
			<div class="state-box">
				<div class="state-box-inner">
					<div class="state-img">
						<img src="<?php echo base_url_custom;?>images/up.png" alt="" class="img-responsive">
					</div>
					<p>Uttar Pradesh</p>
				</div>
			</div>
			<div class="state-box">
				<div class="state-box-inner">
					<div class="state-img">
						<img src="<?php echo base_url_custom;?>images/bihar.png" alt="" class="img-responsive">
					</div>
					<p>Bihar</p>
				</div>
			</div>
			<div class="state-box">
				<div class="state-box-inner">
					<div class="state-img">
						<img src="<?php echo base_url_custom;?>images/west-bengal.png" alt="" class="img-responsive">
					</div>
					<p>West Bengal</p>
				</div>
			</div>
			<div class="state-box">
				<div class="state-box-inner">
					<div class="state-img">
						<img src="<?php echo base_url_custom;?>images/rajasthan.png" alt="" class="img-responsive">
					</div>
					<p>Rajasthan</p>
				</div>
			</div>
		</div>
	</section>

	<section class="ourTeam-wraper">
		<h6>Our Team</h6>

		<div class="directorCard-wraper">
			<div class="director-cardBx">
				<div class="director-card">
					<img src="<?php echo base_url_custom;?>images/female.png" alt="" class="img-responsive">
				</div>
				<h4>Dr. Smita Soni</h4>
				<p>Director</p>
				<a href="#" class="linkedin-icon"><i class="fa fa-linkedin"></i></a>
			</div>
		</div>
		<div class="team-bx-wraper">
			<div class="team-cardBx">
				<div class="team-card">
					<img src="<?php echo base_url_custom;?>images/male.png" alt="" class="img-responsive">
				</div>
				<h4>Hitesh Khatri</h4>
				<p>Core Team Member</p>
				<a href="#" class="linkedin-icon"><i class="fa fa-linkedin"></i></a>
			</div>
			<div class="team-cardBx">
				<div class="team-card">
					<img src="<?php echo base_url_custom;?>images/male.png" alt="" class="img-responsive">
				</div>
				<h4>Vihan Gupta</h4>
				<p>Core Team Member</p>
				<a href="#" class="linkedin-icon"><i class="fa fa-linkedin"></i></a>
			</div>
			<div class="team-cardBx">
				<div class="team-card">
					<img src="<?php echo base_url_custom;?>images/female.png" alt="" class="img-responsive">
				</div>
				<h4>Mokshita Luthra</h4>
				<p>Core Team Member</p>
				<a href="#" class="linkedin-icon"><i class="fa fa-linkedin"></i></a>
			</div>
		</div>
	</section>
	
<script type="text/javascript">
	var cInterval;
var images;
var thumbnails;
var cur;

onload=function()
{
	images=document.getElementsByClassName('aboutus-tab-content');
	thumbnails=document.getElementsByClassName('dot');
	cur=0;


	//Hiding all images
	for(i=0;i<images.length;i++)
	{
		images[i].style.display='none';
		images[i].addEventListener('mouseover',Pause);
		images[i].addEventListener('mouseout',Resume);
	}

	//Registering Events for Thumbnails
	for(i=0;i<thumbnails.length;i++)
	{
			//console.log(thumbnails);
	//thumbnails[i].classList.add("active");
		thumbnails[i].addEventListener('click',function(){
			Pause();
			HideImage();
			for(j=0;j<thumbnails.length;j++)
			{
				if(this==thumbnails[j])
				{

					cur=j;
					break;
				}
			}
			LoadImage();
			Resume();
		});
	}

	LoadImage();
	cInterval=setInterval("Next();",2000);

	document.getElementById('overlay').addEventListener('click',function(){
		this.style.display='none';
	});
}

function Previous()
{
	HideImage();
	//Change index
	if(cur==0)
	{
		cur=4;
	}
	else
	{
		cur=cur-1;
	}

	LoadImage();
}

function Next()
{
	HideImage();
	//Change index
	if(cur==4)
	{
		cur=0;
	}
	else
	{
		cur=cur+1;
	}
	
	LoadImage();
}

function HideImage()
{
	//Hide Current Image
	thumbnails[cur].classList.remove('active');
	images[cur].style.display='none';			
}

function LoadImage()
{
	//Show Next Image
	thumbnails[cur].classList.add('active');
	images[cur].style.display='block';
}

function Pause()
{
	clearInterval(cInterval);
}

function Resume()
{
	cInterval=setInterval("Next();",5000);
}


</script>