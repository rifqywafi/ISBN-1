<?php
include_once 'Models/BukuModel.php';
include_once 'Models/StafModel.php';
include_once 'Models/PengajuModel.php';
include_once 'Models/EditorModel.php';


class Buku
{
    var $db, $dbS, $dbP, $dbE;

    function __construct()
    {
        $this->db = new BukuModel();
        $this->dbP = new PengajuModel();
        $this->dbS = new StafModel();
        $this->dbE = new EditorModel();
    }

    function getAllBukuPengaju()
    {
        $data = $this->db->getAllJoinDataByPengaju();
        return $data;
    }
    function getAllBukuStaf()
    {
        $data = $this->db->getAllJoinDataByStaf();
        return $data;
    }
    function getJumlahBuku(){
        $jumlahBuku = $this->db->countBuku();
        return $jumlahBuku;
    }
    function getMonthName($monthNumber) {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        return $months[$monthNumber];
    }
    function getJumlahBukuByMonth(){
        $jumlahBukuByMonth = $this->db->countBukuByMonth();
        $jumlahBukuByMonthArray = array();
        foreach($jumlahBukuByMonth as $j){
            $jumlahBukuByMonthArray[$this->getMonthName($j["bulan"])] = $j["jumlah_buku"];
        }
        return $jumlahBukuByMonthArray;
    }
    function getStatusSelesai()
    {
        $dataBukuSelesai = $this->db->getByStatus("Selesai");
        return $dataBukuSelesai;
    }
    function getStatusMenungguDiproses()
    {
        $dataBukuMenungguDiproses = $this->db->getByStatus("Menunggu Diproses");
        return $dataBukuMenungguDiproses;
    }
    function getStatusSedangDiproses()
    {
        $dataBukuSedangDiproses = $this->db->getByStatus("Sedang Diproses");
        return $dataBukuSedangDiproses;
    }
    function getStatusSedangDiajukan()
    {
        $dataBukuSedangDiajukan = $this->db->getByStatus("Sedang Diajukan");
        return $dataBukuSedangDiajukan;
    }
    function getStatusDitolak()
    {
        $dataBukuDitolak = $this->db->getByStatus("Ditolak");
        return $dataBukuDitolak;
    }


    function tambahData()
    {
        $filename = $_FILES['dokumen']['name'];
        $rand = rand();

        $newfilename = $rand . '_' . $filename;
        move_uploaded_file($_FILES['dokumen']['tmp_name'], 'database/document/' . $rand . '_' . $filename);

        // Upload file to local server 
        $data = [
            $_POST['pengaju_id'],
            $_POST['judul_buku'],
            $_POST['tahun_buku'],
            $_POST['penulis_buku'],
            $newfilename,
            "Menunggu Diproses"
        ];
        $this->db->tambahData($data);
    }


    function hapus()
    {
        $id = $_GET['buku_id'];
        $this->db->hapusData($id);
    }

    function previewBuku($data)
    {
        $file = "database/document/" . $data;
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        header('Accept-Ranges: bytes');
        @readfile($file);
    }
    function updateStatus($status, $mail){
        $statUpdate = false;
        $dataBuku = [];  
        if(isset($_POST['buku_id'])){
            $dataBuku = $this->db->getById($_POST['buku_id'])[0];
        }else if(isset($_GET['id'])){
            $dataBuku = $this->db->getById($_GET['id'])[0];
        }
        $pengaju_id = $dataBuku['pengaju_id'];
        $dataPengaju = $this->dbP->getById($pengaju_id);

        if($status === "Sedang Diproses"){
            // var_dump($_POST['buku_id']);
            $data = [
                'buku_id' => $_POST['buku_id'],
                'editor_id' => $_POST['editor_id'],
                'staf_id' => $_SESSION['id'],
                'buku_status' => $status
            ];
            $this->db->updateStatusBuku($data);
            $dataStaf = $this->dbS->getById($data['staf_id']);
            $dataEditor = $this->dbE->getById($data['editor_id']);
            $statUpdate = true;
        }else if($status === "Ditolak"){
            $data = [
                'buku_id' => $_GET['id'],
                'buku_status' => $status
            ];
            $this->db->updateStatusBuku($data);
            $dataStaf = $this->dbS->getById($_SESSION['id']);
            $dataEditor = [
                'nama' => "Belum Diproses",
                'email' => "Belum Diproses"
            ];
            $statUpdate = true;
        }else{
            $dataStaf = $this->dbS->getById($dataBuku['staf_id']);
            $dataEditor = $this->dbE->getById($dataBuku['editor_id']);
            if($status === "Sedang Diajukan"){
                // var_dump($_POST['buku_id']);
                $filename = $_FILES['dokumen_new']['name'];
                $rand = rand();
                $newfilename = $rand . '_' . $filename;
                if(unlink("database/document/".$_POST['old-dokumen'])){
                    move_uploaded_file($_FILES['dokumen_new']['tmp_name'], 'database/document/' . $rand . '_' . $filename);
                }else{
                    echo 'alert("Terjadi Kesalahan!")';
                }
                $data = [
                    'buku_id' => $_POST['buku_id'],
                    'buku_dokumen' => $newfilename,
                    'buku_status' => $status
                ];
                $this->db->updateStatusBuku($data);
                $statUpdate = true;
            }else if($status === "Selesai"){
                $filename = $_FILES['buku_isbn']['name'];
                $rand = rand();
        
                $newfilename = $rand . '_' . $filename;
                move_uploaded_file($_FILES['buku_isbn']['tmp_name'], 'database/isbn/' . $rand . '_' . $filename);
                // var_dump($_POST['buku_id']);
                $data = [
                    'buku_id' => $_POST['buku_id'],
                    'buku_isbn' => $newfilename,
                    'buku_status' => $status
                ];
                $this->db->updateStatusBuku($data);
                $statUpdate = true;
            }
        }
        
        if(filter_var($dataPengaju['pengaju_email'], FILTER_VALIDATE_EMAIL)){
            $mail->addAddress($dataPengaju['pengaju_email']);
            $mail->Subject = "PENGAJUAN ISBN BUKU";
            $mail->Body = "Buku ".$dataBuku['buku_judul']." <b><i>".$status."</b></i>, oleh:
            <br>
            <br>
            <b>Staf</b>
            <br>
            Nama: ".$dataStaf['staf_nama']."
            <br>
            Email: ".$dataStaf['staf_email']."
            <br>
            <br>
            <b>Editor</b>
            <br>
            Nama: ".$dataEditor['editor_nama']."
            <br>
            Email: ".$dataEditor['editor_email']."
            ";
            $mail->send();
        }

        if($statUpdate){
            echo "<script>
                alert('Status Berhasil Diubah!');
                window.location.href = 'index.php?page=listBuku';
                </script>";
        }else {
            echo "<script>
                alert('Gagal Ubah Status!');
                window.location.href = 'index.php?page=listBuku';
                </script>";
        };
    }
    function updateData()
    {
        
        if($_FILES['dokumen_new']['name'] != null){
            $filename = $_FILES['dokumen_new']['name'];
            $rand = rand();
    
            $newfilename = $rand . '_' . $filename;
            move_uploaded_file($_FILES['dokumen_new']['tmp_name'], 'database/document/' . $rand . '_' . $filename);
        }else{
            $newfilename = $_POST['dokumen_old'];   
        }

        // Upload file to local server 
        $data = [
            'buku_id' => $_POST['buku_id'],
            'judul_buku' => $_POST['judul_buku'],
            'tahun_buku' => $_POST['tahun_buku'],
            'penulis_buku' => $_POST['penulis_buku'],
            'dokumen_buku' => $newfilename,
        ];
        var_dump($data);
        $this->db->updateData($data);
    }
    function getSelesaiWithPengajuId(){
        $data = $this->db->getSelesaiWithPengajuId($_SESSION['id']);
        return $data;
    }
}
