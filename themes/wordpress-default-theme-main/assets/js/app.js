let html = document.querySelector("html");

// burger
let burger = document.querySelector(".header__burger"),
  menu = document.querySelector(".header-menu");
burger.addEventListener("click", function (e) {
  e.preventDefault;
  html.classList.toggle("stop-scrolling");
  menu.classList.toggle("active");
});
