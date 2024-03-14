<!-- コメント入力欄フォーム -->

<section class="comments">

<!-- コメント入力欄のタイトル --------------------------------- -->
  <?php
  /**
   * $args配列の中で用意されているキーを指定してフォームの形などのカスタイムズを指定をする
   * キー => カスタム内容
   * 変更したいキーを指定して(フォームやテキスト) => 変更内容を入力
   */

  $args = [
    // 'fields' => [
    //   'url' => '<div class="sss">自分のサイトアドレス: <input type="text" name="author"></div>',
    // ]
    'title_reply' => 'コメント投稿フォーム',
  ];

  //上記のカスタマイズ(変更内容)が入っている$args(変数)をcomment_form();に渡して実装
  comment_form($args);
  if (have_comments()) :
  ?>

    <!-- コメントの一覧化 ---------------------------------------------------- -->
    <ol class="commentlist">
      <?php
      $wp_list_comments_args = [
        'avatar_size' => 50,
        // 'format' => 'html5',　元のdivタグをコメントなどに相応しいarticleタグに変える。コメントアウトしている理由はfunction.phpにまとめているため、ここでいち記述する必要がないため。
      ];

      //上記のカスタマイズ(変更内容)が入っている$wp_list_comments_args(変数)をwp_list_comments();に渡して実装
      wp_list_comments($wp_list_comments_args);
      ?>
    </ol>




    <!-- ページネーションの作成 -------------------------------------------------------------- -->
  <?php
    // ページネーションのカスタマイズ
    $args = [
      'prev_text' => '←前のコメントページ',
      'next_text' => '次のコメントページ→',
      // 'type' => 'array', //データの取得のみに変化する
    ];
    // ページネーションの出力
    // $data = paginate_comments_links($args); 
    paginate_comments_links($args); //データの取得のみに変化する。その場合は$data = paginate_comments_links($args);と記述

  endif;
  ?>

</section>