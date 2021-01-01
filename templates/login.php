<?php include __DIR__ . "/components/header.php" ?>

<div class="container">
  <div class="row d-flex justify-content-center">
    <form class="col-lg-6 border p-3 mt-5 form-to-handle" novalidate>
      <div class="mb-3 input-div">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div class="invalid-feedback feedback"></div>
      </div>
      <div class="mb-3 input-div">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
        <div class="invalid-feedback feedback"></div>
      </div>
      <button type="submit" class="btn btn-primary">Войти</button>
    </form>
  </div>
</div>

<?php include __DIR__ . "/components/footer.php" ?>