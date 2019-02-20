     <?php   $session_data = $this->session->userdata('session_data');  ?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Wealth Tree</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('admin/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       <!--  <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            
                        </li> -->
                        <?php

                           if($session_data['level']==2)
                           {
                            ?>
                                <li>
                                <a href="<?php echo base_url('query')?>"><i class="fa fa-table fa-fw"></i>Query</a>
                                </li>

                            <?php

                           }
                           elseif ($session_data['level']==3)
                           {
                                ?>
                                <li>
                                <a href="<?php echo base_url()?>users"><i class="fa fa-users fa-fw"></i>Users</a>
                                </li>
                                <li>
                                <a href="<?php echo base_url('query')?>"><i class="fa fa-table fa-fw"></i>Query</a>
                                </li>
                                <?php   
                            }
                           else
                           {



                        ?>
                        <li>
                            <a href="<?php echo base_url()?>dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>users"><i class="fa fa-users fa-fw"></i>Users</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('subadmin')?>"><i class="fa fa-sitemap fa-fw"></i>Sub Admin</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('query')?>"><i class="fa fa-table fa-fw"></i>Query</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('faq');?>"><i class="fa fa-edit fa-fw"></i>Faq</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url('org');?>"><i class="fa fa-reorder fa-fw"></i>Organisation</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('org/top_towns');?>"><i class="fa  fa-star fa-fw"></i>Top Town</a>
                        </li>

                        <?php }?>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>