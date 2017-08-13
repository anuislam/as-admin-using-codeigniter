<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Register a account.</h2>
<?php echo form_open('login/registration', array(
	'class' => 'form-horizontal',
	'method' => 'post'
)); ?>
	<fieldset>
		

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
		<?php echo form_error('username', '<div class="input-large span10 as_error" style="margin:0;">', '</div>'); ?>



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
		<?php echo form_error('password', '<div class="input-large span10 as_error" style="margin:0;">', '</div>'); ?>


		<div class="input-prepend" title="Retype password">
			<span class="add-on"><i class="halflings-icon lock"></i></span>
			<?php
				echo form_input(array(
						'name' 			=> 'repeat_password',
						'id' 			=> 'repeat_password',
						'type' 			=> 'password',
						'class' 		=> 'input-large span10 as_custom_focus',
						'placeholder' 	=> 'Retype password',
						));
			?>			
		</div>
		<div class="clearfix"></div>
		<?php echo form_error('repeat_password', '<div class="input-large span10 as_error" style="margin:0;">', '</div>'); ?>


		<div class="input-prepend" title="Email">
			<span class="add-on"><i class="halflings-icon envelope"></i></span>
			<?php
				echo form_input(array(
						'name' 			=> 'email',
						'id' 			=> 'email',
						'type' 			=> 'text',
						'class' 		=> 'input-large span10 as_custom_focus',
						'placeholder' 	=> 'Type Email',
						));
			?>			
		</div>
		<div class="clearfix"></div>
		<?php echo form_error('email', '<div class="input-large span10 as_error" style="margin:0;">', '</div>'); ?>	
		
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