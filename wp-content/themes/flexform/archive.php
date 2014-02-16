<?php get_header(); ?>
	
<?php 

	$options = get_option('sf_flexform_options');
	$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
	$sidebar_config = $options['archive_sidebar_config'];
	$left_sidebar = $options['archive_sidebar_left'];
	$right_sidebar = $options['archive_sidebar_right'];
	$blog_type = $options['archive_display_type'];
	
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
	
	$list_class = $item_class = '';
	
	if ($blog_type == "mini") {
		if ($sidebar_config == "both-sidebars") {
		$item_class = "span6";
		} else if ($sidebar_config == "right-sidebar" || $sidebar_config == "left-sidebar") {
		$item_class = "span8";
		} else {
		$item_class = "span12";
		}
	} else if ($blog_type == "masonry") {
		if ($sidebar_config == "both-sidebars") {
		$item_class = "span3";
		} else {
		$item_class = "span4";
		}
	} else {
		if ($sidebar_config == "both-sidebars") {
		$standard_post_width = "span5";
		} else if ($sidebar_config == "right-sidebar" || $sidebar_config == "left-sidebar") {
		$standard_post_width = "span6";
		} else {
		$standard_post_width = "span10";
		}
	}
	
	if ($blog_type == "masonry") {
	$list_class .= 'row masonry-items';
	$item_class .= ' recent-post';
	} else if ($blog_type == "mini") {
	$list_class .= 'row mini-items';
	} else {
	$list_class .= 'standard-items';
	}
	
	if ($blog_type == "masonry") {
	global $include_isotope;
	$include_isotope = true;
	}
	
	global $has_blog;
	$has_blog = true;
	
	global $sidebars;
	$sidebars = $sidebar_config;

?>

<div class="row">
	<div class="page-heading span12 clearfix alt-bg <?php echo $default_page_heading_bg_alt; ?>">
		<!-- Conditional Statements for .page-heading -->
		<?php /* If this is a tag archive */ if( is_tag() ) { ?>
		<h1><?php _e("Posts tagged with", "swiftframework"); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h1>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1><?php _e("Archive for", "swiftframework"); ?> <?php the_time('F jS, Y'); ?></h1>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1><?php _e("Archive for", "swiftframework"); ?> <?php the_time('F, Y'); ?></h1>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1><?php _e("Archive for", "swiftframework"); ?> <?php the_time('Y'); ?></h1>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<?php $author = get_userdata( get_query_var('author') );?>
		<h1><?php _e("Author archive for", "swiftframework"); ?> <?php echo $author->display_name;?></h1>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1><?php _e("Blog Archives", "swiftframework"); ?></h1>
		<?php } else { ?>
		<h1><?php wp_title(''); ?></h1>
		<?php } ?>
	</div>
</div>

<?php 
	// BREADCRUMBS
	echo sf_breadcrumbs();
?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
	<!-- OPEN page -->
	<?php if ($sidebar_config == "left-sidebar" || $sidebar_config == "right-sidebar") { ?>
	<div class="archive-page span8 clearfix">
	<?php } else if ($sidebar_config == "both-sidebars") { ?>
	<div class="archive-page row clearfix">
	<?php } else { ?>
	<div class="archive-page clearfix">
	<?php } ?>
	
		<?php if ($sidebar_config == "both-sidebars") { ?>
			
			<div class="page-content span6 clearfix">
			
				<?php if(have_posts()) : ?>
					
					<div class="blog-wrap">
					
						<!-- OPEN .blog-items -->
						<ul class="blog-items <?php echo $list_class; ?> clearfix">
				
						<?php while (have_posts()) : the_post(); ?>
				
							<?php 
								$post_format = get_post_format($post->ID);
								if ( $post_format == "" ) {
									$post_format = 'standard';
								}
							?>
							<li class="blog-item <?php echo $item_class; ?> format-<?php echo $post_format; ?>">
								<?php echo sf_get_post_item($post->ID, $blog_type); ?>
							</li>
				
						<?php endwhile; ?>
								
						<!-- CLOSE .blog-items -->
						</ul>
					
					</div>
					
				<?php else: ?>
					
				<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
			
				<?php endif; ?>
				
				<div class="pagination-wrap">
					<?php echo pagenavi($wp_query); ?>									
				</div>
				
			</div>
				
			<aside class="sidebar left-sidebar span3">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
		
		<?php } else { ?>
		
		<div class="page-content clearfix">

			<?php if(have_posts()) : ?>
				
				<div class="blog-wrap">
				
					<!-- OPEN .blog-items -->
					<ul class="blog-items <?php echo $list_class; ?> clearfix">
			
					<?php while (have_posts()) : the_post(); ?>
			
						<?php 
							$post_format = get_post_format($post->ID);
							if ( $post_format == "" ) {
								$post_format = 'standard';
							}
						?>
						<li class="blog-item <?php echo $item_class; ?> format-<?php echo $post_format; ?>">
							<?php echo sf_get_post_item($post->ID, $blog_type); ?>
						</li>
			
					<?php endwhile; ?>
							
					<!-- CLOSE .blog-items -->
					</ul>
					
				</div>
		
			<?php else: ?>
				
			<h3><?php _e("Sorry, there are no posts to display.", "swiftframework"); ?></h3>
		
			<?php endif; ?>
		
			<div class="pagination-wrap">
				<?php echo pagenavi($wp_query); ?>									
			</div>
			
		</div>
		
		<?php } ?>	
	
	<!-- CLOSE page -->
	</div>
	
	<?php if ($sidebar_config == "left-sidebar") { ?>
		
		<aside class="sidebar left-sidebar span4">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>

	<?php } else if ($sidebar_config == "right-sidebar") { ?>
		
		<aside class="sidebar right-sidebar span4">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
		
	<?php } else if ($sidebar_config == "both-sidebars") { ?>

		
		<aside class="sidebar right-sidebar span3">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
	
	<?php } ?>

</div>

<!--// WordPress Hook //-->
<?php get_footer(); ?>