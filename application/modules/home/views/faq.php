	

	<section class="faq-wraper">
		<div class="mobileFaq-nav">
			<a href="javascript:void(0)" id="faqNav">Select Category</a>
		</div>
		<div class="container">
			<div class="search-wraper">
				<div class="faqSearch-bar">
					<input type="text" name="searched_qn" id="search_qn" onkeyup="get_question(this.value)" placeholder="Search">
				</div>
				<div class="searchResult" id="search_result">
					
					

				</div>
			</div>
			<div class="faq-innerwraper">
				<!-- faq sidebar start  -->
				<div class="faq-sidebar">
					<ul class="faq-tabs">

						<?php
						foreach ($tabs as $key => $value)
						{
							// print_r($tabs); die;
							if($key==0)
							{
								$active='active';
							}
							else
							{
								$active='';
							}
							
						?>
							<li><a href="#faq-tab<?php echo $value['id'];?>" id="faq-tab_<?php echo $value['id'];?>" class="sidelink <?php echo $active;?>"><?=$value['name']?></a></li>

						<?php
						}



						?>
						<!-- <li><a href="#faq-tab1" id="faq-tab_1" class="sidelink active">BASIC TERMS</a></li>
						<li><a href="#faq-tab2" id="faq-tab_2" class="sidelink">PMAY ELIGIBILITY</a></li>
						<li><a href="#faq-tab3" id="faq-tab_3" class="sidelink">HOW To APPLY ?</a></li>
						<li><a href="#faq-tab4" id="faq-tab_4" class="sidelink">CARPET AREA</a></li>
						<li><a href="#faq-tab5" id="faq-tab_5" class="sidelink">PMAY SUBSIDY</a></li>
						<li><a href="#faq-tab6" id="faq-tab_6" class="sidelink">LOAN</a></li>
						<li><a href="#faq-tab7" id="faq-tab_7" class="sidelink">MISCELLANEOUS</a></li>
						<li><a href="#faq-tab8" id="faq-tab_8" class="sidelink">WOMAN OWNERSHIP</a></li> -->
					</ul>
				</div>
				<!-- faq sidebar end -->
				
				<div class="faq-contentbx-wraper">
					<?php
					$count=1;
					foreach ($content as $key => $value)
					{
						//echo"<pre>";print_r($content); die;
						if($count==1)
						{
							$class='show'; 
						}
						else
						{
							$class='';
						}
						echo'
						<div class="que-ans-locationBx '.$class.'" id="faq-tab'.$key.'">';
								foreach ($value as $inkey => $invalue) 
								{
									// print_r($invalue);die;
									echo'
									<div class="que-ansBx" id="que_ans_box_'.$count.'">
											<div class="quebx">
												<h4>'.$invalue['qes_name'].'</h4>
											</div>
											<div class="ansbx" id="ansbx_'.$invalue["qes_id"].'">
												<p>'.$invalue['ans_name'].'</p>
											</div>
									</div>';

								}
						echo"
						</div>";
						$count++;

					}
					?>
					<!-- WOMAN OWNERSHIP End Here -->
				</div>
			</div>
		</div>
	</section>
</body>
</html>
<script>

	 // Faq page js
$(document).ready(function(){
$(".ansbx").first().slideDown();
$(".quebx").removeClass('active');
$(".quebx").click(function(){
$(".ansbx").not($(this).next()).slideUp(300);
$(this).next(".ansbx").slideToggle(300);

$(".quebx").not($(this)).removeClass('active');
$(this).toggleClass('active');   
});


});



$(".faq-tabs a").click(function(e) {
e.preventDefault();
$(".faq-tabs a").removeClass("active");
$(".que-ans-locationBx").removeClass("show");
$(this).addClass("active");
$($(this).attr("href")).addClass("show");
});

$(document).ready(function(){
    $(window).scroll(function(){
        var hei1 = $('.header').height();
        var hei2 = $('.menu').height();
        var hei = hei1 + hei2;
        if($(window).scrollTop() > hei){
            $('.faq-tabs').addClass('fixed-faqNav');
        }
        else{
            $('.faq-tabs').removeClass('fixed-faqNav');
        }
    });
    $('#faqNav').click(function(){
        $('.faq-tabs').slideToggle();
    });
});
</script>
<script>
function for_tab()
{
window.location='http://13.126.99.14/wealthtree/index.php/home/faq#faq-tab2';
}
</script>
<script>
function get_question(val)
{
	qn_letters = val;
	 // alert(qn_letters);
	
		$.ajax
		({
			type : "POST",
			url : "<?php echo base_url(); ?>home/get_questions?>",
			dataType : "json",
			data : {"name" : qn_letters},
			success : function(data)
			{
				$('#search_result').html(data);
				$('.searchResult').show();
				
			},
			error : function(data) 
			{
				alert('Something went wrong');
			}
		});
	
}	
</script>
<script>
function get_it_answer(id)
{
	 // alert(id);
	 qn_tab_id = id;
	 var myarr = qn_tab_id.split("_");
	 question_id = myarr[0];
	 tab_id = myarr[1];
	///alert(question_id);
	//alert(tab_id);
	$('.que-ans-locationBx').removeClass('show');// remove each show class of que ans location box;
	$('#faq-tab'+tab_id).addClass('show');// add classs show on which user clicked;

	// $('.ansbx').removeClass('active');
	$('.ansbx').css("display","none");// to hide previous answer
	$('#ansbx_'+question_id).css("display", "block");// to show searched answer

	 // $('#ansbx_'+question_id).focus();

	$('.sidelink').removeClass('active');
	$('#faq-tab_'+tab_id).addClass('active');



	$('#search_result').html('');
	$('.searchResult').hide();


	$('html, body').animate({
        scrollTop: $("#ansbx_"+question_id).offset().top
    }, 2000);



}
// hide when clicked outside

$(document).mouseup(function(e) 
{
    var container = $("#search_result");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});
</script>
<script>

	function active_tab(id)
	{

		$('#faq-tab_2').addClass('active');
		$('#faq-tab_1').removeClass('active');
		$('.que-ans-locationBx').removeClass('show');

		$('#faq-tab2').addClass('show');
		


	}


</script>
<?php
	$var = $this->input->get('id');
	if($var==420)
	{
		?>
		<script>
			$('#faq-tab_1').removeClass('active');
			$('#faq-tab_2').addClass('active');
			$('.que-ans-locationBx').removeClass('show');
			$('#faq-tab2').addClass('show');
		</script>

		<?php
		
	}


	?>