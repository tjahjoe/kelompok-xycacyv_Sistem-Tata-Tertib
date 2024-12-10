$(document).ready(function () {
  const showAlert = (alertId) => {
    $(`#${alertId}`).addClass("alert-active");
  };

  const closeAlert = (alertId, reload = false, directLink) => {
    $(`#${alertId}`).removeClass("alert-active");
    if (reload) {
      window.location.reload();
    }else if(directLink){
      window.location.href = directLink;
    }
  };

  const closingAlertWithReload = (isReload, directLink) => {
    $(".alert-close-button, .overlay").on("click", function () {
      const alertId = $(this).data("alert-id");
      const overlayId = $(this).attr("id");

      if (overlayId) {
        closeAlert(overlayId, isReload, directLink);
      } else if (alertId) {
        closeAlert(alertId, isReload, directLink);
      }
    });
  };

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

  // untuk searchByNIM
  $("#search-user-nim").on("submit", function (e) {
    e.preventDefault();
    searchUser();
  });

  // handle ketika role mahasiswa akan menambah kolom baru
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
  
  // add new user
  $("#form-add-user").on("submit", function (e) {
    e.preventDefault();

    const formData = $(this).serialize();

    const alertId = "alert-success-add-user";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=uploadUser",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showAlert(alertId);
          closingAlertWithReload(false, "./profile-user.php#pengaturan-lanjutan");
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  })
  
  // edit detail user
  $("#form-edit-user").on("submit", function (e) {
    e.preventDefault();

    const formData = $(this).serialize();

    const alertId = "alert-success-update-user";

    $.ajax({
      url: "../app/controllers/handlerPost.php?action=updateUser",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showAlert(alertId);
          closingAlertWithReload(false, "./profile-user.php#pengaturan-lanjutan");
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
  })

  // delete photo user
  $("#delete-photo").on("click", function (e) {
    e.preventDefault();

    const id = $("#id-user").val();

    const alertId = "alert-delete-photo";
    showAlert(alertId);

    $(".alert-confirm-button").on("click", function () {
    $.ajax({
      url: "../app/controllers/handlerPost.php?action=deletePhotoProfil",
      type: "POST",
      data: {id: id},
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          closeAlert(alertId, true);
        } else {
          $("#hasil").css("display", "block");
          $("#hasil").html(response.message);
        }
      },
    });
    });
    closingAlertWithReload(false);
  })

  
});
