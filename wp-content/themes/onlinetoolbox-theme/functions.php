<?php
/**
 * Online Toolbox Theme functions and definitions
 *
 * @package OnlineToolbox
 */

if ( ! function_exists( 'onlinetoolbox_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function onlinetoolbox_setup() {
        add_theme_support( 'title-tag' );
    }
endif;
add_action( 'after_setup_theme', 'onlinetoolbox_setup' );

/**
 * Enqueue scripts and styles.
 */
function onlinetoolbox_enqueue_scripts() {
    // Enqueue workflow builder scripts only on the specific page template
    if ( is_page_template('template-workflow-builder.php') ) {
        // Enqueue tool modules
        wp_enqueue_script( 'onlinetoolbox-tool-case-converter', get_template_directory_uri() . '/js/tools/case-converter.js', array(), '1.0', true );

        // Enqueue the main builder script
        wp_enqueue_script( 'onlinetoolbox-workflow-builder', get_template_directory_uri() . '/js/workflow-builder.js', array('jquery', 'onlinetoolbox-tool-case-converter'), '1.0', true );

        // Pass data to the workflow script
        wp_localize_script( 'onlinetoolbox-workflow-builder', 'workflow_ajax_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'workflow_nonce' ),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'onlinetoolbox_enqueue_scripts' );

/**
 * Register Custom Post Type for Workflows.
 */
function onlinetoolbox_register_workflow_cpt() {
    $labels = array(
        'name'               => _x( 'Workflows', 'Post Type General Name', 'onlinetoolbox' ),
        'singular_name'      => _x( 'Workflow', 'Post Type Singular Name', 'onlinetoolbox' ),
        'menu_name'          => __( 'Workflows', 'onlinetoolbox' ),
        'name_admin_bar'     => __( 'Workflow', 'onlinetoolbox' ),
        'all_items'          => __( 'All Workflows', 'onlinetoolbox' ),
        'add_new_item'       => __( 'Add New Workflow', 'onlinetoolbox' ),
        'add_new'            => __( 'Add New', 'onlinetoolbox' ),
        'new_item'           => __( 'New Workflow', 'onlinetoolbox' ),
        'edit_item'          => __( 'Edit Workflow', 'onlinetoolbox' ),
        'update_item'        => __( 'Update Workflow', 'onlinetoolbox' ),
        'view_item'          => __( 'View Workflow', 'onlinetoolbox' ),
        'search_items'       => __( 'Search Workflow', 'onlinetoolbox' ),
    );
    $args = array(
        'label'              => __( 'Workflow', 'onlinetoolbox' ),
        'description'        => __( 'Stores user-created tool workflows.', 'onlinetoolbox' ),
        'labels'             => $labels,
        'supports'           => array( 'title', 'author', 'custom-fields' ),
        'hierarchical'       => false,
        'public'             => false, // Not publicly queryable
        'show_ui'            => true,  // Show in admin UI
        'show_in_menu'       => true,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-controls-repeat',
        'show_in_admin_bar'  => false,
        'show_in_nav_menus'  => false,
        'can_export'         => true,
        'has_archive'        => false,
        'exclude_from_search'=> true,
        'publicly_queryable' => false,
        'capability_type'    => 'post',
        'show_in_rest'       => true,
    );
    register_post_type( 'workflow', $args );
}
add_action( 'init', 'onlinetoolbox_register_workflow_cpt', 0 );

/**
 * AJAX handler for saving a workflow.
 */
function onlinetoolbox_save_workflow() {
    // Security checks
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'workflow_nonce' ) ) {
        wp_send_json_error( 'Nonce verification failed.' );
    }
    if ( ! is_user_logged_in() ) {
        wp_send_json_error( 'You must be logged in to save workflows.' );
    }

    $title = sanitize_text_field( $_POST['title'] );
    $steps = json_decode( stripslashes( $_POST['steps'] ), true );

    if ( empty( $title ) ) {
        wp_send_json_error( 'Please provide a name for your workflow.' );
    }
    if ( empty( $steps ) || ! is_array( $steps ) ) {
        wp_send_json_error( 'Workflow has no steps.' );
    }

    // Create new workflow post
    $post_id = wp_insert_post( array(
        'post_title'  => $title,
        'post_status' => 'publish',
        'post_type'   => 'workflow',
        'post_author' => get_current_user_id(),
    ) );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( 'Failed to save workflow.' );
    }

    // Save steps as post meta
    update_post_meta( $post_id, '_workflow_steps', $steps );

    wp_send_json_success( array( 'post_id' => $post_id, 'title' => $title ) );
}
add_action( 'wp_ajax_save_workflow', 'onlinetoolbox_save_workflow' );

/**
 * AJAX handler for loading a workflow.
 */
function onlinetoolbox_load_workflow() {
    // Security checks
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'workflow_nonce' ) ) {
        wp_send_json_error( 'Nonce verification failed.' );
    }
    if ( ! is_user_logged_in() ) {
        wp_send_json_error( 'You must be logged in to load workflows.' );
    }

    $post_id = intval( $_POST['post_id'] );
    $workflow_post = get_post( $post_id );

    // Check if post exists and user is the author
    if ( ! $workflow_post || $workflow_post->post_author != get_current_user_id() ) {
        wp_send_json_error( 'Workflow not found or you do not have permission to load it.' );
    }

    $steps = get_post_meta( $post_id, '_workflow_steps', true );

    wp_send_json_success( array( 'steps' => $steps ) );
}
add_action( 'wp_ajax_load_workflow', 'onlinetoolbox_load_workflow' );
