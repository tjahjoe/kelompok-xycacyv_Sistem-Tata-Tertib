<?php include 'components/navbar.php'; ?>
<?php include 'components/headerSection.php'; ?>
<?php include 'components/tataTertibSection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home Page</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php Navbar(false); ?>
  <?php HeaderSection("Bersama dan Bersatu Mewujudkan POLINEMA MAJU", "Lorem ipsum odor amet, consectetuer adipiscing elit. Habitasse mattis
      scelerisque nunc fermentum ornare viverra cras.", true); ?>
  <div class="container">
    <?php 
      $data = [
        [
            'id_list_pelanggaran' => 1,
            'nama_jenis_pelanggaran' => 'Tidak melakukan tindakan kriminal dan asusila termasuk membawa senjata tajam dan senapan, membawa atau menggunakan NAPZA, dan membawa barang-barang porno',
            'tingkat_pelanggaran' => 'IV'
        ],
        [
            'id_list_pelanggaran' => 2,
            'nama_jenis_pelanggaran' => 'Memakai pakaian yang rapi, bersepatu, atau bersepatu sandal',
            'tingkat_pelanggaran' => 'IV'
        ],
        [
            'id_list_pelanggaran' => 3,
            'nama_jenis_pelanggaran' => 'Setiap orang dalam melakukan aktivitas membutuhkan kenyamanan dan ketertiban. Begitu pula dengan aktivitas perkuliahan. Perkuliahan dapat berjalan dengan aman, tertib, dan lancar bila semua',
            'tingkat_pelanggaran' => 'IV'
        ],
        [
            'id_list_pelanggaran' => 4,
            'nama_jenis_pelanggaran' => 'Memakai pakaian yang rapi, bersepatu, atau bersepatu sandal',
            'tingkat_pelanggaran' => 'IV'
        ],
        [
            'id_list_pelanggaran' => 5,
            'nama_jenis_pelanggaran' => 'Memakai pakaian yang rapi, bersepatu, atau bersepatu sandal',
            'tingkat_pelanggaran' => 'IV'
        ],
        [
            'id_list_pelanggaran' => 6,
            'nama_jenis_pelanggaran' => 'Setiap orang dalam melakukan aktivitas membutuhkan kenyamanan dan ketertiban. Begitu pula dengan aktivitas perkuliahan. Perkuliahan dapat berjalan dengan aman, tertib, dan lancar bila semua',
            'tingkat_pelanggaran' => 'IV'
        ],
        [
            'id_list_pelanggaran' => 7,
            'nama_jenis_pelanggaran' => 'Tidak melakukan tindakan kriminal...',
            'tingkat_pelanggaran' => 'IV'
        ],
        [
            'id_list_pelanggaran' => 8,
            'nama_jenis_pelanggaran' => 'Setiap orang dalam melakukan aktivitas membutuhkan kenyamanan dan ketertiban. Begitu pula dengan aktivitas perkuliahan. Perkuliahan dapat berjalan dengan aman, tertib, dan lancar bila semua',
            'tingkat_pelanggaran' => 'IV'
        ],
        [
            'id_list_pelanggaran' => 9,
            'nama_jenis_pelanggaran' => 'Tidak melakukan tindakan kriminal...',
            'tingkat_pelanggaran' => 'IV'
        ],
    ];
    
    ?>
    <?php TataTertibSection($data)?>
    <?php include 'components/footerLaporSection.php'; ?>
  </div>
  <script src="../assets/js/script.js"></script>
</body>

</html>