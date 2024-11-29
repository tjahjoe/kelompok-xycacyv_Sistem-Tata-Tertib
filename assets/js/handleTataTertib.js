$(document).ready(function () {

  $("#add-tatatertib").submit(function(e) {
    e.preventDefault();

    // Mendapatkan data form
    var formData = $(this).serialize();

    // Kirim data ke server PHP
    $.ajax({
        url: "../app/controllers/uploadListPelanggaran.php",
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
})