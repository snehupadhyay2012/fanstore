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
    <script>
        jQuery('.updateSpecifications').on('click',function(){
            $(this).siblings('.updateSpecifications').removeClass('btn-outline-success active');
            $(this).addClass('btn-outline-success active');

            let data = JSON.parse($('.vol_freq_data_array').html());
            let activeVoltage = $('.voltageBtn.active').data('value');
            let activeFreq = $('.frequencyBtn.active').data('value');
            
            if((data[activeVoltage][activeFreq] != undefined) && (data[activeVoltage][activeFreq]['short_specification'] != false)){
                let html = '';
                let specification = data[activeVoltage][activeFreq]['short_specification'];
                
                specification.forEach(function( val ) {
                    html += '<div class="specRow"><h4 class="specLabel">'+ val.label +'</h4>';
                    html += '<p class="specVal">'+ val.value +'</p></div>';              
                });
                $('.shortSpecificationContainer').html(html);
            }else{
                $('.shortSpecificationContainer').html('');
            }
            
        });
    </script>
</footer>
</div> <!-- Wrapper End-->
</body>
</html>