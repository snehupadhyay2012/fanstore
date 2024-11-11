<footer class="fs_footer">
    <div class="fs_footer_logo_container">
        <?php
            if ( get_field('show_logo', 'option') && get_field('kdk_logo', 'option') ):
                ?>
                <a href="<?php echo esc_url(home_url('/')) ?>" class="fs-custom-logo-link">
                    <img src="<?php echo esc_url( get_field('kdk_logo', 'option') ); ?>" alt="KDK Logo" class="custom-logo">
                </a>
                <?php
            else : 
                ?>
                <a href="<?php echo esc_url(home_url('/')) ?>" class="fs-custom-logo-name"><?= get_bloginfo('name'); ?></a>
                <?php
            endif
        ?>
    </div>
    <div class="footer_block_mid"></div>
    <div class="footer_nav_links">
        <?php wp_nav_menu(array('theme_location' => 'primary-menu')); ?>
    </div>
    <p>&copy; <?php echo date('Y'); ?> Panasonic Marketing Theme. All Rights Reserved.</p>
    <?php wp_footer(); ?>
</footer>
</div> <!-- Wrapper End-->
</body>
</html>