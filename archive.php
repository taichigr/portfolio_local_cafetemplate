
<!-- ヘッダー -->
<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part('content', 'menu'); ?>

<!--メインコンテンツ-->
        <!--メインコンテンツ-->
        <div id="main">

            <!-- infomation -->
            <section id="infomation">
                <h2 class="title">infomation</h2>
                <div class="info-box">
                    <table>
                        <tbody>
                        
                    <!-- 記事のループ お知らせ一覧 -->
                    <?php if(have_posts()): ?>
                    <?php while(have_posts()):the_post(); ?>
                            <tr><th><a href="<?php the_permalink(); ?>"><?php the_time("Y/m/j"); ?></a></th><td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td></tr>
                    <?php endwhile; ?>
                    <?php endif; ?>
                       
                        </tbody>
                    </table>
                </div>
                <?php if(function_exists("pagination")) pagination($additional_loop->max_num_pages); ?>
            </section>
            
        </div>

        <!-- footer -->
        <?php
        get_footer(); 
        ?>
