<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_1 ?></li>
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_2?></li>
        <li class="breadcrumb-item active"><?php echo $strings->breadcrumb_3 ?></li>
    </ol>
    <div class="container-fluid">

        <div class="card card-accent-primary" id="text-card">
            <div class="card-header">
                <?php echo $strings->card_header_create ?>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#multiple-choice" class="nav-link active show" data-toggle="tab" role="tab" aria-controls="multiple-choice" aria-selected="true">
                            <?php echo $strings->button_switch_back ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#rating" class="nav-link" data-toggle="tab" role="tab" aria-controls="rating" aria-selected="false">
                            <?php echo $strings->button_switch ?>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active show" id="multiple-choice" role="tabpanel">
                        <?php echo form_open_multipart('surveys/create_survey'); ?>
                        <?php echo validation_errors(); ?>

                        <?php

                        $user_types = json_decode($user_types_json);
                        if ($this->session->flashdata('survey_created')) :
                            echo $this->session->flashdata('survey_created');
                        endif;
                        ?>

                        <div class="form-group">
                            <label for="question"><?php echo $strings->form_question ?></label>
                            <input type="text" id="question" name="question" class="form-control" required value="<?php echo set_value('question') ?>">
                            <input type="hidden" value="1" name="type">
                        </div>
                        <div id="answer-box">
                            <div class="form-group">
                                <label for="content"><?php echo $strings->form_answer ?></label>
                                <input type="text" name="answer1" id="answer1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="content"><?php echo $strings->form_answer ?></label>
                                <input type="text" name="answer2" id="answer2" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-md btn-outline-success" id="add-answer" value="<?php echo $strings->button_add_answer ?>">
                        </div>

                        <div class="row">

                            <div class="form-group col-6 ">
                                <label class=""><?php echo $strings->form_auth_level; ?></label>
                                <div class=" form-control " >
                                    <?php
                                    foreach ($user_types as $type) {
                                        if($type->type_name == 'Admin'){
                                            echo '<div class="form-check checkbox">';
                                            echo '<input class="form-check-input" type="checkbox" value="'.$type->id.'" id="check'.$type->id.'" name="check'.$type->id.'" disabled checked>';
                                            echo '<label class="form-check-label">'.$type->type_name.'</label>';
                                            echo '</div>';
                                        } else {
                                            echo '<div class="form-check checkbox">';
                                            echo '<input class="form-check-input" type="checkbox" value="'.$type->id.'" id="check'.$type->id.'" name="check'.$type->id.'">';
                                            echo '<label class="form-check-label">'.$type->type_name.'</label>';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group col-6 ">
                                <label><?php echo $strings->form_image ?></label>
                                <div class="form-control">
                                    <input type="file" name="img" id="img"
                                           accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                                    <img id="img_pv"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-4 pl-0">
                            <label for="push"><?php echo $strings->switch_label ?></label>
                            <div>
                                <label class="switch switch-sm switch-primary">
                                    <input type="checkbox" class="switch-input" name="push" checked>
                                    <span class="switch-slider"></span>
                                </label>
                            </div>
                        </div>

                        <div id="answer-counter"><input type="hidden" value="2" name="counter"></div>

                        <input type="submit" class="btn btn-lg btn-primary" value="<?php echo $strings->button_save ?>">
                        <input type="reset" class="btn btn-lg btn-danger" value="<?php echo $strings->button_reset ?>">

                        <?php echo form_close(); ?>
                    </div>

                    <div class="tab-pane" id="rating" role="tabpanel">
                        <?php echo form_open_multipart('surveys/create_survey'); ?>
                        <?php echo validation_errors(); ?>

                        <div class="form-group">
                            <label for="question"><?php echo $strings->form_question ?></label>
                            <input type="text" id="question-rating" name="questionRating" class="form-control" required value="<?php echo set_value('question') ?>">
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label><?php echo $strings->form_auth_level; ?></label>
                                <div class="form-control">
                                    <?php
                                    foreach ($user_types as $type) {
                                        if($type->type_name == 'Admin'){
                                            echo '<div class="form-check checkbox">';
                                            echo '<input class="form-check-input" type="checkbox" value="'.$type->id.'" id="check-rating'.$type->id.'" name="check-rating'.$type->id.'" disabled checked>';
                                            echo '<label class="form-check-label">'.$type->type_name.'</label>';
                                            echo '</div>';
                                        } else {
                                            echo '<div class="form-check checkbox">';
                                            echo '<input class="form-check-input" type="checkbox" value="'.$type->id.'" id="check-rating'.$type->id.'" name="check-rating'.$type->id.'">';
                                            echo '<label class="form-check-label">'.$type->type_name.'</label>';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label><?php echo $strings->form_image ?></label>
                                <div class="form-control">
                                    <input type="file" name="img-rating" id="img-rating"
                                           accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                                    <img id="img_pv_rating"/>
                                </div>
                            </div>

                        </div>




                        <div class="form-group col-4 pl-0">
                            <label for="push-rating"><?php echo $strings->switch_label ?></label>
                            <div>
                                <label class="switch switch-sm switch-primary m-0">
                                    <input type="checkbox" class="switch-input" id="push-rating" name="push-rating" checked>
                                    <span class="switch-slider"></span>
                                </label>
                            </div>
                        </div>



                        <input type="submit" class="btn btn-lg btn-primary" value="<?php echo $strings->button_save ?>">
                        <input type="reset" class="btn btn-lg btn-danger" value="<?php echo $strings->button_reset ?>">

                        <?php echo form_close(); ?>
                    </div>
                </div>


            </div>
        </div>
</main>
</div>


<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/javascript.js"></script>

<script>
    $('#skala-card').hide();
</script>

</body>
</html>