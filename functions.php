<?php


add_action('after_setup_theme', function () {

});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('garchive-font-primary', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,600', array(), null);
    wp_enqueue_style('garchive-font-secondary', 'https://fonts.googleapis.com/css?family=Bitter:400,700', array(), null);

    wp_enqueue_script('garchive-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), null);
    wp_enqueue_style('garchive-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), null);
    wp_enqueue_style('garchive-bootstrap-4-style', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css', array(), null);
    wp_enqueue_script('garchive-bootstrap-4-script', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js', array(), null);
    wp_enqueue_script('garchive-masonry', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js', array(), null);

    wp_enqueue_style('garchive-style', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'));
    wp_enqueue_script('garchive-main', get_template_directory_uri() . '/scripts/main.js', array(), 4);
    wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js?render=6LffjYIUAAAAAFVO0IpvQWLIUgOpEudcXg8IZrgf', array(), null);

    if (is_page_template('template-submit-content.php')) {
        wp_enqueue_script('tinymce', 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js', array(), null);
    }
});

add_filter('show_admin_bar', '__return_false');

add_filter('excerpt_length', function () {
    return 40;
});

add_filter('excerpt_more', function () {
    return '&hellip;';
});

add_action('admin_init', function () {
    if (current_user_can('subscriber') && is_admin()) {
        wp_redirect(home_url());
        exit;
    }
});

add_action('template_redirect', function () {

    if (!is_user_logged_in()) {
        if (is_page_template('template-submit-content.php')) {
            wp_redirect(esc_url(home_url('/register')), 302);
        }
    }
});


add_action('init', function () {
    register_nav_menu('header-menu', __('Header Menu'));
});

// Register Custom Post Type

add_action('init', function () {
    $labels = array(
        'name' => _x('Content Submissions', 'Post Type General Name', 'garchive'),
        'singular_name' => _x('Content Submission', 'Post Type Singular Name', 'garchive'),
        'menu_name' => __('Submissions', 'garchive'),
        'name_admin_bar' => __('Content Submission', 'garchive'),
        'archives' => __('Item Archives', 'garchive'),
        'attributes' => __('Item Attributes', 'garchive'),
        'parent_item_colon' => __('Parent Item:', 'garchive'),
        'all_items' => __('All Items', 'garchive'),
        'add_new_item' => __('Add New Item', 'garchive'),
        'add_new' => __('Add New', 'garchive'),
        'new_item' => __('New Item', 'garchive'),
        'edit_item' => __('Edit Item', 'garchive'),
        'update_item' => __('Update Item', 'garchive'),
        'view_item' => __('View Item', 'garchive'),
        'view_items' => __('View Items', 'garchive'),
        'search_items' => __('Search Item', 'garchive'),
        'not_found' => __('Not found', 'garchive'),
        'not_found_in_trash' => __('Not found in Trash', 'garchive'),
        'featured_image' => __('Featured Image', 'garchive'),
        'set_featured_image' => __('Set featured image', 'garchive'),
        'remove_featured_image' => __('Remove featured image', 'garchive'),
        'use_featured_image' => __('Use as featured image', 'garchive'),
        'insert_into_item' => __('Insert into item', 'garchive'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'garchive'),
        'items_list' => __('Items list', 'garchive'),
        'items_list_navigation' => __('Items list navigation', 'garchive'),
        'filter_items_list' => __('Filter items list', 'garchive'),
    );

    $args = array(
        'label' => __('Content Submission', 'garchive'),
        'description' => __('A content submission.', 'garchive'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'author', 'custom-fields'),
        'taxonomies' => array('category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );

    register_post_type('content_submission', $args);
}, 0);

require_once 'helpers.php';
include 'metabox.php';