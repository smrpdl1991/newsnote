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
class Masonery_Posts extends Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'masonery_posts', 'description' => 'Please set your social icons to connect with your customers' );
		parent::__construct( 'masonery_posts', esc_html__('NM: Masonery Posts', 'newsnote' ), $widget_ops );
	}

	public function fields(){

		$fields = array(
			'title' => array(
				'name' => 'title',
				'type' => 'text',
				'default' => '',
				'title' => esc_html__( 'Title', 'newsnote' ),
			),
			'masonery_cat' => array(
				'name' => 'masonery_cat',
				'type' => 'select',
				'default' => '',
				'title' => esc_html__( 'Masonery Category', 'newsnote' ),
				'choices' => newsnote_term_list()
			),
			'remove_space' => array(
				'name' => 'remove_space',
				'type' => 'checkbox',
				'default' => 0,
				'title' => esc_html__( 'Remove space?', 'newsnote' ),
			),
			'absolute_content' => array(
				'name' => 'absolute_content',
				'type' => 'checkbox',
				'default' => 0,
				'title' => esc_html__( 'Absolute Content?', 'newsnote' ),
			),
			'no_of_posts' => array(
				'name' => 'no_of_posts',
				'type' => 'number',
				'default' => 10,
				'title' => esc_html__( 'No of posts?', 'newsnote' ),
			),
			'no_of_column' => array(
				'name' => 'no_of_column',
				'type' => 'select',
				'default' => 0,
				'title' => esc_html__( 'No of column', 'newsnote' ),
				'choices'	=> array(
					'column-one' => esc_html__( 'Column One', 'newsnote' ),
					'column-two' => esc_html__( 'Column Two', 'newsnote' ),
					'column-three' => esc_html__( 'Column Three', 'newsnote' ),
					'column-four' => esc_html__( 'Column Four', 'newsnote' ),
				)
			),
			'thumbnail_size' => array(
				'name' => 'thumbnail_size',
				'type' => 'select',
				'default' => 'newsnote-thumb-600x600',
				'title' => esc_html__( 'Thumbnail Size', 'newsnote' ),
				'choices'	=> newsnote_image_sizes()
			)

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
		$masonery_cat = (isset($instance['masonery_cat'])) ? $instance['masonery_cat'] : 0;
		$no_of_posts = (isset($instance['no_of_posts'])) ? $instance['no_of_posts'] : 10;
		$remove_space = (isset($instance['remove_space'])) ? $instance['remove_space'] : 0;
		$absolute_content = (isset($instance['absolute_content'])) ? $instance['absolute_content'] : 0;
		$no_of_column = (isset($instance['no_of_column'])) ? $instance['no_of_column'] : 'column-two';
		$thumbnail_size = (isset($instance['thumbnail_size'])) ? $instance['thumbnail_size'] : 'NewsNote-thumb-600x600';

		echo $before_widget;
		$masonery_class = ($remove_space) ? 'no-space ' : 'has-space ';
		$masonery_class .= ($absolute_content) ? 'absolute-content ' : 'normal-content ';
		if(!$no_of_column){
			$no_of_column = 'column-two';
		}
		$masonery_class.= $no_of_column;

		?>
		<div class="masonery-layout <?php echo esc_attr($masonery_class); ?>" data-space="<?php echo esc_attr($remove_space); ?>">
			<!-- column-one, column-two ,column-three, column-four-->
			<?php
			if($title){
				echo $before_title.esc_html($title).$after_title;    
			}
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $no_of_posts
			);
			if($masonery_cat){
				$args['cat'] = array(absint($masonery_cat));
			}
			$masonery_posts = new \WP_Query($args);
			if($masonery_posts->have_posts()):
				?>
				<div class="news-layout-wrap">
					<?php while($masonery_posts->have_posts()): $masonery_posts->the_post(); ?>
						<article <?php post_class(); ?>>
							<?php if(has_post_thumbnail()): ?>
								<figure>
									<?php the_post_thumbnail($thumbnail_size); ?>
								</figure>
							<?php endif; ?>
							<div class="post-content">
								<?php newsnote_cat_list(); ?>
								<header class="entry-header">
									<h4 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h4>
								</header>
								<?php newsnote_entry_meta(); ?>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
			<?php endif;  ?>
		</div>
		<!--masonery-layout end-->
		<?php
		echo $after_widget;
		wp_reset_postdata();

	}

}
