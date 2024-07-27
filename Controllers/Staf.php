<?php
include_once 'Controllers/Buku.php';
include_once 'Controllers/Editor.php';
class Staf{
    var $bc, $ec;
    function __construct()
    {
        $this->bc = new Buku();
        $this->ec = new Editor();
    }
    
    function viewDashboardStaf(){
        $jumlahBukuByMonthArray = $this->bc->getJumlahBukuByMonth();
        $jumlahBuku = $this->bc->getJumlahBuku();
        $dataBukuSelesai = $this->bc->getStatusSelesai();
        $dataBukuMenungguDiproses = $this->bc->getStatusMenungguDiproses();
        $dataBukuSedangDiproses = $this->bc->getStatusSedangDiproses();
        $dataBukuSedangDiajukan = $this->bc->getStatusSedangDiajukan();
        $dataBukuDitolak = $this->bc->getStatusDitolak();
        require_once 'Views/header-staf.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/Staf/dashboard.php';
        require_once 'Views/footer-staf.php';
    }

    function viewBuku(){
        $dataEditorTidakAda = $this->ec->getAllEditorByStatus("Tidak Ada");
        $data = $this->bc->getAllBukuStaf();
        require_once 'Views/header-staf.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/Staf/list-buku.php';
        require_once 'Views/footer-staf.php';
    }

    function viewEditor(){
        $data = $this->ec->getAllEditor();
        require_once 'Views/header-staf.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/Staf/list-editor.php';
        require_once 'Views/footer-staf.php';
    }
}
?>