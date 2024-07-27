<main class="flex-shrink-0">
  <!-- Navigation-->
  <nav class="navbar border-2 border-bottom sticky-top navbar-expand-lg navbar-light bg-white py-3">
    <div class="container px-5">
      <a class="navbar-brand" href="index.php"><span class="fw-bolder text-primary">
          <img src="img/pcr2.png" width="400" height="50" alt="Politeknik Caltex Riau" srcset="" /></span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small d-flex align-items-center fw-bolder">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=buku&act=tambahData">Pengajuan Buku</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              List Buku
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="index.php?page=buku&act=list">Semua Buku</a>
              <a class="dropdown-item" href="index.php?page=buku&act=listTerbit">Buku Yang Sudah Terbit ISBN nya</a>
            </div>
          </li>
          <li class=" border-2 border-start ps-2 nav-item d-flex align-items-center">
            <?php if(isset($_SESSION['profil'])){ ?>
            <div class="profil">
              <img src="<?= $_SESSION['profil'] ?>" class="rounded-circle" height="50" width="50" alt="Profil">
            </div>
            <?php } else{ ?>
            <i class="bi bi-person-circle" style="font-size: 50px;"></i>
            <?php } ?>
            <div class="fw-bolder ms-2"><?= $_SESSION['nama'] ?></div>
            <div class="btn-logout nav-link">
              <a class="btn btn-primary" href="index.php?page=auth&act=logout"><i class="bi bi-box-arrow-right"></i></a>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </nav>