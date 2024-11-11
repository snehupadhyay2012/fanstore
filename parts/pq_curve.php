<?php 
    if(get_sub_field('show') || (isset($args['pdf_template_call']) && ($args['pdf_template_call'] == true))){
        if(have_rows('variations')){
            $dataArr = [];
            $voltages = [];
            $frequencies = [];
            $first = 1;
            while (have_rows('variations')): the_row();
                $variation = get_sub_field('variation');
                $voltages[] = isset($variation['voltage']) ? $variation['voltage'] : 0;
                $frequencies[] = isset($variation['frequency']) ? $variation['frequency'] : 0;

                if($first == 1){
                    $activeVoltage = isset($args['active_voltage']) ? $args['active_voltage'] : (isset($variation['voltage']) ? $variation['voltage'] : 0 ); 
                    $activeFreq = isset($args['active_frequency']) ? $args['active_frequency'] : (isset($variation['frequency']) ? $variation['frequency'] : 0 );
                }

                $dataArr[$variation['voltage']][$variation['frequency']]['curve_data'] = isset($variation['curve_data']) ? $variation['curve_data'] : [];
                $first = 0;
            endwhile;
            $voltages = array_unique($voltages);
            $frequencies = array_unique($frequencies);

            $currentCurve = [];
            foreach($dataArr[$voltages[0]][$frequencies[0]]['curve_data'] as $curveData){
                $currentCurve[] = [(int) $curveData['static_pressure'], (int) $curveData['air_volume']];
            }
            ?>
                <div class="d-none curve_data_array"><?= json_encode($dataArr); ?></div>
                <div class="d-none activeHighchart_data_array" data-animation="<?= isset($args['animation']) ? $args['animation'] : true; ?>"><?= json_encode($currentCurve); ?></div>
                <div class="row row-cols-lg-auto justify-content-center mt-3 curve_tab_btns <?= (isset($args['pdf_template_call']) && ($args['pdf_template_call'] == true)) ? 'd-none' : '' ?>">
                    <div class="col-auto voltage-col">
                        Voltage [V]
                        <?php 
                            foreach ($voltages as $voltage){
                                ?>
                                    <button class="btn <?= $activeVoltage == $voltage ? 'btn-outline-success active':'' ?> voltageBtn updateCurve" data-value="<?= $voltage ?>"><?= $voltage ?></button>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="col-auto freq-col">
                        Frequency [Hz]
                        <?php 
                            foreach ($frequencies as $frequency){
                                ?>
                                    <button class="btn <?= $activeFreq == $frequency ? 'btn-outline-success active':'' ?> frequencyBtn updateCurve" data-value="<?= $frequency ?>"><?= $frequency ?></button>
                                <?php
                            }
                        ?>
                    </div>
                </div>

            <?php
        }
    ?>
        <figure class="highcharts-figure">
            <div id="container" style="width:500px!important"></div>
        </figure>

        <script>
            jQuery(window).load(function() {
                updateCurve();
            });
        </script>
        <?php
    }
?>