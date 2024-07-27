        <!-- Sidebar -->
            <div id="sidebar" class=" flex-column p-3 bg-light border-2 border-end">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <span class="fs-4">Sistem Pengajuan ISBN</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">
                    <i class="bi bi-house me-2"></i>
                    Home
                    </a>
                </li> -->
                <li class>
                    <a href="index.php" class="nav-link <?= (!isset($_GET['page'])) ? "active" : "" ?>">
                    <i class="bi bi-graph-up me-2"></i>
                    Dashboard
                    </a>
                </li>
                <li>
                    <a href="index.php?page=listBuku" class="nav-link <?= (isset($_GET['page']) && $_GET['page'] === "listBuku") ? "active" : "" ?>">
                    <i class="bi bi-book me-2"></i>
                    Data Pengajuan ISBN
                    </a>
                </li>
                <li>
                    <a href="index.php?page=listEditor" class="nav-link <?= (isset($_GET['page']) && $_GET['page'] === "listEditor") ? "active" : "" ?>">
                    <i class="bi bi-person-lines-fill me-2"></i>
                    List Editor
                    </a>
                </li>
                </ul>
                <hr>
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-circle fs-3 me-2"></i><strong class=""><?= $_SESSION['nama']?></strong>
                    <div class="btn-logout ms-auto">
                        <a class="btn btn-primary" href="index.php?page=auth&act=logout"><i class="bi bi-box-arrow-right me"></i></a>
                    </div>
                </div>
            </div>
        <!-- End of Sidebar -->  


        