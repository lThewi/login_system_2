<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">FAQ</li>
        <li class="breadcrumb-item active">Frage erstellen</li>
    </ol>
    <div class="container-fluid">
        <div class="card card-accent-primary">
            <div class="card-header">
                <?php echo $strings->card_header_mod ?>
            </div>
            <?php echo form_open_multipart('faq/mod_faq'); ?>
            <div class="card-body">
                <?php echo validation_errors(); ?>
                <?php if ($this->session->flashdata('faq_created')) : ?>
                    <?php echo $this->session->flashdata("faq_created"); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('faq_error')) : ?>
                    <?php echo $this->session->flashdata("faq_error"); ?>
                <?php endif; ?>

                <?php
                    $faq = json_decode($faq_json);
                ?>


                <div class="form-group">
                    <label for="question"><?php echo $strings->form_question ?></label>
                    <input type="text" id="question" name="question" class="form-control" required value="<?php echo set_value('question', $faq[0]->question);?>">
                    <input type="hidden" id="id" name="id" value="<?php echo set_value('id', $faq[0]->id);?>">
                </div>

                <div class="form-group">
                    <label for="content"><?php echo $strings->form_content ?></label>
                    <textarea id="content" name="content" class="form-control" required><?php echo $faq[0]->answer;?></textarea>
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
<script src="<?php echo base_url(); ?>assets/js/javascript.js"></script>

<script>
    $(document).ready(function () {
        tinymce.init({
            selector: 'textarea',
            branding: false
        });
    });
</script>

</body>
</html>