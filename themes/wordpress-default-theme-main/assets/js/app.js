let html = document.querySelector("html"),
  bgCover = document.querySelector(".cover-bg");

// BURGER MENU
let burger = document.querySelector(".header__burger"),
  menu = document.querySelector(".header-menu");
burger.addEventListener("click", function (e) {
  e.preventDefault;
  html.classList.toggle("stop-scrolling");
  menu.classList.toggle("active");
});

// FAQ PAGE
let qBx = document.querySelectorAll(".faq__question-box");
for (let i = 0; i < qBx.length; i++) {
  qBx[i].addEventListener("click", function (e) {
    e.preventDefault;
    if (!this.nextElementSibling.classList.contains("active")) {
      qBx.forEach((item) => {
        item.nextElementSibling.classList.remove("active");
        item.children[1].classList.remove("active");
      });
      this.children[1].classList.add("active");
      this.nextElementSibling.classList.add("active");
    } else {
      this.nextElementSibling.classList.remove("active");
      this.children[1].classList.remove("active");
    }
  });
}

// LOGIN POPUP
let signInBtn = document.querySelectorAll(".header__btn-sign-in"),
  login = document.querySelector(".login-popup"),
  loginCloseBtn = document.querySelector(".close-btn_login");

for (let i = 0; i < signInBtn.length; i++) {
  signInBtn[i].addEventListener("click", openLogin);
}

loginCloseBtn.addEventListener("click", closeLogin);
bgCover.addEventListener("click", closeLogin);

function openLogin(e) {
  e.preventDefault();
  login.classList.add("active");
  bgCover.classList.add("active");
  html.classList.add("stop-scrolling");
}
function closeLogin(e) {
  e.preventDefault();
  login.classList.remove("active");
  bgCover.classList.remove("active");
  html.classList.remove("stop-scrolling");
}

let loginEye = document.querySelector(".login-popup__eye"),
  passInput = document.querySelector('.login-popup__input[type="password"]');

// SIGN UP
let signUpBtn = document.querySelectorAll(".header__btn-sign-up"),
  signUp = document.querySelector(".register-popup"),
  signUpCloseBtn = document.querySelector(".close-btn_register");

for (let i = 0; i < signUpBtn.length; i++) {
  signUpBtn[i].addEventListener("click", openSignUp);
}
signUpCloseBtn.addEventListener("click", closeSignUp);
bgCover.addEventListener("click", closeSignUp);

function openSignUp(e) {
  e.preventDefault();
  signUp.classList.add("active");
  bgCover.classList.add("active");
  html.classList.add("stop-scrolling");
}
function closeSignUp(e) {
  e.preventDefault();
  signUp.classList.remove("active");
  bgCover.classList.remove("active");
  html.classList.remove("stop-scrolling");
}

let signUpEye = document.querySelectorAll(".register-popup__eye"),
  signUpPassInput = document.querySelectorAll(
    '.register-popup__input[type="password"]'
  );

// SHOW PASSWORD
["mousedown", "mouseup", "touchstart", "touchend"].forEach((event) => {
  loginEye.addEventListener(event, showPass, false);
});

["mousedown", "mouseup", "touchstart", "touchend"].forEach((event) => {
  for (let i = 0; i < signUpEye.length; i++) {
    signUpEye[i].addEventListener(event, showPass, false);
  }
});

function showPass(e) {
  e.preventDefault();
  if (this.parentNode.children[1]) {
    this.parentNode.children[1].type === "password"
      ? (this.parentNode.children[1].type = "text")
      : (this.parentNode.children[1].type = "password");
  }
}

// SUBSCRIBE POPUP
let subscribePopup = document.querySelector(".subscribe-popup");
let closeSubscribeBtn = document.querySelector(".close-btn_subscribe");

setTimeout(showSubscribePopup, 5000);

[("mousedown", "mouseup", "touchstart", "touchend")].forEach((event) => {
  closeSubscribeBtn.addEventListener(event, closeSubscribePopup, false);
});
[("mousedown", "mouseup", "touchstart", "touchend")].forEach((event) => {
  bgCover.addEventListener(event, closeSubscribePopup, false);
});

function showSubscribePopup() {
  subscribePopup.classList.add("active");
  bgCover.classList.add("active");
  html.classList.add("stop-scrolling");
}

function closeSubscribePopup() {
  subscribePopup.classList.remove("active");
  bgCover.classList.remove("active");
  html.classList.remove("stop-scrolling");
}
