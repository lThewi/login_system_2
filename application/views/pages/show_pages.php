<main class="main">
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
        echo '<div class="card-header">Alle Seiten</div>';
        echo '<div class="card-body" id="all_pages_body">';

        if ($this->session->flashdata('page_created')){
            echo '<p class="alert alert-success">' . $this->session->flashdata("page_created") . '</p>';
        }
        if ($this->session->flashdata('page_updated')){
            echo '<p class="alert alert-success">' . $this->session->flashdata("page_updated") . '</p>';
        }
        if ($this->session->flashdata('page_deleted')){
            echo '<p class="alert alert-success">' . $this->session->flashdata("page_deleted") . '</p>';
        }
        if ($this->session->flashdata('page_delete_error')){
            echo '<p class="alert alert-success">' . $this->session->flashdata("page_delete_error") . '</p>';
        }

            echo '<table class="table table-responsive-sm table-hover table-outline sorted_table" id="all_pages_table">';
            echo '<thead class="thead-light">';
            echo '<tr>';
            echo '<th class="no-sort">Bild</th>';
            echo '<th>Name</th>';
            echo '<th>Erstelldatum</th>';
            echo '<th class="no-sort">Optionen</th>';
            echo '<tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($all_pages as $page){
                    echo '<tr id="'.$page->id.'">';
                    echo '<td><img src="'.base_url().$path.$page->graphic.'"></td>';
                    echo '<td>' . $page->name . '</td>';
                    echo '<td>'. $page->created_at .'</td>';
                    echo '<td>';
                    echo '<a href="'.base_url().'pages/modify_page/'.$page->id.'" class="btn btn-md btn-primary mx-1">Bearbeiten</a>';
                    echo '<a href="#" class="btn btn-md btn-danger mx-1 delete-page" data-id="'.$page->id.'">Löschen</a>';
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

<script>
    $(document).ready(function(){
        $('.sorted_table').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            placeholder: '<tr class="placeholder"/>'
        });

        $('table').tablesort();
    });
</script>

</body>
</html>