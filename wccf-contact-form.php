<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );

/**
 * Plugin Name:       WC Contact Form
 * Plugin URI:        https://github.com/qurinastha/wccf-contact-form
 * Description:       A simple contact form plugin for the WordPress Plugin Development Workshop
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      5.0
 * Author:            Qurina Shrestha
 * Author URI:        https://github.com/qurinastha
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wccf-contact-form
 * Domain Path:       /languages
 */

add_action( 'admin_menu', 'wccf_admin_menu' );

if ( !function_exists( 'wccf_admin_menu' ) ) {

    function wccf_admin_menu() {
        add_menu_page( 'WC Contact Form', 'WC Contact Form', 'manage_options', 'wccf-contact-form', 'wccf_settings_page', 'dashicons-email' );
    }

}

if ( !function_exists( 'wccf_settings_page' ) ) {

    function wccf_settings_page() {
        echo "This is our plugin's main settings page";
    }

}