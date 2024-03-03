<?php
/**
 * Bootstrap Blog Pro Theme Info
 *
 * @package Bootstrap Blog
 */

function bootstrap_blog_customizer_upgrade_to_pro( $wp_customize ) {

	$wp_customize->add_section( new Bootstrap_Blog_Customize_Section_Pro_Control( $wp_customize, 'upgrade-to-pro',	array(
			'title'    => esc_html__( 'Bootstrap Blog', 'bootstrap-blog' ),
			'type'	=> 'upgrade-to-pro',
			'pro_text' => esc_html__( 'Upgrade to Pro', 'bootstrap-blog' ),
			'pro_url'  => esc_url( 'https://thebootstrapthemes.com/bootstrap-blog/#free-vs-pro' ),
			'priority' => 1
		) )	);

	
}
add_action( 'customize_register', 'bootstrap_blog_customizer_upgrade_to_pro' );