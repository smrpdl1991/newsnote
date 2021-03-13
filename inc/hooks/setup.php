<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Hooks;
class Setup{

	public function __construct(){
		$this->hooks();
	}

	public function hooks(){
		add_action( 'after_setup_theme', array( $this, 'after_setup' ) );
		add_filter( 'excerpt_more', '__return_false' );
		add_filter( 'excerpt_length', array( $this, 'newsnote_excerpt_length' ) );
	}

	public function after_setup(){

		global $content_width;
		
		if(!$content_width){
			$content_width = apply_filters( 'newsnote_content_width', 640 );
		}

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on NewsNote, use a find and replace
		 * to change 'newsnote' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'newsnote', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'newsnote-thumb-600x600', 600, 600, true );
		add_image_size( 'newsnote-thumb-508x338', 508, 338, true );
		add_image_size( 'newsnote-thumb-366x260', 366, 260, true );
		

		$newsnote_image_src_set_option = get_theme_mod( 'newsnote_image_src_set_option', 'disable' );
		$calculate_image_srcset_callback = ($newsnote_image_src_set_option=='enable') ? '__return_true' : '__return_false';
		add_filter( 'wp_calculate_image_srcset', $calculate_image_srcset_callback );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'top_menu' => esc_html__( 'Top Menu', 'newsnote' ),
			'primary-nav' => esc_html__( 'Primary Menu', 'newsnote' ),
			'footer' => esc_html__( 'Footer Menu', 'newsnote' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for Custom Logo.
		add_theme_support( 
			'custom-logo', 
			array(
				'width'       => 300,
				'height'      => 45,
				'flex-width'  => true,
				'flex-height'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support( 
			'custom-background', 
			apply_filters( 
				'newsnote_custom_background_args', 
				array(
					'default-color' => '#ffffff',
					'default-image' => '',
				) 
			) 
		);

		// Add theme support for post format.
		add_theme_support( 
			'post-formats', 
			array( 
				'standard',
				'aside',
				'chat',
				'gallery',
				'link',
				'image',
				'quote',
				'status',
				'video',
				'audio',
			) 
		);

		$defaults = array(
			'width'                  => 1200,
			'height'                 => 800,
			'flex-height'            => true,
			'flex-width'             => true,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => true,
			'default-text-color'     => '#0c4da2',
		);
		add_theme_support( 'custom-header', $defaults );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}

	function newsnote_excerpt_length( $length ) {

		if(!is_admin()):
			$excerpt_length = get_theme_mod( 'newsnote_excerpt_length', 55 );
			if(absint($excerpt_length)){
				return absint($excerpt_length);
			}
		endif;
		return $length;
		
	}

}
