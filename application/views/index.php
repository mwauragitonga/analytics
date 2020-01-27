<?php $this->load->view('template/header'); ?>
<?php
		if($this->session->userdata('userType')=='admin'){
			$this->load->view('template/sidebar.php');
		}else{
			$this->load->view('template/agentSidebar.php');
		}
?>
<?php $this->load->view($view); ?>
<?php $this->load->view('template/footer'); ?>

