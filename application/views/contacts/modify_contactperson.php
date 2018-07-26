<main class="main">
    <?php $strings = json_decode($strings_json); ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Dokumente</li>
        <li class="breadcrumb-item active">Ansprechpartner erstellen</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_mod ?>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('documents/modify_con'); ?>
                <?php echo validation_errors(); ?>
                <?php if ($this->session->flashdata('database_error')) : ?>
                    <?php echo $this->session->flashdata('database_error'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('upload_error')) : ?>
                    <?php echo $this->session->flashdata('upload_error'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('contact_created')) : ?>
                    <?php echo $this->session->flashdata('contact_created'); ?>
                <?php endif; ?>

                <?php
                    $contact = json_decode($contact_json);

                    $placeholder_list = array(
                        1 => 'Platzhalter 1',
                        2 => 'Platzhalter 2',
                        3 => 'Platzhalter 3',
                    );
                ?>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name"><?php echo $strings->form_name ?></label>
                        <input type="text" id="name" name="name" class="form-control" required value="<?php echo set_value('name', $contact[0]->name)?>">
                        <input type="hidden" id="con_id" name="con_id" value="<?php echo $contact[0]->id; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="position"><?php echo $strings->form_position ?></label>
                        <input type="text" id="position" name="position" class="form-control" required value="<?php echo set_value('name', $contact[0]->position)?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="tel"><?php echo $strings->form_tel ?></label>
                        <input type="text" id="tel" name="tel" class="form-control" required value="<?php echo set_value('tel', $contact[0]->tel)?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category"><?php echo $strings->form_contact_area ?></label>
                        <?php echo form_dropdown('category', $placeholder_list, $contact[0]->category_id, array('class' => 'form-control', 'id' => 'category')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="img"><?php echo $strings->form_img ?></label>
                    <div class="form-control col-md-4 mb-3">
                        <input type="file" name="img" id="img"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <input type="hidden" name="img_old" value="<?php echo $contact[0]->img?>">
                        <?php
                        if($contact[0]->img != null){
                            $path = json_decode($img_path);
                            $src = 'class="img-thumbnail mt-2" src="'.base_url().$path.$contact[0]->img.'"';
                        } else $src = 'class="img-thumbnail mt-2"';?>
                        <img id="img_pv" <?php echo $src;?>/>
                    </div>
                </div>
                <input type="submit" class="btn btn-lg btn-primary" value="<?php echo $strings->form_button_save ?>">
                <input type="reset" class="btn btn-lg btn-danger" value="<?php echo $strings->form_button_reset ?>">

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

</body>
</html>