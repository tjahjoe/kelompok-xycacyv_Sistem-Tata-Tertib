// handle submit form pelaporan
$(document).ready(function () {
  const showAlert = () => {
    $(".overlay").addClass("alert-active");
  };

  const closeAlert = () => {
    $(".overlay").removeClass("alert-active");
    window.location.reload();
  };

  $("#form-pelaporan").submit(function (e) {
    e.preventDefault();

    // Mendapatkan data form
    var formData = new FormData(this);

    // Kirim data ke server PHP
    $.ajax({
      url: "../app/controllers/uploadData.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showAlert();
          if ($(".overlay").length && $(".alert-close-button").length) {
            $(".overlay").on("click", closeAlert);
            $(".alert-close-button").on("click", closeAlert);
          }
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  });

  // handle update pelaporan
  $("#updatePelaporan").submit(function (e) {
    e.preventDefault();

    // Mendapatkan data form
    var formData = $(this).serialize();

    // Kirim data ke server PHP
    $.ajax({
      url: "../app/controllers/uploadTingkat.php",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          window.location.reload();
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  });

  // generate sanksi by tingkat pelanggaran
  $("#tingkatPelanggaranAdmin").on("change", function () {
    let tingkatPelanggaran = $(this).val();

    $.ajax({
      url: "../app/controllers/getSanksi.php",
      type: "POST",
      data: { tingkatPelanggaran: tingkatPelanggaran },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          $("#sanksi").val(response.data.sanksi);
        } else {
          $("#sanksi").val("Data tidak ditemukan");
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
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