<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header(); ?>
<?php 
    do_action( 'nbd_before_designer_page_content' ); 
    $user_id = (isset($_GET['id']) && $_GET['id'] != '' ) ? intval( $_GET['id'] ) : 0;
    if($user_id == 0){
        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        get_template_part( 404 ); exit();
    }
    $user_infos = nbd_get_artist_info($user_id);
    $wp_user_infos = get_user_by('id', $user_id);
    $banner_url = wp_get_attachment_url( $user_infos['nbd_artist_banner'] );
    $current_user_id = get_current_user_id();
    $link_designer = add_query_arg(array('id' => $current_user_id), getUrlPageNBD('designer'));
    $user_infos['nbd_artist_name'] = $user_infos['nbd_artist_name'] != '' ? $user_infos['nbd_artist_name'] : $wp_user_infos->display_name;

?>

<div class="nbd-user-banner  <?php if($user_infos['nbd_artist_banner'] != ''):?> banner_img <?php endif; ?> <?php if(printshop_get_option('nbcore_template_designer_style')){ echo printshop_get_option('nbcore_template_designer_style'); } ?>" <?php if($user_infos['nbd_artist_banner'] != ''):?>style="border-radius: 0;background-image: url(<?php echo $banner_url;?>)<?php endif; ?>">
    <?php if( $current_user_id == $user_id ): ?>
    <a class="nbd-edit-profile" href="<?php echo wc_get_endpoint_url( 'artist-info', $user_id, wc_get_page_permalink( 'myaccount' ) ); ?>" title="<?php _e('Edit profile', 'printshop'); ?>">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <title>Edit profile</title>
            <path fill="#6d6d6d" d="M20.719 7.031l-1.828 1.828-3.75-3.75 1.828-1.828c0.375-0.375 1.031-0.375 1.406 0l2.344 2.344c0.375 0.375 0.375 1.031 0 1.406zM3 17.25l11.063-11.063 3.75 3.75-11.063 11.063h-3.75v-3.75z"></path>
        </svg>          
    </a>
    <?php endif;?>
    <?php if(printshop_get_option('nbcore_template_designer_style') == 'style3'){?>
        <div class="container">
            <div class="row">
                <div class="nbd-user-infos <?php if(printshop_get_option('nbcore_template_designer_style')){ echo printshop_get_option('nbcore_template_designer_style'); } ?>">
                    
                    <div class="nbd-user-info">
                        <img class="nbd-avatar" src="<?php echo get_avatar_url($user_id); ?>" />
                        <div class="nbd-designer-info">
                            <h1 class="nbd-artist-name"><?php echo $user_infos['nbd_artist_name']; ?></h1>
                            <div class="nbd-social-list">
                                <?php  if( $user_infos['nbd_artist_facebook'] != '' ): ?>
                                <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_facebook']; ?>" title="<?php _e('Facebook', 'printshop'); ?>">
                                <i class="icon-facebook"></i>
                                </a>    
                                <?php  endif; ?>
                                <?php  if( $user_infos['nbd_artist_google'] != '' ): ?>
                                <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_google']; ?>" title="<?php _e('Google', 'printshop'); ?>">
                                <i class="icon-gplus"></i> 
                                </a>    
                                <?php  endif; ?>       
                                <?php  if( $user_infos['nbd_artist_twitter'] != '' ): ?>
                                <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_twitter']; ?>" title="<?php _e('Twitter', 'printshop'); ?>">
                                <i class="icon-twitter"></i>             
                                </a>    
                                <?php  endif; ?>
                                <?php  if( $user_infos['nbd_artist_linkedin'] != '' ): ?>
                                <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_linkedin']; ?>" title="<?php _e('Linkedin', 'printshop'); ?>">
                                <i class="icon-linkedin"></i>
                                </a>    
                                <?php  endif; ?>  
                                <?php  if( $user_infos['nbd_artist_youtube'] != '' ): ?>
                                <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_youtube']; ?>" title="<?php _e('Linkedin', 'printshop'); ?>">
                                <i class="icon-youtube"></i>
                                </a>    
                                <?php  endif; ?>  
                                <?php  if( $user_infos['nbd_artist_instagram'] != '' ): ?>
                                <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_instagram']; ?>" title="<?php _e('Instagram', 'printshop'); ?>">
                                <i class="icon-instagram"></i>     
                                </a>    
                                <?php  endif; ?>         
                                <?php  if( $user_infos['nbd_artist_flickr'] != '' ): ?>
                                <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_flickr']; ?>" title="<?php _e('Flickr', 'printshop'); ?>">
                                    <i class="icon-social-normal"></i>    
                                </a>    
                                <?php  endif; ?>                   
                            </div>
                            <?php if( $user_infos['nbd_artist_address'] != '' ): ?>
                            <div class="nbd-artist-add">
                                <i class="icon-home"></i> 
                            <?php echo $user_infos['nbd_artist_address']; ?>
                            </div>
                            <?php endif; ?>
                            <?php if( $user_infos['nbd_artist_phone'] != '' ): ?>
                            <div class="nbd-artist-phone">
                                <i class="icon-phone"></i> 
                                <?php echo $user_infos['nbd_artist_phone']; ?>
                            </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    <div class="nbd-description">
                        <p><?php echo $user_infos['nbd_artist_description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>  
<div class="container">
    <div class="row">
        <div id="primary" class="content-area page-no-sidebar">
        <?php if(printshop_get_option('nbcore_template_designer_style') != 'style3'){?>
            
            <div class="nbd-user-infos <?php if(printshop_get_option('nbcore_template_designer_style')){ echo printshop_get_option('nbcore_template_designer_style'); } ?>">
                
                <div class="nbd-user-info">
                    <img class="nbd-avatar" src="<?php echo get_avatar_url($user_id); ?>" />
                    <div class="nbd-designer-info">
                        <h1 class="nbd-artist-name"><?php echo $user_infos['nbd_artist_name']; ?></h1>
                        <div class="nbd-social-list">
                            <?php  if( $user_infos['nbd_artist_facebook'] != '' ): ?>
                            <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_facebook']; ?>" title="<?php _e('Facebook', 'printshop'); ?>">
                            <i class="icon-facebook"></i>
                            </a>    
                            <?php  endif; ?>
                            <?php  if( $user_infos['nbd_artist_google'] != '' ): ?>
                            <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_google']; ?>" title="<?php _e('Google', 'printshop'); ?>">
                            <i class="icon-gplus"></i> 
                            </a>    
                            <?php  endif; ?>       
                            <?php  if( $user_infos['nbd_artist_twitter'] != '' ): ?>
                            <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_twitter']; ?>" title="<?php _e('Twitter', 'printshop'); ?>">
                            <i class="icon-twitter"></i>             
                            </a>    
                            <?php  endif; ?>
                            <?php  if( $user_infos['nbd_artist_linkedin'] != '' ): ?>
                            <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_linkedin']; ?>" title="<?php _e('Linkedin', 'printshop'); ?>">
                            <i class="icon-linkedin"></i>
                            </a>    
                            <?php  endif; ?>  
                            <?php  if( $user_infos['nbd_artist_instagram'] != '' ): ?>
                            <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_instagram']; ?>" title="<?php _e('Instagram', 'printshop'); ?>">
                            <i class="icon-instagram"></i>     
                            </a>    
                            <?php  endif; ?>         
                            <?php  if( $user_infos['nbd_artist_flickr'] != '' ): ?>
                            <a class="nbd-social" href="<?php echo $user_infos['nbd_artist_flickr']; ?>" title="<?php _e('Flickr', 'printshop'); ?>">
                                <i class="Defaults-flickr"></i>    
                            </a>    
                            <?php  endif; ?>                   
                        </div>
                        <?php if( $user_infos['nbd_artist_address'] != '' ): ?>
                        <div class="nbd-artist-add">
                            <i class="icon-home"></i> 
                           <?php echo $user_infos['nbd_artist_address']; ?>
                        </div>
                        <?php endif; ?>
                        <?php if( $user_infos['nbd_artist_phone'] != '' ): ?>
                        <div class="nbd-artist-phone">
                            <i class="icon-phone"></i> 
                            <?php echo $user_infos['nbd_artist_phone']; ?>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
                <div class="nbd-description">
                    <p><?php echo $user_infos['nbd_artist_description']; ?></p>
                </div>
            </div>

        <?php } ?>
           
        
<?php if( isset($_GET['template_id']) && $_GET['template_id'] != '' ): ?>
<?php    
    $template_id = $_GET['template_id'];
    $design = My_Design_Endpoint::get_template($user_id, $template_id);
    $product = wc_get_product( $design->variation_id ? $design->variation_id : $design->product_id );
    $path = NBDESIGNER_CUSTOMER_DIR .'/'.$design->folder. '/preview';
    $thumbnail = $design->thumbnail ? wp_get_attachment_url( $design->thumbnail ) : '';
    $list = Nbdesigner_IO::get_list_images($path, 1);
    $resources = (array)json_decode( file_get_contents( NBDESIGNER_CUSTOMER_DIR .'/'.$design->folder. '/design.json' ) );
    $fonts = (array)json_decode( file_get_contents( NBDESIGNER_DATA_DIR . '/fonts.json' ) );
    if( $thumbnail == '' ){  
        $thumbnail = Nbdesigner_IO::wp_convert_path_to_url(reset($list));
    }
    $link_create_template = add_query_arg(array(
        'product_id' => $design->product_id,
        'task'  =>  'create',
        'rd'    => urlencode($link_designer)
    ), getUrlPageNBD('create'));   
    $link_edit_template = add_query_arg(array(
        'product_id' => $design->product_id,
        'nbd_item_key'  =>  $design->folder,
        'rd'    => urlencode($link_designer.'&template_id='.$template_id),
        'design_type'  =>  'template',
        'task'  =>  'edit'
    ), getUrlPageNBD('create')); 
    $product_name = $product->get_title();
    wp_enqueue_media();
?>
<div class="nbd-edit-tem-wraper">
    <div class="nbd-edit-tem-wrap">
        <div>
            <?php wp_nonce_field( 'nbd_edit_template_nonce' ); ?>
            <input value="<?php echo $design->id; ?>" name="id" id="name" type="hidden"/>
            <input value="<?php echo $user_id; ?>" name="user_id" id="user_id" type="hidden"/>
            <p class="nbd-template-title">
                <a class="nbd-back-to-gallery" href="<?php echo $link_designer; ?>" title="<?php _e('Back to list', 'printshop'); ?>">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <title>back</title>
                        <path fill="#6d6d6d" d="M21 11.016v1.969h-14.156l3.563 3.609-1.406 1.406-6-6 6-6 1.406 1.406-3.563 3.609h14.156z"></path>
                    </svg>
                </a>&nbsp;&nbsp;&nbsp;<b style="vertical-align: middle;">
                    <?php $title = $current_user_id == $user_id ? __('Edit template for', 'printshop') : __('Template for', 'printshop'); ?>
                    <?php echo $title; ?> </b>
                <a class="nbd-product-template-title" href="<?php echo get_permalink( $product->get_id() ); ?>"><?php echo $product_name; ?></a>
                <span class="statistic">
                <span class="nbd-vote-count" title="<?php _e('Vote', 'printshop'); ?>" >
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <title>favorite</title>
                        <path fill="#6d6d6d" d="M12 21.328l-1.453-1.313c-5.156-4.688-8.531-7.734-8.531-11.531 0-3.094 2.391-5.484 5.484-5.484 1.734 0 3.422 0.844 4.5 2.109 1.078-1.266 2.766-2.109 4.5-2.109 3.094 0 5.484 2.391 5.484 5.484 0 3.797-3.375 6.891-8.531 11.578z"></path>
                    </svg>                    
                </span>&nbsp;&nbsp;<?php echo $design->vote ? $design->vote : '0';  ?>&nbsp;&nbsp;&nbsp;
                <span class="nbd-vote-count" title="<?php _e('View', 'printshop'); ?>" >
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <title>view</title>
                        <path fill="#6d6d6d" d="M3.516 18.469l-1.5-1.5 7.5-7.5 3.984 4.031 7.078-7.969 1.406 1.406-8.484 9.563-3.984-4.031z"></path>
                    </svg>
                </span>&nbsp;&nbsp;<?php echo $design->hit ? $design->hit : '0';  ?></span>
            </p>
        </div>
        <div class="nbd-template-form">
            <p class="nbd-form-title">
                <label for="name"><?php _e('Name', 'printshop'); ?></label>
                <input value="<?php echo $design->name; ?>" name="name" id="name" placeholder="<?php echo $product_name; ?>" <?php  if( $current_user_id !=  $user_id ) echo 'disabled'; ?> />
            </p>
            <?php  if( $current_user_id ==  $user_id ): ?>
            <p class="nbd-form-title"><?php _e('Thumbnail', 'printshop'); ?></p>
            <div class="nbd-thumbnail">
                <div class="image-wrap<?php echo $design->thumbnail ? '' : ' nbd-hide'; ?>">
                    <input type="hidden" class="nbd-file-field" value="<?php echo $design->thumbnail; ?>" name="thumbnail">
                    <img class="nbd-thumbnail-img" src="<?php echo $thumbnail; ?>" alt="<?php echo $design->name; ?>" />
                    <a class="close nbd-remove-banner-image">&times;</a>
                </div>
                <div class="button-area<?php echo $design->thumbnail ? ' nbd-hide' : ''; ?>">
                    <a href="#" class="nbd-thumbnail-drag"><?php _e( 'Upload thumbnail', 'printshop' ); ?></a>
                    <p class="description"><?php _e( 'Upload a thumbnail image to show in template page. If omit thumbnail image, use a preview design by default.', 'printshop' ); ?></p>
                </div>  
            </div>    
            <?php endif; ?>
            <p class="nbd-form-title" style="margin-top: 15px;"><?php _e('Preview', 'printshop'); ?></p>
            <div>
                <?php 
                    foreach ( $list as $image ): 
                    $image_url =  Nbdesigner_IO::wp_convert_path_to_url($image);   
                ?>
                <div class="nbd-preview-wrap">
                    <img class="nbd-preview" src="<?php echo $image_url; ?>" alt="<?php echo $design->name; ?>" />
                </div>
                <?php endforeach; ?>
            </div>
            <p class="nbd-form-title" style="margin-top: 15px;"><?php _e('Resource used in this template', 'printshop'); ?></p>
            <div>
                <div>
                <?php foreach( $resources as $resource ): ?>
                    <?php 
                        foreach( $resource->objects as $layer ): 
                        if( $layer->type == 'image' || $layer->type == 'custom-image' ){   
                            $src = $layer->type == 'image' ? $layer->src : $layer->origin_src;
                    ?>
                    <div class="image-resource">
                        <div><a href="<?php echo $src; ?>" download><img src="<?php echo $src; ?>" /></a></div>   
                        <div class="image-resource-hover-wrap">
                            <div class="image-resource-hover">
                                <a class="image-resource-action" href="<?php echo $src; ?>" download title="<?php _e('Download', 'printshop'); ?>">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <title>downward</title>
                                        <path fill="#6d6d6d" d="M20.016 12l-8.016 8.016-8.016-8.016 1.453-1.406 5.578 5.578v-12.188h1.969v12.188l5.625-5.578z"></path>
                                    </svg>                             
                                </a>
                                <a class="image-resource-action" href="javascript:void(0)" data-href="<?php echo $src; ?>" onclick="NBDEditTemplate.copyUrl( this )" title="<?php _e('Copy Url', 'printshop'); ?>">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <title>link</title>
                                        <path fill="#6d6d6d" d="M17.016 6.984c2.766 0 4.969 2.25 4.969 5.016s-2.203 5.016-4.969 5.016h-4.031v-1.922h4.031c1.688 0 3.094-1.406 3.094-3.094s-1.406-3.094-3.094-3.094h-4.031v-1.922h4.031zM8.016 12.984v-1.969h7.969v1.969h-7.969zM3.891 12c0 1.688 1.406 3.094 3.094 3.094h4.031v1.922h-4.031c-2.766 0-4.969-2.25-4.969-5.016s2.203-5.016 4.969-5.016h4.031v1.922h-4.031c-1.688 0-3.094 1.406-3.094 3.094z"></path>
                                    </svg>                             
                                </a>
                            </div>    
                        </div>
                    </div>
                    <?php } endforeach; ?>
                <?php endforeach; ?>
                </div>
                <div class="nbd-tabbe-wrap">
                    <table class="nbd-resource-text">
                        <thead>
                            <tr>
                                <th>Content</th>
                                <th>Color</th>
                                <th>Font</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach( $resources as $resource ): ?>
                            <?php 
                                foreach( $resource->objects as $layer ): 
                                if( $layer->type == 'text' || $layer->type == 'i-text' || $layer->type == 'curvedText' ){ 
                                    $alias = $fontname = $layer->fontFamily;
                                    $fonturl = 'https://fonts.google.com/specimen/'.$fontname;
                                    $is_google_font = true;
                                    foreach ( $fonts as $font ){
                                        if( $font->alias == $fontname ) {
                                            $fontname = $font->name;
                                            $fonturl = ( strpos($font->url, 'http') !== false ) ? $font->url : NBDESIGNER_FONT_URL . $font->url;
                                            $is_google_font = false;
                                            break;
                                        }
                                    }
                            ?>
                            <tr>
                                <style type='text/css'>
                                    <?php if( !$is_google_font ): ?>
                                    @font-face {font-family: <?php echo $alias; ?>;src: local('☺'), url('<?php echo $fonturl; ?>')}
                                    <?php else: ?>
                                    @import url(https://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $alias) ?>);
                                    <?php endif; ?>
                                </style>                                   
                                <td style="font-family: <?php echo $alias; ?>;"><?php echo $layer->text; ?></td>
                                <td>
                                    <span class="nbd-color-wrap"><span class="nbd-color" style="background: <?php echo $layer->fill; ?>"></span><span class="nbd-color-value"><?php echo $layer->fill; ?></span></span>
                                </td>
                                <td><a href="<?php echo $fonturl; ?>" <?php if( $is_google_font ) echo 'target="_blank"'; else echo 'download'; ?> title="<?php _e('Download', 'printshop'); ?>"><?php echo $fontname; ?></a></td>
                            </tr>
                            <?php } endforeach; ?>
                        <?php endforeach; ?> 
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>
        <?php  if( $current_user_id ==  $user_id ): ?>
        <div class="nbd-template-action-wrap">
            <a class="nbd-template-action-btn update" href="javascript:void(0)" onclick="NBDEditTemplate.updateTemplate()"><?php _e('Update info', 'printshop'); ?></a>
            <a class="nbd-template-action-btn" href="<?php echo $link_edit_template; ?>"><?php _e('Edit template', 'printshop'); ?></a>
            <a class="nbd-template-action-btn" href="<?php echo $link_create_template; ?>"><?php _e('Add template', 'printshop'); ?></a>
            <a class="nbd-template-action-btn warning" href="javascript:void(0)" onclick="NBDEditTemplate.deleteTemplate()"><?php _e('Delete template', 'printshop'); ?></a>
        </div> 
        <?php endif; ?>
    </div>
</div>        
<?php else: ?>
    <div class="nbd-list-designer-template" id="nbd-list-designer-template">
        <?php if( $current_user_id == $user_id ): ?>
        <span onclick="showPopupCreateTemplate()" class="nbd-add-template-btn">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <title>Add template</title>
                <path fill="#fff" d="M8 7v2h6v-2h-6zM8 11h9v-1h-9v1zM17 12h-8v1h8v-1zM17 15v-1h-7v1h7zM8 14h-3v3h-3v3h3v3h3v-3h3v-3h-3v-3zM4 2v10h2v-8h13v17h-6.643l-1 2h9.643v-21h-17z"></path>
            </svg>            
        </span>  
        <?php endif; ?>
    <?php 
        $row = apply_filters('nbd_artist_designs_row', 5);
        $per_row = intval( apply_filters('nbd_artist_designs_per_row', 4) );
        $des = '';
        $pagination = true;
        $url = add_query_arg(array('id' => $user_id), getUrlPageNBD('designer'));
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1; 
        $templates = My_Design_Endpoint::nbdesigner_get_templates_by_page($page, $row, $per_row, false, false, $user_id);
        $favourite_templates = My_Design_Endpoint::get_favourite_templates();
        $total = My_Design_Endpoint::count_total_template( false, $user_id );     
        $limit = $row * $per_row;
        $current_user_id = get_current_user_id();           
        $column = absint( get_option( 'nbdesigner_artist_gallery_column', 4 ) );
    ?>
        <div id="nbdesigner-gallery" class="<?php echo 'nbd-gallery-column-' . $column;?>">
            <?php include_once('gallery-item.php'); ?>
        </div> 
        <div>
            <div class="nbd-load-more" id="nbd-load-more"></div>
            <div id="nbd-pagination-wrap" >
                <?php if($pagination) include_once('pagination.php'); ?> 
            </div>  
            <?php include_once('popup-wrap.php'); ?> 
        </div>
    </div>    
<?php endif; ?>
        </div>
    </div>
</div>
<script>
    var is_nbd_gallery = 0;
    var redirect_url = "<?php  echo  $link_designer;  ?>";
    var NBDEditTemplate = {
        init: function() {
            jQuery('a.nbd-thumbnail-drag').on('click', this.imageUpload);
            jQuery('a.nbd-remove-banner-image').on('click', this.removeBanner);
        },
        imageUpload: function(e) {
            e.preventDefault();

            var file_frame,
                self = jQuery(this);
            if ( file_frame ) {
                file_frame.open();
                return;
            }
            file_frame = wp.media.frames.file_frame = wp.media({
                title: jQuery( this ).data( 'uploader_title' ),
                button: {
                    text: jQuery( this ).data( 'uploader_button_text' )
                },
                multiple: false
            });
            file_frame.on( 'select', function() {
                var attachment = file_frame.state().get('selection').first().toJSON();

                var wrap = self.closest('.nbd-thumbnail');
                wrap.find('input.nbd-file-field').val(attachment.id);
                wrap.find('img.nbd-thumbnail-img').attr('src', attachment.url);
                jQuery('.image-wrap', wrap).removeClass('nbd-hide');

                jQuery('.button-area').addClass('nbd-hide');
            });
            file_frame.open();
        },
        removeBanner: function(e) {
            e.preventDefault();
            var self = $(this);
            var wrap = self.closest('.image-wrap');
            var instruction = wrap.siblings('.button-area');
            wrap.find('input.nbd-file-field').val('0');
            wrap.addClass('nbd-hide');
            instruction.removeClass('nbd-hide');
        },
        updateTemplate: function(){
            jQuery('.nbd-edit-tem-wraper').addClass( 'processing' ).block( {
                message: null,
                overlayCSS: {
                    background: '#fff',
                    opacity: 0.6
                }
            } );            
            var formdata =  jQuery('.nbd-edit-tem-wraper').find('input, select').serialize();
            formdata = formdata + '&action=nbd_update_my_template';
            jQuery.ajax({
                url: nbds_frontend.url,
                method: "POST",
                data: formdata           
            }).done(function(data){
                if( data.flag == 1 ){
                    alert('Success!');
                }
                jQuery('.nbd-edit-tem-wraper').removeClass( 'processing' ).unblock();
            });  
        },
        deleteTemplate: function(){
            jQuery('.nbd-edit-tem-wraper').addClass( 'processing' ).block( {
                message: null,
                overlayCSS: {
                    background: '#fff',
                    opacity: 0.6
                }
            } ); 
            var formdata =  jQuery('.nbd-edit-tem-wraper').find('input, select').serialize();
            formdata = formdata + '&action=nbd_delete_my_template';
            jQuery.ajax({
                url: nbds_frontend.url,
                method: "POST",
                data: formdata           
            }).done(function(data){
                if( data.flag == 1 ){
                    window.location = redirect_url;
                }
                jQuery('.nbd-edit-tem-wraper').removeClass( 'processing' ).unblock();
            });            
        },
        copyUrl: function( e ){
            var url = jQuery(e).attr('data-href');
            var $temp = jQuery("<input>");
            jQuery("body").append($temp);
            $temp.val( url ).select();
            document.execCommand("copy");
            $temp.remove();           
        }
    };
    NBDEditTemplate.init();
</script>
<?php 
    do_action( 'nbd_after_designer_page_content' ); 
    get_footer();