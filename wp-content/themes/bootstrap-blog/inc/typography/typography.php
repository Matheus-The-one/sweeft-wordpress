<?php
/**
 * Blossom Magazine Pro Typography Related Functions
 *
 * @package Blossom_Magazine_Pro
 */



include_once wp_normalize_path( dirname( __FILE__ ) . '/inc/customizer-dropdown-google-fonts.php' );



include_once wp_normalize_path( dirname( __FILE__ ) . '/inc/class-webfonts-local.php' );
include_once wp_normalize_path( dirname( __FILE__ ) . '/inc/class-fonts-google-local.php' );

include_once wp_normalize_path( dirname( __FILE__ ) . '/site-fonts.php' );
include_once wp_normalize_path( dirname( __FILE__ ) . '/inc/helper-functions.php' );


add_action( 'wp_enqueue_scripts', 'scripts' );
function scripts() {
    $args = bootstrap_blog_used_google_fonts();
    wp_enqueue_style( 'google-fonts', blossom_magazine_pro_fonts_url( $args ), array(), null );
}