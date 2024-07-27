<?php
include_once 'Core/Database.php';
class EditorModel extends Database {
    private $db;
    private $editor_id, $editor_nama, $editor_email, $editor_jk, $editor_noTlp;
    function __construct() {
        $this->db = new Database();
    }
    function getId(){
        return $this->editor_id;
    }
    function getNama(){
        return $this->editor_nama;
    }
    function getEmail(){
        return $this->editor_email;
    }
    function getJk(){
        return $this->editor_jk;
    }
    function getNoTlp(){
        return $this->editor_noTlp;
    }
    function getJenis(){
        return $this->editor_jenis;
    }
    function setId($editor_id){
        $this->editor_id = $editor_id;
    }
    function setNama($editor_nama){
        $this->editor_nama = $editor_nama;
    }
    function setEmail($editor_email){
        $this->editor_email = $editor_email;
    }
    function setJk($editor_jk){
        $this->editor_jk = $editor_jk;
    }
    function setNoTlp($editor_noTlp){
        $this->editor_noTlp = $editor_noTlp;
    }

    function login($email, $password){
        $stat = false;
        $sql = "SELECT * FROM  where editor_email = ? AND editor_pass = md5(?)";
        $dataLogin = $this->db->execute($sql, [$email, $password]);
        if($dataLogin != null){
            $this->editor_id = $dataLogin[0]['editor_id'];
            $this->editor_nama = $dataLogin[0]['editor_nama'];
            $this->editor_email = $dataLogin[0]['editor_email'];
            $this->editor_jk = $dataLogin[0]['editor_jk'];
            $this->editor_noTlp = $dataLogin[0]['editor_noTlp'];
            $this->editor_jenis = $dataLogin[0]['editor_jenis'];
            $stat = true;
        }
        return $stat;
    }
    function getEmailFromDB($email){
        $stat = false;
        $sql = "SELECT * FROM  where editor_email = ?";
        $dataEmail = $this->db->execute($sql, [$email]);
        if($dataEmail == null){
            $stat = true;
        }
        return $stat;
    }
    function logout(){
        $this->editor_id = null;
        $this->editor_nama = null;
        $this->editor_email = null;
        $this->editor_jk = null;
        $this->editor_noTlp = null;
        $this->editor_jenis = null;
    }
    function getAllEditor(){
        $query = "SELECT * FROM editor";
        $data = $this->db->execute($query);
        return $data;
    }
    function tambahData($data) {
        $col = ['editor_nama', 'editor_email', 'editor_noTlp', 'editor_jk' , 'editor_pass'];

        $status = $this->db->insert('', $col, $data);
        
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
    function getAllEditorByStatus($status){
        $query = "SELECT * FROM editor WHERE editor_status_pengerjaan = '$status'";
        $data = $this->db->execute($query);
        return $data;
    }
    function getById($id){
        $sql = "SELECT * FROM editor where editor_id = ?";
        $data = $this->db->execute($sql, [$id]);
        return $data[0];
    }
}