<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" >
<!-- start -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="format-detection" content="telephone=no">
	
	<?php wp_head();?>
</head>		
<!-- start body -->
<body <?php body_class(); ?> id="particles-js" >
	<!-- start header -->
			<!-- fixed menu -->		
			<?php 
			?>	
			<?php if(tolarcek_globals('display_scroll')) { ?>
			<div class="pagenav fixedmenu">						
				<div class="holder-fixedmenu">							
					<div class="logo-fixedmenu">								
					<?php if(tolarcek_globals('scroll_logo') && !tolarcek_globals('use_site_title')){ ?>
						<a href='google.com'><img src="<?php echo esc_url(tolarcek_data('scroll_logo')); ?>" data-rjs="3" alt="<?php esc_html(bloginfo('name')); ?> - <?php esc_html(bloginfo('description')) ?>" ></a>
					<?php } else { ?>
						<a class = "blog-name-scroll" href="google.com"><?php bloginfo('name'); ?></a>
					<?php } ?>
					</div>
						<div class="menu-fixedmenu home">
						<?php
						if ( has_nav_menu( 'tolarcek_scrollmenu' ) ) {
						wp_nav_menu( array(
						'container' =>false,
						'container_class' => 'menu-scroll',
						'theme_location' => 'tolarcek_scrollmenu',
						'echo' => true,
						'fallback_cb' => 'tolarcek_fallback_menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'walker' => new tolarcek_Walker_Main_Menu())
						);
						}
						?>	
					</div>
				</div>	
			</div>
			<?php } ?>
				<header>
				<!-- top bar -->
				<?php if(tolarcek_globals('top_bar')) { ?>
					<div class="top-wrapper">
						<?php if(!tolarcek_globals('show_crypto_slider_top_bar')) { ?>
						<div class="top-wrapper-content">
							<div class="top-left">
								<?php if(is_active_sidebar( 'tolarcek_sidebar-top-left' )) { ?>
									<?php dynamic_sidebar( 'tolarcek_sidebar-top-left' ); ?>
								<?php } ?>
							</div>
							<div class="top-right">
								<?php if(is_active_sidebar( 'tolarcek_sidebar-top-right' )) { ?>
									<?php dynamic_sidebar( 'tolarcek_sidebar-top-right' ); ?>
								<?php } ?>
							</div>
						</div>
						<?php } else { ?>
							<?php if(shortcode_exists('currencyprice_pmc')){
								if(tolarcek_data('crypto_options_coins_design') == 1){
									if(tolarcek_globals('show_crypto_daychange')) {$daycahnge = 'yes';} else {$daycahnge = 'no';}
										echo do_shortcode(' [currencyprice_pmc currency1="'.implode( ",", tolarcek_data('select_crypto_coin')).'" currency2="'.implode( ",", tolarcek_data('select_crypto_coin_currency')).'" daychange="'.$daycahnge.'"]');
								}
								if(tolarcek_data('crypto_options_coins_design') == 2){
									echo do_shortcode(' [currency_ticker_2 coins="'. str_replace("*", "",implode( ",", tolarcek_data('select_crypto_coin'))).'" compare="'.tolarcek_data('select_crypto_coin_currency_1').'"]');
								}
							} ?>
						<?php } ?>						
					</div>
					<?php } ?>			
					<div id="headerwrap">		

						<!-- logo and main menu -->
						<div id="header">
							<div class="header-image">
							<!-- respoonsive menu main-->
							<!-- respoonsive menu no scrool bar -->
							<?php if ( has_nav_menu( 'tolarcek_respmenu' ) ) { ?>
							<div class="respMenu noscroll">
								<div class="resp_menu_button"><i class="fa fa-list-ul fa-2x"></i></div>
								<?php 
									$menuParameters =  array(
									  'theme_location' => 'tolarcek_respmenu', 
									  'walker'         => new tolarcek_Walker_Responsive_Menu(),
									  'echo'            => false,
									  'container_class' => 'menu-main-menu-container',
									  'items_wrap'     => '<div class="event-type-selector-dropdown">%3$s</div>',
									);
									echo strip_tags(wp_nav_menu( $menuParameters ), '<a>,<br>,<div>,<i>,<strong>' );
								?>	
							<?php } ?>
							</div>
							<!-- logo -->
							<?php if(tolarcek_data('logo_position') == 1 ){ 
								tolarcek_logo();
							} ?>
							</div>
							<!-- main menu -->
							<div class="pagenav <?php if( tolarcek_data('logo_position') == 3  ){ echo 'logo-left-menu'; } ?>"> 	
							<?php if( tolarcek_data('logo_position') == 3  ){ 
									tolarcek_logo();
								} ?>								
								<div class="pmc-main-menu">
								<?php
									if ( has_nav_menu( 'tolarcek_mainmenu' ) ) {	
										wp_nav_menu( array(
										'container' =>false,
										'container_class' => 'menu-header home',
										'menu_id' => 'menu-main-menu-container',
										'theme_location' => 'tolarcek_mainmenu',
										'echo' => true,
										'fallback_cb' => 'tolarcek_fallback_menu',
										'before' => '',
										'after' => '',
										'link_before' => '',
										'link_after' => '',
										'depth' => 0,
										'walker' => new tolarcek_Walker_Main_Menu()));								
									} ?>											
								</div> 	
							</div> 
							<?php if(tolarcek_data('logo_position') == 2){ 
								tolarcek_logo();
							} ?>							
						</div>
					</div> 												
				</header>	
				<?php
				if(function_exists( 'putRevSlider')){						
					if(tolarcek_globals('use_rev_slider_home') && is_front_page() ){ ?>
						<div id="tolarcek-slider-wrapper">
							<div id="tolarcek-slider">
								<?php putRevSlider(tolarcek_data('rev_slider'),"homepage") ?>
							</div>
						</div>
					<?php } ?>
				<?php } ?>		
				<?php 					
				if(is_front_page() && tolarcek_globals('use_categories')){ ?>
						<?php tolarcek_block_one(); ?>
					<?php } ?>	
					<?php if(is_front_page() && tolarcek_globals('use_block2') ){ ?>	
						<?php tolarcek_block_two(); ?>
					<?php } ?>				
				<?php if(is_front_page()){ ?>
				<?php tolarcek_custom_layout(); ?>
				<?php } ?>				
