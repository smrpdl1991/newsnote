<?php
/**
 * @package: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Customizer;
class Theme_Options{

	public function __construct(){
		add_action('customize_register', array( $this, 'register' ) );
	}

	public function register($wp_customize){

		$wp_customize->add_panel(
			'newsnote_theme_options',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'title'          => esc_html__( 'Theme Options', 'newsnote' ),
			)
		);

		$background_image = $wp_customize->get_section('background_image');
		if($background_image){
			$background_image->panel = 'newsnote_theme_options';
		}

		$wp_customize->add_section(
			'newsnote_global_options',
			array(
				'title' => esc_html__( 'Global Options', 'newsnote' ),
				'description' => esc_html__('Global options settings goes here.', 'newsnote'),
				'panel' 	=> 'newsnote_theme_options',
			)
		);

		$wp_customize->add_setting(
			'newsnote_sidebar_layout',
			array(
				'default' => 'right-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'newsnote_sidebar_layout',
			array(
				'type' => 'select',
				'section'=> 'newsnote_global_options',
				'choices' => array(
					'left-sidebar' => esc_html__( 'Left Sidebar', 'newsnote' ),
					'right-sidebar' => esc_html__( 'Right Sidebar', 'newsnote' ),
					'no-sidebar' => esc_html__( 'No Sidebar', 'newsnote' ),
					'both-sidebar' => esc_html__( 'Both Sidebar', 'newsnote' ),
					'no-sidebar-center' => esc_html__( 'No Sidebar center', 'newsnote' ),
				),
				'label' => esc_html__( 'Sidebar Layout', 'newsnote' ),
				'description' => esc_html__( 'Sidebar related settings goes here.', 'newsnote' ),
			)
		);
		
		

		$wp_customize->add_setting(
			'newsnote_excerpt_length',
			array(
				'default' => '55',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(
			'newsnote_excerpt_length',
			array(
				'label' => esc_html__( 'Excerpt Length', 'newsnote' ),
				'type' => 'number',
				'section'=> 'newsnote_global_options',			
			)
		);


		$wp_customize->add_section(
			'newsnote_social_media',
			array(
				'title' => esc_html__( 'Social Links', 'newsnote' ),
				'description' => esc_html__('You can add or social media links from there.', 'newsnote'),
				'panel' 	=> 'newsnote_theme_options',
			)
		);

		$wp_customize->add_setting(
			'newsnote_social_links',
			array(
				'default' => '',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			new \NewsNote_Sortable_Repeater_Custom_Control(
				$wp_customize,
				'newsnote_social_links',
				array(
					'label'          => esc_html__( 'Social Links', 'newsnote' ),
					'section'			=> 'newsnote_social_media',
					'button_labels' => array(
						'add' => esc_html__( 'Add Icon', 'newsnote' )
					)
				)
			)
		);

		$wp_customize->add_section(
			'newsnote_categories_color_options',
			array(
				'priority'      => 20,
				'title'         => esc_html__( 'Category Colors', 'newsnote' ),
				'panel'         => 'newsnote_theme_options',
			)
		);

		$priority = 10;

		$categories = get_categories( array( 'hide_empty' => 0 ) );

		foreach ( $categories as $category_list ) {

			$wp_customize->add_setting( 
				'newsnote_category_color_'.esc_attr( strtolower( $category_list->slug ) ),
				array(
					'default'              => '#4db2ec',
					'capability'           => 'edit_theme_options',
					'sanitize_callback'    => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_control( 
				new \WP_Customize_Color_Control(
					$wp_customize, 
					'newsnote_category_color_'.esc_attr( strtolower( $category_list->slug ) ),
					array(
						/* translators: %s: Category Name */
						'label'    => sprintf( esc_html__( ' %s Button Background', 'newsnote' ), esc_attr( $category_list->name ) ),
						'section'  => 'newsnote_categories_color_options',
						'priority' => $priority
					)
				)
			);

			$priority+=10;

		}

	}

}