const form = document.querySelector(".typing-area"),
  continueBtn = form.querySelector("button"),
  inputField = form.querySelector("#message"),
  chatBox = document.querySelector(".chat-box");
//
form.onsubmit = (e) => {
  e.preventDefault();
};
//
continueBtn.onclick = () => {
  //AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "assets/php/sendMessage.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = "";
        if (!chatBox.classList.contains("activeScroll")) {
          scrollToBottom();
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
//
setInterval(() => {
  //AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "assets/php/getMessage.php", true);
  xhr.onload = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        //console.log(data);
        if (!chatBox.classList.contains("activeScroll")) {
          scrollToBottom();
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);
//
function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
//
chatBox.onmouseenter = () => {
  chatBox.classList.add("activeScroll");
};
chatBox.onmouseleave = () => {
  chatBox.classList.remove("activeScroll");
};
