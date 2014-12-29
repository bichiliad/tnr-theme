<?php

/* Thumbnails */

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 350, 350, true );

/* oEmbed things */
if ( ! isset( $content_width ) ) $content_width = '560';
function allow_oembed_params($provider, $url, $args) {
	$newargs = $args;
	unset( $newargs['discover'] );
	unset( $newargs['width'] );
	unset( $newargs['height'] );

	$parameters = urlencode( http_build_query( $newargs ) );
	return $provider . '&' . $parameters;
}
add_filter( 'oembed_fetch_url', 'allow_oembed_params', 10, 3 );

/* Add opengraph image to homepage */
function open_graph_home_image( $tags ) {
    if ( is_home() || is_front_page() ) {
        // Remove the default blank image added by Jetpack
        unset( $tags['og:image'] );
 
        $fb_home_img = get_template_directory_uri() . '/img/tnr-og.png';
        $tags['og:image'] = esc_url( $fb_home_img );
    }
    return $tags;
}
add_filter( 'jetpack_open_graph_tags', 'open_graph_home_image' );

/* Set fallback opengraph image for posts */
function open_graph_default( $media, $post_id, $args ) {
    if ( $media ) {
        return $media;
    } else {
        $permalink = get_permalink( $post_id );
        $fb_home_img =  get_template_directory_uri() . '/img/tnr-og.png';
        $url = apply_filters( 'jetpack_photon_url', $fb_home_img );
     
        return array( array(
            'type'  => 'image',
            'from'  => 'custom_fallback',
            'src'   => esc_url( $url ),
            'href'  => $permalink,
        ) );
    }
}
add_filter( 'jetpack_images_get_images', 'open_graph_default', 10, 3 );

/* Change related post details */
function jetpackme_related_posts_headline( $headline ) {
$headline = sprintf(
            '<div class="related-posts desktop"><br /><h2>%s</h2><br /></div>',
            esc_html( 'similar / tracks' )
            );
return $headline;
}
add_filter( 'jetpack_relatedposts_filter_headline', 'jetpackme_related_posts_headline' );

/* Don't show related post context */
add_filter( 'jetpack_relatedposts_filter_post_context', '__return_empty_string' );

/* Add a menu in the header */ 
function register_menus() {
	register_nav_menu('header-menu', __( 'Header Menu' ));
}
add_action( 'init', 'register_menus');

/* Add widgets in the footer */
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'bucket left',
		'before_widget' => '<div class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'bucket right',
		'before_widget' => '<div class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

?>
