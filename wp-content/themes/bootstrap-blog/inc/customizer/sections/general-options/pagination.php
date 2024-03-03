<?php

/**
 * Pagination Settings
 *
 * @package Bootstrap Blog
 */


add_action( 'customize_register', 'bootstrap_blog_customize_register_pagination_section' );
function bootstrap_blog_customize_register_pagination_section( $wp_customize ) {

    $wp_customize->add_section( 'bootstrap_blog_pagination_section', array(
        'title'          => esc_html__( 'Pagination', 'bootstrap-blog' ),
        'description'    => esc_html__( 'Pagination :', 'bootstrap-blog' ),
        'panel'          => 'bootstrap_blog_general_panel',
        'priority'       => 3,        
    ) );
}

add_action( 'customize_register', 'bootstrap_blog_customize_pagination' );

function bootstrap_blog_customize_pagination( $wp_customize ) {

    $wp_customize->add_setting( 'pagination_type', array(
        'capability'  => 'edit_theme_options',        
        'sanitize_callback' => 'bootstrap_blog_sanitize_choices',
        'default'     => 'ajax-loadmore',
    ) );

    $wp_customize->add_control( new Bootstrap_Blog_Radio_Buttonset_Control( $wp_customize, 'pagination_type', array(
        'label' => esc_html__( 'Pagination Type :', 'bootstrap-blog' ),
        'section' => 'bootstrap_blog_pagination_section',
        'settings' => 'pagination_type',
        'type'=> 'radio-buttonset',
        'choices'     => array(
            'ajax-loadmore' => esc_html__( 'Ajax Loadmore', 'bootstrap-blog' ),
            'number-pagination'    =>  esc_html__( 'Number Pagination', 'bootstrap-blog' ),      
        ),
    ) ) );            
    
}