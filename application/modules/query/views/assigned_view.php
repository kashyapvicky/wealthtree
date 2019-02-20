

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Query</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" style="background-color: #f8f8f8; height:100px">
                <br>
                <div class="col-lg-3"><?=$query_data['name']?></div>
                <div class="col-lg-3"><?=$query_data['email']?></div>
                <div class="col-lg-3"><?=$query_data['phone_number']?></div>
                <div class="col-lg-3"><?=$query_data['timestamp']?></div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="">User Query</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row" style="background-color: #f8f8f8; height:100px">

                <br>
                <div class="col-lg-12"><?=$query_data['query']?></div>
                <!-- <div class="col-lg-6"><?=$query_data['query']?></div> -->
               
            </div>
            <br>
            <div class="row">                   
                    <!-- /.col-lg-6 -->
                   <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b> Assigned Admin Detail</b>
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
                                        <?php //echo"<pre>"; print_r($query_data); die;?>
                                        <th>Admin Name</th>
                                        <td><?php echo ucfirst($query_data['admin'])?></td>
                                    </tr>
                                     <tr>
                                        <th>Level</th>
                                        <td><?php if($query_data['level']==2){echo "Level 1";}else{echo"Level 2";}?></td>
                                    </tr>
                                     <tr>
                                        <th>Status</th>
                                        <td><?php if($query_data['status']==2){echo "Completed";}else{echo"Pending";}?></td>
                                    </tr>
                                     <tr>
                                        <th>Assiagned On</th>

                                        <td><?php
                                        echo date('Y-m-d', strtotime($query_data['assigned_on']));


                                         ?></td>
                                    </tr>
                                     <tr>
                                        <th>Generated On</th>

                                        <td><?php
                                         echo date('Y-m-d', strtotime($query_data['generated_on']));?></td>
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
                <!-- /.col-lg-6 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="">Query Solution</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


            <div class="row" style="background-color: #f8f8f8; height:100px">

                <br>
                <div class="col-lg-12"><?=$query_data['solution']?></div>
                <!-- <div class="col-lg-6"><?=$query_data['query']?></div> -->
            </div>
            <br>

            

            <!-- /.row -->
            
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
    // $('#query_btn').on('click',function(e)
    // {


    //     alert('helo');

    //     e.preventDefault();


    // });
</script>
    <!-- /#wrapper -->