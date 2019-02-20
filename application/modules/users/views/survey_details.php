       
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
                    <h1 class="page-header"><?php echo ucfirst($answers['first_name'])?> - Survey Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div>
                    <a onclick="return do_confirm();" href="<?php echo base_url('users/delete_survey?id='.$answers['user_id'].'')?>" class="btn btn-danger">Delete Survey</a>
                    <div>
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b> First Survey Details</b>
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
                                        <th><strong>Question</strong></th>
                                        <td><strong>Answer</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Do you own a pakka house?</th>
                                        <td><?php echo $answers['pakka_house']?></td>
                                    </tr>
                                    <tr>
                                        <th>What do you want?</th>
                                        <td><?php if($answers['what_you_want']==1){echo"Construct";}elseif($answers['what_you_want']==2){echo"Purchase";}elseif($answers['what_you_want']==3){echo"Add Rooms In Existing House";} ?></td>
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
                                <thead>
                                    <tr>
                                        <th><strong>Question</strong></th>
                                        <td><strong>Answer</strong></td>
                                    </tr>

                                    <?php 

                                    if(!empty($second_survey_answers))
                                    {



                                        foreach ($second_survey_answers as $key => $value)
                                        {

                                            foreach ($second_survey_answers[$key] as $keys => $values)
                                            {
                                            // print_r($values); die;
                                                echo"</tr>";
                                                echo"<th>".$values['name']."</th>";
                                                echo"<td>".$values[$key]."</td>";
                                                echo"</tr>";
                                            }
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
    <!-- /#wrapper -->
    <script>
    $('#back').on('click', function(e){
    e.preventDefault();
    window.history.back();
    });
    </script>
    <script>
        function do_confirm()
        {
            $job = confirm('Are you sure to delete survey permanently?');
            if(!$job)
            {
                return false;
            }
        }

    </script>