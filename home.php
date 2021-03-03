<?php 
/*
Template Name: Home 〜トップページ〜
*/
?>

<!-- head -->
       <?php get_header(); ?>
        <!-- メニュー -->
        <?php get_template_part('content', 'menu'); ?>
        
        <!--メインコンテンツ-->
        <div id="main">
            <!-- トップバナー -->
            <img src="<?php echo get_post_meta($post->ID, 'img-top', true); ?>" alt="" id="top-baner">

            <!-- コンテンツ -->
            <section id="introduction">
                <?php dynamic_sidebar('ホーム'); ?>
            </section>
        </div>

        <!-- footer -->
        <?php get_footer(); ?>