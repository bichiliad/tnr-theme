<?php get_header(); ?>
  <div id="content">
    <div id="main-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="post" id="post-<?php the_ID(); ?>">

		<?php 
			$embed_url = get_post_meta( get_the_ID(), 'embed', true );
			if ( $embed_url == '' ) {
				?><a href="<?php the_permalink() ?>"><?php
				the_post_thumbnail('full');
				?></a><?php
			} else {
				echo wp_oembed_get( $embed_url, array('color'=>'cccccc', 'show_comments'=>'false') );
			}
		 ?>
		<div class="post-content">
			<h2 class="mobile-header"><?php the_title(); ?></h2>
			<span class="date mobile-header">
			  by <?php the_author_posts_link(); ?>
			  on <a href="<?php the_permalink() ?>"><?php the_time(__('m/j/Y','min')) ?></a>
			  in <?php the_category(', ') ?>
			</span>
			<div class="entry">
			  <?php the_content(__('Read the rest of this post','min').' &raquo;'); ?>
			  <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages','min').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div>
			  <?php
				$orig_post = $post;
				global $post;
				$cats = wp_get_post_categories($post->ID);

				$post = $orig_post;
				wp_reset_query();
			  ?>
			</div>
		</div>
      </div>

    <?php comments_template(); ?>
    <?php endwhile; else: ?>
      <p class="string"><?php _e('Sorry, there are no posts about that.','min'); ?></p>
  <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
<?php get_footer(); ?>
