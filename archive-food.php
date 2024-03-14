<!-- この関数でheader.phpをここにコピー(紐付け) -->
<?php get_header(); ?>

<main>
  <section class="section section-foodList">
    <div class="section_inner">
      <div class="section_header">
        <h2 class="heading heading-primary"><span>フード紹介</span>FOOD</h2>
      </div>
      <!-- フードとドリンクのセクションを分けるためにデートを取得する -->
      <?php
      $menu_terms = get_terms(['taxonomy' => 'menu']);
      ?>

      <!-- 取得したデータを使って出力していく -->
      <?php if (!empty($menu_terms)) : ?>
        <!-- さらにこのページのタイトルなどの細かいデータをとるための指定 -->
        <?php foreach ($menu_terms as $menu) : ?>

          <!-- フードとドリンクの大枠のセクション -->
          <section class="section_body">
            <h3 class="heading heading-secondary">
              <!-- タイトルをaタグでリンクにして、フードとドリンクごとの専用ページに遷移するようにget_term_link($menu);で専用ページと紐付け -->
              <a href="<?= get_term_link($menu); ?>">
                <!-- タイトルの出力 -->
                <?= $menu->name; ?>
              </a>
              <!-- スラッグをstrtoupper();で大文字で出力 -->
              <span><?= strtoupper($menu->slug); ?></span>
            </h3>


            <!-- フードとドリンクのメニューリスト -->
            <ul class="foodList">

              <!-- ワードループプレスでclass="foodList_item"のタグを囲んで内容を出力 -->
              <?php
              $args = [
                'post_type' => 'food', // どの投稿かしてい。この場合foodという投稿に限定して取ってくる。
                'posts_per_page' => -1, // -1は全件という意味になるので全件のデータを指定
              ];

              $taxquerysp = [
                'relation' => 'AND', // 以下全ての条件に合致という意味
                [
                  'taxonomy' => 'menu',
                  'field' => 'slug',
                  'terms' => $menu->slug, //slug(mealという文字)を取得する。
                ],
              ];
                 
              // 上記の配列の $args と $taxquerysp を紐付け
              $args['tax_query'] = $taxquerysp;

              $the_query = new WP_Query($args);
              ?>

              <!-- ページに表示したい指定を上記の記述が新しく作ったクエリー $the_query に全て入っているのでそれをループで出力する -->
              <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                  <li class="foodList_item">
                    <!-- テンプレートファイルの紐付け -->
                    <?php get_template_part('template-parts/loop', 'food'); ?>
                  </li>
                <?php endwhile; ?>
              <?php endif; ?>

            </ul>
          </section>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </section>
</main>

<!-- この関数でfooter.phpをここにコピー(紐付け) -->
<?php get_footer(); ?>