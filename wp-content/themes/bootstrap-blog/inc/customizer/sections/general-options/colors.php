<?php

/**
 * Colors Settings
 *
 * @package Bootstrap Blog
 */
add_action( 'customize_register', 'bootstrap_blog_change_colors_panel' );
function bootstrap_blog_change_colors_panel( $wp_customize )
{
    //$wp_customize->get_section( 'colors' )->title = esc_html__( 'Colors and Fonts', 'bootstrap-blog' );
    $wp_customize->get_section( 'colors' )->priority = 1;
    $wp_customize->get_section( 'colors' )->panel = 'bootstrap_blog_general_panel';
}

add_action( 'customize_register', 'bootstrap_blog_customize_color_options' );
function bootstrap_blog_customize_color_options( $wp_customize )
{
    $wp_customize->add_setting( 'bootstrap_blog_colors_upgrade_to_pro', array(
        'sanitize_callback' => null,
    ) );
    $wp_customize->add_control( new Bootstrap_Blog_Control_Upgrade_To_Pro( $wp_customize, 'bootstrap_blog_colors_upgrade_to_pro', array(
        'section'     => 'colors',
        'settings'    => 'bootstrap_blog_colors_upgrade_to_pro',
        'title'       => __( 'Choose colors that perfectly align with your brand.', 'bootstrap-blog' ),
        'items'       => array(
        'one' => array(
        'title' => __( 'Multiple color palettes for the most important sections of your website', 'bootstrap-blog' ),
    ),
    ),
        'button_url'  => esc_url( 'https://thebootstrapthemes.com/bootstrap-blog/#free-vs-pro' ),
        'button_text' => __( 'Upgrade Now', 'bootstrap-blog' ),
    ) ) );
}
