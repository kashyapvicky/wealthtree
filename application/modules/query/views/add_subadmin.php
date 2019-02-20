        <style>
        .error {
        color: red;
        /*background-color: #acf;*/
        }
        </style>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sub Admin</h1>
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
                            <form id="admin_form" action="<?php echo base_url('subadmin/add_subadmin')?>" method="post">
                                <input type="hidden" name="hidden_id" value="<?php if(!empty($admin_data)){echo $admin_data['id'];}?>">
                                <div class="row">
                                    <div class="col-md-2">
                                      
                                        <label>Admin Type</label>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="admin_type" required class="form-control" value="<?php  echo  set_select('admin_type')?>">
                                            <?php
                                        if($admin_data['level']==2)
                                        {
                                            $selected2="selected";
                                        }
                                        else
                                        {
                                            $selected2="";
                                        }
                                        if($admin_data['level']==3)
                                        {
                                            $selected3="selected";
                                        }
                                        else
                                        {
                                            $selected3="";
                                        }
                                        ?>
                                        <option disabled selected value="">Select Type</option>
                                        <option <?php echo $selected2 ?> value="2">Level-1 Admin</option>
                                        <option  <?php echo $selected3 ?> value="3">Level-2 Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:1%">
                                    <div class="col-md-2">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"  required name="name" value="<?php if(!empty($admin_data)){echo $admin_data['name'];} echo  set_value('name')?>" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:1%">
                                    <div class="col-md-2">
                                        <label>Mobile No</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" required name="mobile" value="<?php if(!empty($admin_data)){echo $admin_data['mobile_no'];} echo  set_value('mobile')?>" class="form-control" placeholder="Mobile No" onkeypress="if(this.value.length==10) return false;">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:1%">
                                    <div class="col-md-2">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" autocomplete="off" required value="<?php if(!empty($admin_data)){echo $admin_data['email'];} echo  set_value('email')?>" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:1%">
                                    <div class="col-md-2">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" autocomplete="off" value="<?php if(!empty($admin_data)){echo $admin_data['password'];}?>" required name="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                               <!--  <div class="row" style="margin-top:1%">
                                    <div class="col-md-2">
                                        <label>Confirm Password</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" value="<?php if(!empty($admin_data)){echo $admin_data['password'];}?>" required name="confirm_password" class="form-control" placeholder="Re Enter Password">
                                    </div>
                                </div> -->
                                 <div class="row" style="margin-top:1%">
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