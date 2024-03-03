<?php
/**
 * Drag & Drop Sections
 *
 * @package Bootstrap Blog
 */
add_action( 'customize_register', 'bootstrap_blog_drag_and_drop_sections' );

function bootstrap_blog_drag_and_drop_sections( $wp_customize ) {

	$wp_customize->add_section( 'bootstrap_blog_sort_homepage_sections', array(
	    'title'          => esc_html__( 'Drag & Drop', 'bootstrap-blog' ),
	    'description'    => esc_html__( 'Drag & Drop', 'bootstrap-blog' ),
	    'panel'          => 'bootstrap_blog_theme_options_panel',
	    'priority'       => 6,
	) );

	$default = array( 'blog', 'featured', 'shop', 'email-subscription', 'instagram' );

	$choices = array(			
		'blog' => esc_html__( 'Blog Section', 'bootstrap-blog' ),
		'featured' => esc_html__( 'Featured Section', 'bootstrap-blog' ),
		'shop' => esc_html__( 'Shop Section', 'bootstrap-blog' ),
		'email-subscription' => esc_html__( 'Email Subscription Section', 'bootstrap-blog' ),
		'instagram' => esc_html__( 'Instagram Section', 'bootstrap-blog' ),
	);
	

	$wp_customize->add_setting( 'bootstrap_blog_sort_homepage', array(
        'capability'  => 'edit_theme_options',
        'sanitize_callback'	=> 'bootstrap_blog_sanitize_array',
        'default'     => $default
    ) );

    $wp_customize->add_control( new Bootstrap_Blog_Control_Sortable( $wp_customize, 'bootstrap_blog_sort_homepage', array(
        'label' => esc_html__( 'Drag and Drop Sections to rearrange.', 'bootstrap-blog' ),
        'section' => 'bootstrap_blog_sort_homepage_sections',
        'settings' => 'bootstrap_blog_sort_homepage',
        'type'=> 'sortable',
        'disabled'     => fs_bootstrap_blog()->is_free_plan(),
        'choices'     => $choices
    ) ) );

    if ( fs_bootstrap_blog()->is_free_plan() ) {
        $wp_customize->add_setting( 'bootstrap_blog_sort_homepage_upgrade_to_pro', array(
            'sanitize_callback' => null,
        ) );
        $wp_customize->add_control( new Bootstrap_Blog_Control_Upgrade_To_Pro(
            $wp_customize, 'bootstrap_blog_sort_homepage_upgrade_to_pro', array(
                'section' => 'bootstrap_blog_sort_homepage_sections',
                'settings'    => 'bootstrap_blog_sort_homepage_upgrade_to_pro',
                'title'   => __( 'Rearrange homepage sections and prioritize what your visitors should see first.', 'bootstrap-blog' ),
                'items' => array(
                    'one'   => array(
                        'title' => __( 'Rearrange sections on the Homepage', 'bootstrap-blog' ),
                    ),
                ),
                'button_url'   => esc_url( 'https://thebootstrapthemes.com/bootstrap-blog/#free-vs-pro' ),
                'button_text'   => __( 'Upgrade Now', 'bootstrap-blog' ),
            )
        ) );
    }
}