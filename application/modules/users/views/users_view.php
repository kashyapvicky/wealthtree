        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $counts['total_user']?></div>
                                    <div>Total User</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <!-- <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div> -->
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $counts['eligible']?></div>
                                    <div>Eligible User</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <!-- <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div> -->
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $counts['not_eligible']?></div>
                                    <div>Not Eligible User</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <!-- <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div> -->
                        </a>
                    </div>
                </div>
            </div><!--/row-->
            <div class="row">
                <form method="post" action="<?php echo base_url('users/index')?>">
                <div class="col-md-2">
                    <select name="survey" class="form-control">
                        <option value="" disabled selected>Survey</option>

                        <!-- <option value="1">Basic Details Complete</option> -->
                        <option value="1">Survey 1 Complete</option>
                        <option value="2">Both Complete</option>

                    </select>
                </div>
                <div class="col-md-2">
                    <select name="org" class="form-control">
                         <option value="" disabled selected>Organisation</option>
                         <?php
                            if(!empty($org))
                            {
                                foreach ($org as $key => $value)
                                {
                                   echo"<option value='".$value['id']."'>".$value['name']."</option>";
                                }
                            }

                         ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="case" class="form-control">
                        <option value="" disabled selected>Cases</option>
                        <option value="1">Case 1 </option>
                        <option value="2" >Case 2</option>
                        <option value="3" >Case 3</option>
                        <option value="4" >Case 4</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="place" class="form-control">
                         <option value="" disabled selected>Places</option>
                         <option value="1" >Exist In Database</option>
                         <option value="2" >Does Not Exist</option>

                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" style="">Submit</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    
                            <?php
                            echo $this->session->flashdata('user_deleted');
                            echo $this->session->flashdata('survey_deleted');
                            ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            </b>Users Detail</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                       <!--  <th>ID</th> -->
                                        <th>User Name</th>
                                        <th>Email ID</th>
                                        <th>Survey 1</th>
                                        <th>Survey 2</th>
                                        <th>Organisation</th>
                                        <th>Eligible</th>
                                        <th>Cases</th>
                                        <th>Created Date</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     // echo"<pre>";print_r($users);die;
                                    foreach ($users as $key => $value)
                                    {

                                        if($value['survey_status']==5)
                                        {
                                            $second_survey = 'Completed';
                                            $first_survey = 'Completed';
                                        }
                                        else
                                        {
                                            $second_survey = 'Not Completed';
                                            if($value['is_completed']==2)
                                            {
                                                $first_survey = 'Completed';
                                            }
                                            else
                                            {
                                                $first_survey='Not Completed';
                                            }
                                        }
                                        if($value['case_number']==1 || $value['case_number']==3)
                                        {
                                            $eligible='Yes';
                                        }
                                        else
                                        {
                                            $eligible='No';
                                        }
                                        //print_r($users); die;
                                    ?>
                                    <tr class="odd gradeX">

                                        <!-- <td><?php echo  $value['id']?></td> -->
                                        <td><?php echo  ucfirst($value['first_name'])?></td>
                                        <td><?php echo  ucfirst($value['email'])?></td>
                                        <td><?php echo $first_survey?></td>
                                        <td><?php echo $second_survey?></td>
                                        <td><?php echo $value['org']?></td>
                                        <td class="center"><?php echo $eligible;?></td>
                                        <td class="center"><?php echo $value['case_number']?></td>
                                        <td><?php echo $newDate = date("d-M-Y", strtotime($value['date_modified']));?></td>
                                        <td> <a href="<?php echo base_url()?>users/view_user_detail?id=<?php echo $value['id']?>" class="btn btn-primary">Details</a></td>
                                        <td> 
                                            <a href="<?php echo base_url()?>users/delete_user?id=<?php echo $value['id']?>" class="btn btn-danger" onClick='return doconfirm();'>Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }  
                                        ?>
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
       


        // $(document).ready(function() {
        // $('#dataTables-example').DataTable( {
        // //"scrollY": true,
        //     "scrollX": true
        // } );
        // } );
    </script>
<script>
    function doconfirm()
    {
        job=confirm("Are you sure to delete user permanently?");
        if(job!=true)
        {
            return false;
        }
    }
</script>