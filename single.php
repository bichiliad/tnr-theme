<?php get_header(); ?>
	<div id="content">
    	<div id="main-content">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="post" id="post-<?php the_ID(); ?>">
				<?php echo get_post_masthead( get_the_ID() ); ?>
				<div class="post-content">
					<h2 class="mobile-header"><?php the_title(); ?></h2>

					<?php if ( !is_page() ) { ?>
						<span class="date mobile-header">
						  by <?php the_author_posts_link(); ?>
						  on <a href="<?php the_permalink() ?>"><?php the_time(__('m/j/Y','min')) ?></a>
						  in <?php the_category(', ') ?>
						</span>
					<?php } ?>
					<div class="entry">
						<?php the_content(__('Read the rest of this post','min').' &raquo;'); ?>
						<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages','min').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					</div><!-- ./entry -->
				</div><!-- ./post-content -->
			</div><!-- ./post -->

			<?php comments_template(); ?>
    	<?php endwhile; else: ?>
			<p class="string"><?php _e('Sorry, there are no posts about that.','min'); ?></p>
  		<?php endif; ?>
    	</div><!-- /#main-content -->
	    <?php get_sidebar(); ?>
	</div><!-- /#content -->
<?php get_footer(); ?>
