<?php session_start(); 
include __DIR__ . "/components/header.php" 
?>

<div class="container profile-page">
  <div class="row">
    <div class="col-lg-6 m-auto">
      <h1 class="h4 mb-4">Изменить профиль <span class="lead">@<?php echo $this->login ?></span></h1>
      <div class="avatar-container d-flex justify-content-center mb-4">
        <div class="overlay" onclick="uploadAvatar()">
          <div class="avatar" style="background-image: url(<?php echo $this->avatar; ?>)"></div>
        </div>
      </div>
      <form method="post" action="profile.php">
        <div class="form-group mb-3">
          <label for="name">Имя</label>
          <input type="text" class="form-control mt-2" id="name" name="name" value="<?php echo $this->userName; ?>">
        </div>
        <div class="form-group mb-3">
          <label for="about">О себе</label>
          <textarea class="form-control mt-2" id="about" rows="3" name="about" style="resize: none;"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . "/components/footer.php" ?>