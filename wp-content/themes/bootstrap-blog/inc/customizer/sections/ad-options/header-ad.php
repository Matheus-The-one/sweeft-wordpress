<?php

/**
 * Header Advertisement Settings
 *
 * @package Bootstrap Blog
 */
add_action( 'customize_register', 'bootstrap_blog_customize_register_header_ad' );
function bootstrap_blog_customize_register_header_ad( $wp_customize )
{
    $wp_customize->add_section( 'bootstrap_blog_header_ad_sections', array(
        'title'       => esc_html__( 'Header Advertisement', 'bootstrap-blog' ),
        'description' => esc_html__( 'Header Advertisement :', 'bootstrap-blog' ),
        'panel'       => 'bootstrap_blog_ad_panel',
        'priority'    => 1,
    ) );
}
