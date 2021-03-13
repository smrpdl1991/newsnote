<?php
$header_image = get_theme_mod( 'branding_background_image', '');
$alignment_items = get_theme_mod( 'newsnote_branding_alignment', 'left' );
?>
<div class="middle-header align-<?php echo esc_attr($alignment_items); ?>" style='background-image: url("<?php echo esc_url($header_image); ?>");'>
    <div class="container">
        <div class="middle-header-wrap">
            <section class="site-branding">
                <?php if ( has_custom_logo() ) { ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div><!-- .site-logo -->
                <?php } 
                $header_textcolor = get_theme_mod('header_textcolor');
                if($header_textcolor!='blank'){
                    if ( is_front_page() || is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php
                    endif;
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
                        <?php
                    endif;
                }
                ?>
            </section>
            <div class="midle-header-right widget-area">
                <?php dynamic_sidebar( 'header-area' ); ?>
            </div>
        </div>
    </div>
</div>