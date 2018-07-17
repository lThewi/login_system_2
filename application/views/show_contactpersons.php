<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Dokumente</li>
        <li class="breadcrumb-item active">Dokumente anzeigen</li>
    </ol>
    <div class="container-fluid">
        <?php
        $contacts = json_decode($contact_persons_json);

            echo '<div class="card card-accent-primary" id="contacts">';
            echo '<div class="card-header">Kontaktpersonen</div>';
            echo '<div class="card-body" id="contacts-body">';

                echo '<table class="table table-responsive-sm table-hover table-outline sorted_table" id="contacts-table">';
                echo '<thead class="thead-light">';
                echo '<tr>';
                echo '<th>Name</th>';
                echo '<th>Position</th>';
                echo '<th class="no-sort">Optionen</th>';
                echo '<tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($contacts as $contact) {
                        echo '<tr>';
                        echo '<td>' . $contact->name . '</td>';
                        echo '<td>' . $contact->position . '</td>';
                        echo '<td>';
                        echo '<a href="'.base_url().'documents/modify_contact/'.$contact->id.'" class="btn btn-md btn-primary mx-1">Bearbeiten</a>';
                        echo '<a href="#" class="btn btn-md btn-danger mx-1 delete-contact" data-id="'.$contact->id.'">Löschen</a>';
                        echo '</td>';
                        echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';

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