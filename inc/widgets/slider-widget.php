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
class Slider_Widget extends Widget{

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'slider-post-widget', 'description' => 'Please set your slider widget to frontend ara.' );
		parent::__construct( 'widget_post_slider', esc_html__('NM: Slider Widget', 'newsnote'), $widget_ops );
	}

	public function fields(){

		$fields = array(
			'title' => array(
				'name' => 'title',
				'type' => 'text',
				'default' => '',
				'title' => esc_html__( 'Title', 'newsnote' ),
			),
			'slider_cat' => array(
				'name' => 'slider_cat',
				'type' => 'select',
				'default' => '',
				'title' => esc_html__( 'Carousel Category', 'newsnote' ),
				'choices' => newsnote_term_list()
			),
			'remove_space' => array(
				'name' => 'remove_space',
				'type' => 'checkbox',
				'default' => 0,
				'title' => esc_html__( 'Remove space?', 'newsnote' ),
			),
			'no_of_column' => array(
				'name' => 'no_of_column',
				'type' => 'select',
				'default' => 0,
				'title' => esc_html__( 'No of column', 'newsnote' ),
				'choices'	=> array(
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
					'5' => 5
				)
			),
			'no_of_posts' => array(
				'name' => 'no_of_posts',
				'type' => 'select',
				'default' => 10,
				'title' => esc_html__( 'No of Posts', 'newsnote' ),
				'choices'	=> array(
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
					'5' => 5,
					'6' => 6,
					'7' => 7,
					'8' => 8,
					'9' => 9,
					'10' => 10,
					'11' => 11,
					'12' => 12,
					'13' => 13,
					'14' => 14,
					'15' => 15,
					'16' => 16,
					'17' => 17,
					'18' => 18,
					'19' => 19,
					'110' => 20
				)
			),
			'thumbnail_size' => array(
				'name' => 'thumbnail_size',
				'type' => 'select',
				'default' => 'NewsNote-thumb-600x600',
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
		$slider_cat = (isset($instance['slider_cat'])) ? $instance['slider_cat'] : '';
		$remove_space = (isset($instance['remove_space'])) ? $instance['remove_space'] : 0;
		$no_of_column = (isset($instance['no_of_column'])) ? $instance['no_of_column'] : 3;
		$no_of_posts = (isset($instance['no_of_posts'])) ? $instance['no_of_posts'] : 10;
		$thumbnail_size = (isset($instance['thumbnail_size'])) ? $instance['thumbnail_size'] : 'NewsNote-thumb-600x600';
		if(!absint($no_of_column)){
			$no_of_column = 3;
		}

		echo $before_widget;

		if($title){
			echo $before_title.esc_html($title).$after_title;    
		}
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $no_of_posts,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
					'compare' => 'EXISTS'
				),
			)
		);
		if($slider_cat){
			$args['cat'] = array(absint($slider_cat));
		}
		$slider_query = new \WP_Query($args);
		$wraper_class = ($remove_space) ? 'no-space ' : 'has-space ';
		$wraper_class.= 'column-'.$no_of_column;
		?>
		<div class="carousel-news">
			<div class="carousel-news-wrap <?php echo esc_attr($wraper_class); ?>" data-column="<?php echo esc_attr($no_of_column); ?>" data-removespace="<?php echo esc_attr($remove_space); ?>">
				<?php while($slider_query->have_posts()): $slider_query->the_post(); ?>
					<article class="post">
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
				<!--article-->
			</div>
			<!--carousel-news-wrap end-->
		</div>
		<?php
		echo $after_widget;
		wp_reset_postdata();

	}

}
