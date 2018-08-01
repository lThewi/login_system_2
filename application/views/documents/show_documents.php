    <main class="main">
        <?php $strings = json_decode($strings_json); ?>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item">Dokumente</li>
            <li class="breadcrumb-item active">Dokumente anzeigen</li>
        </ol>
        <div class="container-fluid">
            <?php if ($this->session->flashdata('documents_created')) : ?>
                <?php echo $this->session->flashdata('documents_created'); ?>
            <?php endif; ?>
        <?php
            $categories = json_decode($categories_json);
            $documents = json_decode($documents_json);

            foreach ($categories as $cat){
                $print_table = FALSE;
                foreach ($documents as $doc){
                    if($doc->category === $cat->id){
                        $print_table = TRUE;
                        break;
                    }
                }
                echo '<div class="card card-accent-primary" id="'.$cat->name.'">';
                    echo '<div class="card-header">'.$cat->name.'</div>';
                    echo '<div class="card-body" id="'.$cat->name.'">';
                    if($print_table) {
                        echo '<table class="table table-responsive-sm table-hover table-outline sorted_table doc-table" id="'.$cat->name.'">';
                            echo '<thead class="thead-light">';
                                echo '<tr>';
                                    echo '<th>'.$strings->table_tech.'</th>';
                                    echo '<th>'.$strings->table_name.'</th>';
                                    echo '<th>'.$strings->table_date.'</th>';
                                    echo '<th class="no-sort">'.$strings->table_options.'</th>';
                                echo '<tr>';
                            echo '</thead>';
                            echo '<tbody class="ui-sortable">';
                            $id_cat_table = 0;
                            foreach ($documents as $doc) {
                                if ($doc->category === $cat->id) {
                                    echo '<tr id="'.$doc->id.'">';
                                        echo '<td>' . $doc->technische_kennung . '</td>';
                                        echo '<td>' . $doc->name . '</td>';
                                        echo '<td>' . $doc->created_date . '</td>';
                                        echo '<td>';
                                            echo '<a href="'.base_url().'documents/modify_document/'.$doc->id.'" class="btn btn-md btn-primary mx-1">'.$strings->button_mod.'</a>';
                                            echo '<a href="#" class="btn btn-md btn-danger mx-1 delete_row" data-id="'.$doc->id.'">'.$strings->button_delete.'</a>';
                                        echo '</td>';
                                    echo '</tr>';
                                    $id_cat_table++;
                                }
                            }
                            echo '</tbody>';
                        echo '</table>';
                    } else echo $strings->no_entries;
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