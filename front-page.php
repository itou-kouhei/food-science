<!-- この関数でheader.phpをここにコピー(紐付け) -->
<?php get_header(); ?>

<!-- TOPページの表示。「 if (is_front_page()) : 」で囲む -->
<?php if (is_front_page()) : ?>
  <section class="kv">
    <div class="kv_inner">
      <h1 class="kv_title">FOOD SCIENCE<br>TOKYO</h1>
      <p class="kv_subtitle">FROM JAPAN</p>
    </div>

    <!-- 下のclass="kv_slider js-slider"をメインビジュアルの投稿があったときだけ表示させる -->
    <?php
    $args = [
      'post_type' => 'main-visual', //これでwpで作成した投稿(ページ)を取得
      'posts_per_page' => -1,
      'meta_query' => [
        // 以下のいずれかの(OR)条件
        'relation' => 'OR',
        // 1. 公開終了日が未来のもの
        [
          'key' => 'end_date', //wpのACFで作成したデータのキーを指定
          'type' => 'DATETIME', //取得するデータのタイプが時間
          'compare' => '>', //未来
          'value' => date('Y-m-d H:i:s'), //現在の日時
        ],
        // 2. 公開終了日が設定なし
        [
          'key' => 'end_date',
          'value' => '',
        ],
        // 3. 公開終了日が存在しない(の場合を一応作っておく)
        [
          'key' => 'end_date',
          'comapre' => 'NOT EXISTS', //存在しない
        ],
      ]
    ];
    $the_query = new WP_Query($args);
    ?>

    <!-- 上記で取得した投稿(ページ)を出力 -->
    <?php if ($the_query->have_posts()) : ?>
      <div class="kv_slider js-slider">
        <!-- 繰り返し処理 -->
        <?php while ($the_query->have_posts()) : $the_query->the_post();
          // 写真のデータを取得
          $pic = get_field('pic');
        ?>

          <!-- $pic['url'];で画像のフルサイズを取得  -->
          <div class="kv_sliderItem" style="background-image: url('<?= $pic['url']; ?>')"></div>

        <?php endwhile; ?>
        <!-- $_POSTの値をリセットする -->
        <?php wp_reset_postdata(); ?>

      </div>
    <?php endif; ?>

    <div class=" kv_overlay"></div>

    <div class="kv_scroll">
      <a href="#concept" class="kv_scrollLink">
        <p>SCROLL DOWN</p>
        <div class="kv_scrollIcon"><i class="fa-solid fa-chevron-down"></i></div>
      </a>
    </div>
  </section>
<?php endif; ?>


<section class="section section-concept" id="concept">
  <div class="section_inner">
    <div class="section_headerWrapper">
      <header class="section_header">
        <h2 class="heading heading-primary"><span>コンセプト</span>CONCEPT</h2>
      </header>
      <div class="section_pic">
        <div><img src="<?= get_template_directory_uri() ?>/assets/img/home/concept_img01@2x.png" alt=""></div>
        <div><img src="<?= get_template_directory_uri() ?>/assets/img/home/concept_img02@2x.png" alt=""></div>
        <div><img src="<?= get_template_directory_uri() ?>/assets/img/home/concept_img03@2x.png" alt=""></div>
      </div>
    </div>
    <div class="section_body">
      <p>
        ご提供するメキシコ料理は、当店の店主が修行したローカルフードを中心にした、ご家族でも楽しめる、美味しいメキシカンです。<br>
        スパイシーでヘルシーな本場の味をお楽しみ下さい。
      </p>
      <div class="section_btn">
        <!-- get_permalink();はhome_url('/contact/');と同じ機能 -->
        <a href="<?= get_permalink(25); ?>" class="btn btn-more">もっと見る</a>
      </div>
    </div>
  </div>
</section>

<!-- 取り出すデータの指定 -->
<?php
$args = [
  'post_type' => 'post', // 投稿
  'posts_per_page' => 3, // 1ページにnewsの最新３件を表示
  'category_name' => 'news', // newsの項目のデータ
];

// 上記で取り出したデータを　new WP_Query();　に入れて変数　$the_query　に渡す。
$the_query = new WP_Query($args);
?>


<!-- 投稿のカードリストを表示　 -->
<?php if ($the_query->have_posts()) : ?>
  <section class="section">
    <div class="section_inner">
      <header class="section_header">

        <h2 class="heading heading-primary"><span>最新情報</span>NEWS</h2>

        <!-- もっと見るのボタンにリンクを取得 -->
        <?php
        $news = get_term_by('slug', 'news', 'category');
        $news_link = get_term_link($news, 'category');
        ?>
        <div class="section_headerBtn">
          <a href="<?= $news_link; ?>" class="btn btn-more">もっと見る</a>
        </div>

      </header>

      <!-- 投稿のカードリスト -->
      <div class="section_body">
        <div class="cardList cardList-1row">

          <!-- 投稿の表示 -->
          <?php while ($the_query->have_posts()) :
            $the_query->the_post(); ?>
            <!-- テンプレート化したtemplate-partsフォルダの配下のloop-news.phpファイルの紐付け -->
            <?php get_template_part('template-parts/loop', 'news'); ?>
          <?php endwhile;
          wp_reset_postdata(); // wp_reset_postdata(); は内容をメインのクエリーに戻すということ。?>

        </div>
      </div>
    </div>
  </section>
<?php endif; ?>


<section>
  <h2>フード</h2>
  <div id="food-list"></div>
</section>


<section class="section section-info">
  <div class="section_inner">
    <div class="section_content">
      <header>
        <h2 class="heading heading-primary"><span>インフォメーション</span>INFORMATION</h2>
      </header>

      <ul class="infoList">
        <li class="infoList_item">
          <span class="infoList_prepend">営業時間</span>
          <span class="infoList_num">09:00〜21:00</span><span class="infoList_time">(LO 20:00)</span>
          <span class="infoList_append">店休日：火曜日</span>
        </li>
        <li class="infoList_item">
          <span class="infoList_prepend">お電話でのお問い合わせ</span>
          <span class="infoList_num">03-0000-0123</span>
        </li>
        <li class="infoList_item">
          <span class="infoList_prepend">メールでのお問い合わせ</span>
          <div class="infoList_btn">
            <!-- home_url('/contact/');はget_permalink();と同じ機能 -->
            <a href="<?= home_url('/contact/'); ?>" class="btn btn-primary">お問い合わせ</a>
          </div>
        </li>
      </ul>
    </div>

    <div class="section_pic">
      <img src="<?= get_template_directory_uri() ?>/assets/img/home/info_img01@2x.png" alt="">
    </div>
  </div>
</section>


<section class="section section-access">
  <div class="section_inner">
    <div class="section_content">
      <header class="section_header">
        <h2 class="heading heading-secondary">アクセス</h2>
      </header>
      <div class="section_body">
        <p>〒162-0846 東京都新宿区市谷左内町21-13</p>
        <div class="section_btn">
          <!-- get_permalink();はhome_url('/contact/');と同じ機能 -->
          <a href="<?= get_permalink(37); ?>" class="btn btn-primary">アクセスはこちら</a>
        </div>
      </div>
    </div>
    <div class="section_pic">
      <img src="<?= get_template_directory_uri() ?>/assets/img/home/access_img01@2x.png" alt="">
    </div>
  </div>
</section>

<!-- この関数でfooter.phpをここにコピー(紐付け) -->
<?php get_footer(); ?>