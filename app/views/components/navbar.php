<?php
function Navbar($isOtherPage) {
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
                    src="https://static.wikia.nocookie.net/logopedia/images/8/8a/Politeknik_Negeri_Malang.png"
                    width="50px"
                    alt=""
                />
                <p>SiTatib</p>
            </div>
            <div class="menu" id="menu">
                <a href="#beranda">Beranda</a>
                <a href="#pelaporan">Pelaporan</a>
                <a href="#riwayat">Riwayat</a>
            </div>
            <a href="profile-user.php" class="profile" id="profile">
                <img
                    class="img-profile"
                    src="https://i.pinimg.com/474x/aa/d3/d6/aad3d691d8d8592bb8dd240de636f6a9.jpg"
                    alt=""
                    width="50px"
                />
                <span href="#profile" class="profile-text">
                    <p class="profile-username">Ndak tau sopo</p>
                    <p class="role-user">Mahasiswa</p>
                </span>
            </a>
        </nav>
    </header>
<?php
}
?>
