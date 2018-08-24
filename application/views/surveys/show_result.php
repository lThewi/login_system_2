<main class="main">
    <?php
        $strings = json_decode($strings_json);
        $question = json_decode($question_json);
        $answers = json_decode($answers_json);
        $results = json_decode($results_json);
        
    ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_1 ?></li>
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_2?></li>
        <li class="breadcrumb-item"><?php echo $strings->breadcrumb_4?></li>
        <li class="breadcrumb-item active"><?php echo $strings->breadcrumb_5 ?></li>
    </ol>
    <div class="container-fluid">

        <a href="<?php echo base_url()?>surveys/show_surveys" class="btn btn-lg btn-success m-4">
            <?php echo $strings->button_back ?>
        </a>

        <div class="card card-accent-primary" id="text-card">
            <div class="card-header" id="result-card" data-id="<?php echo $question[0]->id; ?>" data-type="<?php echo $question[0]->survey_type ?>">
                <h2><?php echo $question[0]->question?></h2>
            </div>
            <div class="card-body">
                <h5><?php echo $strings->result_card_body_header; ?></h5>
                <ul id="answers">
                <?php 
                    // foreach($answers as $answer){
                    //     echo '<li class="answer-list">'.$answer->answer.'</li>';   
                    // }
                ?>
                </ul>
                <canvas id="result-chart"></canvas>
                <div id="rating-area"></div>
            </div>
        </div>

</main>
</div>


<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/javascript.js"></script>
<script src="<?php echo base_url(); ?>assets/js/chart_handler.js"></script>


<script>

</script>


</body>
</html>