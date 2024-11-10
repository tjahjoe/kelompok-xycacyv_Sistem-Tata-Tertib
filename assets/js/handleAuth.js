// handle submit form login
$(document).ready(function() {
  $("#formLogin").submit(function(e) {
      e.preventDefault();

      // Mendapatkan data form
      var formData = $(this).serialize();

      // Kirim data ke server PHP
      $.ajax({
          url: "../app/controllers/AuthLogin.php",
          type: "POST",
          data: formData,
          dataType: "json",
          success: function(response) {
              if (response.status === 'success') {
                  window.location.href = './'; // Redirect ke halaman utama
              } else {
                $("#hasil").style.display = 'block';
                  $("#hasil").html(response.message);
              }
          }
      });
  });
});