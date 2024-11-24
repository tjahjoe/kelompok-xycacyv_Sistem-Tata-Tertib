<?php
// require_once __DIR__ . "/generatorPdf.php";
// echo shell_exec("soffice --version");

// pdfGenerator();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="generatorPdf.php"  method="post" id="upload-form">
        <label for="nim">nama</label>
        <input type="text" name="nama" id="nim">
        <br>
        <label for="tingkat">tingkat</label>
        <input type="text" name="nim" id="tingkat">
        <input type="submit" value="submit">
    </form>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#upload-form').submit(function(e) {
            e.preventDefault(); // Prevent form submission
            var formData = new FormData(this); // Create FormData object from the form
            alert("a")
            $.ajax({
                type: 'POST',
                url: 'uploadData.php', // URL to handle the upload
                data: formData, // The form data
                processData: false, // Prevent jQuery from automatically processing data
                contentType: false, // Do not set the content type header, let the browser set it
                success: function(response) {
                    alert('Upload successful: ' + response);
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });
        })
    </script> -->

</body>

</html>