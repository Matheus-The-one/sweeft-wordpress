<?php

/**
 * Bootstrap Blog Pro Theme Customizer
 *
 * @package Bootstrap Blog
 */
$panels = array(
    'general-options',
    'theme-options',
    'header-options',
    'advertisement-options'
);
add_action( 'customize_register', 'bootstrap_blog_change_homepage_settings_options' );
function bootstrap_blog_change_homepage_settings_options( $wp_customize )
{
    $wp_customize->get_section( 'title_tagline' )->priority = 12;
    $wp_customize->get_section( 'static_front_page' )->priority = 13;
    $wp_customize->remove_control( 'header_textcolor' );
}

$general_sections = array(
    'colors',
    'fonts',
    'pagination',
    'footer',
    'social-media',
    'background'
);
$header_sections = array( 'header-image', 'theme-header', 'site-identity' );
$theme_sections = array(
    'blog-list',
    'slider',
    'pages',
    'featured',
    'shop',
    'drag-and-drop'
);
$ad_section = array( 'header-ad' );
require get_template_directory() . '/inc/customizer/sections/upgrade-to-pro.php';
if ( !empty($panels) ) {
    foreach ( $panels as $panel ) {
        require get_template_directory() . '/inc/customizer/panels/' . $panel . '.php';
    }
}
if ( !empty($general_sections) ) {
    foreach ( $general_sections as $section ) {
        require get_template_directory() . '/inc/customizer/sections/general-options/' . $section . '.php';
    }
}
if ( !empty($header_sections) ) {
    foreach ( $header_sections as $section ) {
        require get_template_directory() . '/inc/customizer/sections/header-options/' . $section . '.php';
    }
}
if ( !empty($theme_sections) ) {
    foreach ( $theme_sections as $section ) {
        require get_template_directory() . '/inc/customizer/sections/theme-options/' . $section . '.php';
    }
}
if ( !empty($ad_section) ) {
    foreach ( $ad_section as $section ) {
        require get_template_directory() . '/inc/customizer/sections/ad-options/' . $section . '.php';
    }
}
/**
 * Enqueue the customizer stylesheet.
 */
function bootstrap_blog_customizer_stylesheet()
{
    wp_register_style(
        'bootstrap-blog-customizer-css',
        get_template_directory_uri() . '/css/customizer.css',
        NULL,
        '1.1.0',
        'all'
    );
    wp_enqueue_style( 'bootstrap-blog-customizer-css' );
}

add_action( 'customize_controls_print_styles', 'bootstrap_blog_customizer_stylesheet' );
/**
 * Enqueue the customizer javascript.
 */
function bootstrap_blog_customize_preview_js()
{
    wp_enqueue_script(
        'bootstrap-blog-customizer-preview',
        get_template_directory_uri() . '/js/customizer.js',
        array( 'jquery' ),
        '1.0.0',
        true
    );
}

add_action( 'customize_preview_init', 'bootstrap_blog_customize_preview_js' );
/**
 * Binds Customizer CSS directives for free theme version.
 */
function bootstrap_blog_customizer_css()
{
    wp_enqueue_style(
        'bootstrap_blog_customizer_css',
        get_template_directory_uri() . '/inc/css/customizer.css',
        array(),
        BOOTSTRAP_BLOG_VERSION
    );
}

if ( fs_bootstrap_blog()->is_free_plan() ) {
    add_action( 'customize_controls_enqueue_scripts', 'bootstrap_blog_customizer_css' );
}
/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';