const searchInput = document.querySelector(".users .search input"),
  searchBtn = document.querySelector(".users .search button"),
  usersList = document.querySelector(".users-list");

const searchUsers = (e) => {
  const data = new FormData();

  e.target.value != ""
    ? searchInput.classList.add("active")
    : searchInput.classList.remove("active");

  data.append("search", e.target.value);
  fetch("php/search.php", {
    method: "POST",
    header: {
      "Content-Type": "x-www-form-urlencoded",
    },
    body: data,
  })
    .then((data) => data.text())
    .then((res) => (usersList.innerHTML = res));
};

const getUsers = () => {
  fetch("php/users.php")
    .then((data) => data.text())
    .then((res) => {
      if (!searchInput.classList.contains("active")) {
        usersList.innerHTML = res;
      }
    });
};

setInterval(getUsers, 500);
// Event listener
searchBtn.addEventListener("click", (e) => {
  searchInput.classList.toggle("active");
  searchBtn.classList.toggle("active");
  searchInput.focus();
});

searchInput.addEventListener("keyup", searchUsers);
