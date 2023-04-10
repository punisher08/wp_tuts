<?php
/** 
 * @package WP tutorials
 * Plugin Name:		    WP tutorials
 * Plugin URI:			https://jretech.com/
 * Description:			Basic WP tutorial
 * Version:				1.0.0
 * Requires at least: 	6.0
 * Requires PHP:        5.2
 * Tested up to:		6.1
 * Author:				jhomignacio08@gmail.com
 * Author URI:			https://jretech.com/
 * License:    			GPL2 or later
 * License URI:			https://www.gnu.org/licenses/gpl-2.0.html
 * 
 */


defined( 'ABSPATH') or die( 'You are not allowed to enter!');

if ( file_exists( dirname(__FILE__).'/vendor/autoload.php')){

    require_once dirname(__FILE__).'/vendor/autoload.php';

}
use Inc\Activate;
use Inc\Deactivate;

function plugin_activate(){

    Activate::activate();

}
register_activation_hook(__FILE__,'plugin_activate');

function plugin_deactivate(){

    Deactivate::deactivate();

}
register_deactivation_hook(__FILE__,'plugin_deactivate');