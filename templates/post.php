<?php include __DIR__ . "/components/header.php" ?>
<div class="container full-post-container">
  <a href="/microblog" class="back-to-posting"><span class="arrow">🠐</span><h2 class="h3">Опубликовать пост</h2></a>
  <div class="post full-post">
    <?php include __DIR__. "/components/post.php" ?>
  </div>
</div>
<script src="assets/js/Gallery.js"></script>
<script>
  const gallery = new Gallery(document.querySelector(".full-post"));
</script>
<?php include __DIR__ . "/components/footer.php" ?>