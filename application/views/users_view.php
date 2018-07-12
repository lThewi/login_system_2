    <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <div class="card card-accent-primary">
                <div class="card-header">
                    Nicht aktivierte Accounts
                </div>
                <div class="card-body" id="pending-users">
                    <?php echo form_open('users/add_multiple_users') ?>
                    <table class="table table-responsive-sm table-hover table-outline">
                        <thead class="thead-light">
                        <tr>
                            <th><!--<label><input type="checkbox" id="check-all"></label>--></th>
                            <th><strong>Name</strong></th>
                            <th><strong>Nachname</strong></th>
                            <th><strong>Email</strong></th>
                            <th><strong>Accounttyp</strong></th>
                        </tr>
                        </thead>

                        <?php
                        $user_types = json_decode($user_types_json);
                        $temp_users = json_decode($temp_users_json);
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
                                <td>'. form_dropdown($dropdown_name, $types, 2, array('class' => 'form-control')) .'</td>
                                </tr>';
                        }
                        ?>
                    </table>
                    <input type="submit" value="Hinzufügen" class="btn btn-lg btn-primary">
                    <?php echo form_close() ?>
                </div>
            </div>
            <div class="card card-accent-primary">
                <div class="card-header">
                    Aktivierte Accounts
                </div>
                <div class="card-body" id="users">
                    <table class="table table-responsive-sm table-hover table-outline">
                        <thead class="thead-light">
                        <tr>
                            <th><strong>Name</strong></th>
                            <th><strong>Nachname</strong></th>
                            <th><strong>Email</strong></th>
                            <th><strong>Accounttyp</strong></th>
                        </tr>
                        </thead>

                        <?php
                        $users = json_decode($users_json);
                        foreach ($users as $user) {
                            echo '<tr>
                                <td>'. $user->name .'</td>
                                <td>'. $user->lastname .'</td>
                                <td>'. $user->email .'</td>
                                <td>'. $user->acc_type_id .'</td>
                                </tr>';
                        }?>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>


<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/coreui.min.js"></script>
</body>
</html>