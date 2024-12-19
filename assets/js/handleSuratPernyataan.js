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

  const closingAlertWithReload = (isReload) => {
    console.log("coba closing");
    $(".alert-close-button, .overlay").on("click", function () {
      const alertId = $(this).data("alert-id");
      const overlayId = $(this).attr("id");

      if (overlayId) {
        closeAlert(overlayId, isReload);
      } else if (alertId) {
        closeAlert(alertId, isReload);
      }
    });
  };

  $(document).on("submit", "#uploadSuratPernyataan", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    const alertId = "alert-success-upload-surat";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=uploadSuratPernyataan",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          console.log('berhasil');
          showAlert(alertId);
          closingAlertWithReload(true);
        } else {
          $("#error-tatib").css("display", "block").html(response.message);
        }
      },
      error: function (xhr, status, error) {
        $("#error-tatib")
          .css("display", "block")
          .html("Upload failed: " + error);
      },
    });
  });
});
