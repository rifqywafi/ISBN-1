<?php
include_once 'Core/Database.php';
class PengajuModel extends Database {
    private $db;
    private $pengaju_id, $pengaju_nama, $pengaju_email, $pengaju_jk, $pengaju_noTlp, $pengaju_jenis, $pengaju_profil;
    function __construct() {
        $this->db = new Database();
    }
    function getId(){
        return $this->pengaju_id;
    }
    function getNama(){
        return $this->pengaju_nama;
    }
    function getEmail(){
        return $this->pengaju_email;
    }
    function getJk(){
        return $this->pengaju_jk;
    }
    function getNoTlp(){
        return $this->pengaju_noTlp;
    }
    function getJenis(){
        return $this->pengaju_jenis;
    }
    function getProfil(){
        return $this->pengaju_profil;
    }
    function setId($pengaju_id){
        $this->pengaju_id = $pengaju_id;
    }
    function setNama($pengaju_nama){
        $this->pengaju_nama = $pengaju_nama;
    }
    function setEmail($pengaju_email){
        $this->pengaju_email = $pengaju_email;
    }
    function setJk($pengaju_jk){
        $this->pengaju_jk = $pengaju_jk;
    }
    function setNoTlp($pengaju_noTlp){
        $this->pengaju_noTlp = $pengaju_noTlp;
    }
    function setJenis($pengaju_jenis){
        $this->pengaju_jenis = $pengaju_jenis;
    }
    function setProfil($pengaju_profil){
        $this->pengaju_profil = $pengaju_profil;
    }
    function login($email, $password, $withGoogle){
        if($withGoogle){
            $sql = "SELECT * FROM pengaju where pengaju_email = ?";
            $dataLogin = $this->db->execute($sql, [$email]);
        }else{
            $sql = "SELECT * FROM pengaju where pengaju_email = ? AND pengaju_pass = md5(?)";
            $dataLogin = $this->db->execute($sql, [$email, $password]);
        }
        $stat = false;
       
        if($dataLogin != null){
            $this->pengaju_id = $dataLogin[0]['pengaju_id'];
            $this->pengaju_nama = $dataLogin[0]['pengaju_nama'];
            $this->pengaju_email = $dataLogin[0]['pengaju_email'];
            $this->pengaju_jk = $dataLogin[0]['pengaju_jk'];
            $this->pengaju_noTlp = $dataLogin[0]['pengaju_noTlp'];
            $this->pengaju_jenis = $dataLogin[0]['pengaju_jenis'];
            $this->pengaju_profil = $dataLogin[0]['pengaju_foto_profil'];
            $stat = true;
        }
        return $stat;
    }
    function getEmailFromDB($email){
        $stat = false;
        $sql = "SELECT * FROM pengaju where pengaju_email = ?";
        $dataEmail = $this->db->execute($sql, [$email]);
        if($dataEmail == null){
            $stat = true;
        }
        return $stat;
    }
    function logout(){
        $this->pengaju_id = null;
        $this->pengaju_nama = null;
        $this->pengaju_email = null;
        $this->pengaju_jk = null;
        $this->pengaju_noTlp = null;
        $this->pengaju_jenis = null;
    }
    function tambahData($data, $withGoogle) {
        if($withGoogle){
            $col = ['pengaju_nama', 'pengaju_email', 'pengaju_jk', 'pengaju_foto_profil', 'pengaju_jenis'];
        }else{
            $col = ['pengaju_nama', 'pengaju_email', 'pengaju_noTlp', 'pengaju_jk' , 'pengaju_pass', 'pengaju_jenis' ];
        }
        
        $status = $this->db->insert('pengaju', $col, $data);
        
        return $status;
    }
    function getById($id){
        $sql = "SELECT * FROM pengaju where pengaju_id = ?";
        $data = $this->db->execute($sql, [$id]);
        return $data[0];
    }



}