<!-- この関数でheader.phpをここにコピー(紐付け) -->
<?php get_header(); ?>

<main>
  <section class="section">
    <div class="section_inner">
      <div class="section_header">
        <h2 class="heading heading-primary"><span>エラー</span>404 Not Found</h2>
      </div>

      <div class="section_body">
        <div class="content">

          <p>お探しのページが見つかりませんでした。</p>
          <p>
            申し訳ございませんが、
            <!-- href=〜でトップページに飛ぶ -->
            <a href="<?= home_url('/'); ?>">こちらのリンク</a>
            からトップページにお戻りください。
          </p>

        </div>
      </div>
    </div>
  </section>
</main>

<!-- この関数でfooter.phpをここにコピー(紐付け) -->
<?php get_footer(); ?>