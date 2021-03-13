<div class="navbar">
    <div class="container">
        <div class="navbar-main-wrap">
            <div class="navbar-wrap">
                <a class='navbar-home' href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-home"></i></a>
                <div class="toggle-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <?php
                if (has_nav_menu('primary-nav')) :
                    wp_nav_menu(array(
                        'theme_location'  => 'primary-nav',
                        'container'       => 'nav',
                        'container_class' => 'main-navigation',
                        'menu_class'      => 'menu',
                        'echo'            => true,
                        'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
                        'depth'           => 0,
                        'walker'          => '',
                        'fallback_cb '    => 'newsnote_fallback_menu',
                    ));
                else :
                    newsnote_fallback_menu();
                endif;
                ?>
            </div>
            <div class="navbar-icons header-icons-wrap">
                <?php
                $show_search_form = get_theme_mod('navigation_show_search_icon', 1);
                if ($show_search_form) {
                ?>
                    <a class="search-toggle" href="javascript:void(0)">
                        <i class="fa fa-search" aria-hidden="true"></i><?php esc_html_e('Search', 'newsnote'); ?>
                    </a>
                    <div class="search-header">
                        <?php get_search_form(); ?>
                    </div>
                <?php
                }
                ?>
                <?php
                $link_string = get_theme_mod('newsnote_social_links');
                if ($link_string) :
                    $social_links = explode(',', $link_string);
                    $show_links = get_theme_mod('navigation_show_social_links', true);
                    if ($social_links && $show_links) :
                ?>
                        <div class="social-links">
                            <a href="javascript:void(0)" class="follow-us">
                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            </a>
                            <ul class="social-nav">
                                <?php foreach ($social_links as $link) { ?>
                                    <li>
                                        <a href="<?php echo esc_attr($link); ?>">
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                <?php
                    endif;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>