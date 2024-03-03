
<?php if( get_theme_mod( 'pages_display_option', false ) ) : ?>
  <div class="home-pages">
    <div class="row">

      <?php 
        $pages = get_theme_mod( 'pages' ); 
        if( is_array( $pages ) && ! empty( $pages ) ) :
      ?>

        <?php foreach( $pages as $page ) :
            if( $page[ 'page' ] == '' ) {
              continue;
            }
            $selectPage = get_page_by_path($page[ 'page' ] );
            $post = get_post($selectPage);
            setup_postdata( $post )
        ?>

          <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>

          <div class="col-sm-4">
            <div class="home-pages-block">
            <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
              <?php if( ! empty( $image ) ) : ?> <img src="<?php echo esc_url( $image[0] ); ?>"> <?php endif; ?>
            </a>
            <div class="page-home-summary">
                    <h5 class="category"><a href="<?php echo esc_url( get_permalink( $page_id ) ); ?>"><?php the_title(); ?></a></h5>
            </div>
            </div>
          </div>
          <?php wp_reset_postdata(); ?>

      <?php endforeach; ?>


      <?php endif; ?>


    </div>
  </div>
<?php endif;