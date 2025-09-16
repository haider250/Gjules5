<?php
/**
 * Online Toolbox Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OnlineToolbox
 */

if ( ! function_exists( 'onlinetoolbox_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function onlinetoolbox_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary', 'onlinetoolbox' ),
        ) );
    }
endif;
add_action( 'after_setup_theme', 'onlinetoolbox_setup' );

/**
 * Register Custom Post Type for Tools.
 */
function onlinetoolbox_register_tool_cpt() {

    $labels = array(
        'name'                  => _x( 'Tools', 'Post Type General Name', 'onlinetoolbox' ),
        'singular_name'         => _x( 'Tool', 'Post Type Singular Name', 'onlinetoolbox' ),
        'menu_name'             => __( 'Tools', 'onlinetoolbox' ),
        'name_admin_bar'        => __( 'Tool', 'onlinetoolbox' ),
        'archives'              => __( 'Tool Archives', 'onlinetoolbox' ),
        'attributes'            => __( 'Tool Attributes', 'onlinetoolbox' ),
        'parent_item_colon'     => __( 'Parent Tool:', 'onlinetoolbox' ),
        'all_items'             => __( 'All Tools', 'onlinetoolbox' ),
        'add_new_item'          => __( 'Add New Tool', 'onlinetoolbox' ),
        'add_new'               => __( 'Add New', 'onlinetoolbox' ),
        'new_item'              => __( 'New Tool', 'onlinetoolbox' ),
        'edit_item'             => __( 'Edit Tool', 'onlinetoolbox' ),
        'update_item'           => __( 'Update Tool', 'onlinetoolbox' ),
        'view_item'             => __( 'View Tool', 'onlinetoolbox' ),
        'view_items'            => __( 'View Tools', 'onlinetoolbox' ),
        'search_items'          => __( 'Search Tool', 'onlinetoolbox' ),
        'not_found'             => __( 'Not found', 'onlinetoolbox' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'onlinetoolbox' ),
        'featured_image'        => __( 'Featured Image', 'onlinetoolbox' ),
        'set_featured_image'    => __( 'Set featured image', 'onlinetoolbox' ),
        'remove_featured_image' => __( 'Remove featured image', 'onlinetoolbox' ),
        'use_featured_image'    => __( 'Use as featured image', 'onlinetoolbox' ),
        'insert_into_item'      => __( 'Insert into tool', 'onlinetoolbox' ),
        'uploaded_to_this_item' => __( 'Uploaded to this tool', 'onlinetoolbox' ),
        'items_list'            => __( 'Tools list', 'onlinetoolbox' ),
        'items_list_navigation' => __( 'Tools list navigation', 'onlinetoolbox' ),
        'filter_items_list'     => __( 'Filter tools list', 'onlinetoolbox' ),
    );
    $args = array(
        'label'                 => __( 'Tool', 'onlinetoolbox' ),
        'description'           => __( 'A post type for online tools.', 'onlinetoolbox' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-tools',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable for Gutenberg editor
    );
    register_post_type( 'tools', $args );

}
add_action( 'init', 'onlinetoolbox_register_tool_cpt', 0 );

/**
 * Register custom taxonomy for Tool Categories.
 */
function onlinetoolbox_register_tool_taxonomy() {
    $labels = array(
        'name'              => _x( 'Tool Categories', 'taxonomy general name', 'onlinetoolbox' ),
        'singular_name'     => _x( 'Tool Category', 'taxonomy singular name', 'onlinetoolbox' ),
        'search_items'      => __( 'Search Tool Categories', 'onlinetoolbox' ),
        'all_items'         => __( 'All Tool Categories', 'onlinetoolbox' ),
        'parent_item'       => __( 'Parent Tool Category', 'onlinetoolbox' ),
        'parent_item_colon' => __( 'Parent Tool Category:', 'onlinetoolbox' ),
        'edit_item'         => __( 'Edit Tool Category', 'onlinetoolbox' ),
        'update_item'       => __( 'Update Tool Category', 'onlinetoolbox' ),
        'add_new_item'      => __( 'Add New Tool Category', 'onlinetoolbox' ),
        'new_item_name'     => __( 'New Tool Category Name', 'onlinetoolbox' ),
        'menu_name'         => __( 'Tool Category', 'onlinetoolbox' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'tool-category' ),
        'show_in_rest'      => true, // Enable for Gutenberg editor
    );

    register_taxonomy( 'tool_category', array( 'tools' ), $args );
}
add_action( 'init', 'onlinetoolbox_register_tool_taxonomy', 0 );
