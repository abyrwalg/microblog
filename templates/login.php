<?php session_start(); 

if ($this->loginFail) {
  $invalidClass = "is-invalid";
  $errorMessage = "Логин или пароль неверный";
}

?>
<?php include __DIR__ . "/components/header.php" ?>

<div class="container">
  <div class="row d-flex justify-content-center">
    <form class="col-lg-6 border p-3 mt-5 form-to-handle" method="post" action="login.php" novalidate>
      <div class="mb-3 input-div">
        <label for="login" class="form-label">Логин</label>
        <input type="text" class="form-control <?php echo $invalidClass; ?>" id="login" name="login">
        <div class="invalid-feedback feedback"></div>
      </div>
      <div class="mb-3 input-div">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control <?php echo $invalidClass; ?>" id="exampleInputPassword1" name="password">
        <div class="invalid-feedback feedback"><?php echo $errorMessage; ?></div>
      </div>
      <button type="submit" class="btn btn-primary">Войти</button>
    </form>
  </div>
</div>

<?php include __DIR__ . "/components/footer.php" ?>