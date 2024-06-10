<?php
    global $product;
    $args_sale = array(
        'posts_per_page'    => -1,
        'post_status'       => 'publish',
        'post_type'         => 'post'
    );
    
    //get products on sale using wp_query class
    $products_sale = new WP_Query( $args_sale );
?>
<div class="post-container">
    <div class="post__wrap-post">
        <?php while($products_sale->have_posts()) : $products_sale->the_post(); ?>
            <?php
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
            ?>
            <div>
                <div class="post__wrap-sale" style="background-image: url('<?php echo $image[0]; ?>');">
                    <div class="post-content">
                        <?php
                        $content = substr(get_the_content(), 0, 250) . '...';
                        ?>
                        <div class="post-description">
                            <div class="desctiption__wrap">
                                <div class="description__wrap-title">
                                    <h2><?php echo get_the_title(); ?></h2>
                                </div>
                            </div>
                            <p><?php echo $content; ?></p>
                            <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="learn-more">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
        endwhile; 
        wp_reset_postdata();
        ?>
    </div>
</div>