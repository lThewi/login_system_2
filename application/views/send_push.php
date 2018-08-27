<main class="main">
    <?php
        $strings = json_decode($strings_json);
    ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_1; ?></li>
        <li class="breadcrumb-item active"><?php echo $strings->breadcrumb_2; ?></li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header; ?>
            </div>
            <div class="card-body">
                <?php echo form_open('notifications/send_push') ?>

                <?php if ($this->session->flashdata('send_success')) : ?>
                    <?php echo $this->session->flashdata('send_success'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('send_error')) : ?>
                    <?php echo $this->session->flashdata('send_error'); ?>
                <?php endif; ?>

                <?php echo validation_errors(); ?>
                <div class="form-group">
                    <label for="title"><?php echo $strings->form_title; ?></label>
                    <input class="form-control" type="text" name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="message"><?php echo $strings->form_body; ?></label>
                    <input class="form-control" type="text" name="message" id="message">
                </div>
                <div class="form-group">
                    <label for=""><?php echo $strings->form_auth_level; ?></label>
                    <div class=" form-control " >
                        <?php
                        $user_types = json_decode($user_types_json);
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
                

                <input type="submit" value="<?php echo $strings->form_button_send; ?>" id="send" class="btn btn-lg btn-primary">
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</main>
</div>


<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/sortable.min.js"></script>
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>
<!--<script src="<?php //echo base_url();?>assets/js/custom_push.js"></script>-->


</body>
</html>