        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Survey Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b> First Survey Detail</b>
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
                                        <th>Do You Own A Pakka House House?</th>
                                        <td><?php echo $answers['pakka_house']?></td>
                                    </tr>
                                    <tr>
                                        <th>What Do You want?</th>
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
                           <b> Second Survey Detail</b>
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
                                                echo"<th>".$values['name']."?</th>";
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