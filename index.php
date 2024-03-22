<!-- この関数でheader.phpをここにコピー(紐付け) -->
<?php get_header(); ?>

<main>

  <section class="section">
    <div class="section_inner">
      <div class="section_header">
        <h1 class="heading heading-primary">
          <!-- if (is_archive()) : は下記のタイトルをカテゴリーの一覧か年別アーカイブのページのみに表示させる -->
        <?php if (is_archive()) : ?>
          <span>最新情報</span>
          <!-- タイトル -->
          NEWS - <?php wp_title(''); ?>
          <?php if (is_year()) : ?>年<?php endif; ?>
            <?php elseif (is_home()) : ?>
            <?php wp_title(''); ?>
          <?php endif; ?>
        </h1>
      </div>

      <div class="archive">
        <div class="archive_category">
          <h2 class="archive_title">カテゴリー</h2>
          <ul class="archive_list">
            <!-- カテゴリーリンクの作成 -->
            <?php
            $args = [
              'title_li' => '',
            ];
            wp_list_categories($args);
            ?>
          </ul>
        </div>

        <div class="archive_yealy">
          <h2 class="archive_title">年別</h2>
          <ul class="archive_list">
            <!-- 年別アーカイブ -->
            <?php
            $args = [
              'type' => 'yearly',
            ];
            wp_get_archives($args);
            ?>
          </ul>
        </div>
      </div>

      <!-- 投稿のカードリスト -->
      <div class="section_body">
        <!-- 記事がなかったらカード自体表示しない -->
        <?php if (have_posts()) : ?>
          <div class="cardList">
            <!-- ループの作成で投稿のカードリストの表示 -->
            <?php while (have_posts()) : the_post(); ?>
              <!-- テンプレート化したtemplate-partsフォルダの配下のloop-news.phpファイルの紐付け -->
              <?php get_template_part('template-parts/loop', 'news'); ?>
            <?php endwhile; ?>
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