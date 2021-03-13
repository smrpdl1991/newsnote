<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Widgets;
class Index{

	public function __construct(){
		$this->hooks();
	}

	public function hooks(){
		add_action( 'widgets_init', array( $this, 'widgets' ) );
		add_action( 'widgets_init', array( $this, 'sidebars' ) );
	}

	public function widgets(){

		register_widget( '\\NewsNote\\Inc\Widgets\\Author' );
		register_widget( '\\NewsNote\\Inc\Widgets\\Video' );
		register_widget( '\\NewsNote\\Inc\Widgets\\Social_Icons' );
		register_widget( '\\NewsNote\\Inc\Widgets\\News_List' );
		register_widget( '\\NewsNote\\Inc\Widgets\\Popular_Posts' );
		register_widget( '\\NewsNote\\Inc\Widgets\\Featured_Posts' );
		register_widget( '\\NewsNote\\Inc\Widgets\\Slider_Widget' );
		register_widget( '\\NewsNote\\Inc\Widgets\\Tab_Posts' );
		register_widget( '\\NewsNote\\Inc\Widgets\\Masonery_Posts' );

	}

	public function sidebars(){

		/**
		 * Creates a sidebar
		 * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
		 */
		$args = array(
			'name'          => esc_html__( 'Left Sidebar', 'newsnote' ),
			'id'            => 'left-sidebar',
			'description'   => '',
			'class'         => '',
			'before_widget' => '<section id="%s" class="widget %s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="heading"><h2 class="widget-title">',
			'after_title'   => '</h2></div>',
		);
		
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Right Sidebar', 'newsnote' );
		$args['id']		= 'right-sidebar';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Header Area', 'newsnote' );
		$args['id']		= 'header-area';
		register_sidebar( $args );

		

		$args['name']	= esc_html__( 'Homepage Top Area', 'newsnote' );
		$args['id']		= 'hompage-top-area';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Homepage Left Area', 'newsnote' );
		$args['id']		= 'hompage-left-area';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Homepage Right Sidebar', 'newsnote' );
		$args['id']		= 'hompage-right-sidebar';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Homepage Left Sidebar', 'newsnote' );
		$args['id']		= 'hompage-left-sidebar';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Homepage Right Area', 'newsnote' );
		$args['id']		= 'hompage-right-area';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Homepage Both Sidebar(Left)', 'newsnote' );
		$args['id']		= 'hompage-bothsidebar-left';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Homepage Both Sidebar(Content)', 'newsnote' );
		$args['id']		= 'hompage-bothsidebar-content';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Homepage Both Sidebar(right)', 'newsnote' );
		$args['id']		= 'hompage-bothsidebar-right';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Homepage Bottom Area', 'newsnote' );
		$args['id']		= 'hompage-bottom-area';
		register_sidebar( $args );

		$args['name']	= esc_html__( 'Footer Area %d', 'newsnote' );
		$args['id']		= 'footer-sidebar';
		register_sidebars( 3, $args );
		
	}

}