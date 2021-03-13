<?php
/**
 * @package: NewsNote
 * @author: NewsNote
 * @since 1.0.0
 */
if(!function_exists('newsnote_term_list')):

	function newsnote_term_list($taxonomy='category'){

		$filter_category = array();
		$args = array(
			'taxonomy' => $taxonomy
		);
		$categories = get_categories($args);
		foreach($categories as $single_category){
			$filter_category[$single_category->term_id] = $single_category->name.'('.$single_category->count.')';
		}
		return $filter_category;

	}

endif;

if(!function_exists('newsnote_video_format_link')){

	function newsnote_video_format_link(){

		$post_format = get_post_format();
		
		if( $post_format!='video' ){
			return;
		}
		
		$all_video_block = array();
		$all_blocks = parse_blocks( get_the_content() );
		foreach($all_blocks as $index=>$block_details){
			$block_name = $block_details['blockName'];
			if($block_name=='core/video' ){
				$all_video_block[] = $block_details;
				break;
			}
		}

		if(!$all_video_block){
			return;
		}
		$video_link = $all_video_block[0]['attrs'];
		if($video_link){
			return true;
		}
		return;

	}
}



if(!function_exists('newsnote_cat_list')):

	function newsnote_cat_list(){

		$categories = get_the_category();
		?>
		<div class="post-cat-list">
			<?php
			foreach($categories as $category){
				$category_link = get_category_link($category);
				$category_name = $category->name;
				?>
				<a class="cat-link cat-<?php echo esc_attr($category->slug); ?>" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_name); ?></a>
				<?php
			}
			?>
		</div>
		<?php

	}

endif;


if(!function_exists('newsnote_tag_list')):

	function newsnote_tag_list(){

		$tags = get_the_tags(get_the_ID());
		if($tags):
			?>
			<div class="post-cat-list">
				<?php
				foreach($tags as $tag){
					$tag_link = get_tag_link($tag);
					$tag_name = $tag->name;
					?>
					<a class="cat-link tag-<?php echo esc_attr($tag->slug); ?>" href="<?php echo esc_url($tag_link); ?>"><?php echo esc_html($tag_name); ?></a>
					<?php
				}
				?>
			</div>
			<?php
		endif;

	}

endif;



if(!function_exists('newsnote_entry_meta')):

	function newsnote_entry_meta($date=true, $author=true, $like=true, $comment=true){
		$like=false;
		$post_author_id = get_post_field( 'post_author', get_the_ID() );
		if(!$post_author_id){
			$post_author_id = get_the_author_meta( 'ID' );
		}
		// Get user object
		$current_author = get_user_by( 'ID', $post_author_id );
		// Get user display name
		$author_name = (isset($current_author->display_name)) ? $current_author->display_name : '';
		$comment_number = get_comments_number();
		?>
		<div class="entry-meta">
			<?php if($date): ?>
				<div class="posted-on">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<time><?php echo get_the_date() ?></time>
					</a>
				</div>
			<?php endif; ?>
			<?php if($author): ?>
				<div class="post-author vcard">
					<a href="<?php esc_url( get_author_posts_url( $post_author_id ) ) ?>" title="<?php echo esc_attr( $author_name ); ?>" rel="author"><?php echo esc_html( $author_name ); ?></a>
				</div>
			<?php endif; ?>
			<?php if($like): ?>
				<div class="post-like">55</div>
			<?php endif; ?>
			<?php if($comment): ?>
				<div class="post-comment">
					<a href="<?php the_permalink(); ?>"><?php echo esc_html($comment_number); ?></a>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

endif;

if(!function_exists('newsnote_author_listing')):

	function newsnote_author_listing(){

		$authors = get_users();
		$author_listing = array();
		foreach ( $authors as $author_detail ) :
			$author_listing[$author_detail->ID]=$author_detail->data->user_login;
		endforeach;

		return $author_listing;

	}

endif;

if(!function_exists('newsnote_fallback_menu')):

	function newsnote_fallback_menu(){
		?>
		<nav class="main-navigation">
			<ul class="menu">
				<li class="menu-item">
					<a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e( 'Home', 'newsnote' ); ?></a>
				</li>
			</ul>
		</nav>
		<?php	
	}

endif;

if(!function_exists('newsnote_image_sizes')):

	function newsnote_image_sizes( $disable_image = false ){

		global $_wp_additional_image_sizes;
		$newsnote_get_image_sizes = array();
		if ( true == $disable_image ) {
			$newsnote_get_image_sizes['disable'] = esc_html__( 'No Image', 'newsnote' );
		}
		foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
			$newsnote_get_image_sizes[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
		}
		$newsnote_get_image_sizes['full'] = esc_html__( 'full (original)', 'newsnote' );
		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ($_wp_additional_image_sizes as $key => $size ) {
				$croped_resize = ($size['crop']) ? esc_html__('Croped', 'newsnote') : esc_html__('Resize', 'newsnote'); 
				$newsnote_get_image_sizes[ $key ] = $key . ' - '.$croped_resize;
			}
		}

		return $newsnote_get_image_sizes;
		
	}

endif;

if(!function_exists('newsnote_sidebar_options')){

	function newsnote_sidebar_options(){

		$sidebar_layout = get_theme_mod('newsnote_sidebar_layout', 'right-sidebar');
		$sidebars = array();
		switch ($sidebar_layout) {
			case 'left-sidebar':
			$sidebars[] = 'left-sidebar';
			break;
			case 'right-sidebar':
			$sidebars[] = 'right-sidebar';
			break;
			case 'both-sidebar':
			$sidebars = array(
				'left-sidebar',
				'right-sidebar'
			);
			break;
			default:
			$sidebars = array();
			break;
		}

		return $sidebars;

	}

}



if(!function_exists('newsnote_excerpt')){

	function newsnote_excerpt( $length = 20 ){

		if($length<1){
			return;
		}

		$full_content = get_the_content();
		$content_without_shortcode = strip_shortcodes($full_content);
		$content_without_tags = strip_tags($content_without_shortcode);

		$all_words = explode( ' ', $content_without_tags );
		$excerpt_words = array_slice($all_words,0,$length);
		$excerpt_value = implode(' ',$excerpt_words);		
		$get_excerpt = apply_filters( 'get_the_excerpt', $excerpt_value );
		echo apply_filters( 'the_excerpt', $get_excerpt );

	}

}

if(!function_exists('newsnote_archive_column_callback')){

	function newsnote_archive_column_callback(){

		$listing_layout =  get_theme_mod( 'newsnote_page_listing_layout', 'list' );
		if($listing_layout=='list'){
			return false;
		}

		return true;

	}

}
