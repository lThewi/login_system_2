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
        <h2>Registrierung</h2>
        <?php echo form_open('users/register', array('id' => 'register-form', 'class' => 'bt-flabels js-flabels', 'data-parsley-validate' => '', 'data-parsley-errors-messages-disabled' => '')); ?>
        <?php echo validation_errors(); ?>
        <div class="bt-flabels__wrapper">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" autocomplete="off" data-parsley-required>
            <span class="bt-flabels__error-desc">Required</span>
        </div>
        <div class="bt-flabels__wrapper">
            <label class="">Nachname</label>
            <input type="text" name="lastname" placeholder="Nachname" autocomplete="off" data-parsley-required>
            <span class="bt-flabels__error-desc">Required</span>
        </div>
        <div class="bt-flabels__wrapper">
            <label class="">Email</label>
            <input type="text" name="email" placeholder="Email" data-parsley-required data-parsley-type="email">
            <span class="bt-flabels__error-desc">Required/Invalid Email</span>
        </div>
        <div class="bt-flabels__wrapper">
            <label class="">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" data-parsley-required>
            <span class="bt-flabels__error-desc">Required</span>
        </div>
        <div class="bt-flabels__wrapper">
            <label class="">Confirm Password</label>
            <input type="password" name="password2" placeholder="Comfirm Password" data-parsley-required data-parsley-equalto="#password">
            <span class="bt-flabels__error-desc">Required</span>
        </div>

        <input type="submit" value="REGISTRIEREN">
        <?php echo form_close(); ?>
    </div>
</div>


<script src="/login_registration_system/assets/js/jquery-3.3.1.min.js"></script>
<script src="/login_registration_system/assets/js/parsley.min.js"></script>
<script src="/login_registration_system/assets/js/javascript.js"></script>
</body>
</html>
