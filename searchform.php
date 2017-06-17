<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label>
    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
  </label>
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />

  <span class="search-title"><?php echo esc_html__( 'Category: ', 'gachafan' ); ?></span>
  <?php $cats = get_categories(); if ($cats) : ?>
    <?php foreach ( $cats as $cat ): ?>
      <div class="search-checkbox">
      <label><input type="checkbox" name="cat[]" value="<?php echo $cat->cat_ID; ?>"><?php echo esc_html( $cat->name ); ?></label>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <span class="search-title"><?php echo esc_html__( 'Tag: ', 'gachafan' ); ?></span>
  <?php $tags = get_tags(); if ( $tags ) : ?>
    <select class="search-pulldown" name='tag' id='tag'>
      <option value="" selected="selected"><?php echo esc_html__('All tags', 'gachafan'); ?></option>
      <?php foreach ( $tags as $tag ): ?>
        <option value="<?php echo esc_html( $tag->slug ); ?>"><?php echo esc_html( $tag->name ); ?></option>
      <?php endforeach; ?>
    </select>
  <?php endif; ?>

  <span class="search-title"><?php echo esc_html__( 'Release Date: ', 'gachafan' ); ?></span>
  <?php $dates = array('2017/1', '2017/2', '2017/3', '2017/4', '2017/5', '2017/6', '2017/7', '2017/8', '2017/9', '2017/10', '2017/11', '2017/12', '2016', '2015'); if ( $dates ) : ?>
    <select class="search-release" name='release_date' id='release_date'>
      <option value="" selected="selected"><?php echo esc_html__('All days', 'gachafan'); ?></option>
      <?php foreach ( $dates as $date ): ?>
        <option value="<?php echo esc_html( $date ); ?>"><?php echo esc_html( $date ); ?></option>
      <?php endforeach; ?>
    </select>
  <?php endif; ?>

  <button type="submit" class="search-btn"><?php echo esc_html__( 'Search', 'submit button' ) ?></button>
</form>
