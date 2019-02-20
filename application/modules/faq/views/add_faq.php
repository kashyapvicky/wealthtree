        <style>
        .error {
        color: red;
        /*background-color: #acf;*/
        }
        .glyphicon
         {
            cursor: pointer;
            font-size: 30px;
            top: 25px;
            }
        </style>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                     <button style="border: none; background: none; padding: 0;" id="back" class="glyphicon glyphicon-circle-arrow-left"></button>
                    <h1 class="page-header">Add Faq</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                     <?php echo $this->session->flashdata('insert_succ');

                     echo validation_errors();
                     ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Sub Admin
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form id="" action="<?php echo base_url('faq/add_question')?>" method="post">
                                <div class="row">
                                    <div class="col-md-2">
                                      
                                        <label>Select Cateogry</label>
                                    </div>
                                    <div class="col-md-6">
                                        <select required  class="form-control" name="faq_tab">
                                            <option disabled selected value="">Select Cateogry</option>
                                            <?php

                                            foreach ($tabs as $key => $value)
                                            {
                                            echo"
                                            <option value=".$value['id'].">".$value['name']."</option>
                                            ";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Question In English</label>
                                    </div>
                                    <div class="col-md-6">
                                       <textarea required name="question" placeholder="Type your question here.." class="form-control"></textarea> 
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Question In Hindi</label>
                                    </div>
                                    <div class="col-md-6">
                                       <textarea required name="question_hindi" placeholder="Type your question here.." class="form-control"></textarea> 
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Answer In English</label>
                                    </div>
                                    <div class="col-md-6">
                                        <textarea required name="answer" placeholder="Type your answer here.." class="form-control"></textarea>
                                    </div>
                                </div>
                               
                               <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Answer In Hindi</label>
                                    </div>
                                    <div class="col-md-6">
                                        <textarea required name="answer_hindi" placeholder="Type your answer here.." class="form-control"></textarea>
                                    </div>
                                </div>
                                <br>
                         
                                 <div class="row">
                                    <div class="col-md-2">
                                        
                                    </div>
                                    <div class="col-md-6" style="display: flex; justify-content: center;">
                                        <button class="btn btn-info">Submit</button>
                                    </div>
                            </form>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div><!--/row-->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<script>
    $().ready(function() {
        jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Please enter alphabets only"); 
        $("#admin_form").validate({
            rules: {
                
                name: {
                    required: true,
                    minlength: 3,
                    maxlength:35,
                    lettersonly: true
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength:35,
                },
                
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    minlength: 6,
                    maxlength:10
                },
                
            },
            messages: {
                
                name: {
                    required: "Please enter a name",
                    minlength: "Your name must consist of at least 3 characters",
                    maxlength: "Your name must not  consist of more than 35 characters",


                },
                mobile: {
                    required: "Please provide a mobile no",
                    minlength: "Your mobile no  must be at least 10 digit long",
                    maxlength: "Your mobile no must  not be more than 10 digit long",
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must  be at least 6 characters long",
                    maxlength: "Your password  must not be more than 10 characters ",
                },
                email: "Please enter a valid email address",
                
            }
        });
    });
</script>
    <script>
    $('#back').on('click', function(e){
    e.preventDefault();
    window.history.back();
    });
    </script>