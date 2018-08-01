<main class="main">
    <?php $strings = json_decode($strings_json); ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Dokumente</li>
        <li class="breadcrumb-item active">Kategorie erstellen</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_create;?>
            </div>
            <?php
            if ($category != null) {
                $this_category = json_decode($category);
            }

            ?>

            <div class="card-body">
                <?php echo form_open_multipart($form_func); ?>
                <?php if ($this->session->flashdata('created_category')) : ?>
                    <?php echo $this->session->flashdata("created_category"); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('updated_category')) : ?>
                    <?php echo $this->session->flashdata("updated_category"); ?>
                <?php endif; ?>

                <?php echo validation_errors(); ?>

                <div class="form-group">
                    <label for="name"><?php echo $strings->form_name;?></label>
                    <input type="text" id="name" name="name" class="form-control" required
                           value="<?php if ($category != null) {
                               echo set_value('name', $this_category[0]->name);
                           } else {echo set_value('name');} ?>">
                    <input type="hidden" id="cat_id" name="cat_id" value="<?php if ($category != null) {
                        echo set_value('id', $this_category[0]->id);
                    }?>">
                </div>

                <input type="submit" class="btn btn-lg btn-primary" value="<?php echo $strings->form_button_save;?> ">
                <input type="reset" class="btn btn-lg btn-danger" value="<?php echo $strings->form_button_reset;?> ">

                <?php echo form_close(); ?>

            </div>
        </div>


        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_show;?>
            </div>
            <div class="card-body">
                <?php
                $cat = json_decode($categories);

                if($cat) {
                    echo '<table class="table table-responsive-sm table-hover table-outline sorted_table cat-table" id="cat-table">';
                    echo '<thead class="thead-light">';
                    echo '<tr>';
                    echo '<th>'. $strings->table_category.' </th>';
                    echo '<th class="no-sort">'. $strings->table_options.' </th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($cat as $item) {
                        echo '<tr id="' . $item->id . '">';
                        echo '<td>' . $item->name . '</td>';
                        echo '<td>';
                        echo '<a href="' . base_url() . 'documents/create_category/' . $item->id . '" class="btn btn-md btn-primary mx-1">'. $strings->button_mod.' </a>';
                        echo '<a href="#" class="btn btn-md btn-danger mx-1 delete-category" data-id="' . $item->id . '">'. $strings->button_delete.' </a>';
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
<script src="<?php echo base_url(); ?>assets/js/jquery.tablesort.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/javascript.js"></script>

<script>
    $(document).ready(function(){
        $('table').tablesort();
    });
</script>

</body>
</html>