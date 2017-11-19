
<!-- Page title -->
<h2 class="main-header"><?= $title; ?></h2>

<!-- Check if user is logged in -->
<?php if($this->session->userdata('logged_in')) : ?>

    <!-- Print validation error messages -->
    <?php echo validation_errors(); ?>

    <!-- Post message form -->
    <?php echo form_open('message/doPost'); ?>
        <div class="post-wrapper">
            <input type="text" class="input-field" name="msgbody" placeholder="Message..." autofocus>
            <button type="submit" class="btn">Publish</button>
        </div>
    <?php echo form_close(); ?>
<?php endif; ?>
