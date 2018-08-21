<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">News</li>
        <li class="breadcrumb-item active">News anzeigen</li>
    </ol>
    <div class="container-fluid">
        <?php if ($this->session->flashdata('upload_error')) : ?>
            <?php echo $this->session->set_flashdata("upload_error"); ?>
        <?php endif; ?>
        <?php
        $all_news = json_decode($all_news_json);
        $all_auths = json_decode($news_auths_json);
        $all_types = json_decode($user_types_json);

        echo '<div class="card card-accent-primary" id="news">';
        echo '<div class="card-header">'.$strings->card_header_show.'</div>';
        echo '<div class="card-body" id="news-body">';

        echo '<table class="table table-responsive-sm table-hover table-outline sorted_table" id="news-table">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th class="no-sort">'.$strings->form_title.'</th>';
        echo '<th>'.$strings->form_content.'</th>';
        echo '<th>'.$strings->form_category.'</th>';
        echo '<th>'.$strings->form_auth_level.'</th>';
        echo '<th class="no-sort">'.$strings->table_options.'</th>';
        echo '<tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($all_news as $news) {
            $auth_string = 'Admin';
            foreach($all_auths as $auth){
                if($news->id == $auth->news_id){
                    foreach ($all_types as $type){
                        if($auth->auth_id == $type->id && $auth->auth_id != 1)
                        $auth_string .= ', '.$type->name;
                    }

                }
            }

            echo '<tr id="'.$news->id.'">';
            echo '<td>' . $news->title . '</td>';
            echo '<td>' . $news->content . '</td>';
            echo '<td>' . $news->category_id. '</td>';
            echo '<td>' . $auth_string. '</td>';
            echo '<td>';
            echo '<a href="'.base_url().'news/update_news/'.$news->id.'" class="btn btn-md btn-primary mx-1">'.$strings->button_mod.'</a>';
            echo '<a href="#" class="btn btn-md btn-danger mx-1 delete-news" data-id="'.$news->id.'">'.$strings->button_delete.'</a>';
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
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>

</body>
</html>