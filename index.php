<?php get_header(); ?>
	<div id="content">
		<div id="main-content">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<div class="post-masthead">						
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
					</div>
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
			<p class="string"><?php _e('You broke the interwebs... wow... way to go.. no really you may want to call someone to take a look at it..','min'); ?></p>
			<a href="<?php echo get_option('home'); ?>/" class="back"><?php _e('Back home','min'); ?></a>
		<?php endif; ?>
		</div><!-- /#main-content -->
		<?php get_sidebar(); ?>
	</div><!-- /#content -->
<?php get_footer(); ?>