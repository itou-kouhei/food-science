<!-- カードのテンプレート化 -->

<div class="foodCard">
  <a href="<?php the_permalink(); ?>">
    <!-- オススメアイコンの表示非表示する(対象のオススメ商品にはオススメアイコンを表示) -->
    <?php if (get_field('recommend')) : ?>
      <span class="foodCard_label">オススメ</span>
    <?php endif; ?>

    <div class="foodCard_pic">
       <!-- ループを使うが、ループは関数化したのでその関数名を呼び出す。　関数を使う時は、作成した関数名(); と記述　-->
      <?php display_thumbnail(); ?>
    </div>
    
    <div class="foodCard_body">
      <h4 class="foodCard_title"><?php the_title(); ?></h4>
      <!-- the_field('price');はそれぞれの価格を表示 -->
      <p class="foodCard_price">¥<?php the_field('price'); ?></p>
    </div>
  </a>
</div>