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
class Featured_Posts extends Widget{

    /**
     * Constructor
     *
     * @return void
     */
    function __construct() {
        $widget_ops = array( 'classname' => 'block-posts', 'description' => 'display featured post to your website.' );
        parent::__construct( 'featured_posts', esc_html__('NM: Featured Posts', 'newsnote'), $widget_ops );
    }

    public function fields(){

        $fields = array(
            'title' => array(
                'name' => 'title',
                'type' => 'text',
                'default' => '',
                'title' => esc_html__( 'Title', 'newsnote' ),
            ),
            'slider_cat' => array(
                'name' => 'slider_cat',
                'type' => 'select',
                'default' => '',
                'title' => esc_html__( 'Slider Category', 'newsnote' ),
                'choices' => newsnote_term_list()
            ),
            'excerpt_length' => array(
                'name' => 'excerpt_length',
                'type' => 'number',
                'default' => '',
                'title' => esc_html__( 'Excerpt Length', 'newsnote' ),
            ),
            'no_of_slides' => array(
                'name' => 'no_of_slides',
                'type' => 'number',
                'default' => '10',
                'title' => esc_html__( 'No of slides', 'newsnote' ),
            ),
            'post_category' => array(
                'name' => 'post_category',
                'type' => 'select',
                'default' => '',
                'title' => esc_html__( 'Block Category', 'newsnote' ),
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

        $slider_cat = (isset($instance['slider_cat'])) ? $instance['slider_cat'] : '';
        $no_of_slides = (isset($instance['no_of_slides'])) ? $instance['no_of_slides'] : 10;
        $post_category = (isset($instance['post_category'])) ? $instance['post_category'] : '';
        $excerpt_length = (isset($instance['excerpt_length'])) ? $instance['excerpt_length'] : '';

        echo $before_widget;
        if($title){
            echo $before_title.esc_html($title).$after_title;    
        }
        ?>
        <div class="featured-news">   
            <div class="featured-news-wrap">
                <div class="featured-news-slides">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page'=> $no_of_slides,
                    );
                    if($slider_cat){
                        $args['cat'] = array(absint($slider_cat));
                    }
                    $slider_query = new \WP_Query($args);
                    if($slider_query->have_posts()):
                        ?>
                        <div class="slides-wrap">
                            <div class="slides-tab">
                                <?php
                                while($slider_query->have_posts()):
                                    $slider_query->the_post();
                                    ?>
                                    <article class="post">
                                        <div class="post-content">
                                            <?php newsnote_cat_list(); ?>
                                            <header class="entry-header">
                                                <h5 class="entry-title">
                                                    <a href="#<?php echo esc_attr(get_post_field( 'post_name', get_the_ID() )); ?>"><?php the_title(); ?></a>
                                                </h5>
                                            </header>
                                        </div>
                                    </article>
                                    <!--article-->
                                <?php endwhile; ?>
                            </div>
                            <!--.slides-tab-->
                            <div class="slides-post">
                                <?php
                                while($slider_query->have_posts()):
                                    $slider_query->the_post();
                                    ?>
                                    <article class="post">
                                        <?php if(has_post_thumbnail()): ?>
                                            <figure>
                                                <?php the_post_thumbnail( 'newsnote-thumb-508x338' ); ?>
                                            </figure>
                                        <?php endif; ?>
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
                                    <!--article-->
                                <?php endwhile; ?>
                            </div>
                            <!--.slides-post-->
                        </div>
                        <!--slides-wrap-->
                        <?php
                    endif;
                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
                </div>
                <!-- featured-news-slide end-->
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page'=> 2,
                );
                if($slider_cat){
                    $args['cat'] = array(absint($post_category));
                }
                $post_query = new \WP_Query($args);
                if($post_query->have_posts()):
                    ?>
                    <div class="featured-news-posts">
                        <?php 
                        while($post_query->have_posts()):
                            $post_query->the_post();
                            ?>
                            <article class="post">
                                <?php if(has_post_thumbnail()): ?>
                                    <figure>
                                        <?php the_post_thumbnail('newsnote-thumb-366x260'); ?>
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
                    <!-- featured-news-post end-->
                <?php endif; ?>
            </div>
            <!--featured-news-wrap end-->
        </div>
        <?php
        echo $after_widget;
        wp_reset_postdata();

    }

}
