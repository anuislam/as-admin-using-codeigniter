<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_table {

	public $obj;


	public function __construct()
	{
		$this->obj =& get_instance();
		$this->obj->load->model('user');
		$this->obj->load->model('custom_db');
		$this->obj->load->helper('form');
		$this->obj->load->helper('url');
		$this->obj->load->helper('html');
		$this->obj->load->library('pagination');
		$this->obj->load->library('form_validation');
	}

	public function page_title(){
		return 'Posts';
	}

	public function button_text(){
		return 'Add new';
	}

	public function item_action(){
		return array(
				'button_title' => 'apply',
				'options' 		=> array(
						'default'		=> 'bulk action',
						'delete'		=> 'Delete',
						'send_spam'		=> 'Send Spam',
						'send_trush'	=> 'Send Trush',
						'benned'		=> 'Benned User'
					)
			);
	}


	public function form_action_controller(){
		return current_url();
	}

	public function get_current_url(){
		
		$get_data = (empty($_GET) === false) ? $_GET : '' ;
		if (isset($get_data)) {
			$data = false;
			if (is_array($get_data)) {
				$data = '?';
				$a1 = 1;
				$get_data_count = count($get_data); 
				foreach ($get_data as $key => $value) {
					if ($key != 'page') {
						$data .= $key.'='.$value;
						if ($get_data_count != $a1) {
							if ($a1 < $get_data_count) {
								$data .= '&';
							}
						}
						$a1++;
					}
				}
				return $data;
			}
		}else{
			return false;
		}
	}

	public function pagination()
	{

$config['base_url'] = base_url('dashboard/all-user');

$search_data = $this->obj->input->get('search');
if (isset($search_data)) {
	$config['total_rows'] = count($this->items_loop());
}else{
	$config['total_rows'] = $this->obj->user->total_uset_count();
}

$config['per_page'] = 20;
$config['full_tag_open'] = '<div class="center" style="text-align: right;"><div class="pagination" style="margin: 0;"><ul>';
$config['full_tag_close'] = '</ul></div></div>';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '</a></li>';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
$config['first_link'] = 'First';
$config['last_link'] = 'Last';
$config['next_link'] = 'Next &rarr;';
$config['prev_link'] = '&larr; Previous';
$config['suffix'] = $this->get_current_url();
$config['first_url'] = base_url('dashboard/all-user').$this->get_current_url();

$this->obj->pagination->initialize($config);
		ob_start();

echo $this->obj->pagination->create_links();

		return ob_get_clean();
	}

/*						<li class="prev disabled"><a href="#">← Previous</a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li class="next"><a href="#">Next → </a></li>*/
	public function box_title_and_icon()
	{
		return array(
				'icon' 	=> 'icon-pushpin',
				'title' => 'All posts'
			);
	}

	public function sub_item_menu()
	{
		$data[] = array(
				'title' => 'title',
				'count' => '12',
				'url' 	=> '12',
			);
		$data[] = array(
				'title' => 'title',
				'count' => '12',
				'url' 	=> '12',
			);
		$data[] = array(
				'title' => 'title',
				'count' => '12',
				'url' 	=> '12',
			);
		$data[] = array(
				'title' => 'title',
				'count' => '12',
				'url' 	=> '12',
			);
	}


	public function items_loop()
	{

		$config_form = array(
		        array(
		                'field' => 'orderby',
		                'label' => 'orderby',
		                'rules' => 'trim|alpha_dash'
		        ),
		        array(
		                'field' => 'order',
		                'label' => 'order',
		                'rules' => 'trim|alpha_dash'
		        ),
		        array(
		                'field' => 'search',
		                'label' => 'Search',
		                'rules' => 'trim|alpha_numeric_spaces',
		                'errors' => 'The %s field may only contain alpha-numeric characters and spaces.',
		        ),
		);

		$this->obj->form_validation->set_data($this->obj->input->get());
		$this->obj->form_validation->set_rules($config_form);
		if ($this->obj->form_validation->run() !== FALSE)
		{
			if (chack_database_table_row('cod_user', $this->obj->input->get('orderby')) === true) {
				$config['orderby'] 	= $this->obj->input->get('orderby');
				$config['order']	= $this->obj->input->get('order');
			}	
			$config['search']		= $this->obj->input->get('search');
		}

		$config['user_per_page'] = 20;
		$config['user_paged'] = $this->obj->uri->segment(3, 0);
		return $this->obj->user->get_users($config);
	}


	public function item_cols_format($key, $value)
	{
		?>

				<tr>
					<td width="20"><input type="checkbox" id="inlineCheckbox1" value=""></td>
					<td><?php echo $value->username; ?></td>
					<td class="center"><?php echo date("Y/d/m"); ?></td>
					<td class="center"><?php echo $this->obj->user->get_the_user_meta($value->ID, 'capabilities', true); ?></td>
					<td class="center">

					<?php $user_status = $value->user_status;
						if ($user_status == 0) {
							echo '<span class="label label-warning">Pending</span>';
						}else if ($user_status == 1) {
							echo '<span class="label label-success">Verified</span>';
						}else if ($user_status == 2) {
							echo '<span class="label label-important">Banned</span>';
						}else if ($user_status == 3){			
							echo '<span class="label">Awaiting</span>';
						}
					 ?>


						
					</td>
					<td class="center">
						<a class="btn btn-success" href="#">
							<i class="halflings-icon white zoom-in"></i>                                            
						</a>
						<a class="btn btn-info" href="#">
							<i class="halflings-icon white edit"></i>                                            
						</a>
						<a class="btn btn-danger" href="#">
							<i class="halflings-icon white trash"></i> 
							
						</a>
					</td>
				</tr>

		<?php
	}


	public function table_header_items()
	{
		$conf   = array();
		$conf[] = array(
			'title'	=> 'Username',
			'slug'	=> 'username'
			);
		$conf[] = array(
			'title'	=> 'Registered',
			'slug'	=> 'registered'
			);
		$conf[] = array(
			'title'	=> 'Role',
			'slug'	=> 'role'
			);
		$conf[] = array(
			'title'	=> 'Status',
			'slug'	=> 'user_status'
			);
		$conf[] = array(
			'title'	=> 'Actions',
			'slug'	=> 'actions'
			);
		return $conf;
	}

	public function sort_items($title, $slug)
	{
		switch ($slug) {
			case 'username':
				return $this->default_sort_func(
					'username', // for url value
						$title, // for main title in menu
						'search' // for seach if have
					);
				break;
			case 'registered':
				return $this->default_sort_func(
					'user_registered', // for url value
						$title, // for main title in menu
						'search' // for seach if have
					);
				break;
			case 'user_status':
				return $this->default_sort_func(
					'user_status', // for url value
						$title, // for main title in menu
						'search' // for seach if have
					);
				break;
			
			default:
				return false;
				break;
		}
	}

	public function default_sort_func($ouderbyarg, $title, $search = '')
	{
		$order = $this->obj->input->get('order');
		$orderby = $this->obj->input->get('orderby');
		$search_tag = $this->obj->input->get($search);
		$icon_data = '<i class="icon-sort-down hovernone"></i><i class="icon-sort-up none hovershow"></i>';
		$acor_icon = '?orderby='.$ouderbyarg.'&order=asc';
		$acor_icon .= (isset($search_tag) === true) ? '&'.$search.'='.$search_tag : '' ;
			if ($orderby == $ouderbyarg) {
				if ($order == 'asc') {
					$icon_data = '<i class="icon-sort-down none hovershow"></i><i class="icon-sort-up  hovernone"></i>';
					$acor_icon = '?orderby='.$ouderbyarg.'&order=desc';
					$acor_icon .= (isset($search_tag) === true) ? '&'.$search.'='.$search_tag : '' ;
				}else{
					$icon_data = '<i class="icon-sort-down hovernone"></i><i class="icon-sort-up none hovershow"></i>';
					$acor_icon = '?orderby='.$ouderbyarg.'&order=asc';
					$acor_icon .= (isset($search_tag) === true) ? '&'.$search.'='.$search_tag : '' ;
				}
			}
		return '<a href="'.$acor_icon.'" class="admin_menu_sort_item">'.$title. $icon_data .'</a>';
	}


	public function get_search_box()
	{
		ob_start();
		?>


        <label style="text-align: right;">Search By Username:
			<?php
				echo form_input(array(
					'name' 			=> 'search',
					'type' 			=> 'text',
					'placeholder' 	=> 'Search',
					'style' 		=> 'margin:-2px 0 0 0;',
					'value' 		=> (isset($_GET['search'])) ? $_GET['search'] : null 
			));
			?>
        </label>
        <?php echo form_error('search', '<div class="input-large span10 as_error" style="margin:0;">', '</div>'); ?>

		<?php
		return ob_get_clean();
	}

	public function bulk_action_setup($value='')
	{
		echo $this->obj->input->get('bulk_action');
	}

	public function get_main_table(){
		$item_loop = $this->items_loop();

$this->bulk_action_setup();

		?>
<?php echo form_open($this->form_action_controller(), array(
	'method' => 'get'
));
if (isset($_GET['orderby'])) {
	echo form_input(array(
		'name' 			=> 'orderby',
		'type' 			=> 'hidden',
		'value' 		=> (isset($_GET['orderby'])) ? $_GET['orderby'] : null ,
	));
}
if (isset($_GET['order'])) {
	echo form_input(array(
		'name' 			=> 'order',
		'type' 			=> 'hidden',
		'value' 		=> (isset($_GET['order'])) ? $_GET['order'] : null ,
	));
}



?>
<!--table start-->
<div class="row-fluid">		
	<div class="box span12">
		<div class="box-header" >
		<!-- nothing -->
		</div>
		<div class="box-content">
			<div class="row-fluid">
			    <div class="span12">
			    	<ul class="admin_dashboard_add_new_button">
			    		<li><h2><?php echo $this->page_title(); ?></h2></li>
			    		<li><a href="#" class="btn btn-primary"><?php echo $this->button_text(); ?></a></li>
			    	</ul>
			    </div>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid">
    <div class="span7">
		<div class="center" >
		<?php $item_actions = $this->item_action(); ?>
			<ul class="admin_bulk_action">
				<li>
				<div class="control-group">
					<div class="controls">
					  <select id="selectError3" name="bulk_action">
					  <?php

					  if (is_array($item_actions)) {
					  	$bulk_action_data = $this->obj->input->get('bulk_action');
					  	foreach ($item_actions['options'] as $key => $value) {
					  		if ($key == 'default') {
					  			echo '<option value="" >'.$value.'</option>';
					  		}else{
					  			$selected = ($bulk_action_data == $key) ? 'selected' : '' ;
					  			echo '<option value="'.$key.'" '.$selected.' >'.$value.'</option>';
					  		}					  		
					  	}
					  }

					  ?>						
					  </select>
					</div>
					</div>
				</li>
				<li>	
					<label class="control-label" for="selectError3"><button class="btn"><?php echo $item_actions['button_title']; ?></button></label>
				</li>
			</ul>
		</div>
    </div>
	<div class="span5">
	    <?php echo $this->pagination(); ?>
	</div>
</div>


<div class="row-fluid">		
	<div class="box span12">
		<div class="box-header" data-original-title>

			<?php $box_icon = $this->box_title_and_icon(); ?>
			<h2><i class="<?php echo $box_icon['icon']; ?>"></i><span class="break"></span><?php echo $box_icon['title']; ?></h2>

			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
			</div>
		</div>
		<div class="box-content">

			<div class="row-fluid">
			    <div class="span8">
					<div class="center">
						<a href="#" class="label" style="color: #3e85c0;background-color: #fff;">Active (12)</a>
						<a href="#" class="label" style="color: #3e85c0;background-color: #fff;">Active (12)</a>
						<a href="#" class="label" style="color: #3e85c0;background-color: #fff;">Active (12)</a>
						<a href="#" class="label" style="color: #3e85c0;background-color: #fff;">Active (12)</a>
						<a href="#" class="label" style="color: #3e85c0;background-color: #fff;">Active (12)</a>
						<a href="#" class="label" style="color: #3e85c0;background-color: #fff;">Active (12)</a>
					</div>
			    </div>
			    <div class="span4">
			    	<?php echo $this->get_search_box(); ?>
			    </div>
			</div>


			<table class="table table-striped table-bordered">
			  <thead>
				  <tr>

					  <th><input type="checkbox" value=""></th>
				  <?php

				  $header_items = $this->table_header_items();
				  if (count($header_items) > 0) {
					  foreach ($header_items as $key => $value) {
					  	$sort_items = $this->sort_items($value['title'], $value['slug']);
					  	if ($sort_items) {					  		
					  		echo '<th>'.$sort_items.'</th>';
					  	}else{
					  		echo '<th>'.$value['title'].'</th>';
					  	}
					  }
				  }

				  ?>
					  
				  </tr>
			  </thead>   
			  <tbody>	


<?php
		if ($item_loop) {
			foreach ($item_loop as $key => $value) {
				$this->item_cols_format($key, $value); 
			}
		}

?>

			  </tbody>
		  </table>
		</div>
	</div><!--/span-->

</div><!--/row-->

<div class="row-fluid">
    <div class="span12">
		<?php echo $this->pagination(); ?>
    </div>
</div>
<!--table end-->
<?php echo form_close(); ?>
		<?php
	}

}
