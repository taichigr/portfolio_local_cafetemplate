<?php 
/*
Template Name: access ~アクセス~
*/
?>
<!-- ヘッダー -->
<?php get_header(); ?>
   
        <!-- メニュー -->
        <?php get_template_part('content', 'menu'); ?>
        <!--メインコンテンツ-->
        <div id="main">

            <!-- infomation -->
            <section id="map">
                <h2 class="title"><?php get_the_title(); ?></h2>
                <div class="map-container">
                    <?php echo get_post_meta($post->ID, 'map', true); ?>
                </div>
                
                
                <div class="sentence-container">
                    <?php if(have_posts()) : //wordpressループ
                    while (have_posts()) : the_post();  //繰り返し処理開始 ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php the_content(); ?>
                    </div>
                    <?php endwhile; //繰り返し処理終了
                    else: //ここから記事が見つからなかった場合の処理 ?>
                    <div class="post">
                        <h2>記事はありません。</h2>
                        <p>お探しの記事は見つかりませんでした。</p>
                    </div>
                    <?php endif; //wordpress　ループ終了 ?>
                </div>
                
                
                
                
            </section>
        </div>

        <!-- footer -->
        <?php get_footer(); ?>