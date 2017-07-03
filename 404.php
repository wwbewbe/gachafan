<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package GachaFan
 */

get_header(); ?>

  <div id="primary" class="content-area large-9 columns">
    <main id="main" class="site-main" role="main">

      <section class="error-404 not-found">
        <header class="page-header entry-header">
          <h1 class="page-title entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'gachafan' ); ?></h1>
          <img src="<?php echo get_template_directory_uri(); ?>/img/404.png" alt="<?php echo esc_html__( 'can&rsquo;t be found...' ); ?>" />
        </header><!-- .page-header -->

        <div class="page-content">
          <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'gachafan' ); ?></p>

          <?php
            get_search_form();
          ?>

        </div><!-- .page-content -->
      </section><!-- .error-404 -->

    </main><!-- #main -->
  </div><!-- #primary -->
<?php get_sidebar(); ?>
<?php
get_footer();
