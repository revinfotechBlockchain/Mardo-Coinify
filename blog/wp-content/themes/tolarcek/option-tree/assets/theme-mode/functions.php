<?php
/**
 * Theme Mode
 */
 add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Child Theme Mode
 */
# add_filter( 'ot_child_theme_mode', '__return_false' );

/**
 * Show Settings Pages
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Show Theme Options UI Builder
 */
 add_filter( 'ot_show_options_ui', '__return_true' );

/**
 * Show Settings Import
 */
 
add_filter( 'ot_show_settings_import', '__return_true' );

/**
 * Show Settings Export
 */
 
add_filter( 'ot_show_settings_export', '__return_true' );

/**
 * Show New Layout
 */

add_filter( 'ot_show_new_layout', '__return_true' );

/**
 * Show Documentation
 */
# add_filter( 'ot_show_docs', '__return_true' );

/**
 * Custom Theme Option page
 */

 add_filter( 'ot_use_theme_options', '__return_true' );

/**
 * Meta Boxes
 */
add_filter( 'ot_meta_boxes', '__return_true' );

/**
 * Allow Unfiltered HTML in textareas options
 */
# add_filter( 'ot_allow_unfiltered_html', '__return_false' );

/**
 * Loads the meta boxes for post formats
 */
add_filter( 'ot_post_formats', '__return_true' );

/**
 * OptionTree in Theme Mode
 */
require( get_template_directory()  . '/option-tree/ot-loader.php' );

/**
 * Theme Options
 */
require( trailingslashit( get_template_directory() ) . 'option-tree/assets/theme-mode/theme-options.php' );

require( trailingslashit( get_template_directory() ) . 'option-tree/assets/theme-mode/meta-boxes.php' );

		
function tolarcek_background_filter( ) {
    // Maybe modify $example in some way.
    return array( 
          'background-color',
          'background-image'
        );
}
add_filter( 'ot_recognized_background_fields', 'tolarcek_background_filter' );

function tolarcek_typography_filter(){

return array( 
          'color',
          'face', 
          'size', 
          'font-weight', 
        );

}
add_filter( 'ot_recognized_typography_fields', 'tolarcek_typography_filter' );


function tolarcek_dimension_filter(){

return array( 
          'width',
          'unit'
        );

}
add_filter( 'ot_recognized_dimension_fields', 'tolarcek_dimension_filter' );


function tolarcek_check_google_font($string){
	if (strpos($string, ':') !== false) {
		$string = explode(':', $string );
		$string = $string[0];

	} 
	
	return preg_replace('/\s+/', '',strtolower($string));

}

function tolarcek_in_multi_array($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && tolarcek_in_multi_array($needle, $item, $strict))) {
            return true;
        }
    }
    return false; 
}

function tolarcek_custom_layout(){
	$tolarcek_data = get_option(OPTIONS);
	if(!empty($tolarcek_data['use_builder'])){
		/*build layout*/
		$layouts = $tolarcek_data['test2'];
		echo '<div class="custom-layout"><div class="custom-layout-inner">';
		foreach($layouts as $layout){
		$title = str_replace(' ', '', esc_attr($layout['title']));
		?>
			<?php if(!empty($layout['use_sidebar'])){ ?>
				<div class="layout-sidebar <?php echo esc_attr($title) ?>">	
					<?php dynamic_sidebar( esc_attr($layout['sidebar_select']) ); ?>
				</div>
			<?php } ?>
			<?php if(!empty($layout['use_category'])){ ?>
				<div class="layout-sidebar <?php echo esc_attr($title) ?>">	
					<?php 
					global $post;
					$args = array( 'category' => $layout['category_select'] );
					$layout_posts = get_posts( $args );
					foreach( $layout_posts as  $key => $post ) : 
						if($key == $layout['category_select_number']) {break;}
						setup_postdata($post); ?>
						<div class="blogpostcategory list">
							<div class="topBlog">	
								<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'tolarcek' ) ) . '</em>'; ?> </div>
								<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title=<?php esc_attr_e('Permanent Link to','tolarcek')?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<?php if(tolarcek_globals('display_post_meta')) { ?>
									<div class = "post-meta">
										<?php 
										$day = get_the_time('d');
										$month= get_the_time('m');
										$year= get_the_time('Y');
										?>
										<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_date() ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php esc_html_e('by ','tolarcek'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>			
									</div>
									<?php } ?> <!-- end of post meta -->
							</div>	
						</div>
					<?php endforeach; 
					wp_reset_postdata(); 
					?>		
				</div>
			<?php } ?>		
			<?php if(!empty($layout['use_post'])){ ?>
				<div class="layout-sidebar <?php echo esc_attr($title) ?>">	
					<?php 
					global $post;
					$args = array( 'include' => $layout['single_post'] );
					$layout_posts = get_posts( $args );
					foreach( $layout_posts as $post ) :
						setup_postdata($post); ?>
						<div class="blogpostcategory">
							<div class="topBlog">	
								<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'tolarcek' ) ) . '</em>'; ?> </div>
								<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title=<?php esc_attr_e('Permanent Link to','tolarcek')?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<?php if(tolarcek_globals('display_post_meta')) { ?>
									<div class = "post-meta">
										<?php 
										$day = get_the_time('d');
										$month= get_the_time('m');
										$year= get_the_time('Y');
										?>
										<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_date() ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php esc_html_e('by ','tolarcek'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>			
									</div>
									<?php } ?> <!-- end of post meta -->
							</div>	
							<div class="post-layout-content"><?php the_content(esc_html__('<div class="pmc-read-more">Continue reading</div>','tolarcek')) ?></div>
						</div>
					<?php endforeach; 
					wp_reset_postdata(); 
					?>				

				</div>
			<?php } ?>
		<?php
		}
		echo '</div></div>'; 
	} else {	
	?>
	
	<div class="sidebars-wrap top">
		<div class="sidebars">
			<div class="sidebar-left-right">
				<div class="left-sidebar">
					<?php dynamic_sidebar( 'tolarcek-sidebar-under-header-left' ); ?>
				</div>
				<div class="right-sidebar">
					<?php dynamic_sidebar( 'tolarcek-sidebar-under-header-right' ); ?>
				</div>
			</div>					
			<div class="sidebar-fullwidth">
				<?php dynamic_sidebar( 'tolarcek-sidebar-under-header-fullwidth' ); ?>
			</div>				
		</div>
	</div>	
	<?php
	}
}

function tolarcek_custom_layout_style(){
	$tolarcek_data = get_option(OPTIONS);
	if(isset($tolarcek_data['test2'])){
		$layout_style = '';
		$layouts = $tolarcek_data['test2'];
		$slider_height = 0;
		if(is_array($layouts)){
		foreach($layouts as $layout){
			$top = $left = $right = $bootom = '';
			if(isset($layout['margin_select']['top'])) $top = esc_attr($layout['margin_select']['top']);
			if(isset($layout['margin_select']['left'])) $left = esc_attr($layout['margin_select']['left']);
			if(isset($layout['margin_select']['bottom'])) $bottom = esc_attr($layout['margin_select']['bottom']);
			if(isset($layout['margin_select']['right'])) $right = esc_attr($layout['margin_select']['right']);
			$title = str_replace(' ', '', esc_attr($layout['title']));
			$layout_style .= '.layout-sidebar.'.$title .'{width:'.esc_attr($layout['dimension_select']['width']).esc_attr($layout['dimension_select']['unit']).';  margin-top:'.$top .esc_attr($layout['dimension_select']['unit']).'; margin-right:'.$right.esc_attr($layout['dimension_select']['unit']).'; margin-bottom:'.$bottom.esc_attr($layout['dimension_select']['unit']).'; margin-left:'.$left.esc_attr($layout['dimension_select']['unit']).'}

		
			';	
			
		}
		$layout_style = $layout_style;
		wp_add_inline_style( 'style', $layout_style );
	}
	}
}

add_action( 'wp_enqueue_scripts', 'tolarcek_custom_layout_style' );

function tolarcek_custom_sidebars(){
	$tolarcek_data = get_option(OPTIONS);
	/*build sidebars*/
	if(isset($tolarcek_data['sidebar_builder'])){
		if(is_array($tolarcek_data['sidebar_builder'])){
			$sidebars = $tolarcek_data['sidebar_builder'];
			$sidebarOut = '';
				foreach($sidebars as $sidebar){
					$id = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $sidebar['title']);
					$id = strtolower(str_replace(' ', '' , $id));
					register_sidebar(array(
						'id' => 'tolarcek-'.$id,
						'name' => esc_attr($sidebar['title']),
						'description' => esc_attr($sidebar['sidebar_description']),
						'before_widget' => '<div class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h3>',
						'after_title' => '</h3>'
					));			
				}
			}
	}
}

add_action( 'widgets_init', 'tolarcek_custom_sidebars' );

function tolarcek_admin(){
	$tolarcek_data = get_option(OPTIONS);
	if(!isset($tolarcek_data['use_css'])){
		echo '<style>#tab_custom_style{display:none}</style>';
	}
}

add_action( 'admin_print_scripts', 'tolarcek_admin' );

if ( ! function_exists( 'tolarcek_decode' ) ) {

	function tolarcek_decode( $value ) {

	  $func = 'base64' . '_decode';
	  return $func( $value );
	  
	}
}

if ( ! function_exists( 'tolarcek_options' ) ) {

	function tolarcek_options($option){
		$add = array('active_layout' => $option  );
		$new = get_option('option_tree_layouts');
		$new_add = array_merge($new , $add);
		update_option('option_tree_layouts', $new_add );
		$new_options =  get_option('option_tree_layouts');
		$new_options = unserialize( tolarcek_decode($new_options[$new_options['active_layout']]));
		update_option('of_options_pmc', $new_options);	
	}
}

add_action( 'admin_init', 'tolarcek_import' );
    
function tolarcek_import(){
	if(isset($_GET["pmc_import"]) && $_GET["pmc_import"] == 'start'){   
		/*import setup*/
		define('ADMIN_PATH', get_stylesheet_directory() . '/option-tree/');
		defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );
		global $wpdb;

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
		

			$class_wp_import = get_template_directory() . '/option-tree/import/plugins/wordpress-importer.php';
			if ( file_exists( $class_wp_import ) ) {
			include $class_wp_import;

			}
		

		
		$class_widget_import = get_template_directory() . '/option-tree/import/plugins/class-widget-data.php';
		if ( file_exists( $class_widget_import ) ) {
			include $class_widget_import;
		}		

		if($_GET['import_content'] == 'all') { 

			/*import xml*/

			$importer = new PMC_import_WP();
			$theme_xml = get_template_directory() . '/option-tree/import/tolarcek.xml';
									
			$importer->fetch_attachments = true;
			ob_start();
			$importer->import($theme_xml);
			ob_end_clean();					


			$locations = get_theme_mod( 'nav_menu_locations' ); 
			$menus = wp_get_nav_menus(); 
			
			if( is_array($menus) ) {

				foreach($menus as $menu) { // assign menus to theme locations
				
					$menu_items = wp_get_nav_menu_object($menu->term_id);		
					
					switch($menu_items->name){
						case 'Main menu':
							$locations['tolarcek_respmenu'] = $menu->term_id;
							$locations['tolarcek_mainmenu'] = $menu->term_id;
							$locations['tolarcek_scrollmenu'] = $menu->term_id;										
							break;																			
					}					
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations );		
			
			update_option( 'posts_per_page', 4 );
			
					
		/*import sliders*/
		if($_GET['import_content'] == ('all' || 'revslider') ) { 
		
			$absolute_path = get_template_directory() . '/option-tree/import/revslider/';
			$path_to_file = explode( 'wp-content', $absolute_path );
			$path_to_wp = $path_to_file[0];
			
			
			require_once( $path_to_wp.'/wp-includes/functions.php');
			require_once( $path_to_wp.'/wp-admin/includes/file.php');
			
			$slider_array = array(
				'Tolarcek-Crypto-Slider.zip',
				'tolarcek-crypto-slider-fullscreen.zip',
				'Tolarcek-posts-grid-slider.zip',		
			
			);
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if(is_plugin_active( 'revslider/revslider.php')){	
			$slider = new RevSlider();
			 
				foreach($slider_array as $filepath) {
					
					$slider->importSliderFromPost(true, true, $absolute_path.$filepath);  
					
				}
			}
		}

			global $wp_rewrite;
			$wp_rewrite->set_permalink_structure('/%postname%/');
			$wp_rewrite->flush_rules();		

			
			/*widgets+options*/
			/* demo 1 */
			if($_GET['import_demo'] == 'default-layout-sidebar') {
				$file_widget = get_template_directory() . '/option-tree/import/widget.json';
				tolarcek_options('default-layout-sidebar');
			/* demo 2 */	
			} else if($_GET['import_demo'] == 'minimal-layout-sidebar')  {
				$file_widget = get_template_directory() . '/option-tree/import/widget.json';
				tolarcek_options('minimal-layout-sidebar');	
			/* demo 3 */	
			} else if($_GET['import_demo'] == 'default-layout-magazine')  {
				$file_widget = get_template_directory() . '/option-tree/import/widget_magazine.json';
				tolarcek_options('default-layout-magazine');		
			/* demo 4 */		
			} else if($_GET['import_demo'] == 'default-layout-sidebar-boxed')  {
				$file_widget = get_template_directory() . '/option-tree/import/widget.json';
				tolarcek_options('default-layout-sidebar-boxed');	
			/* demo 5 */		
			} else if($_GET['import_demo'] == 'grid-layout-sidebar')  {
				$file_widget = get_template_directory() . '/option-tree/import/widget.json';
				tolarcek_options('grid-layout-sidebar');	
			/* demo 6 */		
			} else if($_GET['import_demo'] == 'default-layout-fullwidth')  {
				$file_widget = get_template_directory() . '/option-tree/import/widget.json';
				tolarcek_options('default-layout-fullwidth');
			/* demo 7 */		
			} else if($_GET['import_demo'] == 'default-layout-fullscreen-slider')  {
				$file_widget = get_template_directory() . '/option-tree/import/widget.json';
				tolarcek_options('default-layout-fullscreen-slider');		
			/* demo 8 */		
			} else if($_GET['import_demo'] == 'default-layout-dark-skin')  {
				$file_widget = get_template_directory() . '/option-tree/import/widget.json';
				tolarcek_options('default-layout-dark-skin');					
			/* demo 1 */	
			}else {
				$file_widget = get_template_directory() . '/option-tree/import/widget.json';
				tolarcek_options('default-layout-sidebar');
			}
			$class_widget_import = new Widget_Data_PMC();
			$class_widget_import->ajax_import_widget_data($file_widget);
		
		}
		

		
		wp_redirect( admin_url( 'themes.php?page=ot-theme-options&pmc_import=true#section_import' ) );
	}


}
 

?>