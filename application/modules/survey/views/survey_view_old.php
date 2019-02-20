<style>
.forhover:hover
{
  text-decoration: underline;
  cursor: pointer;
}
</style>
<section class="construct-quebox">
	<div class="container">
		<div class="wealth-tab">
			<form method="post" id="survey_form" action=<?php echo base_url()?>survey/survey_data>
				<ul class="tab-list">
					<li><a href="javascript:void(0)" class="tab tab-ac1 active">Check Your Eligibility</a></li>
					<li><a href="javascript:void(0)" class="tab tab-ac2">Preference</a></li>
				</ul>
				<div class="tab-content show" id="tab1">
					<div class="wealth-que-tab" id="que1">
						<h1 class="border-center-hding">Where Do You Want To Construct Your House ?</h1>
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<div class="slect-row">
									<select  id="state_id" name="state_id" onchange="get_city(this.value)" class="formfull-row" id="state">
										<option value="0" selected>Select A State</option>
										<?php
										//print_r($states); die;
										if(!empty($states))
										{
											foreach ($states as $key => $value)
											{

												echo"
												<option value='".$value['id']."'>".$value['name']."</option>
												";
											}
										}

										?>
									</select>
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<div class="slect-row">
									<select name="district_id" class="formfull-row" id="city" onchange="get_town(this.value)">
										<option value="0" selected="">Select Your District</option>
									</select>
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<div class="slect-row">
									<input type="text" id="town_field" autocomplete="off" value=""  onkeyup="get_town_name(this.value)" placeholder="Type two characters of your town/village" name="town_search" class="formfull-row1">
									<input type="hidden" name="town" id="town_hidden" value="">
									 <div  class="form-control" id="searched_item" name="search_street" style="border: 1px solid #00000073; height: 50px; display:none"></div>
									<!-- <select name="town" required class="formfull-row" id="town_select">
										<option value="0"  selected="">Select A Town</option>
										<option value="">Model Town</option>
										<option value="">New Town</option>
										<option value="others">Others</option>
									</select> -->
								</div>
							</div>
							<input type="hidden" name="ncity_id" id="ncity_id">
							<input type="hidden" name="moza_id" id="moza_id">

							<!-- <div class="col-md-6 col-sm-6">
								<div class="slect-row">
									<input onchange="movenext()"  id="place" type="text" class="formfull-row no-icon" name="place" placeholder="Place">
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="slect-row">
									<input onchange="movenext()" type="text" class="formfull-row no-icon" name="sub_place" id="sub_place" placeholder="Sub-place">
								</div>
							</div> -->

						</div>
						<a href="javascript:void(0)" id="next" class="next-btn">next</a>
					</div><!-- tab que end -->

					<div class="wealth-que-tab" id="que2">
						<h1 class="border-center-hding">Do You Own A Pakka House</h1>
						<div class="pkka-houseResultbx">
							<div class="row">
								<div class="col-md-5 col-sm-5 col-xs-6 bd-radio">
									<input type="radio" id="test9" name="is_pakka" value="yes">
									<label for="test9">Yes</label>
								</div>
								<div class="col-md-5 col-sm-5 col-xs-6 bd-radio">
									<input  type="radio" id="testa9" name="is_pakka" value="no">
									<label for="testa9">No</label>
								</div>
							</div>
						</div>
						<div class="pakka-house-memberbx" id="pkhouse">
							<div class="bd-radio pk-memberbx">
								<input type="radio"  id="test10" name="pakka" value="in your name">
								<label for="test10">In My Name</label>
							</div>
							<div class="bd-radio pk-memberbx">
								<input type="radio" id="test11" name="pakka" value="in name of your wife">
								<label for="test11">In Name Of My Wife</label>
							</div>
							<div class="bd-radio pk-memberbx">
								<input type="radio" id="test12" name="pakka" value="in joint name of your  husband/wife and you">
								<label for="test12">Joint Name Of My Wife & Me</label>
							</div>
							<div class="bd-radio pk-memberbx" title="loreum lipsum dor sit amet" >
								<input type="radio" id="test13" name="pakka" value="in name of any of your minor dependent Children">
								<label for="test13">In Name of Any of My Minor Dependent Children</label>
							</div>
						</div>
						<a href="javascript:void(0)" id="back-btn1" class="next-btn back-btn">Back</a>
						<a href="javascript:void(0)" id="next1" class="next-btn">next</a>
					</div><!-- tab que end -->

					<div class="wealth-que-tab" id="que3">
						<h1 class="border-center-hding">Who Else In Your Family Has Independent Income</h1>
						<div class="faimily-incomebox">
							<label class="container-check">No one
								<input type="checkbox" class="ncheck" name="family" id="nooneCheckbx" value="noone" checked>
								<span class="checkmark"></span>
							</label>
							<label class="container-check">Husband/Wife
								<input type="checkbox" class="wcheck check-noone" name="family" value="yes">
								<span class="checkmark"></span>
							</label>
							<div class="wife-salary-row" >
								<input type="number" name="independent_wife" placeholder="Enter Your Income / Salary (Monthly)" class="wsalary">
							</div>

							<label class="container-check">Son
								<input type="checkbox" class="scheck check-noone" name="family">
								<span class="checkmark"></span>
								<span class="apnd-icon" id="apnd-icon1"><a href="javascript:void(0)"></a></span>
							</label>
							<div class="son-salary-row">
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-12 sagebx">
										<select name="son[age][]" class="sage sonAge">
											<option value ="0"  selected>Select Age</option>
											<option value="17">Less Than 18</option>
											<option value="18">18 And Above</option>
										</select>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="number" id="append_son" name="son[salary][]" placeholder="Enter Your Income / Salary (Monthly)" class="wsalary sonSal">
									</div>
								</div>
							</div>
							<span id="sonsalaryrow">

							</span>
							<label class="container-check check-noone">Daughter
								<input type="checkbox"  class="dcheck" name="family">
								<span class="checkmark"></span>
								<span class="apnd-icon" id="apnd-icon2"><a href="javascript:void(0)"></a></span>
							</label>
							<div class="daughter-salary-row">
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-12 sagebx">
										<select name="daughter[age][]" class="sage dage">
											<option value ="0"  selected>Select Age</option>
											<option value="17">Less Than 18</option>
											<option value="18">18 And Above</option>
										</select>
									</div>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="number" id="append_dau" name="daughter[salary][]" placeholder="Enter Your Income / Salary (Monthly)" class="wsalary dsalary">
									</div>
								</div>
							</div>
							<span id="daughtersalaryrow"></span>
						</div>
						<a href="javascript:void(0)" id="next3" class="next-btn">next</a>
						<a href="javascript:void(0)" id="back-btn" class="next-btn back-btn">Back</a>
					</div>
					<div class="wealth-que-tab" id="ques4">
						<h1 class="border-center-hding">What Do you want?</h1>
						<div class="pkka-houseResultbx">
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-6 bd-radio">
									<input type="radio" id="construct" name="what_want" value="1">
									<label for="construct">Construct</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-6 bd-radio">
									<input  type="radio" id="purchase" name="what_want" value="2">
									<label for="purchase">Purchase</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-6 bd-radio">
									<input  type="radio" id="add_rooms" name="what_want" value="3">
									<label for="add_rooms">Add Rooms In Existing House</label>
								</div>
							</div>
						</div>
						<div class="formbtn-box">
							<button class="form-btn">Submit</button>
						</div>
						<a href="javascript:void(0)" id="back-btn2" class="next-btn back-btn">Back</a>
					</div>

				</div>
			</form>
		</div>
	</div>
</section>

<!--modal statr -->
<script>
	var state_id=$('#state_id').val();
	var district_id = $('#district_id').val();
</script>
<div class="optionPopup">
	<div class="optionPopup-inner">
		<form method="post" action="survey/town_data">
			<div class="first-namebx town-namebx">
				<label>Enter Your Town Name</label>
				<input type="text" id="town" name="first_name" class="formfull-row" placeholder="Enter Your Town Name" autocomplete="off" required>
			</div>
			<input type="button" onclick="submit_town_data()" name="send" class="form-btn" value="Submit">
		</form>
	</div>
	<span class="cut-optionPopup"></span>
</div>

<!--Model closed -->
<!-- modal for orrisa and west bengal -->
<div class="wbpopup">
	<div class="wbpopup-inner">
		<form method="post" action="survey/town_data">
			<div class=" town-namebx slect-row">
				<select id="state_name" class="formfull-row">
					<option disabled selected></option>
				</select>
				<!-- <input type="text" id="town" name="first_name" class="formfull-row" placeholder="Enter Your Town Name" autocomplete="off" required> -->
			</div>
			<div class=" town-namebx slect-row">
				<select onchange="get_moza(this.value)" id="near_id" class="formfull-row">
					<option disabled selected>Nearest City</option>
					<option>Moza</option>
				</select>
			</div>
			<div class=" town-namebx slect-row">
				<select id="moza_select" onchange="other_moza(this.value)" class="formfull-row">
					<option disabled selected>Moza</option>
				</select>
			</div>
			<input type="button" onclick="assian_hidden_val_move_next()" name="send" class="form-btn" value="Submit">
		</form>
	</div>
	<span class="cut-wbpopup"></span>
</div>

<!--/ modal for orrisa and west bengal -->


<!-- popup when moza other select -->

<div class="mozapopup">
	<div class="mozapopup-inner">
		<form method="post" action="">
			<div class="first-namebx town-namebx">
				<label>Enter Your Moza Name</label>
				<input type="text" id="moza_input" name="moza_name" class="formfull-row" placeholder="Enter Your Village" autocomplete="off" required>
			</div>
			<input type="button" onclick="submit_moza_data()" name="send" class="form-btn" value="Submit">
		</form>
	</div>
	<span class="cut-mozapopup"></span>
</div>


<!-- / popup when moza other select --> 


<script>
	function submit_town_data()
	{
		var state_id=$('#state_id').val();
		var city_id = $('#city').val();
		var town = $('#town').val();
	//alert(town);return false;

	$.ajax
	({
		type : "POST",
		url : "<?php echo base_url(); ?>survey/town_data?>",
		dataType : "json",
		data : {"state_id" : state_id,"city_id":city_id,"town":town},
		success : function(data)
		{
			//console.log(data);
			if(data.flag==5)
			{
				alert('Town Name is Already Existed');
			}
			else
			{

				// $("#town_select").html(data.option);
				// $('.optionPopup').hide();
					$('#town_hidden').val(data.option);
					$('#town_field').val(data.name);
					$('.optionPopup').hide();
					$('#searched_item').hide();

				
			}
		},
		error : function(data) {
			alert('Something went wrong');
		}
	});
}


// to enter moza in database
function submit_moza_data()
{
	var ncity_id=$('#near_id').val();

	// alert(ncity_id);
	// return false;
	// var city_id = $('#city').val();
	var moza_name = $('#moza_input').val();
	//alert(town);return false;

	$.ajax
	({
		type : "POST",
		url : "<?php echo base_url(); ?>survey/moza_data?>",
		dataType : "json",
		data : {"ncity_id" : ncity_id,"moza_name":moza_name},
		success : function(data)
		{
			//console.log(data);
			if(data.flag==5)
			{
				alert('Moza Name is Already Existed');
			}
			else
			{
				console.log(data);
				$("#ncity_id").val(data.ncity_id);
				$("#moza_id").val(data.moza_id);
				$('.mozapopup').hide();
				$('#que1').hide();
				$('#que3').show();
				// $("#phone").html(data);
				//alert(data);
			}
		},
		error : function(data) {
			alert('Something went wrong');
		}
	});
}	

function assian_hidden_val_move_next()
{
	var ncity_id = $('#near_id').val();
	var moza_id = $('#moza_select').val();
	$("#ncity_id").val(ncity_id);
	$("#moza_id").val(moza_id);
	$('.wbpopup').hide();
	$('#que1').hide();
	$('#que3').show();
}

</script>








<script type="text/javascript">

	function get_city(val)
	{
//alert(val);
city_id = val; 

$.ajax({
	type: "POST",
	url: "<?php echo base_url(); ?>" + "survey/get_city",
	dataType: 'json',
	data: {id:city_id},
	success: function(data){
            //alert(data);
            //alert(data);
            //console.log(data);
            $('#city').html(data);
        },
    });
}
</script>
<script>

	function movenext()
	{
		var s = $('#state').val();
		var d = $('#district').val();
		var p = $('#place').val();
		var sub_place = $('#sub_place').val();

        //alert(s+"--"+d+"---"+p);
        if (s == '' || d == '' || p == '' || sub_place =='') {
            //alert('all field are required');
            return false; 
        }
        else{
        	console.log(sub_place);
        	//console.log(s);
        	// alert('completed');
        	$('#que1').hide();
        	$('#que3').show();
        }
    }
    function movepakka()
    {
	// var value = $('#testa9').val();
	// console.log(value);
}	
</script>

<script type="text/javascript">
	
// $('input[name=pakka]').on('change', function() {
// 	//alert('hello sir')
//     $(this).closest("form").submit();
// });
</script>

<!-- <script>
 if($('input[name=pakka]')is(':checked'))
	{
		 alert('hello this is checked');
	}
</script> -->
<script type="text/javascript">
	$('#back-btn').click(function(){
		$('#que3').hide();
		$('#que1').show();
	});
	$('#back-btn1').click(function(){
		$('#que2').hide();
		$('#que3').show();
	});

	$('#back-btn2').click(function(){
		$('#ques4').hide();
		$('#que2').show();
	});

// 	$(document).on('change','#town',function () {
//     var value1 = ($('option:selected', this).val());
//     // alert(value1);
//     if ((value1 === "others")) {
//         alert("value1");

//     }
// });
</script>

<script>
	function for_other()
	 {
		// if ($(this).val() == "others")
		// {
			if($('#state_id').val() == 29 || $('#state_id').val() == 41)
			{
			//alert($('#state_id').val());return false;
			$('.wbpopup').show();
			var state_id = $('#state_id').val();
			ajax_for_ncity(state_id);

			}
			else{

				$('.optionPopup').show();
			}
		// }
		// else if ($(this).val() != "others") {
		// 	$('.optionPopup').hide();
		// 	$('.wbpopup').hide();
		// }
	}
	$('.cut-optionPopup').click(function(){
		$('.optionPopup').hide();
	});
	$('.cut-wbpopup').click(function(){
		$('.wbpopup').hide();
	});
	$('.cut-mozapopup').click(function(){
		$('.mozapopup').hide();
	});
</script>

<script type="text/javascript">

	function get_town(val)
	{
		//alert(val);
		// blank the search fields value everytime city got changed
		$('#town_hidden').val('');
		$('#town_field').val('');
		$('#searched_item').hide();
		c_id = val; 

		$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>" + "survey/get_town",
		dataType: 'json',
		data: {id:c_id},
		success: function(data){
            //alert(data);
            //alert(data);
            console.log(data);
            $('#town_select').html(data);
        },
    });
}
</script>
<script>
	function ajax_for_ncity(val)
	{
		var state_id = val;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "survey/get_nearest_city",
			dataType: 'json',
			data: {id:state_id},
			success: function(data){
            //alert(data);
            //alert(data);
            console.log(data);
            $('#near_id').html(data.option);
            $('#state_name').html(data.sname);
        },
        error : function(data) {
        	alert('Something went wrong');
        }
    });
	}
</script>
<script>
	function get_moza(val)
	{
		var ncity_id = val;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "survey/get_moza",
			dataType: 'json',
			data: {id:ncity_id},
			success: function(data){
            //alert(data);
            //alert(data);
            console.log(data);
            $('#moza_select').html(data.option);
            // $('#state_name').html(data.sname);
        },
        error : function(data) {
        	alert('Something went wrong');
        }
    });
	}
</script>

<script>
	function other_moza(val)
	{
	//alert(val);
	var others = val;
	if(others == 'moza_others')
	{
		$('.wbpopup').hide();
		$('.mozapopup').show();

	}
	// if ($(this).val() == "moza_others")
	// {
	// 	alert(val);
	// }
}
</script>

<script>


//var total_income = '';
//var i = 0;
//$('$apnd-icon1').click(function(){
//    alert(i);
//    i++;
//    
//});
$(".dage").change(function(e)
{
	//alert('change');
	 $('#append_son').attr('data','zero');
});
$("#next3").click(function(e)
{
   //  alert($('.sonSal').children().last().attr('id')) ;
	var user_income = '<?php echo $income;?>';
	//alert(user_income);
	var wife_salary = $("input[name=independent_wife]").val();
	wife_salary = wife_salary || 0;
	//alert(wife_salary); 
	//return false;
	var values = $("input[name='son[salary][]']")
	.map(function(){return $(this).val();}).get();
              //alert(values);

              var son_ages = $("select[name='son[age][]']")
              .map(function(){return $(this).val();}).get();
              //console.log(values);

    // var sonage_array = $("input[name='son[age][]']").map(function(){return $(this).val();}).get();
    // console.log(sonage_array);
    // alert(sonage_array);
   // return false;
   var total_son_income = 0;
   for (var i = 0; i < son_ages.length; i++)
	{	//console.log(son_ages[i]);
		if(son_ages[i] < 18)
		{
			// alert('not adult');
			//alert(values[i]);
			total_son_income += parseInt(values[i]);
	    	//alert(total_son_income);
	    }
	}


	// for (var i = 0; i < values.length; i++)
	// {
	//     total_son_income += values[i] << 0;
	// }
	var d_array = $("input[name='daughter[salary][]']")
	.map(function(){return $(this).val();}).get();
              //alert(values);
              //console.log(values);
              var d_age = $("select[name='daughter[age][]']").map(function(){return $(this).val();}).get();
              var total_daughter_income = 0;
              for (var i = 0; i < d_age.length; i++)
	{	//console.log(d_age[i]);
		if(d_age[i] < 18)
		{
			// alert(d_age[i]);
			// alert(d_array[i]);
			total_daughter_income += parseInt(d_array[i]);
	    	///alert(total_daughter_income);
	    }
	}
	// alert(wife_salary);
	console.log(parseInt(user_income));
	console.log(parseInt(wife_salary));
	if(isNaN(wife_salary))
	{
		wife_salary=0;
	}
	if(isNaN(total_son_income))
	{
		total_son_income=0;
	}
	if(isNaN(total_daughter_income))
	{
		total_daughter_income=0;
	}
	if(isNaN(user_income))
	{
		user_income=0;
	}
	console.log(parseInt(total_son_income));
	// alert(parseInt(total_son_income));

	console.log(parseInt(total_daughter_income));
	var total_salary = parseInt(user_income) + parseInt(wife_salary) + parseInt(total_son_income) + parseInt(total_daughter_income);
	// alert(total_salary);
	// return false;
	 //var total_income += total_salary;
	 $("#next1").val(total_salary);

var sonAge = $(".sonAge").val();
 var sonSal = $(".sonSal").val();
 //var sonSal1 = $("#abc").val();
 var dAge = $(".dage").val();
 var dSal = $(".dsalary").val();
 var son = $('#append_son').attr('data');
 var dau = $('#append_dau').attr('datad'); 

//alert(typeof son+'--www');
			//alert('son.l--'+ typeof son.length);
//alert('dau--'+dau);
 		//$('#next1').attr('das',total_salary);
	 if((total_salary*12) > 1800000)
	 {
		//alert('above 18 lac');
		$(this).closest("form").submit();
	}
  
   else if ((typeof son  !== "undefined" )   &&  (son.toString().length <  2) )

	{
       // alert('fgfd');  //return false;
        for(var i=1;i<= son; i++){
            var val1 = $('#append_son_id_'+i).val(); 
            var sona1 = $('#append_sona_id_'+i).val(); 
        
            if( val1 == ""  && sona1 != "0")
            {          
                    alert("Please Enter Son's Salary.");
                    return false;
            }
             if( sona1 == "0" && val1 != "")
			{
				alert("Please Enter Son's Age.");
				 return false;
			}
            else{
            	//alert('son');
            	$('#que3').hide();
				$('#que2').show();
            }
        }
        //alert('ll'); 
	}

	else if (typeof dau  !== "undefined")

	{
       // alert('mannu');
           for(var i=1;i<= dau; i++){
               var dausal = $('#append_dau_id_'+i).val(); 
               var dauage = $('#append_daua_id_'+i).val(); 
          		// alert(dausal);
               if( dausal == ""  && dauage != "0")
               {          
                      alert("Please Enter Daughter's Salary.");
                      e.preventDefault();
                       //return false;
               }
              else if( dauage == "0" && dausal != "")
				{
					alert("Please Enter Daughter's Age.");
					e.preventDefault();
					// return false;
				}
				else{
				//	alert('dau');
	            	$('#que3').hide();
					$('#que2').show();
            	}
           }
	}
        

	else if( sonAge == "0" && sonSal != "")
	{
		//alert('eee');
		alert("Please Enter Son's Age.");
		e.preventDefault();
	}
	else if( sonSal == ""  && sonAge != "0")
	{      
		//alert('ggg');    
		alert("Please Enter Son's Salary.");
		e.preventDefault();
	}

	else if( dAge == "0" && dSal != "")
	{
		alert("Please Enter Daughter's Age.");
		e.preventDefault();
	}
	else if( dSal == ""  && dAge != "0")
	{
		alert("Please Enter Daughter's Salary.");
		e.preventDefault();
	}
	// else if( dSal == ""  && dAge == "0" ){
	// 	$('#que3').hide();
	// 	$('#que2').show();
	// 	e.preventDefault();
	// }
	else
	{
		//alert('final');
		$('#que3').hide();
		$('#que2').show();
	}

	
       
      //  alert('stop');

});

// next bitton of pakka house question
$("#next1").click(function()
{
	var total_income = $("#next1").val();
		//alert(total_income);
	//console.log(total_income);
	if($('#testa9').is(':checked'))
	{ 
		$("#survey_form").submit();
	}
	else if (!$('input[name=pakka]:checked').val()) {
        alert("required");
   }
	else if(parseInt(total_income*12) < 600000)
	{
		console.log(total_income);
		$('#que2').hide();
		$('#ques4').show();
	}
	else
	{
		$(this).closest("form").submit();
	}
});

</script>

<script>
// when i clicked on no on pakka house
 // function move_to_second()
 // {
 // 	//alert('aaya ni idhar');
 // 	$("#survey_form").submit();
 // 	//$(this).closest("form").submit();
 // }
</script>
<script>
	function get_town_name(val)
	{
		var state_id= $('#state_id').val();
		var city= $('#city').val();
		 //console.log(city);
		// return false;
		if(state_id==0 || city==0 || city==null)
		{
			alert('Please Choose State/District First');
			$('#town_field').val('');
			return false;
		}
		 var latter  = val;
		 if(latter.length	> 1)
		 {
			$.ajax
			({
				type : "POST",
				url : "<?php echo base_url(); ?>survey/get_town_names?>",
				dataType : "json",
				data : {"town_alphbets" : latter,"city_id":city},
				success : function(data)
				{
					// console.log(data);
					$('#searched_item').show();
					$('#searched_item').html(data.span_html);
					//console.log(data);
					
					// if(data.flag==5)
					// {
					// alert('Town Name is Already Existed');
					// }
					// else
					// {

					// $("#town_select").html(data.option);
					// $('.optionPopup').hide();
					// $("#phone").html(data);
					//alert(data);
				},
				error : function(data) 
				{
					alert('Something went wrong');
				}
			});
		 }
	}
	function get_this_name(town_id)
	{
		var id = town_id;
		if(id=='others')
		{
			var state_id= $('#state_id').val();
			// alert(state_id);
			// alert(city);
			var city= $('#city').val();
			if(state_id && city)
			{
				//$('#town_hidden').val('');
				$('#town_field').val('others'); // insert serch field others value so thaat we can make validation for it
				for_other();
			}
			else
			{
				alert('Please Choose State/District First');
				$('#town_field').val('');
				return false;
			}
		}
		else
		{

		
			// alert(id);
			// alert(this.innerHTML);
			// $('#town_field').val(id);
			// $('#town_field').val(id);
			$.ajax
			({
				type : "POST",
				url : "<?php echo base_url(); ?>survey/get_town_name_for_field?>",
				dataType : "json",
				data : {"id" : town_id},
				success : function(data)
				{
					$('#town_hidden').val(data.id);
					$('#town_field').val(data.name);
					$('#searched_item').hide();
				},
				error : function(data) 
				{
					alert('Something went wrong');
				}
			});
		}
	}
</script>

<script>
// next button of page where user choose city,district,town


$('#next').click(function(){
        var s = $('#state_id').val();
        var d = $('#city').val();
        var p = $('#town_field').val();
        //alert(s+"--"+d+"---"+p);
        if (s == '0' || d == '0' || p == '0' || p=='' || p==null) {
            alert('all field are required');
             return false; 
        }

        //ajax to check weather the town name given by user exist in database or not

        $.ajax
			({
				type : "POST",
				url : "<?php echo base_url(); ?>survey/check_town_name_exist_or_not?>",
				dataType : "json",
				data : {"town_name" : p,"city_id":d},
				success : function(data)
				{
					if(data=='0')
					{
						alert('Town name You entered is not in our database please choose other option');
						$('#town_field').val('');	
					}
					else
					{
						console.log(data);
						$('#town_hidden').val(data.id);	
						// return false;
						$('#que1').hide();
						$('#que3').show();
						// alert('town exist go ahead');
					}
					
				},
				error : function(data) 
				{
					alert('Something went wrong');
				}
			});







        // else{
        //     $('#que1').hide();
        //     $('#que3').show();
        // }
    });

</script>