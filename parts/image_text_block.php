<?php
    $image = get_sub_field('image');
    $text = get_sub_field('html_text');
    $layout = get_sub_field('layout_switcher');
    $theme = get_field('theme_color');
?>

<div class="text-image-block <?php echo esc_attr($layout); ?>  <?= ($theme == 'dark') ? 'theme_dark':''; ?>" data-theme="<?= ($theme == 'dark') ? 'dark' : 'light'; ?>">
    <?php if ($layout === 'image-on-left'): ?>
        <img class="block-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
        <div class="block-text">
            <?php echo $text; ?>
        </div>
    <?php elseif ($layout === 'image-on-right'): ?>
        <div class="block-text">
            <?php echo $text; ?>
        </div>
        <img class="block-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
    <?php endif; ?>
</div>
