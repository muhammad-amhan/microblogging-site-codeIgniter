
<h2 class="main-header"><?= $title; ?></h2>

<!-- Many methods use **messages** var as they share the same view, such as return search results, users and current user messages etc. -->
<?php foreach($messages as $message) : ?>
    <div class="wrapper">
      <!-- Print the username that published the message. -->
        <div class="message-header">
            <h3><?php echo $message['user_username']; ?></h3>
            <!-- Print when the message was posted. -->
            <p class="posted-at"><small><?php echo $message['posted_at']; ?></small></p>
        </div>

        <!-- Perform the follow button boolean check and display the user that was just followed. -->
        <?php if(isset($follow_btn)) : ?>
          <div class="follow">
              <a class="btn" href="<?php echo base_url().'user/follow/'.$name?>" class="btn">Follow</a>
          </div>
        <?php endif; ?>

        <!-- Print the message itself. -->
        <div class="message-body">
            <p><?php echo $message['text']; ?></p>
        </div>
    </div>
<?php endforeach; ?>

<!-- Print the flashdata for an empty search. -->
<?php if($this->session->flashdata('empty_search')) : ?>
    <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('empty_search').'</p>'; ?>
<?php endif; ?>
