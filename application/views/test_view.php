<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <?php
        $strings = json_decode($strings_json);
        ?>

        <div class="card card-accent-primary">
            <div class="card-header">
                Test
            </div>
            <div class="card-body" id="pending-users">
                <?php echo form_open('api/test') ?>
                <input type="text" name="message" id="message" placeholder="Nachricht eingeben.">
                <input type="button" value="Senden" id="send" class="btn btn-lg btn-primary">
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</main>
</div>


<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/coreui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/sortable.min.js"></script>
<script src="<?php echo base_url();?>assets/js/javascript.js"></script>
<script src="<?php echo base_url();?>assets/js/push_test.js"></script>


</body>
</html>