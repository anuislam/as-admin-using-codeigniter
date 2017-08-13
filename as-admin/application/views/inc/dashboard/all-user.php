<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid-full">
	<div class="row-fluid">
			
		<!-- start: Main Menu -->
		<?php $this->load->view('inc/dashboard/sidebar'); ?>
		<!-- end: Main Menu -->
		
		<noscript>
			<div class="alert alert-block span10">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
			</div>
		</noscript>
		
		<!-- start: Content -->
		<div id="content" class="span10">
		
		
		<!-- breadcrumb -->

		<?php custom_breadcrumb(); ?>
		
		<!-- main content -->


		<?php 

			get_admin_table('Admin_table');

		 ?>
   

		</div><!--/.fluid-container-->

		<!-- end: Content -->

	</div><!--/#content.span10-->
</div><!--/fluid-row-->
