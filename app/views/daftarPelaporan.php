<?php include 'components/table.php'; ?>
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
              <input type="checkbox" id="showAll" name="showAll" />
              <label for="showAll">Perlihatkan Semua</label>
            </div>
            <div class="filter-item filter-select">
              <div class="dropdown date-range-input">
                Date Range
              </div>
            </div>
            <div class="filter-item filter-select">
              <div class="dropdown">
              <?php $filterTingkat = $_SESSION['filter']['tingkat'];
              ?>
                <select id="tingkatPelaporan" class="tingkatPelaporan" name="tingkatPelaporan">
                  <option disabled selected hidden>Tingkat</option>
                  <option value="" <?php echo $filterTingkat == '' ? 'selected' : ''; ?>>All</option>
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
              <?php $filterStatus = $_SESSION['filter']['status'];
              ?>
                <select id="statusPelaporan" class="statusPelaporan" name="statusPelaporan">
                  <option disabled selected hidden>Status</option>
                  <option value="" <?php echo $filterStatus == '' ? 'selected' : ''; ?>>All</option>
                  <option value="baru" <?php echo $filterStatus == 'baru' ? 'selected' : ''; ?>>Pending</option>
                  <option value="aktif" <?php echo $filterStatus == 'aktif' ? 'selected' : ''; ?>>Processing</option>
                  <option value="nonaktif" <?php echo $filterStatus == '' ? 'nonaktif' : ''; ?>>Completed</option>
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
          <input type="date" name="startTanggalPelaporan" id="startTanggalPelaporan" class="custom-date" value="<?php echo $_SESSION['filter']['tanggalAwal'] ?>">
        </span>
        <span class="flex-col">
          <label for="">End Date</label>
          <input type="date" name="endTanggalPelaporan" id="endTanggalPelaporan" class="custom-date" value="<?php echo $_SESSION['filter']['tanggalAkhir'] ?>">
        </span>
      </div>
      <div class="search-input-container">
        <input type="text" class="search-text" placeholder="Tulis NIM yang ingin dicari..." name="searchNim" id="searchNim" value="<?php echo $_SESSION['filter']['nim'] ?>">
        <button class="btn btn-gray" type="submit"><img src="../assets/images/send.svg" alt=""></button>
      </div>
      </form>
    </div>
    <div class="box-content">
      <!-- daftar PELAPORAN -->
      <div class="tab-content active" id="daftar-pelaporan">
        <?php
        require_once __DIR__ . "../../controllers/getData.php";
        $allData = dataPelanggaran();
        $page = 1;

        if(isset($_GET['page'])){
          $page = $_GET['page'];
          $dataPerPage = dataPelanggaranPagination($page);
          TableContent($dataPerPage, 'detail-pelaporan-admin');
        }else{
          TableContent($allData, 'detail-pelaporan-admin');
        }

        $maxPage = count($allData) / 10;
        ?>
      </div>
    </div>
    
    <?php if(isset($_GET['page'])){ ?>
    <div class="flex-between">
      <?php echo "<p>Showing $page of " . ceil($maxPage) . " Pages</p>"; ?>
      <div class="arrow-container">
        <button class="arrow left-arrow"><img src="../assets/images/arrow.svg" style="transform: rotate(90deg);" alt=""></button>
        <button class="arrow right-arrow"  <?php 
          echo $page == ceil($maxPage) ? "disabled" : "";
        ?>><img src="../assets/images/arrow.svg" style="transform: rotate(-90deg);" alt=""></button>
      </div>
    </div>
    <?php }?>
  </div>
  </div>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/handleFilter.js"></script>
  <script>
    // event untuk filter tab
    $(".search-input-container").hide();

    // event search dropdown
    $(".filter-item.search").click(function() {
      $(".search-input-container").slideToggle(500);
      $(".date-input").removeClass("date-input-active");
    });

    // event date range dropdown
    $(".date-range-input").click(function() {
      $(".search-input-container").slideUp(500);
      $(".date-input").toggleClass("date-input-active");
    });

    // pagination event
    // Fungsi untuk mendapatkan nilai parameter dari URL
    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }

    // Fungsi untuk mengupdate nilai parameter `page` di URL
    function updatePageParam(newPage) {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set('page', newPage); // Set parameter `page` dengan nilai baru
      window.location.search = urlParams.toString(); // Redirect ke URL baru
    }

    // Event handler untuk tombol kiri
    $(".left-arrow").click(function() {
      const currentPage = parseInt(getQueryParam('page')) || 1; // Ambil nilai `page`, default 1 jika tidak ada
      if (currentPage > 1) {
        updatePageParam(currentPage - 1); // Kurangi nilai `page`
      }
    });

    // Event handler untuk tombol kanan
    $(".right-arrow").click(function() {
      const currentPage = parseInt(getQueryParam('page')) || 1; // Ambil nilai `page`, default 1 jika tidak ada
      updatePageParam(currentPage + 1); // Tambahkan nilai `page`
      
    });
  </script>
</body>

</html>