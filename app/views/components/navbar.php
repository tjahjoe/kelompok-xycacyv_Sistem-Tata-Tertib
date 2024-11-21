<?php
require_once __DIR__ . "../../../controllers/getData.php";
require_once __DIR__ . "../../../controllers/check.php";

function Navbar($isOtherPage) {
    $data = dataUser();
    // var_dump($data);
?>
    <header>
        <nav class="navbar <?php echo $isOtherPage ? "navbar-other": "" ?>" id="navbar">
            <!-- Hamburger Menu Icon -->
            <?php if($data && in_array($data['role'], ['dosen', 'dpa', 'kps', 'sekjur', 'admin'])){?>
            <div class="hamburger" id="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <?php }?>
                <a href="./" class="logo">
                    <img
                    src="../assets/images/Logo_Politeknik_Negeri_Malang.png"
                    width="50px"
                    alt=""
                />
                <p>SiTatib</p>
            </a>
            
            <div class="menu" id="menu">
            <?php if($data && in_array(trim($data['role']), ['dosen', 'dpa', 'kps', 'sekjur', 'admin'])){?>
                <a href="./">Beranda</a>
                <a href="./pelaporan.php">Pelaporan</a>
                <?php if($data['role'] !== 'dosen'){ ?>
                <a href="./daftar-pelaporan.php">Daftar Pelaporan</a>
                <?php }?>
            <?php }?>
            </div>
            
            <?php if(isLogin()){?>
            <a href="profile-user.php" class="profile" id="profile">
                <?php $photoProfile =  $data['foto_diri'] ? '../assets/images/'.$data['foto_diri'] : "https://i.pinimg.com/474x/aa/d3/d6/aad3d691d8d8592bb8dd240de636f6a9.jpg";?>
                <img
                    class="img-profile"
                    src="<?php echo $photoProfile?>"
                    alt=""
                    width="50px"
                />
                <span class="profile-text">
                    <p class="profile-username"><?php echo $data['nama']?></p>
                    <p class="role-user capitalize-text"><?php echo $data['role']?></p>
                </span>
            </a>
            <?php }else{?>
                <a href="login.php" class="btn btn-white">
                    Login
                </a>
            <?php }?>
        </nav>
    </header>
<?php
}
?>
