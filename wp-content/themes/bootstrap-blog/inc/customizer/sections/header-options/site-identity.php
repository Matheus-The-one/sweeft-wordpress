<?php
/**
 * Site Identity Settings
 *
 * @package Bootstrap Blog
 */


add_action( 'customize_register', 'bootstrap_blog_change_site_identity_panel' );

function bootstrap_blog_change_site_identity_panel( $wp_customize)  {
    $wp_customize->get_section( 'title_tagline' )->priority = 3;
    $wp_customize->get_section( 'title_tagline' )->panel = 'bootstrap_blog_header_panel';

    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}



add_action( 'customize_register', 'bootstrap_blog_site_identity_settings' );

function bootstrap_blog_site_identity_settings( $wp_customize ) {

    $wp_customize->add_setting( 'site_title_color_option', array(
        'capability'  => 'edit_theme_options',
        'default'     => '#000',
        'transport' => 'postMessage',
        'sanitize_callback' => 'bootstrap_blog_sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_title_color_option', array(
        'label'      => esc_html__( 'Site Title Color', 'bootstrap-blog' ),
        'section'    => 'title_tagline',
        'settings'   => 'site_title_color_option',
    ) ) );

	$wp_customize->add_setting( 'bootstrap_blog_logo_size', array(
        'default'           => 30,
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ) );

    $wp_customize->add_control( new Bootstrap_Blog_Slider_Control( $wp_customize, 'bootstrap_blog_logo_size', array(
        'section' => 'title_tagline',
        'settings' => 'bootstrap_blog_logo_size',
        'label'   => esc_html__( 'Logo Size', 'bootstrap-blog' ),
        'choices'     => array(
            'min'   => 15,
            'max'   => 60,
            'step'  => 1,
        )
    ) ) );

    $wp_customize->add_setting( 'site_identity_font_family', array(
        'sanitize_callback' => 'bootstrap_blog_sanitize_google_fonts',
        'default'     => 'Poppins',
    ) );

    $wp_customize->add_control( 'site_identity_font_family', array(
        'settings'    => 'site_identity_font_family',
        'label'       =>  esc_html__( 'Site Identity Font Family', 'bootstrap-blog' ),
        'section'     => 'title_tagline',
        'type'        => 'select',
        'choices'     => customizer_dropdown_google_fonts(),
    ) );
    

    $wp_customize->add_setting( 'header_image_height', array(
        'default'           => 30,
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ) );

    $wp_customize->add_control( new Bootstrap_Blog_Slider_Control( $wp_customize, 'header_image_height', array(
        'section' => 'title_tagline',
        'settings' => 'header_image_height',
        'label'   => esc_html__( 'Header Image Height', 'bootstrap-blog' ),
        'choices'     => array(
            'min'   => 15,
            'max'   => 200,
            'step'  => 1,
        )
    ) ) );
    
}