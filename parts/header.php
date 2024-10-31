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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/jquery-2.2.4.min.js"></script>
    <script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/fs_theme.js"></script>
    <script src="<?= get_stylesheet_directory_uri(); ?>/assets/js/jquery.flexslider-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php 
        if(is_single()){ // Single Post Page
            ?>
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/modules/data.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://code.highcharts.com/modules/export-data.js"></script>
                <script src="https://code.highcharts.com/modules/accessibility.js"></script>
            <?php
        }
    ?>
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