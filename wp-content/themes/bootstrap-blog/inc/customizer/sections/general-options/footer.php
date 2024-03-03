<?php
/**
 * Footer Settings
 *
 * @package Bootstrap Blog
 */

add_action( 'customize_register', 'bootstrap_blog_customize_register_footer_section' );

function bootstrap_blog_customize_register_footer_section( $wp_customize ) {

    $wp_customize->add_section( 'bootstrap_blog_footer_section', array(
        'title'          => esc_html__( 'Footer / Copyright', 'bootstrap-blog' ),
        'description'    => esc_html__( 'Footer / Copyright :', 'bootstrap-blog' ),
        'panel'          => 'bootstrap_blog_general_panel',
        'priority'       => 170,        
    ) );

     $wp_customize->add_setting( 'copyright_text', array(
        'sanitize_callback'     =>  'wp_kses_post',
        'default'               =>  ''
    ) );

    $wp_customize->add_control( 'copyright_text', array(
        'label' => esc_html__( 'Copyright :', 'bootstrap-blog' ),
        'section' => 'bootstrap_blog_footer_section',
        'settings' => 'copyright_text',
        'type'=> 'textarea',
    ) );

    if ( fs_bootstrap_blog()->is_free_plan() ) {
        $wp_customize->add_setting( 'bootstrap_blog_footer_upgrade_to_pro', array(
            'sanitize_callback' => null,
        ) );
        $wp_customize->add_control( new Bootstrap_Blog_Control_Upgrade_To_Pro(
            $wp_customize, 'bootstrap_blog_footer_upgrade_to_pro', array(
                'section' => 'bootstrap_blog_footer_section',
                'settings'    => 'bootstrap_blog_footer_upgrade_to_pro',
                'title'   => __( 'Want the full control over your copyright?', 'bootstrap-blog' ),
                'items' => array(
                    'one'   => array(
                        'title' => __( 'Remove WordPress links from the copyright', 'bootstrap-blog' ),
                    ),
                ),
                'button_url'   => esc_url( 'https://thebootstrapthemes.com/bootstrap-blog/#free-vs-pro' ),
                'button_text'   => __( 'Upgrade Now', 'bootstrap-blog' ),
            )
        ) );
    }
}