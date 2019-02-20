
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
                    <!-- <button style="border: none; background: none; padding: 0;" id="back" class="glyphicon glyphicon-circle-arrow-left"></button> -->
                    <h1 class="page-header">Sub Admin</h1>
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
                                    <div class="huge">2</div>
                                    <div>Total</div>
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
                                    <div class="huge">1</div>
                                    <div>Level 1</div>
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
                                    <div class="huge">2</div>
                                    <div>Level </div>
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
                <div class="col-lg-12">
                    <?php echo $this->session->flashdata('insert_succ');?>
                    <?php echo $this->session->flashdata('delete_succ');?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                            <a href="<?php echo base_url('subadmin/add_subadmin')?>" class="btn btn-primary">ADD MORE</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Admin Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile No</th>
                                        <th>Password</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($subadmins))
                                    {
                                        foreach ($subadmins as $key => $value)
                                        {
                                         $newDate = date("d-M-Y", strtotime($value['timestamp']));
                                            echo 
                                            "
                                                <tr>
                                                <td>".$value['name']."</td>  
                                                <td>".$value['email']."</td> 
                                                <td>".$value['mobile_no']."</td> 
                                                <td>".$value['password']."</td> 
                                                <td>".$newDate."</td>
                                                <td><a href='".base_url('subadmin/view_subadmin')."?id=".$value['id']."' class='btn btn-info'>View</a> 
                                                <a href='".base_url('subadmin/add_subadmin')."?id=".$value['id']."' class='btn btn-info'>Edit</a>
                                                <a href='".base_url('subadmin/delete_admin')."?id=".$value['id']."' class='btn btn-danger' onClick='return doconfirm();'>Delete</a></td> 
                                                </tr>

                                            ";
                                        }

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
<script>
    function doconfirm()
    {
        job=confirm("Are you sure to delete permanently?");
        if(job!=true)
        {
            return false;
        }
    }
</script>
<script>
$('#back').on('click', function(e){
e.preventDefault();
window.history.back();
});
</script>
    <!-- /#wrapper -->