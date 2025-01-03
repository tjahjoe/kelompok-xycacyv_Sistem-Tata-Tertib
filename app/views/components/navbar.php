<?php
require_once __DIR__ . "../../../controllers/getData.php";
require_once __DIR__ . "../../../controllers/utils/check.php";

function Navbar($isOtherPage)
{
    $data = dataUser();
?>
    <header>
        <nav class="navbar <?php echo $isOtherPage ? "navbar-other" : "" ?>" id="navbar">

            <?php if ($data && in_array($data['role'], ['dosen', 'dpa', 'kps', 'sekjur', 'admin'])) { ?>
                <div class="hamburger" id="hamburger">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            <?php } ?>

            <a href="./" class="logo">
                <img
                    src="../assets/images/logo-sitatib.png"
                    width="50px"
                    alt="" />
                <p>SiTatib</p>
            </a>

            <?php if ($data && in_array(trim($data['role']), ['dosen', 'dpa', 'kps', 'sekjur', 'admin'])) { ?>
                <div class="menu" id="menu">
                    <a href="./">Beranda</a>
                    <a href="./pelaporan.php">Pelaporan</a>
                    <?php if ($data['role'] !== 'dosen') { ?>
                        <a href="./daftar-pelaporan.php?page=1">Daftar Pelaporan</a>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if (isLogin()) { ?>
                <a href="profile-user.php" class="profile" id="profile">
                    <?php $photoProfile =  $data['foto_diri'] ? '../assets/uploads/photo/' . $data['foto_diri'] : "../assets/images/foto.webp"; ?>
                    <img
                        class="img-profile"
                        src="<?php echo $photoProfile ?>"
                        alt=""
                        width="50px" />
                    <span class="profile-text capitalize-text">
                        <p class="profile-username"><?php echo $data['nama'] ?></p>
                        <p class="role-user"><?php echo $data['role'] ?></p>
                    </span>
                </a>
            <?php } else { ?>
                <a href="login.php" class="btn btn-white">
                    Login
                </a>
            <?php } ?>
        </nav>
    </header>
<?php
}
?>