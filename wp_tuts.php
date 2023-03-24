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

if ( ! defined( 'WPINC' ) ) { die(); }

if (!defined('WP_TUTS_DIR')) {
    define('WP_TUTS_DIR', dirname(__FILE__));
}
if (!defined('WP_TUTS_URL')) {
    define('WP_TUTS_URL', plugins_url('', WP_TUTS_DIR . '/wp_tuts.php'));
}
if (!defined('WP_TUTS_BASENAME')) {
    define('WP_TUTS_BASENAME', plugin_basename(WP_TUTS_DIR . '/wp_tuts.php'));
}
if (!defined('WP_TUTS_PLUGIN_VERSION')) {
    define('WP_TUTS_PLUGIN_VERSION', '1.0.0');
}

add_action( 'add_meta_boxes', 'post_additional_fields' );
function post_additional_fields(){
    add_meta_box(
		'post_tag_field',
		'Post Tag Field',
		'post_tag_field_callback',
		'post',
		'advanced',
		'default'
	);
}
function post_tag_field_callback( $post ){
    $val = get_post_meta($post->ID,'post_tag_field',true);
    $output = '';
    $output .= '<input type="text" value="'.$val.'" placeholder="Custom Tag" name="post_tag_field" id="post_tag_field" />';
    echo $output;
}

add_action( 'save_post', 'catch_metafield' );
function catch_metafield( $post_id ){
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( isset( $_POST['post_tag_field'] ) ){
		update_post_meta( $post_id, 'post_tag_field',$_POST['post_tag_field'] );
	}
}
function create_customtaxonomy_tax() {

	$labels = array(
		'name'              => _x( 'Custom Taxonomies', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Custom Taxonomy', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Custom Taxonomies', 'textdomain' ),
		'all_items'         => __( 'All Custom Taxonomies', 'textdomain' ),
		'parent_item'       => __( 'Parent Custom Taxonomy', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Custom Taxonomy:', 'textdomain' ),
		'edit_item'         => __( 'Edit Custom Taxonomy', 'textdomain' ),
		'update_item'       => __( 'Update Custom Taxonomy', 'textdomain' ),
		'add_new_item'      => __( 'Add New Custom Taxonomy', 'textdomain' ),
		'new_item_name'     => __( 'New Custom Taxonomy Name', 'textdomain' ),
		'menu_name'         => __( 'Custom Taxonomy', 'textdomain' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'textdomain' ),
		'hierarchical' => false,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'customtaxonomy', array('post'), $args );

}
add_action( 'init', 'create_customtaxonomy_tax' );


    function register_hello_world_widget( $widgets_manager ) {

        require_once( __DIR__ . '/widgets/hello-world-widget-1.php' );
        require_once( __DIR__ . '/widgets/hello-world-widget-2.php' );

        $widgets_manager->register( new \Elementor_Hello_World_Widget_1() );
        $widgets_manager->register( new \Elementor_Hello_World_Widget_2() );

    }
    add_action( 'elementor/widgets/register', 'register_hello_world_widget' );


function wp_tuts_menu_registration(){
	add_menu_page(
        'WP TUTS HOME ',
        'WP TUTS HOME ',
        'manage_options',
        'wp-tutorial',
        'wp_tuts_page_callback',
        'dashicons-index-card',
        10
    );
}
add_action( 'admin_menu', 'wp_tuts_menu_registration' );

function wp_tuts_page_callback(){
    if (!current_user_can('manage_options'))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
	}
    echo 'test';
}

function enqueue_scripts() {
    wp_register_style( 'ndf-uikit-tooltip-style',  WP_TUTS_URL . '/assets/css/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'ndf-uikit-tooltip-style' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts');
add_action( 'admin_enqueue_scripts', 'enqueue_scripts' );