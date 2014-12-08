<?php get_header(); ?>
	<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
	<div class="content">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			<h2 class="entry-title">
				<a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="post_meta">
				<span class="category"><?php the_category(', '); ?></span>
			</div>
			<?php the_content(); ?>
		</div><!-- post-->
	</div><!-- content -->

		<?php else : ?>
	    <div class="errorbox">
	        没有文章！
	    </div>
	    <?php endif; ?>
	<div class="clear"></div>
	<div class="comment-responsive">
		<?php comments_template(); ?>
	</div>
<?php get_footer(); ?>