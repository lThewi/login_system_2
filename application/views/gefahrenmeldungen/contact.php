<main class="main">
    <?php $strings = json_decode($strings_json); ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_1 ?></li>
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_2 ?></li>
        <li class="breadcrumb-item active"><?php echo $strings->breadcrumb_3 ?></li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_add;?>
            </div>
            <?php
            if ($contact_json != null) {
                $contact = json_decode($contact_json);
            }

            ?>

            <div class="card-body">
                <?php echo form_open_multipart($form_func); ?>
                <?php if ($this->session->flashdata('contact')) : ?>
                    <?php echo $this->session->flashdata("contact"); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('updated_contact')) : ?>
                    <?php echo $this->session->flashdata("updated_contact"); ?>
                <?php endif; ?>

                <?php echo validation_errors(); ?>
                 <!-- Buttons disablen wenn contacts_json inhalt hat und form_func auf default ist -->
                 <?php 
                    if($contact_json == null && $form_func == 'gefahrenmeldungen/contact'){
                        $button = 'disabled';
                    } else {
                        $button = '';
                    }
                ?>

                <div class="form-group">
                    <label for="email"><?php echo $strings->form_label_email;?></label>
                    <input type="text" id="email" name="email" class="form-control" required
                           value="<?php if ($contact_json != null) {
                               echo set_value('email', $contact[0]->email);
                           } else {echo set_value('email');} ?>" <?php echo $button ?>>
                    <input type="hidden" id="id" name="id" value="<?php if ($contact_json != null) {
                        echo set_value('id', $contact[0]->id);
                            }?>" >
                </div>
                <div class="form-group">
                    <label for="tel"><?php echo $strings->form_label_tel ?></label>
                    <input type="text" id="tel" name="tel" class="form-control" required
                              value="<?php if ($contact_json != null) {
                                    echo set_value('tel', $contact[0]->tel);
                              } else {echo set_value('tel');} ?>" <?php echo $button ?>>
                </div>
               
                <input type="submit" class="btn btn-lg btn-primary" value="<?php echo $strings->form_button_save;?> " <?php echo $button ?>>
                <input type="reset" class="btn btn-lg btn-danger" value="<?php echo $strings->form_button_reset;?> "<?php echo $button ?>>

                <?php echo form_close(); ?>

            </div>
        </div>


        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_show;?>
            </div>
            <div class="card-body">
                <?php
                $con = json_decode($contacts_json);

                if($con) {
                    echo '<table class="table table-responsive-sm table-hover table-outline sorted_table cat-table" id="cat-table">';
                    echo '<thead class="thead-light">';
                    echo '<tr>';
                    echo '<th>'. $strings->table_head_email.' </th>';
                    echo '<th>'. $strings->table_head_tel.' </th>';
                    echo '<th class="no-sort">'. $strings->table_head_options.' </th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($con as $item) {
                        echo '<tr id="' . $item->id . '">';
                        echo '<td>' . $item->email . '</td>';
                        echo '<td>' . $item->tel . '</td>';
                        echo '<td>';
                        echo '<a href="' . base_url() . 'gefahrenmeldungen/contact/' . $item->id . '" class="btn btn-md btn-primary mx-1">'. $strings->table_button_mod.' </a>';
                        echo '<a href="#" class="btn btn-md btn-danger mx-1 delete-gefahren-kontakt" data-id="' . $item->id . '">'. $strings->table_button_delete.' </a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else echo $strings->no_entries;
                ?>
            </div>
        </div>
    </div>

</main>
</div>


<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sortable.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/javascript.js"></script>


</body>
</html>