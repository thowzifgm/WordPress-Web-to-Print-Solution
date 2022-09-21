<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$thumbnail_post    = get_post( $post_thumbnail_id );
$image_title       = $thumbnail_post->post_content;
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
'woocommerce-product-gallery',
'woocommerce-product-gallery--' . $placeholder,
'woocommerce-product-gallery--columns-' . absint( $columns ),
'images',
) );
$attachment_ids = $product->get_gallery_image_ids();
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
    <figure class="woocommerce-product-gallery__wrapper">
        <div class="featured-gallery owl-carousel">
             <?php
            $attributes = array(
                'title'                   => $image_title,
                'data-src'                => $full_size_image[0],
                'data-large_image'        => $full_size_image[0],
                'data-large_image_width'  => $full_size_image[1],
                'data-large_image_height' => $full_size_image[2],
                'data-zoom-image'               => $full_size_image[0],
            );

            if ( has_post_thumbnail() ) {
                $html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
                $html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
                $html .= '</div>';
            } else {
                $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'printshop' ) );
                $html .= '</div>';
            }

            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

//            do_action( 'woocommerce_product_thumbnails' );

            if ( $attachment_ids && has_post_thumbnail() ) {
                foreach ( $attachment_ids as $attachment_id ) {
                    $full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
                    $thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
                    $thumbnail_post   = get_post( $attachment_id );
                    $image_title      = $thumbnail_post->post_content;

                    $attributes = array(
                        'title'                   => $image_title,
                        'data-src'                => $full_size_image[0],
                        'data-large_image'        => $full_size_image[0],
                        'data-large_image_width'  => $full_size_image[1],
                        'data-large_image_height' => $full_size_image[2],
                        'data-zoom-image'               => $full_size_image[0],
                    );

                    $html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image">';
                    $html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
                    $html .= '</div>';

                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
                }
            }
            ?>            
        </div>
            <?php if($attachment_ids):?>
            <div class="thumb-gallery owl-carousel"'>
                <?php
                $attributes = array(
                    'title'                   => $image_title,
                    'data-src'                => $full_size_image[0],
                    'data-large_image'        => $full_size_image[0],
                    'data-large_image_width'  => $full_size_image[1],
                    'data-large_image_height' => $full_size_image[2],
                );

                if ( has_post_thumbnail() ) {
                    $html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
                    $html .= get_the_post_thumbnail( $post->ID, 'shop_thumbnail', $attributes );
                    $html .= '</div>';
                } else {
                    $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                    $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'printshop' ) );
                    $html .= '</div>';
                }

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

//                do_action( 'woocommerce_product_thumbnails' );

                $attachment_ids = $product->get_gallery_image_ids();

                if ( $attachment_ids && has_post_thumbnail() ) {
                    foreach ( $attachment_ids as $attachment_id ) {
                        $full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
                        $thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
                        $thumbnail_post   = get_post( $attachment_id );
                        $image_title      = $thumbnail_post->post_content;

                        $attributes = array(
                            'title'                   => $image_title,
                            'data-src'                => $full_size_image[0],
                            'data-large_image'        => $full_size_image[0],
                            'data-large_image_width'  => $full_size_image[1],
                            'data-large_image_height' => $full_size_image[2],
                        );

                        $html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image">';
                        $html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
                        $html .= '</div>';

                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
                    }
                }
                ?>
            </div>
        <?php endif;?>
    </figure>
</div>
