<?php
if (!defined('ABSPATH')) exit;
$product_id = $product->get_id();
$product_id = get_wpml_original_id($product_id);

$url =  add_query_arg(array(
    'product_id'    =>  $product_id
),  getUrlPageNBD('create'));

echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s %s"><span class="tooltip">%s</span></a>',
    $url,
    esc_attr( isset( $quantity ) ? $quantity : 1 ),
    esc_attr( $product->get_id() ),
    esc_attr( $product->get_sku() ),
    esc_attr( isset( $class ) ? $class : 'button' ),
    nbdesigner_get_option('nbdesigner_class_design_button_catalog'),
    esc_html( $label )
);
