<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/coreui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card ms-4">
                <div class="card-body p-4">
                    <?php $strings = json_decode($strings_json); ?>
                    <h1><?php echo $strings->register_text_headline ?></h1>
                    <p class="text-muted"><?php echo $strings->register_text_head ?></p>

                    <?php echo form_open('users/register'); ?>
                    <?php echo validation_errors(); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="name" placeholder="<?php echo $strings->register_text_firstname ?>" autocomplete="off" required class="form-control"
                               value="<?php if ($this->session->flashdata('name')) echo set_value('name',$this->session->flashdata('name')); ?>">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="lastname" placeholder="<?php echo $strings->register_text_lastname ?>" autocomplete="off" required class="form-control"
                               value="<?php if ($this->session->flashdata('lastname')) echo set_value('lastname',$this->session->flashdata('lastname')); ?>">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="email" placeholder="Email" required class="form-control"
                               value="<?php if ($this->session->flashdata('mail')) echo set_value('email',$this->session->flashdata('mail')); ?>">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" placeholder="<?php echo $strings->register_text_password ?>" required class="form-control">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="password2" placeholder="<?php echo $strings->register_text_cpassword ?>" required class="form-control">
                    </div>

                    <input type="submit" value="<?php echo $strings->register_text_rbutton ?>" class="btn btn-block btn-primary">

                    <?php echo form_close(); ?>
                    <a href="<?php echo base_url();?>/users/login" class="btn btn-light btn-block"><?php echo $strings->register_text_lbutton ?></a>
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
