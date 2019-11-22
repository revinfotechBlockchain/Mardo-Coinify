<?php
/**
 * Initialize the tolarcek Meta Boxes. 
 */
add_action( 'admin_init', 'tolarcek_meta_boxes' );

/**
 * Meta Boxes tolarcek code.
 *
 * You can find all the available option types in tolarcek-theme-options.php.
 *
 * @return    void
 * @since     2.0
 */
function tolarcek_meta_boxes() {
  
  /**
   * Create a tolarcek meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  $recipe = $recipe_hover = $crypto_options_bottom_bar_post_page = array();
  if(class_exists('WPRM_Recipe_Manager')){
	$recipe =       array(
        'label'       => esc_html__( 'Set the post as recipe post.', 'tolarcek' ),
        'id'          => 'tolarcek_sigle_option_recipe',
        'type'        => 'on-off',
        'desc'        => esc_html__('If set to ON this post will have different text for continue reading, comments', 'tolarcek'),
        'std'         => ''
      );
	 $recipe_hover = array(
        'label'       => esc_html__( 'Show recipe on image hover(default category layout only).', 'tolarcek' ),
        'id'          => 'tolarcek_sigle_option_recipe_hover',
        'type'        => 'on-off',
        'desc'        => esc_html__('If set to ON recipe will show on mouse hover over the image on category view.', 'tolarcek'),
        'std'         => '',
        'condition'   => 'tolarcek_sigle_option_recipe:is(1)',
        'operator'    => 'and',			
      );
  }
  if(CRYPTO){	
    $crypto_options_bottom_bar_post_page =       array(
        'id'          => 'show_crypto_slider_bottom_bar_post_page',
        'label'       => 'Show Crypto slider in bottom bar for this page only.',
        'desc'        => 'Set this to on if you wish to display crypto slider inside bottom bar (this is fixed position).',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'crypto',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      );	 
  }
  $tolarcek_meta_box_post = array(
    'id'          => 'tolarcek_meta_box',
    'title'       => esc_html__( 'Tolarcek Options', 'tolarcek' ),
    'desc'        => '',
    'pages'       => array( 'post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'Tolarcek post options', 'tolarcek' ),
        'id'          => 'tolarcek_post_options',
        'type'        => 'tab'
      ),
	  $crypto_options_bottom_bar_post_page,
      $recipe ,
	  $recipe_hover,
      array(
        'label'       => esc_html__( 'Set the fullwidth layout for this post.', 'tolarcek' ),
        'id'          => 'tolarcek_sigle_option_fullwidth',
        'type'        => 'on-off',
        'desc'        => esc_html__('If set to ON this post will have the fullwidth layout.','tolarcek'),
        'std'         => ''
      ),
      array(
        'label'       => esc_html__( 'Use different sidebar for the single post?', 'tolarcek' ),
        'id'          => 'tolarcek_sigle_option_sidebar',
        'type'        => 'on-off',
        'desc'        => esc_html__('If set to ON this post will use different sidebar ("Sidebar for single blog posts").','tolarcek'),
        'std'         => '',
        'condition'   => 'tolarcek_sigle_option_fullwidth:is()',
        'operator'    => 'and',				
		),
      array(
        'label'       => esc_html__( 'Use Revolution slider instead of thr featured image?', 'tolarcek' ),
        'id'          => 'tolarcek_sigle_option_revslider',
        'type'        => 'on-off',
        'desc'        => esc_html__('If set to ON this post will use Revolution Slider instead of the feautured image.','tolarcek'),
        'std'         => '',	
      ),
      array(
        'label'       => esc_html__( 'Use Revolution slider instead of featured image?', 'tolarcek' ),
        'id'          => 'tolarcek_sigle_option_revslider_alias',
        'type'        => 'revslider_select',
        'desc'        => esc_html__('If set to ON this you will use Revolution Slider instead of the feautured image.','tolarcek'),
        'std'         => '',	
        'condition'   => 'tolarcek_sigle_option_revslider:is(1)',
        'operator'    => 'and',				
      ),	  
    )
  );
  
  $tolarcek_meta_box_page = array(
    'id'          => 'tolarcek_meta_box',
    'title'       => esc_html__( 'Tolarcek Options', 'tolarcek' ),
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => esc_html__( 'Tolarcek page options', 'tolarcek' ),
        'id'          => 'tolarcek_pafe_options',
        'type'        => 'tab'
      ),
	  $crypto_options_bottom_bar_post_page,
      array(
        'label'       => esc_html__( 'Use Revolution slider instead of featured image?', 'tolarcek' ),
        'id'          => 'tolarcek_sigle_option_revslider',
        'type'        => 'on-off',
        'desc'        => esc_html__('If set to ON this page will use Revolution Slider instead of feautured image.','tolarcek'),
        'std'         => '',	
      ),
      array(
        'label'       => esc_html__( 'Use Revolution slider instead of featured image?', 'tolarcek' ),
        'id'          => 'tolarcek_sigle_option_revslider_alias',
        'type'        => 'revslider_select',
        'desc'        => esc_html__('If set to ON this pyou will use Revolution Slider instead of feautured image.','tolarcek'),
        'std'         => '',	
        'condition'   => 'tolarcek_sigle_option_revslider:is(1)',
        'operator'    => 'and',				
      ),	  
    )
  );  
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  if ( function_exists( 'ot_register_meta_box' ) ){
    ot_register_meta_box( $tolarcek_meta_box_post );
	ot_register_meta_box( $tolarcek_meta_box_page );
	}

}