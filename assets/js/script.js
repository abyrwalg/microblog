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

function validateForm(form) {
  let formValidity = true;
  const inputGroup = form.querySelectorAll("div.input-div");
  inputGroup.forEach((inputDiv) => {
    let valid = true;
    let errorMessage = "";
    const input = inputDiv.querySelector("input");

    const allowedSymbols = /^[a-zA-Z0-9]+$/;

    if (input.name === "name" && !allowedSymbols.test(input.value)) {
      valid = false;
      errorMessage =
        "Имя пользователя должно содержать только символы латинского алфавита и цифры";
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

    if (input.value.trim() === "") {
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

const form = document.querySelector(".form-to-handle");

if (form) {
  form.addEventListener("submit", formSubmitHandler);
}
