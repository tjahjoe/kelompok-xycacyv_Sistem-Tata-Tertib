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
    <form action="uploadData.php" method="post" enctype="multipart/form-data">
        <label for="nim">label</label>
        <input type="text" name="nim" id="nim">
        <br>
        <label for="tingkat">tingkat</label>
        <input type="text" name="tingkat" id="tingkat">
        <br>
        <label for="jenis">jenis</label>
        <input type="text" name="jenis" id="jenis">
        <br>
        <label for="catatan">catatan</label>
        <input type="text" name="catatan" id="catatan">
        <br>
        <label for="tanggal">tanggal</label>
        <input type="date" name="tanggal" id="tanggal">
        <br>
        <input type="file" name="files[]" id="lampiran" accept="image/*" multiple>
        <input type="submit" name="submit" id="submit">
    </form>
</body>

</html>