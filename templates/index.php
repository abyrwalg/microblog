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
  </main>
<?php include __DIR__ . "/components/footer.php" ?>
