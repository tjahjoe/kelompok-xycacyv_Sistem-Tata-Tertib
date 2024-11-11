// filter list pelanggaran(daftar tatib) by tingkat
$(document).ready(function() {
  $("#tingkatPelanggaran").on('change', function() {
      var tingkatPelanggaran = $(this).val();

      $.ajax({
          url: "../app/controllers/FilterTataTertib.php",
          type: "POST",
          data: { tingkatPelanggaran: tingkatPelanggaran },
          dataType: "json",
          success: function(response) {
              if (response.status === 'success') {
                  // Clear the table body before adding new rows
                  $("#tataTertib tbody").empty();

                  // Loop through each record in the response data
                  $.each(response.data, function(index, record) {
                      var row = "<tr>" +
                                  "<td>" + (index + 1) + "</td>" + // Display row number
                                  "<td>" + record.nama_jenis_pelanggaran + "</td>" + // Display pelanggaran name
                                  "<td>" + record.tingkat_pelanggaran + "</td>" + // Display tingkat pelanggaran
                                "</tr>";
                      // Append the row to the table body
                      $("#tataTertib tbody").append(row);
                  });
              } else {
                  // If no data, show a message
                  $("#tataTertib tbody").html("<tr><td colspan='3'>" + response.message + "</td></tr>");
              }
          },
          error: function(xhr, status, error) {
              console.error("Error:", error);
          }
      });
  });
});
