<?php
require_once __DIR__ . "../../../controllers/getData.php";

function Navbar($isOtherPage) {
    $data = dataUser();
    // var_dump($data);
?>
    <header>
        <nav class="navbar <?php echo $isOtherPage ? "navbar-other": "" ?>" id="navbar">
            <!-- Hamburger Menu Icon -->
            <div class="hamburger" id="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="logo">
                <img
                    src="../assets/images/Logo_Politeknik_Negeri_Malang.png"
                    width="50px"
                    alt=""
                />
                <p>SiTatib</p>
            </div>
            <div class="menu" id="menu">
                <a href="./">Beranda</a>
                <a href="./pelaporan.php">Pelaporan</a>
                <a href="./daftar-pelaporan.php">Daftar Pelaporan</a>
            </div>
            <a href="profile-user.php" class="profile" id="profile">
                <img
                    class="img-profile"
                    src="https://i.pinimg.com/474x/aa/d3/d6/aad3d691d8d8592bb8dd240de636f6a9.jpg"
                    alt=""
                    width="50px"
                />
                <span class="profile-text">
                    <p class="profile-username"><?php echo $data['nama_admin']?></p>
                    <p class="role-user capitalize-text"><?php echo $data['role']?></p>
                </span>
            </a>
        </nav>
    </header>
<?php
}
?>
