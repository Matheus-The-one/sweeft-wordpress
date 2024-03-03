<?php

/**
 * Fonts Settings
 *
 * @package Bootstrap Blog
 */
add_action( 'customize_register', 'bootstrap_blog_customize_register_fonts_section' );
function bootstrap_blog_customize_register_fonts_section( $wp_customize )
{
    $wp_customize->add_section( 'bootstrap_blog_fonts_section', array(
        'title'       => esc_html__( 'Fonts', 'bootstrap-blog' ),
        'description' => esc_html__( 'Fonts :', 'bootstrap-blog' ),
        'panel'       => 'bootstrap_blog_general_panel',
        'priority'    => 2,
    ) );
}

add_action( 'customize_register', 'bootstrap_blog_customize_font_family' );
function bootstrap_blog_customize_font_family( $wp_customize )
{
    $wp_customize->add_setting( 'bootstrap_blog_fonts_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Bootstrap_Blog_Control_Upgrade_To_Pro( $wp_customize, 'bootstrap_blog_fonts_upgrade_to_pro', array(
        'section'     => 'bootstrap_blog_fonts_section',
        'settings'    => 'bootstrap_blog_fonts_upgrade_to_pro',
        'title'       => __( 'Customize your typography with options such as size, line height, and font weight.', 'bootstrap-blog' ),
        'items'       => array(
        'one' => array(
        'title' => __( 'Choose from over 850 Google Fonts', 'bootstrap-blog' ),
    ),
    ),
        'button_url'  => esc_url( 'https://thebootstrapthemes.com/bootstrap-blog/#free-vs-pro' ),
        'button_text' => __( 'Upgrade Now', 'bootstrap-blog' ),
    ) ) );
}
