<?php

/**
 * Added One Page Conference Page.
*/
/**
 * Add a new page under Appearance
 */
function bootstrap_blog_menu()
{
    add_theme_page(
        __( 'Get Started', 'bootstrap-blog' ),
        __( 'Get Started', 'bootstrap-blog' ),
        'edit_theme_options',
        'bootstrap-blog-get-started',
        'bootstrap_blog_page'
    );
}

add_action( 'admin_menu', 'bootstrap_blog_menu' );
/**
 * Enqueue styles for the help page.
 */
function bootstrap_blog_admin_scripts( $hook )
{
    if ( 'appearance_page_bootstrap-blog-get-started' !== $hook ) {
        return;
    }
    wp_enqueue_style(
        'bootstrap-blog-admin-style',
        get_template_directory_uri() . '/inc/about/about.css',
        array(),
        ''
    );
}

add_action( 'admin_enqueue_scripts', 'bootstrap_blog_admin_scripts' );
/**
 * Add the theme page
 */
function bootstrap_blog_page()
{
    ?>
	<div class="das-wrap">
		<div class="bootstrap-blog-panel">
			<div class="bootstrap-blog-logo">
				<img class="ts-logo" width="25" src="<?php 
    echo  esc_url( get_template_directory_uri() . '/inc/about/images/bootstrap.png' ) ;
    ?>" alt="Logo"> 
			</div>
			<?php 
    ?>
				<a href="https://thebootstrapthemes.com/bootstrap-blog/" target="_blank" class="btn btn-success pull-right"><?php 
    esc_html_e( 'Upgrade to Pro $59', 'bootstrap-blog' );
    ?></a>
			<?php 
    ?>
			<p>
			<?php 
    esc_html_e( 'Bootstrap Blog Pro is the premium version of Bootstrap Blog WordPress theme. It is perfect for lifestyle bloggers, style guides, personal bloggers and more. Even Though the theme is packed with loads of features, it is very light weight. It is very easy to use and customize with live preview. It supports Woocommerce plugin and is SEO optimized.', 'bootstrap-blog' );
    ?></p>
			<a class="btn btn-primary" href="<?php 
    echo  esc_url( admin_url( '/customize.php?' ) ) ;
    ?>"><?php 
    esc_html_e( 'Theme Options - Click Here', 'bootstrap-blog' );
    ?></a>
		</div>

		<div class="bootstrap-blog-panel">
			<div class="bootstrap-blog-panel-content">
				<div class="theme-title">
					<h3><?php 
    esc_html_e( 'Once you install all recommended plugins, you can import demo template.', 'bootstrap-blog' );
    ?></h3>
				</div>
				<a class="btn btn-secondary" href="<?php 
    echo  esc_url( admin_url( '/themes.php?page=advanced-import' ) ) ;
    ?>"><?php 
    esc_html_e( 'View Demo Templates', 'bootstrap-blog' );
    ?></a>
			</div>
		</div>
		<div class="bootstrap-blog-panel">
			<div class="bootstrap-blog-panel-content">
				<div class="theme-title">
					<h4><?php 
    esc_html_e( 'If you like the theme, please leave a review or Contact us for technical support.', 'bootstrap-blog' );
    ?></h4>
				</div>
				<a href="https://wordpress.org/support/theme/bootstrap-blog/reviews/#new-post" target="_blank" class="btn btn-secondary"><?php 
    esc_html_e( 'Rate this theme', 'bootstrap-blog' );
    ?></a> <a href="https://thebootstrapthemes.com/support/" target="_blank" class="btn btn-secondary"><?php 
    esc_html_e( 'Contact Us', 'bootstrap-blog' );
    ?></a>
			</div>
		</div>
	</div>
	<?php 
}
