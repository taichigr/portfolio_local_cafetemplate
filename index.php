
<!-- head -->
<?php 
get_header();
?>
<!-- メニュー -->
<?php get_template_part('content', 'menu'); ?>

<!--メインコンテンツ-->
<div id="main">
    <!-- トップバナー -->
    <img src="img_cafe/coffee-baner.jpg" alt="" id="top-baner">

    <!-- コンテンツ -->
    <section id="introduction">
        <div class="introblock introblock-left-img">
            <div class="img-area">
                <img src="img_cafe/coffee02.jpg" alt="">
            </div>
            <div class="sentence-area">
                <h2 class="intro-title">非日常へ</h2>
                <p>
                    当店はヨーロッパの路地裏のカフェ<br>
                    のゆったりとした空間をイメージして<br>
                    います。<br>
                    都会の喧騒を忘れたひとときを<br>
                    お過ごしください。
                </p>
            </div>
        </div>
        <div class="introblock introblock-right-img">
            <div class="sentence-area">
                <h2 class="intro-title">フェアトレードの豆使用</h2>
                <p>
                    当店では、公正な取引により貧困を<br>
                    無くそうという取り組みに共感し、<br>
                    フェアトレード豆を使用しています。<br>
                    苦味、香りの強い<br>
                    グアテマラの豆です。
                </p>
            </div>
            <div class="img-area">
                <img src="img_cafe/coffee03.jpg" alt="">
            </div>
        </div>
    </section>
</div>

<!-- footer -->
<?php get_footer(); ?>