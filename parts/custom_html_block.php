<?php 
    $theme = get_field('theme_color');
?>
<section class="custom_html_block <?= ($theme == 'dark') ? 'theme_dark':''; ?>" data-theme="<?= ($theme == 'dark') ? 'dark' : 'light'; ?>">
    <div class="content"><?php the_sub_field('html'); ?></div>
</section>