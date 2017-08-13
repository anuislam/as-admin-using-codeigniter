<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Bootstrap Metro Dashboard by Dennis Ji for ARM demo</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
<?php

$link = array(
          'href' => base_url('libs/css/bootstrap.min.css'),
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'id'	 => 'bootstrap-style'
);
echo link_tag($link);

$link = array(
          'href' => base_url('libs/css/bootstrap-responsive.min.css'),
          'rel' => 'stylesheet',
          'type' => 'text/css'
);
echo link_tag($link);

$link = array(
          'href' => base_url('libs/css/style.css'),
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'id'	=>	'base-style'
);
echo link_tag($link);

$link = array(
          'href' => base_url('libs/css/style-responsive.css'),
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'id'	=>	'base-style-responsive'
);
echo link_tag($link);

$link = array(
          'href' => '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext',
          'rel' => 'stylesheet',
          'type' => 'text/css'
);
echo link_tag($link);

?>


	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<?php
		$data = array();
		$data[] = array(
					'src' => '//html5shim.googlecode.com/svn/trunk/html5.js'
				);
		script_tag($data);
		
		$link = array(
		          'href' => base_url('libs/css/ie.css'),
		          'rel' => 'stylesheet',
		          'type' => 'text/css',
		          'id'	=>	'ie-style'
		);
		echo link_tag($link);
		?>

	<![endif]-->
	
	<!--[if IE 9]>

		<?php
		$link = array(
		          'href' => base_url('libs/css/ie9.css'),
		          'rel' => 'stylesheet',
		          'type' => 'text/css',
		          'id'	=>	'ie9style'
		);
		echo link_tag($link);
		?>

	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url('libs/img/avatar.jpg'); ?>">
	<!-- end: Favicon -->
	
			<style type="text/css">
			body { background: url(<?php echo base_url('libs/img/bg-login.jpg'); ?>) !important; }
		</style>
		
		
		
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>