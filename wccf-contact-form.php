<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );

/**
 * Plugin Name:       WC Contact Form
 * Plugin URI:        https://github.com/qurinastha/wccf-contact-form
 * Description:       A simple contact form plugin for the WordPress Plugin Development Workshop
 * Version:           2.0.0
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

            //Display Shortcode API
            add_shortcode( 'wccf_contact_form', array( $this, 'generate_contact_form_html' ) );

            //enqueue front scripts
            add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_assets' ) );

            //ajax call
            add_action( 'wp_ajax_wccf_ajax_action', array( $this, 'process_form_ajax' ) );
            add_action( 'wp_ajax_nopriv_wccf_ajax_action', array( $this, 'process_form_ajax' ) );

        }


        function define_constants() {

            defined( 'WCCF_PLUGINNAME' ) or define( 'WCCF_PLUGINNAME', 'WC Contact Form' );
            defined( 'WCCF_PATH' ) or define( 'WCCF_PATH', plugin_dir_path( __FILE__ ) );
            defined( 'WCCF_URL' ) or define( 'WCCF_URL', plugin_dir_url( __FILE__ ) );
            defined( 'WCCF_VERSION' ) or define( 'WCCF_VERSION', '2.0.0' );

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

            if ( !empty( $_POST['wccf_settings_nonce_field'] ) && wp_verify_nonce( $_POST['wccf_settings_nonce_field'], 'wccf_settings_nonce' ) ) {

                $name_field_label       = sanitize_text_field( $_POST['name_field_label'] );
                $email_field_label      = sanitize_text_field( $_POST['email_field_label'] );
                $message_field_label    = sanitize_text_field( $_POST['message_field_label'] );
                $submit_button_label    = sanitize_text_field( $_POST['submit_button_label'] );
                $admin_email            = sanitize_email( $_POST['admin_email'] );
                
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

        }

        function displayArr( $array ) {
            if ( isset( $_GET['debug'] ) ) {
                echo "<pre>";
                print_r( $array );
                echo "</pre>";
            }
        }


        /*
        * ShortCode API Integration
        * Use shortcode [wccf_contact_form]
        * */
        function generate_contact_form_html(){

            ob_start();

            include(WCCF_PATH . 'includes/frontend/shortcode.php');

            $form_html = ob_get_contents();

            ob_end_clean();

            return $form_html;

        }


        function register_frontend_assets(){

           
            $js_object = array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'ajax_nonce' => wp_create_nonce( 'wccf_ajax_nonce' ) );

            wp_enqueue_style( 'wccf-front-style', WCCF_URL . 'assets/css/wccf-frontend.css', array(), WCCF_VERSION );
            wp_enqueue_script( 'wccf-front-script', WCCF_URL . 'assets/js/wccf-frontend.js', array( 'jquery' ), WCCF_VERSION );

            wp_localize_script( 'wccf-front-script', 'wccf_js_obj', $js_object );

        }


        function process_form_ajax(){

            if ( !empty( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'wccf_ajax_nonce' ) ) {

                $wccf_settings   = get_option( 'wccf_settings' );

                $name_field     = sanitize_text_field( $_POST['name_field'] );
                $email_field    = sanitize_text_field( $_POST['email_field'] );
                $message_field  = sanitize_text_field( $_POST['message_field'] );
                $email_html = 'Hello there, <br/>'
                        . '<br/>'
                        . 'Your have received an email from your site. Details below: <br/>'
                        . '<br/>'
                        . 'Name: ' . $name_field . '<br/>'
                        . 'Email: ' . $email_field . '<br/>'
                        . 'Message: ' . $message_field . '<br/>'
                        . '<br/>'
                        . 'Thank you';
                $headers[]   = 'Content-Type: text/html; charset=UTF-8';
                $headers[]   = 'No Reply<noreply@localhost.com>';
                $subject     = 'New contact email received';
                $admin_email = (!empty( $wccf_settings['admin_email'] )) ? $wccf_settings['admin_email'] : get_option( 'admin_email' );
                
                $mail_check  = wp_mail( $admin_email, $subject, $email_html, $headers );
               
                if ( $mail_check ) {
                    $status = 200;
                    $message = 'Email sent successfully.';
                } else {
                    $status = 403;
                    $message = 'Email couldn\'t be sent due to local server. Please try on live server.';
                }

                $response['status'] = $status;
                $response['message'] = $message;

                die( json_encode( $response ) );

            } else {

                die( 'No script kiddies please!!' );

            }

        }


    }

    new WCCF_Contact_Form();
}