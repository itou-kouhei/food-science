<footer class="footer">
    <!-- パーツファイルの紐付け -->
  <?php get_template_part('template-parts/breadcrumb'); ?>
  <div class="footer_inner">
    <div class="footer_info">
      <div class="footer_logo">
        <h3 class="logo logo-white"><a href="">FOOD SCIENCE<span>メキシカン・レストラン</span></a></h3>
      </div>
      <div class="footer_text">
        <p>〒162-0846 東京都新宿区市谷左内町21-13</p>
      </div>
    </div>
    <section class="footer_sns">
      <h3>SHARE ON</h3>

    <!-- snsの表示 -->
      <?php
     // 入れる値の設定
      $args = [
        'menu' => 'footer-sns',
        'menu_class' => '',
        'container' => false,
      ];
      wp_nav_menu($args);
      ?>
    </section>
    <div class="footer_copyright">
      <small>&copy; FOOD SCIENCE All rights reserved.</small>
    </div>
  </div>
</footer>

<div class="pageTop js-toTop">
  <a href="#"><i class="fas fa-arrow-up"></i><span>TOP PAGE</span></a>
</div>


<?php
//slikのロード
if (is_front_page()) {

//スタイルシート(slick)の読み込み
  wp_enqueue_style(
'slick-carousel', //ハンドルネームは自由に決めていい
 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css'
);

// JavaScript(min.js)の読み込み
  wp_enqueue_script(
'slick-carousel', //ハンドルネームは自由に決めていい
 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js'
);

//自前のJavaScript(home.js)の読み込み
  wp_enqueue_script(
'food-science-home', //ハンドルネームは自由に決めていい
 get_template_directory_uri() . '/assets/js/home.js'
);
}
?>

<!-- WoredPressを使ってサイト作成する時は必ず記述しておく関数。 アドミンバー画表示させる(WoredPressのヘッダーの位置に表示されるバーのこと)。そのアドミンバー関連の設定がwp_footer()関数に入ってる。　-->
<?php wp_footer(); ?>
</body>

</html>