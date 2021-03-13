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
class Author extends Widget{

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'author_info', 'description' => 'Please show your author information.' );
		parent::__construct( 'author_info', esc_html__('NM: Author Info', 'newsnote'), $widget_ops );
	}

	public function fields(){

		$fields = array(
			'title' => array(
				'name' => 'title',
				'type' => 'text',
				'default' => '',
				'title' => esc_html__( 'Title', 'newsnote' ),
			),
			'author_id' => array(
				'name' => 'author_id',
				'type' => 'select',
				'default' => '',
				'choices' => newsnote_author_listing(),
				'title' => esc_html__( 'Author ID', 'newsnote' ),
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
		$author_id    = isset($instance['author_id']) ? absint( $instance['author_id'] ) : 0;
		if($author_id):
			$description = get_the_author_meta( 'description', $author_id ); 
			$author_link = get_author_posts_url( get_the_author_meta( 'ID', $author_id ) );
			echo $before_widget;
			?>
			<div class="author-info">
				<?php
				if($title){
					echo $before_title.esc_html($title).$after_title;    
				}
				?>
				<div class="card-profile">
					<div class="card-avatar">
						<a href="<?php echo esc_url($author_link); ?>"><?php 
						echo get_avatar( get_the_author_meta( 'ID', $author_id ), 500 ); 
						?></a>
					</div>
					<div class="card-content">
						<h4 class="card-title"><?php echo esc_html(get_the_author_meta( 'display_name', $author_id )); ?></h4>
						<div class="card-description">
							<p><?php echo esc_html($description); ?></p>
						</div>
						<div class="card-detail-more">
							<a href="<?php echo esc_url($author_link); ?>"><?php esc_html_e( 'Read More', 'newsnote' ); ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php
		endif;
		echo $after_widget;

	}


}
