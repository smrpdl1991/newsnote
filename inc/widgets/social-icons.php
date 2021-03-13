<?php
/**
 * @package: NewsNote
 * @subpackage: NewsNote
 * @author: NewsNote
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since 1.0.0
 */
namespace NewsNote\Inc\Widgets;
use NewsNote\Inc\Base\Widget;
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class Social_Icons extends Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_social_share', 'description' => 'Please set your social icons to connect with your customers' );
		parent::__construct( 'widget_social_share', esc_html__('NM: Social Icons', 'newsnote'), $widget_ops );
	}

	public function fields(){

		$fields = array(
			'title' => array(
				'name' => 'title',
				'type' => 'text',
				'default' => '',
				'title' => esc_html__( 'Title', 'newsnote' ),
				'description'=> sprintf( esc_html__( 'To add social icons please go click  %s here %s or Custoizer >> Theme Options >> Social Media and add link from there.', 'newsnote' ), '<a target="_blank" href="'.admin_url('customize.php').'?autofocus[section]=newsnote_social_media">', '</a>'),
			),
		);

		return $fields;

	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array  An array of standard parameters for widgets in this theme
	 * @param array  An array of settings for this widget instance
	 * @return void Echoes it's output
	 */
	function widget( $args, $instance ) {


		$before_title = (isset($args['before_title'])) ? $args['before_title'] : '';
		$after_title = (isset($args['after_title'])) ? $args['after_title'] : '';
		$before_widget = (isset($args['before_widget'])) ? $args['before_widget'] : '';
		$after_widget = (isset($args['after_widget'])) ? $args['after_widget'] : '';

		$title = (isset($instance['title'])) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $before_widget;

		if($title){
			echo $before_title.esc_html($title).$after_title;    
		}
		$link_string = get_theme_mod( 'newsnote_social_links' );
		if($link_string):
			$social_links = explode( ',', $link_string );
			$show_links = get_theme_mod( 'topbar_show_social_links', true );
			if($social_links && $show_links):
				?>
				<div class="social-links">
					<ul>
						<?php foreach($social_links as $link): ?>
							<li>
								<a target="_blank" href="<?php echo esc_url($link); ?>"></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php
			endif;
		endif;
		echo $after_widget;

	}

}
