    <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item">Dokumente</li>
            <li class="breadcrumb-item active">Dokument erstellen</li>
        </ol>
        <div class="container-fluid">
            <div class="card card-accent-primary">
                <div class="card-header">
                    Dokument erstellen
                </div>
                <?php echo form_open_multipart('documents/modify'); ?>
                <div class="card-body">
                    <?php if ($this->session->flashdata('database_error')) : ?>
                        <?php echo '<p class="alert">' . $this->session->flashdata('database_error') . '</p>'; ?>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('upload_error')) : ?>
                        <?php echo '<p class="alert">' . $this->session->flashdata('upload_error_1') . '</p>'; ?>
                    <?php endif; ?>
                    <?php
                    $categories = json_decode($categories_json);
                    foreach ($categories as $cat){
                        $category_list[$cat->id] = $cat->name;
                    }
                    $doc = json_decode($document_json);


                    //hidden field with id?<?php echo set_value('name', $doc[0]->name)
                    //evtl preview für bilder
                    ?>


                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo set_value('name', $doc[0]->name);?>" required>
                            <input type="hidden" id="doc_id" name="doc_id" value="<?php echo $doc[0]->id; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="category">Kategorie</label>
                            <?php echo form_dropdown('categories', $category_list, $doc[0]->category, array('class' => 'form-control', 'id' => 'category')); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="tech">Technische Kennung</label>
                            <input type="text" name="tech" id="tech" class="form-control" value="<?php echo set_value('tech', $doc[0]->technische_kennung);?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date">Erstellungsdatum</label>
                            <input type="text" name="date" value="<?php echo set_value('date', $doc[0]->created_date);?>" class="flatpickr flatpickr-input form-control input" placeholder="Datum auswählen" readonly="readonly" tabindex="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="checked_by">Geprüft von</label>
                        <input type="text" name="checked_by" value="<?php echo set_value('checked_by', $doc[0]->checked_by);?>" id="checked_by" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Freitext</label>
                        <textarea id="textarea-input" name="content" class="form-control" ><?php echo $doc[0]->text;?></textarea>
                    </div>
                    <label>Bilder (Optional, bis zu drei Bilder möglich)</label>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <input type="file" name="img_1" id="img_1" value=""
                                   accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                            <input type="hidden" name="img_1_old" value="<?php echo $doc[0]->img_1?>">
                            <?php
                            if($doc[0]->img_1 != null){
                                $src_1 = 'class="img-thumbnail mt-2" src="'.base_url().'assets/uploaded_images/'.$doc[0]->img_1.'"';
                            } else $src_1 = '';?>
                            <img id="img_pv_1" <?php echo $src_1;?>/>

                        </div>
                        <div class="form-group col-md-4">
                            <input type="file" name="img_2" id="img_2"
                                   accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                            <input type="hidden" name="img_2_old" value="<?php echo $doc[0]->img_2?>">
                            <?php
                            if($doc[0]->img_2 != null){
                                $src_2 = 'class="img-thumbnail mt-2" src="'.base_url().'assets/uploaded_images/'.$doc[0]->img_2.'"';
                            } else $src_2 = '';?>
                                <img id="img_pv_2" <?php echo $src_2;?>/>

                        </div>
                        <div class="form-group col-md-4">
                            <input type="file" name="img_3" id="img_3"
                                   accept="image/tif, image/tiff, image/png, image/jpg, image/jpeg">
                            <input type="hidden" name="img_3_old" value="<?php echo $doc[0]->img_3?>">
                            <?php
                            if($doc[0]->img_3 != null){
                                $src_3 = 'class="img-thumbnail mt-2" src="'.base_url().'assets/uploaded_images/'.$doc[0]->img_3.'"';
                            } else $src_3 = '';?>
                            <img id="img_pv_3" <?php echo $src_3;?>/>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-lg btn-primary" value="Speichern">
                    <input type="reset" class="btn btn-lg btn-danger" value="Zurücksetzen">

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