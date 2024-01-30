<?php 
class ACWC_APPLY_CHARGE_OPTIONS{
	public function __construct()
	{
		add_action("woocommerce_cart_calculate_fees", array($this, 'acwc_apply_charges_fee'));
	}

	public function acwc_apply_charges_fee() 
	{
       if (get_option('wc_enable_additional_charges_options') == 'yes') {
        $fee_label = get_option('wc_additional_fee_title');
        $fee_amount = get_option('wc_additional_fee_amount');
        
        // Get cart total
        $arrCart = WC()->cart->get_totals();
        $cartVal = $arrCart['subtotal'];
        
        // Get shipping total
        $shippingTotal = WC()->cart->get_shipping_total();
        
        $mincartVal = get_option('wc_additional_fee_minimum_cart_amount');
        $conditionType = get_option('wc_additional_fee_condition_type');
        
        if (
            isset($mincartVal) && !empty($mincartVal) &&
            (($conditionType == 'Order is more than' && $mincartVal > $cartVal) ||
             ($conditionType == 'Order is less than' && $mincartVal < $cartVal))
        ) {
            return;
        }

        if (get_option('wc_additional_fee_include_shipping_charge') !== 'yes') {
            $shippingTotal = 0;
        }

        if (get_option('wc_additional_fee_type') == 'Fixed Amount') {
            $calculatedTotalFees = $cartVal + $shippingTotal + $fee_amount;
        } else {
            $calculatedTotalFees = $cartVal + $shippingTotal * ($fee_amount / 100);
        }

        WC()->cart->add_fee(sprintf(__('%s', 'additional-charges-on-wc-checkout'), esc_html($fee_label)), $calculatedTotalFees);
    }
}

}

$chargeOptions = new ACWC_APPLY_CHARGE_OPTIONS();
?>