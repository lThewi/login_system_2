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
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-muted">Loggen Sie sich mit ihrem Account ein</p>
                        <?php echo form_open('users/login'); ?>
                        <?php echo validation_errors(); ?>

                        <?php if ($this->session->flashdata('wrong_password')) : ?>
                            <?php echo '<p class="alert">' . $this->session->flashdata('wrong_password') . '</p>'; ?>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('wrong_email')) : ?>
                            <?php echo '<p class="alert">' . $this->session->flashdata('wrong_email') . '</p>'; ?>
                        <?php endif; ?>

                        <div class="input-group mb-3">
                            <input type="text" name="mail" placeholder="E-MAIL" id="email" required class="form-control">
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" name="password" placeholder="PASSWORT" id="password" required class="form-control">
                        </div>
                        <input type="submit" name="submit" value="ANMELDEN" class="btn btn-primary px-4">
                        <?php echo form_close() ?>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none">
                    <div class="card-body text-center">
                        <div>
                            <h2>Registrieren Sie sich</h2>
                            <p>Sie haben noch keinen Account bei uns? Registrieren Sie sich.</p>
                            <a href="<?php echo base_url(); ?>users/register" class="btn btn-primary active mt-3">Registrieren Sie sich jetzt!</a>
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
