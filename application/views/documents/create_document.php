<main class="main">
    <?php $strings = json_decode($strings_json)?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Dokumente</li>
        <li class="breadcrumb-item active">Dokument erstellen</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header; ?>
            </div>
            <?php echo form_open_multipart('documents/create_document'); ?>
            <div class="card-body">
                <?php echo validation_errors(); ?>
                <?php if ($this->session->flashdata('database_error')) : ?>
                    <?php echo $this->session->flashdata('database_error'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('upload_error')) : ?>
                    <?php echo $this->session->flashdata('upload_error'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('form_errors')) : ?>
                    <?php echo $this->session->flashdata('form_errors'); ?>
                <?php endif; ?>

                <?php
                $categories = json_decode($categories_json);
                $contacts = json_decode($contact_persons);
                foreach ($categories as $cat) {
                    $category_list[$cat->id] = $cat->name;
                }
                foreach ($contacts as $contact) {
                    $contact_list[$contact->id] = $contact->name;
                }
                if(!$contacts){
                    $contact_list[0] = $strings->no_contacts;
                } else{
                    $contact_list[0] = $strings->contacts_list;
                }
                ?>

                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name"><?php echo $strings->form_name; ?></label>
                        <input type="text" id="name" name="name" class="form-control" required value="<?php echo set_value('name') ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category"><?php echo $strings->form_category; ?></label>
                        <?php echo form_dropdown('categories', $category_list, set_value('categories', '0'), array('class' => 'form-control', 'id' => 'category')); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="tech"><?php echo $strings->form_tech; ?></label>
                        <input type="text" name="tech" id="tech" class="form-control" required value="<?php echo set_value('tech') ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="date"><?php echo $strings->form_date; ?></label>
                        <input type="text" name="date" class="flatpickr flatpickr-input form-control input"
                               placeholder="Datum auswählen" readonly="readonly" tabindex="0" value="<?php echo set_value('date') ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="checked_by"><?php echo $strings->form_checked_by; ?></label>
                        <input type="text" name="checked_by" id="checked_by" class="form-control" required value="<?php echo set_value('checked_by') ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contacts"><?php echo $strings->form_contact; ?></label>
                        <?php echo form_dropdown('contacts', $contact_list, set_value('contacts'), array('class' => 'form-control', 'id' => 'contacts')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content"><?php echo $strings->form_text; ?></label>
                    <textarea id="textarea-input" name="content" class="form-control"><?php echo set_value('content') ?></textarea>
                </div>
                <label><?php echo $strings->form_img; ?></label>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="file" name="img_1" id="img_1"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <img id="img_pv_1"/>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="img_2" id="img_2"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <img id="img_pv_2"/>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="img_3" id="img_3"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <img id="img_pv_3"/>
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
            branding: false,
        });

        $(".flatpickr").flatpickr({dateFormat: "Y-m-d"});
    });
</script>

</body>
</html>