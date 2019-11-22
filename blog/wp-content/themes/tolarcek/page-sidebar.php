<?php
/*
Template Name: Page with sidebar
*/

?>

<?php get_header(); 
?>
<!-- main content start -->
<div class="mainwrap sidebar">
	<!--rev slider-->
	<?php $postmeta = get_post_custom(get_the_id()); 
	if(!empty($postmeta["tolarcek_sigle_option_revslider"][0]) && function_exists('putRevSlider')) { ?>
		<div id="tolarcek-slider-wrapper" class="tolarcek-rev-slider">
		<?php putRevSlider(esc_attr($postmeta["tolarcek_sigle_option_revslider_alias"][0])); ?>
		</div>
	<?php } ?>	

	<div class="blogsingleimage">			
			<?php echo tolarcek_getImage(get_the_id(), 'tolarcek-postBlock'); ?>
	</div>
	<div class="main clearfix">
		
		<div class="content  singlepage">
			<div class="postcontent">
				<div class="posttext">
					<h1><?php the_title(); ?></h1>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="usercontent"><?php the_content(); ?></div>
					<?php endwhile; endif; ?>
				</div>
			</div>
			<div class="tolarcek-page-navigation">
				<?php wp_link_pages(); ?> 
			</div>
			<?php comments_template(); ?>	
		</div>

		<?php if(is_active_sidebar( 'tolarcek_sidebar' )) { ?>
			<div class="sidebar">	
				<?php dynamic_sidebar( 'tolarcek_sidebar' ); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>