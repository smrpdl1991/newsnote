<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Customizer;
class Footer_Options{

	public function __construct(){

		add_action('customize_register', array( $this, 'register' ) );

	}

	public function register( $wp_customize ){

		$wp_customize->add_panel( 
			'newsnote_footer_options',
			array(
				'priority' => 20,
				'title'		=> esc_html__( 'Footer', 'newsnote' ),
			)
		);

		$wp_customize->add_section(
			'footer_bottom_options',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'title'          => esc_html__( 'Botom Footer', 'newsnote' ),
				'panel'			=> 'newsnote_footer_options',
			)
		);

		$wp_customize->add_setting(
			'copyright_text_bottom',
			array(
				'default' => esc_html__( '2020 Theme Company All Rights Reserved Privacy Policy ', 'newsnote' ),
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'copyright_text_bottom',
			array(
				'type'			=> 'text',
				'label'          => esc_html__( 'Copyright Text', 'newsnote' ),
				'section'			=> 'footer_bottom_options',
			)
		);

	}

}