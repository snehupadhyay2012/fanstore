<?php 
    if(have_rows('slider_posts')) :
        $theme = get_field('theme_color');
?>
    <section id="fs_slider" class="fs_slider_container <?= ($theme == 'dark') ? 'theme_dark':''; ?>" data-theme="<?= ($theme == 'dark') ? 'dark' : 'light'; ?>">
        <div class="flexslider">
            <ul class="slides">
            <?php query_posts(array('post_type' => 'fans','orderby' => 'rand')); if(have_posts()) : while(have_posts()) : the_post();?>
                <li class="slide">
                    <p class="fs_slider_title"><?php the_title(); ?></p>
                    <p class="fs_slider_short_desc"><?= get_post_meta(get_the_ID(), 'subtitle', true) ?></p>
                    <div class="fs_post_thumbnail">
                        <a href="<?= the_permalink() ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    </div>
                </li>
            <?php endwhile; endif; wp_reset_query(); ?>
            </ul>
        </div>
    </section>
<?php else : ?>
    <p>No slider posts found.</p>
<?php endif; ?>