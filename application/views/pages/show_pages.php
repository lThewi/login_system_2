<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Seiten</li>
        <li class="breadcrumb-item active">Seiten anzeigen</li>
    </ol>
    <div class="container-fluid">
        <?php
        $all_pages = json_decode($all_pages_json);

        //table
        echo '<div class="card card-accent-primary" id="all_pages">';
        echo '<div class="card-header">'.$strings->card_header_show.'</div>';
        echo '<div class="card-body" id="all_pages_body">';

        if ($this->session->flashdata('page_created')){
            echo $this->session->flashdata("page_created");
        }
        if ($this->session->flashdata('page_updated')){
            echo $this->session->flashdata("page_updated");
        }
        if ($this->session->flashdata('page_deleted')){
            echo $this->session->flashdata("page_deleted");
        }
        if ($this->session->flashdata('page_delete_error')){
            echo$this->session->flashdata("page_delete_error");
        }

            echo '<table class="table table-responsive-sm table-hover table-outline sorted_table" id="all_pages_table">';
            echo '<thead class="thead-light">';
            echo '<tr>';
            echo '<th class="no-sort">'.$strings->form_img.'</th>';
            echo '<th>'.$strings->form_name.'</th>';
            echo '<th>'.$strings->form_date.'</th>';
            echo '<th class="no-sort">'.$strings->table_options.'</th>';
            echo '<tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($all_pages as $page){
                    echo '<tr id="'.$page->id.'">';
                    echo '<td><img src="'.base_url().$path.$page->graphic.'"></td>';
                    echo '<td>' . $page->name . '</td>';
                    echo '<td>'. $page->created_at .'</td>';
                    echo '<td>';
                    echo '<a href="'.base_url().'pages/modify_page/'.$page->id.'" class="btn btn-md btn-primary mx-1">'.$strings->table_button_mod.'</a>';
                    echo '<a href="#" class="btn btn-md btn-danger mx-1 delete-page" data-id="'.$page->id.'">'.$strings->table_button_delete.'</a>';
                    echo '</td>';
                    echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        echo '</div>';
        echo '</div>';

        //table end


        foreach ($all_pages as $page){
            echo '<div class="card card-accent-primary" id="'.$page->name.'">';
            echo '<div class="card-header">'.$page->name.'</div>';
            echo '<div class="card-body" id="'.$page->name.'">';
            echo $page->content;
            echo '</div>';
            echo '</div>';
        }
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