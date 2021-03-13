<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php wp_head(); ?>
</head>
<?php
$sidebar_layout = get_theme_mod('newsnote_sidebar_layout', 'right-sidebar'); 
if( is_page_template( 'home-template.php' )){
    $sidebar_layout = '';
}
?>
<body <?php body_class($sidebar_layout); ?>>
    <?php do_action( 'wp_body_open' ); ?>
    <div id="page" class="site">
        <header class="site-header">
            <?php 
            $sections = get_theme_mod( 'newsnote_header_sections', 'media,top,branding,ticker,navigation' );
            $header_section = explode(',', $sections);
            foreach ($header_section as $value) {
                get_template_part( 'template-parts/header/header', $value );
            }
            ?>
        </header>

        
        <!-- header ends here -->

