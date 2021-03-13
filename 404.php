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
				<div class="post-item-wrapper list-layout">
					<h1><?php esc_html_e("404 page not found", 'newsnote'); ?></h1>
				</div>
				<div class="search-form">
					<?php 
						get_search_form();
					?>
				</div>
				<div class="back-to-main-page">
					<a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e( 'Back to home', 'newsnote' ); ?></a>
				</div>
			</main>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();

