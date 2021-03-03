<!-- ヘッダー -->
<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part('content', 'menu'); ?>

<!--メインコンテンツ-->
<!--メインコンテンツ-->
<div id="main">

    <!-- infomation -->
    <section id="infomation">
        <h2 class="title"><?php get_the_title(); ?></h2>
        <div class="info-box">
            <?php if(have_posts()): ?>
            <?php while(have_posts()):the_post(); ?>
            <article class="article-item">
                <h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <h3 style="font-size:80%;"><?php the_time("Y/m/j"); ?></h3>

                <p class="article-body">
                    <?php the_content(); ?>
                </p>
            </article>
            <?php endwhile; ?>
            
            <?php else : ?>
            <h2 class="title">記事が見つかりませんでした。</h2>
            <p>検索で見つかるかもしれません。</p><br />
            <?php get_search_form(); ?>
            
            <?php endif; ?>
        </div>
        <?php if(function_exists("pagination")) pagination($additional_loop->max_num_pages); ?>
    </section>

</div>

<!-- footer -->
<?php
get_footer(); 
?>
