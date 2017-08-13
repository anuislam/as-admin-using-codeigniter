<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function add_admin_menu($data = array()){
	global $admin_menu;
	$admin_menu[] = $data;
	return $admin_menu;
}



function get_admin_menu(){
	global $admin_menu;
		$obj =& get_instance();
		$cur_controller = $obj->uri->segment(1);
		$cur_controller_two = $obj->uri->segment(2);
		if ($cur_controller_two === null) {			
			$cur_controller = $cur_controller;
		}else if ($cur_controller_two == 'index') {
			$cur_controller = $cur_controller;
		}else{
			$cur_controller = $cur_controller .'/'. $obj->uri->segment(2);
		}
		$cur_controller = base_url($cur_controller);
		
	if (is_array($admin_menu)) {
		if (count($admin_menu) > 0) {
			foreach ($admin_menu as $key => $value) {
				$capability = (isset($value['capability'])) ? $value['capability'] : false ;
				if ($capability) {
					if (user_can(get_current_user_id(), $capability) === true) {
						if (isset($value['parent']) === true) {
							if (is_array($value['parent'])) {
								?>
									<li <?php 
									if ($cur_controller == $value['url']) {									
										echo 'class=""active';
									} ?> >
										<a class="dropmenu" href="<?php echo @$value['url']; ?>"><i class="<?php echo @$value['icon']; ?>"></i><span class="hidden-tablet"> <?php echo @$value['title']; ?></span></a>
										<ul>
											<?php
											foreach ($value['parent']as $parent_key => $parent_value) {

												$capability = (isset($parent_value['capability'])) ? $parent_value['capability'] : false ;
												if ($capability) {
													if (user_can(get_current_user_id(), $capability) === true) {
														?>
														
															<li <?php echo ($cur_controller == $parent_value['url']) ? 'class="active"' : '' ; ?> ><a class="submenu" href="<?php echo @$parent_value['url']; ?>"><?php

																if (isset($parent_value['icon'])) {
																	?>

																	<i class="<?php echo $parent_value['icon']; ?>"></i>

																	<?php
																}

															?><span class="hidden-tablet"> <?php echo @$parent_value['title']; ?></span></a></li>

														<?php
													}
												}

											}
											?>
										</ul>
									</li>
								<?php
							}
						}else{
							?>

							<li <?php echo ($cur_controller == $value['url']) ? 'class="active"' : '' ; ?> ><a href="<?php echo @$value['url']; ?>"><i class="<?php echo @$value['icon']; ?>"></i><span class="hidden-tablet"> <?php echo @$value['title']; ?></span></a></li>

							<?php
						}
					}
				}
			}
		}
	}
	return true;
}

function page_title(){
	$admin_menu = apply_filters('admin_menu_filter', null);
	$obj =& get_instance();
	$cur_controller = $obj->uri->segment(1);
	$cur_controller_two = $obj->uri->segment(2);
	if ($cur_controller_two === null) {			
		$cur_controller = $cur_controller;
	}else if ($cur_controller_two == 'index') {
		$cur_controller = $cur_controller;
	}else{
		$cur_controller = $cur_controller .'/'. $obj->uri->segment(2);
	}
	$cur_controller = base_url($cur_controller);
	if (is_array($admin_menu)) {
		if (count($admin_menu) > 0) {
			foreach ($admin_menu as $key => $value) {
				if (isset($value['parent']) === true) {
					if (is_array($value['parent'])) {
						foreach ($value['parent']as $parent_key => $parent_value) {
							if (isset($parent_value['page_title']) === true) {
								if ($cur_controller == $parent_value['url']) {
									 $ret_data = $parent_value['page_title'];
									 break;
								}
							}	
						}
					}
				}else{
					if (isset($value['page_title']) === true) {
						if ($cur_controller == $value['url']) {
							 $ret_data = $value['page_title'];
							 break;
						}
					}
				}
			}
		}
	}
	return (isset($ret_data)) ? $ret_data : false;
}