<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <link href="<?php echo base_url_custom;?>admin_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <!-- MetisMenu CSS -->
    <link href="<?php echo base_url_custom;?>admin_assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
   <link href="<?php echo base_url_custom;?>admin_assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url_custom;?>admin_assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
   
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><font size="5px" color="red">Reset Password</font></h3>
                                 <?php echo validation_errors(); ?> 
             <?php  
            echo $this->session->flashdata('link_sent');
            echo $this->session->flashdata('email_not_found');
            ?> 
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo base_url()?>admin/reset_password" method="post">
                            <input type="hidden" name="id" value="<?php if($id){echo $id;}else{echo set_value('id');};?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="password" required type="password" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="cnf_password" required type="password" autofocus>
                                </div>
                                <button class="btn btn-lg btn-success btn-block">Submit</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <script src="<?php echo base_url_custom;?>admin_assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url_custom;?>admin_assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url_custom;?>admin_assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url_custom;?>admin_assets/dist/js/sb-admin-2.js"></script>

</body>

</html>
