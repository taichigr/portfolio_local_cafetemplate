<?php
//カスタムヘッダー画像の設置
$custom_header_defaults = array(
    'default-image' => get_bloginfo('template_url').'/images/headers/logo.png',
    'header-text' => false, //ヘッダー画像上にテキストを被せる
);
//カスタムヘッダー機能の有効化
add_theme_support('custom-header', $custom_header_defaults );

//カスタムメニュー使用
register_nav_menu('mainmenu', 'メインメニュー');

//ページネーション
function pagination($pages = '', $range = 2)
{
    $showitems = ($range * 2)+1;//表示するページ数（５ページを表示）

    global $paged; //現在のページ数
    if(empty($paged)) $paged = 1; //デフォルトのページ

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;//全ページ数を取得
        if(!$pages) //全ページ数が空の場合は、１とする
        {
            $pages = 1;
        }
    }

    if(1 != $pages)//全ページが１ではない場合はページネーションを表示する
    {
        echo "<div class=\"pagination\">\n";
        echo "<ul>\n";
        //prev:現在のページ値が１より大きい場合は表示
        if($paged > 1) echo "<li class=\"prev\"><a href='".get_pagenum_link($paged - 1)."'>Prev</a></li>\n";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                //三項演算子での条件分岐
                echo ($paged == $i)? "<li class=\"active\">".$i."</li>\n":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>\n";
            }
        }
        //Next: 総ページ数より現在のページ値が小さい場合は表示
        if($paged < $pages) echo "<li class=\"next\"><a href=\"".get_pagenum_link($paged + 1)."\">Next</a></li>\n";
        echo "</ul>\n";
        echo "</div>\n";
    }
}


/*=======================================
カスタムフィールド
====================================== */
/* カスタムボックスの定義 */
add_action('admin_menu', 'add_custom_inputbox',);
/* 追加した表示項目のデータ更新・保存のためのアクションフック */
add_action('save_post', 'save_custom_postdata');
/* 入力項目がどの投稿タイプのページに表示されるのかを設定 */
function add_custom_inputbox(){
    //第一引数：編集画面のhtmlに挿入されるid属性名
    //第二引数：管理画面に表示されるカスタムフィールド名
    //第三引数：メタボックスの中に出力される関数名
    //第四引数：管理画面に表示するカスタムフィールドの場所(postなら投稿、pageなら固定ページ)
    //第誤引数：配置される順序
    add_meta_box('map_id', 'マップURL入力欄', 'custom_area1', 'page', 'normal');
    add_meta_box('top_img_id', 'トップ画像URL入力欄', 'custom_area2', 'page', 'normal');

}


function custom_area1(){
    global $post;
    echo 'マップ　： <textarea cols="50" rows="5" name="map">'.get_post_meta($post->ID, 'map', true).'</textarea><br>';
}

function custom_area2(){
    global $post;
    echo 'トップ画像URL :<input type="text" name="img-top" value="'.get_post_meta($post->ID, 'img-top', true).'" >';
}

function save_custom_postdata($post_id){
    $map = '';
    $img_top = '';
    
    /* MAP */
    if(isset($_POST['map'])){
        $map = $_POST['map'];
    }
    if($map != get_post_meta($post_id, 'map', true)){
        update_post_meta($post_id, 'map', $map);
    }elseif($map = ''){
        delete_post_meta($post_id, 'map', get_post_meta($post_id, 'map', true));
    }
    
    /* img_top */
    if(isset($_POST['img-top'])){
        $img_top = $_POST['img-top'];
    }
    if($img_top != get_post_meta($post_id, 'img-top', true)){
        update_post_meta($post_id, 'img-top', $map);
    }elseif($img_top = ''){
        delete_post_meta($post_id, 'img-top', get_post_meta($post_id, 'img-top', true));
    }
    
}


/*=======================================
カスタムウィジェット
====================================== */
//ウィジェットエリアを作成する関数がどれなのかを登録する
add_action( 'widgets_init', 'my_widgets_area' );
//ウィジェット自体の作成する(クラス)関数がどれなのかを登録する
add_action( 'widgets_init', function(){
    register_widget( 'my_Widgets_item3' );
});
add_action( 'widgets_init', function(){
    register_widget( 'my_Widgets_item4' );
});
//ウィジェットエリアを作成する
function my_widgets_area(){

    register_sidebar(array(
        'name' => 'ホーム',
        'id' => 'home_left',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
}

//ウィジェット自体を作成する
class my_widgets_item3 extends WP_Widget {

    //初期化（管理画面で表示するウィジェットの名前を設定する）
    function my_widgets_item3(){
        parent::WP_Widget(false, $name = 'ホームレフト');
    }

    //ウィジェットの入力項目を作成する処理
    function form($instance) {
        //入力された情報をサニタイズして変数へ格納
        $img = esc_attr($instance['img']);
        $title = esc_attr($instance['title']);
        $body = esc_attr($instance['body']);
?>

<p>
    <label for="<?php echo $this->get_field_id('img'); ?>">
        <?php echo 'img'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" type="text" value="<?php echo $img; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php echo 'タイトル'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('body'); ?>">
        <?php echo '内容：'; ?>
    </label>
    <textarea class="widefat" cols="20" rows="16" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>"><?php echo $body; ?></textarea>
</p>

<?php
    }

    //ウィジェットに入力された情報を保存する処理
    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['img'] = strip_tags($new_instance['img']);
        $instance['title'] = strip_tags($new_instance['title']); //サニタイズ php,htmlタグを取り除く
        $instance['body'] = trim($new_instance['body']); //サニタイズ 先頭と最後尾の空白を取り除く

        return $instance;
    }

    //管理画面から入力されたウィジェットを画面に表示する処理
    function widget($args, $instance){
        //配列を変数に展開
        extract( $args );

        //ウィジェットから入力された情報を取得
        $img = apply_filters( 'widget_img', $instance['img']);
        $title = apply_filters( 'widget_title', $instance['title']);
        $body = apply_filters( 'widget_body', $instance['body']);

        //ウィジェットから入力された情報がある場合、htmlを表示する
        if ( $title ){
?>

<div class="introblock introblock-left-img">
    <div class="img-area">
        <img src="<?php echo $img; ?>" alt="">
    </div>
    <div class="sentence-area">
        <h2 class="intro-title"><?php echo $title; ?></h2>
        <p>
            <?php echo $body; ?>
        </p>
    </div>
</div>

<?php
                     }
    }
}

class my_widgets_item4 extends WP_Widget {

    //初期化（管理画面で表示するウィジェットの名前を設定する）
    function my_widgets_item4(){
        parent::WP_Widget(false, $name = 'ホームライト');
    }

    //ウィジェットの入力項目を作成する処理
    function form($instance) {
        //入力された情報をサニタイズして変数へ格納
        $img = esc_attr($instance['img']);
        $title = esc_attr($instance['title']);
        $body = esc_attr($instance['body']);
?>

<p>
    <label for="<?php echo $this->get_field_id('img'); ?>">
        <?php echo 'img'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" type="text" value="<?php echo $img; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php echo 'タイトル'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('body'); ?>">
        <?php echo '内容：'; ?>
    </label>
    <textarea class="widefat" cols="20" rows="16" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>"><?php echo $body; ?></textarea>
</p>

<?php
    }

    //ウィジェットに入力された情報を保存する処理
    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['img'] = strip_tags($new_instance['img']);
        $instance['title'] = strip_tags($new_instance['title']); //サニタイズ php,htmlタグを取り除く
        $instance['body'] = trim($new_instance['body']); //サニタイズ 先頭と最後尾の空白を取り除く

        return $instance;
    }

    //管理画面から入力されたウィジェットを画面に表示する処理
    function widget($args, $instance){
        //配列を変数に展開
        extract( $args );

        //ウィジェットから入力された情報を取得
        $img = apply_filters( 'widget_img', $instance['img']);
        $title = apply_filters( 'widget_title', $instance['title']);
        $body = apply_filters( 'widget_body', $instance['body']);

        //ウィジェットから入力された情報がある場合、htmlを表示する
        if ( $title ){
?>

<div class="introblock introblock-right-img">
    <div class="sentence-area">
        <h2 class="intro-title"><?php echo $title; ?></h2>
        <p>
            <?php echo $body; ?>
        </p>
    </div>
    <div class="img-area">
        <img src="<?php echo $img; ?>" alt="">
    </div>
</div>

<?php
                     }
    }
}





