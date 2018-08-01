    <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <?php
                $strings = json_decode($strings_json);
            ?>

            <div class="card card-accent-primary">
                <div class="card-header">
                    <?php echo $strings->card_header_pending;?>
                </div>
                <div class="card-body" id="pending-users">
                    <?php echo form_open('users/add_multiple_users') ?>
                    <table class="table table-responsive-sm table-hover table-outline sorted_table" id="pending-users-table">
                        <thead class="thead-light">
                        <tr>
                            <th><!--<label><input type="checkbox" id="check-all"></label>--></th>
                            <th><strong><?php echo $strings->table_header_firstname;?></strong></th>
                            <th><strong><?php echo $strings->table_header_lastname;?></strong></th>
                            <th><strong><?php echo $strings->table_header_email;?></strong></th>
                            <th><strong><?php echo $strings->table_header_date;?></strong></th>
                            <th class="no-sort"><strong><?php echo $strings->table_header_type;?></strong></th>
                        </tr>
                        </thead>

                        <?php
                        $user_types = json_decode($user_types_json);
                        $temp_users = json_decode($temp_users_json);
                        foreach ($user_types as $user_type) {
                            $types[$user_type->id] = $user_type->name;
                        }
                        foreach ($temp_users as $temp_user) {
                            if($temp_user->declined == FALSE){
                                $dropdown_name = $temp_user->id;
                                echo '<tr id="'.$temp_user->id.'">
                                <td>'. form_checkbox('row[]', $temp_user->id, FALSE) .'</td>
                                <td>'. $temp_user->name .'</td>
                                <td>'. $temp_user->lastname .'</td>
                                <td>'. $temp_user->email .'</td>
                                <td>'. $temp_user->register_date .'</td>
                                <td>'. form_dropdown($dropdown_name, $types, 2, array('class' => 'form-control')) .'</td>
                                </tr>';
                            }
                        }
                        ?>
                    </table>
                    <input type="submit" value="<?php echo $strings->table_button_add;?>" class="btn btn-lg btn-primary accept-user" disabled>
                    <input type="button" value="<?php echo $strings->table_button_decline;?>" class="btn btn-lg btn-danger mx-1 decline-user" disabled/>
                    <?php echo form_close() ?>
                </div>
            </div>
            <div class="card card-accent-primary">
                <div class="card-header">
                    <?php echo $strings->card_header_active;?>
                </div>
                <div class="card-body" id="users">
                    <table class="table table-responsive-sm table-hover table-outline sorted_table" id="active-users-table">
                        <thead class="thead-light">
                        <tr>
                            <th><strong><?php echo $strings->table_header_firstname;?></strong></th>
                            <th><strong><?php echo $strings->table_header_lastname;?></strong></th>
                            <th><strong><?php echo $strings->table_header_email;?></strong></th>
                            <th><strong><?php echo $strings->table_header_date;?></strong></th>
                            <th><strong><?php echo $strings->table_header_last_login;?></strong></th>
                            <th><strong><?php echo $strings->table_header_type;?></strong></th>
                            <th><strong><?php echo $strings->table_header_options;?></strong></th>
                        </tr>
                        </thead>

                        <?php
                        $users = json_decode($users_json);
                        foreach ($users as $user) {
                            echo '<tr id="'.$user->id.'">';
                            echo '<td>'. $user->name .'</td>';
                            echo '<td>'. $user->lastname .'</td>';
                            echo '<td>'. $user->email .'</td>';
                            echo '<td>'. $user->register_date .'</td>';
                            echo '<td>'. $user->last_login .'</td>';
                            echo '<td>'. $user->acc_type_id .'</td>';
                            echo '<td>';
                                echo '<a href="'.base_url().'users/update_user/'.$user->id.'" class="btn btn-md btn-primary mx-1">'.$strings->table_button_mod.'</a>';
                                echo '<a href="#" class="btn btn-md btn-danger mx-1 decline-active-user" data-id="'.$user->id.'">'.$strings->table_button_decline.'</a>';
                            echo '</td>';
                            echo '</tr>';
                        }?>
                    </table>
                </div>
            </div>

            <div class="card card-accent-primary">
                <div class="card-header">
                    <?php echo $strings->card_header_declined;?>
                </div>
                <div class="card-body" id="declined-users">
                    <table class="table table-responsive-sm table-hover table-outline sorted_table" id="declined-users-table">
                        <thead class="thead-light">
                        <tr>
                            <th><strong><?php echo $strings->table_header_firstname;?></strong></th>
                            <th><strong><?php echo $strings->table_header_lastname;?></strong></th>
                            <th><strong><?php echo $strings->table_header_email;?></strong></th>
                            <th><strong><?php echo $strings->table_header_date;?></strong></th>
                            <th class="no-sort"><strong><?php echo $strings->table_header_options?></strong></th>
                        </tr>
                        </thead>

                        <?php
                        foreach ($temp_users as $temp_user) {
                            if($temp_user->declined == TRUE){
                                echo '<tr id="'.$temp_user->id.'">';
                                echo '<td>'. $temp_user->name .'</td>';
                                echo '<td>'. $temp_user->lastname .'</td>';
                                echo '<td>'. $temp_user->email .'</td>';
                                echo '<td>'. $temp_user->register_date .'</td>';
                                echo '<td><a href="#" class="btn btn-md btn-primary mx-1 re-add-user" data-id="'.$temp_user->id.'">'.$strings->table_button_add.'</a></td>';
                                echo '</tr>';
                            }
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
<script src="<?php echo base_url();?>assets/js/sortable.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.tablesort.min.js"></script>
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>


</body>
</html>