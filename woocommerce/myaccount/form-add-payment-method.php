<?php
/**
 * Add payment method form form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-add-payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.3.0
 */

defined( 'ABSPATH' ) || exit;

?>
<form id="add_payment_method" method="post">
	<div id="payment">
		<ul class="payment_methods methods">
			<?php
				if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) {
					// Chosen Method
					if ( sizeof( $available_gateways ) )
						current( $available_gateways )->set_current();

					foreach ( $available_gateways as $gateway ) {
						?>
						<li class="payment_method_<?php echo sanitize_html_class($gateway->id); ?>">
							<input id="payment_method_<?php echo sanitize_html_class($gateway->id); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> />
							<label for="payment_method_<?php echo sanitize_html_class($gateway->id); ?>"><?php printf("%s", $gateway->get_title()); ?> <?php printf("%s", $gateway->get_icon()); ?></label>
							<?php
								if ( $gateway->has_fields() || $gateway->get_description() ) {
									echo '<div class="payment_box payment_method_' . $gateway->id . '" style="display:none;">';
									$gateway->payment_fields();
									echo '</div>';
								}
							?>
						</li>
						<?php
					}
				} else {

					echo '<p>' . esc_html__( 'Sorry, it seems that there are no payment methods which support adding a new payment method. Please contact us if you require assistance or wish to make alternate arrangements.', 'printshop' ) . '</p>';

				}
			?>
		</ul>
		
		<?php do_action( 'woocommerce_add_payment_method_before_save' ); ?>
		
		<div class="form-row">
			<?php wp_nonce_field( 'woocommerce-add-payment-method' ); ?>
			<input type="submit" class="button alt" id="place_order" value="<?php esc_attr_e( 'Add Payment Method', 'printshop' ); ?>" />
			<input type="hidden" name="woocommerce_add_payment_method" value="1" />
		</div>

	</div>

</form>
