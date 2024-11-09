<?php include 'components/emptyState.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Pelaporan</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php include 'components/navbar.php'; ?>
  <?php Navbar(true); ?>
  <div class="container bg-gray pt-5">
    <h1 class="title">Daftar Pelaporan</h1>
    <!-- FILTER TAB -->
    <div class="filter-tab">
      <div class="filter-container">
        <div class="filter-item">
          <img src="../assets/images/filter.svg" alt="Filter Icon">
        </div>
        <div class="filter-item search">
          <span>Search</span>
        </div>
        <div class="filter-item filter-checkbox">
          <input type="checkbox" id="showAll" />
          <label for="showAll">Perlihatkan Semua</label>
        </div>
        <div class="filter-item filter-select">
          <div class="dropdown">
            <select id="tanggal">
              <option>Tanggal</option>
              <option>Option 1</option>
              <option>Option 2</option>
            </select>
          </div>
        </div>
        <div class="filter-item filter-select">
          <div class="dropdown">
            <select id="tingkat">
              <option>Tingkat</option>
              <option>Option 1</option>
              <option>Option 2</option>
            </select>
          </div>
        </div>
        <div class="filter-item filter-select">
          <div class="dropdown">
            <select id="status">
              <option>Status</option>
              <option>Option 1</option>
              <option>Option 2</option>
            </select>
          </div>
        </div>
        <div class="filter-item reset-button" onclick="resetFilters()">
          Reset Filter
        </div>
      </div>
    </div>
    <div class="search-input-container">
      <input type="text" class="search-text" placeholder="Tulis NIM yang ingin dicari...">
    </div>
    <div class="box-content">
      <!-- RIWAYAT PELAPORAN -->
      <div class="tab-content active" id="riwayat-pelaporan">
        <?php include 'components/tableRiwayatPelaporan.php';
        ?>
      </div>
    </div>
    <div class="flex-between">
      <p>Showing 1-09 of 78</p>
      <div class="arrow-container">
        <button class="arrow left-arrow" disabled>&lt;</button>
        <button class="arrow right-arrow">&gt;</button>
      </div>
    </div>
  </div>
  </div>
  <script src="../assets/js/script.js"></script>
  <script>
    $(document).ready(function() {
      $(".search-input-container").hide();
      $(".filter-item.search").click(function() {
        $(".search-input-container").slideToggle("500");
      })
    })
  </script>
</body>

</html>