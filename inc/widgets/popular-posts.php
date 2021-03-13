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
class Popular_Posts extends Widget{


    public function fields(){

        $fields = array(
            'title' => array(
                'name' => 'title',
                'type' => 'text',
                'default' => '',
                'title' => esc_html__( 'Title', 'newsnote' ),
            ),
            'thumbnail_size' => array(
                'name' => 'thumbnail_size',
                'type' => 'select',
                'default' => 'NewsNote-thumb-600x600',
                'title' => esc_html__( 'Thumbnail Size', 'newsnote' ),
                'choices'   => newsnote_image_sizes()
            ),
        );
        
        return $fields;

    }

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        $widget_ops = array( 'classname' => 'popular-post', 'description' => 'display popular posts to your website.' );
        parent::__construct( 'popular_posts', esc_html__( 'NM: Popular Posts', 'newsnote'), $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     */
    public function widget( $args, $instance ) {

        $before_title = (isset($args['before_title'])) ? $args['before_title'] : '';
        $after_title = (isset($args['after_title'])) ? $args['after_title'] : '';
        $before_widget = (isset($args['before_widget'])) ? $args['before_widget'] : '';
        $after_widget = (isset($args['after_widget'])) ? $args['after_widget'] : '';

        $title = (isset($instance['title'])) ? $instance['title'] : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $thumbnail_size = (isset($instance['thumbnail_size'])) ? $instance['thumbnail_size'] : 'NewsNote-thumb-600x600';
        echo $before_widget;
        if($title){
            echo $before_title.esc_html($title).$after_title;
        }
        ?>
        <div class="news-layout-wrap">
            <?php
            $popular_args = array(
                'post_type'         => 'post',
                'post_status'       => 'publish',
                'posts_per_page'    => 5,
                'order_by'          => 'comment_count',
            );
            $popular_query = new \WP_Query($popular_args);
            if( $popular_query->have_posts() ):
                while( $popular_query->have_posts() ):
                    $popular_query->the_post();
                    ?>
                    <article <?php post_class(); ?>>
                        <?php if(has_post_thumbnail()): ?>
                            <figure>
                                <?php the_post_thumbnail($thumbnail_size); ?>
                            </figure>
                        <?php endif; ?>
                        <div class="post-content">
                            <header class="entry-header">
                                <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            </header>
                            <?php newsnote_entry_meta(true, false, false, false); ?>
                        </div>
                    </article>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
        <?php
        echo $after_widget;
        wp_reset_query();
        wp_reset_postdata();

    }

}
