<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Ultimate_Sticky_Popup_And_Widgets
 * @subpackage Ultimate_Sticky_Popup_And_Widgets/admin/partials
 */
$uspaw_object = new Ultimate_Sticky_Popup_And_Widgets;
$text_domain = $uspaw_object->get_plugin_name();
$uspaw_options = Ultimate_Sticky_Popup_And_Widgets::uspaw_get_options();
$get_uspaw_button_layout = $uspaw_object->get_uspaw_button_layout();
$get_uspaw_place = $uspaw_object->get_uspaw_place();
?>
<div class="wrap">
    <h2><?php echo esc_html( 'Ultimate Sticky Popup & Widget Settings' );?></h2>
    <?php if($uspaw_options['uspaw_social_share_active']): ?>
    <div class="uspaw_current_short_code"> 
        <h4>Copy this short code to display Social Share:</h4>
        <div class='uspaw-current-short-code-wrap'>
            <input type="text" size="30" readonly name="uspaw_shortcode" id="uspaw_shortcode_id" value="[uspaw_social_share]" disabled/>&nbsp;&nbsp; 
            <span class="uspaw-copy-to-clip" id="uspaw_copy_to_clip_id" alt="copy">Copy</span>
        </div>
        <span class="aps-text-copied-msg" style="display:none;">Shortcode copied!</span>
    </div>
    <?php endif; ?>
    <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="save_uspaw_update_settings" />
        <?php wp_nonce_field(-1,'save_uspaw_popup' ); ?>
        <?php if(isset($_GET["update-status"])): ?>
        <div class="notice notice-success is-dismissible">
            <p><?php echo esc_html('Settings save successfully!'); ?>.</p>
        </div>
        <?php endif; ?>
        <div class="sticky_popup_form">
            <table class="form-table" width="100%">
                <tr>
                    <th scope="row">Display Popup</th>
                    <td>
                        <input type="checkbox" name="popup_active" id="popup_active" value="1"
                            <?php if($uspaw_options['uspaw_popup_active'])  echo 'checked="checked"'; else '';?>>&nbsp;<label
                            for="popup_active"><strong><?php echo esc_html('Enable Us');?></strong></label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Enable Social Share</th>
                    <td>
                        <input type="checkbox" name="social_share_active" id="popup_active" value="1"
                            <?php if($uspaw_options['uspaw_social_share_active'])  echo 'checked="checked"'; else '';?>>&nbsp;<label
                            for="social_share_active"><strong><?php echo esc_html('Enable Share');?></strong></label>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="button_layout"><?php echo esc_html( 'Layout' );?></label></th>
                    <td><select name="button_layout" id="button_layout">
                            <?php foreach ( $get_uspaw_button_layout as $key => $value ): ?>
                            <option value="<?php esc_attr_e( $key ); ?>"
                                <?php esc_attr_e( $key == $uspaw_options['uspaw_button_layout'] ? ' selected="selected"' : '' ); ?>>
                                <?php esc_attr_e( $value ); ?></option>
                            <?php endforeach;?>
                        </select></td>
                </tr>
                <tr>
                    <th scope="row"><label for="popup_title"><?php echo esc_html( 'Popup Title');?></label></th>
                    <td><input type="text" name="popup_title" id="popup_title" size="25"
                            value="<?php echo esc_attr($uspaw_options['uspaw_popup_title']); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="popup_title_color"><?php echo esc_html( 'Popup Title Color' );?></label>
                    </th>
                    <td><input type="text" name="popup_title_color" id="popup_title_color" maxlength="255" size="25"
                            value="<?php echo esc_attr($uspaw_options['uspaw_popup_color']); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label
                            for="popup_title_image"><?php echo esc_html( 'Popup Title Right Side Icon');?></label></th>
                    <td><input type="text" name="popup_title_image" id="popup_title_image" maxlength="255" size="25"
                            value="<?php echo esc_attr($uspaw_options['uspaw_popup_image']); ?>"><input
                            id="popup_title_image_button" class="button" type="button" value="Upload Image" />
                        <br />Enter a URL or upload an image
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label
                            for="popup_right_icon_border"><?php echo esc_html( 'Popup Right Icon Border Color' );?></label>
                    </th>
                    <td><input type="text" name="popup_right_icon_border" id="popup_right_icon_border"
                            maxlength="255" size="25"
                            value="<?php echo esc_attr($uspaw_options['uspaw_popup_right_icon_border']); ?>"></td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="popup_header_color"><?php echo esc_html( 'Popup Header Color' );?></label>
                    </th>
                    <td><input type="text" name="popup_header_color" id="popup_header_color" maxlength="255" size="25"
                            value="<?php echo esc_attr($uspaw_options['uspaw_popup_header_color']); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label
                            for="popup_header_border_color"><?php echo esc_html( 'Popup Header Border Color' );?></label>
                    </th>
                    <td><input type="text" name="popup_header_border_color" id="popup_header_border_color"
                            maxlength="255" size="25"
                            value="<?php echo esc_attr($uspaw_options['uspaw_popup_header_border_color']); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="popup_place"><?php echo esc_html( 'Popup Place' );?></label></th>
                    <td><select name="popup_place" id="popup_place">
                            <?php foreach ( $get_uspaw_place as $key => $value ): ?>
                            <option value="<?php esc_attr_e( $key ); ?>"
                                <?php esc_attr_e( $key == $uspaw_options['uspaw_popup_place'] ? ' selected="selected"' : '' ); ?>>
                                <?php esc_attr_e( $value ); ?></option>
                            <?php endforeach;?>
                        </select></td>
                </tr>

                <tr>
                    <th scope="row"><label for="popup_top_margin"><?php echo esc_html( 'Popup Top Margin');?></label>
                    </th>
                    <td><input type="number" name="popup_top_margin" id="popup_top_margin" maxlength="255" size="25"
                            value="<?php echo esc_attr($uspaw_options['uspaw_popup_top_margin']); ?>">%<br />
                        <small>Top margin is only included if popup place Left or Right is selected. Please enter
                            numeric value.
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label
                            for="popup_content"><?php echo esc_html( 'Popup Content');?><br></label><small><?php echo esc_html( 'you can add shortcode or html' );?></small>
                    </th>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="100%;">
                            <?php                           
                                    $args = array(
                                        'textarea_name' => 'popup_content',
                                        'textarea_rows' => 10,
                                        'editor_class'  => 'uspaw_content',
                                        'wpautop'       => true,
                                    );
                                    wp_editor( $uspaw_options['uspaw_popup_content'], 'popup_content', $args ); 
                                    ?>
                        </div>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="Submit" class="button-primary"
                    value="<?php echo esc_attr( 'Save Changes' ) ?>" />
            </p>
        </div>
    </form>
</div>