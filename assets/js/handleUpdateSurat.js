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

  // untuk mengirimkan file template surat pernyataan
  $('#lampiran').on('change', function (e) {
    e.preventDefault();

    const file = this.files[0];

    if (file.size > 5 * 1024 * 1024) {
      alert('File terlalu besar! Maksimal ukuran file adalah 5MB.');
      this.value = '';
      return;
    }

    const formData = new FormData();
    formData.append('surat', file);

    const alertId = "alert-success-update-surat";

    $.ajax({
      url: '../app/controllers/handlerPost.php?action=updateSuratPeringatan',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showAlert(alertId);
          closingAlertWithReload(true);
        } else {
          $("#hasil").css("display", "block").html(response.message);
        }
      },
    });
  });
});
