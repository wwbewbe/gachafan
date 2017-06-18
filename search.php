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
    $release_year = $_GET['release_year'];
    $release_month = $_GET['release_month'];
    $args=array(
      'post_type' => array( 'post', 'gf_blog' ),
      'category__in' => $cat,
      'tag' => $tag,
      's' => $s,
    );
    if ( $release_year && $release_month ) {
      $args += array('meta_query'	=> array(
        'relation' => 'AND',
          'meta_year' => array(
            'key' => 'release_year',// 発売年
            'value' => $release_year,
            'compare' => '=',
          ),
          'meta_month' => array(
            'key' => 'release_month',// 発売月
            'value' => $release_month,
            'compare' => '=',
          ),
        ),
      );
    } elseif ( $release_year ) {
      $args += array('meta_query'	=> array(
          array(
            'key' => 'release_year',// 発売年
            'value' => $release_year,
            'compare' => '=',
          ),
        ),
      );
    } elseif ( $release_month ) {
      $args += array('meta_query'	=> array(
          array(
            'key' => 'release_month',// 発売月
            'value' => $release_month,
            'compare' => '=',
          ),
        ),
      );
    }
    ?>
    <?php $the_query = new WP_Query($args); ?>

    <?php
    if ( $the_query->have_posts() ) : ?>

      <header class="page-header">
        <h1 class="page-title"><?php printf( esc_html__( 'Search Results: %s', 'gachafan' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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
