
<!-- Login form -->
<?php echo form_open('user/dologin'); ?>

    <div class="login-wrapper">
        <!-- Form title -->
        <h2 class="form-header"><?= $title; ?></h2>
        <!-- print validation messages -->
        <div class="validation">
            <?php echo validation_errors(); ?>
        </div>

        <!-- Print flashdata error -->
        <?php if($this->session->flashdata('login_failed')) : ?>
            <p class="alert alert-danger"><?php echo $this->session->flashdata('login_failed'); ?></p>
        <?php endif; ?>

        <div class="username">
            <label for="username">Username</label>
            <input type="text" class="input-field" name="username" placeholder="e.g. john123" autofocus>
        </div>

        <div class="password">
            <label for="password">Password</label>
            <input type="password" class="input-field" name="password" placeholder="********" autofocus>
        </div>

        <button type="submit" class="btn">Login</button>
    </div>

<?php echo form_close(); ?>
