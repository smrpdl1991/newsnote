<?php
/**
 * Template Name: Contact US
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
				<?php while(have_posts()):the_post(); ?>
					<article <?php post_class('featured-post'); ?>>
						<figure class="featured-post-image">
							<?php the_post_thumbnail(); ?>
						</figure>
						<div class="post-content">
							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title">', '<h1>' ); ?>
							</header>
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</main>
			<!--.site-main-->
		</div>
		<!--#primary-->
		<?php get_sidebar(); ?>
	</div>
	<!--.container-->
</div>
<?php
get_footer();
