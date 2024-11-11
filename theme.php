<?php

// Theme Setup: Menus, Support for PDF Upload, Custom Post Type Registration
function theme_setup() {
    // Register Navigation Menus
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'pnm'),
    ));
    
    // Enable PDF Uploads
    add_filter('upload_mimes', function($mime_types) {
        $mime_types['pdf'] = 'application/pdf';
        return $mime_types;
    });
    
    // Register Custom Post Type for Products
    $labels = array(
        'name'               => __('Products', 'pnm'),
        'singular_name'      => __('Product', 'pnm'),
        'add_new'            => __('Add New Product', 'pnm'),
        'add_new_item'       => __('Add New Product', 'pnm'),
        'edit_item'          => __('Edit Product', 'pnm'),
        'new_item'           => __('New Product', 'pnm'),
        'view_item'          => __('View Product', 'pnm'),
        'search_items'       => __('Search Products', 'pnm'),
        'not_found'          => __('No Products found', 'pnm'),
        'not_found_in_trash' => __('No Products found in Trash', 'pnm'),
        'all_items'          => __('All Products', 'pnm'),
        'menu_name'          => __('Products', 'pnm'),
        'name_admin_bar'     => __('Product', 'pnm'),
    );
    $args = array(
        'label'               => __('Products', 'pnm'),
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'supports'            => array('title', 'thumbnail'),
        'show_in_rest'        => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-products',
    );
    register_post_type('products', $args);
}
add_action('after_setup_theme', 'theme_setup');

// Enqueue Stylesheet
function pnm_enqueue_theme_scripts() {
    wp_enqueue_style('pnm-theme-style', get_stylesheet_uri());
    wp_enqueue_script('jquery-2-2-4', get_stylesheet_directory_uri() . '/assets/js/jquery-2.2.4.min.js', [], null, false);
    wp_enqueue_script('pnm-theme-js', get_stylesheet_directory_uri() . '/assets/js/pnm_theme.js', [], null, false);
}
add_action('wp_enqueue_scripts', 'pnm_enqueue_theme_scripts');

function enqueue_scripts_header_function($sections) {
    if (in_array('flexslider', $sections)) {
        wp_enqueue_style('flexslider-style', get_stylesheet_directory_uri() . '/assets/css/flexslider.css', array(), '1.0', 'all');
        wp_enqueue_script('flexslider', get_stylesheet_directory_uri() . '/assets/js/jquery.flexslider-min.js', ['jquery'], null, true);
    }

    if (in_array('highchart', $sections)) {
        wp_enqueue_script('highcharts', get_stylesheet_directory_uri() . '/assets/js/highchart/highcharts.js', [], null, true);
        wp_enqueue_script('highcharts-exporting', get_stylesheet_directory_uri() . '/assets/js/highchart/exporting.js', ['highcharts'], null, true);
        wp_enqueue_script('highcharts-export-data', get_stylesheet_directory_uri() . '/assets/js/highchart/export-data.js', ['highcharts'], null, true);
    }

    if (in_array('spec_pdf_template', $sections)) {
        wp_enqueue_style('spec-pdf-style', get_stylesheet_directory_uri() . '/assets/css/spec_pdf_template.css', array(), '1.0', 'all');
    }
}
add_action('enqueue_scripts_header', 'enqueue_scripts_header_function');

// ACF Options Page for Theme Settings
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

// Generate PDF for Product Specification on Request
add_action('template_redirect', function() {
    if (isset($_GET['generate_spec_pdf'], $_GET['post_id']) && $post = get_post(intval($_GET['post_id']))) {
        include get_theme_file_path('/parts/spec-pdf-template.php');
        exit;
    }
});
