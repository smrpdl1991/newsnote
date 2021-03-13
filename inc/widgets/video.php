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
class Video extends Widget{

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'video_gallery', 'description' => 'Please show your author information.' );
		parent::__construct( 'video_gallery', esc_html__('NM: Tab Gallery', 'newsnote'), $widget_ops );
	}

	public function fields(){

		$fields = array(
			'title' => array(
				'name' => 'title',
				'type' => 'text',
				'default' => '',
				'title' => esc_html__( 'Title', 'newsnote' ),
			),
			'post_category' => array(
				'name' => 'post_category',
				'type' => 'select',
				'default' => '',
				'title' => esc_html__( 'Post Category', 'newsnote' ),
				'choices' => newsnote_term_list()
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
		$post_category = (isset($instance['post_category'])) ? $instance['post_category'] : '';

		echo $before_widget;
		?>
		<div class="video-gallery-section">
			<!-- <div class="heading"> -->
				<?php
				if($title){
					echo $before_title.esc_html($title).$after_title;    
				}
				$slider_query = array(
					'post_type' => 'post',
					'posts_per_page' => 5, 
					'post_status'	=> 'publish',
				);
				if($post_category){
					$slider_query['cat'] = array(absint($post_category));
				}
				?>
				<!-- </div> -->
				<div class="news-layout-wrap">
					<div class="video-tabs">
						<div class="video-titles">
							<ul>
								<?php 
								$video_tabs = new \WP_Query($slider_query);
								$first_index = true;
								while($video_tabs->have_posts()): $video_tabs->the_post();
									global $post;
									$active_class = ($first_index) ? 'current' : '';
									$first_index = false;
									?>
									<li class="title <?php echo esc_attr($active_class); ?>" data-tab="<?php echo esc_attr($post->post_name); ?>">
										<?php the_title(); ?>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
						<div class="video-container">
							<?php 
							$video_query = new \WP_Query($slider_query);
							$first_index = true;
							while($video_query->have_posts()): $video_query->the_post(); 
								$active_class = ($first_index) ? 'current' : '';
								$first_index = false;
								?>
								<div class="tab-content <?php echo esc_attr($post->post_name); ?> <?php echo esc_attr($active_class); ?>">
									<article <?php post_class(); ?>>
										<?php if(has_post_thumbnail()){ ?>
											<figure>
												<?php the_post_thumbnail(); ?>
											</figure>
										<?php } ?>

										<div class="post-content">
											
											<?php newsnote_cat_list(); ?>
											<header class="entry-header">
												<h4 class="entry-title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h4>
											</header>
											<div class="entry-content">
												<?php the_excerpt(); ?>
											</div>
											<?php newsnote_entry_meta(true, true, true, true); ?>
										</div>

										<?php
										$link = '';
										$post_format = get_post_format();
										switch ($post_format) {
											case 'image':
											$link = wp_get_attachment_thumb_url( get_the_ID() );
											case 'video':
											$link = newsnote_video_format_link();
											if($link){
												$link = get_the_permalink();
											}
											break;
										}
										if($link){
											switch ($post_format) {
												case 'image':
												?>
												<a class="image-icon" href="<?php echo esc_attr($link); ?>"></a>
												<?php
												break;
												case 'video':
												?>
												<a class="video-icon" href="<?php echo esc_attr($link); ?>"></a>
												<?php
												break;
											}
										}
										?>
									</article>
								</div>
							<?php endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
			echo $after_widget;

		}


	}
