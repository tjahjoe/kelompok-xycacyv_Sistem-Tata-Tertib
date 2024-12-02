$(document).ready(function () {
  const showAlert = (alertId) => {
    $(`#${alertId}`).addClass("alert-active");
  };

  const closeAlert = (alertId, reload = false) => {
    $(`#${alertId}`).removeClass("alert-active");
    if (reload) {
      window.location.reload();
    }
  };

  $(".alert-close-button, .overlay").on("click", function () {
    const alertId = $(this).data("alert-id");
    const overlayId = $(this).attr("id");

    if (overlayId) {
      closeAlert(overlayId, false);
    } else if (alertId) {
      closeAlert(alertId, false);
    }
  });

  $(".logout-btn").on("click", function () {
    const alertId = "alert-logout";
    showAlert(alertId);
    $(".alert-confirm-button").on("click", function () {
      $.ajax({
        url: "./../app/controllers/utils/logout.php",
        type: "POST"
      });
      window.location.href="./login.php"
    });
  });

});
