<?php
if (!defined('ABSPATH')) exit;
if( $total > $limit ): 
    require_once NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.pagination.php';
    $paging = new Nbdesigner_Pagination();
    $config = array(
        'current_page'  => isset($page) ? $page : 1, 
        'total_record'  => $total,
        'limit'         => $limit,
        'link_full'     => add_query_arg(array('paged' => '{p}'), $url),
        'link_first'    => $url              
    );
    $paging->init($config); 
?>
<div class="tablenav top nbdesigner-pagination-con" id="nbd-pagination">
    <div class="tablenav-pages">
        <div>
            <span class="displaying-num"><?php printf( _n( '%s Template', '%s Templates', $total, 'printshop'), number_format_i18n( $total ) ); ?></span>
            <?php echo $paging->html();  ?>
        </div>
        <div class="spacer" style="clear: both;"></div>
    </div>
</div>  
<?php endif;