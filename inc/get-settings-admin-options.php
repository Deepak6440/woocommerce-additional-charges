<?php

class ACWC_SETTING_ADMIN_OPTIONS_FIELDS{

	public function __construct()
	{
		add_filter("woocommerce_get_sections_products", array($this, 'acwc_add_settings_tabs'));
		add_filter("woocommerce_get_settings_products", array($this, 'acwc_create_setting_fields'), 10, 2);
	}

	public function acwc_add_settings_tabs($setting_tab)
	{
	   $setting_tab['additional_charges'] = __("Additional Charges","additional-charges-on-wc-checkout");
	   return $setting_tab;
	}

	public function acwc_create_setting_fields($settings, $current_section)
	{
		$wc_ac_settings = array();
		if( 'additional_charges' == $current_section ) {
			$wc_ac_settings = array(
				array(
					'name' => __('WC Additional Charges','additional-charges-on-wc-checkout'),
					'type' => 'title',
					'desc' => '',
					'id' => 'wc_additional_fee_sections_title'
				),
				array(
					'name' => __('Enable WC Additional Charges','additional-charges-on-wc-checkout'),
					'type' => 'checkbox',
					'desc' => __('Check this if you want to enable the WC Additional Charges','additional-charges-on-wc-checkout'),
					'id'   =>'wc_enable_additional_charges_options'
				),			   
				array(
					'name' => __('Please Enter The Additional Charges Name','
						additional-charges-on-wc-checkout'),
					'type' => 'text',
					'desc' => __('This will be the title of fee which names shows on checkout page','additional-charges-on-wc-checkout'),
					'desc_tip' => true,
					'id'	=> 'wc_additional_fee_title'
				),
				array(
					'name' => __( 'Fixed Amount ( ' . get_woocommerce_currency_symbol() . ' )', 'additional-charges-on-wc-checkout' ),
					'type' => 'text',
					'desc' => __( 'This amount will be added to the order total when user places an order.', 'additional-charges-on-wc-checkout' ),
					'desc_tip' => true,
					'id'   => 'wc_additional_fee_amount'
				),
				array(
					'name' => __( 'Type of Fee', 'additional-charges-on-wc-checkout' ),
					'type' => 'select',
					'desc' => __( 'Whether this is a fixed amount fee or % of order total.', 'additional-charges-on-wc-checkout' ),
					'options' => array( 'Fixed Amount' => 'Fixed Amount', '% of Order Total' => '% of Order Total'),
					'desc_tip' => true,
					'id'   => 'wc_additional_fee_type'
				),
				array(
					'name' => __( 'Cart Amount (Optional)', 'additional-charges-on-wc-checkout' ),
					'type' => 'text',
					'desc' => __( 'cart amount, after which this fee will be added to order total. (Leave blank if you do not wish to use this feature.)', 'additional-charges-on-wc-checkout' ),
					'desc_tip' => true,
					'id'   => 'wc_additional_fee_minimum_cart_amount'
				),
				array(
                'name' => __( 'Apply fee when (optional)', 'additional-charges-on-wc-checkout' ),
                'type' => 'select',
                'desc' => __( 'Whether you want to apply fee if order amount is more than $XX or less than $XX. (Leave empty if you do not wish to use this.)', 'additional-charges-on-wc-checkout' ),
                'options' => array( 'Order is more than' => 'Order is more than', 'Order is less than' => 'Order is less than'),
                'id'   => 'wc_additional_fee_condition_type'
            	),
				array(
					'name' => __( 'Include Shipping Charge', 'additional-charges-on-wc-checkout' ),
					'type' => 'checkbox',
					'desc' => __( 'Include shipping charge in Order Total when "Type of Fee" is "% of Order Total".', 'additional-charges-on-wc-checkout' ),
					'id'   => 'wc_additional_fee_include_shipping_charge'
				),

				array( 'type' => 'sectionend', 'id' => 'additional_charges_fee_sections_end' ),
			);
			return $wc_ac_settings;
		} else {
			return $settings;
		}
	}

	
}

$adminSetting = new ACWC_SETTING_ADMIN_OPTIONS_FIELDS();

?>