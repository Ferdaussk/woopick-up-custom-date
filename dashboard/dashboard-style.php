<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// Taxos label check
$wpucd_thankyou_page_check = get_option( 'wpucd-thankyou-page-check', 'on' );
$wpucd_send_date_email = get_option( 'wpucd-send-date-email', 'on' );
// Label controls
// *** estimass
$wpucd_estimass_color_value = get_option( 'wpucd-estimass-color');
$wpucd_estimass_fontsize_value = get_option( 'wpucd-estimass-fontsize');
$wpucd_estimass_fontweight_value = get_option( 'wpucd-estimass-fontweight');
$wpucd_estimass_fontfamilly_value = get_option( 'wpucd-estimass-fontfamilly');
// *** estimdate
$wpucd_product_shipted_value = get_option( 'wpucd-product-shipted', 'Recommended order received date and time ');
$wpucd_product_multidates_value = get_option( 'wpucd-product-multidates', '2023-10-09');
$wpucd_product_delivered_value = get_option( 'wpucd-product-delivered', 'This order will be delivered on ');
$wpucd_shipping_icon_value = get_option( 'wpucd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/delivery-service.png');
$wpucd_shipimgsize_value = get_option( 'wpucd-shipimgsize-check');
$wpucd_notice_position_value = get_option( 'wpucd-notice-position', 'top' );
$wpucd_pagechack_value = get_option( 'wpucd-check-orderdatefrmt-taxo-widget', 'DD MMM YYYY' );
$wpucd_weekend0_value = get_option( 'wpucd-check-weekend0-widget', 0 );
$wpucd_weekend1_value = get_option( 'wpucd-check-weekend1-widget');
$wpucd_weekend2_value = get_option( 'wpucd-check-weekend2-widget');
$wpucd_weekend3_value = get_option( 'wpucd-check-weekend3-widget');
$wpucd_weekend4_value = get_option( 'wpucd-check-weekend4-widget');
$wpucd_weekend5_value = get_option( 'wpucd-check-weekend5-widget');
$wpucd_weekend6_value = get_option( 'wpucd-check-weekend6-widget');
// *** reason
$wpucd_reason_color_value = get_option( 'wpucd-reason-color');
$wpucd_reason_fontsize_value = get_option( 'wpucd-reason-fontsize');
$wpucd_reason_bdrcolor_value = get_option( 'wpucd-reason-bdrcolor');
$wpucd_reason_bdrwidth_value = get_option( 'wpucd-reason-bdrwidth');
$wpucd_reason_fontweight_value = get_option( 'wpucd-reason-fontweight');
// *** estimdate
$wpucd_estimdate_color_value = get_option( 'wpucd-estimdate-color');
$wpucd_estimdate_fontsize_value = get_option( 'wpucd-estimdate-fontsize');
$wpucd_estimdate_fontweight_value = get_option( 'wpucd-estimdate-fontweight');
$wpucd_estimdate_fontfamilly_value = get_option( 'wpucd-estimdate-fontfamilly');
// Get all font here start
$all_fonts = [
	'' => 'Default',
	'Arial, sans-serif' => 'Arial',
	'Helvetica, sans-serif' => 'Helvetica',
	'Georgia, serif' => 'Georgia',
	'fantasy' => 'Fantasy',
	'Tahoma, sans-serif' => 'Tahoma',
	'Courier New, monospace' => 'Courier New',
	'Palatino, serif' => 'Palatino',
	'Garamond, serif' => 'Garamond',
	'Century Gothic, sans-serif' => 'Century Gothic',
	'Futura, sans-serif' => 'Futura',
	'Roboto, sans-serif' => 'Roboto',
	'Open Sans, sans-serif' => 'Open Sans',
	'Lato, sans-serif' => 'Lato',
	'Montserrat, sans-serif' => 'Montserrat',
	'Raleway, sans-serif' => 'Raleway',
	'Poppins, sans-serif' => 'Poppins',
	'Nunito, sans-serif' => 'Nunito',
	'Playfair Display, serif' => 'Playfair Display',
	'Quicksand, sans-serif' => 'Quicksand',
];
?>
<div class="admin-panel">
  <form method="post" action="options.php">
    <div class="header">
			<?php
			settings_fields( 'wpucd-plugin-settings' );
      ?>
      <a href="https://bestwpdeveloper.com/" target="_blank"><h1 class="dashboard-title"><?php echo esc_html__('BEST WP DEVELOPER', 'woopick-up-custom-date'); ?></h1></a>
      <?php
			do_settings_sections( 'wpucd-plugin-main-menu' );
      ?>
      <div class="save-button">
        <?php submit_button(); ?>
      </div>
    </div>
    <div class="section">
      <div class="clmn-wrap first-clm">
        <div class="select-container">
          <label for=""><?php echo esc_html__('Label position to date', 'woopick-up-custom-date'); ?></label>
          <select name="wpucd-notice-position">
            <option value="top" <?php selected($wpucd_notice_position_value, 'top'); ?>><?php echo esc_html__('Top', 'woopick-up-custom-date'); ?></option>
            <option value="bottom" <?php selected($wpucd_notice_position_value, 'bottom'); ?>><?php echo esc_html__('Bottom', 'woopick-up-custom-date'); ?></option>
          </select>
        </div>
        <div class="select-container emessage-container">
        <label><?php echo esc_html__('Select off days:', 'woopick-up-custom-date'); ?></label>
          <?php echo '<input type="text" name="wpucd-product-multidates" id="wpucd-product-multidates" value="'.$wpucd_product_multidates_value.'" placeholder="'.$wpucd_product_multidates_value.'"/>'; ?>
        </div>
        <div class="select-container emessage-container">
          <label><?php echo esc_html__('Checkout page label:', 'woopick-up-custom-date'); ?></label>
          <?php echo '<input type="text" name="wpucd-product-shipted" id="wpucd-product-shipted" value="'.$wpucd_product_shipted_value.'" title="Text"  placeholder="Recommended order received date and time ">'; ?>
        </div>
        <div class="select-container emessage-container">
          <label><?php echo esc_html__('Thankyou page label:', 'woopick-up-custom-date'); ?></label>
          <?php echo '<input type="text" name="wpucd-product-delivered" id="wpucd-product-delivered" value="'.$wpucd_product_delivered_value.'" title="Text"  placeholder="This order will be delivered on ">';?>
        </div>
        <div class="select-container emessage-container">
          <label><?php echo esc_html__('Image url:', 'woopick-up-custom-date'); ?></label>
          <?php echo '<input type="text" name="wpucd-shipping-icon" id="wpucd-shipping-icon" value="'.$wpucd_shipping_icon_value.'" title="If don\'t want empty it."  placeholder="Url here">';?>
        </div>
        <div class="select-container emessage-container">
          <label><?php echo esc_html__('Image size', 'woopick-up-custom-date'); ?></label>
          <input type="text" name="wpucd-shipimgsize-check" value="<?php echo $wpucd_shipimgsize_value; ?>" title="If don\'t want empty it."  placeholder="px, %, rem">
        </div>

        <!-- For week end -->
        <div class="choose-page"><?php echo esc_html__('Week end:', 'woopick-up-custom-date'); ?></div>
        <div class="list-container dayoff-select">
          <!-- Multi Select -->
          <div class="list-container wpucd_cmmn_chacthak">
            <input type="checkbox" name="wpucd-check-weekend0-widget" value="0" <?php echo checked( $wpucd_weekend0_value, '0', false ); ?>>
            <label class="checker-switch"><?php echo esc_html__('Sunday', 'woopick-up-custom-date'); ?></label>
          </div>
          <div class="list-container wpucd_cmmn_chacthak">
            <input type="checkbox" name="wpucd-check-weekend1-widget" value="1" <?php echo checked( $wpucd_weekend1_value, '1', false ); ?>>
            <label class="checker-switch"><?php echo esc_html__('Monday', 'woopick-up-custom-date'); ?></label>
          </div>
          <div class="list-container wpucd_cmmn_chacthak">
            <input type="checkbox" name="wpucd-check-weekend2-widget" value="2" <?php echo checked( $wpucd_weekend2_value, '2', false ); ?>>
            <label class="checker-switch"><?php echo esc_html__('Tuesday', 'woopick-up-custom-date'); ?></label>
          </div>
          <div class="list-container wpucd_cmmn_chacthak">
            <input type="checkbox" name="wpucd-check-weekend3-widget" value="3" <?php echo checked( $wpucd_weekend3_value, '3', false ); ?>>
            <label class="checker-switch"><?php echo esc_html__('Wednesday', 'woopick-up-custom-date'); ?></label>
          </div>
          <div class="list-container wpucd_cmmn_chacthak">
            <input type="checkbox" name="wpucd-check-weekend4-widget" value="4" <?php echo checked( $wpucd_weekend4_value, '4', false ); ?>>
            <label class="checker-switch"><?php echo esc_html__('Thursday', 'woopick-up-custom-date'); ?></label>
          </div>
          <div class="list-container wpucd_cmmn_chacthak">
            <input type="checkbox" name="wpucd-check-weekend5-widget" value="5" <?php echo checked( $wpucd_weekend5_value, '5', false ); ?>>
            <label class="checker-switch"><?php echo esc_html__('Friday', 'woopick-up-custom-date'); ?></label>
          </div>
          <div class="list-container wpucd_cmmn_chacthak">
            <input type="checkbox" name="wpucd-check-weekend6-widget" value="6" <?php echo checked( $wpucd_weekend6_value, '6', false ); ?>>
            <label class="checker-switch"><?php echo esc_html__('Saturday', 'woopick-up-custom-date'); ?></label>
          </div>
        </div>

        <div class="choose-page"><?php echo esc_html__('Date format:', 'woopick-up-custom-date'); ?></div>
        <div class="list-container">
          <div class="list-item">
            <input type="radio" name="wpucd-check-orderdatefrmt-taxo-widget" value="DD MMM YYYY"
            <?php checked(get_option('wpucd-check-orderdatefrmt-taxo-widget', 'off'), 'DD MMM YYYY'); ?>>
            <label ><?php echo esc_html__('03 Nov 2023', 'woopick-up-custom-date'); ?></label>
          </div>
          <div class="list-item">
            <input type="radio" name="wpucd-check-orderdatefrmt-taxo-widget" value="YYYY-MM-DD HH:mm"
            <?php checked(get_option('wpucd-check-orderdatefrmt-taxo-widget', 'off'), 'YYYY-MM-DD HH:mm'); ?>>
            <label ><?php echo esc_html__('2023-11-03', 'woopick-up-custom-date'); ?></label>
          </div>
          <div class="list-item">
            <input type="radio" name="wpucd-check-orderdatefrmt-taxo-widget" value="MMMM D, YYYY"
            <?php checked(get_option('wpucd-check-orderdatefrmt-taxo-widget', 'off'), 'MMMM D, YYYY'); ?>>
            <label ><?php echo esc_html__('November 3, 2023', 'woopick-up-custom-date'); ?></label>
          </div>
          <div class="list-item">
            <input type="radio" name="wpucd-check-orderdatefrmt-taxo-widget" value="MMM D, YYYY"
            <?php checked(get_option('wpucd-check-orderdatefrmt-taxo-widget', 'off'), 'MMM D, YYYY'); ?>>
            <label ><?php echo esc_html__('Oct 31, 2023', 'woopick-up-custom-date'); ?></label>
          </div>
        </div>

        <div class="choose-page"><?php echo esc_html__('Settings check:', 'woopick-up-custom-date'); ?></div>
        <div class="list-container wpucd_cmmn_chacthak">
          <input type="checkbox" name="wpucd-thankyou-page-check" value="on" <?php echo checked( $wpucd_thankyou_page_check, 'on', false ); ?>>
          <label class="checker-switch"><?php echo esc_html__('Show in thank you Page', 'woopick-up-custom-date'); ?></label>
        </div>
        <div class="list-container wpucd_cmmn_chacthak">
          <input type="checkbox" name="wpucd-send-date-email" value="on" <?php echo checked( $wpucd_send_date_email, 'on', false ); ?>>
          <label class="checker-switch"><?php echo esc_html__('Send date in email', 'woopick-up-custom-date'); ?></label>
        </div>
      </div>
      <div class="clmn-wrap secound-clm">
        <div class="control_row">
        <label for="" class="wpucd_style_title"><?php echo esc_html__('Label style', 'woopick-up-custom-date');?></label>
          <div class="color-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Color', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" class="color-field" data-wheelcolorpicker data-wcp-format="rgba" name="wpucd-estimass-color" id="wpucd-estimass-color" value="'.$wpucd_estimass_color_value.'" placeholder="rgba(0,0,0,1)">'; ?>
          </div>
          <div class="text-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Font size', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" name="wpucd-estimass-fontsize" id="wpucd-estimass-fontsize" value="'.$wpucd_estimass_fontsize_value.'" title="10px"  placeholder="px, %, rem">';?>
          </div>
          <div class="number-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Font weight', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" name="wpucd-estimass-fontweight" id="wpucd-estimass-fontweight" value="'.$wpucd_estimass_fontweight_value.'" title="Number"  placeholder="400">';?>
          </div>
          <div class="select-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Font family', 'woopick-up-custom-date');?></label>
            <?php
            echo '<select id="wpucd-estimass-fontfamilly" name="wpucd-estimass-fontfamilly">';
              foreach($all_fonts as $font_slug => $font_title){
                echo '<option value="'.esc_attr($font_slug).'" '.selected(esc_attr($wpucd_estimass_fontfamilly_value),esc_attr($font_slug)).'>'.esc_html__($font_title,'woopick-up-custom-date').'</option>';
              }
            echo '</select>';
            ?>
          </div>
        </div>
        <div class="control_row">
        <label for="" class="wpucd_style_title"><?php echo esc_html__('Date style', 'woopick-up-custom-date');?></label>
          <div class="color-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Color', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" class="color-field" data-wheelcolorpicker data-wcp-format="rgba" name="wpucd-estimdate-color" id="wpucd-estimdate-color" value="'.$wpucd_estimdate_color_value.'" placeholder="rgba(0,0,0,1)">'; ?>
          </div>
          <div class="text-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Font size', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" name="wpucd-estimdate-fontsize" id="wpucd-estimdate-fontsize" value="'.$wpucd_estimdate_fontsize_value.'" title="10px"  placeholder="px, %, rem">';?>
          </div>
          <div class="number-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Font weight', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" name="wpucd-estimdate-fontweight" id="wpucd-estimdate-fontweight" value="'.$wpucd_estimdate_fontweight_value.'" title="Number"  placeholder="400">';?>
          </div>
          <div class="select-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Font family', 'woopick-up-custom-date');?></label>
            <?php
            echo '<select id="wpucd-estimdate-fontfamilly" name="wpucd-estimdate-fontfamilly">';
              foreach($all_fonts as $font_slug => $font_title){
                echo '<option value="'.esc_attr($font_slug).'" '.selected(esc_attr($wpucd_estimdate_fontfamilly_value),esc_attr($font_slug)).'>'.esc_html__($font_title,'woopick-up-custom-date').'</option>';
              }
            echo '</select>';
            ?>
          </div>
        </div>
        <div class="control_row">
        <label for="" class="wpucd_style_title"><?php echo esc_html__('Wrap style', 'woopick-up-custom-date');?></label>
          <div class="color-control wpucd-style-style">
            <label for=""><?php echo esc_html__('BG', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" class="color-field" data-wheelcolorpicker data-wcp-format="rgba" name="wpucd-reason-color" id="wpucd-reason-color" value="'.$wpucd_reason_color_value.'" placeholder="rgba(255,243,255,1)">'; ?>
          </div>
          <div class="text-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Border Radius', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" name="wpucd-reason-fontsize" id="wpucd-reason-fontsize" value="'.$wpucd_reason_fontsize_value.'" title="10px"  placeholder="px, %, rem">';?>
          </div>

          <div class="color-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Border color', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" class="color-field" data-wheelcolorpicker data-wcp-format="rgba" name="wpucd-reason-bdrcolor" id="wpucd-reason-bdrcolor" value="'.$wpucd_reason_bdrcolor_value.'" placeholder="rgba(204,204,204,1)">'; ?>
          </div>
          <div class="text-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Border width', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" name="wpucd-reason-bdrwidth" id="wpucd-reason-bdrwidth" value="'.$wpucd_reason_bdrwidth_value.'" title="10px"  placeholder="px, %, rem">';?>
          </div>

          <div class="number-control wpucd-style-style">
            <label for=""><?php echo esc_html__('Padding', 'woopick-up-custom-date');?></label>
            <?php echo '<input type="text" name="wpucd-reason-fontweight" id="wpucd-reason-fontweight" value="'.$wpucd_reason_fontweight_value.'" title="Number"  placeholder="0px 0px">';?>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
