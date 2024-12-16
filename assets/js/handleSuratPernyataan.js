$(document).ready(function () {
  $("#uploadSuratPernyataan label").on("click", function () {
    $("#suratPernyataan").click();
  });

  $(document).on("submit", "#uploadSuratPernyataan", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=uploadSuratPernyataan",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showAlert("alert-success-add-tatib");
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
