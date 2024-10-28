<?php get_template_part('parts/header'); ?>
<?php
if (have_rows('main_page_sections')): 
    $slider_content = '';
    $other_sections = [];
    while (have_rows('main_page_sections')): the_row();
        if (get_row_layout() == 'main_slider'):
            // Because Slider Should Always Load First, Regardless of its order!!..
            ob_start();
            get_template_part('parts/main_slider');
            $slider_content = ob_get_clean();
        else:
            ob_start();
            get_template_part('parts/' . get_row_layout());
            $other_sections[] = ob_get_clean();
        endif;
    endwhile;
    
    echo $slider_content;
    foreach ($other_sections as $section):
        echo $section;
    endforeach;
endif;
?>

<?php get_template_part('parts/footer'); ?>