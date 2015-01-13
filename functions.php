<?php

function mytheme_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'header_textcolor' , array(
		'default'     => '#000000',
		'transport'   => 'refresh',
	) );
}
add_action( 'customize_register', 'mytheme_customize_register' );

/*
 * HELPERS
 */

# Given a post ID, generates a masthead. First tries oembed, 
#   then tries featured image. 
function get_post_masthead( $post_id ) {

	# Attempt to get oembed code
	$embed_url = get_post_meta( $post_id, 'embed', true);
	if ( $embed_url != '' ) {
		
		# Check for custom players
		if ( strpos( $embed_url, 'soundcloud.com' ) !== false ) {
			return custom_soundcloud_oembed($embed_url);
		}

		$embed_code = wp_oembed_get( $embed_url, array(
			'show_comments' => 'false',
			'buying' 		=> 'false',
			'sharing'		=> 'false'		
		));

		if ( $embed_code != false ) {
			return '<div class="post-masthead">' . $embed_code . '</div>';
		}
	}

	# No embed code or no url, better try post thumbnail
	if( has_post_thumbnail( $post_id ) ) {
		return  '<div class="post-masthead">'
			. '<a href="'
			. get_permalink( $post_id )
			. '">'
			. get_the_post_thumbnail( $post_id, 'full' )
			. '</a>'
			. '</div>';
	}

	# No thumbnail, no embed code, just return empty.
	return '<div class="post-masthead"><!-- No masthead content  --></div>';
}

/*
 * CUSTOM OEMBEDS
 */

function custom_soundcloud_oembed($url) {

	$markup = ' 
	<div class="plangular" plangular="'. $url . '">

        <!-- The player -->
        <div class="track-frame" ng-if="track"> 
            <div class="play-pause">
                <svg plangular-icon="play" ng-if="player.playing != track"></svg>
                <svg plangular-icon="pause" ng-if="player.playing == track"></svg>
            </div>
            <img crossorigin class="artwork" ng-click="playPause()" ng-src="{{ track.artwork_url.replace(\'large\', \'t500x500\') }}"></img>

            <div class="controls check">
                <span class="play" ng-click="play()" ng-if="player.playing != track">
                    <svg plangular-icon="play"></svg>
                </span>
                <span class="pause" ng-click="pause()" ng-if="player.playing == track">
                    <svg plangular-icon="pause"></svg>
                </span>
                <!-- {{ track.user.username }} - {{ track.title }} -->
            </div>
            <progress class="check" value="{{ currentTime / duration || 0 }}" ng-click="seek($event)">
                {{ currentTime / duration }}
            </progress>
            <div class="track-info">
                <div class="track-username">{{ track.user.username }}</div>
                <div class="track-title">{{ track.title }}</div>
                <a ng-href="{{ track.permalink_url}}">Listen on Soundcloud</a>
            </div>
        </div>


        <!-- Loading -->
        <div class="loading" ng-if="!track">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div><!-- /.loading --> 

    </div><!-- /.plangular --> 	
	';
	return $markup;
}

/* 
 * CONFIGURATION 
 */

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
	register_nav_menu('top-menu', __( 'Top Menu' ));
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
