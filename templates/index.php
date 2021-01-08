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
    <script src="assets/js/imagesUploader.js"></script>
    <script>
      const addImageButton = document.querySelector(".add-image-button");
      const imagesContainer = document.querySelector(".images-container");
      let imagesUploader;
      if (addImageButton) {
        imagesUploader = new ImagesUploader(addImageButton, imagesContainer);
      }
    </script>
  </main>
<?php include __DIR__ . "/components/footer.php" ?>
