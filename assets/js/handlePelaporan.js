// handle submit form pelaporan
$(document).ready(function() {
  $("#form-pelaporan").submit(function(e) {
      e.preventDefault();

      // Mendapatkan data form
      var formData = $(this).serialize();

      // Kirim data ke server PHP
      $.ajax({
          url: "../app/controllers/uploadData.php",
          type: "POST",
          data: formData,
          dataType: "json",
          success: function(response) {
              if (response.status === 'success') {
                  // window.location.href = './'; // Redirect ke halaman utama
                  console.log(response.message)
              } else {
                $("#hasil").css("display", "block");
                  $("#hasil").html(response.message);
              }
          }
      });
  });

  // filter jenis pelanggaran by tingkat
  $("#tingkatPelanggaran").on("change", function () {
    let tingkatPelanggaran = $(this).val();

    $.ajax({
      url: "../app/controllers/FilterTataTertib.php",
      type: "POST",
      data: { tingkatPelanggaran: tingkatPelanggaran },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          
          $("#jenisPelanggaran").empty();
          $.each(response.data, function (index, record) {
            const row = `
            <option value="${record.nama_jenis_pelanggaran}">${record.nama_jenis_pelanggaran}</option>
        `;
            $("#jenisPelanggaran").append(row);
          });

        } else {
          $("#jenisPelanggaran").html(
            `<option>Data is not ${response.message}</option>`
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });
});