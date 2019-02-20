   <?php// print_r($sib_income); die;?>

    <style>
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
                    <button style="border: none; background: none; padding: 0;" id="back" class="glyphicon glyphicon-circle-arrow-left">
                       
                    </button>
                    <h1 class="page-header"><?php echo ucfirst($user_info['first_name'])?></h1>
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
                                        <td><?php echo ucfirst($user_info['first_name'])?></td>
                                    </tr>
                                    <tr>
                                        <th>Middle Name</th>
                                        <td><?php echo ucfirst($user_info['middle_name'])?></td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td><?php echo ucfirst($user_info['last_name'])?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $user_info['email']?></td>
                                    </tr>
                                    <tr>
                                        <th>Date Of Birth</th>
                                        <td><?php echo  $newDate = date("d-M-Y", strtotime($user_info['dob']));?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <td><?php echo $user_info['phone_number']?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number 2</th>
                                        <td><?php echo $user_info['phone_number_2']?></td>
                                    </tr>
                                    <tr>
                                        <th>Pan Number</th>
                                        <td><?php echo $user_info['pan_number']?></td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td><?php echo ucfirst($user_info['gender'])?></td>
                                    </tr>
                                    <tr>
                                        <th>Income</th>
                                        <td><?php echo $user_info['income']?></td>
                                    </tr>
                                    <tr>
                                        <th>Wife Income</th>
                                        <td><?php echo $user_info['wife_income']?></td>
                                    </tr>
                                    <tr>
                                        <th>Children Total Income(Less Than 18)</th>
                                        <td><?php if(!empty($sib_income['sib_income'])){echo $sib_income['sib_income'];}?></td>
                                    </tr>
                                     <tr>
                                        <th>Family Income</th>
                                        <td><?php echo $family =$user_info['income']+$user_info['wife_income'] +$sib_income['sib_income']  ?></td>
                                    </tr>
                                    <tr>
                                        <th>Organization</th>
                                        <td><?php echo $user_info['org']?></td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td><?php echo $user_info['state']?></td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td><?php echo $user_info['district']?></td>
                                    </tr>
                                    <tr>
                                        <th>Town</th>
                                        <td><?php echo $user_info['town']?></td>
                                    </tr>
                                    <tr>
                                        <th>Moza</th>
                                        <td><?php echo $user_info['moza']?></td>
                                    </tr>
                                    <tr>
                                        <th>PSU</th>
                                        <td><?php echo $user_info['psu']?></td>
                                    </tr>
                                    <tr>
                                        <th>User Type</th>
                                        <td><?php echo ucfirst($user_info['user_type'])?></td>
                                    </tr>
                                    <tr>
                                        <th> Registration Date</th>
                                        <td><?php echo  $nDate = date("d-M-Y", strtotime($user_info['date_modified']));?></td>
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



            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b>Childeren Details</b>
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
                                        <th>
                                            Name
                                        </th>
                                        <th>Age</th><th>Salary</th>
                                    </tr>
                                   <?php
                                    if(!empty($childeren_details))
                                    {
                                        foreach ($childeren_details as $key => $value)
                                        {
                                            echo"
                                                <tr>
                                                <td>".$value['name']."</td>
                                                <td>".$value['age']."</td>
                                                <td>".$value['salary']."</td>
                                                </tr>


                                            ";
                                            # code...
                                        }
                                    }





                                   ?>
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
    <script>
    $('#back').on('click', function(e){
    e.preventDefault();
    window.history.back();
    });
    </script>