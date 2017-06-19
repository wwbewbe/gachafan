<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GachaFan
 */

get_header(); ?>

  <div id="primary" class="content-area large-9 columns">
    <?php if( has_category() ): ?>
      <div class="bread">
        <?php $postcats=get_the_category(); ?>
        <?php foreach( $postcats as $postcat ): ?>
          <ol>
            <li><a href="<?php echo home_url(); ?>">
            <i class="fa fa-home"></i><span>TOP</span>
            </a></li>

            <li>
            <?php echo get_category_parents( $postcat, true, '</li><li>' ); ?>
            <a><?php the_title(); ?></a>
            </li>
          </ol>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <main id="main" class="site-main" role="main">

    <?php
    while ( have_posts() ) : the_post();

      get_template_part( 'template-parts/content', 'single' );

      the_post_navigation();

      // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) :
        comments_template();
      endif;

    endwhile; // End of the loop.
    ?>

    </main><!-- #main -->

    <?php if( has_category() ) { // Related posts menu on each post
      $cats = get_the_category();
      $catkwds = array();
      foreach($cats as $cat) {
        $catkwds[] = $cat->term_id;
      }
    } ?>
    <?php if( has_term( '', 'keyword' ) ) { // Related posts menu on each post
      $keywords = get_the_terms( $post->ID, 'keyword' );
      $kwds = array();
      foreach($keywords as $keyword) {
        $kwds[] = $keyword->term_id;
      }
    } ?>
    <?php
    if ( is_singular( 'gf_blog' ) ) {
      $args = array(
        'post_type' => 'gf_blog',
        'posts_per_page' => '4',
        'post__not_in' => array( $post->ID ),
        'tax_query' => array(
      		array(
      			'taxonomy' => 'keyword',
      			'field'    => 'term_id',
      			'terms'    => $kwds,
      		),
      	),
        'orderby' => 'rand'
      );
    } else {
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => '4',
        'post__not_in' => array( $post->ID ),
        'category__in' => $catkwds,
        'orderby' => 'rand'
      );
    }
    $the_query = new WP_Query($args);
    ?>
    <?php if($the_query->have_posts()): ?>
      <aside class="site-related">
        <h2><?php esc_html_e( 'Related Posts', 'gachafan' ); ?></h2>
        <ul>
          <div class="row">
          <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="related-contents large-3 columns">
            <li>
              <a href="<?php the_permalink(); ?>">
              <div class="related-thumb" style="background-image: url(<?php echo get_thumbnail_url( 'medium' ); ?>)"></div>
              <div class="related-text">
                <?php the_title(); ?>
              </div>
              </a>
            </li>
            </div>
          <?php endwhile; ?>
          </div>
        </ul>
      </aside><!-- #site-related -->
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>

  </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
