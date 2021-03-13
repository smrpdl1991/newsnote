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
class News_List extends Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'list_post_news', 'description' => 'Please set your social icons to connect with your customers' );
		parent::__construct( 'list_post_news', esc_html__('NM: News List', 'newsnote'), $widget_ops );
	}

	public function fields(){

		$fields = array(
			'title' => array(
				'name' => 'title',
				'type' => 'text',
				'default' => '',
				'title' => esc_html__( 'Title', 'newsnote' ),
			),
			'news_layout' => array(
				'name' => 'news_layout',
				'type' => 'select',
				'default' => '',
				'choices' => array(
					'layout_one' => esc_html__( 'Layout One', 'newsnote' ),
					'layout_two' => esc_html__( 'Layout Two', 'newsnote' ),
					'layout_three' => esc_html__( 'Layout Three', 'newsnote' ),
					'layout_four' => esc_html__( 'Layout Four', 'newsnote' ),
					'tabs_news' => esc_html__( 'Tabs News', 'newsnote' ),
				),
				'title' => esc_html__( 'Layouts', 'newsnote' ),
			),
			'news_category' => array(
				'name' => 'news_category',
				'type' => 'multiple',
				'default' => '',
				'title' => esc_html__( 'Slider Category', 'newsnote' ),
				'choices' => newsnote_term_list()
			),
			'no_of_column' => array(
				'name' => 'no_of_column',
				'type' => 'select',
				'default' => '',
				'title' => esc_html__( 'No of column(This is only work when you choose tab news layout)', 'newsnote' ),
				'choices' => array(
					'column1' => esc_html__( 'Column One', 'newsnote' ),
					'column2' => esc_html__( 'Column Two', 'newsnote' ),
					'column3' => esc_html__( 'Column Three', 'newsnote' ),
					'column4' => esc_html__( 'Column Four', 'newsnote' ),
				)
			),
			'thumbnail_size' => array(
				'name' => 'thumbnail_size',
				'type' => 'select',
				'default' => 'NewsNote-thumb-600x600',
				'title' => esc_html__( 'Thumbnail Size', 'newsnote' ),
				'choices'	=> newsnote_image_sizes()
			),
			'excerpt_length' => array(
				'name' => 'excerpt_length',
				'type' => 'number',
				'default' => '20',
				'title' => esc_html__( 'Excerpt Length', 'newsnote' ),
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
		$news_layout = (isset($instance['news_layout'])) ? $instance['news_layout'] : 'layout_one';
		

		echo $before_widget;

		if( $title && $news_layout!='tabs_news' ){
			echo $before_title.esc_html($title).$after_title;    
		}
		switch ($news_layout) {
			case 'layout_one':
			case 'layout_two':
			case 'layout_three':
			case 'layout_four':
			case 'tabs_news':
			$this->$news_layout($instance);
			break;
			default:
			$this->layout_one($instance);
			break;
		}
		echo $after_widget;
		wp_reset_query();
		wp_reset_postdata();

	}

	public function layout_one($instance){

		$thumbnail_size = (isset($instance['thumbnail_size'])) ? $instance['thumbnail_size'] : 'NewsNote-thumb-600x600';
		$excerpt_length = (isset($instance['excerpt_length'])) ? $instance['excerpt_length'] : 20;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 5,
			'post_status' => 'publish',
		);
		$news_category = (isset($instance['news_category'])) ? $instance['news_category'] : array();
		if($news_category){
			$args['cat'] = $news_category;
		}
		$query = new \WP_Query($args);
		?>
		<div class="news-layout-one">
			<div class="news-layout-wrap">
				<?php while($query->have_posts()): $query->the_post(); ?>
					<article <?php post_class(); ?>>
						<figure>
							<?php the_post_thumbnail($thumbnail_size); ?>
						</figure>
						<div class="post-content">
							<?php newsnote_cat_list(); ?>
							<header class="entry-header">
								<h4 class="entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h4>
							</header>
							<div class="entry-content">
								<?php newsnote_excerpt($excerpt_length); ?>
							</div>
							<?php newsnote_entry_meta(); ?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
		<?php
	}

	public function layout_two($instance){

		$thumbnail_size = (isset($instance['thumbnail_size'])) ? $instance['thumbnail_size'] : 'NewsNote-thumb-600x600';
		$excerpt_length = (isset($instance['excerpt_length'])) ? $instance['excerpt_length'] : 20;

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 4,
			'post_status' => 'publish',
		);
		$news_category = (isset($instance['news_category'])) ? $instance['news_category'] : array();
		if($news_category){
			$args['cat'] = $news_category;
		}
		$query = new \WP_Query($args);
		?>
		<div class="news-layout-two">
			<div class="news-layout-wrap">
				<?php while($query->have_posts()): $query->the_post(); ?>
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
			</div>
		</div>
		<?php
	}

	public function layout_three($instance){

		$thumbnail_size = (isset($instance['thumbnail_size'])) ? $instance['thumbnail_size'] : 'NewsNote-thumb-600x600';
		$excerpt_length = (isset($instance['excerpt_length'])) ? $instance['excerpt_length'] : 20;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 6,
			'post_status' => 'publish',
		);
		$news_category = (isset($instance['news_category'])) ? $instance['news_category'] : array();
		if($news_category){
			$args['cat'] = $news_category;
		}
		$query = new \WP_Query($args);
		?>
		<div class="news-layout-three">
			<div class="news-layout-wrap">
				<?php 
				while($query->have_posts()):
					$query->the_post(); 
					?>
					<article class="post">
						<?php if(has_post_thumbnail()): ?>
							<figure>
								<?php the_post_thumbnail($thumbnail_size); ?>
							</figure>
						<?php endif; ?>
						<div class="post-content">
							<header class="entry-header">
								<h4 class="entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h4>
							</header>
							<div class="entry-content">
								<?php newsnote_excerpt($excerpt_length); ?>
							</div>
							<?php newsnote_entry_meta(true, false, false, false); ?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
		<?php
	}

	public function layout_four($instance){

		$thumbnail_size = (isset($instance['thumbnail_size'])) ? $instance['thumbnail_size'] : 'NewsNote-thumb-600x600';
		$excerpt_length = (isset($instance['excerpt_length'])) ? $instance['excerpt_length'] : 20;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 5,
			'post_status' => 'publish',
		);
		$news_category = (isset($instance['news_category'])) ? $instance['news_category'] : array();
		if($news_category){
			$args['cat'] = $news_category;
		}
		$query = new \WP_Query($args);
		?>
		<div class="news-layout-four">
			<div class="news-layout-wrap">
				<?php while($query->have_posts()): $query->the_post(); ?>
					<article class="post">
						<?php if(has_post_thumbnail()): ?>
							<figure>
								<?php the_post_thumbnail($thumbnail_size); ?>
							</figure>
						<?php endif; ?>
						<div class="post-content">
							<header class="entry-header">
								<h4 class="entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h4>
							</header>
							<?php newsnote_entry_meta(true, false, false, false); ?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
		<?php
	}

	public function tabs_news($instance){

		$title = (isset($instance['title'])) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$news_category = (isset($instance['news_category'])) ? $instance['news_category'] : array();
		$no_of_column = (isset($instance['no_of_column'])) ? $instance['no_of_column'] : 'column3';
		$thumbnail_size = (isset($instance['thumbnail_size'])) ? $instance['thumbnail_size'] : 'NewsNote-thumb-600x600';
		$excerpt_length = (isset($instance['excerpt_length'])) ? $instance['excerpt_length'] : 20;
		
		?>
		<div class="news-on-tab">
			<div class="news-on-tab-wrap">
				<div class="heading">
					<h2 class="entry-title"><?php echo esc_html($title); ?></h2>
					<?php if($news_category){ ?>
						<ul class="tab-list">
							<?php
							$first_class = true;
							foreach($news_category as $cat_id){ 
								if(!$cat_id){
									continue;
								}
								$active_class = ($first_class) ? 'current' : '';
								$first_class = false;
								$cat_details = get_category( $cat_id );
								?>
								<li class="tab <?php echo esc_attr($active_class); ?>" data-tab="<?php echo $cat_details->slug; ?>">
									<?php echo $cat_details->name; ?>		
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
				</div>
				<?php 
				$first_class = true;
				foreach($news_category as $cat_id ){ 
					if(!$cat_id){
						continue;
					}
					$active_class = ($first_class) ? 'current' : '';
					$first_class = false;
					$cat_details = get_category( $cat_id );
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 6,
						'post_status' => 'publish',
						'cat' => $cat_id,
					);
					$query = new \WP_Query($args);
					?>
					<div class="tab-content <?php echo esc_attr($cat_details->slug.' '.$active_class); ?>">
						<div class="news-wrap <?php echo esc_attr($no_of_column); ?>">
							<?php while($query->have_posts()):$query->the_post(); ?>
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
										<?php newsnote_entry_meta(true, false, false, false); ?>
									</div>
								</article>
							<?php endwhile; ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}

}
