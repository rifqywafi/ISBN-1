<?php
include '../Core/Database.php';

class Mahasiswa_model extends Database {
    private $db;

    function __construct() {
        $this->db = new Database();
    }

    function getAllData() {
        $query = "SELECT * FROM Mahasiswa ORDER BY created DESC";
        $data = $this->db->execute($query);
        return $data;
    }

    function hapusData($id) {
        $where = 'nim='.$id;
        $status = $this->db->delete('mahasiswa',$where);

        if ($status) {
            echo "<script>
                alert('Data Berhasil Dihapus!');
                window.location.href = 'index.php?page=mahasiswa&menu=berandaMahasiswa';
                </script>";
        } else {
            echo "<script>
                alert('Data Gagal Dihapus!');
                </script>";
        }
    }

    function tambahData($data) {
        $col = ['nim', 'nama', 'prodi'];
        $status = $this->db->insert('mahasiswa', $col, $data);
        if (!$status) {
            echo "<script>
            alert('Data Berhasil Ditambahkan!');
            window.location.href = '../Views/index.php?page=mahasiswa&menu=berandaMahasiswa';
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Ditambahkan!');
            </script>";
        }
    }

    function editData($id) {
        $query = "SELECT * FROM Mahasiswa WHERE nim = ?";
        $data = $this->db->execute($query, [$id]);
        return $data;
    }
    

    function updateData($data) {
            $query = "UPDATE Mahasiswa SET nama = ?, prodi = ? WHERE nim = ?";
            $status = $this->db->execute($query, [$data['nama'], $data['prodi'], $data['nim']]);
    
        if (!$status) {
            echo "<script>
                alert('Data Berhasil Diupdate!');
                window.location.href = '../Views/index.php?page=mahasiswa&menu=berandaMahasiswa';
                </script>";
        } else {
            echo "<script>
                alert('Data Gagal Diupdate!');
                </script>";
        }
    }
}
