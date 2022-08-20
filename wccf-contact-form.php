<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );

/**
 * Plugin Name:       WC Contact Form
 * Plugin URI:        https://github.com/qurinastha/wccf-contact-form
 * Description:       A simple contact form plugin for the WordPress Plugin Development Workshop
 * Version:           1.0.7
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

            //define constants
            $this->define_constants();

            add_action( 'admin_menu', array( $this, 'wccf_admin_menu' ) );

            // admin enqueue scripts
            add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_assets' ) );

            add_action( 'admin_post_wccf_settings_save_action', array( $this, 'save_settings_action' ) );

        }


        function define_constants() {

            defined( 'WCCF_PLUGINNAME' ) or define( 'WCCF_PLUGINNAME', 'WC Contact Form' );
            defined( 'WCCF_PATH' ) or define( 'WCCF_PATH', plugin_dir_path( __FILE__ ) );
            defined( 'WCCF_URL' ) or define( 'WCCF_URL', plugin_dir_url( __FILE__ ) );
            defined( 'WCCF_VERSION' ) or define( 'WCCF_VERSION', '1.0.7' );

        }

        function wccf_admin_menu() {

            add_menu_page( 'WC Contact Form', 'WC Contact Form', 'manage_options', 'wccf-contact-form', array( $this, 'wccf_settings_page' ), 'dashicons-email' );
      
        }

        function wccf_settings_page() {

            include( WCCF_PATH . 'includes/backend/settings.php' );
            
        }

        function register_admin_assets(){

            wp_enqueue_style( 'wccf-backend-style', WCCF_URL . 'assets/css/wccf-backend.css', array(), WCCF_VERSION );
            wp_enqueue_script( 'wccf-backend-script', WCCF_URL . 'assets/js/wccf-backend.js', array( 'jquery' ), WCCF_VERSION );

        }

        function save_settings_action(){

            $name_field_label       = $_POST['name_field_label'];
            $email_field_label      = $_POST['email_field_label'];
            $message_field_label    = $_POST['message_field_label'];
            $submit_button_label    = $_POST['submit_button_label'];
            $admin_email            = $_POST['admin_email'];
            
            $wccf_settings = array(
                'name_field_label'    => $name_field_label,
                'email_field_label'   => $email_field_label,
                'message_field_label' => $message_field_label,
                'submit_button_label' => $submit_button_label,
                'admin_email'         => $admin_email 
            );

            update_option( 'wccf_settings', $wccf_settings );

            wp_redirect( admin_url( 'admin.php?page=wccf-contact-form&message=1' ) );

            exit;

        }

        function displayArr( $array ) {
            if ( isset( $_GET['debug'] ) ) {
                echo "<pre>";
                print_r( $array );
                echo "</pre>";
            }
        }


    }

    new WCCF_Contact_Form();
}