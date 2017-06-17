<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package GachaFan
 */

get_header(); ?>

  <section id="primary" class="content-area large-9 columns">
    <main id="main" class="site-main" role="main">

    <?php
    $s = $_GET['s'];
    $cat = $_GET['cat'];
    $tag = $_GET['tag'];
    $release_date = $_GET['release_date'];
    var_dump($s);
    var_dump($cat);
    var_dump($tag);
    var_dump($release_date);
    $args=array(
      'post_type' => array( 'post', 'gf_blog' ),
      'category__in' => $cat,
      'tag' => $tag,
      's' => $s,
    );
    if ( $release_date ) {
      $args += array('meta_query'	=> array(
              array(
                'key' => 'release_date',// 発売日
                'value' => $release_date,
                'compare' => '=',
              )
            )
          );
    }
    echo 'Args:';
    var_dump($args);
    ?>
    <?php $the_query = new WP_Query($args); ?>

    <?php
    if ( $the_query->have_posts() ) : ?>

      <header class="page-header">
        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'gachafan' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
      </header><!-- .page-header -->

      <?php
      /* Start the Loop */
      while ( $the_query->have_posts() ) : $the_query->the_post();

        /**
         * Run the loop for the search to output the results.
         * If you want to overload this in a child theme then include a file
         * called content-search.php and that will be used instead.
         */
        get_template_part( 'template-parts/content', 'search' );

      endwhile;

      the_posts_navigation();

    else :

      get_template_part( 'template-parts/content', 'none' );

    endif; ?>

    </main><!-- #main -->
  </section><!-- #primary -->

<?php
get_sidebar();
get_footer();
