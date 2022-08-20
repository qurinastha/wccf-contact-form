<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );?>
<div class="wrap">
     <div class="wccf-header">
         <h2><?php echo WCCF_PLUGINNAME;?> Settings</h2>
     </div>
    <div class="wccf-settings-wrap">
        <em>Version: <?php echo WCCF_VERSION;?></em>
        <form>
            <h3>Field Settings</h3>
            <div class="wccf-field-wrap">
                <label>Name Field Label</label>
                <div class="wccf-field">
                    <input type="text" name="name_field_label" placeholder="Fill label for name here"/>
                </div>
            </div>
            <div class="wccf-field-wrap">
                <label>Email Field Label</label>
                <div class="wccf-field">
                    <input type="text" name="email_field_label" placeholder="Fill label for email here"/>
                </div>
            </div>
            <div class="wccf-field-wrap">
                <label>Message Field Label</label>
                <div class="wccf-field">
                    <input type="text" name="message_field_label" placeholder="Fill label for message here"/>
                </div>
            </div>
            <div class="wccf-field-wrap">
                <label>Submit Button Label</label>
                <div class="wccf-field">
                    <input type="text" name="submit_button_label" placeholder="Fill label for submit button here"/>
                </div>
            </div>
            <h3>Additional Settings</h3>
            <div class="wccf-field-wrap">
                <label>Admin Email</label>
                <div class="wccf-field">
                    <input type="text" name="admin_email" placeholder="Fill custom email here"/>
                </div>
            </div>
            <div class="wccf-field-wrap">
                <label></label>
                <div class="wccf-field">
                    <input type="button" class="btn button-primary" value="Save Settings"/>
                </div>
            </div>
        </form>
    </div>
</div>