<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GachaFan
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
  <div class="row">
    <div class="large-3 small-3 columns thumbnail">
      <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'gachafan' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
          <img src="<?php echo get_thumbnail_url( 'mideum' ); ?>" alt="" title="" />
      </a>
    </div> <!-- 3 thumbnail -->
    <div class="large-9 small-9 columns">
      <header class="entry-header">
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'gachafan' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

        <?php if ( 'gf_blog' === get_post_type() ) : ?>
          <div class="entry-meta">
            <?php gachafan_posted_on(); ?>
          </div><!-- .entry-meta -->
        <?php endif; ?>
        <?php if ( 'post' === get_post_type() ) : ?>
          <div class="release-meta">
            <?php
            $year = get_post_meta( $post->ID, 'release_year', true );
            $month = get_post_meta( $post->ID, 'release_month', true );
            $year_month = $year . '-' . $month;
            printf( '<p>%1$s%2$s</p>', esc_html__( 'Release: ', 'gachafan' ), date_i18n( __('M. Y', 'gachafan'), strtotime($year_month) ) );
            ?>
          </div><!-- .release-meta -->
        <?php endif; ?>
      </header><!-- .entry-header -->

      <div class="entry-summary">
        <?php the_excerpt(); ?>
      </div><!-- .entry-summary -->

      <footer class="entry-meta">
      <?php if ( 'post' == get_post_type() ) : // List category and tag text for posts ?>
        <?php
          /* translators: used between list items, there is a space after the comma */
          $categories_list = get_the_category_list( esc_html__( ' ', 'gachafan' ) );
          if ( $categories_list && gachafan_categorized_blog() ) :
        ?>
          <span class="cat-links">
            <?php printf( '%1$s', $categories_list ); ?>
          </span>
        <?php endif; // End if categories ?>

        <?php
          /* translators: used between list items, there is a space after the comma */
          $tags_list = get_the_tag_list( '', esc_html__( ' ', 'gachafan' ) );
          if ( $tags_list ) :
        ?>
          <span class="tags-links">
            <?php printf( '<i class="fa fa-tags fa-fw" aria-hidden="true"></i>%1$s', $tags_list ); ?>
          </span>
        <?php endif; // End if $tags_list ?>
      <?php endif; // End if 'post' == get_post_type() ?>

      <?php if ( 'gf_blog' == get_post_type() ) : // List taxonomy for custom post type ?>
        <?php
          $keyword_list = get_the_term_list( $post_ID, 'keyword', '<li>', '</li><li>', '</li>' );
          if ( $keyword_list ) :
        ?>
          <span class="keyword-links">
            <?php printf( '<ul>%1$s</ul>', $keyword_list ); ?>
          </span>
        <?php endif; // End if $keyword_list ?>
      <?php endif; // End if 'gf_blog' == get_post_type() ?>

      <?php edit_post_link( esc_html__( 'Edit', 'gachafan' ), '<span class="edit-link">', '</span>' ); ?>
      </footer><!-- .entry-meta -->
    </div><!-- 9 title excerpt -->
  </div><!-- .row -->
</article><!-- #post-## -->
