<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url();?>assets/css/stylesheet.less" />
    <script src="<?php echo base_url();?>assets/js/less.min.js"></script>
</head>
<body>


<div class="nav-side">
    <h2>Navigationsleiste</h2>
    <ul>
        <li class="active"><a href="<?php echo base_url(); ?>users/users_view">Benutzer</a></li>
        <li><a href="<?php echo base_url(); ?>users/logout">Abmelden</a></li>
    </ul>
</div>
<div>
    <div>
        <?php echo form_open('users/add_multiple_users') ?>
        <table>
            <tr>
                <td></td>
                <td>Name</td>
                <td>Nachname</td>
                <td>Email</td>
                <td>Accounttyp</td>
            </tr>
        <?php
        foreach ($user_types as $user_type) {
            $types[$user_type->id] = $user_type->name;
        }
        foreach ($temp_users as $temp_user) {
            $dropdown_name = $temp_user->id;
            echo '<tr>
                    <td>'. form_checkbox('row[]', $temp_user->id, FALSE) .'</td>
                    <td>'. $temp_user->name .'</td>
                    <td>'. $temp_user->lastname .'</td>
                    <td>'. $temp_user->email .'</td>
                    <td>'. form_dropdown($dropdown_name, $types) .'</td>
                </tr>';
        }
        ?>
        </table>
        <input type="submit" value="Abschicken">
        <?php echo form_close() ?>
    </div>
    <hr>
    <div>
        <table>
            <tr>
                <td>Name</td>
                <td>Nachname</td>
                <td>Email</td>
                <td>Accounttyp</td>
            </tr>
            <?php
            foreach ($users as $user) {
                echo '<tr>
                    <td>'. $user->name .'</td>
                    <td>'. $user->lastname .'</td>
                    <td>'. $user->email .'</td>
                    <td>'. $user->acc_type_id .'</td>
                </tr>';
            }
            ?>
        </table>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/parsley.min.js"></script>
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>
</body>
</html>