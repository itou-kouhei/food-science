<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/css/app.css" type="text/css" />
  <?php
  //スタイルシートの読み込み
  wp_enqueue_style(
    'font-awesome', //ハンドルネームは自由に決めていい
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css'
  );

  //Google Fontsの読み込み
  wp_enqueue_style(
    'google-web-fonts', //ハンドルネームは自由に決めていい
    'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Sans+JP:wght@100..900&display=swap',
    false,
    null
  );

  //自前のJavaScriptを呼び出せる。記述パターン１
  wp_enqueue_script(
    'food-science-main', //ハンドルネームは自由に決めていい
    get_template_directory_uri() . '/assets/js/main.js',
    ['jquery'],
    filemtime(get_template_directory() . '/assets/js/main.js'),
    true //これでbodyの閉じタグ前に記述される
  );

  //WoredPressに元々入っているjqueryを呼び出せる。
  wp_enqueue_script('jquery'); 


  //wp_head()関数はWoredPressを使ってサイト作成する時は必ず記述しておく関数 
  wp_head();
  ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="header">
    <div class="header_logo">
      <h1 class="logo"><a href="<?= home_url(); ?>">FOOD SCIENCE<span><?php bloginfo('description'); ?></span></a></h1>
    </div>

    <div class="header_nav">
      <div class="header_menu js-menu-icon"><span></span></div>
      <div class="gnav js-menu">

        <!-- ナビゲーションの表示 -->
        <?php
        // 入れる値の設定
        $args = [
          'menu' => 'global-navigation',
          'menu_class' => '',
          'container' => false,
        ];
        wp_nav_menu($args);
        ?>

        <div class="header_info">
          <!-- 検索フォームの作成　ーーーーーーーーーーーーーーーー -->
          <form class="header_search" method="get" action="<?= home_url('/'); ?>">
          <!-- value="〜"は検索したキーワードを残す -->
            <input type="text" name="s" value="<?php the_search_query(); ?>" aria-label="Search">
            <button type="submit">
              <!-- 虫眼鏡のアイコン -->
              <i class="fas fa-search"></i>
          </button>
          </form>

          <div class="header_contact">
            <div class="header_time">
              <dl>
                <dt>OPEN</dt>
                <dd>09:00〜21:00</dd>
              </dl>
              <dl>
                <dt>CLOSED</dt>
                <dd>Tuesday</dd>
              </dl>
            </div>
            <p>
              <a href="#"><i class="fa-solid fa-envelope"></i><span>ご予約・お問い合わせ</span></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </header>