<?php

/**
 * Calls the class on the post edit screen.
 */
function call_metaboxClass() {
    new metaboxClass();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_metaboxClass' );
    add_action( 'load-post-new.php', 'call_metaboxClass' );
}

/**
 * The Class.
 */
class metaboxClass {

  /**
   * Hook into the appropriate actions when the class is constructed.
   */
  public function __construct() {
    add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
    add_action( 'save_post', array( $this, 'save' ) );
  }

  /**
   * Adds the meta box container.
   */
  public function add_meta_box( $post_type ) {
    $post_types = array('post');     //limit meta box to certain post types
    if ( in_array( $post_type, $post_types )) {
      add_meta_box(
        'gachapon_info',
        __( 'Gachapon Info Meta Box', 'gachafan' ),
        array( $this, 'render_meta_box_content' ),
        $post_type,
        'normal',
        'high'
      );
    }
  }

  /**
   * Save the meta when the post is saved.
   *
   * @param int $post_id The ID of the post being saved.
   */
  public function save( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['custom_fields_nonce'] ) )
      return $post_id;

    $nonce = $_POST['custom_fields_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'save_custom_fields_data' ) )
      return $post_id;

    // If this is an autosave, our form has not been submitted,
    //     so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return $post_id;

    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {

      if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;

    } else {

      if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    }

    /* OK, its safe for us to save the data now. */
    $post_keys = array( // true:単一文字列, false:複数配列
      'release_date' => true,
      'price' => true,
      'types' => true,
    );

    foreach ($post_keys as $post_key => $unique) {
      // single(単一文字列)
      if ($unique && isset($_POST[$post_key])) {
        // Sanitize the user input.
        $mydata = sanitize_text_field( $_POST[$post_key] );
        // Update the meta field in the database.
        update_post_meta(
          $post_id,			// post ID
          $post_key,			// Custom Field Key
          $mydata //$_POST[$post_key]	// Value
        );
      // multiple(複数配列)
      } elseif (isset($_POST[$post_key])) {
        $input_vals = (array)$_POST[$post_key];
        delete_post_meta(
        $post_id,	// post ID
        $post_key	// Custom Field Key
        );
        foreach ($input_vals as $input_val) {
          add_post_meta(
          $post_id,	// post ID
          $post_key,	// Custom Field Key
          $input_val,	// Value
          false		// true:同じキーがあれば追加しない, false:同じキーがあっても追加する
          );
        }
      }
    }
  }

  /**
   * Render Meta Box content.
   *
   * @param WP_Post $post The post object.
   */
  public function render_meta_box_content( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'save_custom_fields_data', 'custom_fields_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    // table
    echo '<table style="width:100%;text-align:left;"><tbody>';

    //Textfield for Release Date
    $value = get_post_meta(
      $post->ID, //post ID
      'release_date', //Custom Field Key
      true //true:単一文字列, false:複数配列
    );
    echo '<tr>';
    echo   '<th style="width:10%;">';
    echo     '<label for="release_date">';
    _e( 'Release Date', 'gachafan' );
    echo     '</label>';
    echo   '</th>';
    echo   '<td style="width:90%;">';
//    echo     '<textarea id="release_date" name="release_date" style="width:100%">'.$value.'</textarea>';
    echo     '<input type="text" id="release_date" name="release_date"';
    echo     ' value="' . esc_attr( $value ) . '" size="25" />';
    echo   '</td>';
    echo '</tr>';

    //Textfield for Price
    $value = get_post_meta(
      $post->ID, //post ID
      'price', //Custom Field Key
      true //true:単一文字列, false:複数配列
    );
    echo '<tr>';
    echo   '<th style="width:10%;">';
    echo     '<label for="price">';
    _e( 'Price', 'gachafan' );
    echo     '</label>';
    echo   '</th>';
    echo   '<td style="width:90%;">';
//    echo     '<textarea id="price" name="price" style="width:100%">'.$value.'</textarea>';
    echo     '<input type="text" id="price" name="price"';
    echo     ' value="' . esc_attr( $value ) . '" size="25" />';
    echo   '</td>';
    echo '</tr>';

    //Textfield for Types
    $value = get_post_meta(
      $post->ID, //post ID
      'types', //Custom Field Key
      true //true:単一文字列, false:複数配列
    );
    echo '<tr>';
    echo   '<th style="width:10%;">';
    echo     '<label for="types">';
    _e( 'Types', 'gachafan' );
    echo     '</label>';
    echo   '</th>';
    echo   '<td style="width:90%;">';
//    echo     '<textarea id="types" name="types" style="width:100%">'.$value.'</textarea>';
    echo     '<input type="text" id="types" name="types"';
    echo     ' value="' . esc_attr( $value ) . '" size="25" />';
    echo   '</td>';
    echo '</tr>';

    echo '<p style="clear:left;"></p>';
  	echo '</table></tbody>';

  }
}
