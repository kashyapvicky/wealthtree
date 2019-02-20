
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                    <a class="btn btn-primary" href="<?php echo base_url()?>users/view_survey?id=<?php echo $user_info['id']; ?>">View Survey</a>
                    <br><br>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b> User Detail</b>
                        </div>
                        <!-- /.panel-heading -->
                        <?php
                            // echo"<pre>";
                            // print_r($user_info);die;
                         ?>
                        <div class="panel-body">
                            <table  class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <td><?php echo $user_info['first_name']?></td>
                                    </tr>
                                    <tr>
                                        <th>Middle Name</th>
                                        <td><?php echo $user_info['middle_name']?></td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td><?php echo $user_info['last_name']?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $user_info['email']?></td>
                                    </tr>
                                    <tr>
                                        <th>Date Of Birth</th>
                                        <td><?php echo $user_info['dob']?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <td><?php echo $user_info['phone_number']?></td>
                                    </tr>
                                    <tr>
                                        <th>phone Number 2</th>
                                        <td><?php echo $user_info['phone_number_2']?></td>
                                    </tr>
                                    <tr>
                                        <th>Pan Number</th>
                                        <td><?php echo $user_info['pan_number']?></td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td><?php echo $user_info['gender']?></td>
                                    </tr>
                                    <tr>
                                        <th>income</th>
                                        <td><?php echo $user_info['income']?></td>
                                    </tr>
                                    <tr>
                                        <th>Wife Income</th>
                                        <td><?php echo $user_info['wife_income']?></td>
                                    </tr>
                                    <tr>
                                        <th>Childeren Income Total(Less Than 18)</th>
                                        <td><?php echo $user_info['sib_income']?></td>
                                    </tr>
                                    <tr>
                                        <th>Organisation</th>
                                        <td><?php echo $user_info['org']?></td>
                                    </tr>
                                    <tr>
                                        <th>PSU</th>
                                        <td><?php echo $user_info['psu']?></td>
                                    </tr>
                                    <tr>
                                        <th>User Type</th>
                                        <td><?php echo $user_info['user_type']?></td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td><?php echo $user_info['date_modified']?></td>
                                    </tr>

                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
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