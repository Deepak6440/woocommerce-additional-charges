<?php 
/**
 * Plugin Name: Additional Charges on WC Checkout
 * Text Domain: additional-charges-on-wc-checkout
 * Author: Deepak Kumar Gupta
 * Author URI: https://www.dk-gupta.com
 * Description: Empower customers to include personalized fees in their order total with this plugin. Admins have full control over modifying fee descriptions and amounts from the backend.
 * Version: 1.0.0
 * Tested up to: 6.1.1
 * WC tested up to: 7.1.0
 * License: GPLv2 or later
 * 
 */

//Check if the WC plugin is install or not if its not installed then print the error messages

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
add_action( 'admin_init', 'acwc_additional_active_check' );
function acwc_additional_active_check() {
    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        add_action( 'admin_notices', 'acwc_active_failed_notice' );
        deactivate_plugins( plugin_basename( __FILE__ ) ); 
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }
}

function acwc_active_failed_notice(){
    ?><div class="error"><p>Please Activate <b>WooCommerce</b> Plugin, Before You Proceed To Activate <b>Additional Charges on WooCommerce Checkout</b> Plugin.</p></div><?php
}

define('ACWC', 'WC Additional Charges');
define( 'ACWC_BASE', plugin_basename( __FILE__ ) );
require 'inc/get-settings-admin-options.php';
require 'inc/apply-charge-options.php';
function acwc_additional_actions_links( $links ) {
    $custom_links = array(
        '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=products&section=additional_charges' ) . '">' . __( 'Settings') . '</a>',
        '<a href="https://www.dk-gupta.com/contact/">' . esc_html__( 'Support', 'additional-charges-on-wc-checkout' ) . '</a>',
    );

    return array_merge( $custom_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'acwc_additional_actions_links' );

?>