<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Customizer;
class Header_Options{

	public function __construct(){

		add_action('customize_register', array( $this, 'register' ) );

	}


	public function register( $wp_customize ){

		$wp_customize->add_panel(
			'newsnote_header_options',
			array(
				'priority'       => 15,
				'capability'     => 'edit_theme_options',
				'title'          => esc_html__( 'Header', 'newsnote' ),
			)
		);

		$header_image = $wp_customize->get_section('header_image');
		if($header_image){
			$header_image->priority = 5;
			$header_image->panel = 'newsnote_header_options';
		}

		$wp_customize->add_section(
			'newsnote_header_topbar',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'title'          => esc_html__( 'Top Bar', 'newsnote' ),
				'panel'			=> 'newsnote_header_options',
			)
		);

		$wp_customize->add_setting(
			'topbar_show_date',
			array(
				'default' => 1,
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(
			'topbar_show_date',
			array(
				'type'			=> 'checkbox',
				'label'          => esc_html__( 'Show date?', 'newsnote' ),
				'section'			=> 'newsnote_header_topbar',
			)
		);

		$wp_customize->add_setting(
			'topbar_show_search_icon',
			array(
				'default' => 1,
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(
			'topbar_show_search_icon',
			array(
				'type'			=> 'checkbox',
				'label'          => esc_html__( 'Show search icon?', 'newsnote' ),
				'section'			=> 'newsnote_header_topbar',
			)
		);

		$wp_customize->add_setting(
			'topbar_show_social_links',
			array(
				'default' => 1,
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(
			'topbar_show_social_links',
			array(
				'type'			=> 'checkbox',
				'label'          => esc_html__( 'Show social links?', 'newsnote' ),
				'section'			=> 'newsnote_header_topbar',
			)
		);

		$title_tagline = $wp_customize->get_section('title_tagline');
		if($title_tagline){
			$title_tagline->priority = 15;
			$title_tagline->panel = 'newsnote_header_options';
		}
		$wp_customize->add_setting(
			'branding_background_image',
			array(
				'default' => '',
				'sanitize_callback' => 'sanitize_url'
			)
		);
		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				'branding_background_image',
				array(
					'label'          => esc_html__( 'Background Image', 'newsnote' ),
					'section'			=> 'title_tagline',
				)
			)
		);

		$wp_customize->add_setting(
			'newsnote_branding_alignment',
			array(
				'default' => 'left',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'newsnote_branding_alignment',
			array(
				'type'			=> 'select',
				'label'          => esc_html__( 'Alignment Items', 'newsnote' ),
				'choices'				=> array(
					'left'		=> esc_html__('Left Align', 'newsnote'),
					'right'		=> esc_html__('Right Align', 'newsnote'),
					'center'		=> esc_html__('Center Align', 'newsnote')
				),
				'section'			=> 'title_tagline'
			)
		);

		$wp_customize->add_section(
			'newsnote_header_navigation',
			array(
				'priority'       => 20,
				'capability'     => 'edit_theme_options',
				'title'          => esc_html__( 'Navigation Menu', 'newsnote' ),
				'panel'			=> 'newsnote_header_options',
			)
		);

		$wp_customize->add_setting(
			'navigation_show_search_icon',
			array(
				'default' => 1,
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(
			'navigation_show_search_icon',
			array(
				'type'			=> 'checkbox',
				'label'          => esc_html__( 'Show search icon?', 'newsnote' ),
				'section'			=> 'newsnote_header_navigation',
			)
		);
		$wp_customize->add_setting(
			'navigation_show_social_links',
			array(
				'default' => 1,
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(
			'navigation_show_social_links',
			array(
				'type'			=> 'checkbox',
				'label'          => esc_html__( 'Show social links?', 'newsnote' ),
				'section'			=> 'newsnote_header_navigation',
			)
		);
		$wp_customize->add_section(
			'newsnote_ticker_options',
			array(
				'priority'       => 20,
				'capability'     => 'edit_theme_options',
				'title'          => esc_html__( 'Ticker Options', 'newsnote' ),
				'panel'			=> 'newsnote_header_options',
			)
		);

		$wp_customize->add_setting(
			'newsnote_ticker_label',
			array(
				'default' => esc_html__('Recent News', 'newsnote'),
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'newsnote_ticker_label',
			array(
				'type'			=> 'text',
				'label'          => esc_html__( 'Ticker Label', 'newsnote' ),
				'section'			=> 'newsnote_ticker_options',
			)
		);


		$wp_customize->add_setting(
			'newsnote_ticker_layout',
			array(
				'default' => 'layout1',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'newsnote_ticker_layout',
			array(
				'type'			=> 'select',
				'choices'		=> array(
					'layout1'		=> esc_html__( 'Layout One', 'newsnote' ),
					'layout2'		=> esc_html__( 'Layout Two', 'newsnote' ),
				),
				'label'          => esc_html__( 'Ticker Layouts', 'newsnote' ),
				'section'			=> 'newsnote_ticker_options',
			)
		);

		$wp_customize->add_section(
			'newsnote_header_settings',
			array(
				'priority'       => 20,
				'capability'     => 'edit_theme_options',
				'title'          => esc_html__( 'Header Settings', 'newsnote' ),
				'panel'			=> 'newsnote_header_options',
			)
		);

		$wp_customize->add_setting(
			'newsnote_header_sections',
			array(
				'default' => 'header-image,top-header,branding,ticker,navigation',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			new \NewsNote_Pill_Checkbox_Custom_Control(
				$wp_customize,
				'newsnote_header_sections',
				array(
					'type'			=> 'text',
					'input_attrs' => array(
						'sortable' => true,
						'fullwidth' => true,
					),
					'choices' => array(
						'media' => esc_html__( 'Header Image', 'newsnote' ),
						'top' => esc_html__( 'Top Header', 'newsnote' ),
						'branding' => esc_html__( 'Branding', 'newsnote'  ),
						'ticker' => esc_html__( 'Ticker', 'newsnote'  ),
						'navigation' => esc_html__( 'Navigation', 'newsnote'  ),
					),
					'label'          => esc_html__( 'Sortable headers section', 'newsnote' ),
					'section'			=> 'newsnote_header_settings',
				)
			)
		);

	}


}