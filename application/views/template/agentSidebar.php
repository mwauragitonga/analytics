<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle"
					 alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $this->session->userdata('fname').' '. $this->session->userdata('lname') ;?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li >
				<a href="<?php echo base_url().'referrals/'.$this->session->userdata('agentCode') ?>">
					<i class="fa fa-home"></i> <span>Agent Dashboard</span>
				<?php // var_dump($this->session->userdata('agentCode'))?>
				</a>

			</li>
			<li >
				<a href="<?php echo base_url(); ?>general">
					<i class="fa fa-dashboard"></i> <span>General Dawati Analytics</span>

				</a>

			</li>

			<li>
				<a href="<?php echo base_url(); ?>web">
					<i class="fa fa-th"></i> <span>Dawati Web  Analysis</span>

				</a>
			</li>

			<li>
				<a href="<?php echo base_url(); ?>app">
					<i class="fa fa-pie-chart"></i>
					<span>Android App Analysis</span>
				</a>

			</li>
<!--			<li>-->
<!--				<a href="--><?php //echo base_url(); ?><!--payments">-->
<!--					<i class="fa fa-laptop"></i>-->
<!--					<span>Payments</span>-->
<!--				</a>-->
<!---->
<!--			</li>-->
<!--			<li>-->
<!--				<a href="--><?php //echo base_url(); ?><!--accounts">-->
<!--					<i class="fa fa-user"></i>-->
<!--					<span>Accounts</span>-->
<!--				</a>-->
<!---->
<!--			</li>-->
<!--			<li>-->
<!--				<a href="--><?php //echo base_url(); ?><!--evaluations">-->
<!--					<i class="fa fa-tasks"></i>-->
<!--					<span>Evaluations</span>-->
<!--				</a>-->
<!---->
<!--			</li>-->
			<li>
				<a href="<?php echo base_url(); ?>schools">
					<i class="fa fa-graduation-cap"></i>
					<span>Schools</span>
				</a>
			</li>


		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
