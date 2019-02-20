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
                    <h1 class="page-header">Top Town</h1>
                    <?php echo $this->session->flashdata('org_insert');?>
                    <?php echo $this->session->flashdata('org_delete');?>
                    <?php echo $this->session->flashdata('org_edited');?>

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
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                             <table  class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Location Name</th>
                                    </tr>
                                    
                                        <?php 
                                        if(!empty($locations))
                                        {
                                            $count=1;
                                            foreach ($locations as $key => $value)
                                            {
                                                echo"<tr>";
                                                echo"<td>".$count."</td>";
                                                echo"<td>";
                                                    echo $value['name'];
                                                echo"</td>";
                                                echo"</tr>";
                                                $count++;
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





<!-- Modal content -->

    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div>
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Organisation</h4>
                </div>
              <div class="modal-body">
                <form method="post" action="<?php echo base_url('org/add_org')?>">
               <input required type="text" name="org_name" class="form-control" placeholder="Enter  Name">

              </div>
              <div class="modal-footer">
                 <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
              </div>
            </div>
        </div>
    </div>
</div>

<!-- /Modal content -->


<!-- Model to edit organisation -->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div>
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Organisation</h4>
                </div>
              <div class="modal-body">
                <form method="post" action="<?php echo base_url('org/edit_org')?>">
                    <input type="hidden" value="" name="org_id" id="hidden_id">

               <input required type="text" id="tab_data" name="org_name" value="" class="form-control" placeholder="Enter Name">

              </div>
              <div class="modal-footer">
                 <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
              </div>
            </div>
        </div>
    </div>
</div>

<!-- /Modal to edit organisation -->

    <script>

        $('.tab_btn_classs').on('click',function(){
            var tab_name = $(this).attr('value');
            var id = $(this).attr('data');
            $('#hidden_id').val(id);
            $('#tab_data').val(tab_name);

             // console.log(tab_name);
        })

    $('#back').on('click', function(e){
    e.preventDefault();
    window.history.back();
    });
    </script>
    <!-- /#wrapper -->
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