$(document).ready(function () {
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
      // url: "../app/controllers/updateFoto.php",
      url: "../app/controllers/handlerPost.php?action=updatePhotoProfil",
      type: "POST",
      data: formData,
      contentType: false, // Biarkan jQuery menetapkan header ini secara otomatis
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          window.location.href = "./profile-user.php"; // Redirect ke halaman utama
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  });

  $("#delete-photo").on("click", function (e) {
    e.preventDefault();
    $.ajax({
      // url: "../app/controllers/deleteFoto.php",
      url: "../app/controllers/handlerPost.php?action=deletePhotoProfil",
      type: "POST",
      contentType: false, // Biarkan jQuery menetapkan header ini secara otomatis
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          console.log('success');
          window.location.href = "./profile-user.php"; // Redirect ke halaman utama
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  });


  $("#form-editprofile").submit(function(e) {
    e.preventDefault();

    // Mendapatkan data form
    var formData = $(this).serialize();

    // Kirim data ke server PHP
    $.ajax({
        // url: "../app/controllers/updateDataProfile.php",
        url: "../app/controllers/handlerPost.php?action=updateDataUser",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function(response) {
            if (response.status === 'success') {
                window.location.href = './profile-user.php'; // Redirect ke halaman utama
            } else {
              $("#hasil").css("display", "block");
                $("#hasil").html(response.message);
            }
        }
    });
});
});
