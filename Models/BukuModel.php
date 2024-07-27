<?php
include 'Core/Database.php';

class BukuModel extends Database {
    private $db;
    private $buku_id, $buku_judul, $buku_tahun, $buku_penulis, $buku_status, $buku_dokumen;

    function __construct() {
        $this->db = new Database();
    }

    function getAllJoinDataByPengaju() {
        $query = "SELECT * FROM bukuJoin WHERE pengaju_id = '".$_SESSION['id']."'";
        $data = $this->db->execute($query);
        return $data;
    }
    function getAllJoinDataByStaf() {
        $query = "SELECT * FROM bukuJoin";
        $data = $this->db->execute($query);
        return $data;
    }

    function countBuku() {
        $query = "SELECT COUNT(buku_id) AS jumlah from buku";
        $data = $this->db->execute($query);
        return $data[0]["jumlah"];
    }

    function countBukuByMonth(){
        $tahun = date("Y");
        $query = "SELECT MONTH(buku_tanggal_pengajuan) AS bulan, COUNT(*) AS jumlah_buku FROM buku WHERE YEAR(buku_tanggal_pengajuan) = $tahun GROUP BY bulan ORDER BY bulan";
        $data = $this->db->execute($query);
        return $data;
    }

    function updateStatusBuku($data){
        // var_dump($data);
        $status = false;
        if($data['buku_status'] === "Sedang Diproses"){
            $query = "UPDATE buku SET buku_status = ?, editor_id = ?, staf_id = ? WHERE buku_id = ?";
            $this->db->execute($query, [$data['buku_status'], $data['editor_id'], $data['staf_id'], $data['buku_id']]);
            $status = true;
        }else if($data['buku_status'] === "Sedang Diajukan"){
            $query = "UPDATE buku SET buku_dokumen = ?, buku_status = ? WHERE buku_id = ?";
            $this->db->execute($query, [$data['buku_dokumen'], $data['buku_status'], $data['buku_id']]);
            $status = true;
        }else if($data['buku_status'] === "Selesai"){
            $query = "UPDATE buku SET buku_isbn = ?, buku_status = ? WHERE buku_id = ?";
            $this->db->execute($query, [$data['buku_isbn'], $data['buku_status'], $data['buku_id']]);
            $status = true;
        }else{
            $query = "UPDATE buku SET buku_status = ? WHERE buku_id = ?";
            $this->db->execute($query, [$data['buku_status'], $data['buku_id']]);
            $status = true;
        }
        return $status;
        
    }

    function hapusData($id) {
        $where = 'buku_id='.$id;
        $status = $this->db->delete('buku',$where);

        if ($status) {
            echo "<script>
                alert('Data Berhasil Dihapus!');
                window.location.href = 'index.php?page=buku&act=list';
                </script>";
        } else {
            echo "<script>
                alert('Data Gagal Dihapus!');
                </script>";
        }
    }

    function tambahData($data) {
        $col = ['pengaju_id', 'buku_judul', 'buku_tahun', "buku_penulis", "buku_dokumen", 'buku_status'];

        $status = $this->db->insert('buku', $col, $data);
        
        if (!$status) {
            echo "<script>
            alert('Data Berhasil Ditambahkan!');
            window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Ditambahkan!');
            window.location.href = 'index.php?page=buku&act=tambahData';
            </script>";
        }
    }

    function getById($id) {
        $query = "SELECT * FROM buku WHERE buku_id = ?";
        $data = $this->db->execute($query, [$id]);
        return $data;
    }

    function updateData($data) {
        $query = "UPDATE buku SET buku_judul = ?, buku_tahun = ?, buku_penulis = ?, buku_dokumen = ? WHERE buku_id = ?";
        $status = $this->db->execute($query, [$data['judul_buku'], $data['tahun_buku'], $data['penulis_buku'], $data['dokumen_buku'], $data['buku_id']]);
    
        if (!$status) {
            echo "<script>
                alert('Data Berhasil Diupdate!');
                window.location.href = 'index.php?page=buku&act=list';
                </script>";
        } else {
            echo "<script>
                alert('Data Gagal Diupdate!');
                </script>";
        }
    }

    function getJoinByStatus($status) {
        $query = "SELECT * FROM bukuJoin WHERE buku_status = '$status'";
        $data = $this->db->execute($query);
        return $data;
    }

    function getByStatus($status) {
        $query = "SELECT * from buku WHERE buku_status = '$status'";
        $data = $this->db->execute($query);
        return $data;
    }

    function getSelesaiWithPengajuId($id) {
        $query = "SELECT * from buku WHERE buku_status = 'Selesai' AND pengaju_id = '$id'";
        $data = $this->db->execute($query);
        return $data;
    }
}
