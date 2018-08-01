<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Seiten</li>
        <li class="breadcrumb-item active">Seite bearbeiten</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_mod ?>
            </div>
            <?php echo form_open_multipart('pages/mod_page'); ?>
            <div class="card-body">
                <?php echo validation_errors(); ?>
                <?php if ($this->session->flashdata('page_update_error')) : ?>
                    <?php echo $this->session->flashdata("page_update_error"); ?>
                <?php endif; ?>

                <?php
                    $page = json_decode($page_json);
                ?>

                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name"><?php echo $strings->form_name ?></label>
                        <input type="text" id="name" name="name" class="form-control" required value="<?php echo set_value('name', $page[0]->name);?>">
                        <input type="hidden" id="page_id" name="page_id" value="<?php echo $page[0]->id; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="date"><?php echo $strings->form_date ?></label>
                        <input type="text" name="date" class="flatpickr flatpickr-input form-control input"
                               placeholder="Datum auswählen" readonly="readonly" tabindex="0"  value="<?php echo set_value('date', $page[0]->created_at);?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="content"><?php echo $strings->form_content ?></label>
                    <textarea id="textarea-input" name="content" class="form-control"><?php echo $page[0]->content;?></textarea>
                </div>
                <div class="form-group">
                    <label><?php echo $strings->form_img ?></label>
                    <div class="form-control col-md-4">

                        <input type="file" name="img" id="img"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <input type="hidden" name="img_old" value="<?php echo $page[0]->graphic?>">
                        <?php
                        if($page[0]->graphic != null && $page[0]->graphic != 'default-image.jpg'){
                            $path = json_decode($path_json);
                            $src = 'class="img-thumbnail mt-2" src="'.base_url().$path.$page[0]->graphic.'"';
                        } else $src = '';?>
                        <img id="img_pv" <?php echo $src;?>/>
                        <?php
                        if($page[0]->graphic != null && $page[0]->graphic != 'default-image.jpg'){
                            echo '<div class="form-group row m-0 mt-2">';
                            echo '<label class="switch switch-sm switch-secondary mr-2">';
                            echo '<input type="checkbox" name="del_old" id="del_old" class="switch-input">';
                            echo '<span class="switch-slider"></span>';
                            echo '</label>';
                            echo '<label for="del_old">'.$strings->del_old_image.'</label>';
                            echo '</div>';
                        }
                        ?>
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