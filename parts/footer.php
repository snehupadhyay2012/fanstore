<footer class="fs_footer">
    <div class="fs_footer_logo_container">
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
    <div class="footer_block_mid"></div>
    <div class="footer_nav_links">
        <?php wp_nav_menu(array('theme_location' => 'primary-menu')); ?>
    </div>
    <p>&copy; <?php echo date('Y'); ?> Fan Store Theme. All Rights Reserved.</p>
    <?php wp_footer(); ?>
</footer>
</div> <!-- Wrapper End-->
</body>
</html>