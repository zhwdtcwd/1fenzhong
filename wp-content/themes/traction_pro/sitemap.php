<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>
	<div id="main-top">
		<?php if (is_file(STYLESHEETPATH . '/subscribe.php' )) include(STYLESHEETPATH . '/subscribe.php' ); else include(TEMPLATEPATH . '/subscribe.php' ); ?>
	</div>
	<div id="main" class="clear">
		<div id="content">
			<h1 class="title"><?php the_title(); ?></h1>
			<div class="entry page">
				<h2><?php _e( 'Pages', 'traction' ); ?></h2>
				<ul>
					<?php wp_list_pages( 'sort_column=menu_order&depth=0&title_li=' ); ?>
				</ul>
				<h2><?php _e( 'Categories', 'traction' ); ?></h2>
				<ul>
					<?php wp_list_categories( 'depth=0&title_li=&show_count=1' ); ?>
				</ul>
				<h2><?php _e( 'Monthly Archives', 'traction' ); ?></h2>
				<ul>
					<?php wp_get_archives( 'type=monthly&limit=12' ); ?>
				</ul>
			</div><!--end entry-->
		</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>