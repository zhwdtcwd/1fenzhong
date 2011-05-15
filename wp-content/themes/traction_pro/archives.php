<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
	<div id="main-top">
		<div class="main-top-left">
			<h4><?php the_title(); ?></h4>
			<div class="archive-comments">
				<img src="<?php bloginfo( 'template_url' ); ?>/images/main-comment.png" alt="<?php _e( 'Comments', 'traction' ); ?>">
			</div>
		</div>
		<?php if (is_file(STYLESHEETPATH . '/subscribe.php' )) include(STYLESHEETPATH . '/subscribe.php' ); else include(TEMPLATEPATH . '/subscribe.php' ); ?>
	</div>
	<div id="main" class="clear">
		<div id="content">
			<div class="p-archives">
				<?php query_posts( 'showposts=25' ); ?>
				<?php if ( have_posts() ) : ?>
					<ul>
				<?php while (have_posts()) : the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><span class="comments_number"><?php comments_number( '0', '1', '%', '' ); ?></span><span class="archdate"><?php the_time(__ ( 'n.j.y', 'traction' )); ?></span><?php the_title(); ?></a></li>
				<?php endwhile; endif; ?>
					</ul>
			</div><!--end p-archives-->
			<div class="entry page">
				<h3><?php _e( 'Monthly Archives', 'traction' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly&show_post_count=1' ); ?>
				</ul>
			</div><!--end entry-->
		</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>