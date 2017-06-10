<?php
/**
 * Widget API: Widget_Recent_Posts class
 *
 * @package My Original
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @see WP_Widget
 */
class Widget_Recent_Posts extends WP_Widget {

  /**
   * Sets up a new Recent Posts widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops = array(
      'classname' => 'widget_recent_entries',
      'description' => __( 'Your site&#8217;s most recent Posts.' ),
      'customize_selective_refresh' => true,
    );
    parent::__construct( 'recent-posts', __( 'Recent Posts with Thumbnail' ), $widget_ops );
    $this->alt_option_name = 'widget_recent_entries';
  }

  /**
   * Outputs the content for the current Recent Posts widget instance.
   *
   * @access public
   *
   * @param array $args     Display arguments including 'before_title', 'after_title',
   *                        'before_widget', and 'after_widget'.
   * @param array $instance Settings for the current Recent Posts widget instance.
   */
  public function widget( $args, $instance ) {
    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
    if ( ! $number )
      $number = 5;
    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    /**
     * Filters the arguments for the Recent Posts widget.
     *
     * @see WP_Query::get_posts()
     *
     * @param array $args An array of arguments used to retrieve the recent posts.
     */
    $r = new WP_Query( apply_filters( 'widget_recent_posts_args', array(
      'posts_per_page'      => $number,
      'no_found_rows'       => true,
      'post_status'         => 'publish',
      'ignore_sticky_posts' => true
    ) ) );

    if ($r->have_posts()) :
    ?>
    <?php echo $args['before_widget']; ?>
    <?php if ( $title ) {
      echo $args['before_title'] . $title . $args['after_title'];
    } ?>
    <ul>
    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
      <li>
        <a href="<?php the_permalink(); ?>">
        <div class="recent-thumb" style="background-image: url(<?php echo get_thumbnail_url( 'medium' ); ?>)"></div>
        <div class="recent-text"><?php get_the_title() ? the_title() : the_ID(); ?>
          <?php if ( $show_date ) : ?>
            <div class="post-date"><?php echo get_the_date(); ?></div>
          <?php endif; ?>
        </div>
      </a>
      </li>
    <?php endwhile; ?>
    </ul>
    <?php echo $args['after_widget']; ?>
    <?php
    // Reset the global $the_post as this query will have stomped on it
    wp_reset_postdata();

    endif;
  }

  /**
   * Handles updating the settings for the current Recent Posts widget instance.
   *
   * @access public
   *
   * @param array $new_instance New settings for this instance as input by the user via
   *                            WP_Widget::form().
   * @param array $old_instance Old settings for this instance.
   * @return array Updated settings to save.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = sanitize_text_field( $new_instance['title'] );
    $instance['number'] = (int) $new_instance['number'];
    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
    return $instance;
  }

  /**
   * Outputs the settings form for the Recent Posts widget.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {
    $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
    <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

    <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
  }
}
