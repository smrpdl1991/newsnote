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
class Tab_Posts extends Widget{

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'tabbed_posts', 'description' => 'Please set your social icons to connect with your customers' );
		parent::__construct( 'tabbed_posts', esc_html__('NM: Tab Posts', 'newsnote'), $widget_ops );
	}


	public function fields(){

		$fields = array(
			'latest_title' => array(
				'name' => 'latest_title',
				'type' => 'text',
				'default' => '',
				'title' => esc_html__( 'Latest Title', 'newsnote' ),
			),
			'popular_title' => array(
				'name' => 'popular_title',
				'type' => 'text',
				'default' => '',
				'title' => esc_html__( 'Popular Title', 'newsnote' ),
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
		$latest_title = (isset($instance['latest_title'])) ? $instance['latest_title'] : '';
		$popular_title = (isset($instance['popular_title'])) ? $instance['popular_title'] : '';
		echo $before_widget;
		?>
		<div class="tab-section">   
			<div class="tab-section-wrap">
				<div class="heading">
					<ul>
						<li class="tab-link current" data-tab="latest">
							<?php echo esc_html($latest_title); ?>
						</li>
						<li class="tab-link" data-tab="popular">
							<?php echo esc_html($popular_title); ?>
						</li>
					</ul>
				</div>
				<div class="latest tab-content current">
					<?php
					$latest_args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => 5,
					);
					$latest_query = new \WP_Query($latest_args);
					while($latest_query->have_posts()):
						$latest_query->the_post();
						?>
						<article class="post">
							<?php if(has_post_thumbnail()): ?>
								<figure>
									<?php the_post_thumbnail(); ?>
								</figure>
							<?php endif; ?>
							<div class="post-content">
								<header class="entry-header">
									<h4 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title();  ?></a>
									</h4>
								</header>
								<?php newsnote_entry_meta(true, false, false, false); ?>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<div class="popular tab-content">
					<?php
					$popular_args = array(
						'post_type' => 'post',
						'posts_per_page'=> 5,
						'orderby'	=> 'comment_count',
					);
					$popular_query = new \WP_Query($popular_args);
					while($popular_query->have_posts()):
						$popular_query->the_post();
						?>
						<article class="post">
							<?php if(has_post_thumbnail()): ?>
								<figure>
									<?php the_post_thumbnail();?>
								</figure>
							<?php endif; ?>
							<div class="post-content">
								<header class="entry-header">
									<h4 class="entry-title">
										<a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
									</h4>
								</header>
								<?php newsnote_entry_meta(true, false, false, false); ?>
							</div>
						</article>      
					<?php endwhile; ?>    
				</div>
			</div>
		</div>
		<?php
		echo $after_widget;
		wp_reset_postdata();

	}


}
