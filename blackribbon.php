<?php
/*
Plugin Name: BlackRibbon
Plugin URI: http://nuuneoi.com/blog/blog.php?read_id=884
Version: 1.0
Description: Add Mourning Black Ribbon to your site
Author: Sittiphol Phanvilai
Author URI: https://nuuneoi.com
*/

function blackribbon_scripts() {
    wp_enqueue_style( 'blackribbon', plugins_url( 'css/style.css', __FILE__ ) );
    //wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'blackribbon_scripts' );

function blackribbon_head_hook() {
    $ribbon_position = get_option('ribbon_position');
    if (empty($ribbon_position))
        $ribbon_position = 'top_left';

    $positions = explode('_', $ribbon_position);
    echo "<img src='" . plugins_url( 'images/black_ribbon_' . $ribbon_position . '.png', __FILE__ ) . "' class='black-ribbon stick-" . $positions[0] . " stick-" . $positions[1] . "'/>";
}
add_action('wp_footer', 'blackribbon_head_hook');


/* Admin */
function blackribbon_page_create() {
    $page_title = 'Black Ribbon Admin Page';
    $menu_title = 'Black Ribbon';
    $capability = 'edit_posts';
    $menu_slug = 'blackribbon_page';
    $function = 'blackribbon_page_display';
    $icon_url = '';
    $position = 24;

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}
function blackribbon_page_display() {
    include dirname(__FILE__) . '/admin-form.php';
}
add_action('admin_menu', 'blackribbon_page_create');


function display_blackribbon_position_element()
{
    $ribbon_position = get_option('ribbon_position');
    if (empty($ribbon_position))
        $ribbon_position = 'top_left';
  	echo '<input type="radio" name="ribbon_position" value="top_left" ' . ($ribbon_position == 'top_left' ? 'checked' : '') . '/>Top Left<br/><br/>';
    echo '<input type="radio" name="ribbon_position" value="top_right" ' . ($ribbon_position == 'top_right' ? 'checked' : '') . '/>Top Right<br/><br/>';
    echo '<input type="radio" name="ribbon_position" value="bottom_left" ' . ($ribbon_position == 'bottom_left' ? 'checked' : '') . '/>Bottom Left<br/><br/>';
    echo '<input type="radio" name="ribbon_position" value="bottom_right" ' . ($ribbon_position == 'bottom_right' ? 'checked' : '') . '/>Bottom Right<br/>';
}
function display_blackribbon_panel_fields() {
    add_settings_section("section", "All Settings", null, "blackribbon-options");

    add_settings_field("ribbon_position", "Ribbon Position", "display_blackribbon_position_element", "blackribbon-options", "section");

    register_setting("section", "ribbon_position");
}
add_action('admin_init', 'display_blackribbon_panel_fields');
