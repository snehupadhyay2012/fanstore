<?php
//Centralized File for all Theme configurations.
function theme_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    add_theme_support('post-thumbnails', array('fans'));
    
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'fanstore'),
    ));

    $labels = array(
        'name'               => __('Fans', 'fanstore'),
        'singular_name'      => __('Fan', 'fanstore'),
        'add_new'            => __('Add New Fan', 'fanstore'),
        'add_new_item'       => __('Add New Fan', 'fanstore'),
        'edit_item'          => __('Edit Fan', 'fanstore'),
        'new_item'           => __('New Fan', 'fanstore'),
        'view_item'          => __('View Fan', 'fanstore'),
        'search_items'       => __('Search Fans', 'fanstore'),
        'not_found'          => __('No Fans found', 'fanstore'),
        'not_found_in_trash' => __('No Fans found in Trash', 'fanstore'),
        'all_items'          => __('All Fans', 'fanstore'),
        'menu_name'          => __('Fans', 'fanstore'),
        'name_admin_bar'     => __('Fan', 'fanstore'), // This affects the label in the top admin bar
    );

    $args = array(
        'label'               => __('Fans', 'fanstore'),
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'supports'            => array('title', 'thumbnail'),
        'show_in_rest'        => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-products',
    );
    register_post_type('fans', $args);
}
add_action('after_setup_theme', 'theme_setup');


/**
 * Enqueue Theme Stylesheet
 * @return void
 */
function fs_enqueue_theme_scripts() {
    wp_enqueue_style('fs-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'fs_enqueue_theme_scripts');