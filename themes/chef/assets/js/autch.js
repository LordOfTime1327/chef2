jQuery(function ($) {
  /**
   * Autch Ajax
   */
  $(document).on("submit", "#autch_form_login", function (e) {
    var $this = $(this);

    $.ajax({
      type: "POST",
      url: ajax_account_object.ajaxurl,
      data: $this.serialize(),
      dataType: "json",
      beforeSend: function () {
        $this.block({
          message: null,
          overlayCSS: { background: "#fff", opacity: 0.6 },
        });
      },
      success: function (response) {
        console.log(response);

        if (response.data.loggedin == false) {
          $(".autch_form__message").html(response.data.message);
        }

        if (response.data.loggedin == true) {
          document.location.href = ajax_account_object.redirecturl;
        }
      },

      complete: function (data) {
        $this.unblock();
      },
    });

    e.preventDefault();
  });

  /**
   * Registration Ajax
   */
  $(document).on("submit", "#autch_form_registration", function (e) {
    var $this = $(this);

    $.ajax({
      type: "POST",
      url: ajax_account_object.ajaxurl,
      data: $this.serialize(),
      dataType: "json",
      beforeSend: function () {
        $this.block({
          message: null,
          overlayCSS: { background: "#fff", opacity: 0.6 },
        });
      },
      success: function (response) {
        if (response.data.loggedin == false) {
          $(".autch_form__message").html(response.data.message);
        }

        if (response.data.loggedin == true) {
          document.location.href = ajax_account_object.redirecturl;
        }
      },

      complete: function (data) {
        $this.unblock();
      },
    });

    e.preventDefault();
  });
});
