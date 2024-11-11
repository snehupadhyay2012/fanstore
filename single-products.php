<?php get_template_part('parts/header', null, ['sections' => ['highchart', 'flexslider']]); ?>

<main class="post-content">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="row product_outer_div">
                    <!-- Product Image -->
                    <div class="col-md-6">
                        <div class="border rounded p-3">
                            <?php 
                                $thumbnail = get_field('product_thumbnail');
                                if(!empty($thumbnail)){
                                    ?>
                                        <img src="<?php echo $thumbnail; ?>" class="img-fluid rounded wp-post-image" alt="">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="col-md-6">
                        <h1 class="product-title mb-3"><?php the_title(); ?></h1>
                        <p class="text-muted">Category: <a href="#">Electronics</a></p>
                        <!-- Key Points -->
                        <?php 
                            $getKeyPoints = get_field('key_points');
                            if(!empty($getKeyPoints) && count($getKeyPoints) > 0){
                                ?>
                                <ul>
                                    <?php
                                    foreach($getKeyPoints as $keyPoints){
                                        ?>
                                            <li class="mb-4"><?= $keyPoints['key_point'] ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                        ?>
                    </div>
                </div>

                <!-- Product Description and Reviews Tabs -->
                <div class="row mt-5">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="productTab" role="tablist">
                            <?php 
                                $first = 1;
                                while (have_rows('product_detail_tabs')): the_row();
                                    $layout_labels = [
                                        'features' => 'Features',
                                        'specification' => 'Specification',
                                        'support' => 'Support',
                                        'pq_curve' => 'PQ Curve',
                                    ];
                                    ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?= ($first == 1)? 'active':'' ?>" id="<?= get_row_layout() ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= get_row_layout() ?>" type="button" role="tab" aria-controls="<?= get_row_layout() ?>" aria-selected="true"><?= (isset($layout_labels[get_row_layout()]) ? $layout_labels[get_row_layout()] : get_row_layout()) ?></button>
                                    </li>
                                    <?php
                                        $first = 0;
                                endwhile
                            ?>
                        </ul>
                        <div class="tab-content p-4 border border-top-0" id="productTabContent">
                            <?php 
                                $first = 1;
                                while (have_rows('product_detail_tabs')): the_row();
                                    ?>
                                        <div class="tab-pane <?= ($first == 1)? 'fade show active':'fade' ?> " id="<?= get_row_layout() ?>" role="tabpanel" aria-labelledby="<?= get_row_layout() ?>-tab">
                                            <?php
                                                $first = 0;
                                                get_template_part('parts/' . get_row_layout());
                                            ?>
                                        </div>
                                    <?php    
                                endwhile
                            ?>    
                        </div>
                    </div>
                </div>
            </article>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- Display the Post Content -->
                <div class="post-description">
                    <?php 
                        the_content();
                    ?>
                </div>
            </article>
    <?php
        endwhile;
    else :
        echo '<p>No product found</p>';
    endif;
    ?>
</main>

<?php get_template_part('parts/footer'); ?>
