<?php
/**
 * Music Blog Hero Home two
 */

?>
<section id="hero-section" class="<?php (get_theme_mod('select_post_types') == "post") ? "banner-section":"";?>">
<?php
    if(get_theme_mod('select_post_types') == "post"){
        get_template_part( 'template-parts/banner/banner', 'post');
    }
?>
<?php
    if(get_theme_mod('select_post_types') == "products"){
    ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        get_template_part( 'template-parts/banner/banner', 'products');
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
?>
</section>
