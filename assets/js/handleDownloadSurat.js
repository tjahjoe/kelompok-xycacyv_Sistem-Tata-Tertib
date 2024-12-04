$(document).ready(function () {
  $('#download-surat-peringatan').on('click', function (e) {
      e.preventDefault();
      
      let nama = $(".profile-username").text();
      let nim = $(".NIM.Pelanggar").text();
      let tanggal =  $(".Tanggal.Pelanggaran").text();

      let formData = new FormData();
      formData.append('nama', nama);
      formData.append('nim', nim);
      formData.append('tanggal', tanggal);

      $.ajax({
          url: '../app/controllers/handlerPost.php?action=suratPeringatan',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          xhrFields: {
              responseType: 'blob'
          },
          success: function (blob) {
            let link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'surat_peringatan.docx'; 
            link.click();
          }
      });

  });
});