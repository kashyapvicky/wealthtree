

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Query</h1>
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
                                    <div>Total Query</div>
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
                                    <div>Solved</div>
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
                                    <div>Unsolved</div>
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
                    <font color="green">
                    <?php echo $this->session->flashdata('insert_succ');?>
                    <?php echo $this->session->flashdata('delete_succ');?>
                    <?php echo $this->session->flashdata('solution_updated');?>
                    </font>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                           <!--  <a href="<?php echo base_url('subadmin/add_subadmin')?>" class="btn btn-primary">ADD MORE</a> -->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile No</th>
                                        <th>Query</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($queries))
                                    {
                                        // print_r($queries); die;
                                        $session_data = $this->session->userdata('session_data');
                                        if($session_data['level']==1)
                                        {
                                            $path = 'query/assigned_view';
                                        }
                                        else
                                        {
                                            $path = 'query/query_solution';
                                        }
                                        foreach ($queries as $key => $value)
                                        {

                                            if($value['assiagn_to']==0)  //not assigned yet
                                            {
                                                $assign_class = '';
                                                $view_class='disabled';
                                                $status = 'Not Assigned';
                                            }
                                            else
                                            {
                                                    //assigned job
                                                
                                                $assign_class='disabled';
                                                $view_class='';
                                                $status='assigned';

                                            }
                                         $newDate = date("d-M-Y", strtotime($value['timestamp']));
                                            echo 
                                            "
                                                <tr>
                                                <td>".$value['name']."</td>  
                                                <td>".$value['email']."</td> 
                                                <td>".$value['phone_number']."</td> 
                                                <td>".$value['query']."</td>
                                                <td>".$status."</td>
                                                <td>".$newDate."</td>
                                                <td>
                                                ";if($assign_class!='disabled'){echo"
                                                <a ".$assign_class." href='".base_url('query/view_query')."?id=".$value['id']."' class='btn btn-info'>Assign</a> 
                                                ";}if($view_class!='disabled'){echo"
                                                <a ".$view_class." href='".base_url($path)."?id=".$value['id']."' class='btn btn-success'>View</a>
                                                ";}"
                                                </td> 
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
    <!-- /#wrapper -->