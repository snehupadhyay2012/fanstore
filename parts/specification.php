<?php 
    if(have_rows('variations')){
        $voltages = [];
        $frequencies = [];
        $dataArr = [];
        $first = 1;
        while (have_rows('variations')): the_row();
            $variation = get_sub_field('variation');
            $voltages[] = isset($variation['voltage']) ? $variation['voltage'] : 0;
            $frequencies[] = isset($variation['frequency']) ? $variation['frequency'] : 0;
            $shortSpecifications = isset($variation['short_specification']) ? $variation['short_specification'] : [];
            $dataArr[$variation['voltage']][$variation['frequency']]['short_specification'] = $shortSpecifications;

            if($first == 1){
                $activeVoltage = (isset($variation['voltage']) ? $variation['voltage'] : 0 ); 
                $activeFreq = (isset($variation['frequency']) ? $variation['frequency'] : 0 );
            }

            $first = 0;
        endwhile;

        $voltages = array_unique($voltages);
        $frequencies = array_unique($frequencies);

        ?>
            <div class="d-none vol_freq_data_array"><?= json_encode($dataArr); ?></div>
            <div class="row row-cols-lg-auto justify-content-center mt-3 spec_tab_btns">
                <div class="col-auto voltage-col">
                    Voltage [V]
                    <?php 
                        $first = 1;
                        foreach ($voltages as $voltage){
                            ?>
                                <button class="btn <?= $activeVoltage == $voltage ? 'btn-outline-success active':'' ?> voltageBtn updateSpecifications" data-value="<?= $voltage ?>"><?= $voltage ?></button>
                            <?php
                            $first = 0;
                        }
                    ?>
                </div>
                <div class="col-auto freq-col">
                    Frequency [Hz]
                    <?php 
                        $first = 1;
                        foreach ($frequencies as $frequency){
                            ?>
                                <button class="btn <?= $activeFreq == $frequency ? 'btn-outline-success active':'' ?> frequencyBtn updateSpecifications" data-value="<?= $frequency ?>"><?= $frequency ?></button>
                            <?php
                            $first = 0;
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 shortSpecificationContainer pt-5">
                    <?php 
                        $specification = $dataArr[$voltages[0]][$frequencies[0]]['short_specification'];
                        foreach ($specification as $value) {
                            ?>
                                <div class="specRow">
                                    <h4 class="specLabel"><?= isset($value['label']) ? $value['label'] : '' ?></h4>
                                    <p class="specVal"><?= isset($value['value']) ? $value['value'] : '' ?></p>
                                </div>
                            <?php
                        }
                    ?>
                </div>
                <div class="col-lg-6">
                    <?php
                        $specificationImg = get_sub_field('image');
                    ?>

                    <img src="<?= $specificationImg ?>" alt="">
                </div>
                <div class="col-lg-6">
                    <?php
                        // Generate a URL to trigger the PDF generation
                        $pdf_url = add_query_arg(array('generate_spec_pdf' => 'true', 'post_id' => get_the_ID()));
                    ?>
                    <a href="<?php echo esc_url($pdf_url); ?>&voltage=<?= $activeVoltage ?>&freq=<?= $activeFreq ?>" data-base="<?= $pdf_url ?>" target="_blank" class="btn btn-primary downloadPDFBtn">Download PDF</a>
                </div>
            </div>
        <?php
    }else{
        echo 'No Variations Found!!';
    }
?>