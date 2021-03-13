<!-- .hgroup-wrap ends here -->
<?php
$ticker_layout = get_theme_mod( 'newsnote_ticker_layout', 'layout1' );
?>
<!-- ticker layout 1-->
<div class="news-ticker <?php echo esc_attr($ticker_layout); ?>">
    <div class="container">
        <div class="news-ticker-wrap">
            <div class="news-ticker-caption">
                <div class="alert-spinner">
                    <span class="double-bounce1"></span>
                    <span class="double-bounce2"></span>
                </div>
                <?php
                $ticker_label = get_theme_mod( 'newsnote_ticker_label', 'Recent News' );
                echo esc_html($ticker_label);
                ?>
            </div>
            <div class="news-ticker-content">
                <?php
                $ticker_args = array(
                    'post_type'          => 'post',
                    'post_status'       => 'publish',
                    'posts_per_page'    => 3,
                );
                $ticker_query = new WP_Query($ticker_args);
                if($ticker_query->have_posts()):
                    ?>
                    <ul>
                        <?php while($ticker_query-> have_posts()): $ticker_query->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <?php if(has_post_thumbnail()): ?>
                                        <figure>
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </figure>
                                    <?php endif; ?>
                                    <?php the_title(); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


