<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/coreui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
</head>
<body class="app flex-row align-items-center">
<?php
    $strings = json_decode($strings_json);
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1><?php echo $strings->email_card_header?></h1>

                        <p class="text-muted"><?php echo $strings->reset_text_head_email; ?></p>
                        <?php echo form_open('users/reset_pw_email'); ?>
                        <?php echo validation_errors(); ?>


                        <div class="input-group mb-3">
                            <input type="text" name="email" placeholder="<?php echo $strings->reset_text_email;?>" id="email" required class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="submit" name="submit" value="<?php echo $strings->reset_text_button_email ?>" class="btn btn-primary px-4">
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-link px-0" href="<?php echo base_url();?>users/login"><?php echo $strings->reset_text_back_link ?></a>
                            </div>
                        </div>
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
