// send subscription form
const subscription_form = document.querySelector(".tnp-subscription form");
const formSubscribeMessage = document.querySelector(".form-subscribe-message");
const loader = document.querySelector(".your-loader");

if (subscription_form)
  subscription_form.addEventListener("submit", onSubmitForm);

async function onSubmitForm(e) {
  e.preventDefault();
  const fd = new FormData(e.currentTarget);
  fd.set("action", "ajax_subscription");

  subscription_form.classList.add("is-none");
  loader.classList.remove("is-none");
  try {
    await fetch(wp.ajaxurl, {
      method: "POST",
      body: fd,
    });
    loader.classList.add("is-none");

    formSubscribeMessage.textContent =
      "מזל טוב! נרשמת בהצלחה לניוזלטר. תוך 10 דקות תישלח הודעה למייל שלך.";
  } catch (error) {
    formSubscribeMessage.textContent =
      "טעות! ההרשמה נכשלה. צרו קשר עם בעל האתר.";
  }
}
