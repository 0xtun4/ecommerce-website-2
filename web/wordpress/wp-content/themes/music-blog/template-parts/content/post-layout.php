<?php

$get_post_column_layout = get_theme_mod( 'post_column', 'grid' );
$post_column_layout = 'col-sm-12 col-md-6 col-lg-4';
if ( $get_post_column_layout == 2 ) {
	$post_column_layout = 'col-lg-6 col-md-12';
} elseif ( $get_post_column_layout == 3 ) {
	$post_column_layout = 'col-sm-12 col-md-6 col-lg-4';
} elseif ( $get_post_column_layout == 4 ) {
	$post_column_layout = 'col-sm-12 col-md-6 col-lg-3';
}else{
	$post_column_layout = 'col-sm-12 grid';
}
$post_classes = 'music-blog-standard-post';
if ( ! has_post_thumbnail() ) {
	$post_classes = 'music-blog-standard-post no-post-thumbnail ';
}

$post_el_is_on = array(
	'show_post_category' => get_theme_mod('show_post_category', true),
	'show_post_thumbnail' => get_theme_mod('show_post_thumbnail', true),
	'show_post_date' => get_theme_mod('show_post_date', true),
	'show_post_author' => get_theme_mod('show_post_author', true),
	'show_post_title' => get_theme_mod('show_post_title', true),
	'show_post_excerpt' => get_theme_mod('show_post_excerpt', true),
);
?>
<div class="<?php echo esc_attr( $post_column_layout ); ?> blog-grid-layout">
	<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
		<div class="music-blog-standard-post__entry-content text-left">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="music-blog-standard-post__thumbnail post-header">
					<?php
					if (true == $post_el_is_on['show_post_thumbnail']) :
						music_blog_post_thumbnail();
					endif;
					?>
					<div class="date-label">
						<div class="current-month">
							<?php echo get_the_date( 'M', get_the_ID() ); ?>
						</div>
						<div class="current-date">
							<?php echo get_the_date('j'); ?>
						</div>
					</div>
				</div>
			<?php endif;?>
			<div class="music-blog-standard-post__content-wrapper">
				<div class="music-blog-standard-post__post-title">
					<?php
					if(true === $post_el_is_on['show_post_category']) :
					?>
						<div class="music-blog-standard-post__overlay-category">
							<?php music_blog_categories(); ?>
						</div>
					<?php endif; 
					if(true == $post_el_is_on['show_post_title']) :?>
						<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
					<?php
					endif;
					if(true == $post_el_is_on['show_post_date']) :
						music_blog_posted_on();
					endif;
					if(true == $post_el_is_on['show_post_excerpt']) :
						the_excerpt();
					endif;
				?>
				</div>
				<div class="music-blog-standard-post__blog-meta">
					<?php
					if (true == $post_el_is_on['show_post_author']) :
						music_blog_posted_by( true );
					endif;
					?>
				</div>
			</div>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
