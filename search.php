<?php get_header(); ?>
	<div id="content">
		<div id="main-content">
	<?php if (have_posts()) : ?>
		<p class="string"><?php _e('You searched for the following','min'); ?>: "<strong><?php echo esc_html($s); ?></strong>"</p>
		<a href="<?php echo get_option('home'); ?>/" class="back"><?php _e('Back home','min'); ?></a>
		<h2 class="error"><?php _e('Search results','min'); ?></h2>
		<?php while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<?php echo get_post_masthead( get_the_ID() ); ?>
					<div class="post-content">
						<h2 class="mobile-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<span class="date mobile-header">
							by <?php the_author_posts_link(); ?>
							on <a href="<?php the_permalink() ?>"><?php the_time(__('m/j/Y','min')) ?></a>
							in <?php the_category(', ') ?>
						</span>
						<div class="clearfix"></div>
						<div class="post-footer">
							<div class="entry">
								<?php the_content(__('Continue Reading','min').' &raquo;'); ?>
							</div>
							<span class="number-of-comments">
								<a href="<?php the_permalink() ?>#comments" title="title">
									<?php comments_number(__('No Comments','min'), __('1 Comment','min'), __('% Comments','min'));?>
								</a>
							</span>
						</div>
					</div><!-- /.post-content -->
				</div><!-- /.post -->
		<?php endwhile; ?>
		<div class="pagination clearfix">
			<div class="prev"><?php next_posts_link('&laquo; '.__('Previous posts','min')) ?></div>
			<div class="next"><?php previous_posts_link(__('Newer posts','min').' &raquo;') ?></div>
		</div>
	<?php else : ?>
		<p class="string"><?php _e('You searched for the following','min') ?>: "<strong><?php echo esc_html($s); ?></strong>"</p>
		<a href="<?php echo get_option('home'); ?>/" class="back"><?php _e('Back home','min'); ?></a>
		<h2 class="error"><?php _e('We didn\'t find anything. Try a different search or look in the categories below.','min'); ?></h2>
	<?php endif; ?>
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
