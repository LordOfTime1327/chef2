let html = document.querySelector("html"),
  bgCover = document.querySelector(".cover-bg");

// BURGER MENU
let burger = document.querySelector(".header__burger"),
  menu = document.querySelector(".header-menu");
burger.addEventListener("click", function (e) {
  e.preventDefault;
  burger.classList.toggle("close");
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

// setTimeout(showSubscribePopup, 5000);
// showSubscribePopup();

let bgCoverSubscribe = document.querySelector(".bgCoverSubscribe");
if (bgCoverSubscribe)
  bgCoverSubscribe.addEventListener("click", closeSubscribePopup);
if (closeSubscribeBtn)
  closeSubscribeBtn.addEventListener("click", closeSubscribePopup);

function showSubscribePopup() {
  subscribePopup.classList.add("active");
  bgCoverSubscribe.classList.add("active");
  html.classList.add("stop-scrolling");
}

function closeSubscribePopup() {
  subscribePopup.classList.remove("active");
  bgCoverSubscribe.classList.remove("active");
  html.classList.remove("stop-scrolling");
}

// QUESTION POPUP
let qPopup = document.querySelector(".question-popup"),
  closeBtnQ = document.querySelector(".close-btn_question"),
  bgCoverQuestion = document.querySelector(".bgCoverQuestion");

// if (qPopup) setTimeout(showQPopup, 1000);

if (bgCoverQuestion) bgCoverQuestion.addEventListener("click", closeQePopup);
if (closeBtnQ) closeBtnQ.addEventListener("click", closeQePopup);

function showQPopup() {
  qPopup.classList.add("active");
  bgCoverQuestion.classList.add("active");
  html.classList.add("stop-scrolling");
}

function closeQePopup() {
  qPopup.classList.remove("active");
  bgCoverQuestion.classList.remove("active");
  html.classList.remove("stop-scrolling");
}

// SINGLE PRODUCT SLIDER
function initThumbs(direction) {
  return new Swiper(".product__slider-thumbs", {
    slidesPerView: 4,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    direction: direction,
  });
}

let prodThumbs =
  window.innerWidth < 992 ? initThumbs("horizontal") : initThumbs("vertical");

let prodSlider = new Swiper(".product__slider", {
  navigation: {
    nextEl: ".product__slider-arrow_next",
    prevEl: ".product__slider-arrow_prev",
  },

  thumbs: {
    swiper: prodThumbs,
  },

  effect: "flip",

  lazy: true,

  keyboard: {
    enabled: true,
  },

  pagination: {
    el: ".product__slider-pagination",
    clickable: true,
  },
});

// cart quantity
$(document).ready(function () {
  $(document).on("click", ".cart-form__quantity-btn_plus", function (e) {
    e.preventDefault();
    let inp = this.parentNode.children[1].children[1],
      count = +inp.value,
      max = inp.getAttribute("max");

    if (count == max) {
      return;
    } else {
      count += 1;
      inp.setAttribute("value", count);
    }

    $(".qty").trigger("change");
    $('button[name="update_cart"]').trigger("click");
  });
  $(document).on("click", ".cart-form__quantity-btn_minus", function (e) {
    e.preventDefault();
    let inp = this.parentNode.children[1].children[1],
      count = +inp.value,
      min = inp.getAttribute("min");

    if (count == min) {
      return;
    } else {
      count -= 1;
      inp.setAttribute("value", count);
    }

    $(".qty").trigger("change");
    $('button[name="update_cart"]').trigger("click");
  });
});

// single product quantity
$(document).ready(function () {
  $(document).on("click", ".product-form__quantity-btn_plus", function (e) {
    e.preventDefault();
    let inp = this.parentNode.children[1].children[1],
      count = +inp.value,
      max = inp.getAttribute("max");

    if (count == max) {
      return;
    } else {
      count += 1;
      inp.setAttribute("value", count);
    }

    $(".qty").trigger("change");
    $('button[name="update_cart"]').trigger("click");
  });
  $(document).on("click", ".product-form__quantity-btn_minus", function (e) {
    e.preventDefault();
    let inp = this.parentNode.children[1].children[1],
      count = +inp.value,
      min = inp.getAttribute("min");

    if (count == min) {
      return;
    } else {
      count -= 1;
      inp.setAttribute("value", count);
    }

    $(".qty").trigger("change");
    $('button[name="update_cart"]').trigger("click");
  });
});

//related slider single product page
let relatedSlider = new Swiper(".related__slider", {
  navigation: {
    nextEl: ".related__slider-arrow_next",
    prevEl: ".related__slider-arrow_prev",
  },
  allowTouchMove: true,

  breakpoints: {
    550: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    992: {
      slidesPerView: 4,
      navigation: false,
      allowTouchMove: false,
    },
  },
});

// homepage catalog slider single product page
function homeProdsFn() {
  if (document.body.classList.contains("home")) {
    let products = document.querySelector(".products"),
      productsContent = products.innerHTML;

    products.innerHTML = `<div class='catalog-home__slider swiper-container'>
                            <div class='swiper-wrapper'>
                              ${productsContent}
                            </div>
                            <div class='catalog-home__slider-arrow-box'>
                              <div class="swiper-button-prev catalog-home__slider-arrow catalog-home__slider-arrow_prev">
                                <svg width="16" height="24" viewBox="0 0 16 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M15 1L1 12.5L15 23" stroke="white"/>
                                </svg>
                              </div>
                              <div class="swiper-button-next catalog-home__slider-arrow catalog-home__slider-arrow_next">
                                <svg width="16" height="24" viewBox="0 0 16 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M15 1L1 12.5L15 23" stroke="white"/>
                                </svg>
                              </div>
                            </div>
                          </div>`;

    $(".products__card").wrap("<div class='swiper-slide'></div>");
  } else {
    return;
  }
}
homeProdsFn();
let homeCatalogSlider = new Swiper(".catalog-home__slider", {
  navigation: {
    nextEl: ".catalog-home__slider-arrow_next",
    prevEl: ".catalog-home__slider-arrow_prev",
  },
  // slidesPerView: 1,
  allowTouchMove: true,

  breakpoints: {
    550: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    992: {
      slidesPerView: 4,
      navigation: false,
      allowTouchMove: false,
    },
  },
});

// popup checkout
// let checkoutBtn = document.querySelector(".checkout-button"),
//   checkout = document.querySelector(".popup-checkout");
// if (checkoutBtn) {
//   checkoutBtn.addEventListener("click", checkoutFn);

//   bgCover.addEventListener("click", function () {
//     html.classList.remove("stop-scrolling");
//     bgCover.classList.remove("active");
//     checkout.classList.remove("active");
//   });
// }
// function checkoutFn(e) {
//   e.preventDefault();
//   bgCover.classList.add("active");
//   html.classList.add("stop-scrolling");
//   checkout.classList.add("active");
// }

let checkoutBtn = $(".checkout-button"),
  checkout = $(".popup-checkout");

if (checkoutBtn) {
  // checkoutBtn.on("click", checkoutFn);
  $(document).on("click", ".checkout-button", checkoutFn);
  $(".cover-bg").on("click", function () {
    $("html").removeClass("stop-scrolling");
    $(".cover-bg").removeClass("active");
    checkout.removeClass("active");
  });
  function checkoutFn(e) {
    e.preventDefault();
    $(".cover-bg").addClass("active");
    $("html").addClass("stop-scrolling");
    checkout.addClass("active");
  }
}

// insta
let insta = document.querySelector(".insta");
if (insta) {
  setTimeout(() => {
    let instaArrows = document.querySelectorAll(".sbi-owl-nav > div");
    for (let i = 0; i < instaArrows.length; i++) {
      instaArrows[
        i
      ].innerHTML = `<svg width="16" height="24" viewBox="0 0 16 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15 1L1 12.5L15 23" stroke="white"/>
                    </svg>`;
    }

    let instaLink = document.querySelector(".sbi_follow_btn a");
    instaLink.classList.add("btn");
    instaLink.children[0].remove();
  }, 100);
}

//single prod reviews
let allReviewsBtn = document.querySelector(".reviews__show-reviews"),
  leaveFeedbackBtn = document.querySelector(".reviews__leave-feedback"),
  allReviews = document.querySelector(".allReviews"),
  leaveFeedbackPopup = document.querySelector(".leaveFeedback"),
  allReviewsClose = document.querySelector(".allReviews__close"),
  leaveFeedbackClose = document.querySelector(".leaveFeedback__close");

if (allReviewsBtn) allReviewsBtn.addEventListener("click", showReviews);
if (leaveFeedbackBtn) leaveFeedbackBtn.addEventListener("click", leaveFeedback);
if (allReviewsClose) allReviewsClose.addEventListener("click", closeAllReviews);
if (bgCover) bgCover.addEventListener("click", closeAllReviews);
if (leaveFeedbackClose)
  leaveFeedbackClose.addEventListener("click", closeLeaveFeedback);
if (bgCover) bgCover.addEventListener("click", closeLeaveFeedback);

// bgCover.addEventListener("click", closeAllReviews);
// bgCover.addEventListener("click", closeLeaveFeedback);

function showReviews(e) {
  e.preventDefault();
  html.classList.add("stop-scrolling");
  allReviews.classList.add("active");
  bgCover.classList.add("active");
}
function closeAllReviews() {
  html.classList.remove("stop-scrolling");
  allReviews.classList.remove("active");
  bgCover.classList.remove("active");
}

function leaveFeedback(e) {
  e.preventDefault();
  html.classList.add("stop-scrolling");
  leaveFeedbackPopup.classList.add("active");
  bgCover.classList.add("active");
}
function closeLeaveFeedback() {
  html.classList.remove("stop-scrolling");
  leaveFeedbackPopup.classList.remove("active");
  bgCover.classList.remove("active");
}

let nameFeedback = document.querySelector(".comment-form-author input"),
  emailFeedback = document.querySelector(".comment-form-email input"),
  commentFeedback = document.querySelector(".comment-form-comment textarea"),
  submitFeedback = document.querySelector('.form-submit input[type="submit"]');

if (nameFeedback) nameFeedback.setAttribute("placeholder", "Name *");
if (emailFeedback) emailFeedback.setAttribute("placeholder", "Email *");
if (commentFeedback) commentFeedback.setAttribute("placeholder", "Comment");

if (nameFeedback) nameFeedback.classList.add("leaveFeedback__input");
if (emailFeedback) emailFeedback.classList.add("leaveFeedback__input");
if (commentFeedback)
  commentFeedback.classList.add(
    "leaveFeedback__input",
    "leaveFeedback__textarea"
  );
if (submitFeedback)
  submitFeedback.classList.add("popup-submit", "leaveFeedback__submit");

import "../js/autch";

//

$(document).on(
  "added_to_cart updated_cart_totals removed_from_cart",
  function (data) {
    $.ajax({
      url: wp.ajaxurl,
      type: "POST",
      data: { action: "cart_count" },
      success: function (response) {
        $(".header__cart-link span").html(response.data);
      },
    });
  }
);

// search
let searchIcon = document.querySelector(".header__search svg"),
  searchForm = document.querySelector(".search-form"),
  searchClose = document.querySelector(".search-form__close");

searchIcon.addEventListener("click", showSearchFrom);
searchClose.addEventListener("click", hideSearchFrom);

function showSearchFrom() {
  searchForm.classList.add("is-active");
}
function hideSearchFrom() {
  searchForm.classList.remove("is-active");
}

// phone validate
let tel = document.querySelector('input[type="tel"]');
// let tel = document.getElementById("tel");
if (tel) {
  function setInputFilter(textbox, inputFilter) {
    [
      "input",
      "keydown",
      "keyup",
      "mousedown",
      "mouseup",
      "select",
      "contextmenu",
      "drop",
    ].forEach(function (event) {
      textbox.addEventListener(event, function () {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    });
  }
  setInputFilter(tel, function (value) {
    return /^\d*$/.test(value);
  });
}
// function phoneValidation(ph) {
//   let regex = /^\d{10}$/;
//   if (ph.value.match(regex)) return 1;
//   else console.log("Nope!");
// }
// let test = document.querySelector(".wpcf7-tel");
// phoneValidation(test);

// cookies to close subscribe popup
$(document).ready(function () {
  if (!readCookie("hideSubscribe")) {
    showSubscribePopup();
  }

  $(".close-btn_subscribe").click(closeSubsc);
  $(".bgCoverSubscribe").click(closeSubsc);
});

function closeSubsc() {
  $("#subscribe-popup").hide();
  createCookie("hideSubscribe", true, 1);
  return false;
}

function createCookie(name, value, days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    var expires = "; expires=" + date.toGMTString();
  } else var expires = "";
  document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

// function eraseCookie(name) {
//   createCookie(name, "", -1);
// }

// cookies to close questions popup
$(document).ready(function () {
  if (!readCookie("hideQuestion")) {
    showQPopup();
  }

  $(".close-btn_question").click(closeQuestion);
  $(".bgCoverQuestion").click(closeQuestion);
});

function closeQuestion() {
  $("#question-popup").hide();
  createCookie("hideQuestion", true, 1);
  return false;
}

////////////////
import "../js/subscribe";

// lang switcher
let drop = document.querySelector(".wpm-languages a[aria-current] ");
let dropMenu = document.querySelector(".wpm-languages .sub-menu ");

drop.addEventListener("click", function (e) {
  e.preventDefault();

  dropMenu.classList.toggle("active");
  drop.classList.toggle("active");
});
