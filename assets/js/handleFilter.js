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

    $("#filterTab").submit(function (e) {
        e.preventDefault();
        var searchNim = $("#searchNim").val();
        var tingkat = $("#tingkatPelaporan").val();
        var status = $("#statusPelaporan").val();
        var startTanggal = $("#startTanggalPelaporan").val();
        var endTanggal = $("#endTanggalPelaporan").val();

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
                            "<td>" + record.tgl_pelanggaran + "</td>" +
                            "<td>" + record.nama_jenis_pelanggaran + "</td>" +
                            "<td>" + record.catatan + "</td>" +
                            "<td>" + record.tingkat_pelanggaran + "</td>" +
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
    });

    $('#tingkatPelaporan').on('change', function (e) {
        e.preventDefault();
        var searchNim = $("#searchNim").val();
        var tingkat = $("#tingkatPelaporan").val();
        var status = $("#statusPelaporan").val();
        var startTanggal = $("#startTanggalPelaporan").val();
        var endTanggal = $("#endTanggalPelaporan").val();
        var tingkat = $("#tingkatPelaporan").val();
        
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
                            "<td>" + record.tgl_pelanggaran + "</td>" +
                            "<td>" + record.nama_jenis_pelanggaran + "</td>" +
                            "<td>" + record.catatan + "</td>" +
                            "<td>" + record.tingkat_pelanggaran + "</td>" +
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
    });
});
