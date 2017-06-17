<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label>
    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
  </label>
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
  <?php $cats = get_categories(); if ($cats) : ?>
    <?php foreach ( $cats as $cat ): ?>
      <div class="search-checkbox">
      <label><input type="checkbox" name="cat" value="<?php echo $cat->cat_ID; ?>"><?php echo esc_html( $cat->name ); ?></label>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
  <?php $tags = get_tags(); if ( $tags ) : ?>
    <select class="search-pulldown" name='tag' id='tag'>
      <option value="" selected="selected"><?php echo esc_html__('All tags', 'gachafan'); ?></option>
      <?php foreach ( $tags as $tag ): ?>
        <option value="<?php echo esc_html( $tag->slug); ?>"><?php echo esc_html( $tag->name ); ?></option>
      <?php endforeach; ?>
    </select>
  <?php endif; ?>
  <button type="submit" class="search-btn" name="search-btn"><?php echo esc_html__( 'Search', 'submit button' ) ?></button>
</form>
