// $(document).ready(function(){
//  $('.mobile-trigger').click(function(){
//      $('body').addClass('show-nav');
//  });

//  $('.hide-trigger').click(function(){
//      $('body').removeClass('show-nav');
//  });
//  $('.subsidybtn').click(function(){
//      $('body').addClass('show-popup');
//  });

//  $('.hide-phNopopup').click(function(){
//      $('body').removeClass('show-popup');
//  });
//  $('.hide-otppopup').click(function(){
//      $('.otpPopup-wraper').hide();
//  });

//  // $('.tab').click(function(event){-
//  //  event.preventDefault();
//  //  $('.tab').removeClass('active');
//  //  $('.tab-content').removeClass('show');
//  //  $(this).addClass('active');
//  //  $($(this).attr('href')).addClass('show');
//  // });

//  $('#next').click(function(){
//      var s = $('#state').val();
//      var d = $('#district').val();
//      var p = $('#place').val();
//         //alert(s+"--"+d+"---"+p);
//      if (s == '' || d == '' || p == '') {
//             // alert('all field are required');
//             $("#error").text("all field are required");
//             return false; 
//         }
//         else{
//          $('#que1').hide();
//          $('#que2').show();
//         }
//  });

// $("#test9").click(function(){
//  if ($('input[id=test9]:checked').val()){
//         $("#pkhouse").show();
//     }
// });

// $("#testa9").click(function(){
//  if ($('input[id=testa9]:checked').val()){
//         $("#pkhouse").hide();
//     }
// });

// $("#next1").click(function(){
//  if($('input[id=test9]:checked').val()){
//  if (!$('input[name=pakka]:checked').val()) {
//         $('#error1').text("required");
//     }
// }

//  if($('input[id=test9]:checked').val()){
//      if ($('input[name=pakka]:checked').val()) {
//      $('#que2').hide();
//         $('#que3').show();
//     }
//  }
//     if($('input[id=testa9]:checked').val()){
//      $('#que2').hide();
//         $('#que3').show();
//     }

// });

// // show hide checkbox
//     $(".wcheck").on("click",function() {
//      $(".wife-salary-row").toggle(this.checked);
//   });
//     $(".scheck").on("click",function() {
//      $(".son-salary-row").toggle(this.checked);
//      $("#apnd-icon1").toggle(this.checked);

//   });

//     $(".dcheck").on("click",function() {
//         $(".daughter-salary-row").toggle(this.checked);
//      $("#apnd-icon2").toggle(this.checked);

//   });

//     var i = 0;
//  $("#apnd-icon1 a").click(function(){
//      //alert('hlo');
//      i++;
   
 
//       $('#sonsalaryrow').append('<div id="row'+i+'" class="apnd-row"><div class="son-salary-row"><div class="row"><div class="col-md-4 sagebx"><select class="sage"><option>Select Age</option><option>12</option><option>12</option><option>12</option></select></div><div class="col-md-8"><input type="text" name=arr[] placeholder="Enter Your Income / Salary (Monthly)" class="wsalary"></div></div></div><a id='+i+' class="custom_cut"></a></div>')
//     });
//     $(document).on('click','.custom_cut', function(){
//        var button_id = $(this).attr("id");
//        $("#row"+button_id+"").remove();
//     });

//     $("#apnd-icon2 a").click(function(){
//      i++;
 
//       $('#daughtersalaryrow').append('<div id="roww'+i+'" class="apnd-row"><div class="daughter-salary-row"><div class="row"><div class="col-md-4 sagebx"><select class="sage"><option>Select Age</option><option>12</option><option>12</option><option>12</option></select></div><div class="col-md-8"><input type="text" name="" placeholder="Enter Your Income / Salary (Monthly)" class="wsalary"></div></div></div><a id='+i+' class="custom_cut1"></a></div>')
//     });
//     $(document).on('click','.custom_cut1', function(){
//        var button_id1 = $(this).attr("id");
//        $("#roww"+button_id1+"").remove();
//     });


//     $("#next3").click(function(){
//   var fields = $("input[name='family']").serializeArray(); 
//     if (fields.length === 0) 
//     { 
//         $('#error2').text("required");
//         // cancel submit
//         return false;
//     } 
//     else 
//     { 
//     $('#tab1').removeClass('show');
//     $($(this).attr('href')).addClass('show');
//     $('.tab-ac1').removeClass('active');
//     $('.tab-ac2').addClass('active');
//     }
// });
//     //login
// $('#login-form').click(function(){
//  var logNo = $('#login-no').val();
//  if(logNo == ""){
//      alert("please enter your Mobile Number");
//      return false;
//  }
//  else{
//      $('.phNopopup-wraper').hide();
//      $('.otpPopup-wraper').css("top","0");
//      return false;
//  }
//      });
// $('#verify-btn').click(function(){
//  window.open("construct-house.html");
// });

// // otp move input
// $(".otp-input").keyup(function() {
//     if($(this).val().length >= 1) {
//       var input_flds = $(this).closest('.otp-inputbox').find('.otp-input:input');
//       input_flds.eq(input_flds.index(this) + 1).focus();
//     }
// });

// });


// // Onload
// $("#pkhouse").show();




$(document).ready(function(){
   // alert('helllo');
    $('.mobile-trigger').click(function(){
        $('body').addClass('show-nav');
    });

    $('.hide-trigger').click(function(){
        $('body').removeClass('show-nav');
    });
    $('.subsidybtn').click(function(){
        $('body').addClass('show-popup');
        $('#login-no').val('');
        $('.phNopopup-wraper').show();    
    });

    $('.hide-phNopopup').click(function(){
        $('body').removeClass('show-popup');

    });
    $('.hide-otppopup').click(function(){
        // $('.otpPopup-wraper').hide();
        $('.otpPopup-wraper').css("top","-100%");
        //location.reload();
    });

    $('.getservBtn').click(function(){
    $('body').addClass('showPopup');
    $('#login-No').val('');
    $('.phNopopup-wraper1').show();
  });
    $('#hidephNopopup').click(function(){
        $('body').removeClass('showPopup');
    });

    $('#hideOtppopup').click(function(){
        $('.otpPopup-wraper1').css('top','-100%');
        //location.reload();
    });

    // $('.tab').click(function(event){
    //  event.preventDefault();
    //  $('.tab').removeClass('active');
    //  $('.tab-content').removeClass('show');
    //  $(this).addClass('active');
    //  $($(this).attr('href')).addClass('show');
    // });

    // $('#next').click(function(){
    //     var s = $('#state_id').val();
    //     var d = $('#city').val();
    //     var p = $('#town_field').val();
    //     //alert(s+"--"+d+"---"+p);
    //     if (s == '0' || d == '0' || p == '0') {
    //         alert('all field are required');
    //          return false; 
    //     }
    //     else{
    //         $('#que1').hide();
    //         $('#que3').show();
    //     }
    // });

$("#test9").click(function(){
    //alert('hello');
    if ($('input[id=test9]:checked').val()){
        $("#pkhouse").show();
    }
});

$("#testa9").click(function(){
    if ($('input[id=testa9]:checked').val()){
        $("#pkhouse").hide();
    }
});

// $("#next1").click(function(){
//     if($('input[id=test9]:checked').val()){
//         //alert('checked');
//     if (!$('input[name=pakka]:checked').val()) {
//         alert("required");
//     }
// }

//  if($('input[id=test9]:checked').val()){
//         if ($('input[name=pakka]:checked').val()) {
//         $('#que2').hide();
//         $('#ques4').show();
//     }
// }
//     if($('input[id=testa9]:checked').val()){
//         $('#que2').hide();
//         $('#ques4').show();
//     }

// });

// show hide checkbox
    $(".wcheck").on("click",function() {
        $(".wife-salary-row").toggle(this.checked);
  });
    $(".scheck").on("click",function() {
        $(".son-salary-row").toggle(this.checked);
        $("#apnd-icon1").toggle(this.checked);

  });

    $(".dcheck").on("click",function() {
        $(".daughter-salary-row").toggle(this.checked);
        $("#apnd-icon2").toggle(this.checked);

  });

    var i = 0;
   // $("#apnd-icon1 a").live('click',function(){
    $(document).on('click','#apnd-icon1 a', function(){
        //alert('hlo');
        i++;
       //  $('#append_dau').attr('datad','zero'); 
      $('#append_son').attr('data',i);
 
      $('#sonsalaryrow').append('<div id="row'+i+'" class="apnd-row"><div class="son-salary-row"><div class="row"><div class="col-md-4 sagebx"><select id ="append_sona_id_'+i+'" name="son[age][]" class="sage sonAge"><option style="background-color:#D3D3D3;" value="0">Select Age</option><option value="17">Less Than 18</option><option value="18">18 And Above</option></select></div><div class="col-md-8"><input id ="append_son_id_'+i+'" type="number" name=son[salary][] placeholder="Enter Your Income / Salary (Monthly)" class="wsalary sonSal"></div></div></div><a id='+i+' class="custom_cut"></a></div>')
    });
    $(document).on('click','.custom_cut', function(){
       var button_id = $(this).attr("id");
       $("#row"+button_id+"").remove();
    });
var j = 0;
    $("#apnd-icon2 a").click(function(){        
        j++;
        $('#append_son').attr('data','zero');
         $('#append_dau').attr('datad',j); 
      $('#daughtersalaryrow').append('<div id="roww'+j+'" class="apnd-row"><div class="daughter-salary-row"><div class="row"><div class="col-md-4 sagebx"><select id ="append_daua_id_'+j+'" name="daughter[age][]" class="sage"><option style="background-color:#D3D3D3;" value="0">Select Age</option><option value="17">Less Than 18</option><option value="18">18 And Above</option></select></div><div class="col-md-8"><input id ="append_dau_id_'+j+'" type="number" name="daughter[salary][]" placeholder="Enter Your Income / Salary (Monthly)" class="wsalary"></div></div></div><a id='+j+' class="custom_cut1"></a></div>')
    });
    $(document).on('click','.custom_cut1', function(){
       var button_id1 = $(this).attr("id");
       $("#roww"+button_id1+"").remove();
    });


//     $("#next3").click(function(){
//     //  var fields = $("input[name='family']").serializeArray(); 
//     // if (fields.length === 0) 
//     // { 
//     //    // alert('nothing selected'); 
//     //     // cancel submit
//     //     return false;
//     // } 
//     // else 
//     // { 
//      $('#que3').hide();
//      $('#que2').show();
//    // }
// });
    //login
$('#login-form').click(function(){
    var logNo = $('#login-no').val();
    var length = logNo.length;
    console.log(length);
    if(logNo == "")
    {
        alert("please enter your Mobile Number");
        return false;
    }
    else if(length < 10 )
    {
        alert('Mobile number should be 10 digit number');
        return false;
    }
    else
    {
        $('.phNopopup-wraper').hide();
        $('.otpPopup-wraper').css("top","0");
        return false;
    }
});

$('#loginForm').click(function(){
    var logNo1 = $('#login-No').val();
    var length = logNo1.length;
      console.log(length);
    if(logNo1 == "")
    {
        alert("please enter your Mobile Number");
        return false;
    }
    else if(length < 10)
    {
        alert('Mobile number should be 10 digit number');
        return false;
    }
    else{
        $('.phNopopup-wraper1').hide();
        $('.otpPopup-wraper1').css("top","0");
        return false;
    }
});


$('#verify-btn').click(function(){
    window.open("construct-house.html");
});


// otp move input
$(".otp-input").keyup(function(e) {
    if($(this).val().length >= 1) {
      var input_flds = $(this).closest('.otp-inputbox').find('.otp-input:input');
      input_flds.eq(input_flds.index(this) + 1).focus();
    }
    else if(e.keyCode == 8 ){

         var inputs = $('input.otp-input');
         var index = inputs.index(this);
        if (index != 0)
            {
                 var input_flds = $(this).closest('.otp-inputbox').find('.otp-input:input');
              input_flds.eq(input_flds.index(this) - 1).focus();
                        
            } 


    }
});
// aboutus tab start
// $(".aboutTab a").click(function(e) {
// e.preventDefault();
//     $(".aboutTab a").removeClass("active");
//     $(".aboutus-tab-content").removeClass("show");
//     $(this).addClass("active");
//     $($(this).attr("href")).addClass("show");
// });

// aboutus tab  end

// landing page hover tab start
    $(".getServicebtn-inner").hover(function() {
    $('.getServicebtn-inner').removeClass('active');
    $(this).addClass('active');
    $(".getServiceInfo-bx").removeClass("show-serv");
    $($(this).attr("cust")).addClass("show-serv");
});
  // landing page hover tab End

  // Get Service otp verification
  



$('.check-noone').click(function(){  
  $('#nooneCheckbx').prop('checked', false);
});

$('#nooneCheckbx').click(function(){  
  $('.check-noone').prop('checked', false);
});

$('h#currM').parent().css('background-color:','blue');

});


// Onload
$("#pkhouse").show();

