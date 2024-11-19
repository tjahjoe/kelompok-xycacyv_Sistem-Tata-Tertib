$(document).ready(function () {
    $("#tingkatPelanggaran").on("change", function () {
        var tingkatPelanggaran = $(this).val();

        $.ajax({
            url: "../app/controllers/FilterTataTertib.php",
            type: "POST",
            data: { tingkatPelanggaran: tingkatPelanggaran },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("#tataTertib tbody").empty();
                    $.each(response.data, function (index, record) {
                        var row = "<tr>" +
                            "<td>" + (index + 1) + "</td>" +
                            "<td>" + record.nama_jenis_pelanggaran + "</td>" +
                            "<td>" + record.tingkat_pelanggaran + "</td>" +
                            "</tr>";
                        $("#tataTertib tbody").append(row);
                    });
                } else {
                    $("#tataTertib tbody").html("<tr><td colspan='3'>" + response.message + "</td></tr>");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });

    function filterPelaporan(){
        let searchNim = $("#searchNim").val();
        let tingkat = $("#tingkatPelaporan").val();
        let status = $("#statusPelaporan").val();
        let startTanggal = $("#startTanggalPelaporan").val();
        let endTanggal = $("#endTanggalPelaporan").val();
        
        $.ajax({
            url: "../app/controllers/FilterDaftarPelaporan.php",
            type: "POST",
            data: { 
                searchNim: searchNim,
                tingkatPelaporan: tingkat,
                statusPelaporan: status,
                startTanggalPelaporan: startTanggal,
                endTanggalPelaporan: endTanggal
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $(".table-content tbody").empty();
                    $.each(response.data, function (index, record) {
                        var row = "<tr>" +
                            "<td>" + record.nim + "</td>" +
                            "<td>" + record.nama + "</td>" +
                            "<td>" + record.tanggal + "</td>" +
                            "<td>" + record.judulmasalah + "</td>" +
                            "<td>" + record.tingkat + "</td>" +
                            "<td>" + record.status + "</td>" +
                            "</tr>";
                        $(".table-content tbody").append(row);
                    });
                } else {
                    $(".table-content tbody").html("<tr><td colspan='5'>" + response.message + "</td></tr>");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
                console.error("Response Text:", xhr.responseText);
                alert("An error occurred. Please check the console for details.");
            }
        });
    }

    $("#filterTab").submit(function (e) {
        e.preventDefault();
       filterPelaporan();
    });

    $('#tingkatPelaporan').on('change', function (e) {
        e.preventDefault();
        filterPelaporan();
    });

    $('#statusPelaporan').on('change', function (e) {
        e.preventDefault();
        filterPelaporan();
    });
    
    $('#startTanggalPelaporan').on('change', function (e) {
        e.preventDefault();
        let startDate = $(this).val();
        $("#endTanggalPelaporan").attr("min", startDate);
        filterPelaporan();
    });

    $('#endTanggalPelaporan').on('change', function (e) {
        e.preventDefault();
        let endDate = $(this).val();
        $("#startTanggalPelaporan").attr("max", endDate);
        filterPelaporan();  
    });

     // event reset filter
     $('.filter-item.reset-button').click(function(e) {
        e.preventDefault();
        $('#filterTab')[0].reset();
        filterPelaporan();
      });

});
