<!-- この関数でheader.phpをここにコピー(紐付け) -->
<?php get_header(); ?>

<!-- if (wp_theme_has_theme_json())でjson を呼ぶだす -->
<main <?php if (wp_theme_has_theme_json()) : ?>class="is-full" <?php endif; ?>>
  <div class="section">
    <div class="section_inner">
      <!-- ワードループプレスの作成 -->
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class('post') ?>>

            <header class="section_header">
              <h1 class="heading heading-primary"><?php the_title(); ?></h1>
            </header>

            <div class="post_content">
              <!-- 年月日の出力 -->
              <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日'); ?></time>
              <div class="content">
                <!-- 本文の出力 -->
                <?php the_content(); ?>
              </div>

              <!-- コメント入力欄フォームのテンプレートを表示 -->
              <?php comments_template(); ?>

            </div>

            <footer class="post_footer">
              <?php 
              $categories = get_the_category();
               ?>
              <?php if ($categories) : ?>
                <div class="category">
                  <div class="category_list">
                    <?php foreach ($categories as $category) : ?>
                      <!-- nameデータの出力 -->
                      <div class="category_item"><a href="<?= get_category_link($category); ?>" class="btn btn-sm is-active"><?= $category->name; ?></a></div>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endif; ?>

              <!-- ページの下部にある戻るボタン -->
              <div class="prevNext">
                <?php 
                $previous_post = get_previous_post();
                 ?>
                <?php if ($previous_post) : ?>
                  <div class="prevNext_item prevNext_item-prev">
                    <!-- 次のページのリンク先のパーマリンク -->
                    <a href="<?php the_permalink($previous_post); ?>">
                      <svg width="20" height="38" viewBox="0 0 20 38">
                        <path d="M0,0,19,19,0,38" transform="translate(20 38) rotate(180)" fill="none" stroke="#224163" stroke-width="1" />
                      </svg>
                      <!-- 戻るボタンに前の記事のタイトルを出力 -->
                      <span><?= get_the_title($previous_post); ?></span>
                    </a>
                  </div>
                <?php endif; ?>

                <!-- ページの下部にある次へのボタン -->
                <?php 
                $next_post = get_next_post(); 
                ?>
              
                <?php if ($next_post) : ?>
                  <div class="prevNext_item prevNext_item-next">
                    <!-- 次のページのリンク先のパーマリンク -->
                    <a href="<?php the_permalink($next_post); ?>">
                      <!-- 次へのボタンに次の記事のタイトルを出力 -->
                      <span><?= get_the_title($next_post); ?></span>
                      <svg width="20" height="38" viewBox="0 0 20 38">
                        <path d="M1832,1515l19,19L1832,1553" transform="translate(-1832 -1514)" fill="none" stroke="#224163" stroke-width="1" />
                      </svg>
                    </a>
                  </div>
                <?php endif; ?>

              </div>
            </footer>
          </article>

      <?php endwhile;
      endif; ?>

<!-- 投稿データ3件分の取得 -->
      <?php
      $args = [
        'post_type' => 'post', //投稿のみ
        'posts_per_page' => 3,
        'post__not_in' => [get_the_ID()], //省きたい投稿IDのしてい
      ];
      $latest_query = new WP_Query($args);

      if ($latest_query->have_posts()) :
      ?>

        <section class="latest">
          <header class="latest_header">
            <h2 class="heading heading-secondary">新着情報</h2>
          </header>
          <div class="latest_body">
            <div class="cardList">
              <?php while ($latest_query->have_posts()) : $latest_query->the_post(); ?>
                <?php get_template_part('template-parts/loop', 'news'); ?>
              <?php endwhile; ?>
            </div>
          </div>
        </section>

      <?php endif; ?>

    </div>
  </div>
</main>


<!-- この関数でfooter.phpをここにコピー(紐付け) -->
<?php get_footer(); ?>