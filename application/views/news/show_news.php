<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">News</li>
        <li class="breadcrumb-item active">News anzeigen</li>
    </ol>
    <div class="container-fluid">
        <?php if ($this->session->flashdata('upload_error')) : ?>
            <?php echo '<p class="alert alert-danger">'.$this->session->set_flashdata("upload_error").'</p>'; ?>
        <?php endif; ?>
        <?php
        $all_news = json_decode($all_news_json);

        echo '<div class="card card-accent-primary" id="news">';
        echo '<div class="card-header">News</div>';
        echo '<div class="card-body" id="news-body">';

        echo '<table class="table table-responsive-sm table-hover table-outline sorted_table" id="news-table">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th class="no-sort">Titel</th>';
        echo '<th>Content</th>';
        echo '<th>Kategorie</th>';
        echo '<th>Berechtigungslevel</th>';
        echo '<th class="no-sort">Optionen</th>';
        echo '<tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($all_news as $news) {
            echo '<tr id="'.$news->id.'">';
            echo '<td>' . $news->title . '</td>';
            echo '<td>' . $news->content . '</td>';
            echo '<td>' . $news->category_id. '</td>';
            echo '<td>' . $news->auth_levels. '</td>';
            echo '<td>';
            echo '<a href="'.base_url().'news/update_news/'.$news->id.'" class="btn btn-md btn-primary mx-1">Bearbeiten</a>';
            echo '<a href="#" class="btn btn-md btn-danger mx-1 delete-news" data-id="'.$news->id.'">Löschen</a>';
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
        $('table').tablesort();
    });
</script>