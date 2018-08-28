<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_1 ?></li>
        <li class="breadcrumb-item active"><?php echo $strings->breadcrumb_2 ?></li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_add; ?>
            </div>
            <div class="card-body">
            <?php echo form_open_multipart('rules/show_rules'); ?>
                <?php if ($this->session->flashdata('create_rule')) : ?>
                    <?php echo $this->session->flashdata("create_rule"); ?>
                <?php endif; ?>


                <?php echo validation_errors(); ?>


                <div class="form-group">
                    <label for="rule"><?php echo $strings->form_label_rule;?></label>
                    <input type="text" id="rule" name="rule" class="form-control" required>
                </div>
                <div class="form-group col-6 p-0">
                    <label><?php echo $strings->form_label_image ?></label>
                    <div class="form-control">
                        <input type="file" name="img" id="img"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <img id="img_pv"/>
                    </div>
                </div>


                <input type="submit" class="btn btn-lg btn-primary" value="<?php echo $strings->form_button_save;?> ">

            <?php echo form_close(); ?>

            </div>
        </div>




        <?php if ($this->session->flashdata('upload_error')) : ?>
            <?php echo $this->session->set_flashdata("upload_error"); ?>
        <?php endif; ?>
        <?php
        $all_rules = json_decode($rules_json);
        $path = json_decode($path_json);

        echo '<div class="card card-accent-primary" id="rules">';
        echo '<div class="card-header">'.$strings->card_header_show.'</div>';
        echo '<div class="card-body" id="rules-body">';

        echo '<table class="table table-responsive-sm table-hover table-outline sorted_table" id="rules-table">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th>'.$strings->table_number.'</th>';
        echo '<th>'.$strings->table_icon.'</th>';
        echo '<th>'.$strings->table_text.'</th>';
        echo '<th>'.$strings->table_options.'</th>';
        echo '<tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($all_rules as $rule) {
            echo '<tr id="'.$rule->id.'">';
            echo '<td>' . $rule->id . '</td>';
            echo '<td><img class="table-image" src="'. base_url() . $path . $rule->icon . '"></td>';
            echo '<td>' . $rule->text. '</td>';
            echo '<td><a href="#" class="btn btn-md btn-danger mx-1 delete-rule" data-id="'.$rule->id.'">'.$strings->table_button_delete.'</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

        echo '</div>';
        echo '</div>';

        ?>
    </div>
</main>
</div>

<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/sortable.min.js"></script>
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>

</body>
</html>