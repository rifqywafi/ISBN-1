<?php
include_once 'Models/PengajuModel.php';
include_once 'Models/StafModel.php';
// include_once 'Models/EditorModel.php';

class Auth {
    var $dbP, $dbS, $client;

    function __construct() {
        $this->dbP = new PengajuModel();
        $this->dbS = new StafModel();
    }

    function viewAuth() {
        require_once 'Views/Auth/auth.php';
    }
    function viewPilihJenis(){
        require_once 'Views/header.php';
        require_once 'Views/Auth/pilih-jenis.php';
        // require_once 'Views/footer.php.php';
    }
    function gLogin($client){
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);

        $googleAuth = new Google_Service_OAuth2($client);
        $google_info = $googleAuth->userinfo->get();
        $domain = substr(strrchr($google_info['email'], "@"), 1);
        if($domain == "mahasiswa.pcr.ac.id" || $domain == "alumni.pcr.ac.id" || $domain == "pcr.ac.id" || $domain == "graduate.pcr.ac.id"){
            if($this->cekEmail($google_info['email'])){
                $data = [
                    $google_info['given_name']." ".$google_info['family_name'],
                    $google_info['email'],
                    $google_info['gender'],
                    $google_info['picture']
                ];
                if($domain == "mahasiswa.pcr.ac.id" || $domain == "alumni.pcr.ac.id" || $domain == "graduate.pcr.ac.id" ){
                    array_push($data, "Mahasiswa");
                }else{
                    array_push($data, "Dosen");
                }
                if(!$this->dbP->tambahData($data, true)){
                    if($this->dbP->login($data[1], null, true)){
                        $_SESSION['id'] = $this->dbP->getId();
                        $_SESSION['nama'] = $this->dbP->getNama();
                        $_SESSION['email'] = $this->dbP->getEmail();
                        $_SESSION['profil'] = $this->dbP->getProfil();
                        $_SESSION['jenis'] = $this->dbP->getJenis();
                        $_SESSION['role'] = "Pengaju";
                        echo "<script>
                        alert('Berhasil Login Sebagai Pengaju!');
                        window.location.href = 'index.php';
                        </script>";
                    }
                }else{
                    echo'<script>
                    alert("Terjadi Kesalahan!")
                    window.location.href = "index.php?page=login"
                    </script>';
                }
            }else{
                if($this->dbP->login($google_info['email'], null, true)){
                    // session_start();
                    // var_dump($this->dbP->getId());
                    $_SESSION['id'] = $this->dbP->getId();
                    $_SESSION['nama'] = $this->dbP->getNama();
                    $_SESSION['email'] = $this->dbP->getEmail();
                    $_SESSION['jk'] = $this->dbP->getJk();
                    $_SESSION['noTlp'] = $this->dbP->getNoTlp();
                    $_SESSION['jenis'] = $this->dbP->getJenis();
                    $_SESSION['role'] = "Pengaju";
                    $_SESSION['profil'] = $this->dbP->getProfil();
                    echo "<script>
                    alert('Berhasil Login Sebagai Pengaju!');
                    window.location.href = 'index.php';
                    </script>";
                }else if($this->dbS->login($google_info['email'], null, true)){
                    // session_start();
                    // var_dump($this->dbP->getId());
                    $_SESSION['id'] = $this->dbS->getId();
                    $_SESSION['nama'] = $this->dbS->getNama();
                    $_SESSION['email'] = $this->dbS->getEmail();
                    $_SESSION['jk'] = $this->dbS->getJk();
                    $_SESSION['noTlp'] = $this->dbS->getNoTlp();
                    $_SESSION['role'] = "Staf";
                    echo "<script>
                    alert('Berhasil Login Sebagai Staf!');
                    window.location.href = 'index.php';
                    </script>";
                }else{
                    echo "<script>
                    alert('Login Gagal!');
                    window.location.href = 'index.php';
                    </script>";
                }
            }
        }else{
            echo'
            <script>
            alert("Anda Bukan Civitas PCR!")
            window.location.href = "index.php?page=login"
            </script>
            ';
        }


    }
    function login(){
        $email = $_POST['email_login'];
        $password = $_POST['pass_login'];
        if($this->dbP->login($email, $password, false)){
            // session_start();
            // var_dump($this->dbP->getId());
            $_SESSION['id'] = $this->dbP->getId();
            $_SESSION['nama'] = $this->dbP->getNama();
            $_SESSION['email'] = $this->dbP->getEmail();
            $_SESSION['jk'] = $this->dbP->getJk();
            $_SESSION['noTlp'] = $this->dbP->getNoTlp();
            $_SESSION['jenis'] = $this->dbP->getJenis();
            $_SESSION['role'] = "Pengaju";
            echo "<script>
            alert('Berhasil Login Sebagai Pengaju!');
            window.location.href = 'index.php';
            </script>";
        }else if($this->dbS->login($email, $password, false)){
            // session_start();
            // var_dump($this->dbP->getId());
            $_SESSION['id'] = $this->dbS->getId();
            $_SESSION['nama'] = $this->dbS->getNama();
            $_SESSION['email'] = $this->dbS->getEmail();
            $_SESSION['jk'] = $this->dbS->getJk();
            $_SESSION['noTlp'] = $this->dbS->getNoTlp();
            $_SESSION['role'] = "Staf";
            echo "<script>
            alert('Berhasil Login Sebagai Staf!');
            window.location.href = 'index.php';
            </script>";
        }else{
            echo "<script>
            alert('Akun Tidak Ada!');
            window.location.href = 'index.php';
            </script>";
        }
    }   
    function logout($role){
        if($role === "pengaju"){
            $this->dbP->logout();
            if(session_destroy()){
                echo "<script>
                alert('Berhasil Logout!');
                window.location.href = 'index.php';
                </script>";
            }
        }else if($role === "staf"){
            $this->dbS->logout();
            if(session_destroy()){
                echo "<script>
                alert('Berhasil Logout!');
                window.location.href = 'index.php';
                </script>";
            }
        }
    }   
    
    function cekEmail($email){
        if($this->dbP->getEmailFromDB($email) && $this->dbS->getEmailFromDB($email)){
            return true;
        }else{
            return false;
        }
    }

    function register(){
        if($this->cekEmail($_POST['email'])){
            if($_POST['konfirmasi_password'] === $_POST['password']){
                if($_POST['role'] === "pengaju"){
                    $data = [
                        $_POST['nama'],
                        $_POST['email'],
                        $_POST['no_telp'],
                        $_POST['jk'],   
                        md5($_POST['password']),
                        $_POST['jp']
                    ];
                    $status = $this->dbP->tambahData($data, false);
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
                }else if($_POST['role'] === "staf"){
                    $data = [
                        $_POST['nama'],
                        $_POST['email'],
                        $_POST['no_telp'],
                        $_POST['jk'],
                        md5($_POST['password']),
                    ];
                    $status = $this->dbS->tambahData($data);
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
            }else{
                echo'<script>
                alert("Password dan Konfirmasinya Berbeda!")
                window.location.href = "index.php?page=register"
                </script>';
            }
        }else{
            echo'<script>
            alert("Email Sudah Terdaftar!")
            window.location.href = "index.php?page=register"
            </script>';
        }
        
    }
}
