<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GachaFan
 */

?>

  </div><!-- #content -->

  <?php if ( ! is_home() && ! is_front_page() && is_my_plugin_active( 'show-adsense/show-adsense.php' ) ) : ?>
    <div class="row">
      <div class="large-12 columns">
        <?php echo do_shortcode( '[showad id="footer"]' ); ?>
      </div>
    </div>
  <?php endif; ?>

  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="row">
      <div class="large-12 columns">
        <?php get_template_part('inc/snsbtn'); // add SNS button ?>
          <div class="site-info text-center">
            <p>Copyright&copy; 2017<?php if ( '2017' != ($date = date_i18n( 'Y' )) ) { echo ' - '.$date;}?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> All Rights Reserved.</p>
          </div><!-- .site-info -->
      </div>
    </div>
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
