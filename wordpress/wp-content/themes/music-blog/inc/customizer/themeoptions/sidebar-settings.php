<?php
/*Blog Page Settings*/

Kirki::add_section( 'sidebar_settings_section', array(
    'title'          => esc_html__( 'Sidebar Settings', 'music-blog' ),
    'description'    => esc_html__( 'Control Sidebar Of Your Website', 'music-blog' ),
    'panel'          => 'music_blog_global_panel',
) );

Kirki::add_field( 'music_blog_config', [
	'type'        => 'select',
	'settings'    => 'blog_page_sidebar',
	'label'       => esc_html__( 'Blog Page Sidebar', 'music-blog' ),
	'section'     => 'sidebar_settings_section',
	'default'     => 'right',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'left' => esc_html__( 'left Sidebar', 'music-blog' ),
		'right' => esc_html__( 'Right Sidebar', 'music-blog' ),
		'no' => esc_html__( 'No Sidebar', 'music-blog' ),
	],
] );

Kirki::add_field( 'music_blog_config', [
	'type'        => 'select',
	'settings'    => 'archive_page_sidebar',
	'label'       => esc_html__( 'Archive Page Sidebar', 'music-blog' ),
	'section'     => 'sidebar_settings_section',
	'default'     => 'right',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'left' => esc_html__( 'left Sidebar', 'music-blog' ),
		'right' => esc_html__( 'Right Sidebar', 'music-blog' ),
		'no' => esc_html__( 'No Sidebar', 'music-blog' ),
	],
] );

Kirki::add_field( 'music_blog_config', [
	'type'        => 'select',
	'settings'    => 'page_sidebar',
	'label'       => esc_html__( 'Page Sidebar', 'music-blog' ),
	'section'     => 'sidebar_settings_section',
	'default'     => 'right',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'left' => esc_html__( 'left Sidebar', 'music-blog' ),
		'right' => esc_html__( 'Right Sidebar', 'music-blog' ),
		'no' => esc_html__( 'No Sidebar', 'music-blog' ),
	],
] );

Kirki::add_field( 'music_blog_config', [
	'type'        => 'select',
	'settings'    => 'post_sidebar',
	'label'       => esc_html__( 'Post Sidebar', 'music-blog' ),
	'section'     => 'sidebar_settings_section',
	'default'     => 'right',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'left' => esc_html__( 'left Sidebar', 'music-blog' ),
		'right' => esc_html__( 'Right Sidebar', 'music-blog' ),
		'no' => esc_html__( 'No Sidebar', 'music-blog' ),
	],
] );
