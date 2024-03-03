<?php
/**
 * Advertisement Settings
 *
 * @package Bootstrap Blog
 */

add_action( 'customize_register', 'bootstrap_blog_customize_register_ad_panel' );

function bootstrap_blog_customize_register_ad_panel( $wp_customize ) {
	$wp_customize->add_panel( 'bootstrap_blog_ad_panel', array(
	    'priority'    => 13,
	    'title'       => esc_html__( 'Advertisement Options', 'bootstrap-blog' ),
	    'description' => esc_html__( 'Advertisement Options', 'bootstrap-blog' ),
	) );
}