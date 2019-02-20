


	<section class="successful-wraper text-center">
		<p><?php if(!empty($msg))
		{
			if($this->session->flashdata('eligible'))
			{
				echo $this->session->flashdata('eligible');
			}
			else
			{
			echo $msg;

			}
		}
		else
		{
			echo"Message is not set";
		}
		?></p>

		<!-- <a href="javascript:void(0)" id="next" class="next-btn">next</a> -->
	</section>
<?php
$this->session->sess_destroy()
?>
	
