<?php// echo"<pre>";print_r($tabs); die;?>
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
                    <h1 class="page-header">Faq</h1>
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
                                    <div class="huge"><?php echo count($faqs);?></div>
                                    <div>Total</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <select onchange="get_tab_wise_question(this.value)" style="margin-top: 10%" class="form-control" name="faq_filter">
                        <option disabled selected>Select Cateogry</option>
                        <?php
                       
                            foreach ($tabs as $key => $value)
                            {
                                echo"
                                <option value=".$value['id'].">".$value['name']."</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
            </div><!--/row-->
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $this->session->flashdata('insert_succ');?>
                    <?php echo $this->session->flashdata('delete_succ');?>
                    <?php echo $this->session->flashdata('que_insert');?>
                    <?php echo $this->session->flashdata('tab_insert');?>
                    <?php echo $this->session->flashdata('que_delete');?>
                    <?php echo $this->session->flashdata('edit_succ');?>
                    <?php echo $this->session->flashdata('tab_edited');?>
                    <?php echo $this->session->flashdata('tab_deleted');?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                
                            <a href="<?php echo base_url('faq/add_question')?>" class="btn btn-primary">Add Question</a>

                             <button data-toggle="modal" data-target="#myModal" class="btn btn-primary">Add Tab</button>

                             <a href="<?php echo base_url('faq/view_tab')?>" class="btn btn-primary">View Cateogry</a>

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
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
                           <b> Second Survey Details</b>
                        </div>
                        <!-- /.panel-heading -->
                        <?php
                            // echo"<pre>";
                            // print_r($user_info);die;
                         ?>
                        <div class="panel-body">
                            <table  class="table table-striped table-bordered table-hover" id="">
                                <thead id=faq_tbl_id>
                                    <tr>
                                        <th><strong>Question In English</strong></th>
                                        <th><strong>Question In Hindi</strong></th>
                                        <td><strong>Answer IN English</strong></td>
                                        <td><strong>Answer In Hindi</strong></td>
                                        <td><strong>Action</strong></td>
                                        <!-- <td><strong>Delete</strong></td> -->
                                    </tr>
                                   

                                    <?php 

                                    if(!empty($faqs))
                                    {



                                        foreach ($faqs as $key => $value)
                                        {

                                           
                                            // print_r($values); die;
                                                echo"</tr>";
                                                echo"<th>".$value['question']."</th>";
                                                echo"<th>".$value['question_hin']."</th>";
                                                echo"<td>".$value['answer']."</td>";
                                                echo"<td>".$value['answer_hin']."</td>";
                                                if($value['qs_id'])
                                                {
                                                    
                                                echo"<td>
                                                <a href='".base_url('faq/edit_faq?id='.$value['qs_id'].'')."' class='btn btn-info'>Edit</a>
                                                <a href='".base_url('faq/delete_faq?id='.$value['qs_id'].'')."' class='btn btn-danger' onClick='return doconfirm();'>Delete</a>
                                                </td>";
                                                
                                                }

                                                echo"</tr>";
                                            
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

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div>
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tab</h4>
                </div>
              <div class="modal-body">
                <form method="post" action="<?php echo base_url('faq/add_tab')?>">
              
               <label> Enter Tab Name In English</label>
               <input required type="text" name="tab_name" class="form-control" placeholder="Enter Tab Name IN English">
               <br>
               <label> Enter Tab Name In Hindi</label>
               <input required type="text" name="name_hin" class="form-control" placeholder="Enter Tab Name In Hindi">

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

<script>

function get_tab_wise_question(id)
{
    
    var tab_id = id;
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>" + "faq/get_tab_data",
    dataType: "json",
    data: {tab_id:tab_id},
    success: function(data)
    {
        $('#faq_tbl_id').html(data);
        console.log(data);
    },
    error : function(data)
    {
        alert('Something went wrong');
    }
    });
}

</script>
    <!-- /#wrapper -->