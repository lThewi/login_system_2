<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/coreui.min.css">
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url();?>assets/css/stylesheet.less" />
    <script src="<?php echo base_url();?>assets/js/less.min.js"></script>
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card ms-4">
                <div class="card-body p-4">
                    <h1>Registrierung</h1>
                    <p class="text-muted">Erstellen Sie Ihren Account</p>
                    <?php echo form_open('users/register'); ?>
                    <?php echo validation_errors(); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="name" placeholder="Name" autocomplete="off" required class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="lastname" placeholder="Nachname" autocomplete="off" required class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="email" placeholder="Email" required class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" placeholder="Password" required class="form-control">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="password2" placeholder="Comfirm Password" required class="form-control">
                    </div>

                    <input type="submit" value="REGISTRIEREN" class="btn btn-block btn-success">
                    <?php echo form_close(); ?>
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
