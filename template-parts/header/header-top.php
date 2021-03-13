<div class="top-header">
    <div class="container">
        <div class="top-header-wrap">
            <div class="top-header-item">
                <?php
                $show_date = get_theme_mod('topbar_show_date', true);
                if ($show_date) :
                ?>
                    <div class="current-date-time">
                        <span class="current-date"><?php echo date_i18n(' M j, Y'); ?></span>
                        <span class="current-time"><?php echo date_i18n('g:i:s a'); ?></span>
                    </div>
                <?php endif; ?>
                <?php if (has_nav_menu('top_menu')) : ?>
                    <div class="top-header-menu">
                        <?php
                        $args = array(
                            'depth'               => 1,
                            'theme_location'      => 'top_menu',
                        );
                        wp_nav_menu($args);
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="top-header-item header-icons-wrap">

                <?php
                $show_search_form = get_theme_mod('topbar_show_search_icon', 1);
                if ($show_search_form) {
                ?>
                    <div class="top-header-item-icon">
                        <a class="search-toggle" href="javascript:void(0)">
                            <i class="fa fa-search" aria-hidden="true"></i><?php esc_html_e('Search', 'newsnote'); ?>
                        </a>
                        <div class="search-header">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                    <?php
                }
                $link_string = get_theme_mod('newsnote_social_links');
                if ($link_string) :
                    $social_links = explode(',', $link_string);
                    $show_links = get_theme_mod('topbar_show_social_links', true);
                    if ($social_links && $show_links) :
                    ?>
                        <div class="top-header-item-icon">
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
                        </div>
                <?php
                    endif;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>