<?php get_template_part('parts/header'); ?>

<main class="post-content">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- Display the Title -->
                <h1 class="post-title"><?php the_title(); ?></h1>
                <!-- Display Short Description -->
                <p><?= get_post_meta(get_the_ID(), 'subtitle', true) ?></p>
                <!-- Display the Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                <!-- Display the Post Content -->
                <div class="post-description">
                    <?php the_content(); ?>
                </div>
            </article>
    <?php
        endwhile;
    else :
        echo '<p>No fans found</p>';
    endif;
    ?>
</main>

<?php get_template_part('parts/footer'); ?>
