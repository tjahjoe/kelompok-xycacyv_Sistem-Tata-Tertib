<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <form id="uploadForm">
        <label for="nama">nama</label>
        <input type="text" name="nama">
        <br>
        <br>
        <label for="nim">nim</label>
        <input type="text" name="nim">
        <input type="submit" value="Submit">
    </form>
    <div id="response"></div>

    <script>
        $(document).ready(function () {
            $('#uploadForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                // Create FormData object
                var formData = $(this).serialize()

                // Make AJAX request
                $.ajax({
                    url: 'handlerPost.php?action=suratPeringatan',
                    type: 'POST',
                    data: formData,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (blob) {
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = 'surat_pernyataan.docx';
                        link.click();
                    }
                });

            });
        });
    </script>
</body>

</html> -->

<?php
require_once __DIR__ . "/utils/setData.php";
//  $tanggal = date('m', strtotime("2024-12-02"));
//  var_dump($tanggal);

var_dump(setTimeWithMonthName(date("Y-m-d")));
?>