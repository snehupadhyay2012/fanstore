<?php 
    $pdfs = get_sub_field('pdfs');
    if(!empty($pdfs) && (count($pdfs) > 0)){
        foreach($pdfs as $pdf){
            ?>
                <div class="row">
                    <div class="col">
                        <label for="example" class="form-label"><?= isset($pdf['pdf_label'])? $pdf['pdf_label']: '' ?></label>
                    </div>
                    <div class="col text-end">
                        <a class="btn btn-primary" href="<?= isset($pdf['pdf_file'])? $pdf['pdf_file']: '' ?>" target="_blank">Download</a>
                    </div>
                </div>
            <?php
        }
    }
?>