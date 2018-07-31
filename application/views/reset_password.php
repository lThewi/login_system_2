<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/coreui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
</head>
<body class="app flex-row align-items-center">
<?php $strings = json_decode($strings_json);?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1><?php echo $strings->reset_card_header; ?></h1>
                        <?php

                        $user = json_decode($user_json);
                        if($temp){
                            $temp_value = 1;
                        } else $temp_value = 0;
                        ?>
                        <p class="text-muted"><?php echo $strings->reset_text_head; ?></p>
                        <?php echo form_open('users/reset_pw'); ?>
                        <?php echo validation_errors(); ?>

                        <?php if ($this->session->flashdata('wrong_password')) : ?>
                            <?php echo $this->session->flashdata('wrong_password'); ?>
                        <?php endif; ?>

                        <div class="input-group mb-3">
                            <input type="password" name="password" placeholder="<?php echo $strings->reset_text_password;?>" id="password" required class="form-control">
                            <input type="hidden" name="id" id="id" value="<?php echo $user->id; ?>">
                            <input type="hidden" name="temp" id="temp" value="<?php echo $temp_value; ?>">
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" name="cpassword" placeholder="<?php echo $strings->reset_text_cpassword;?>" id="cpassword" required class="form-control">
                        </div>
                        <input type="submit" name="submit" value="<?php echo $strings->reset_text_button ?>" class="btn btn-primary px-4">
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/parsley.min.js"></script>
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>
</body>
</html>
