<?php
use App\Models\User;

if (isset($this->post)) {
  $post = $this->post;
}
?>

<div class="card mb-3">
  <div class="card-header">
    <img src="assets/images/icons/default-avatar.png" alt="User's avatar" class="post-avatar">
    <p>
      <b class="username"><?php echo User::findById($post->author)->name; ?></b> 
      <span class="text-muted">@<?php echo User::findById($post->author)->login; ?> - <?php echo date("d.m.Y H:i", strtotime($post->date)); ?></span>
    </p>
  </div>
  <div class="card-body">
    <p class="card-text"><?php echo $post->content; ?></p>
    <div class="image-preview"></div>
  </div>
</div>
