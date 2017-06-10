<?php
/**
 * Widget API: Widget_Pickup_Posts class
 *
 * @package My Original
 */

/**
 * Core class used to implement a Pickup Posts widget.
 *
 * @see WP_Widget
 */
class Widget_Pickup_Posts extends WP_Widget {

  /**
   * Sets up a new Pickup Posts widget instance.
   *
   * @access public
   */
  public function __construct() {
    $widget_ops = array(
      'classname' => 'widget_pickup_entries',
      'description' => __( 'Your site&#8217;s most pickup Posts.' ),
      'customize_selective_refresh' => true,
    );
    parent::__construct( 'pickup-posts', __( 'Pickup Posts with Thumbnail' ), $widget_ops );
    $this->alt_option_name = 'widget_pickup_entries';
  }

  /**
   * Outputs the content for the current Pickup Posts widget instance.
   *
   * @access public
   *
   * @param array $args     Display arguments including 'before_title', 'after_title',
   *                        'before_widget', and 'after_widget'.
   * @param array $instance Settings for the current Pickup Posts widget instance.
   */
  public function widget( $args, $instance ) {
    /**
     * define global $post to handle actual post from function.php
     */
     global $post;

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Pickup Posts' );

    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    /**
     * Filters the arguments for the Pickup Posts widget.
     *
     * @see get_post() wp_get_nav_menu_items()
     *
     * @param array $args An array of arguments used to retrieve the pickup posts.
     */
    $location_name = 'pickupnav';
    $locations = get_nav_menu_locations();
    $myposts = wp_get_nav_menu_items( $locations[ $location_name ] );
    if( $myposts ): ?>
    <?php echo $args['before_widget']; ?>
     <?php if ( $title ) {
       echo $args['before_title'] . $title . $args['after_title'];
     } ?>
    <ul>
    <?php foreach($myposts as $post):
      if( ($post->object == 'post') || ($post->object == 'page') ):
      $nav_title = $post->title;    // ナビゲーションラベル名
      $post = get_post( $post->object_id );
      setup_postdata($post); ?>

      <li>
        <a href="<?php the_permalink(); ?>">
        <div class="pickup-thumb" style="background-image: url(<?php echo get_thumbnail_url( 'medium' ); ?>)"></div>
        <div class="pickup-text"><?php echo $nav_title; // ナビゲーションラベル名使用 get_the_title() ? the_title() : the_ID(); ?>
          <?php if ( $show_date ) : ?>
            <div class="post-date"><?php echo get_the_date(); ?></div>
          <?php endif; ?>
        </div>
        </a>
      </li>

    <?php endif;
    endforeach; ?>

    </ul>
    <?php echo $args['after_widget']; ?>
    <?php
    // Reset the global $the_post as this query will have stomped on it
    wp_reset_postdata();

    endif;
  }

  /**
   * Handles updating the settings for the current Pickup Posts widget instance.
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
    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
    return $instance;
  }

  /**
   * Outputs the settings form for the Pickup Posts widget.
   *
   * @access public
   *
   * @param array $instance Current settings.
   */
  public function form( $instance ) {
    $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
  }
}
