<?php
/*Blog Page Settings*/

Kirki::add_section( 'post_loop_settings_section', array(
    'title'          => esc_html__( 'Post Loop Settings', 'music-blog' ),
    'panel'          => 'music_blog_global_panel',
) );

Kirki::add_field( 'music_blog_config', [
	'type'        => 'select',
	'settings'    => 'post_column',
	'label'       => esc_html__( 'Post Column', 'music-blog' ),
	'section'     => 'post_loop_settings_section',
	'default'    => 'grid',
	'priority'    => 10,
	'choices' => [
			'4' => __( '4 Colmun', 'music-blog' ),
			'3' => __( '3 Column', 'music-blog' ),
			'2' => __( '2 Column', 'music-blog' ),
			'grid' => __( 'Grid', 'music-blog' ),
		],
] );

Kirki::add_field( 'rs_personal_blog_config', array(
    'type'        => 'custom',
    'settings'    => 'sep_after_post_column',
    'label'       => '',
    'section'     => 'post_loop_settings_section',
    'default'     => '<hr>',
) );

Kirki::add_field( 'music_blog_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_category',
    'label'       => esc_html__( 'Show Post Category', 'music-blog' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );

Kirki::add_field( 'music_blog_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_title',
    'label'       => esc_html__( 'Show Post Title', 'music-blog' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );

Kirki::add_field( 'music_blog_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_author',
    'label'       => esc_html__( 'Show Post Author', 'music-blog' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );

Kirki::add_field( 'music_blog_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_thumbnail',
    'label'       => esc_html__( 'Thumbnail  On//Off', 'music-blog' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );
Kirki::add_field( 'music_blog_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_excerpt',
    'label'       => esc_html__( 'Show Post Excerpt', 'music-blog' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );

Kirki::add_field( 'music_blog_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_date',
    'label'       => esc_html__( 'Show Post Date', 'music-blog' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );