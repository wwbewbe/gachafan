<?php
/**
 * The template for displaying front-page
 */
get_header(); ?>
  <div class="row front-feature">
    <?php
		$location_name = 'topicnav';
		$locations = get_nav_menu_locations();
		$myposts = wp_get_nav_menu_items( $locations[ $location_name ] );
		if( $myposts ): ?>
			<?php foreach($myposts as $post):
			if(( $post->object == 'post' ) || ( $post->object == 'page' )):
			$post = get_post( $post->object_id );
			setup_postdata($post); ?>

        <div class="large-4 columns">
        	<a href="<?php the_permalink(); ?>">
        	<img class="topic-thumbnail" src="<?php echo get_thumbnail_url( 'full' ); ?>">
        	<h5><?php the_title() ?></h5>
          <?php the_excerpt(); ?>
        	</a>
        </div>

			<?php endif;
			endforeach; ?>
		<?php wp_reset_postdata();
		endif; ?>
  </div>

  <?php
	$location_name = 'pickupnav';
	$locations = get_nav_menu_locations();
	$myposts = wp_get_nav_menu_items( $locations[ $location_name ] );
	if( $myposts ): ?>

    <div class="row front-feature">
    <h3><?php echo esc_html__( 'Feature Posts', 'gachafan' ); ?></h3>
		<?php foreach($myposts as $post):
		if(( $post->object == 'post' ) || ( $post->object == 'page' )):
		$post = get_post( $post->object_id );
		setup_postdata($post); ?>

      <div class="large-4 small-12 columns">
      	<a href="<?php the_permalink(); ?>">
          <div class="row">
            <div class="large-12 small-5 columns">
      	      <img class="topic-thumbnail" src="<?php echo get_thumbnail_url( 'feature-top-thumb' ); ?>">
            </div>
            <div class="large-12 small-7 columns">
              <h5><?php the_title() ?></h5>
              <?php if ( is_singular( 'gf_blog' ) ) :?>
                <div class="date">
                  <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                  <?php the_time( 'Y/m/d' ); ?>
                </div>
              <?php endif; ?>
              <?php the_excerpt(); ?>
            </div>
          </div>
      	</a>
      </div>

		<?php endif;
		endforeach; ?>
  	<?php wp_reset_postdata(); ?>
    </div>

	<?php endif; ?>

  <div class="front-news">
    <div class="row">
      <div class="large-12 columns">
        <h3><?php echo esc_html__( 'Latest Posts', 'gachafan' ); ?></h3>
        <div class="row">
          <?php
          $args = array(
            'post_type' => 'post',
            'posts_per_page' => '4',
          );
          $the_query = new WP_Query($args); ?>
          <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) :
            $the_query->the_post(); ?>
          <div class="large-3 small-12 columns">
            <a href="<?php the_permalink(); ?>">
              <div class="newspost">
                <div class="row">
                  <div class="large-12 small-5 columns">
                    <div class="thumbnail">
                      <img src="<?php echo get_thumbnail_url( 'latest-top-thumb' ); ?>" alt="" title="" />
                    </div>
                  </div>

                  <div class="large-12 small-7 columns">
                    <div class="news-meta">
                      <p>
                        <?php echo mb_substr( get_the_title(), 0, 40 ); ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php endwhile; endif; ?>
        <?php wp_reset_query(); ?>
        </div>
      </div>
    </div> <!-- /row -->
  </div> <!-- /front-news -->

  <div class="front-news">
    <div class="row">
      <div class="large-12 columns">
        <h3><?php echo esc_html__( 'Latest Blogs', 'gachafan' ); ?></h3>
        <div class="row">
          <?php
          $args = array(
            'post_type' => 'gf_blog',
            'posts_per_page' => '4',
          );
          $the_query = new WP_Query($args); ?>
          <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) :
            $the_query->the_post(); ?>
          <div class="large-3 small-12 columns">
            <a href="<?php the_permalink(); ?>">
              <div class="newspost">
                <div class="row">
                  <div class="large-12 small-5 columns">
                    <div class="thumbnail">
                      <img src="<?php echo get_thumbnail_url( 'latest-top-thumb' ); ?>" alt="" title="" />
                    </div>
                  </div>

                  <div class="large-12 small-7 columns">
                    <div class="news-meta">
                      <div class="date">
                        <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                        <?php the_time( 'Y/m/d' ); ?>
                      </div>
                      <p>
                        <?php echo mb_substr( get_the_title(), 0, 40 ); ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php endwhile; endif; ?>
        <?php wp_reset_query(); ?>
        </div>
      </div>
    </div> <!-- /row -->
  </div> <!-- /front-news -->

  <div class="row front-sp front-feature">
    <?php if ( get_page_by_path( 'howtobuy' ) ) : ?>
      <div class="large-4 columns">
        <div class="sep">
          <a href="<?php echo get_permalink( get_page_by_path( 'howtobuy' )->ID ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/gacha-how-to-buy.png" alt=""></a>
          <h5><a href="<?php echo get_permalink( get_page_by_path( 'howtobuy' )->ID ); ?>"><?php echo esc_html__( 'How to buy', 'gachafan' ); ?></a></h5>
          <p><?php echo esc_html__( 'This page describe how to buy Gacahpon.', 'gachafan' ); ?></p>
        </div>
      </div>
    <?php endif; ?>
    <div class="large-4 columns">
      <div class="sep">
        <h5><?php echo esc_html__( 'About GachaFan', 'gachafan' ); ?></h5>
        <div class="circle">
          <img src="<?php echo get_template_directory_uri(); ?>/img/about.png" alt="" width="100" hight="100" />
        </div>
        <p style="font-size:12px;"><?php echo esc_html__( 'GachaFan is exciting gachapon information site to show any kind of gachapon. You can find your favorite gachapon in this site. Many gachapon made based on Japanese culture like Amine, Traditional goods, Daily necessities, etc. This site provide various information in English. You can easily get anything gachapon information.', 'gachafan' ); ?></p>
      </div>
    </div>
    <?php if ( get_page_by_path( 'contact' ) ) : ?>
      <div class="large-4 columns">
        <div class="sep">
          <a href="<?php echo get_permalink( get_page_by_path( 'contact' )->ID ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/contact.png" alt=""></a>
          <h5><a href="<?php echo get_permalink( get_page_by_path( 'contact' )->ID ); ?>"><?php echo esc_html__( 'Contact', 'gachafan' ); ?></a></h5>
          <p><?php echo esc_html__( 'If you have any questions or comments, please contact me in this form.', 'gachafan' ); ?></p>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <div id="main" class="site-main row">
<?php get_footer(); ?>
