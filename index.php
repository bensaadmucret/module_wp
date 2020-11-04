<?php
/*
Plugin Name: essential dashboard
Plugin URI:
Description:
Author: Theme
Author URI:
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: test
*/


defined('ABSPATH') || exit;

require_once(__DIR__. './vendor/autoload.php');
require_once(__DIR__. './vendor/cmb2/init.php');

use App\Register;
use App\Form_login;
use App\Options_page;
use App\Form_registration;

if (!function_exists('wp_get_current_user')) {
    require_once ABSPATH . WPINC . '/pluggable.php';
}

if (!function_exists('admin_created_user_email')) {
    require_once ABSPATH . '/wp-admin/includes/user.php';
}
 
if (!function_exists('wp_insert_user')) {
    require_once ABSPATH . WPINC . '/user.php';
}

new Options_page();
new  Form_login();


new Form_registration();
$register = new Register();
