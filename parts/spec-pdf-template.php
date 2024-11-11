<?php
/*
Template Name: PDF Template
*/

if (isset($_GET['generate_spec_pdf']) && $_GET['generate_spec_pdf'] == 'true' && isset($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']);
    // Get post data
    $post = get_post($post_id);
    add_filter('show_admin_bar', '__return_false');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo get_the_title($post_id); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Enqueue scripts -->
    <?php do_action('enqueue_scripts_header', ['highchart', 'flexslider', 'spec_pdf_template']); // Enqueue scripts / styles for custom sections ?>

    <?php wp_head(); // WordPress hook for plugin/theme integration ?>
</head>
<body class="stop-scrolling">
    <div class="row">
        <div class="col-md-4">
            <div class="logo p-2">
                <?php
                    if ( get_field('show_logo', 'option') && get_field('kdk_logo', 'option') ):
                        ?>
                        <img src="<?php echo esc_url( get_field('kdk_logo', 'option') ); ?>" alt="KDK Logo" width="75">
                        <?php
                    else : 
                        ?>
                        <h3 class="p-2"><?= get_bloginfo('name'); ?></h3>
                        <?php
                    endif
                ?>
            </div>
        </div>
        <div class="col-md-8 justify-content-center">
            <h3 class="text-end p-3">Specification Data Sheet</h3>
        </div>
    </div>
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
            <h3 class="product-title mb-3"><?php the_title(); ?></h3>
            <div class="content">
            <?php 
                $getKeyPoints = get_field('key_points');
                if(!empty($getKeyPoints) && count($getKeyPoints) > 0){
                    ?>
                    <ul>
                        <?php
                        foreach($getKeyPoints as $keyPoints){
                            ?>
                                <li class="mb-2"><?= $keyPoints['key_point'] ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php 
                $dataArr = [];
                while (have_rows('variations')): the_row();
                    $variation = get_sub_field('variation');
                    $shortSpecifications = isset($variation['short_specification']) ? $variation['short_specification'] : [];
                    $dataArr[$variation['voltage']][$variation['frequency']]['short_specification'] = $shortSpecifications;
        
                endwhile;
                if((isset($_GET['voltage'])) && (isset($_GET['freq']))){
                    if(isset($dataArr[$_GET['voltage']][$_GET['freq']]['short_specification']) && ($dataArr[$_GET['voltage']][$_GET['freq']]['short_specification'] != '')){
                        $specification = $dataArr[$_GET['voltage']][$_GET['freq']]['short_specification'];
                        ?>
                            <table class="table text-xsmall table-bordered"><tbody>
                        <?php
                            foreach ($specification as $value) {
                        ?>
                            <tr><th class="text-center"><?= isset($value['label']) ? $value['label'] : '' ?></th>
                            <td class="text-center"><?= isset($value['value']) ? $value['value'] : '' ?></td></tr>
                        <?php
                            }
                        ?>
                            </tbody></table>
                        <?php
                    }
                }else{
                    ?>

                    <?php
                }
            ?>
        </div>
        <div class="col-md-6">
            <?php 
                while (have_rows('product_detail_tabs')): the_row();
                    if(get_row_layout() == 'specification'){
                        $specificationImg = get_sub_field('image');
                    }
                endwhile
            ?>
            <img src="<?= $specificationImg ?>" alt="" style="width:75%;object-fit:cover; ">
        </div>
    </div>
    <!-- <div class="page-break"></div> -->
    <div class="row">
        <div class="col-lg-12">
            <?php 
                get_template_part('parts/pq_curve',null,[
                        'pdf_template_call'=> true, 
                        'active_voltage'=> isset($_GET['voltage']) ? $_GET['voltage'] : '',
                        'active_frequency' => isset($_GET['freq']) ? $_GET['freq'] : '',
                        'animation' => false
                ]);
            ?>
        </div>
    </div>
</body>
<?php wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    window.onload = function() {
        setTimeout(() => {
            // Use html2pdf to convert the page to PDF
            const element = document.body; // or specify a specific element to convert
            var opt = {
                margin:       1,
                html2canvas:  { scale: 2 },
            };
            html2pdf().from(element).set(opt).save('<?php echo esc_js($post->post_title); ?>.pdf');
        }, 300);
    };
</script>
</html>
<?php
    exit; // Stop further execution
}
?>