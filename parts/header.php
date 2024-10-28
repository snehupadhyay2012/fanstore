<!DOCTYPE html>
<?php 
    $theme = get_field('theme_color');
?>
<html <?php language_attributes(); ?> data-theme="<?= ($theme == 'dark') ? 'dark' : 'light'; ?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/flexslider.css" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/jquery-2.2.4.min.js"></script>
    <script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/fs_theme.js"></script>
    <script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/jquery.flexslider-min.js"></script>
</head>
<body <?php body_class(); ?>>
    <div class="fs_wrapper"> <!-- Wrapper start-->
        <header class="fs_header">
            <nav class="fs_nav">
                <div class="fs_logo_container">
                    <?php
                        if (function_exists('the_custom_logo') && has_custom_logo()) {
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $logo = wp_get_attachment_image($custom_logo_id, 'full', false, array(
                                'class' => 'custom-logo', // Custom class
                                'alt'   => get_bloginfo('name') // Alt text
                            ));
                            echo '<a href="' . esc_url(home_url('/')) . '" class="fs-custom-logo-link">' . $logo . '</a>';
                        } else {
                            echo '<a href="' . esc_url(home_url('/')) . '" class="fs-custom-logo-name">' . get_bloginfo('name') . '</a>';
                        }
                    ?>
                </div>
                <div class="fs_menu_container">
                    <?php wp_nav_menu(array('theme_location' => 'primary-menu')); ?> <!-- Showing Primary Menu -->
                    <!--div class="color-switcher">
                        <i id="theme-icon" class="fas fa-moon"></i>
                    </div-->
                </div>
            </nav>
        </header>