<?php
namespace ProdWPUCD;
if ( ! defined( 'ABSPATH' ) ) exit;
use ProdWPUCD\PageSettings\Page_Settings;
define( "WPUCD_ASFSK_ASSETS_PUBLIC_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "WPUCD_ASFSK_ASSETS_ADMIN_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/admin" );
class ClassProdWPUCD {
	private static $_instance = null;
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function wpucd_all_assets_for_the_admin(){
        wp_enqueue_style( 'wpucd-order', plugin_dir_url( __FILE__ ) . 'assets/admin/order.css', null, '1.0', 'all' );
		if (isset($_GET['page']) && $_GET['page'] === 'get-woopick-up-custom-date') {
            // For multiple date selector
            wp_enqueue_style( 'wpucd-smoothness', 'http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css', null, '1.0', 'all' );
            wp_enqueue_script( 'wpucd-libs', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', array('jquery'), '1.0', true );
            wp_enqueue_script( 'wpucd-jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array('jquery'), '1.0', true );
            wp_enqueue_script( 'wpucd-multidatespicker', 'https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js', array('jquery'), '1.0', true );
            wp_enqueue_script( 'wpucd-main-script', plugin_dir_url( __FILE__ ) . 'assets/admin/multi-date-select/script.js', array('jquery'), '1.0', true );
            // For color picker
            wp_enqueue_script( 'wpucd-main-wheelcolorpicker', plugin_dir_url( __FILE__ ) . 'assets/admin/jquery.wheelcolorpicker.js', array('jquery'), '1.0', true );
            wp_enqueue_style( 'wpucd-style-wheelcolorpicker', plugin_dir_url( __FILE__ ) . 'assets/admin/wheelcolorpicker.css', null, '1.0', 'all' );
            
            $all_css_js_file = array(
                'wpucd-style' => array('wpucd_path_define'=>WPUCD_ASFSK_ASSETS_ADMIN_DIR_FILE . '/style.css'),
                'wpucd-multi-date-style' => array('wpucd_path_define'=>WPUCD_ASFSK_ASSETS_ADMIN_DIR_FILE . '/multi-date-select/style.css'),
            );
            foreach($all_css_js_file as $handle => $fileinfo){
                wp_enqueue_style( $handle, $fileinfo['wpucd_path_define'], null, '1.0', 'all');
            }
        }
	}

	public function wpucd_all_assets_for_the_public(){
        wp_enqueue_style( 'wpucd-daterangepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css', null, '1.0', 'all' );
        wp_enqueue_script( 'wpucd-jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array('jquery'), '1.0', true );
        wp_enqueue_script( 'wpucd-moment', 'https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js', array('jquery'), '1.0', true );
        wp_enqueue_script( 'wpucd-jsdelivr', 'https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.js', array('jquery'), '1.0', true );
        wp_enqueue_script( 'wpucd-info-script', plugin_dir_url( __FILE__ ) . 'assets/public/js/info.js', array('jquery'), '1.0', true );

        wp_enqueue_script( 'wpucd-script', plugin_dir_url( __FILE__ ) . 'assets/admin/script.js', array('jquery'), '1.0', true );
        $all_css_js_file = array(
            'wpucd-style' => array('wpucd_path_define'=>WPUCD_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/style.css'),
        );
        foreach($all_css_js_file as $handle => $fileinfo){
            wp_enqueue_style( $handle, $fileinfo['wpucd_path_define'], null, '1.0', 'all');
        }
	}

	public function wpucd_admin_menu_test(){
		if(current_user_can('manage_options')){
			add_submenu_page(
				'woocommerce',
				esc_html__('WooPick Up Custom Date', 'woopick-up-custom-date'),
				esc_html__('WooPick Up Custom Date', 'woopick-up-custom-date'),
				'manage_options',
				'get-woopick-up-custom-date',
				array($this, 'wpucd_plugin_submenu_about_plugin_page'),
                12
			);
		}
    add_action('admin_init', array($this, 'wpucd_admin_controls'));
	}
    public function wpucd_admin_controls() {
        include 'dashboard/controls.php';
    }

	public function wpucd_plugin_submenu_about_plugin_page() {
        include 'dashboard/dashboard-style.php';
    }
    
    public function wpucd_plugin_function_for_datas_callback() {}

    public function wpucd_plugin_settings_to_whitelist( $options ) {
      $options['wpucd-plugin-settings'] = array(
        'wpucd-notice-position',
        'wpucd-product-shipted',
        'wpucd-product-shipted',
        'wpucd-shipping-icon',
        'wpucd-shipimgsize-check',
        'wpucd-check-orderdatefrmt-taxo-widget',
        'wpucd-checkout-page-check',
        'wpucd-thankyou-page-check',
        'wpucd-orderdate-thankyou-page-check',
        'wpucd-send-date-email',
        // *** reason
        'wpucd-reason-color',
        'wpucd-reason-fontsize',
        'wpucd-reason-fontweight',
        'wpucd-reason-fontfamilly',
        // *** estimdate
        'wpucd-estimdate-color',
        'wpucd-estimdate-fontsize',
        'wpucd-estimdate-fontweight',
        'wpucd-estimdate-fontfamilly',
        // *** estimass
        'wpucd-estimass-color',
        'wpucd-estimass-fontsize',
        'wpucd-estimass-fontweight',
        'wpucd-estimass-fontfamilly',
      );
      return $options;
    }

    public function wpucd_taxoes_styles(){
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
        // *** estimass
        $wpucd_estimass_color_value = get_option( 'wpucd-estimass-color');
        $wpucd_estimass_fontsize_value = get_option( 'wpucd-estimass-fontsize');
        $wpucd_estimass_fontweight_value = get_option( 'wpucd-estimass-fontweight');
        $wpucd_estimass_fontfamilly_value = get_option( 'wpucd-estimass-fontfamilly');
        $wpucd_shipimgsize_value = get_option( 'wpucd-shipimgsize-check');//
        $html = "<style>
        .wpucd-select-date, .wpucd-thankyou-orddate{
            background-color:{$wpucd_reason_color_value};
            border-radius:{$wpucd_reason_fontsize_value};
            border-color:{$wpucd_reason_bdrcolor_value};
            border-width:{$wpucd_reason_bdrwidth_value}
            padding:{$wpucd_reason_fontweight_value};
        }
        .wpucd-select-date input, .wpucd-date---on{
            color:{$wpucd_estimdate_color_value};
            font-size:{$wpucd_estimdate_fontsize_value};
            font-weight:{$wpucd_estimdate_fontweight_value};
            font-family:{$wpucd_estimdate_fontfamilly_value};
        }
        .wpucd-select-date label, .wpucd-thankyou-orddate label{
            color:{$wpucd_estimass_color_value};
            font-size:{$wpucd_estimass_fontsize_value};
            font-weight:{$wpucd_estimass_fontweight_value};
            font-family:{$wpucd_estimass_fontfamilly_value};
        }
        .wpucd-select-date img, .wpucd-thankyou-orddate img{
            width:{$wpucd_shipimgsize_value};
        }
        ";
        $html .= '</style>';
        echo $html;
    }

    public function add_custom_content_to_order_number_column($columns) {
        $columns['order_number'] = esc_html__('Order Number', 'woopick-up-custom-date');
        return $columns;
    }
    
    public function display_custom_content_in_order_number_column($column, $post_id) {
        if ($column == 'order_number') {
            $order = wc_get_order($post_id);
            $selected_date = $order->get_meta('_selected_date', true);
            if (!empty($selected_date)) {
                echo '<span style="color:#ff3b00;">' . esc_html__('This order has to deliver on', 'woopick-up-custom-date') . '</span></br>';
                echo '<span style="color:#ff3b00;">' . esc_html($selected_date) . '</span></br>';
            }
        }
    }

    public function save_selected_date_to_order_meta( $order, $data ) {
        if ( isset( $_POST['selected_date'] ) ) {
            $order->update_meta_data( '_selected_date', sanitize_text_field( $_POST['selected_date'] ) );
        }
    }

    public function wpucd_thankyou_page($order_id) {
        if(get_option( 'wpucd-thankyou-page-check', 'on' )==true){
            $order = wc_get_order( $order_id );
            $selected_date = $order->get_meta( '_selected_date', true );
            if ( ! empty( $selected_date ) ) {
                echo (get_option( 'wpucd-notice-position', 'top')=='top')?'<div class="wpucd-thankyou-orddate"><img src="'.get_option( 'wpucd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/delivery-service.png').'" alt="img"></br><label>'.esc_html(get_option( 'wpucd-product-delivered', 'This order will be delivered on ')).'</label></br><div class="wpucd-date---on">' . esc_html( $selected_date ) . '</div></div>':'';
                echo (get_option( 'wpucd-notice-position')=='bottom')?'<div class="wpucd-thankyou-orddate"><img src="'.get_option( 'wpucd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/delivery-service.png').'" alt="img"><div class="wpucd-date---on">'.esc_html( $selected_date ).'</div></br><label>'.esc_html(get_option( 'wpucd-product-delivered', 'This order will be delivered on:')).'</label></div>':'';
            }
        }
    }

    public function wpucd_checkout_page($order_id) {
        echo '<div class="wpucd-select-date">';
            echo '<img src="'.get_option( 'wpucd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/delivery-service.png').'" alt="img">';
            echo (get_option( 'wpucd-notice-position', 'top')=='top')?'<label for="">' . esc_html(get_option( 'wpucd-product-shipted', 'Recommended order received date and time ')).'</br></label>':'';
            echo '<input type="text" name="selected_date" placeholder="'.date('d M Y h:i A').'" value="" />';
            echo (get_option( 'wpucd-notice-position')=='bottom')?'<label for="">' . esc_html(get_option( 'wpucd-product-shipted', 'Recommended order received date and time ')).'</br></label>':'';
        echo '</div>';
        $disabled_dates = get_option( 'wpucd-product-multidates', '2023-10-09');
        $disabled_weekdays = '';
        $disabled_weekdays .= get_option( 'wpucd-check-weekend0-widget', 0);
        $disabled_weekdays .= get_option( 'wpucd-check-weekend1-widget');
        $disabled_weekdays .= get_option( 'wpucd-check-weekend2-widget');
        $disabled_weekdays .= get_option( 'wpucd-check-weekend3-widget');
        $disabled_weekdays .= get_option( 'wpucd-check-weekend4-widget');
        $disabled_weekdays .= get_option( 'wpucd-check-weekend5-widget');
        $disabled_weekdays .= get_option( 'wpucd-check-weekend6-widget');
        ?>
        <script>
            var skdisabledDates = <?php echo json_encode($disabled_dates); ?>;
            var skdisabledWeekdays = <?php echo json_encode($disabled_weekdays); ?>;
            var skOrderDateFrmt = <?php echo json_encode(get_option( 'wpucd-check-orderdatefrmt-taxo-widget', 'DD MMM YYYY h:mm A' )); ?>;
        </script>
        <?php
    }

    public function include_order_notes_in_email( $order, $sent_to_admin, $plain_text ) {
        if(get_option( 'wpucd-send-date-email', 'on' )==true){
            $selected_date = $order->get_meta( '_selected_date', true );
            if ( ! empty( $selected_date ) ) {
                    echo (get_option( 'wpucd-notice-position', 'top')=='top')?'<div class="wpucd-thankyou-orddate" style="background-color:rgba(255,243,255,1); border-radius:4px; text-align:center; border:2px solid #ccc; padding:20px;"><img src="'.get_option( 'wpucd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/delivery-service.png').'" style="width:100px;" alt="img"><br><label style="font-weight:bold; color:black;">'.esc_html(get_option( 'wpucd-product-delivered', 'This order will be delivered on ')).'</label></br><div class="wpucd-date---on" style="color:black;">' . esc_html( $selected_date ) . '</div></div>':'';
                    echo (get_option( 'wpucd-notice-position')=='bottom')?'<div class="wpucd-thankyou-orddate" style="background-color:rgba(255,243,255,1); border-radius:4px; text-align:center; border:2px solid #ccc; padding:20px;"><img src="'.get_option( 'wpucd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/delivery-service.png').'" style="width:100px;" alt="img"><div class="wpucd-date---on" style="color:black;">'.esc_html( $selected_date ).'</div><br><label style="font-weight:bold; color:black;">'.esc_html(get_option( 'wpucd-product-delivered', 'This order will be delivered on:')).'</label></div>':'';
            }
		}
    }

	public function __construct() {
        add_action('woocommerce_checkout_create_order', [$this, 'save_selected_date_to_order_meta'], 10, 2);
        // It's for the admin order page
		add_filter('manage_edit-shop_order_columns', [$this,'add_custom_content_to_order_number_column']);
        add_action('manage_shop_order_posts_custom_column', [$this,'display_custom_content_in_order_number_column'], 10, 2);
        // Last Date 
        add_action('woocommerce_thankyou', [$this, 'wpucd_thankyou_page'], 10, 1 ); // Thank you page
        add_action('woocommerce_review_order_before_payment', [$this, 'wpucd_checkout_page']); // for Your order page
        // Plugins
		add_filter('whitelist_options', [$this,'wpucd_plugin_settings_to_whitelist']);
        add_action('admin_enqueue_scripts', [$this, 'wpucd_all_assets_for_the_admin']);
        add_action('wp_enqueue_scripts', [$this, 'wpucd_all_assets_for_the_public']);
		add_action('admin_menu', [$this,'wpucd_admin_menu_test']);
        add_action('wp_head', [$this, 'wpucd_taxoes_styles'],99);
        // Email
        add_filter('woocommerce_email_order_meta', [$this, 'include_order_notes_in_email'],10,3);
	}
}
ClassProdWPUCD::instance();

