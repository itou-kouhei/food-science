<!-- この関数でheader.phpをここにコピー(紐付け) -->
<?php get_header(); ?>

<main>
  <section class="section section-foodList">
    <div class="section_inner">
      <div class="section_header">
        <h2 class="heading heading-primary"><span>フード紹介</span>FOOD</h2>
      </div>

      <section class="section_body">
        <!-- MEALという文字を取得している -->
        <?php
        $menu_slug = get_query_var('menu');
        $menu = get_term_by('slug', $menu_slug, 'menu');
        ?>
        <h3 class="heading heading-secondary">
          <?php single_term_title(); ?>
        <span>
          <!-- これでMEALという文字を出力。 strtoupper();は大文字にする-->
          <?= strtoupper($menu->slug); ?>
        </span>
      </h3>
        <ul class="foodList">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
              <li class="foodList_item">
                <?php get_template_part('template-parts/loop', 'food'); ?>
              </li>
            <?php endwhile; ?>
          <?php endif; ?>
        </ul>
      </section>
    </div>
  </section>
</main>

<!-- この関数でfooter.phpをここにコピー(紐付け) -->
<?php get_footer(); ?>