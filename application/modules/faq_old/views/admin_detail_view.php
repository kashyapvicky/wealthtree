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
                     <button style="border: none; background: none; padding: 0;" id="back" class="glyphicon glyphicon-circle-arrow-left"></button>
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
                             <table  class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Admin Name</th>
                                        <td><?php echo ucfirst($admin_data['name'])?></td>
                                    </tr>
                                    <tr>
                                       <th>Email ID</th>
                                        <td><?php echo $admin_data['email']?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No</th>
                                        <td><?php echo $admin_data['mobile_no']?></td>
                                    </tr>
                                    <tr>
                                       <th>Password</th>
                                        <td><?php echo $admin_data['password']?></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                       <th>Created Date</th>
                                        <td><?php echo  $newDate = date("d-M-Y", strtotime($admin_data['timestamp']));?></td>
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
    <script>
    $('#back').on('click', function(e){
    e.preventDefault();
    window.history.back();
    });
    </script>
    <!-- /#wrapper -->