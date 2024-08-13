const userList = document.querySelector(".users .users-list"),
  searchBar = document.querySelector(".users .search input");

searchBar.onkeyup = () => {
  let searchTerm = searchBar.value;
  //AJAX
  if (searchTerm != "") {
    searchBar.classList.add("searchMode");
  } else {
    searchBar.classList.remove("searchMode");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "assets/php/search.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      let data = xhr.response;
      userList.innerHTML = data;
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
};

setInterval(() => {
  //AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "assets/php/users.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      let data = xhr.responseText;
      if (!searchBar.classList.contains("searchMode")) {
        userList.innerHTML = data;
      }
    }
  };
  xhr.send();
}, 1000);
