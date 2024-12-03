<?php
include 'components/table.php';
include 'components/emptyState.php';
include 'components/navbar.php';
require_once __DIR__ . "../../controllers/getData.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Pelaporan | SiTatib</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="../assets/images/logo-sitatib.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <!-- DATA -->
  <?php
  $isShowAll = isset($_GET['page']) ? '' : 'checked';
  $filterTingkat = $_SESSION['filter']['tingkat'] ?? '';
  $filterStatus = $_SESSION['filter']['status'] ?? '';
  $filterTanggalAwal = $_SESSION['filter']['tanggalAwal'] ?? '';
  $filterTanggalAkhir = $_SESSION['filter']['tanggalAkhir'] ?? '';
  $searchByNIM = $_SESSION['filter']['nim'] ?? '';
  ?>

  <!-- NAVBAR -->
  <?php Navbar(true); ?>

  <div class="container pt-5">
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
              <input type="checkbox" id="showAll" name="showAll" <?php echo $isShowAll ?> />
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
                  <option value="I" <?php echo $filterTingkat == 'I' ? 'selected' : ''; ?>>I</option>
                  <option value="I/II" <?php echo $filterTingkat == 'I/II' ? 'selected' : ''; ?>>I/II</option>
                  <option value="II" <?php echo $filterTingkat == 'II' ? 'selected' : ''; ?>>II</option>
                  <option value="III" <?php echo $filterTingkat == 'III' ? 'selected' : ''; ?>>III</option>
                  <option value="IV" <?php echo $filterTingkat == 'IV' ? 'selected' : ''; ?>>IV</option>
                  <option value="V" <?php echo $filterTingkat == 'V' ? 'selected' : ''; ?>>V</option>
                </select>
              </div>
            </div>
            <div class="filter-item filter-select">
              <div class="dropdown">
                <select id="statusPelaporan" class="statusPelaporan" name="statusPelaporan">
                  <option disabled selected hidden>Status</option>
                  <option value="">All</option>
                  <option value="baru" <?php echo $filterStatus == 'baru' ? 'selected' : ''; ?>>Pending</option>
                  <option value="aktif" <?php echo $filterStatus == 'aktif' ? 'selected' : ''; ?>>Processing</option>
                  <option value="nonaktif" <?php echo $filterStatus == 'nonaktif' ? 'selected' : ''; ?>>Completed</option>
                  <option value="reject" <?php echo $filterStatus == 'reject' ? 'selected' : ''; ?>>Rejected</option>
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
          <input type="date" name="startTanggalPelaporan" id="startTanggalPelaporan" class="custom-date" value="<?php echo $filterTanggalAwal; ?>" max="<?php echo $filterTanggalAkhir; ?>">
        </span>
        <span class="flex-col">
          <label for="">End Date</label>
          <input type="date" name="endTanggalPelaporan" id="endTanggalPelaporan" class="custom-date" value="<?php echo $filterTanggalAkhir; ?>" min="<?php echo $filterTanggalAwal; ?>">
        </span>
      </div>
      <div class="search-input-container">
        <input type="text" class="search-text" placeholder="Tulis NIM yang ingin dicari..." name="searchNim" id="searchNim" value="<?php echo $searchByNIM ?>">
        <button class="btn btn-gray" type="submit"><img src="../assets/images/send.svg" alt=""></button>
      </div>
      </form>
    </div>
    <!-- daftar PELAPORAN -->
    <div class="table-container" id="daftar-pelaporan">
      <?php

      if (!isset($_SESSION['allData'])) {
        $_SESSION['allData'] = dataPelanggaranWithoutPagination();
      }

      $allData = $_SESSION['allData'];
      $page = 1;

      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $dataPerPage = dataPelanggaranPagination($page);
        TableContent($dataPerPage, 'detail-pelaporan-admin');
      } else {
        TableContent($allData, 'detail-pelaporan-admin');
      }

      $maxPage = $allData ? count($allData) / 10 : false;
      ?>
    </div>

    <?php if (isset($_GET['page'])) { ?>
      <div class="flex-between">
        <?php echo "<p>Showing $page of <span class='max-page'>" . ceil($maxPage) . " </span>Pages</p>"; ?>
        <div class="arrow-container">
          <button class="arrow left-arrow"><img src="../assets/images/arrow.svg" style="transform: rotate(90deg);" alt=""></button>
          <button class="arrow right-arrow" <?php echo $page == ceil($maxPage) ? "disabled" : "";?>>
          <img src="../assets/images/arrow.svg" style="transform: rotate(-90deg);" alt="">
        </button>
        </div>
      </div>
    <?php } ?>
  </div>
  </div>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/handleFilter.js"></script>
  <script>
    $(".search-input-container").hide();

    $(".filter-item.search").click(function() {
      $(".search-input-container").slideToggle(500);
      $(".date-input").removeClass("date-input-active");
    });

    $(".date-range-input").click(function() {
      $(".search-input-container").slideUp(500);
      $(".date-input").toggleClass("date-input-active");
    });

    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }

    function updatePageParam(newPage) {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set('page', newPage); 
      window.location.search = urlParams.toString();
    }

    $(".left-arrow").click(function() {
      const currentPage = parseInt(getQueryParam('page')) || 1;
      if (currentPage > 1) {
        updatePageParam(currentPage - 1);
      }
    });

    $(".right-arrow").click(function() {
      const currentPage = parseInt(getQueryParam('page')) || 1;
      updatePageParam(currentPage + 1);
    });
  </script>
</body>

</html>