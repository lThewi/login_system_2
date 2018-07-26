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
                <?php echo $strings->card_header_mod ?>
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
                <?php
                $categories = json_decode($categories_json);
                $news = json_decode($news_json);
                $path = json_decode($path_json);

                foreach ($categories as $cat) {
                    $category_list[$cat->id] = $cat->name;
                }

                $checked_array = explode(',',$news[0]->auth_levels);
                $check1 = $checked_array[0];
                $check2 = $checked_array[1];
                $check3 = $checked_array[2];
                $check4 = $checked_array[3];
                ?>

                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="title"><?php echo $strings->form_title ?></label>
                        <input type="text" id="title" name="title" class="form-control" required value="<?php echo set_value('title', $news[0]->title); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category"><?php echo $strings->form_category ?></label>
                        <?php echo form_dropdown('category', $category_list, set_value('category', $news[0]->category_id), array('class' => 'form-control', 'id' => 'category')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content"><?php echo $strings->form_content ?></label>
                    <textarea id="textarea-input" name="content" class="form-control"><?php echo set_value('content', $news[0]->content);?></textarea>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label"><?php echo $strings->form_auth_level ?></label>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" value="1" id="check1" name="check1" <?php if($check1 != ' '){echo 'checked';} ?>>
                            <label class="form-check-label">Berechtigungsstufe 1</label>
                        </div>
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" value="2" id="check2" name="check2" <?php if($check2 != ' '){echo 'checked';} ?>>
                            <label class="form-check-label">Berechtigungsstufe 2</label>
                        </div>
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" value="3" id="check3" name="check3" <?php if($check3 != ' '){echo 'checked';} ?>>
                            <label class="form-check-label">Berechtigungsstufe 3</label>
                        </div>
                        <div class="form-check checkbox">
                            <input class="form-check-input" type="checkbox" value="4" id="check4" name="check4" <?php if($check4 != ' '){echo 'checked';} ?>>
                            <label class="form-check-label">Berechtigungsstufe 4</label>
                        </div>
                    </div>
                </div>

                <label><?php echo $strings->form_img ?></label>
                <div class="row">
                    <div class="form-group col-md-4">
                        <input type="file" name="img_1" id="img_1" value=""
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <input type="hidden" name="img_1_old" value="<?php echo $news[0]->img_1?>">
                        <?php
                        if($news[0]->img_1 != null){
                            $src_1 = 'class="img-thumbnail mt-2" src="'.base_url().$path.$news[0]->img_1.'"';
                        } else $src_1 = '';?>
                        <img id="img_pv_1" <?php echo $src_1;?>/>

                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="img_2" id="img_2"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <input type="hidden" name="img_2_old" value="<?php echo $news[0]->img_2?>">
                        <?php
                        if($news[0]->img_2 != null){
                            $src_2 = 'class="img-thumbnail mt-2" src="'.base_url().$path.$news[0]->img_2.'"';
                        } else $src_2 = '';?>
                        <img id="img_pv_2" <?php echo $src_2;?>/>

                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" name="img_3" id="img_3"
                               accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                        <input type="hidden" name="img_3_old" value="<?php echo $news[0]->img_3?>">
                        <?php
                        if($news[0]->img_3 != null){
                            $src_3 = 'class="img-thumbnail mt-2" src="'.base_url().$path.$news[0]->img_3.'"';
                        } else $src_3 = '';?>
                        <img id="img_pv_3" <?php echo $src_3;?>/>
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