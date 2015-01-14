<?php get_header(); ?>
	<div id="content">
		<div id="main-content">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<?php echo get_post_masthead( get_the_id() ); ?> 
					<div class="post-content">
						<h2 class="mobile-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						
						<?php if ( !is_page() ) { ?>
							<div class="date mobile-header">
								posted by <?php the_author_posts_link(); ?>
								<a href="<?php the_permalink() ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></a>
								in <?php the_category(', ') ?> <br> 
							</div>
						<?php } ?>

						<div class="entry">
							<?php the_content( __('Continue reading','min') . ' &raquo;' ); ?>
						</div>

						<div class="clearfix"></div>

						<div class="post-footer">
							<?php the_tags('', '  /  ', '') ?>
						</div><!-- /.post-footer -->

					</div><!-- /.post-content -->
				</div><!-- /.post -->
			<?php endwhile; ?>
			<div class="pagination clearfix">
				<div class="prev"><?php next_posts_link('&laquo; '.__('Previous posts','min')) ?></div>
				<div class="next"><?php previous_posts_link(__('Newer posts','min').' &raquo;') ?></div>
			</div><!-- /.pagination -->
		<?php else : ?>
			<p class="string"><?php _e('Hmm, it looks like I can\'t find anything here.','min'); ?></p>
			<a href="<?php echo get_option('home'); ?>/" class="back"><?php _e('Back home','min'); ?></a>
		<?php endif; ?>
		</div><!-- /#main-content -->
		<?php get_sidebar(); ?>
	</div><!-- /#content -->
<?php get_footer(); ?>
