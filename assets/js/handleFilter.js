$(document).ready(function () {
  // filter tatatertib by tingkat (home page)
  $("#tingkatPelanggaran").on("change", function () {
    let tingkatPelanggaran = $(this).val();

    $.ajax({
      url: "../app/controllers/handlerGet.php?action=filterListPelanggaranByTingkat",
      type: "GET",
      data: { tingkatPelanggaran: tingkatPelanggaran },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          $("#tataTertib tbody").empty();
          $.each(response.data, function (index, record) {
            const row = `
            <tr>
                <td>${index + 1}</td>
                <td>${record.nama_jenis_pelanggaran}</td>
                <td>${record.tingkat_pelanggaran}</td>
            </tr>
        `;
            $("#tataTertib tbody").append(row);
          });
        } else {
          $("#tataTertib tbody").html(
            "<tr><td colspan='3'>" + response.message + "</td></tr>"
          );
        }
      }
    });
  });

  // fungsi untuk filter daftar pelaporan
  function filterPelaporan() {
    let searchNim = $("#searchNim").val();
    let showAll = $("#showAll").is(":checked");
    let tingkat = $("#tingkatPelaporan").val();
    let status = $("#statusPelaporan").val();
    let startTanggal = $("#startTanggalPelaporan").val();
    let endTanggal = $("#endTanggalPelaporan").val();

    $.ajax({
      url: "../app/controllers/handlerGet.php?action=filterDaftarPelaporan",
      type: "GET",
      data: {
        searchNim: searchNim,
        tingkatPelaporan: tingkat,
        statusPelaporan: status,
        startTanggalPelaporan: startTanggal,
        endTanggalPelaporan: endTanggal,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          if (showAll) {
            window.location.href = window.location.pathname;
          } else {
            window.location.href = "daftar-pelaporan.php?page=1";
          }
        } else {
          $(".table-content tbody").html(
            "<tr><td colspan='7'>Data Not Found</td></tr>"
          );
        }
      }
    });
  }

  // fungsi untuk reset filter
  function resetFilterPelaporan() {
    let searchNim = "";
    let tingkat = "";
    let showAll = $("#showAll").is(":checked");
    let status = "";
    let startTanggal = "";
    let endTanggal = "";

    $.ajax({
      url: "../app/controllers/handlerGet.php?action=filterDaftarPelaporan",
      type: "GET",
      data: {
        searchNim: searchNim,
        tingkatPelaporan: tingkat,
        statusPelaporan: status,
        startTanggalPelaporan: startTanggal,
        endTanggalPelaporan: endTanggal,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          if (showAll) {
            window.location.href = window.location.pathname;
          } else {
            window.location.href = "daftar-pelaporan.php?page=1";
          }
        } else {
          $(".table-content tbody").html(
            "<tr><td colspan='7'>Data Not Found</td></tr>"
          );
        }
      }
    });
  }

  // untuk mengaktifkan filter pada tingkatPelaporan, statusPelaporan dan searchByNIM
  $("#tingkatPelaporan, #statusPelaporan, #filterTab").on(
    "change submit",
    function (e) {
      e.preventDefault();
      filterPelaporan();
    }
  );

  // handle ketika check show all
  $("#showAll").change(function () {
    if ($(this).is(":checked")) {
      window.location.href = window.location.pathname;
      filterPelaporan();
    } else {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set("page", 1);
      window.location.search = urlParams.toString();
    }
  });

  // handle ketika filter by tanggal awal
  $("#startTanggalPelaporan").on("change", function (e) {
    e.preventDefault();
    let startDate = $(this).val();
    $("#endTanggalPelaporan").attr("min", startDate);
    filterPelaporan();
  });

  // handle ketika filter by tanggal akhir
  $("#endTanggalPelaporan").on("change", function (e) {
    e.preventDefault();
    let endDate = $(this).val();
    $("#startTanggalPelaporan").attr("max", endDate);
    filterPelaporan();
  });

  // event reset filter
  $(".filter-item.reset-button").click(function (e) {
    e.preventDefault();
    $("#filterTab")[0].reset();
    resetFilterPelaporan();
  });
});
