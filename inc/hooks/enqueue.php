<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Hooks;
class Enqueue{

	public function __construct(){
		$this->hooks();
	}

	public function hooks(){
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 10 );
	}

	public function enqueue(){

		/*
		 * Enqueue Styles
		 */

		wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Heebo:100,300,400,500,700,800,900&display=swap', array(), false );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/third-party/font-awesome/font-awesome.css', array(), false );
		wp_enqueue_style( 'slick-slider', get_template_directory_uri().'/assets/third-party/slickslider/slick.min.css', array(), false );
		wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/assets/third-party/slickslider/slick-theme.min.css', array(), false );
		wp_enqueue_style( 'magnific-poppup', get_template_directory_uri().'/assets/third-party/magnific-popup/magnific-popup.css', array(), false );

		wp_enqueue_style( 'newsnote-style', get_template_directory_uri().'/assets/css/style.min.css', array(), false );


		/*
		 * Enqueue Styles
		 */
		wp_enqueue_script( 'juqery' );

		wp_enqueue_script('jquery.flexmenu', get_template_directory_uri().'/assets/third-party/flexmenu/flexmenu.js', array('jquery'), '', true );

		wp_enqueue_script('jquery.newsTicker', get_template_directory_uri().'/assets/third-party/jquerynewsTicker/jquery.newsTicker.min.js', array('jquery'), '', true );

		wp_enqueue_script('jquery.marquee', get_template_directory_uri().'/assets/third-party/jquery-marquee/jquery.marquee.js', array('jquery'), '', true );

		wp_enqueue_script('jquery.newsTicker', get_template_directory_uri().'/assets/third-party/resize-sensor/ResizeSensor.min.js', array('jquery'), '', true );

		wp_enqueue_script('sticky-sidebar', get_template_directory_uri().'/assets/third-party/sticky-sidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true );

		wp_enqueue_script('imagesloaded', get_template_directory_uri().'/assets/third-party/imagesloaded/imagesloaded.pkgd.min.js', array('jquery'), '', true );
		wp_enqueue_script('isotopes', get_template_directory_uri().'/assets/third-party/isotopes/isotope.min.js', array('jquery'), '', true );
		wp_enqueue_script('slickslider', get_template_directory_uri().'/assets/third-party/slickslider/slick.min.js', array('jquery'), '', true );
		wp_enqueue_script('jquery.magnific-popup', get_template_directory_uri().'/assets/third-party/magnific-popup/jquery.magnific-popup.js', array('jquery'), '', true );
		if ( is_singular() ){
			wp_enqueue_script( "comment-reply" );
		}

		wp_enqueue_script( 'custom', get_template_directory_uri().'/assets/js/custom.js', array('jquery'), '', true );

		$output_css = '';
		$categories = get_categories( array( 'hide_empty' => 0 ) );
		foreach ( $categories as $category_details ) {
			$category_slug = $category_details->slug;
			$category_colorcode = get_theme_mod( 'newsnote_category_color_'.$category_slug, '#4db2ec' );
			$output_css .= ".cat-{$category_slug}{
				background-color:".esc_attr($category_colorcode).";
			}\n";

		}

		wp_add_inline_style( 'newsnote-style', $output_css );


	}

}

