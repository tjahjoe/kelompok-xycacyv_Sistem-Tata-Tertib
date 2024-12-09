$(document).ready(function () {
  // fungsi untuk search by nim
  function searchUser() {
    let searchNim = $.trim($("#searchNim").val());

    $.ajax({
      url: "../app/controllers/handlerGet.php?action=filterUsers",
      type: "GET",
      data: {
        searchNim: searchNim,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          console.log(response.data);
          $(".table-content tbody").empty();
          $.each(response.data, function (index, record) {
            const row = `
              <tr>
                  <td>${index + 1}</td>
                  <td class="text-left normal-white-space">${record.ID}</td>
                  <td class="text-left max-text truncate capitalize-text">${
                    record.NAMA
                  }</td>
                  <td>${record.EMAIL}</td>
                  <td class="capitalize-text">${record.PEKERJAAN}</td>
                  <td>${record.TELEPON}</td>
                  <td class="capitalize-text">${record.STATUS}</td>
                  <td><a href="detail-user.php?id=${record.ID}&role=${
              record.PEKERJAAN
            }">Detail</a></td>
              </tr>
            `;
            $(".table-content tbody").append(row);
          });
        } else {
          $(".table-content tbody").html(
            "<tr><td colspan='8'>Data tidak ditemukan!</td></tr>"
          );
        }
      },
    });
  }

  // untuk mengaktifkan filter pada tingkatPelaporan, statusPelaporan dan searchByNIM
  $("#search-user-nim").on("submit", function (e) {
    e.preventDefault();
    searchUser();
  });

  $("#add-role").on("change", function (e) {
    e.preventDefault();
    let role = $(this).val();
  
    if (role === "mahasiswa") {
      if (!$("#namaOrtu").length) {
        $("#form-add-user .detail-container").append(`
          <div class="detail-item" id="namaOrtu-container">
            <label for="namaOrtu">Nama Orang Tua</label>
            <input type="text" name="namaOrtu" value="" id="namaOrtu" placeholder="Masukkan nama orang tua"/>
          </div>
          <div class="detail-item" id="notelpOrtu-container">
            <label for="notelpOrtu">Nomor Telepon Orang Tua</label>
            <input type="text" name="notelpOrtu" value="" id="notelpOrtu" placeholder="Masukkan nomor telepon"/>
          </div>
        `);
      }
  
      $("#select-dpa").show();
      $("#select-dpa select").prop("disabled", false);
    } else {
      $("#namaOrtu-container").remove();
      $("#notelpOrtu-container").remove();

      $("#select-dpa").hide();
      $("#select-dpa select").prop("disabled", true);
    }
  });
  
  $("#form-add-user").on("submit", function (e) {
    e.preventDefault();

    const formData = $(this).serialize();

    // const alertId = "alert-detail-pelaporan-success";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=uploadUser",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          window.location.href = "./profile-user.php";
          // console.log(response);
          // showAlert(alertId);
          // closingAlertWithReload(true);
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  })
  
  $("#form-edit-user").on("submit", function (e) {
    e.preventDefault();

    const formData = $(this).serialize();

    // const alertId = "alert-detail-pelaporan-success";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=updateUser",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          window.location.href = "./profile-user.php";
          console.log(response);
          // showAlert(alertId);
          // closingAlertWithReload(true);
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  })

  
});
