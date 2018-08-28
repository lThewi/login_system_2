<main class="main">
    <?php $strings = json_decode($strings_json) ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_1 ?></li>
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_2?></li>
        <li class="breadcrumb-item active"><?php echo $strings->breadcrumb_4 ?></li>
    </ol>
    <div class="container-fluid">

        <div class="card card-accent-primary" id="text-card">
            <div class="card-header">
                <?php echo $strings->card_header_show ?>
            </div>
            <div class="card-body">

                <table class="table table-responsive-sm table-hover table-outline">
                    <thead class="thead-light">
                        <tr>
                            <th><?php echo $strings->table_head_img ?></th>
                            <th><?php echo $strings->table_head_question ?></th>
                            <th><?php echo $strings->table_head_type ?></th>
                            <th><?php echo $strings->table_head_votes ?></th>
                            <th><?php echo $strings->table_head_date ?></th>
                            <th><?php echo $strings->table_head_options ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $all_questions = json_decode($survey_questions_json);
                        $all_auths = json_decode($survey_auth_json);

                        foreach($all_questions as $question) {

                            echo '<tr>';
                                echo '<td>';
                                if($question->image == null){
                                    echo '<img class="table-image" src="'.base_url().'assets/uploaded_images/default-image.jpg">';
                                } else {
                                    echo '<img class="table-image" src="'.base_url().'assets/uploaded_images/'.$question->image.'">';
                                }
                                echo '</td>';
                                echo '<td>';
                                echo $question->question;
                                echo '</td>';
                                echo '<td>';
                                if($question->survey_type == 1){
                                    echo $strings->survey_type_mc;
                                } else {
                                    echo $strings->survey_type_r;
                                }
                                echo '</td>';
                                foreach($all_auths as $auth){
                                    if($question->id == $auth->question_id){
                                        echo '<td>';
                                        echo $question->votes.' / '.$auth->participants;
                                        echo '</td>';
                                    }
                                    
                                }
                                
                                echo '<td>';
                                echo $question->time_created;
                                echo '</td>';
                                echo '<td>';
                                if($question->votes == 0){
                                    echo '<a href="'.base_url().'surveys/show_result/'.$question->id.'" class="btn btn-light disabled">'.$strings->table_button_results.'</a>';
                                } else {
                                    echo '<a href="'.base_url().'surveys/show_result/'.$question->id.'" class="btn btn-light">'.$strings->table_button_results.'</a>';
                                }
                                echo '</td>';
                            echo '</tr>';

                        }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
</main>
</div>


<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/javascript.js"></script>


</body>
</html>