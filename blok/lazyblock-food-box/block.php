<!-- wpのプラグイン「Lazy Blocks」で作成したブロックがwpのエディタに出力させる設定 -->

<div class="foodCard foodCard-border">
  <!-- $attributes['url'];でwpのプラグイン「Lazy Blocks」で作成したブロックがwpのエディタに出力させる設定 -->
  <a href="<?= $attributes['url']; ?>">
    <div class="foodCard_pic">
      <?php
      $pic = $attributes['pic']; //$attributes['pic']のpicが画像のデーターが全部入っている配列データー。これを $picに入れている。
      if (!empty($pic)) : //emptyは空という意味で!の否定をつけて$picの配列データの中が空じゃなかったら($picに画像のデーターがアップロードされたらとする)
      ?>
      <!-- $picに画像のデーターがアップロードされたら$pic['url'];でurlのデーターを取ってきてこの画像を表示させる -->
        <img src="<?= $pic['url']; ?>" alt="">
      <?php else : ?>
        <!-- elseで$picの配列データの中が空だったら下のダミー画像を表示 -->
        <img src="<?= get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
      <?php endif; ?>
    </div>
    <div class="foodCard_body">
      <h4 class="foodCard_title"><?= $attributes['name']; ?></h4>
      <p class="foodCard_price"><?= $attributes['price']; ?>円</p>
    </div>
  </a>
</div>