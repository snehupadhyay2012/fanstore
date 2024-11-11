<?php
// Get the theme color field value
$theme = get_field('theme_color');

// Default sections to load (can be passed dynamically using $args)
$sections = isset($args['sections']) ? $args['sections'] : [];

// Define theme data
$theme_data = ($theme == 'dark') ? 'dark' : 'light';
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="<?php echo esc_attr($theme_data); ?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>

    <!-- Enqueue scripts -->
    <?php do_action('enqueue_scripts_header', $sections); // Enqueue scripts / styles for custom sections ?>
    
    <?php wp_head(); // WordPress hook for plugin/theme integration ?>
    <!-- Temporary Stylesheets This will be removed once html templete given -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body <?php body_class(); ?>>
    <div class="fs_wrapper"> <!-- Wrapper start-->
        <header class="fs_header">
            <nav class="fs_nav">
                <div class="fs_logo_container">
                    <?php
                        if ( get_field('show_logo', 'option') && get_field('kdk_logo', 'option') ):
                            ?>
                            <a href="<?= esc_url(home_url('/')) ?>" class="fs-custom-logo-link">
                                <img src="<?php echo esc_url( get_field('kdk_logo', 'option') ); ?>" alt="KDK Logo" class="custom-logo">
                            </a>
                            <?php
                        else : 
                            ?>
                            <a href="<?= esc_url(home_url('/')) ?>" class="fs-custom-logo-name"><?= get_bloginfo('name'); ?></a>
                            <?php
                        endif
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