<?php
/**
 * Template part for displaying post contents
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GachaFan
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>

    <ul class="sns-wrap">
    <li>
      <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
    </li>
    <li>
      <div class="fb-like" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    </li>
    <li>
      <div class="g-plusone" data-size="medium" data-annotation="none"></div>
    </li>
    <li>
      <div class="line-it-button" data-type="share-a" data-url="https://media.line.me/en/how_to_install" style="display: none;"></div>
    </li>
    </ul>

    <div class="entry-meta">
      <?php gachafan_posted_on(); ?>

      <?php
        /* translators: used between list items, there is a space after the comma */
        $tag_list = get_the_tag_list( '', esc_html__( ' ', 'gachafan' ) );
        $kwd_list = get_the_term_list( $post->ID, 'keyword', '', ' ', '');
        if ( ( '' != $tag_list ) || ( '' != $kwd_list ) ) {
          $meta_text = '<i class="fa fa-tags fa-fw" aria-hidden="true"></i>'.esc_html__( '%1$s ', 'gachafan' );
        } else {
          $meta_text = '<i class="fa fa-tags fa-fw" aria-hidden="true"></i>';
        }
      ?>

      <?php if ( '' != $tag_list ) : ?>
        <span class="tags-links">
          <?php
            printf(
              $meta_text,
              $tag_list,
              get_permalink(),
              the_title_attribute( 'echo=0' )
            );
          ?>
        </span>
      <?php endif; ?>

      <?php if ( '' != $kwd_list ) : ?>
        <span class="keyword-links">
          <?php
            printf(
              $meta_text,
              $kwd_list,
              get_permalink(),
              the_title_attribute( 'echo=0' )
            );
          ?>
        </span>
      <?php endif; ?>

    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php gachafan_post_thumbnail() ?>
    <?php the_content(); ?>
    <div class="pagination-centered">
      <?php
      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gachafan' ),
        'after'  => '</div>',
      ) );
      ?>
    </div>
  </div><!-- .entry-content -->

  <footer class="entry-meta">
    <?php
    edit_post_link(
      sprintf(
        /* translators: %s: Name of current post */
        esc_html__( 'Edit %s', 'gachafan' ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
      ),
      '<span class="edit-link">',
      '</span>'
    );
    ?>
  </footer><!-- .entry-meta -->
</article><!-- #post-## -->
