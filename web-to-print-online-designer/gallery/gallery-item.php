<?php if (!defined('ABSPATH')) exit; 
if(count($templates)):  ?>
<?php
    $UrlPageNBD = getUrlPageNBD('create');
    foreach ($templates as $key => $temp): 
    $link_template = add_query_arg(array(
        'product_id' => $temp['product_id'],
        'variation_id' => $temp['variation_id'],
        'reference'  =>  $temp['folder']
    ), $UrlPageNBD);       
    $gallery_type = 1;
?>
    <div class="nbdesigner-item" data-id="<?php echo $temp['tid']; ?>" data-img="<?php echo $temp['image']; ?>" data-title="<?php echo $temp['title']; ?>">
        <div class="nbd-gallery-item">
            <div class="nbd-gallery-item-inner">
                <a href="<?php echo $link_template; ?>" onclick="previewTempalte(event, <?php echo $temp['tid']; ?>)">
                    <img src="<?php echo $temp['image']; ?>" class="nbdesigner-img"/>
                </a>
            </div>
            <div class="nbd-gallery-item-acction">
                <span class="nbd-gallery-item-name"><?php echo $temp['title']; ?></span>
                <div class="nbd-like-icons">
                    <span class="nbd-like-icon like <?php if(in_array($temp['tid'], $favourite_templates)) echo 'active'; ?>" onclick="updateFavouriteTemplate(this, 'unlike', <?php echo $temp['tid']; ?>)">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                            <title>Vote</title>
                            <path fill="#db133b" d="M17.19 4.155c-1.672-1.534-4.383-1.534-6.055 0l-1.135 1.042-1.136-1.042c-1.672-1.534-4.382-1.534-6.054 0-1.881 1.727-1.881 4.52 0 6.246l7.19 6.599 7.19-6.599c1.88-1.726 1.88-4.52 0-6.246z"></path>
                        </svg>                        
                    </span>
                    <span class="nbd-like-icon unlike <?php if(!in_array($temp['tid'], $favourite_templates)) echo 'active'; ?>" onclick="updateFavouriteTemplate(this, 'like', <?php echo $temp['tid']; ?>)">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                            <title>Voted</title>
                            <path fill="#db133b" d="M17.19 4.156c-1.672-1.535-4.383-1.535-6.055 0l-1.135 1.041-1.136-1.041c-1.672-1.535-4.382-1.535-6.054 0-1.881 1.726-1.881 4.519 0 6.245l7.19 6.599 7.19-6.599c1.88-1.726 1.88-4.52 0-6.245zM16.124 9.375l-6.124 5.715-6.125-5.715c-0.617-0.567-0.856-1.307-0.856-2.094s0.138-1.433 0.756-1.999c0.545-0.501 1.278-0.777 2.063-0.777s1.517 0.476 2.062 0.978l2.1 1.825 2.099-1.826c0.546-0.502 1.278-0.978 2.063-0.978s1.518 0.276 2.063 0.777c0.618 0.566 0.755 1.212 0.755 1.999s-0.238 1.528-0.856 2.095z"></path>
                        </svg>                       
                    </span>
                    <span class="nbd-like-icon loading">
                        <img src="<?php echo NBDESIGNER_PLUGIN_URL.'assets/images/loading.gif' ?>" />
                    </span>
                </div>
            </div>
            <?php 
                if( $temp['user_id'] == $current_user_id ): 
                $link_edit_design = add_query_arg(array('id' => $temp['user_id'], 'template_id' => $temp['tid']), getUrlPageNBD('designer'));
            ?>
            <a class="nbd-edit-template" href="<?php echo $link_edit_design; ?>" title="<?php _e('Edit template', 'printshop'); ?>">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 12 14">
                    <title>Edit template</title>
                    <path fill="#757575" d="M2.836 12l0.711-0.711-1.836-1.836-0.711 0.711v0.836h1v1h0.836zM6.922 4.75c0-0.102-0.070-0.172-0.172-0.172-0.047 0-0.094 0.016-0.133 0.055l-4.234 4.234c-0.039 0.039-0.055 0.086-0.055 0.133 0 0.102 0.070 0.172 0.172 0.172 0.047 0 0.094-0.016 0.133-0.055l4.234-4.234c0.039-0.039 0.055-0.086 0.055-0.133zM6.5 3.25l3.25 3.25-6.5 6.5h-3.25v-3.25zM11.836 4c0 0.266-0.109 0.523-0.289 0.703l-1.297 1.297-3.25-3.25 1.297-1.289c0.18-0.187 0.438-0.297 0.703-0.297s0.523 0.109 0.711 0.297l1.836 1.828c0.18 0.187 0.289 0.445 0.289 0.711z"></path>
                </svg>            
            </a>    
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach;
    else: ?>    
    <?php //todo something ?>
<?php endif;