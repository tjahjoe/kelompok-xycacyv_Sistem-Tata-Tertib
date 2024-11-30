$(document).ready(function () {
    // Tambah Data
    $(document).on("submit", "#add-tatatertib", function (e) {
      e.preventDefault();
      const formData = $(this).serialize();
  
      $.ajax({
        url: "../app/controllers/uploadListPelanggaran.php",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            console.log("Tambah data berhasil");
            location.reload(); // Refresh halaman
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
  
      $.ajax({
        url: "../app/controllers/updateListPelanggaran.php",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            console.log("Update data berhasil");
            location.reload(); // Refresh halaman
          } else {
            $("#hasil").css("display", "block").html(response.message);
          }
        },
      });
    });
  
    // Ambil Data untuk Update
    $(".update-tatib").on("click", function (e) {
      e.preventDefault();
      const tatibId = $(this).data("id");

      $.ajax({
        url: "../app/controllers/getListPelanggaranById.php",
        type: "GET",
        data: { id: tatibId },
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            $("#namaPelanggaran").val(response.data.nama_jenis_pelanggaran);
            $("#tingkatPelanggaran").val(response.data.tingkat_pelanggaran);
            $("#add-tatatertib").attr("id", "update-tatatertib")
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
        console.log(tatibId)
  
        $.ajax({
          url: "../app/controllers/deleteListPelanggaran.php",
          type: "POST",
          data: { id: tatibId },
          dataType: "json",
          success: function (response) {
            if (response.status === "success") {
                location.reload();
            } else {
              $("#hasil").css("display", "block").html(response.message);
            }
          },
          error: function () {
            $("#hasil").css("display", "block").html("Terjadi kesalahan.");
          },
        });
      });

      $(".icon-tatib").on("click", function (e) {
        e.preventDefault();
    
        // Cari elemen ".detail-icon-tatib" dalam row yang sama
        const detailTatib = $(this).closest("tr").find(".detail-icon-tatib");
    
        // Tambahkan kelas "active" untuk menampilkan detail
        detailTatib.toggleClass("active");
      });
  });
  