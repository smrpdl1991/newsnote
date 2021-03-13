<article <?php post_class(); ?>>
    <?php if(has_post_thumbnail()): ?>
        <figure>
            <?php the_post_thumbnail(); ?>
        </figure>
    <?php endif; ?>
    <div class="post-content">
        <div class="post-cat-list">
            <?php
            $category_list = get_the_category( get_the_ID() );
            foreach($category_list as $category_details){
                ?>
                <a href="<?php echo get_term_link( $category_details ) ?>" class="cat-link">
                    <?php echo esc_html($category_details->name); ?>
                </a>
                <?php
            }
            ?>
        </div>
        <header class="entry-header">
            <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        </header>
        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
        <div class="entry-meta">
            <div class="posted-on">
                <a href="<?php the_permalink(); ?>">
                    <time><?php echo esc_html(get_the_date( 'F d, Y', get_the_ID())); ?></time>
                </a>
            </div>
            <div class="post-author vcard">
                <?php 
                $comment_number = get_comments_number();
                ?>
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_author_meta('nicename')); ?>" rel="author"><?php the_author_meta('nicename'); ?></a>
            </div>
            <div class="post-comment">
                <a href="<?php the_permalink(); ?>"><?php echo esc_html($comment_number); ?></a>
            </div>
        </div>
    </div>
</article>