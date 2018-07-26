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
            <?php echo form_open_multipart('documents/modify_doc'); ?>
            <div class="card-body">
                <?php if ($this->session->flashdata('database_error')) : ?>
                    <?php echo $this->session->flashdata('database_error'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('upload_error')) : ?>
                    <?php echo $this->session->flashdata('upload_error_1'); ?>
                <?php endif; ?>
                <?php
                $categories = json_decode($categories_json);
                $contacts = json_decode($contact_persons);
                foreach ($categories as $cat) {
                    $category_list[$cat->id] = $cat->name;
                }
                $doc = json_decode($document_json);
                foreach ($contacts as $contact) {
                    $contact_list[$contact->id] = $contact->name;
                }
                ?>


                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name"><?php echo $strings->form_name; ?></label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="<?php echo set_value('name', $doc[0]->name); ?>" required>
                        <input type="hidden" id="doc_id" name="doc_id" value="<?php echo $doc[0]->id; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category"><?php echo $strings->form_category; ?></label>
                        <?php echo form_dropdown('categories', $category_list, $doc[0]->category, array('class' => 'form-control', 'id' => 'category')); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="tech"><?php echo $strings->form_tech; ?></label>
                        <input type="text" name="tech" id="tech" class="form-control"
                               value="<?php echo set_value('tech', $doc[0]->technische_kennung); ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="date"><?php echo $strings->form_date; ?></label>
                        <input type="text" name="date" value="<?php echo set_value('date', $doc[0]->created_date); ?>"
                               class="flatpickr flatpickr-input form-control input" placeholder="Datum auswählen"
                               readonly="readonly" tabindex="0">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="checked_by"><?php echo $strings->form_checked_by; ?></label>
                        <input type="text" name="checked_by"
                               value="<?php echo set_value('checked_by', $doc[0]->checked_by); ?>" id="checked_by"
                               class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contacts"><?php echo $strings->form_contact; ?></label>
                        <?php echo form_dropdown('contacts', $contact_list, $doc[0]->contact_person, array('class' => 'form-control', 'id' => 'contacts')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content"><?php echo $strings->form_text; ?></label>
                    <textarea id="textarea-input" name="content"
                              class="form-control"><?php echo $doc[0]->text; ?></textarea>
                </div>
                <label><?php echo $strings->form_img; ?></label>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="file" name="img_1" id="img_1" value=""
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <input type="hidden" name="img_1_old" value="<?php echo $doc[0]->img_1 ?>">
                        <?php
                        if ($doc[0]->img_1 != null) {
                            $src_1 = 'class="img-thumbnail mt-2" src="' . base_url() . 'assets/uploaded_images/' . $doc[0]->img_1 . '"';
                        } else $src_1 = ''; ?>
                        <img id="img_pv_1" <?php echo $src_1; ?>/>

                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="img_2" id="img_2"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <input type="hidden" name="img_2_old" value="<?php echo $doc[0]->img_2 ?>">
                        <?php
                        if ($doc[0]->img_2 != null) {
                            $src_2 = 'class="img-thumbnail mt-2" src="' . base_url() . 'assets/uploaded_images/' . $doc[0]->img_2 . '"';
                        } else $src_2 = ''; ?>
                        <img id="img_pv_2" <?php echo $src_2; ?>/>

                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="img_3" id="img_3"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <input type="hidden" name="img_3_old" value="<?php echo $doc[0]->img_3 ?>">
                        <?php
                        if ($doc[0]->img_3 != null) {
                            $src_3 = 'class="img-thumbnail mt-2" src="' . base_url() . 'assets/uploaded_images/' . $doc[0]->img_3 . '"';
                        } else $src_3 = ''; ?>
                        <img id="img_pv_3" <?php echo $src_3; ?>/>
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