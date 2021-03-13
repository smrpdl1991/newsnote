<div class="footer-bottom">
    <div class="container">
        <div class="footer-bottom-wrap">
            <div class="footer-bottom-left">
                <div class="copy-right">
                    <?php
                    $copyright = get_theme_mod( 'copyright_text_bottom', esc_html__('&copy; 2021 Theme Company All Rights Reserved', 'newsnote') );
                    echo esc_html($copyright);
                    ?>
                </div>
            </div>
            <?php if(has_nav_menu( 'footer' )): ?>
                <div class="footer-bottom-right">
                    <?php
                    wp_nav_menu( 
                        array(
                            'theme_location'  => 'footer',
                            'container'       => 'div',
                            'container_class' => 'footer-menu',
                            'menu_class'      => 'menu',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
                            'depth'           => 1,
                            'walker'          => '',
                        ) 
                    );
                endif; 
                ?>
            </div>
        </div>
    </div>
</div>