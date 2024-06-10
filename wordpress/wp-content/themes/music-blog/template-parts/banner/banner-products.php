<?php
if ( class_exists('woocommerce') ) {
    global $product;
    $args_sale = array(
        'posts_per_page'    => 1,
        'post_status'       => 'publish',
        'post_type'         => 'product',
        'meta_query'        => WC()->query->get_meta_query(),
        'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
    );

    $args_latest = array(
        'posts_per_page'    => 2,
        'post_status'       => 'publish',
        'post_type'         => 'product',
        'orderby'           => array(
                                'date' =>'ASC'
                            )
    );
    
    //get products on sale using wp_query class
    $products_sale = new WP_Query( $args_sale );
    $products_latest = new WP_Query( $args_latest );
?>
<div class="post-container">
    <div class="post__wrap">
            <?php if($products_sale->have_posts()) : ?>
                <?php while($products_sale->have_posts()) : $products_sale->the_post(); ?>
                    <?php
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
                    ?>
                    <div class="post__wrap-sale" style="background-image: url('<?php echo $image[0]; ?>');">
                        <div class="on-sale">
                            <?php
                                $percentage = round( ( ( get_post_meta( get_the_ID(), '_regular_price', true ) - get_post_meta( get_the_ID(), '_sale_price', true ) ) / get_post_meta( get_the_ID(), '_regular_price', true ) ) * 100 );
                            ?>
                            <h3><?php echo $percentage; ?>%<span>off</span></h3>
                        </div>

                        <div class="post-content">
                            <?php
                            $content = substr(get_the_content(), 0, 250) . '...';
                            ?>
                            <div class="post-description">
                                <div class="desctiption__wrap">
                                    <div class="description__wrap-title">
                                        <h2><?php echo get_the_title(); ?></h2>
                                        <div class="price">
                                            <span><?php echo get_woocommerce_currency_symbol() . get_post_meta( get_the_ID(), '_sale_price', true ); ?>.00</span>
                                            <span><?php echo get_woocommerce_currency_symbol() . get_post_meta( get_the_ID(), '_regular_price', true ); ?>.00</span>
                                        </div>
                                    </div>
                                    <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="learn-more">Shop now</a>
                                </div>
                                <p><?php echo $content; ?></p>
                            </div>
                        </div>
                    </div>
                <?php 
                endwhile; 
                wp_reset_postdata();
                ?>
                
            <?php else : ?>
                <p> Sorry!No products on sale</p>
            <?php endif; ?>
        <div class="post__wrap-latest">
            <?php while($products_latest->have_posts()) : $products_latest->the_post(); ?>
                    <?php
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
                    ?>
                    <div class="post__wrap-col" style="background-image: url('<?php echo $image[0]; ?>');">
                        <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="learn-more btn-shop-now">Shop now</a>
                    </div>
                <?php 
            endwhile; 
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <div class="post__wrap-arrivals">
        <div class="post__wrap-arrivals-col">
        </div>
        <div class="post__wrap-arrivals-col">
        </div>
    </div>
</div>
<?php
}else{
    ?>
        <h2><?php _e("Woocommerce plugin required...", 'music-blog'); ?></h2>
    <?php
}
?>