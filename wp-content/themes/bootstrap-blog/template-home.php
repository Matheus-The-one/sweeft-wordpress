<?php

// Template Name: Home
get_header();
$default = array(
    'blog',
    'featured',
    'shop',
    'email-subscription',
    'instagram'
);
$sections = $default;
if ( !empty($sections) && is_array( $sections ) ) {
    foreach ( $sections as $section ) {
        get_template_part( 'template-parts/home-sections/' . $section, $section );
    }
}
get_footer();