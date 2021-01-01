<?php 

$validity = $this->validity; 

$nameClass = $validity["name"][0];
$emailClass = $validity["email"][0];
$passwordClass = $validity["password"][0];
$passwordConfirmClass = $validity["passwordConfirm"][0];

?>

<?php include __DIR__ . "/components/header.php" ?>

<div class="container">
  <div class="row d-flex justify-content-center">
    <form class="col-lg-6 border p-3 mt-5 form-to-handle" action="register.php" method="post" novalidate>
      <div class="mb-3 input-div">
        <label for="inputName" class="form-label">Имя</label>
        <input type="text" class="form-control <?php echo $nameClass ?>" id="inputName" name="name" value="<?php echo $validity["name"][2] ?>">
        <div class="invalid-feedback feedback"><?php echo $validity["name"][1] ?></div>
      </div>
      <div class="mb-3 input-div">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailClass ?>" id="exampleInputEmail1" name="email" value="<?php echo $validity["email"][2] ?>">
        <div class="invalid-feedback feedback"><?php echo $validity["email"][1] ?></div>
      </div>
      <div class="mb-3 input-div">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control <?php echo $passwordClass ?>" id="exampleInputPassword1" name="password" value="<?php echo $validity["password"][2] ?>">
        <div class="invalid-feedback feedback"><?php echo $validity["password"][1] ?></div>
      </div> 
      <div class="mb-3 input-div">
        <label for="confirmPassword1" class="form-label">Подтвердите пароль</label>
        <input type="password" class="form-control <?php echo $passwordConfirmClass ?>" id="confirmPassword1" name="passwordConfirm" value="<?php echo $validity["passwordConfirm"][2] ?>">
        <div class="invalid-feedback feedback"><?php echo $validity["passwordConfirm"][1] ?></div>
      </div>
      <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
  </div>
</div>

<?php include __DIR__ . "/components/footer.php" ?>
