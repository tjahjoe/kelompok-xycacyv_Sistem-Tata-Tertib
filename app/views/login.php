<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Sitatib</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="container">
    <div class="box">
      <div class="bg-img"></div>
      <div class="box-contain">
        <div class="form-contain">
          <div class="logo">
            <img
              src="../assets/images/logo-sitatib.png"
              width="50px"
              alt="logo polinema" />
            <p>SiTatib</p>
          </div>
          <h2>Login Anggota</h2>
          <div id="hasil" style="color: red; display:none"></div>
          <div class="info-box">
            <h4>Informasi</h3>
            <ul>
              <li>Bagi Mahasiswa: Gunakan akun siakad</li>
              <li>Bagi DPA/Admin: Gunakan akun portal polinema</li>
            </ul>
          </div>
          <form method="post" class="login-form" id="formLogin">
            <label for="idAnggota">ID Anggota</label>
            <input
              type="text"
              id="idAnggota"
              name="idAnggota"
              placeholder="Isikan NIM atau akun Portal Polinema" required/>

            <label for="password">Password</label>
            <div class="password-wrapper">
              <input
                type="password"
                name="password"
                id="password"
                placeholder="Isikan password" required/>
              <span class="toggle-password"><i class="toggle-password-icon fa-solid fa-eye fa-lg"></i></span>
            </div>

            <button type="submit" class="login-button">LOGIN</button>
          </form>
        </div>
        <div class="back-home">
          <a href="./">Kembali ke Beranda</a>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/handleAuth.js"></script>
  <script src="https://kit.fontawesome.com/6a1f5752a8.js" crossorigin="anonymous"></script>
</body>

</html>