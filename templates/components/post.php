<?php

if (isset($this->post)) {
  $post = $this->post;
}
?>

<div class="card mb-3">
  <div class="card-header">
    <div style="background-image: url(<?php echo $post->user->avatar; ?>);" alt="User's avatar" class="post-avatar"></div>
    <p class="post-info">
      <b class="username"><?php echo $post->user->name; ?></b> 
      <span class="text-muted">@<?php echo $post->user->login; ?> - <?php echo date("d.m.Y H:i", strtotime($post->date)); ?></span>
    </p>
  </div>
  <div class="card-body">
    <p class="card-text"><?php echo $post->content; ?></p>
    <div class="image-preview"></div>
  </div>
</div>
