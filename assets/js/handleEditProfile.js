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

  // handle change photo
  $("#change-photo").on("change", function (e) {
    e.preventDefault();

    const fileInput = document.getElementById("change-photo");
    const file = fileInput.files[0];

    if (!file) {
      $("#hasil").css("display", "block").html("Please select a file!");
      return;
    }

    const formData = new FormData();
    formData.append("photo", file);

    const alertId = "alert-success-update-photo";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=updatePhotoProfil",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showAlert(alertId);
          closingAlertWithReload(true);
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  });

  // handle delete photo
  $("#delete-photo").on("click", function (e) {
    e.preventDefault();

    const id = $("#id-user").val();

    const alertId = "alert-delete-photo";
    showAlert(alertId);

    console.log(id);

    $(".alert-confirm-button").on("click", function () {
      $.ajax({
        url: "../app/controllers/handlerPost.php?action=deletePhotoProfil",
        type: "POST",
        data: {id: id},
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            closeAlert(alertId, true);
          } else {
            $("#hasil").css("display", "block");
            $("#hasil").html(response.message);
          }
        },
      });
    });
  });

  // handle edit profile (inputan)
  $("#form-editprofile").submit(function (e) {
    e.preventDefault();

    $("input[name='nama']").val($.trim($("input[name='nama']").val()));
    $("input[name='notelp']").val($.trim($("input[name='notelp']").val()));

    const formData = $(this).serialize();

    const alertId = "alert-success-update-infoprofil";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=updateDataUser",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showAlert(alertId);
          closingAlertWithReload(true);
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  });

});
