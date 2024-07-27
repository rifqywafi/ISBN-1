<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | Pengajuan ISBN 1</title>
   <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      rel="stylesheet"
    />
    <!-- Bootstrap icons-->
    <link
      href="icons/bootstrap-icons-1.11.3/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <!-- <link href="css/bootstrap.css" rel="stylesheet" /> -->
</head>
<body>
   <?php 
   $form = isset($_GET['page']) ? $_GET['page'] : "login";
   ?>
   <section class="vh-100 d-flex align-items-center justify-content-center">
  <div class="container-fluid h-custom ">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="img/pcr2.png"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-3 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="index.php?page=<?= $form == "login" ? "login" : "daftar" ?>&act=<?= $form == "login" ? "login" : "daftar" ?>">
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                <p class="lead fw-normal mb-3 me-3">Login Sebagai Pengaju Menggunakan</p>
                <a href="index.php?page=googleAuth" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating mx-1">
                  <i class="me-2 bi bi-google"></i>Google
                </a>  
            </div>   
            <?php 
            if($form == "login"){
               include 'login.php';
            }else if($form == "daftar"){
               include 'register.php';
            }
            ?> 
            <div class="text-center row text-lg-start mt-4 pt-2">
            <div id="text-switch" class="col-8 small fw-bold mt-2 pt-1 mb-0"><?= $form == "login" ? "Belum" : "Sudah" ?> Punya Akun? 
               <a id="switch-form" href="index.php?page=<?= $form == "login" ? "daftar" : "login" ?>">
               <?= $form == "login" ? "Daftar" : "Login" ?> Sekarang!
               </a>
            </div>
            <input type="submit" id="submit-form" data-mdb-button-init data-mdb-ripple-init class="col-4 btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;" value=<?= $form == "login" ? "Login" : "Daftar" ?>>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
<script>

</script>
</body>
</html>