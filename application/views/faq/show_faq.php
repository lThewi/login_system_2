<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">FAQ</li>
        <li class="breadcrumb-item active">FAQs anzeigen</li>
    </ol>
    <div class="container-fluid">
        <?php if ($this->session->flashdata('faq_deleted')) : ?>
        <?php echo $this->session->flashdata("faq_deleted"); ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('faq_delete_error')) : ?>
        <?php echo $this->session->flashdata("faq_delete_error"); ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('faq_updatetd')) : ?>
        <?php echo $this->session->flashdata("faq_updatetd"); ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('faq_update_error')) : ?>
        <?php echo $this->session->flashdata("faq_update_error"); ?>
        <?php endif; ?>

        <?php
        $faq = json_decode($faq_json);

        echo '<div class="card card-accent-primary" id="faq-card">';
        echo '<div class="card-header">'.$strings->card_header_show.'</div>';
        echo '<div class="card-body" id="faq-card-body">';
        echo '<div class="accordion" role="tablist">';
        foreach ($faq as $item){
            echo '<div class="card">';
            echo '<div class="card-header" role="tab" id="heading-'.$item->id.'">';
                echo '<strong>';
                echo '<a href="#collapse-'.$item->id.'" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-'.$item->id.'" class="collapsed">';
                echo $item->question;
                echo '</a>';
                echo '</strong>';

                echo '<div id="collapse-'.$item->id.'" class="collapse" role="tabpanel" aria-labbelledby="heading-'.$item->id.'" data-parent=""accordion>';
                echo '<div class="card-body">';
                echo $item->answer;
                echo '<a href="'.base_url().'faq/modify_faq/'.$item->id.'" class="btn btn-md btn-primary mx-1">'.$strings->button_mod.'</a>';
                echo '<a href="#" class="btn btn-md btn-danger mx-1 delete-faq" data-id="'.$item->id.'">'.$strings->button_delete.'</a>';
                echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '</div>';

        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        ?>
    </div>
</main>
</div>


<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/sortable.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.tablesort.min.js"></script>
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>

</body>
</html>