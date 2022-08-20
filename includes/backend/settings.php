<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
$wccf_settings = get_option( 'wccf_settings' );
if ( !empty( $wccf_settings ) ) {
    $this->displayArr( $wccf_settings );
}
?>
<div class="wrap">
     <div class="wccf-header">
         <h2><?php echo WCCF_PLUGINNAME;?> Settings</h2>
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

            <h3>Field Settings</h3>

            <div class="wccf-field-wrap">
                <label>Name Field Label</label>
                <div class="wccf-field">
                    <input type="text" name="name_field_label" placeholder="Fill label for name here" value="<?php echo (!empty( $wccf_settings['name_field_label'] )) ? esc_attr($wccf_settings['name_field_label']) : ''; ?>"/>
                </div>
            </div>

            <div class="wccf-field-wrap">
                <label>Email Field Label</label>
                <div class="wccf-field">
                    <input type="text" name="email_field_label" placeholder="Fill label for email here" value="<?php echo (!empty( $wccf_settings['email_field_label'] )) ? esc_attr($wccf_settings['email_field_label']) : ''; ?>"/>
                </div>
            </div>

            <div class="wccf-field-wrap">
                <label>Message Field Label</label>
                <div class="wccf-field">
                    <input type="text" name="message_field_label" placeholder="Fill label for message here" value="<?php echo (!empty( $wccf_settings['message_field_label'] )) ? esc_attr($wccf_settings['message_field_label']) : ''; ?>"/>
                </div>
            </div>

            <div class="wccf-field-wrap">
                <label>Submit Button Label</label>
                <div class="wccf-field">
                    <input type="text" name="submit_button_label" placeholder="Fill label for submit button here" value="<?php echo (!empty( $wccf_settings['submit_button_label'] )) ? esc_attr($wccf_settings['submit_button_label']) : ''; ?>"/>
                </div>
            </div>

            <h3>Additional Settings</h3>

            <div class="wccf-field-wrap">
                <label>Admin Email</label>
                <div class="wccf-field">
                    <input type="email" name="admin_email" placeholder="Fill custom email here" value="<?php echo (!empty( $wccf_settings['admin_email'] )) ? esc_attr($wccf_settings['admin_email']) : ''; ?>"/>
                </div>
            </div>

            <div class="wccf-field-wrap">
                <label></label>
                <div class="wccf-field">
                    <input type="submit" class="btn button-primary" value="Save Settings"/>
                </div>
            </div>
        </form>
    </div>
</div>