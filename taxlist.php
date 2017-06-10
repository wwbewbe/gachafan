<div class="taxlist">
	<?php
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$args = array(
		'post_type' => explode( ',', $posttype ), // 投稿タイプ
		'category__not_in' => array(1), // 未分類の記事は非表示
    'tag'           => $tagname, // タグを指定(slug)
		'category_name'	=> $catname, // カテゴリーを指定(slug)
		'paged' => $paged,
  );
	if ( $list ) $args += array( 'posts_per_page' => $list ); // リスト数を指定
	if ( $keyword ) { // keywordタクソノミーを指定
		$keyword = explode( ',', $keyword );
		$args += array( 'tax_query' => array(
			array(
				'taxonomy' => 'keyword',
				'field'    => 'slug',
				'terms'    => $keyword,
			),
		) );
	}
	?>
	<?php $the_query = new WP_Query( $args ); ?>

	<?php if( $the_query->have_posts() ): while( $the_query->have_posts() ):
	$the_query->the_post();

		get_template_part( 'template-parts/content', get_post_format() );

	endwhile; ?>
	<div class="pagination pagination-index">
		<?php echo paginate_links( array( 'type' => 'list',
								'prev_text' => '&laquo;',
								'next_text' => '&raquo;',
								'total' => $the_query->max_num_pages,
								 ) );
//            the_posts_navigation();?>
	</div>
	<?php endif; ?>

  <?php wp_reset_postdata(); ?>
</div>
