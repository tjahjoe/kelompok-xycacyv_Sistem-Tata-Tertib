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
    console.log("coba closing");
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

  // handle submit form pelaporan (pelaporan page)
  $("#form-pelaporan").submit(function (e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);

    const nim = $.trim(formData.get("nim"));
    const deskripsiLaporan = $.trim(formData.get("deskripsiLaporan"));

    formData.set("nim", nim);
    formData.set("deskripsiLaporan", deskripsiLaporan);

    const alertId = "alert-pelaporan-success";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=uploadPelanggaran",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
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

  // handle update pelaporan
  $("#updatePelaporan").submit(function (e) {
    e.preventDefault();

    $("textarea[name='catatan']").val($.trim($("textarea[name='catatan']").val()));

    const formData = $(this).serialize();

    const alertId = "alert-detail-pelaporan-success";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=updatePelanggaran",
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

  // generate sanksi by tingkat pelanggaran (detail pelaporan admin)
  $("#tingkatSanksiAdmin").on("change", function () {
    let tingkatSanksi = $(this).val();

    $.ajax({
      url: "../app/controllers/handlerGet.php?action=filterSanksiByTingkat",
      type: "GET",
      data: { tingkatSanksi: tingkatSanksi },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          $("#sanksi").val(response.data.sanksi);
        } else {
          $("#sanksi").val("Data tidak ditemukan");
        }
      }
    });
  });

  // filter jenis pelanggaran by tingkat (pelaporan page)
  $("#tingkatPelanggaran").on("change", function () {
    let tingkatPelanggaran = $(this).val();

    $.ajax({
      url: "../app/controllers/handlerGet.php?action=filterListPelanggaranByTingkat",
      type: "GET",
      data: { tingkatPelanggaran: tingkatPelanggaran },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          $("#jenisPelanggaran").empty();
          $.each(response.data, function (_, record) {
            const row = `
              <option value="${record.nama_jenis_pelanggaran}">
                ${record.nama_jenis_pelanggaran}
              </option>
            `;
            $("#jenisPelanggaran").append(row);
          });
        } else {
          $("#jenisPelanggaran").html(
            `<option value='${response.message}'>${response.message}</option>`
          );
        }
      }
    });
  });
});
