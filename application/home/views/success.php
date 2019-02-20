


	<section class="successful-wraper text-center">
		<p><?php if(!empty($msg))
		{
			echo $msg;
		}
		else
		{
			echo"Message is not set";
		}
		?></p>
		<a href="<?php echo base_url_custom;?>"><button class="logout-btn" name="logout">Logout</button></a>
	</section>
	
