<?php
require_once __DIR__ . "/check.php";
$_SESSION['user']['id_users'] = '198912032017095008';
var_dump(isLogin());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="uploadData.php"  method="post" id="upload-form"  enctype="multipart/form-data">
        <label for="nim">label</label>
        <input type="text" name="nim" id="nim">
        <br>
        <label for="tingkat">tingkat</label>
        <input type="text" name="tingkat" id="tingkat">
        <br>
        <label for="jenis">jenis</label>
        <input type="text" name="jenisPelanggaran" id="jenis">
        <br>
        <label for="catatan">catatan</label>
        <input type="text" name="deskripsiLaporan" id="catatan">
        <br>
        <!-- <label for="tanggal">tanggal</label>
        <input type="date" name="tanggal" id="tanggal"> -->
        <br>
        <input type="file" name="lampiran[]" id="lampiran" max="20" accept="image/*" multiple>
        <input type="submit" name="submit" id="submit">
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </script>

</body>

</html>