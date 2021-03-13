<?php
/**
 * @package NewsNote
 * @subpackage NewsNote
 * @since 1.0.0
 */

$sidebar_options = newsnote_sidebar_options();

if(!$sidebar_options){
	return;
}

foreach( $sidebar_options as $sidebar_name ){
	?>
	<div id="<?php echo esc_attr($sidebar_name); ?>" class="widget-area small-news-area">
		<?php dynamic_sidebar( 'right-sidebar' ); ?>
	</div>
	<?php
}
