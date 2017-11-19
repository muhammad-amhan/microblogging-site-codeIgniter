<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>CI Forum</title>
        <!-- we used base_url() to access a resource -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
    </head>

    <body>
        <nav class="navbar">
            <div class="container">
                <div class="nav-wrapper">
                    <ul class="nav-left">
                        <?php if($this->session->userdata('logged_in')) : ?>
                            <li class="nav-brand"><h3>Logged in as <?php echo $this->session->userdata('username')?></h3></li>
                        <?php endif; ?>
                        <li><a href="<?php echo base_url();?>search">Search</a></li>
                    </ul>

                    <ul class="nav-right">
                        <!-- if the user is not logged in then show the register and login links -->
                        <?php if(!$this->session->userdata('logged_in')) : ?>
                            <li><a href="<?php echo base_url();?>user/login">Login</a></li>
                        <?php endif; ?>

                        <!-- if the user is logged in then show the following links -->
                        <?php if($this->session->userdata('logged_in')) : ?>
                          <li><a href="<?php echo base_url().'user/feed/'.$this->session->userdata('username')?>">Feeds</a></li>
                          <li><a href="<?php echo base_url().'user/view/'.$this->session->userdata('username')?>">My Messages</a></li>
                            <li><a href="<?php echo base_url();?>message">Post Message</a></li>
                            <li><a href="<?php echo base_url();?>user/logout">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- This container will be ending in footer -->
        <div class="container">

            <!-- print the flashdata -->
            <!-- check for the message -->
            <?php if($this->session->flashdata('no_user')) : ?>
                <?php echo '<p class="alert alert-success">'.$this->session->flashdata('no_user').'</p>'; ?>
            <?php endif; ?>

            <?php if($this->session->flashdata('post_created')) : ?>
                <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
            <?php endif; ?>

            <?php if($this->session->flashdata('user_loggedin')) : ?>
                <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
            <?php endif; ?>

            <?php if($this->session->flashdata('user_loggedout')) : ?>
                <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
            <?php endif; ?>
