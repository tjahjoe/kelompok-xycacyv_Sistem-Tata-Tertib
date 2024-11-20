<?php include 'components/table.php';?>
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
    <div class="feature-tab">
      <!-- FILTER TAB -->
      <div class="filter-tab">
        <form id="filterTab">
          <div class="filter-container">
            <div class="filter-item">
              <img src="../assets/images/filter.svg" alt="Filter Icon">
            </div>
            <div class="filter-item search">
              <span>Search</span>
            </div>
            <div class="filter-item filter-checkbox">
              <input type="checkbox" id="showAll" name="showAll"/>
              <label for="showAll">Perlihatkan Semua</label>
            </div>
            <div class="filter-item filter-select">
              <div class="dropdown date-range-input">
                Date Range
              </div>
            </div>
            <div class="filter-item filter-select">
              <div class="dropdown">
                <select id="tingkatPelaporan" class="tingkatPelaporan" name="tingkatPelaporan">
                  <option disabled selected hidden>Tingkat</option>
                  <option value="">All</option>
                  <option value="I">I</option>
                  <option value="I/II">I/II</option>
                  <option value="II">II</option>
                  <option value="III">III</option>
                  <option value="IV">IV</option>
                  <option value="V">V</option>
                </select>
              </div>
            </div>
            <div class="filter-item filter-select">
              <div class="dropdown">
                <select id="statusPelaporan" class="statusPelaporan" name="statusPelaporan">
                  <option disabled selected hidden>Status</option>
                  <option value="">All</option>
                  <option value="baru">Pending</option>
                  <option value="aktif">Processing</option>
                  <option value="nonaktif">Completed</option>
                  <option value="reject">Rejected</option>
                </select>
              </div>
            </div>
            <div class="filter-item reset-button flex-row">
              <img src="../assets/images/reset.svg" width="20px" alt="">
              Reset Filter
            </div>
          </div>
      </div>
      <div class="date-input">
        <span class="flex-col">
          <label for="">Start Date</label>
          <input type="date" name="startTanggalPelaporan" id="startTanggalPelaporan" class="custom-date">
        </span>
        <span class="flex-col">
          <label for="">End Date</label>
          <input type="date" name="endTanggalPelaporan" id="endTanggalPelaporan" class="custom-date">
        </span>
      </div>
      <div class="search-input-container">
          <input type="text" class="search-text" placeholder="Tulis NIM yang ingin dicari..." name="searchNim" id="searchNim">
          <button class="btn btn-gray" type="submit"><img src="../assets/images/send.svg" alt=""></button>
      </div>
      </form>
    </div>
    <div class="box-content">
      <!-- daftar PELAPORAN -->
      <div class="tab-content active" id="daftar-pelaporan">
        <?php 
          require_once __DIR__ . "../../controllers/getData.php";
          $data = dataPelanggaran();
          TableContent($data, 'detail-pelaporan-admin'); 
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
  <script src="../assets/js/handleFilter.js"></script>
</body>

</html>