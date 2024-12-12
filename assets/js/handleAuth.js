// handle submit form login
$(document).ready(function() {
  $("#formLogin").submit(function(e) {
      e.preventDefault();

      const formData = $(this).serialize();

      $.ajax({
          url: "../app/controllers/handlerPost.php?action=login",
          type: "POST",
          data: formData,
          dataType: "json",
          success: function(response) {
              if (response.status === 'success') {
                  window.location.href = './';
              } else {
                $("#hasil").css("display", "block");
                $("#hasil").html(response.message);
              }
          }
      });
  });
});