<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Login to your account</h2>
<?php echo form_open('login/index', array(
	'class' => 'form-horizontal',
	'method' => 'post'
)); ?>
	<fieldset>

		
			<?php echo validation_errors('<div class="input-large span10 as_error" style="margin:0;">', '</div>'); ?>
		

		<div class="input-prepend" title="Username">
			<span class="add-on"><i class="halflings-icon user"></i></span>
			<?php
				echo form_input(array(
						'name' 			=> 'username',
						'id' 			=> 'username',
						'type' 			=> 'text',
						'class' 		=> 'input-large span10 as_custom_focus',
						'placeholder' 	=> 'Type Username',
						'value' 		=> set_value('username')
						));
			?>
		</div>

		<div class="clearfix"></div>

		<div class="input-prepend" title="Password">
			<span class="add-on"><i class="halflings-icon lock"></i></span>
			<?php
				echo form_input(array(
						'name' 			=> 'password',
						'id' 			=> 'password',
						'type' 			=> 'password',
						'class' 		=> 'input-large span10 as_custom_focus',
						'placeholder' 	=> 'Type password',
						));
			?>			
		</div>
		<div class="clearfix"></div>
		
		<label class="remember" for="remember">
		<?php

		$data = array(
		    'name'        => 'remember',
		    'id'          => 'remember',
		    'checked'     => FALSE,
		    );

		echo form_checkbox($data);

		?> Remember me</label>

		<div class="button-login">

			<?php
				echo form_submit(array(
						'class' 		=> 'btn btn-primary',
						'value' 		=> 'Login',
						));
			?>	

		</div>
		<div class="clearfix"></div>
		</fieldset>
<?php echo form_close(); ?>