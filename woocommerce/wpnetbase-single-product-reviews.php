<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $review_stats;
global $product;

?>
<div id="reviews_summary">
    <h3><?php _e('Customers\' review', 'printshop') ?></h3>

    <div class="reviews_bar">

        <?php for ($i = 5; $i >= 1; $i--) :
            $perc = ($review_stats['total'] == '0') ? 0 : floor($review_stats[$i] / $review_stats['total'] * 100);
            ?>

            <div class="wpnetbase_review_row">
                <span class="wpnetbase_stars_value"><?php printf(_n('%s star', '%s stars', $i, 'printshop'), $i); ?></span>
                <span class="wpnetbase_num_reviews"><?php echo $review_stats[$i]; ?></span>
				<span class="wpnetbase_rating_bar">
					<span style="background-color:#f4f4f4" class="wpnetbase_scala_rating">
						<span class="wpnetbase_perc_rating" style="<?php echo 'width:'.$perc.'% ;'; ?>">							
                                <span style="color:#666666" class="wpnetbase_perc_value">
                                <?php printf('%s %%', $perc); ?>                                    
                                </span>
                            
						</span>
					</span>
				</span>                
            </div>
        <?php endfor; ?>
    </div>
    
</div>