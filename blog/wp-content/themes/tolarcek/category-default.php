
<!-- main content start -->
<div class="mainwrap blog <?php if(is_front_page()) echo 'home' ?> <?php if(!tolarcek_globals('use_fullwidth')) echo 'sidebar' ?> default">
	<div class="tolarcek-breadcrumb">
		<div class="browsing"><?php if(is_tag()){esc_attr_e('Browsing Tag','tolarcek');}else{esc_attr_e('Browsing Category','tolarcek');} ?></div>
		<?php echo tolarcek_breadcrumb(); ?>
	</div>
	<div class="main clearfix">
		<div class="pad"></div>			
		<div class="content blog">
			
			<?php if (have_posts()) : ?>
				<?php 
				add_filter( 'shortcode_atts_gallery', 'tolarcek_gallery_C' );
				function tolarcek_gallery_c( $out )
				{
					remove_filter( current_filter(), __FUNCTION__ );
					$out['size'] = 'tolarcek-news';
					return $out;
				}			
				?>
				<?php while (have_posts()) : the_post(); ?>
					<?php if(is_sticky(get_the_id())) { 
					?>
						<div class="tolarcek_sticky">
					<?php } ?>
					<?php $postmeta = get_post_custom(get_the_id()); 
					?>
					<?php if ( has_post_format( 'gallery' , get_the_id())) { ?>	
						<div class="slider-category tolarcek-type-gallery">
							<div class="blogpostcategory">
								<?php get_template_part('includes/loops/loop-top-blog','category'); ?>				
								<?php get_template_part('includes/post-formats/format-gallery','category'); ?>
								<?php get_template_part('includes/loops/loop-meta-blog','category'); ?>						
								<?php get_template_part('includes/loops/loop-blog','category'); ?>	
							</div>
						</div>				
					<?php } 
					if ( has_post_format( 'video' , get_the_id())) { ?>
						<div class="slider-category tolarcek-video">		
							<div class="blogpostcategory">
								<?php get_template_part('includes/loops/loop-top-blog','category'); ?>			
								<?php
								if(!empty($postmeta["_format_video_embed"][0])) {
									echo wp_oembed_get(esc_url($postmeta["_format_video_embed"][0]));
								} ?>
								<?php get_template_part('includes/loops/loop-meta-blog','category'); ?>				
								<?php get_template_part('includes/loops/loop-blog','category'); ?>	
							</div>	
						</div>
					<?php } 
					
					if ( has_post_format( 'link' , get_the_id())) {
						get_template_part('includes/post-formats/format-link','category');
					} 	
					
					if ( has_post_format( 'quote' , get_the_id())) {?>
						<div class="quote-category">
							<?php get_template_part('includes/post-formats/format-quote','category'); ?>	
						</div>	
					<?php } ?>
					
					<?php if ( has_post_format( 'audio' , get_the_id())) {?>
						<div class="blogpostcategory tolarcek-audio">
							<?php get_template_part('includes/loops/loop-top-blog','category'); ?>	
							<div class="audioPlayerWrap">
								<div class="audioPlayer">
									<?php 
									if(isset($postmeta["_format_audio_embed"][0]))
										echo wp_oembed_get(esc_url($postmeta["_format_audio_embed"][0])) ?>
								</div>
							</div>
							<?php get_template_part('includes/loops/loop-meta-blog','category'); ?>			
							<?php get_template_part('includes/loops/loop-blog','category'); ?>		
						</div>	
					<?php } ?>					
					
					
					<?php if ( !get_post_format() ) {?>
						<div class="blogpostcategory">
							<?php get_template_part('includes/loops/loop-top-blog','category'); ?>				
							<?php if(tolarcek_getImage(get_the_id(), 'tolarcek-postBlock') != '') { ?>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
								<div class="blogimage">	
									<?php if(!empty($postmeta["tolarcek_sigle_option_recipe"][0]) && !empty($postmeta["tolarcek_sigle_option_recipe_hover"][0])){ ?>
										<div class="tolarcek-hover-image-recipe"><?php echo tolarcek_recipe_hover(); ?></div>
									<?php } ?>
									<?php echo tolarcek_getImage(get_the_id(), 'tolarcek-postBlock'); ?>
								</div></a>
							<?php } ?>
							<?php get_template_part('includes/loops/loop-meta-blog','category'); ?>				
							<?php get_template_part('includes/loops/loop-blog','category'); ?>								
						</div>
					
					<?php } ?>	
					
					<?php if(is_sticky()) { ?>
						</div>
					<?php } ?>
					
				<?php endwhile; ?>
					
				<?php
					get_template_part('includes/wp-pagenavi','navigation');
					if(function_exists('tolarcek_wp_pagenavi')) { tolarcek_wp_pagenavi(); }
				?>
						
			<?php else : ?>
				<div class="postcontent error-404">
					<?php $tolarcek_data = get_option(OPTIONS); ?>
					<h1><?php tolarcek_security($tolarcek_data['errorpagetitle']) ?></h1>
					<div class="posttext">
						<?php tolarcek_security($tolarcek_data['errorpage']) ?>
					</div>
				</div>			
			<?php endif; ?>
				
		</div>
		<!-- sidebar -->
		<?php if(!tolarcek_globals('use_fullwidth')) { ?>
			<?php if(is_active_sidebar( 'tolarcek_sidebar' )) { ?>
				<div class="sidebar">	
					<?php dynamic_sidebar( 'tolarcek_sidebar' ); ?>
				</div>
			<?php } ?>
		<?php } ?>
	</div>	
</div>											
