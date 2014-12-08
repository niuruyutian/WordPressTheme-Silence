<div class="postbg" <?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?> style="background-image: url('<?php echo $image[0]; ?>')" <?php endif; ?>>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="fomatlogo">
			<a href="<?php echo get_permalink(); ?>">
				<i class="fa fa-coffee fa-3x" title="状态"></i>
			</a>
			<div class="statusmeta">
				<span class="date"><?php the_time('Y年n月j日') ?></span>
			</div>
		</div>
		<div class="statuscontent">
			
			<?php the_content( __( '<span class="meta-nav" title="继续阅读"></span>' )); ?>
		</div><!-- .entry-content -->
		<div class="clear"></div>
	</div><!-- #post -->

</div><!-- end bg -->
