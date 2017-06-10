<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package GachaFan
 */

if ( ! function_exists( 'gachafan_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function gachafan_posted_on() {
  $time_string = '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i><time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i><time class="entry-date published" datetime="%1$s">%2$s</time> | <i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i><time class="updated" datetime="%3$s">%4$s</time>';
  }

  $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( 'c' ) ),
    esc_html( get_the_modified_date() )
  );

  $posted_on = sprintf(
    esc_html_x( '%s', 'post date', 'gachafan' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );

//  echo '<span class="posted-on">' . $posted_on . '</span>';
  echo '<span class="posted-on">' . $time_string . '</span>';

}
endif;

if ( ! function_exists( 'gachafan_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function gachafan_entry_footer() {
  // Hide category and tag text for pages.
  if ( 'post' === get_post_type() ) {
    /* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list( esc_html__( ' ', 'gachafan' ) );
    if ( $categories_list && gachafan_categorized_blog() ) {
      printf( '<span class="cat-links">%1$s</span>', $categories_list );
    }

    /* translators: used between list items, there is a space after the comma */
    $tags_list = get_the_tag_list( '', esc_html__( ' ', 'gachafan' ) );
    if ( $tags_list ) {
      printf( '<span class="tags-links"><i class="fa fa-tags fa-fw" aria-hidden="true"></i>%1$s</span>', $tags_list );
    }
  }
  if ( 'gf_blog' === get_post_type() ) {
    $keyword_list = get_the_term_list( $post_ID, 'keyword', '<li>', '</li><li>', '</li>' );
    if ( $keyword_list ) {
      printf( '<span class="keyword-links"><ul>%1$s</ul></span>', $keyword_list );
    }
  }

  if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
    echo '<span class="comments-link">';
    /* translators: %s: post title */
    comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'gachafan' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
    echo '</span>';
  }

  edit_post_link(
    sprintf(
      /* translators: %s: Name of current post */
      esc_html__( 'Edit %s', 'gachafan' ),
      the_title( '<span class="screen-reader-text">"', '"</span>', false )
    ),
    '<span class="edit-link">',
    '</span>'
  );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function gachafan_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'gachafan_categories' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
      'fields'     => 'ids',
      'hide_empty' => 1,
      // We only need to know if there is more than one category.
      'number'     => 2,
    ) );

    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'gachafan_categories', $all_the_cool_cats );
  }

  if ( $all_the_cool_cats > 1 ) {
    // This blog has more than 1 category so gachafan_categorized_blog should return true.
    return true;
  } else {
    // This blog has only 1 category so gachafan_categorized_blog should return false.
    return false;
  }
}

/**
 * Flush out the transients used in gachafan_categorized_blog.
 */
function gachafan_category_transient_flusher() {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  // Like, beat it. Dig?
  delete_transient( 'gachafan_categories' );
}
add_action( 'edit_category', 'gachafan_category_transient_flusher' );
add_action( 'save_post',     'gachafan_category_transient_flusher' );

if ( ! function_exists( 'gachafan_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own gachafan_post_thumbnail() function to override in a child theme.
 *
 * @since GachaFan 1.0
 */
function gachafan_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

	<?php endif; // End is_singular()
}
endif;
