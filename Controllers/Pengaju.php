<?php
include_once 'Controllers/Buku.php';

class Pengaju{
    var $bc;
    function __construct()
    {
        $this->bc = new Buku();
    }
    function viewListBuku()
    {
        $data = $this->bc->getAllBukuPengaju();
        require_once 'Views/header.php';
        require_once 'Views/navbar.php';
        require_once 'Views/Pengaju/list-buku.php';
        require_once 'Views/footer.php';
    }
    function viewLandingPagePengaju()
    {
       
        require_once "Views/header.php";
        require_once "Views/navbar.php";
        require_once "Views/Pengaju/landing-page.php";
        require_once "Views/footer.php";
    }
    function ViewTambahBukuPengaju()
    {
        require_once 'Views/header.php';
        require_once 'Views/navbar.php';
        require_once 'Views/Pengaju/form-pengajuanbuku.php';
        require_once 'Views/footer.php';
    }
    function ViewBukuSelesai()
    {
        $dataBukuSelesai = $this->bc->getSelesaiWithPengajuId();
        require_once 'Views/header.php';
        require_once 'Views/navbar.php';
        require_once 'Views/Pengaju/list-buku-selesai.php';
        require_once 'Views/footer.php';
    }
}
?>