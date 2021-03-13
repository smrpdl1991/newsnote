<?php
/**
 * @package NewsNote
 * @subpackage NewsNote
 * @since 1.0.0
 */
get_header();
$listing_layout = get_theme_mod('newsnote_page_listing_layout', 'list');
$no_of_column = get_theme_mod( 'newsnote_archive_no_of_column', 3 );
$wrapper_class = $listing_layout.'-layout ';
if($listing_layout!='list'){
	$wrapper_class .= 'column-'.$no_of_column;
}
?>
<div id="content" class="site-content">
	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="post-item-wrapper <?php echo esc_attr($wrapper_class); ?>">
					<?php while(have_posts()): the_post(); ?>
						<?php get_template_part( 'template-parts/loop/content', 'list' ); ?>
					<?php endwhile; ?>
				</div>
			</main>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php

get_footer();
