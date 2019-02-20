

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
            <br>
            <div class="row" style="background-color: #f8f8f8; height:100px">
                <br>
                <div class="col-lg-6"><?=$query_data['query']?></div>
                <!-- <div class="col-lg-6"><?=$query_data['query']?></div> -->
               
            </div>
            <br>
            <div class="row">
                <form method="post" action="<?php echo base_url('query/assign_query')?>">
                    <input type="hidden" name="query_id" value="<?php echo $query_data['id'] ?>">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               Level 1 Admin
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Assign</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $count=1;
                                                if(!empty($level_1))
                                                {
                                                    foreach ($level_1 as $key => $value)
                                                    {
                                                        # code...
                                                        echo"<tr>
                                                            <td>".$count++."</td>
                                                            <td>".$value['name']."</td>
                                                            <td><input required type='radio' name='admin_id' value='".$value['id']."'></td>
                                        
                                                        </tr>";
                                                        $count++;
                                                    }
                                                }
                                            ?>
                                           
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               Level 2 Admin
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Assign</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $count=1;
                                                if(!empty($level_2))
                                                {
                                                    foreach ($level_2 as $key => $value)
                                                    {
                                                        # code...
                                                        echo"<tr>
                                                            <td>".$count++."</td>
                                                            <td>".$value['name']."</td>
                                                            <td><input required type='radio' name='admin_id' value='".$value['id']."'></td>
                                        
                                                        </tr>";
                                                        $count++;
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <button class="btn btn-primary" id="query_btn">Assign</button>
                </form>
                <!-- /.col-lg-6 -->
            </div>

            

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