<?php $header_text_color = get_header_textcolor(); ?>
<header class="header-1<?php if( $menu_sticky ) echo ' sticky-header'; ?>">

	<section class="top-bar" <?php if( has_header_image() ) : ?> style="background-image:url(<?php echo esc_url( get_header_image() ); ?>)" <?php endif; ?>>
		<div class="container">
			<div class="row top-head-1">
				<!-- Brand and toggle get grouped for better mobile display -->	
				<div class="col-sm-3">
					<?php
					// To store only value which has links :
					if ( ! empty( $social_media ) && is_array( $social_media ) ) {
						$social_media_filtered = array();
						foreach ( $social_media as $value ) {
							if( empty( $value['social_media_link'] ) ) {
								continue;
							}
							$social_media_filtered[] = $value; 
						}
					}	
					?>

					<?php if ( ! empty( $social_media_filtered ) && is_array( $social_media_filtered ) ) : ?>
					<!-- top-bar -->
						<div class="social-icons">
							<ul class="list-inline">
								<?php foreach ( $social_media_filtered as $value ) { ?>
									<?php
										$no_space_class = str_replace( 'fa fa-', '', $value['social_media_class'] );
										$class = strtolower( $no_space_class );
									?>
							        <li class="<?php echo esc_attr( $class ); ?>"><a href="<?php echo esc_url( $value['social_media_link'] ); ?>" target="_blank"><i class="<?php echo esc_attr( $value['social_media_class'] ); ?>"></i></a></li>
							    <?php } ?>
							</ul>
						</div>
					<!-- top-bar -->
					<?php endif; ?>
				</div>	
				
				<div class="col-sm-6 logo text-center">			
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					}
					if( display_header_text() ) : ?>
		      			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		      				<div class="site-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></div>
		      				<p class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
		      			</a>
      				<?php endif; ?>
				</div>
				<?php if( get_theme_mod( 'header_search_display_option', false ) ) : ?>
					<div class="col-sm-3"><div class="search-top"><?php get_search_form( $echo = true ); ?></div></div>
				<?php endif; ?>
			</div>
		</div> <!-- /.end of container -->
	</section> <!-- /.end of section -->

	



	<section  class="main-nav nav-one">
		<div class="container">
			<nav class="navbar">
		      	<button type="button" class="navbar-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'bootstrap-blog' ); ?></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</button>	    
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  							
					<?php
			            wp_nav_menu( array(
			                'theme_location'    => 'primary',
			                'menu-id'    => 'primary-menu',
			                'depth'             => 8,
			                'container'         => 'div',
			                'menu_class'        => 'nav navbar-nav',
			                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			                'walker'            => new Bootstrap_Blog_Wp_Bootstrap_Navwalker()
			            ) );
			        ?>			        
			    </div> <!-- /.end of collaspe navbar-collaspe -->
			</nav>
		</div>

	</section>
</header>