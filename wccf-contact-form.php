<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );

/**
 * Plugin Name:       WC Contact Form
 * Plugin URI:        https://github.com/qurinastha/wccf-contact-form
 * Description:       A simple contact form plugin for the WordPress Plugin Development Workshop
 * Version:           1.0.3
 * Requires at least: 5.2
 * Requires PHP:      5.0
 * Author:            Qurina Shrestha
 * Author URI:        https://github.com/qurinastha
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wccf-contact-form
 * Domain Path:       /languages
 */

if ( !class_exists( 'WCCF_Contact_Form' ) ) {

    class WCCF_Contact_Form {

        function __construct() {

            add_action( 'admin_menu', array( $this, 'wccf_admin_menu' ) );

        }

        function wccf_admin_menu() {

            add_menu_page( 'WC Contact Form', 'WC Contact Form', 'manage_options', 'wccf-contact-form', array( $this, 'wccf_settings_page' ), 'dashicons-email' );
      
        }

        function wccf_settings_page() {

            include( plugin_dir_path( __FILE__ ) . 'includes/backend/settings.php' );
            
        }

    }

    new WCCF_Contact_Form();
}