<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Customizer;
class Templates{

	public function __construct(){

		add_action('customize_register', array( $this, 'register' ) );

	}


	public function register( $wp_customize ){

		$wp_customize->add_panel(
			'newsnote_templates_options',
			array(
				'priority'       => 15,
				'capability'     => 'edit_theme_options',
				'title'          => esc_html__( 'Templates', 'newsnote' ),
			)
		);

		$home_page = $wp_customize->get_section( "static_front_page" );
		if($home_page){
			$home_page->panel = 'newsnote_templates_options';
		}

		$wp_customize->add_section(
			'newsnote_archive_options',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'title'          => esc_html__( 'Archive Options', 'newsnote' ),
				'panel'			=> 'newsnote_templates_options',
			)
		);


		$wp_customize->add_setting(
			'newsnote_page_listing_layout',
			array(
				'default' => 'list',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'newsnote_page_listing_layout',
			array(
				'label' => esc_html__( 'Archive Layout', 'newsnote' ),
				'description' => esc_html__( 'Sidebar related settings goes here.', 'newsnote' ),
				'type' => 'select',
				'section'=> 'newsnote_archive_options',
				'choices' => array(
					'list' => esc_html__( 'List Layout', 'newsnote' ),
					'grid' => esc_html__( 'Grid Layout', 'newsnote' ),
					'masonery' => esc_html__( 'Masonery Layout', 'newsnote' )
				)
			)
		);

		$wp_customize->add_setting(
			'newsnote_archive_no_of_column',
			array(
				'default' => '3',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'newsnote_archive_no_of_column',
			array(
				'label' => esc_html__( 'No of column', 'newsnote' ),
				'type' => 'select',
				'section'=> 'newsnote_archive_options',
				'active_callback' => 'newsnote_archive_column_callback',
				'choices' => array(
					'1' => esc_html__( 'Column One', 'newsnote' ),
					'2' => esc_html__( 'Column Two', 'newsnote' ),
					'3' => esc_html__( 'Column Three', 'newsnote' ),
					'4' => esc_html__( 'Column Four', 'newsnote' ),
					'5' => esc_html__( 'Column Five', 'newsnote' ),
					'6' => esc_html__( 'Column Six', 'newsnote' ),
				)
			)
		);



	}


	public function __destruct(){

	}

}