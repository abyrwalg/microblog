<?php 
session_start();
include __DIR__ . "/components/header.php"; 
?>
  <main class="container">
    <h1 class="h3 mb-3">Посты</h1>
    <?php if (isset($_SESSION["login"])) {
       include __DIR__ . "/components/postForm.php";
    }?>
    <?php include __DIR__ . "/components/postsFeed.php" ?>
    <script src="assets/js/PostForm.js"></script>
    <script src="assets/js/Gallery.js"></script>
    <script>
      const addImageButton = document.querySelector(".add-image-button");
      const imagesContainer = document.querySelector(".images-container");
      const formPost = document.querySelector(".post-form");
      let postForm;
      if (addImageButton) {
        postForm = new PostForm(formPost, addImageButton, imagesContainer);
      }

      //Add galleries to posts
      const posts = document.querySelectorAll(".post");
      posts.forEach((post) => {
        const gallery = new Gallery(post);
      })
    </script>
  </main>
<?php include __DIR__ . "/components/footer.php" ?>
