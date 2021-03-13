<?php
/**
 * Template Name: Home Page
 * @package NewsNote
 * @subpackage NewsNote
 * @since 1.0.0
 */
get_header();
?>
<div id="content" class="site-content">
	<div class="container">
		<div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="news-area">
                    <?php 
                    get_template_part('template-parts/sections/home', 'toparea');
                    get_template_part('template-parts/sections/home', 'sideright');
                    get_template_part('template-parts/sections/home', 'sideleft');
                    get_template_part('template-parts/sections/home', 'sideboth');
                    get_template_part('template-parts/sections/home', 'bottomfull');
                    ?>
                </div>
                <!--news-area end-->
            </main>
            <!--.site-main-->
        </div>
    </div>
    <!--.container-->
</div>
<?php
get_footer();
