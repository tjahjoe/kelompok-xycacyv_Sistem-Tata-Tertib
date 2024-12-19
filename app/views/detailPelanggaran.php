<?php
include 'components/alert.php';
include 'components/emptyState.php';
include 'components/detailSection.php';
require_once '../app/controllers/getData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Pelanggaran | SiTatib</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../assets/images/logo-sitatib.png" type="image/png">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php
    include 'components/navbar.php';
    Navbar(true);
    ?>

    <div class="container pt-5">
        <div class="flex-between">
            <div class="flex-col">
                <h1 class="title">Detail Pelanggaran</h1>
                <?php
                $data = detailPelanggaran($_GET['id']);
                if (!empty($data)) {
                    ?>
                    <p><strong>ID Pelanggaran:</strong> <?php echo $data['id']; ?></p>
                </div>
                <a href="profile-user.php#riwayat-pelanggaran" class="btn btn-gray">Kembali</a>
            </div>

            <?php if ($data['Status'] != 'reject') { ?>
                <div class="info-box">
                    <span style="font-weight: bold">Informasi</span>
                    <p>Untuk menebus sanksi atas pelanggaran, silakan hubungi admin untuk informasi lebih lanjut.</p>
                </div>
            <?php } ?>

            <?php
            DetailSection($data);
                } else {
                    echo "<p style='margin:20px;'>Data tidak ditemukan!</p>";
                }
                ?>

        <?php
        if (!empty($data['Tingkat Pelanggaran']) && in_array($data['Tingkat Pelanggaran'], ['III', 'IV', 'V'])) {
            if ($data['Status'] != 'reject') {
                ?>
                <div class="danger-box">
                    <label for="">Lampiran</label>
                    <p>
                        Untuk pelanggaran tingkat III hingga V, Anda dapat mengunduh
                        <a href="#" id="download-surat-peringatan" style="text-decoration: underline; color:var(--red-color);">
                            file template di sini.
                        </a>
                    </p>
                </div>
                <form id="uploadSuratPernyataan" class="flex-row-full m-0" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idPelanggaranMhs" value="<?php echo $data['id']; ?>" id="idPelanggaranMhs">
                    <label class="upload-section" for="lampiran">
                        <span class="upload-icon"><img src="../assets/images/upload-surat-icon.svg" width="30px" alt=""></span>
                        <p>Upload Surat Pernyataan</p>
                    </label>
                    <input type="file" name="suratPernyataan" id="lampiran" required hidden accept=".pdf">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
                <div class="list-file-uploaded">
                    <h4 id="file-count"></h4>
                    <ul id="file-list"></ul>
                </div>

                <?php
            }
        } ?>
    </div>

    <!-- ALERT SUCCESS UPLOAD SURAT -->
    <?php
     Alert('alert-success-icon.svg', 'Berhasil', 'Berhasil mengunggah surat pernyataan', false, 'alert-success-upload-surat');
    ?>

    <script src="../assets/js/handleSuratPernyataan.js"></script>
    <script src="../assets/js/handleDownloadSurat.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>