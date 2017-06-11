<?php
/**
 * GachaFan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GachaFan
 */

if ( ! function_exists( 'gachafan_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gachafan_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on GachaFan, use a find and replace
   * to change 'gachafan' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'gachafan', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'latest-top-thumb', 210, 210, true );
  add_image_size( 'feature-top-thumb', 300, 125, true );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary', 'gachafan' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'gachafan_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'gachafan_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gachafan_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'gachafan_content_width', 640 );
}
add_action( 'after_setup_theme', 'gachafan_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gachafan_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'gachafan' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'gachafan' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'gachafan_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gachafan_scripts() {
  wp_enqueue_style( 'foundation-style', get_template_directory_uri().'/layouts/foundation.min.css' );
  wp_enqueue_style( 'gachafan-style', get_stylesheet_uri(), array(), date('U') );
  wp_enqueue_style( 'font-awesone', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
  wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css?family=Averia+Serif+Libre:300,400,700|Oleo+Script:400,700|Open+Sans+Condensed:300,700|Open+Sans:300,400,700,800|Roboto+Condensed:300,400,700|Roboto+Slab:300,400,700|Roboto:300,400,700,900' );
  wp_enqueue_style( 'google-mplus1p', 'https://fonts.googleapis.com/earlyaccess/mplus1p.css' );
  wp_enqueue_style( 'google-roundedmplus1c', 'https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css' );

  wp_enqueue_script( 'jquery');
  wp_enqueue_script( 'navbtn-script', get_template_directory_uri() .'/js/navbtn.js', array( 'jquery' ) );
//    wp_enqueue_script( 'gachafan-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
  wp_enqueue_script( 'gachafan-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
  wp_enqueue_script( 'header-fix', get_template_directory_uri() .'/js/header-fix.js', array( 'jquery' ) );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'gachafan_scripts' );

// エディタスタイルシート
add_editor_style( get_template_directory_uri() . '/editor-style.css?ver=' . date( 'U' ) );
add_editor_style( '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * 抜粋の制限文字数設定
 */
//概要（抜粋）の文字(単語)数(WP Multibyte Patchを使わない時に有効)※バイト数で数えているっぽい
function my_length($length) {
    return 120;
}
add_filter('excerpt_length', 'my_length');
// 抜粋欄を使用した時の抜粋文の文字制限(WP Multibyte Patchを使えば有効)
function my_the_excerpt($myexcerpt) {
  $myexcerpt = mb_strimwidth($myexcerpt, 0, 120, "…", "UTF-8");
  return $myexcerpt;
}
add_filter('the_excerpt', 'my_the_excerpt');

// 概要（抜粋）の省略記号
function my_more( $more ) {
  return '…';
}
add_filter( 'excerpt_more', 'my_more' );

//固定ページにも抜粋(excerpt)を使えるようにする
add_post_type_support( 'page', 'excerpt' );

/**
 * 管理画面カスタマイズ
 */
// 編集画面の設定
function editor_setting($init) {
  $init[ 'block_formats' ] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre';

  $style_formats = array(
    array( 'title' => 'Tips info',
      'block' => 'div',
      'classes' => 'tips',
      'wrapper' => true ),
    array( 'title' => 'Attention',
      'block' => 'div',
      'classes' => 'attention',
      'wrapper' => true ),
    array( 'title' => 'Highlight',
      'inline' => 'span',
      'classes' => 'highlight') );
  $init[ 'style_formats' ] = json_encode( $style_formats );

  return $init;
}
add_filter( 'tiny_mce_before_init', 'editor_setting');

// スタイルメニューを有効化
function add_stylemenu( $buttons ) {
      array_splice( $buttons, 1, 0, 'styleselect' );
      return $buttons;
}
add_filter( 'mce_buttons_2', 'add_stylemenu' );

/**
 * 管理画面の投稿一覧カスタマイズ
 */
// 投稿一覧にカラムを追加
function add_manage_column( $columns ) {
  $post_type = isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : 'post';
  if ( $post_type == 'gf_blog' ) {
    $columns['keyword'] = esc_html__('Keyword', 'gachafan');
  }
  /*if ( post_type_supports( $post_type, 'excerpt' ) ) {
    $columns['excerpt'] = __( 'Excerpt' );
  }*/
  if ( post_type_supports( $post_type, 'thumbnail' ) ) {
    $columns['thumbnail'] = __( 'Featured Images' );
  }
  return $columns;
}
add_filter( 'manage_posts_columns', 'add_manage_column' );

// 投稿一覧に追加したカラム内容を表示
function display_manage_column( $column_name, $post_id ) {
  /*if ( $column_name == 'excerpt' ) {
    if ( has_excerpt( $post_id ) ) {
      echo get_the_excerpt();
    } else {
      _e( 'None' );
    }
  }*/
  if ( $column_name == 'thumbnail' ) {
    if ( has_post_thumbnail( $post_id ) ) {
      echo get_the_post_thumbnail( $post_id, array( 50, 50 ) );
    } else {
      _e( 'None' );
    }
  }
  if ( $column_name == 'keyword' ) {
    $kwds = get_the_terms( $post->ID, 'keyword' );
    if ( !empty($kwds) ) {
      $out = array();
      foreach ( $kwds as $kwd ) {
        $out[] = '<a href="edit.php?keyword=' . $kwd->slug . '&post_type=sw_trend' . '">' . esc_html( sanitize_term_field( 'name', $kwd->name, $kwd->term_id, 'keyword', 'display' ) ) . '</a>';
      }
      echo join( ', ', $out );
    } else {
      echo esc_html( __( 'None', 'gachafan' ) );
    }
  }
}
add_action( 'manage_posts_custom_column', 'display_manage_column', 10, 2 );

/**
 * コメント欄の停止（非表示）
 */
function add_comment_close( $open, $post_id ) {
 $post = get_post( $post_id );
 if ( $post && in_array( $post->post_type, array( 'page', 'post' ) ) ) {
   $open = false;
 }
 return $open;
}
add_filter( 'comments_open', 'add_comment_close', 10, 2 );

/**
 * サムネイル関連関数
 */
// サムネイル画像取得
function get_thumbnail_url( $size ) {
  global $post;

  if ( has_post_thumbnail() ) {
    $postthumb = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
    $url = $postthumb[0];
  } elseif( preg_match( '/wp-image-(\d+)/s', $post->post_content, $thumbid ) ) {
    $postthumb = wp_get_attachment_image_src( $thumbid[1], $size );
    $url = $postthumb[0];
  } else {
    $url = get_template_directory_uri() . '/img/no-image.png';
  }
  return $url;
}

// サムネイル付き最近の投稿一覧ウィジェット
get_template_part('inc/class-widget-recent-posts');
function register_recent_posts_widget() {
  register_widget( 'Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'register_recent_posts_widget' );

// サムネイル付きおすすめ（ピックアップ）投稿一覧ウィジェット
register_nav_menu( 'pickupnav', __( 'Pickup Posts', 'gachafan' ) );
get_template_part( 'inc/class-widget-pickup-posts' );
function register_pickup_posts_widget() {
  register_widget( 'Widget_Pickup_Posts' );
}
add_action( 'widgets_init', 'register_pickup_posts_widget' );

// トップ画面サムネイル付きトピック投稿一覧
register_nav_menu( 'topicnav', __( 'Topic Posts', 'gachafan' ) );

/**
 * カスタムフィールド設定
 */
 get_template_part( 'inc/class-post-metabox' );

/**
 * プラグインの有効・無効確認
 */
function is_my_plugin_active( $plugin ) {
  if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  }
  return is_plugin_active( $plugin );
}

/**
 * リストを表示するショートコード
 */
function set_taxlist($params = array()) {
  extract(shortcode_atts(array(
      'file' => 'taxlist', //表示に使用するPHPファイル
      'posttype' => 'post', // 投稿タイプ
      'tagname' => 0, //表示するタグ名
      'catname' => 0, //表示するカテゴリー名
      'keyword' => 0, // keywordタクソノミー
      'list' => 0, //表示するリスト数
      ), $params));
  ob_start();
  include(TEMPLATEPATH . "/$file.php");
  return ob_get_clean();
}
add_shortcode('taxlist', 'set_taxlist');

/**
 * タクソノミーを表示するショートコード
 */
function set_showtax($params = array()) {
  extract(shortcode_atts(array(
          'type' => 'post_tag', //表示するタクソノミー(デフォルト分類：'category', 'post_tag')
          ), $params));

  $tax = '<div class="entry-tax"><ul>';
  $args = array( 'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true,
          );
  $terms = get_terms( $type, $args );
  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    foreach ($terms as $term ) {
      $term_list = '<li>';
      $term_list .= '<a href="' . get_term_link( $term ) . '">';
      $term_list .= $term->name . '</a>';
      $term_list .= '</li>';
      $tax .= $term_list;
    }
  }
  $tax .= '</ul></div>';

  return $tax;
}
add_shortcode('showtax', 'set_showtax');

/**
 * カスタム投稿タイプ作成
 */
function create_post_type() {
	// ブログ記事用カスタム投稿タイプ
	$labels = array(
		'name' => _x( 'Blogs', 'post type general name', 'gachafan' ),
		'singular_name' => _x( 'Blog', 'post type singular name', 'gachafan' ),
		'menu_name' => _x( 'Blogs', 'admin menu', 'gachafan' ),
		'name_admin_bar' => _x( 'Blog', 'add new on admin bar', 'gachafan' ),
		'add_new' => _x( 'Add New', 'blog', 'gachafan' ),
		'add_new_item' => __( 'Add New Blog', 'gachafan' ),
		'new_item' => __( 'New Blog', 'gachafan' ),
		'edit_item' => __( 'Edit Blog', 'gachafan' ),
		'view_item' => __( 'View Blog', 'gachafan' ),
		'all_items' => __( 'All Blogs', 'gachafan' ),
		'search_items' => __( 'Search Blogs', 'gachafan' ),
		'parent_item_colon' => __( 'Parent Blogs:', 'gachafan' ),
		'not_found' => __( 'No trends found.', 'gachafan' ),
		'not_found_in_trash' => __( 'No blogs found in Trash.', 'gachafan' )
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'menu_position' => 5,
		'rewrite' => array('slug' => 'blog'),
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' )
	);

	register_post_type( 'gf_blog', $args );

	// ブログ記事用カスタム分類(Keyword)
	$labels = array(
		'name' => _x( 'Keywords', 'taxonomy general name', 'gachafan' ),
		'singular_name' => _x( 'Keyword', 'taxonomy singular name', 'gachafan' ),
		'search_items' => __( 'Search Keywords', 'gachafan' ),
		'all_items' => __( 'All Keywords', 'gachafan' ),
//		'parent_item' => __( 'Parent Keyword', 'gachafan' ),
//  	'parent_item_colon' => __( 'Parent Keyword:', 'gachafan' ),
		'edit_item' => __( 'Edit Keyword', 'gachafan' ),
		'update_item' => __( 'Update Keyword', 'gachafan' ),
		'add_new_item' => __( 'Add New Keyword', 'gachafan' ),
		'new_item_name' => __( 'New Keyword Name', 'gachafan' ),
		'menu_name' => __( 'Keyword', 'gachafan' ),
	);

	$args = array(
		'hierarchical' => false,
		'labels' => $labels,
	);

	register_taxonomy( 'keyword', array( 'gf_blog' ), $args );
	register_taxonomy_for_object_type( 'keyword', 'gf_blog' );
//	register_taxonomy_for_object_type( 'category', 'gf_blog' );
//	register_taxonomy_for_object_type( 'post_tag', 'gf_blog' );

}
add_action( 'init', 'create_post_type' );

/**
 * クエリー設定のカスタマイズ
 */
function QueryListFilter($query) {
  if (!is_admin() && $query->is_main_query() && $query->is_search()) {

    $query->set( 'post_type', array( 'post', 'gf_blog' ) ); // 投稿記事とカスタム投稿を対象
    $query->set( 'category__not_in', array(1) ); // カテゴリが未分類の記事は非表示

  }
  return $query;
}
add_action('pre_get_posts','QueryListFilter');
