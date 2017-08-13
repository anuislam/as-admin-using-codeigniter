<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'] = array(
        //'class'    => 'MyClass',
        'function' => 'call_custom_hooks_admin',
        'filename' => 'Functions.php',
        'filepath' => 'hooks',
        //'params'   => array('beer', 'wine', 'snacks')
);

