<?php

echo $this->session->flashdata('first');
echo $this->session->flashdata('second');
echo $this->session->flashdata('third');
echo $this->session->flashdata('fourth');
?>

<section class="report-wraper">
	<div class="container">
		<div class="top-reportbx">
			<span>Dear Rakesh,</span>
					<p class="indentext">As per the information given by you,you are eligible for government subsidy under CLSS of PMAY(U) for an amount of upto Rs. XXXX lakhs.</p>
					<p>This amount of subsidy also depends upon the amount you propose to borrow(principle amount of loan) and the number of years for which you propose to borrow the amount(Tenure of amount). To know the exact amount, go to emi calculator.
					</p>

					<p>This amount of subsidy also depends upon the amount you propose to borrow(principle amount of loan) and the number of years for which you propose to borrow the amount(Tenure of amount). To know the exact amount, go to emi calculator.</p>

					<span>Terms and conditoin-</span>

		</div>

		<!--Choose Our service buton wrap start here-->
		<div class="chooseOur-servicebx">
			<h2>Choose Our Services...</h2>
			<div class="chooseSerBtn-boxWraper">
				<div class="chooseSerBtn-bx">
					<a class="chooseSer-btn" href="#" data-placement="bottom" data-toggle="tooltip" title="Hooray!">Get Services</a>
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
	<!-- Footer Start -->
	<!-- js added -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>