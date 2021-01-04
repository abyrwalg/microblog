<?php
  session_start();
  $page = basename($_SERVER['PHP_SELF']);

  $loginActiveClass = $page == "login.php" ? "active disabled" : "";
  $registerActiveClass = $page == "register.php" ? "active disabled" : "";

  $userMenu;
  if (isset($_SESSION["login"])) {
    $userMenu = ' <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle avatar-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="assets/images/icons/default-avatar.png" class="main-nav-avatar">
      </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#" id="logout-button">Выйти</a></li>
      </ul>
    </li>';
  } else {
    $userMenu = "";
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <link href="http://localhost/microblog/assets/css/style.css" rel="stylesheet">
  <title>Микроблог</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex align-items-center mb-2 main-nav">
  <div class="container">
    <a class="navbar-brand" href="/microblog" ><img src="assets/images/icons/logo.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php echo $loginActiveClass; ?>" aria-current="page" href="login.php">Войти</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $registerActiveClass; ?>" href="register.php">Зарегистрироваться</a>
        </li>
        <?php echo $userMenu; ?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Найти</button>
      </form>
    </div>
  </div>
</nav>