

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
                <div class="col-lg-12">
                    <h1 class="">Query Solution</h1>
                    <font color="red">
                    <?php echo validation_errors();?>
                    </font>
                </div>
            <!-- /.col-lg-12 -->
            </div>
            <div class="row" >
                <form method="post" action="<?php echo base_url('query/query_solution')?>">

                    <input type="hidden" name="hidden_id" value="<?=$query_data['id']?>">
                <br>
                <div class="col-lg-12">
                    <textarea  required placeholder="Type Solution Here.." name="solution"  class="form-control" style="overflow:scroll; border:1px solid #ccc;padding:4px;"> </textarea>
                </div>
                <!-- <div class="col-lg-6"><?=$query_data['query']?></div> -->
            </div>
            <div class="row" >

                <br>
                <div class="col-lg-6"">
                   <select required name="status" class="form-control">
                    <option value="" disabled selected="">Select Status</option>
                    <option value="2">Completed</option>
                    <option value="3">Pending</option>
                   </select>
                </div>
                <div class="col-lg-6" style="">
                   <button class="btn btn-primary">Update</button>
                </div>
                <!-- <div class="col-lg-6"><?=$query_data['query']?></div> -->
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