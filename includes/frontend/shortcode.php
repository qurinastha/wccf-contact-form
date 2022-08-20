<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
/*
* $wccf_fields - Get all fields
*/ 

if( !empty( $wccf_fields ) ): 

do_action( 'wccf_before_main_form' );

if( isset( $_GET['debug'] ) ){
    $this->displayArr($wccf_fields);
    $this->displayArr($wccf_settings);
}

?>
<form class="wccf-form" method="post" action="">

      <?php

        $html_field = '';
        $wrapper_class = '';

        foreach( $wccf_fields as $key => $field):

            if( isset( $field['type'] ) ):
        
                if( !empty( $field['wrapper_class'] ) ){
                    $wrapper_class = esc_attr( implode( ' ', $field['wrapper_class'] ) );
                }

                $labelName = !empty( $wccf_settings[$field['label'].'_field_label'] ) ?  $wccf_settings[$field['label'].'_field_label'] : $field['label'];
                        
                $html_field .= '<div class="wccf-field-wrap '. $wrapper_class . '">';
    
                switch ( $field['type'] ) { 

                            case 'text':
                            case 'number':
                            case 'email':
                            case 'url':
                            case 'tel':

                            $html_field .= '<label>' . esc_attr( $labelName ) . '</label><div class="wccf-field"><input type="' . esc_attr( $field['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $field['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $field['id'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '"  value="" /></div>';
                            
                            break;

                            case 'textarea':

                            $html_field .= '<label>' . esc_attr( $field['label'] ) . '</label><div class="wccf-field"><textarea class="input-textarea ' . esc_attr( implode( ' ', $field['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $field['id'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" ></textarea></div>';
                                
                            break;
                } 

                $html_field .= '</div>';

            endif;
        
        endforeach; 
     
        echo $html_field;

     ?>

    <div class="wccf-field-wrap">
        <label></label>
        <div class="wccf-field">

            <input type="submit" value="<?php echo (!empty( $wccf_settings['submit_button_label'] )) ? esc_html( $wccf_settings['submit_button_label'] ) : 'Save Settings'; ?>"/>
            <img src="<?php echo WCCF_URL . 'assets/images/ajax-loader.gif'; ?>" class="wccf-ajax-loader" style="display:none;"/>
        
        </div>
    </div>

    <div class="wccf-message-wrap" style="display: none;"></div>

</form>
<?php 

do_action( 'wccf_after_main_form' );

endif;