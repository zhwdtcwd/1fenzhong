<div class="feature-top clear"></div>
<div id="feature" class="clear">
	<div class="feature-main">
		<div class="container">
			<div class="slides">
				<?php query_posts(array( 'post__in'=>get_option( 'sticky_posts' ))); ?>
				<?php global $more; $more = 0; ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); $count_1++; ?>
					<div id="slide-<?php echo $count_1; ?>" class="slide">
						<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail( 'feature-big', array( 'class' => 'feature-photo' )); ?>
						<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<?php the_content(__( 'Read more', 'traction' )); ?>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div><!--end feature-main-->
	<div class="feature-sidebar">
		<h2><?php _e( 'Featured Articles', 'traction' ); ?></h2>
		<ul class="pagination">
			<?php query_posts(array( 'post__in'=>get_option( 'sticky_posts' ))); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); $count_2++; ?>
				<?php $custom_field_description = get_post_meta($post->ID, 'short-description', $single = true); ?>
				<li id="slide-nav-<?php echo $count_2; ?>">
					<a class="clear" href="#">
						<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail( 'feature-small' ); ?>
						<strong><?php the_title(); ?></strong>
						<span><?php echo $custom_field_description; ?></span>
					</a>
				</li>
			<?php endwhile; endif; ?>
			<?php wp_reset_query(); ?>
		</ul>
		<?php if ($count_2 > 1) { ?>
			<div id="slider-arrows">
				<div class="slider-nav-left">
					<a class="previous" href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/feature-sld-nav-left.png" alt="Scroll left" width="32" height="27"/></a>
				</div>
				<div class="slider-nav-right">
					<a class="next" href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/feature-sld-nav-right.png" alt="Scroll right" width="32" height="27"/></a>
				</div>
			</div><!--end slider-arrows-->
		<?php } ?>
	</div><!--end feature-sidebar-->
</div><!--end feature-->
<div class="feature-bottom clear"></div>