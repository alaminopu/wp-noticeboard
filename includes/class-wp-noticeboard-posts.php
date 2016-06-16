<?php

/**
 * Register all post for the plugin
 *
 * @link       http://alaminopu.me
 * @since      1.0.0
 *
 * @package    Wp_Noticeboard
 * @subpackage Wp_Noticeboard/includes
 */

/**
 * Register all post for the plugin
 *
 * @package    Wp_Noticeboard
 * @subpackage Wp_Noticeboard/includes
 * @author     Md. Al-Amin <alamin.opu10@gmail.com>
 */
class Wp_Noticeboard_Posts {

	/**
	 * Define the core funtionality of POST related stuff
	 * of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct(){

	}

	/**
	 * Register custom post type
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function wp_noticeboard_post_type() {

		$labels = array(
			'name'                  => _x( 'Noticeboard', 'Noticeboard', TEXTDOMAIN ),
			'singular_name'         => _x( 'Notice', 'Notice', TEXTDOMAIN ),
			'menu_name'             => __( 'Noticeboard', TEXTDOMAIN ),
			'name_admin_bar'        => __( 'Noticeboard', TEXTDOMAIN ),
			'archives'              => __( 'Notice Archives', TEXTDOMAIN ),
			'parent_item_colon'     => __( 'Parent Notice:', TEXTDOMAIN ),
			'all_items'             => __( 'All Notices', TEXTDOMAIN ),
			'add_new_item'          => __( 'Add New Notice', TEXTDOMAIN ),
			'add_new'               => __( 'Add New', TEXTDOMAIN ),
			'new_item'              => __( 'New Notice', TEXTDOMAIN ),
			'edit_item'             => __( 'Edit Notice', TEXTDOMAIN ),
			'update_item'           => __( 'Update Notice', TEXTDOMAIN ),
			'view_item'             => __( 'View Notice', TEXTDOMAIN ),
			'search_items'          => __( 'Search Notice', TEXTDOMAIN ),
			'not_found'             => __( 'Not found', TEXTDOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', TEXTDOMAIN ),
			'featured_image'        => __( 'Featured Image', TEXTDOMAIN ),
			'set_featured_image'    => __( 'Set featured image', TEXTDOMAIN ),
			'remove_featured_image' => __( 'Remove featured image', TEXTDOMAIN ),
			'use_featured_image'    => __( 'Use as featured image', TEXTDOMAIN ),
			'insert_into_item'      => __( 'Insert into Notice', TEXTDOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this Notice', TEXTDOMAIN ),
			'items_list'            => __( 'Notice list', TEXTDOMAIN ),
			'items_list_navigation' => __( 'Notice list navigation', TEXTDOMAIN ),
			'filter_items_list'     => __( 'Filter Notice list', TEXTDOMAIN ),
		);
		$rewrite = array(
			'slug'                  => 'wp-noticeboard',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);

		$args = array(
			'label'                 => __( 'Noticeboard', TEXTDOMAIN ),
			'description'           => __( 'Create admin notice', TEXTDOMAIN ),
			'labels'                => $labels,
			'supports'              => array( ),
			'taxonomies'            => array( 'category'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite' 				=> $rewrite,
			'capability_type'       => 'post',
		);
		register_post_type( 'wp_noticeboard', $args );

	}

	/**
	 * Adding custom post type to taxonomy
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function wp_noticeboard_add_custom_types_to_tax( $query ) {
		if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
			
			$post_types =  array( 'post', 'wp_noticeboard');

			$query->set( 'post_type', $post_types );
			return $query;
		}
	}

	/**
	 * Display shortcode content
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function wp_noticeboard_shortcode( $atts ) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'number' => '5',
				'category' => '',
			),
			$atts,
			'wp-noticeboard'
		);

		// query 
		$return_string = '<ul class="wp-noticeboard-posts">';
		query_posts(
			array(
				'orderby' => 'date', 
				'order' => 'DESC' ,
				'post_type'=> 'wp_noticeboard',
				'category_name' => $atts['category'],
				'showposts' => $atts['number'])
		);

		if (have_posts()) :
			while (have_posts()) : the_post();
				$return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a>'. '<span class="date">'. get_the_date() .'</span></li>';
			endwhile;
		endif;
		$return_string .= '</ul>';

		wp_reset_query();
		return $return_string;

	}


	/**
	 * Register shortcode
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function wp_noticeboard_register_shortcode(){
		add_shortcode( 'wp-noticeboard', array(&$this , 'wp_noticeboard_shortcode'));
	}
	


}