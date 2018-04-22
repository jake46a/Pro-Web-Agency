<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});

	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

Timber::$dirname = array('templates', 'views', 'templates/partial', 'templates/components');

class PwaSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		return $context;
	}



	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new PwaSite();

if ( ! function_exists( 'pwasite_setup' ) ) :

function pwasite_setup() {
// Set up the WordPress core custom background feature.
add_theme_support( 'custom-background', apply_filters( 'pwasite_custom_background_args', array(
	'default-color' => 'ffffff',
	'default-image' => '',
	) ) );
	}
	endif;
add_action( 'after_setup_theme', 'pwasite_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pwasite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pwasite_content_width', 1170 );
}
add_action( 'after_setup_theme', 'pwasite_content_width', 0 );

//sidebars-go here
function pwasite_widgets_init() {
register_sidebar( array(
'name' => 'Footer Sidebar 1',
'id' => 'footersidebar1',
'description' => 'Appears in the footer area',
'before_widget' => '<div class="card-header">',
'after_widget' => '</p></div><div class="card-footer"></div>',
'before_title' => '<h3 class="card-title">',
'after_title' => '</h3></div><div class="card-body"<p class="card-text">',
) );

register_sidebar( array(
'name' => 'Footer Sidebar 2',
'id' => 'footersidebar2',
'description' => 'Appears in the footer area',
'before_widget' => '<div class="card-header">',
'after_widget' => '</p></div><div class="card-footer"></div>',
'before_title' => '<h3 class="card-title">',
'after_title' => '</h3></div><div class="card-body"<p class="card-text">',
) );
}
add_action( 'widgets_init', 'pwasite_widgets_init' );

function pwasite_scripts() {
wp_enqueue_style( 'pwasite-bootstrap-css', get_template_directory_uri() . '/assets/build/css/all.min.css' );
wp_enqueue_style( 'pwasite-style', get_stylesheet_uri() );
    if(get_theme_mod( 'theme_option_setting' ) && get_theme_mod( 'theme_option_setting' ) !== 'default') {
        wp_enqueue_style( 'pwasite-'.get_theme_mod( 'theme_option_setting' ), get_template_directory_uri() . '/assets/src/presets/theme-option/'.get_theme_mod( 'theme_option_setting' ).'.css', false, '' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'poppins-lora') {
        wp_enqueue_style( 'pwasite-poppins-lora-font', '//fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Poppins:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'montserrat-merriweather') {
        wp_enqueue_style( 'pwasite-montserrat-merriweather-font', '//fonts.googleapis.com/css?family=Merriweather:300,400,400i,700,900|Montserrat:300,400,400i,500,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'poppins-poppins') {
        wp_enqueue_style( 'pwasite-poppins-font', '//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'roboto-roboto') {
        wp_enqueue_style( 'pwasite-roboto-font', '//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'arbutusslab-opensans') {
        wp_enqueue_style( 'pwasite-arbutusslab-opensans-font', '//fonts.googleapis.com/css?family=Arbutus+Slab|Open+Sans:300,300i,400,400i,600,600i,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'oswald-muli') {
        wp_enqueue_style( 'pwasite-oswald-muli-font', '//fonts.googleapis.com/css?family=Muli:300,400,600,700,800|Oswald:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'montserrat-opensans') {
        wp_enqueue_style( 'pwasite-montserrat-opensans-font', '//fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,300i,400,400i,600,600i,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'robotoslab-roboto') {
        wp_enqueue_style( 'pwasite-robotoslab-roboto', '//fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:300,300i,400,400i,500,700,700i' );
    }
    if(get_theme_mod( 'preset_style_setting' ) && get_theme_mod( 'preset_style_setting' ) !== 'default') {
        wp_enqueue_style( 'pwasite-'.get_theme_mod( 'preset_style_setting' ), get_template_directory_uri() . '/assets/src/presets/typography/'.get_theme_mod( 'preset_style_setting' ).'.css', false, '' );
    }

    wp_enqueue_script('pwasite-jquery', get_template_directory_uri() . '/inc/js/jquery-3.3.1.slim.min.js', array() );
    wp_enqueue_script('pwasite-popper', get_template_directory_uri() . '/inc/js/popper.min.js', array() );
    wp_enqueue_script('pwasite-bootstrapjs', get_template_directory_uri() . '/inc/js/bootstrap.bundle.min.js', array() );
    }
    add_action( 'wp_enqueue_scripts', 'pwasite_scripts' );

function pwasite_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <div class="d-block mb-3">' . __( "To view this protected post, enter the password below:", "pwasite" ) . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __( "Password:", "pwasite" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__( "Submit", "pwasite" ) . '" class="btn btn-primary"/></div>
    </form>';
    return $o;
}
add_filter( 'the_password_form', 'pwasite_password_form' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

add_theme_support( 'post-thumbnails' );
add_image_size( 'homepage-laptop', 720, 240 );
add_image_size( 'homepage-desck', 900, 300 );
