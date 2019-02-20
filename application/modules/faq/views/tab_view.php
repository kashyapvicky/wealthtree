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
                    <h1 class="page-header">Tabs</h1>
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
                            View Tabs
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                             <table  class="table table-striped table-bordered table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Tab Name In English</th>
                                        <th>Tab Name In Hindi</th>
                                        <th>Actions</th>
                                    </tr>
                                        <?php

                                        foreach ($tabs as $key => $value)
                                        {

                                            echo"<tr>";
                                            echo"<td>".$value['name']."</td>";
                                            echo"<td>".$value['name_hin']."</td>";
                                            echo"<td>
                                            
                                            <button class='tab_btn_classs btn btn-info' data='".$value['id']."' name='".$value['name']."' name_hin='".$value['name_hin']."' data-toggle='modal' data-target='#myModal' class='btn btn-primary'>Edit</button>
                                            <a href='".base_url('faq/delete_tab?id='.$value['id'].'')."' class='btn btn-danger' onClick='return doconfirm();'>Delete</a>
                                            </td>";
                                       
                                        }


                                        ?>
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div>
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tab</h4>
                </div>
              <div class="modal-body">
                <form method="post" action="<?php echo base_url('faq/edit_tab')?>">
                    <input type="hidden" value="" name="tab_id" id="hidden_id">
              <label>Enter Tab In English</label>
               <input required type="text" id="tab_data_english" name="tab_name" value="" class="form-control" placeholder="Enter Tab Name In English"><br>
               <label>Enter Tab In Hindi</label>
               <input required type="text" id="tab_data_hin" name="name_hin" value="" class="form-control" placeholder="Enter Tab Name In Hindi">

              </div>
              <div class="modal-footer">
                 <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
    </div>
</div>
    <script>

        $('.tab_btn_classs').on('click',function(){
           
            var tab_data_english = $(this).attr('name');
           // alert( tab_data_english);
            var tab_data_hin = $(this).attr('name_hin');
            //alert(tab_data_hin);
            var id = $(this).attr('data');
            $('#hidden_id').val(id);
            $('#tab_data_english').val(tab_data_english);
            $('#tab_data_hin').val(tab_data_hin);
            

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