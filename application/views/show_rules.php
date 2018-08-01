<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Regeln</li>
    </ol>
    <div class="container-fluid">
        <?php if ($this->session->flashdata('upload_error')) : ?>
            <?php echo $this->session->set_flashdata("upload_error"); ?>
        <?php endif; ?>
        <?php
        $all_rules = json_decode($rules_json);

        echo '<div class="card card-accent-primary" id="rules">';
        echo '<div class="card-header">'.$strings->card_header_show.'</div>';
        echo '<div class="card-body" id="rules-body">';

        echo '<table class="table table-responsive-sm table-hover table-outline sorted_table" id="rules-table">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th>'.$strings->table_number.'</th>';
        echo '<th>'.$strings->table_icon.'</th>';
        echo '<th>'.$strings->table_text.'</th>';
        echo '<tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($all_rules as $rule) {
            echo '<tr id="'.$rule->id.'">';
            echo '<td>' . $rule->id . '</td>';
            echo '<td><img src="'. $rule->icon . '"></td>';
            echo '<td>' . $rule->text. '</td>';
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
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>

</body>
</html>