<main class="main">
    <?php $strings = json_decode($strings_json); ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">News</li>
        <li class="breadcrumb-item active">News erstellen</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_create; ?>
            </div>
            <?php echo form_open_multipart('news/create_news'); ?>
            <div class="card-body">
                <?php echo validation_errors(); ?>
                <?php if ($this->session->flashdata('database_error')) : ?>
                    <?php echo $this->session->flashdata('database_error'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('upload_error')) : ?>
                    <?php echo $this->session->flashdata('upload_error'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('news_validation_error')) : ?>
                    <?php echo $this->session->flashdata('news_validation_error'); ?>
                <?php endif; ?>
                <?php
                $categories = json_decode($categories_json);
                $user_types = json_decode($user_types_json);

                foreach ($categories as $cat) {
                    $category_list[$cat->id] = $cat->name;
                }
                ?>

                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="title"><?php echo $strings->form_title; ?></label>
                        <input type="text" id="title" name="title" class="form-control" required value="<?php echo set_value('title') ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category"><?php echo $strings->form_category; ?></label>
                        <?php echo form_dropdown('category', $category_list, 1, array('class' => 'form-control', 'id' => 'category')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content"><?php echo $strings->form_content; ?></label>
                    <textarea id="textarea-input" name="content" class="form-control" ><?php echo set_value('content') ?></textarea>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label"><?php echo $strings->form_auth_level; ?></label>
                    <div class="col-md-9 col-form-label">
                    <?php
                    foreach ($user_types as $type) {
                        if($type->type_name == 'Admin'){
                            echo '<div class="form-check checkbox">';
                            echo '<input class="form-check-input" type="checkbox" value="'.$type->id.'" id="check'.$type->id.'" name="check'.$type->id.'" disabled checked>';
                            echo '<label class="form-check-label">'.$type->type_name.'</label>';
                            echo '</div>';
                        } else {
                            echo '<div class="form-check checkbox">';
                            echo '<input class="form-check-input" type="checkbox" value="'.$type->id.'" id="check'.$type->id.'" name="check'.$type->id.'">';
                            echo '<label class="form-check-label">'.$type->type_name.'</label>';
                            echo '</div>';
                        }
                    }
                    ?>
                    </div>
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
            branding: false
        });

        $(".flatpickr").flatpickr({dateFormat: "Y-m-d"});

    });
</script>

</body>
</html>