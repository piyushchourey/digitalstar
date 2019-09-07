<!DOCTYPE html>
<!-- header starts here -->
  <?php 
	if($this->session->userdata('type')=='admin')
		$this->load->view('header_admin');
	else
		$this->load->view('header');
	?>
<!-- header ends here --> 
  
<!--content-->
  <?php
	$this->load->view($body);?>
<!--content end-->
  
<!--footer-->
<?php 
	if($this->session->userdata('type')=='admin')
		$this->load->view('footer_admin');
	else
		$this->load->view('footer');?>
<!-- footer ends here -->

 