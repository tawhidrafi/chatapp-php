const form = document.querySelector(".signup form"),
  continueBtn = form.querySelector(".button input"),
  errorTxt = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

continueBtn.onclick = () => {
  //AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "assets/php/signup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == "Success") {
          location.href = "users.php";
          errorTxt.style.display = "none";
        } else {
          errorTxt.textContent = data;
          errorTxt.style.display = "block";
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
