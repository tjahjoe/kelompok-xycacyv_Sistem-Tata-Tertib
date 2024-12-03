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

  // Tambah Data
  $(document).on("submit", "#add-tatatertib", function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    const alertId = "alert-success-add-tatib";
    $.ajax({
      url: "../app/controllers/handlerPost.php?action=uploadListPelanggaran",
        type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // console.log(response)
        // console.log(response.status)
        // console.log(response.message)
        if (response.status === "success") {
          showAlert(alertId);
          closingAlertWithReload(true);
        } else {
          $("#hasil").css("display", "block").html(response.message);
        }
      },
    });
  });

  // Update Data
  $(document).on("submit", "#update-tatatertib", function (e) {
    e.preventDefault();
    const tatibId = $(this).data("id");
    let formData = $(this).serialize();
    if (tatibId) formData += "&idPelanggaran=" + tatibId;

    const alertId = "alert-success-update-tatib";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=updateListPelanggaran",
        type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showAlert(alertId);
          closingAlertWithReload(true);
          console.log('benar')
        } else {
          console.log('salah')
          $("#hasil").css("display", "block").html("hahaha");
        }
      },
    });
  });

  // Ambil Data untuk Update
  $(".update-tatib").on("click", function (e) {
    e.preventDefault();
    const tatibId = $(this).data("id");

    $.ajax({
      url: "../app/controllers/handlerGet.php?action=filterListPelanggaranById",
        type: "GET",
      data: { id: tatibId },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          $("#namaPelanggaran").val(response.data.nama_jenis_pelanggaran);
          $("#tingkatPelanggaran").val(response.data.tingkat_pelanggaran);
          $("#add-tatatertib").attr("id", "update-tatatertib");
          $("#update-tatatertib").attr("data-id", tatibId);
        } else {
          $("#hasil").css("display", "block").html(response.message);
        }
      },
      error: function () {
        $("#hasil").css("display", "block").html("Terjadi kesalahan.");
      },
    });
  });

  // delete data
  $(".delete-tatib").on("click", function (e) {
    e.preventDefault();
    const tatibId = $(this).data("id");

    const alertId = "alert-delete-tatib";
    showAlert(alertId);

    $(".alert-confirm-button").on("click", function () {
      $.ajax({
        url: "../app/controllers/handlerPost.php?action=deleteListPelanggaran",
        type: "POST",
        data: { id: tatibId },
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            closeAlert(alertId, true);
          } else {
            $("#hasil").css("display", "block").html(response.message);
          }
        },
        error: function () {
          $("#hasil").css("display", "block").html("Terjadi kesalahan.");
        },
      });
    });

    closingAlertWithReload(false);
  });

  $(".icon-tatib").on("click", function (e) {
    e.preventDefault();

    // Cari elemen ".detail-icon-tatib" dalam row yang sama
    const detailTatib = $(this).closest("tr").find(".detail-icon-tatib");

    // Tambahkan kelas "active" untuk menampilkan detail
    detailTatib.toggleClass("active");
  });
});
