function looksLikeMail(str) {
  const lastAtPos = str.lastIndexOf("@");
  const lastDotPos = str.lastIndexOf(".");
  return (
    lastAtPos < lastDotPos &&
    lastAtPos > 0 &&
    str.indexOf("@@") == -1 &&
    lastDotPos > 2 &&
    str.length - lastDotPos > 2
  );
}

function isFileImage(file) {
  const acceptedImageTypes = ["image/gif", "image/jpeg", "image/png"];
  return file && acceptedImageTypes.includes(file["type"]);
}

function validateForm(form) {
  let formValidity = true;
  const inputGroup = form.querySelectorAll("div.input-div");
  inputGroup.forEach((inputDiv) => {
    let valid = true;
    let errorMessage = "";
    const input = inputDiv.querySelector(".form-control");

    const allowedSymbols = /^[a-zA-Z0-9]+$/;

    if (
      input.name === "login" &&
      !allowedSymbols.test(input.value) &&
      input.value.trim().length > 0
    ) {
      valid = false;
      errorMessage =
        "Логин может содержать только символы латинского алфавита и цифры";
    }

    if (input.type === "email" && !looksLikeMail(input.value.trim())) {
      valid = false;
      errorMessage = "Введите корректный email";
    }

    if (input.type === "password" && input.value.length < 8) {
      valid = false;
      errorMessage = "Длина пароля должна быть не меньше 8 символов";
    }

    if (input.name === "passwordConfirm") {
      const passwordInput = form.querySelector("input[name='password']");
      if (input.value !== passwordInput.value) {
        valid = false;
        errorMessage = "Пароли не совпадают";
      }
    }

    if (input.value.trim() === "" && input.classList.contains("required")) {
      valid = false;
      errorMessage = "Заполните это поле";
    }

    if (!valid) {
      input.classList.remove("is-valid");
      input.classList.add("is-invalid");
      inputDiv.querySelector(".feedback").innerHTML = errorMessage;
      formValidity = false;
    } else {
      input.classList.remove("is-invalid");
      input.classList.add("is-valid");
    }
  });
  return formValidity;
}

function formSubmitHandler(event) {
  event.preventDefault();
  if (validateForm(event.target)) {
    event.target.submit();
  }
}

function logOut() {
  const formData = new FormData();
  formData.append("logout", "true");
  fetch("http://localhost/microblog/login.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      console.log(data);
      window.location = "/microblog";
    });
}

function uploadAvatar() {
  const input = document.createElement("input");
  input.type = "file";
  input.accept = "image/png,image/gif,image/jpeg";

  input.onchange = (event) => {
    const file = event.target.files[0];
    if (isFileImage(file)) {
      const formData = new FormData();
      formData.append("avatar", file);
      fetch("profile.php", { method: "POST", body: formData }).then(() => {
        location.reload();
      });
    }
  };

  input.click();
}

const form = document.querySelector(".form-to-handle");
const logOutButton = document.querySelector("#logout-button");

if (form) {
  form.addEventListener("submit", formSubmitHandler);
}

if (logOutButton) {
  logOutButton.addEventListener("click", logOut);
}
