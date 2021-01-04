<?php use App\Models\User; ?>

<?php foreach (array_reverse($this->posts) as $post) { ?>
  <div class="post">
    <a href="post.php?id=<?php echo $post->id; ?>" class="post-link">
      <?php include __DIR__ . "/post.php";  ?>
    </a>
  </div>
<?php } ?>