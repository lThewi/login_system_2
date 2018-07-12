    <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item">Dokumente</li>
            <li class="breadcrumb-item active">Dokumente anzeigen</li>
        </ol>
        <div class="container-fluid">
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
                echo '<div class="card card-accent-primary">';
                    echo '<div class="card-header">'.$cat->name.'</div>';
                    echo '<div class="card-body" id="'.$cat->name.'">';
                    if($print_table) {
                        echo '<table class="table table-responsive-sm table-hover table-outline">';
                            echo '<thead class="thead-light">';
                                echo '<tr>';
                                    echo '<th>Technische Kennung</th>';
                                    echo '<th>Name</th>';
                                    echo '<th>Optionen</th>';
                                echo '<tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            foreach ($documents as $doc) {
                                if ($doc->category === $cat->id) {
                                    echo '<tr>';
                                        echo '<td>' . $doc->technische_kennung . '</td>';
                                        echo '<td>' . $doc->name . '</td>';
                                        echo '<td>';
                                            echo '<a href="'.base_url().'documents/modify_document/'.$doc->id.'" class="btn btn-md btn-primary mx-1">Bearbeiten</a>';
                                            echo '<a href="#" class="btn btn-md btn-danger mx-1 delete_row" data-id="'.$doc->id.'">Löschen</a>';
                                        echo '</td>';
                                    echo '</tr>';
                                }
                            }
                            echo '</tbody>';
                        echo '</table>';
                    } else echo 'Keine Einträge in dieser Kategorie';
                    echo '</div>';
                echo '</div>';
            }
        ?>
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Achtung</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">x</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Sind Sie sicher, dass Sie dieses Dokument löschen wollen?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nein</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Ja, löschen</button>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>
</div>


<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>

</body>
</html>