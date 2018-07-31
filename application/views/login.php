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
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Login</h1>
                        <?php
                        $strings = json_decode($strings_json);

                        ?>
                        <p class="text-muted"><?php echo $strings->login_text_head; ?></p>
                        <?php echo form_open('users/login'); ?>
                        <?php echo validation_errors(); ?>
                        <?php

                        ?>
                        <?php if ($this->session->flashdata('wrong_password')) : ?>
                            <?php echo $this->session->flashdata('wrong_password'); ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('wrong_email')) : ?>
                            <?php echo $this->session->flashdata('wrong_email'); ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('reset_success')) : ?>
                            <?php echo $this->session->flashdata('reset_success'); ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('reset_error')) : ?>
                            <?php echo $this->session->flashdata('reset_error'); ?>
                        <?php endif; ?>

                        <div class="input-group mb-3">
                            <input type="text" name="mail" placeholder="E-MAIL" id="mail" required class="form-control" value="<?php if ($this->session->flashdata('mail')) echo set_value('mail',$this->session->flashdata('mail')); ?>">
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" name="password" placeholder="<?php echo $strings->login_text_password;?>" id="password" required class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="submit" name="submit" value="<?php echo $strings->login_text_button ?>" class="btn btn-primary px-4">
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-link px-0" href="<?php echo base_url();?>users/reset_pw_email"><?php echo $strings->login_forgot_password ?></a>
                            </div>
                        </div>

                        <?php echo form_close() ?>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none">
                    <div class="card-body text-center">
                        <div>
                            <h2><?php echo $strings->login_reg_text_headline; ?></h2>
                            <p><?php echo $strings->login_reg_text_head; ?></p>
                            <a href="<?php echo base_url(); ?>users/register" class="btn btn-primary active mt-3"><?php echo $strings->login_reg_text_button; ?></a>
                        </div>
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
