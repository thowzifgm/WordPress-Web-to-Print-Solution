<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
global $post;
$product = wc_get_product( $post->ID );
$attachment_ids = $product->get_gallery_image_ids();

while ( have_posts() ) : the_post(); ?>

    <div id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>
        <div class="quickview-wrap">
            <div class="quick-view-swiper-container swiper-container">
                <div class="swiper-wrapper">
                <?php
                if ( has_post_thumbnail() ) {
                    $html  = '<div class="swiper-slide"><div>';
                    $html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
                    $html .= '</div></div>';
                }

                echo $html;

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

                        $html  = '<div class="swiper-slide"><div>';
                        $html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
                        $html .= '</div></div>';

                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
                    }
                }

                echo $html;
                ?>
                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>    
        </div>    

		<div class="summary entry-summary">
			<div class="summary-content">
				<?php do_action( 'yith_wcqv_product_summary' ); ?>
			</div>
		</div>

	</div>
    <script>
    var swiper = new Swiper('.quick-view-swiper-container', {
      pagination: {
        el: '.swiper-pagination',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    </script>

<?php endwhile; // end of the loop.