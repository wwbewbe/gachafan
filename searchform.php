<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label>
    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
  </label>
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />

  <span class="search-title"><?php echo esc_html__( 'Category: ', 'gachafan' ); ?></span>
  <?php $cats = get_categories(); if ($cats) : ?>
    <div class="search-checkbox">
      <?php foreach ( $cats as $cat ): ?>
        <label style="float:left; margin-right:10px"><input type="checkbox" name="cat[]" value="<?php echo $cat->cat_ID; ?>"><?php echo esc_html( $cat->name ); ?></label>
      <?php endforeach; ?>
      <p style="clear:left;"></p>
    </div>
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
  <?php $years = array('2014', '2015', '2016', '2017', '2018', '2019', '2020'); if ( $years ) : ?>
    <select class="search-release" name='release_year' id='release_year'>
      <option value="" selected="selected"><?php echo esc_html__('All years', 'gachafan'); ?></option>
      <?php foreach ( $years as $year ): ?>
        <option value="<?php echo esc_html( $year ); ?>"><?php echo esc_html( $year ); ?></option>
      <?php endforeach; ?>
    </select>
  <?php endif; ?>
  <?php $months = array(1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'May', 6=>'Jun', 7=>'Jul', 8=>'Aug', 9=>'Sep', 10=>'Oct', 11=>'Nov', 12=>'Dec'); if ( $months ) : ?>
    <select class="search-release" name='release_month' id='release_month'>
      <option value="" selected="selected"><?php echo esc_html__('All months', 'gachafan'); ?></option>
      <?php foreach ( $months as $month => $_name ): ?>
        <option value="<?php echo esc_html( $month ); ?>"><?php echo esc_html( $_name ); ?></option>
      <?php endforeach; ?>
    </select>
  <?php endif; ?>

  <button type="submit" class="search-btn"><?php echo esc_html__( 'Search', 'submit button' ) ?></button>
</form>
