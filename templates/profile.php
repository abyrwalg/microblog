<?php session_start();

$validity = $this->validity; 
if ($validity) {
  $nameValue = $validity["name"][2];
  $aboutValue = $validity["about"][2];
} else {
  $nameValue = $this->userName;
  $aboutValue = $this->about;
}

$nameClass = $validity["name"][0];
$aboutClass = $validity["about"][0];

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
      <form method="post" action="profile.php" class="form-to-handle">
        <div class="form-group mb-3 input-div">
          <label for="name">Имя</label>
          <input type="text" class="form-control mt-2 required <?php echo $nameClass; ?>" id="name" name="name" maxlength="40" value="<?php echo $nameValue; ?>">
          <div class="invalid-feedback feedback"><?php echo $validity["name"][1]; ?></div>
        </div>
        <div class="form-group mb-3 input-div">
          <label for="about">О себе</label>
          <textarea class="form-control mt-2 <?php echo $aboutClass; ?>" id="about" rows="3" name="about" style="resize: none;" maxlength="2180"><?php echo $aboutValue; ?></textarea>
          <div class="invalid-feedback feedback"><?php echo $validity["about"][1]; ?></div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . "/components/footer.php" ?>