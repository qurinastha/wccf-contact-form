<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );

$wccf_settings = get_option( 'wccf_settings' );

?>
<form class="wccf-form" method="post" action="">
    
    <div class="wccf-field-wrap">
        <label><?php echo (!empty( $wccf_settings['name_field_label'] )) ? esc_html( $wccf_settings['name_field_label'] ) : 'Your Name'; ?></label>
        <div class="wccf-field">
            <input type="text" name="name_field"/>
        </div>
    </div>
    <div class="wccf-field-wrap">
        <label><?php echo (!empty( $wccf_settings['email_field_label'] )) ? esc_html( $wccf_settings['email_field_label'] ) : 'Your email'; ?></label>
        <div class="wccf-field">
            <input type="text" name="email_field"/>
        </div>
    </div>
    <div class="wccf-field-wrap">
        <label><?php echo (!empty( $wccf_settings['message_field_label'] )) ? esc_html( $wccf_settings['message_field_label'] ) : 'Your message'; ?></label>
        <div class="wccf-field">
            <textarea name="message"></textarea>
        </div>
    </div>
    <div class="wccf-field-wrap">
        <label></label>
        <div class="wccf-field">
            <input type="submit" value="<?php echo (!empty( $wccf_settings['submit_button_label'] )) ? esc_html( $wccf_settings['submit_button_label'] ) : 'Save Settings'; ?>"/>
            <img src="<?php echo WCCF_URL . 'assets/images/ajax-loader.gif'; ?>" class="wccf-ajax-loader" style="display:none;"/>
        </div>
    </div>

    <div class="wccf-message-wrap" style="display: none;"></div>

</form>