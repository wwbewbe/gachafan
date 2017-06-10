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

            the_widget( 'Widget_Recent_Posts' );

            // Only show the widget if site has multiple categories.
            if ( gachafan_categorized_blog() ) :
          ?>

          <div class="widget widget_categories">
            <h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'gachafan' ); ?></h2>
            <ul>
            <?php
              wp_list_categories( array(
                'orderby'    => 'count',
                'order'      => 'DESC',
                'show_count' => 1,
                'title_li'   => '',
                'number'     => 10,
              ) );
            ?>
            </ul>
          </div><!-- .widget -->

          <?php
            endif;

            /* translators: %1$s: smiley */
            $archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'gachafan' ), convert_smilies( ':)' ) ) . '</p>';
            the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

            the_widget( 'WP_Widget_Tag_Cloud' );
          ?>

          <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <?php bloginfo( 'name' ); ?>
            トップページへ戻る</a>
          </p>
        </div><!-- .page-content -->
      </section><!-- .error-404 -->

    </main><!-- #main -->
  </div><!-- #primary -->
<?php get_sidebar(); ?>
<?php
get_footer();
