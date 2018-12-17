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
    wp_enqueue_script('garchive-main', get_template_directory_uri() . '/scripts/main.js', array(), 3);
});

add_filter('show_admin_bar', '__return_false');

add_filter('excerpt_length', function() {
    return 40;
});

add_filter('excerpt_more', function() {
    return '&hellip;';
});

require_once 'helpers.php';
include 'metabox.php';