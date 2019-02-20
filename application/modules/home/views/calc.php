<?php 
// if(!(empty($this->session->tempdata('user_id'))))
// {
// 	echo"<script>alert('".$this->session->tempdata('user_id')."')</script>";
// }
?>
	<section class="emi-calculate-wraper">
		<div class="container">
			<div class="topCalculate-bx">
				<h2 class="border-center-hding">To Calculate Total Subsidy amount and EMI, fill the following :</h2>

				<div class="calculate-box-wraper">
					<div class="calculatebx">
						<label>Enter Loan Amount</label>
						<div class="calculateInput">
							<span></span>
							<input type="text" name="" id="loan_amt" autofocus>
						</div>
					</div>
					<div class="calculatebx">
						<label class="tooltip1">Enter <u>Tenure</u>(in years)
							<span class="tooltiptext">In how many years you wish to pay the Loan with Interest amount</span>
						</label>
						<div class="calculateInput">
							<span></span>
							<input type="text" name="" id="tenure" autofocus> 
						</div>
					</div>
					<div class="calculatebx">
						<label class="tooltip1">Enter Monthly <u>Family</u> Income
							<span class="tooltiptext">Husband, wife and all dependant minor children is family according to scheme</span>
						</label>
						<div class="calculateInput">
							<span></span>
							<input type="text" id="income" name="" value="<?php
						 	if(!empty($total_income))
							{
								echo $total_income;
							}?>">
						</div>
					</div>

					<div class="calculatebtn-box">
						<button onclick="calculate_function()" type="button">CALCULATE</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Emi Scheme Wraper Start -->
	<section class="emiPmay-schemeWraper">
		<div class="container">
			<div class="withPmay-schemebx">
				<h3>With PMAY Scheme</h3>
				<div class="withPmay-inputWraper">
					<div class="withPmay-inputbx">
						<label>Total Subsidy Given</label>
						<input type="text" name="" id="subsidy_pmay" class="readonly-input" readonly>
					</div>
					<div class="withPmay-inputbx">
						<label>EMI</label>
						<input type="text" name="" id="emi" class="readonly-input" readonly>
					</div>
						<p>Total Amount you will be paying</p>
					<div class="withPmay-inputbx">
						<label>In <span id="tenure_year"></span> Years</label>
						<input type="text" name="" id="pmay_in_t_year" class="readonly-input" readonly>
					</div>
				</div>
			</div> <!-- With PMAY Scheme BOx End -->

			<div class="withoutPmay-schemebx">
				<h3>Without PMAY Scheme</h3>
				<div class="withoutPmay-inputWraper">
					<div class="withoutPmay-inputbx withPmay-inputbx">
						<label>Total Subsidy Given</label>
						<input type="text" name="" id="subsidy_without_pmay" class="readonly-input" readonly>
					</div>
					<div class="withoutPmay-inputbx withPmay-inputbx">
						<label>EMI</label>
						<input type="text" name="" id ="without_pmay_id" class="readonly-input" readonly>
					</div>
						<p>Total Amount you will be paying</p>
					<div class="withoutPmay-inputbx withPmay-inputbx">
						<label>In <span id="tenure_year_without_pmay"></span> Years</label>
						<input type="text" name="" id="without_pmay_in_t_year" class="readonly-input" readonly>
					</div>
				</div>
			</div>
			<div class="totalsavingPercenteg-bx">
				<div class="totalSavingbx">
					<label>Total Saving</label>
					<input type="text" name="" id="total_saving" class="readonly-input" readonly>
				</div>
				<div class="percenteagebx">
					<label>Percentage Saving</label>
					<input type="text" name="" id="percentage" class="readonly-input" readonly>
				</div>
				
			</div>

			<div class="emi_bottom-tagline">
				<p>*Bank/HFC interest rate is taken as 13% for calculation</p>
			</div>
		</div>
	</section>
	<!-- Emi Scheme Wraper End -->

<script>

 function calculate_function()
{
	var loan_amount = $("#loan_amt").val();
	var tenure = $("#tenure").val();
	$("#tenure_year").text(tenure);
	$("#tenure_year_without_pmay").text(tenure);
	var income = $("#income").val();
	//console.log("<?php echo base_url(); ?>" + "home/calculate");

	// console.log(loan_amount);
	// console.log(tenure);
	// console.log(income);
	$.ajax({
	type: "POST",
	url: "<?php echo base_url(); ?>" + "home/calculate",
	dataType: "json",
	data: {loan_amount:loan_amount,tenure:tenure,income:income},
	success: function(data){
			$("#subsidy_pmay").val(data.subsidy);
			$("#emi").val(data.emi);
			$("#percentage").val(data.percentage);
			$("#total_saving").val(data.total_saving);
			$("#without_pmay_id").val(data.EMIBank);
			$("#pmay_in_t_year").val(data.pmay_in_t_year);
			$("#without_pmay_in_t_year").val(data.without_pmay_in_t_year);
			$("#subsidy_without_pmay").val(0);
            console.log(data);
        },
		error : function(data) {
			alert('Something went wrong');
		}
    });
}

</script>