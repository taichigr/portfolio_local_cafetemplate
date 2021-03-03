<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <title><?php wp_title(); ?></title>
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <!---->
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?> >