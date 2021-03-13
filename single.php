<?php

/**
 * @package NewsNote
 * @subpackage NewsNote
 * @since 1.0.0
 */
get_header();
?>
<div id="content" class="site-content">
	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<?php while (have_posts()) : the_post(); ?>
					<article <?php post_class('featured-post'); ?>>
						<figure class="featured-post-image">
							<?php the_post_thumbnail('full'); ?>
						</figure>
						<div class="post-content">
							<header class="entry-header">
								<?php the_title('<h1 class="entry-title">', '<h1>'); ?>
							</header>
							<?php newsnote_cat_list() ?>
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</div>
					</article>
					<?php
					newsnote_tag_list();
					the_post_navigation();

					$post_author_id = get_post_field('post_author', get_the_ID());
					if (!$post_author_id) {
						$post_author_id = get_the_author_meta('ID');
					}
					// Get user object
					$current_author = get_user_by('ID', $post_author_id);
					// Get user display name
					$author_name = (isset($current_author->display_name)) ? $current_author->display_name : '';
					$author_img = get_avatar($post_author_id, 100, '', '', array('class' => 'avatar-img'));
					?>
					<section class="widget widget-post-author">
						<figure class="avatar">
							<?php echo $author_img; ?>
						</figure>
						<div class="author-details">
							<h3><?php echo $author_name; ?></h3>
							<p><?php the_author_meta('description', $post_author_id); ?></p>
							<div class="author-info-wrap">
								<?php do_action('newsnote_author_social_link', $post_author_id); ?>
								<div class="author-info">
									<?php esc_html_e('view all posts by', 'newsnote'); ?>
									<span class="author vcard">
										<?php echo get_the_author_link() ?>
									</span>
								</div>
							</div>
						</div>
					</section>
					<?php

					wp_link_pages();

					if (comments_open() || get_comments_number()) {
						comments_template();
					}
					?>
				<?php endwhile; ?>
			</main>
			<!--.site-main-->
		</div>
		<!--#primary-->
		<?php get_sidebar(); ?>
	</div>
	<!--.container-->
	<?php
	$cats = wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) );
	$related_query = new \WP_Query(
		array(
			'post_type'	=> 'post',
			'posts_per_page' => 4,
			'cats' => $cats
		)
	);
	?>
	<section class="related-post">
		<div class="container">
			<div class="heading">
				<h2 class="widget-title"><?php esc_html_e('Related Posts', 'newsnote'); ?></h2>
			</div>
			<div class="post-item-wrapper grid-layout column-4 ">
				<?php if ($related_query->have_posts()) : $related_query->the_post(); ?>
					<article <?php post_class(); ?>>
						<figure>
							<?php the_post_thumbnail(); ?>
						</figure>
						<div class="post-content">
							<?php newsnote_cat_list(); ?>
							<header class="entry-header">
								<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							</header>
							<div class="entry-content">
								<?php newsnote_excerpt(25); ?>
							</div>
							<?php newsnote_entry_meta(); ?>
						</div>
			</div>
			</article>
		<?php endif; ?>
		</div>
	</div>
</section>
</div>
<?php
get_footer();
