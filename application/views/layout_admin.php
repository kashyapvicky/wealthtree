    <!-- include your header view here -->
    <?php $this->load->view('admin_header'); ?>
    <?php $this->load->view('admin_sidebar'); ?>
    

    


	<?php   echo $this->load->view($page); ?>



    <!-- include your footer view here -->
    <?php $this->load->view('admin_footer'); ?>