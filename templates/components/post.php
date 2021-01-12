<?php

include_once __DIR__ . "/../../App/helpers.php";

if (isset($this->post)) {
  $post = $this->post;
 }

 $date = date("j.m.Y H:i", strtotime($post->date));
 $images = explode(",", $post->images);
 array_pop($images);
?>

<div class="card mb-3">
  <div class="card-header bg-white">
    <div style="background-image: url(<?php echo $post->user->avatar; ?>);" alt="User's avatar" class="post-avatar"></div>
    <p class="post-info">
      <b class="username"><?php echo $post->user->name; ?></b> 
      <span class="text-muted"><span class="login">@<?php echo $post->user->login; ?></span> · <?php echo formatDate($date); ?></span>
    </p>
  </div>
  <div class="card-body">
    <p class="card-text"><?php echo $post->content; ?></p>
    <div class="images">
      <?php foreach ($images as $image) {?>
      <div class="image-container" style="background-image: url(assets/images/posts/<?php echo $image ?>)">
      </div>
      <?php } ?>
    </div>
    <!-- <div class="image-preview"></div> -->
  </div>
</div>
