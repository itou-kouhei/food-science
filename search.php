<!-- この関数でheader.phpをここにコピー(紐付け) -->
<?php get_header(); ?>

<main>
  <section class="section">
    <div class="section_inner">
      <div class="section_header">
        <h1 class="heading heading-primary"><span>サイト内検索</span>SEARCH</h1>
      </div>

      <div class="section_body">
        <!-- 検索結果があった場合はclass="section_desc"とclass="cardList"の内容を表示 ーーーーーーーーーーーーーーーーーー -->
        <?php if (have_posts()) : ?>
          <!-- 検索ワード -->
          <div class="section_desc">
            <p><i class="fas fa-search"></i> 検索ワード「<?php the_search_query(); ?>」</p>
          </div>
          <!-- カード -->
          <div class="cardList">
            <?php while (have_posts()) : the_post(); ?>
              <?php get_template_part('template-parts/loop', 'news'); ?>
            <?php endwhile; ?>
          </div>

          <!-- 検索結果がなかった場合の内容 ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー -->
        <?php else : ?>
          <div class="section_desc">
            <p>検索結果はありませんでした</p>
          </div>
        <?php endif; ?>

        <!-- ページネーションの実装 -->
        <?php if (function_exists('wp_pagenavi')) : ?>
          <div class="pagination">
            <?php wp_pagenavi(); ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </section>
</main>

<!-- この関数でfooter.phpをここにコピー(紐付け) -->
<?php get_footer(); ?>