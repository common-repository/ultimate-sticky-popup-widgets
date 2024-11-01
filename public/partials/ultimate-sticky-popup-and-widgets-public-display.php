<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Ultimate_Sticky_Popup_And_Widgets
 * @subpackage Ultimate_Sticky_Popup_And_Widgets/public/partials
 */
?>
<div class="uspaw sticky-popup">
    <div class="popup-wrap">
        <?php if( $this->uspaw_options['uspaw_popup_place'] !='top-left' && $this->uspaw_options['uspaw_popup_place'] !='top-right'): ?>
        <div class="popup-header <?php echo esc_attr($this->uspaw_options['uspaw_button_layout']); ?>">
            <span class="popup-title">
                <?php if( $this->uspaw_options['uspaw_popup_title'] != ''): 
                        echo esc_html($this->uspaw_options['uspaw_popup_title']);
                    endif;
                    if( $this->uspaw_options['uspaw_popup_title'] == ''):
                        echo esc_html('Contact Us','uspaw');
                    endif;
                    ?>

                <div class="popup-image">
                    <?php if( $this->uspaw_options['uspaw_popup_image'] != ''): ?>
                    <img src="<?php echo esc_url($this->uspaw_options['uspaw_popup_image']); ?>">
                    <?php endif;
                         if( $this->uspaw_options['uspaw_popup_image'] == ''): 
                            $url = plugin_dir_url( __DIR__ );
                            $imageurl = $url.'images/envelope.png';
                         ?>
                    <img src="<?php echo esc_url( $imageurl ); ?>" />
                    <?php endif;    
                        ?>
                </div>

            </span>
        </div>
        <?php endif; ?>
        <div class="popup-content">
            <div class="popup-content-pad">
                <?php if( $this->uspaw_options['uspaw_popup_content'] != ''):
                     $this->uspaw_options['uspaw_popup_content'] = apply_filters('the_content', $this->uspaw_options['uspaw_popup_content'] );
                     $this->uspaw_options['uspaw_popup_content'] = str_replace( ']]>', ']]&gt;', $this->uspaw_options['uspaw_popup_content'] );
                    echo $this->uspaw_options['uspaw_popup_content'];       
                endif; ?>
            </div>
        </div>
        <?php if( $this->uspaw_options['uspaw_popup_place'] == 'top-left' || $this->uspaw_options['uspaw_popup_place'] == 'top-right'): ?>
        <div class="popup-header <?php echo esc_attr($this->uspaw_options['uspaw_button_layout']); ?>">
            <span class="popup-title">
                <?php if( $this->uspaw_options['uspaw_popup_title'] != ''):
                        echo esc_html($this->uspaw_options['uspaw_popup_title']);
                    endif; 
                    if( $this->uspaw_options['uspaw_popup_title'] == ''):
                        echo esc_html('Contact Us','uspaw');
                    endif;
                    ?>
                <div class="popup-image">
                    <?php if( $this->uspaw_options['uspaw_popup_image'] != ''): ?>
                    <img src="<?php echo esc_url($this->uspaw_options['uspaw_popup_image']); ?>">
                    <?php endif;
                         if( $this->uspaw_options['uspaw_popup_image'] == ''): 
                            $url = plugin_dir_url( __DIR__ );
                            $imageurl = $url.'images/envelope.png';
                         ?>
                    <img src="<?php echo esc_url( $imageurl ); ?>" />
                    <?php endif;    
                        ?>
                </div>
            </span>
        </div>
        <?php endif; ?>
    </div>
</div>