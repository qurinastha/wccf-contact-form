<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
$wccf_settings = get_option( 'wccf_settings' );
if ( !empty( $wccf_settings ) ) {
    $this->displayArr( $wccf_settings );
}
?>
<div class="wrap">
     <div class="wccf-header">
         <h2><?php echo WCCF_PLUGINNAME;?> <?php esc_html_e( 'Settings', 'wccf-contact-form' ); ?></h2>
     </div>
     <?php
        if ( !empty( $_GET['message'] ) && $_GET['message'] == 1 ) {
            ?>
            <div class="notice notice-info is-dismissible inline">
                <p>
                    Settings saved successfully.
                </p>
            </div>
            <?php
        }
    ?>
    <div class="wccf-settings-wrap">

        <em>Version: <?php echo WCCF_VERSION;?></em>

        <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">

             <input type="hidden" name="action" value="wccf_settings_save_action"/>
             
             <?php wp_nonce_field( 'wccf_settings_nonce', 'wccf_settings_nonce_field' ); ?>

            <h3><?php esc_html_e( 'Field Settings', 'wccf-contact-form' ); ?></h3>

            <div class="wccf-field-wrap">
                <label><?php esc_html_e( 'Name Field Label', 'wccf-contact-form' ); ?></label>
                <div class="wccf-field">
                    <input type="text" name="name_field_label" placeholder="<?php esc_html_e( 'Fill label for name here', 'wccf-contact-form' ); ?>" value="<?php echo (!empty( $wccf_settings['name_field_label'] )) ? esc_attr($wccf_settings['name_field_label']) : ''; ?>"/>
                </div>
            </div>

            <div class="wccf-field-wrap">
                <label><?php esc_html_e( 'Email Field Label', 'wccf-contact-form' ); ?></label>
                <div class="wccf-field">
                    <input type="text" name="email_field_label" placeholder="<?php esc_html_e( 'Fill label for email here', 'wccf-contact-form' ); ?>" value="<?php echo (!empty( $wccf_settings['email_field_label'] )) ? esc_attr($wccf_settings['email_field_label']) : ''; ?>"/>
                </div>
            </div>

            <div class="wccf-field-wrap">
                <label><?php esc_html_e( 'Message Field Label', 'wccf-contact-form' ); ?></label>
                <div class="wccf-field">
                    <input type="text" name="message_field_label" placeholder="<?php esc_html_e( 'Fill label for message here', 'wccf-contact-form' ); ?>" value="<?php echo (!empty( $wccf_settings['message_field_label'] )) ? esc_attr($wccf_settings['message_field_label']) : ''; ?>"/>
                </div>
            </div>

            <div class="wccf-field-wrap">
                <label><?php esc_html_e( 'Submit Button Label', 'wccf-contact-form' ); ?></label>
                <div class="wccf-field">
                    <input type="text" name="submit_button_label" placeholder="<?php esc_html_e( 'Fill label for submit button here', 'wccf-contact-form' ); ?>" value="<?php echo (!empty( $wccf_settings['submit_button_label'] )) ? esc_attr($wccf_settings['submit_button_label']) : ''; ?>"/>
                </div>
            </div>

            <h3><?php esc_html_e( 'Additional Settings', 'wccf-contact-form' ); ?></h3>

            <div class="wccf-field-wrap">
                <label><?php esc_html_e( 'Admin Email', 'wccf-contact-form' ); ?></label>
                <div class="wccf-field">
                    <input type="email" name="admin_email" placeholder="<?php esc_html_e( 'Fill custom email here', 'wccf-contact-form' ); ?>" value="<?php echo (!empty( $wccf_settings['admin_email'] )) ? esc_attr($wccf_settings['admin_email']) : ''; ?>"/>
                </div>
            </div>

            <div class="wccf-field-wrap">
                <label></label>
                <div class="wccf-field">
                    <input type="submit" class="btn button-primary" value="<?php esc_html_e( 'Save Settings', 'wccf-contact-form' ); ?>"/>
                </div>
            </div>
        </form>
    </div>
</div>