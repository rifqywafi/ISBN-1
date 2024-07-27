<?php
include_once 'Core/Database.php';
class StafModel extends Database {
    private $db;
    private $staf_id, $staf_nama, $staf_email, $staf_jk, $staf_noTlp;
    function __construct() {
        $this->db = new Database();
    }
    function getId(){
        return $this->staf_id;
    }
    function getNama(){
        return $this->staf_nama;
    }
    function getEmail(){
        return $this->staf_email;
    }
    function getJk(){
        return $this->staf_jk;
    }
    function getNoTlp(){
        return $this->staf_noTlp;
    }
    function setId($staf_id){
        $this->staf_id = $staf_id;
    }
    function setNama($staf_nama){
        $this->staf_nama = $staf_nama;
    }
    function setEmail($staf_email){
        $this->staf_email = $staf_email;
    }
    function setJk($staf_jk){
        $this->staf_jk = $staf_jk;
    }
    function setNoTlp($staf_noTlp){
        $this->staf_noTlp = $staf_noTlp;
    }
    function login($email, $password){
        $stat = false;
        $sql = "SELECT * FROM staf where staf_email = ? AND staf_pass = md5(?)";
        // var_dump($sql);
        $dataLogin = $this->db->execute($sql, [$email, $password]);
        if($dataLogin != null){
            $this->staf_id = $dataLogin[0]['staf_id'];
            $this->staf_nama = $dataLogin[0]['staf_nama'];
            $this->staf_email = $dataLogin[0]['staf_email'];
            $this->staf_jk = $dataLogin[0]['staf_jk'];
            $this->staf_noTlp = $dataLogin[0]['staf_noTlp'];
            $stat = true;
        }
        return $stat;
    }
    function getEmailFromDB($email){
        $stat = false;
        $sql = "SELECT * FROM staf where staf_email = ?";
        $dataEmail = $this->db->execute($sql, [$email]);
        if($dataEmail == null){
            $stat = true;
        }
        return $stat;
    }
    function logout(){
        $this->staf_id = null;
        $this->staf_nama = null;
        $this->staf_email = null;
        $this->staf_jk = null;
        $this->staf_noTlp = null;
    }
    function getById($id){
        $sql = "SELECT * FROM staf where staf_id = ?";
        $data = $this->db->execute($sql, [$id]);
        return $data[0];
    }
    function tambahData($data) {
        $col = ['staf_nama', 'staf_email', 'staf_noTlp', 'staf_jk' , 'staf_pass'];

        $status = $this->db->insert('staf', $col, $data);
        
        if (!$status) {
            echo "<script>
            alert('Akun Berhasil Dibuat!');
            window.location.href = 'index.php?page=login';
            </script>";
        } else {
            echo "<script>
            alert('Akun Gagal Dibuat!');
            window.location.href = 'index.php?page=register';
            </script>";
        }
    }
}