<main class="main">
    <?php $strings = json_decode($strings_json); ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Dokumente</li>
        <li class="breadcrumb-item active">Dokument erstellen</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_mod; ?>
            </div>
            <?php echo form_open_multipart('users/mod_user'); ?>
            <div class="card-body">
                <?php if ($this->session->flashdata('database_error')) : ?>
                    <?php echo $this->session->flashdata('database_error'); ?>
                <?php endif; ?>

                <?php
                $types = json_decode($types_json);
                foreach ($types as $type) {
                    $type_list[$type->id] = $type->type_name;
                }
                $user = json_decode($user_json);
                ?>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name"><?php echo $strings->form_name; ?></label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="<?php echo set_value('name', $user[0]->name); ?>" required>
                        <input type="hidden" id="id" name="id" value="<?php echo $user[0]->id; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname"><?php echo $strings->form_lastname; ?></label>
                        <input type="text" id="lastname" name="lastname" class="form-control"
                               value="<?php echo set_value('lastname', $user[0]->lastname); ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email"><?php echo $strings->form_email; ?></label>
                        <input type="text" id="email" name="email" class="form-control"
                               value="<?php echo set_value('email', $user[0]->email); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="acc_type"><?php echo $strings->form_type; ?></label>
                        <?php echo form_dropdown('acc_type', $type_list, $user[0]->acc_type_id, array('class' => 'form-control', 'id' => 'category')); ?>
                    </div>
                </div>
                <input type="submit" class="btn btn-lg btn-primary" value="<?php echo $strings->form_button_save; ?>">
                <input type="reset" class="btn btn-lg btn-danger" value="<?php echo $strings->form_button_reset; ?>">

                <?php echo form_close(); ?>

            </div>
        </div>
</main>
</div>


<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/flatpickr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/javascript.js"></script>

<script>
    $(document).ready(function () {
        tinymce.init({
            selector: 'textarea',
            branding: false
        });

        $(".flatpickr").flatpickr({dateFormat: "Y-m-d"});

    });
</script>

</body>
</html>