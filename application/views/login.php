<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/login_registration_system/assets/css/normalize.css">
    <link rel="stylesheet/less" type="text/css" href="/login_registration_system/assets/css/stylesheet.less" />
    <script src="/login_registration_system/assets/js/less.min.js"></script>
</head>
<body>

<div class="form-container">
    <div class="bt-form__wrapper">
        <h2>Login</h2>
        <?php echo form_open('users/login', array('id' => 'register-form', 'class' => 'bt-flabels js-flabels', 'data-parsley-validate' => '', 'data-parsley-errors-messages-disabled' => '')); ?>
        <?php echo validation_errors(); ?>
        <?php if ($this->session->flashdata('wrong_password')) : ?>
            <?php echo '<p class="alert">' . $this->session->flashdata('wrong_password') . '</p>'; ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('wrong_email')) : ?>
            <?php echo '<p class="alert">' . $this->session->flashdata('wrong_email') . '</p>'; ?>
        <?php endif; ?>
        <div class="bt-flabels__wrapper">
            <label>Email</label>
            <input type="text" name="mail" placeholder="E-MAIL" id="email" data-parsley-required data-parsley-type="email">
            <span class="bt-flabels__error-desc">Required/Invalid Email</span>
        </div>
        <div class="bt-flabels__wrapper">
            <label>Passwort</label>
            <input type="password" name="password" placeholder="PASSWORT" id="password" data-parsley-required>
            <span class="bt-flabels__error-desc">Required</span>
        </div>
        <input type="submit" name="submit" value="ANMELDEN">
        <?php echo form_close() ?>
    </div>
</div>


<script src="/login_registration_system/assets/js/jquery-3.3.1.min.js"></script>
<script src="/login_registration_system/assets/js/parsley.min.js"></script>
<script src="/login_registration_system/assets/js/javascript.js"></script>
</body>
</html>
