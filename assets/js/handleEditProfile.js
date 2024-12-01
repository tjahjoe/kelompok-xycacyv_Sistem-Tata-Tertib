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

  $("#change-photo").on("change", function (e) {
    e.preventDefault();

    // Mendapatkan file yang dipilih
    const fileInput = document.getElementById("change-photo");
    const file = fileInput.files[0]; // Ambil file dari input

    // Periksa apakah ada file yang dipilih
    if (!file) {
      $("#hasil").css("display", "block").html("Please select a file!");
      return;
    }

    // Membuat objek FormData untuk mengirim data file
    const formData = new FormData();
    formData.append("photo", file);

    // Kirim data ke server PHP
    $.ajax({
      url: "../app/controllers/updateFoto.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          location.reload();
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  });

  $("#delete-photo").on("click", function (e) {
    e.preventDefault();

    const alertId = "alert-delete-photo";
    showAlert(alertId);
    
    $(".alert-confirm-button").on("click", function () {
      $.ajax({
        url: "../app/controllers/deleteFoto.php",
        type: "POST",
        contentType: false, // Biarkan jQuery menetapkan header ini secara otomatis
        processData: false,
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

  $("#form-editprofile").submit(function (e) {
    e.preventDefault();

    // Mendapatkan data form
    var formData = $(this).serialize();

    // Kirim data ke server PHP
    $.ajax({
      url: "../app/controllers/updateDataProfile.php",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          location.reload();
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  });
});
