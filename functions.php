<?php

/**
 * WordPressの投稿エディタのオプション機能を追加する
 * 
 * @return void
 */
function my_theme_support()
{
  // titleタグのタイトルをページ毎の適当なタイトルに出力する
  add_theme_support('title-tag');

  // アイキャッチ画像を有効化する
  add_theme_support('post-thumbnails');

  // カスタムメニューを作成する
  add_theme_support('menus');

  // html5の出力を行う(wpが自動でマークアップするタグが古いので、よくdivなどが使われコメントなどには相応しいarticleタグなどを使う様に最新のタグに変える。)
  add_theme_support('html5');

  // wpのエディターのスタイル 
  add_theme_support('editor-styles');
  add_editor_style('assets/css/editor-style.css');

  add_theme_support('widgets');
  add_theme_support('automatic-feed-links');
}
add_action('after_setup_theme', 'my_theme_support');


/**
 * タイトルの値「ー」を「｜」に変える
 * 
 * 元の関数のフックに自作の関数を引っ掛けて結果を意図的に変える
 * function my~(){}が元の関数。($separator)の中に結果が入る。
 */
function my_document_title_separator($separator)
{
  $separator = '|';
  return $separator;
}
// これでフックに引っ掛けることができる
// document_title_separator(フック名)がフックのこと
add_filter('document_title_separator', 'my_document_title_separator');


/**
 * Contact Form 7 の自動整形をオフにする
 *wpのエディタの初期指定を外すといこと
 *(初期設定は段落の度にpタグが入ってしまうなどがあるため)
 *falseでオフにする
 *
 * @return bool
 */
function my_wpcf7_autop()
{
  return false;
}
add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');


function my_pre_get_posts($query)
{
  if (is_admin() || !$query->is_main_query()) {
    return; //関数ストップ
  }
  if ($query->is_home()) {
    $query->set('posts_per_page', 3);
    return; //関数ストップ
  }
}
// add_action('pre_get_posts', 'my_pre_get_posts');



/**
 * パスワード保護中(パスワードで保護されたページ)の投稿タイトルの「保護中」を削除
 * 保護中: %s の「保護中:」を削除。
 * %sは文字
 *
 * @return string
 */
function my_protected_title()
{
  return '%s';
}
add_filter('protected_title_format', 'my_protected_title');


/**
 * フォームのカスタマイズ
 * the_password_formはヒィルターフックでこの中に一式入ってる。フォームのリード文や入力欄やボタンなどの全部を持っている。
 * 
 *
 */
function my_password_form()
{
  // wpのフォーマットの初期設定で余計なタグが入らないようにする
  remove_filter('the_content', 'wpautop');

  //ログインのurlを文字で返す
  $wp_login_url = wp_login_url();

  // <<<はheredoc(ヒアドック)と言う。heredocは $html = ""; とほぼ同義
  // $html = "";　中で{$〜}(変数)を使えるがheredocも使える。
  // 複数行にわたる文字列の作成に便利
  // HTMLの部分はなんでもいい。自分で作っていい。
  $html = <<<HTML
  <p>パスワードを入力して下さい。</p>
  <form action="{$wp_login_url}?action=postpass" method="post" class="post-password-form">
    <input type="password" name="post_password">
    <input type="submit" name="送信" value="送信">
  </form>
HTML; //右にピッタと付けないとエラーになる。
  return $html; //returnすることで上記の内容を表示する
}
add_filter('the_password_form', 'my_password_form');


/**
 * 第一引数　$allowed_blocks の設定
 * プラグインの投稿エディタの設定
 * プラグインの投稿エディタで作業する際のブロックの初期表示を指定。
 * 
 * 第二引数 $editor_context の設定
 * 固定ページだったら画像ブロックも追加
 *
 */
function my_allowed_block_types_all($allowed_blocks, $editor_context)
{
  // ブロックの初期表示をこの３つだけにする指定。
  $allowed_blocks = [
    'core/heading', //見出しブロック
    'core/paragraph', //段落ブロック
    'core/list', //リストブッロク
  ];

  // 固定ページ(画像ブロックを追加)
  if ($editor_context->post->post_type === 'page') {
    // 固定ページだったら画像ブロックも追加
    $allowed_blocks[] = 'core/image';
  }

  return $allowed_blocks;
}
// add_filter('allowed_block_types_all', 'my_allowed_block_types_all', 10, 2); 　//これを適用すると上のブロックの表示設定がきく。今はコメントアウトしているのでブロックが初期設定で全部表示されている。



/**
 * 管理者権限を操作する
 * プラグインは User Role Editor
 * プラグインのUser Role Editor でも操作できるけど、それを関数で設定してみる
 * 
 * @return void
 */
function my_admin_init()
{
  // 管理者権限の取得（オブジェクト）
  $role = get_role('administrator');

  // 権限の追加 　add_cap('機能のキー');
  $role->add_cap('edit_others_foods');
  $role->add_cap('edit_foods');
  $role->add_cap('edit_private_foods');
  $role->add_cap('edit_published_foods');
  $role->add_cap('publish_foods');
  $role->add_cap('read_private_foods');
  // $role->add_cap('delete_others_foods');
  // $role->add_cap('delete_foods');
  // $role->add_cap('delete_private_foods');
  // $role->add_cap('delete_published_foods');

  // 権限の削除 　remove_cap('機能のキー');
  $role->remove_cap('delete_others_foods');
  $role->remove_cap('delete_foods');
  $role->remove_cap('delete_private_foods');
  $role->remove_cap('delete_published_foods');
}
add_action('admin_init', 'my_admin_init');




function api_register_fields()
{
  register_rest_field(
    'food',
    'price',
    [
      'get_callback' => 'get_custom_field',
      'update_callback' => null,
      'schema' => null,
    ]
  );
  register_rest_field(
    'food',
    'calorie',
    [
      'get_callback' => 'get_custom_field',
      'update_callback' => null,
      'schema' => null,
    ]
  );
}
add_action('rest_api_init', 'api_register_fields');

function get_custom_field($object, $field_name, $request)
{
  return get_post_meta($object['id'], $field_name, true);
}



/**
 * header.phpのhead内にlinkでCSSやJSの紐付けするところを関数化する
 * これでheader.phpにlinkで紐付けを書かなくて済む
 *
 * 
 * @return void
 */
function my_enqueue_scripts()
{
  wp_enqueue_script('rest', get_template_directory_uri() . '/assets/js/rest.js');
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');



/**
 * サムネイルを表示する
 * よく使うループを関数化
 *
 * @return void
 */
function display_thumbnail()
{
  if (has_post_thumbnail()) :
    the_post_thumbnail('medium');
  else :
    echo '<img src="' . get_template_directory_uri() . '/assets/img/common/noimage.png" alt="">';
  endif;
}



/**
 * Var dump with pre tag
 * Var_dumpを関数化する。functions.phpの末尾などに挿入
 *
 * @param mixed $content
 * @return void
 */
function my_dump($content)
{
  echo '<pre>';
  var_dump($content);
  echo '</pre>';
}
