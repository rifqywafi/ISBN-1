<?php

session_start();
// var_dump($_SESSION['id']);
// session_destroy();
if(isset($_SESSION['id'])){
    if($_SESSION['role'] == "Pengaju"){
        if (!isset($_GET['page'])){
            require_once 'Controllers/Pengaju.php';
            $controller = new Pengaju();
            $controller->viewLandingPagePengaju();
        }else if (isset($_GET['page']) && $_GET['page'] == "buku"){
            require_once 'Controllers/Buku.php';
            require_once 'Controllers/Pengaju.php';
            if(isset($_GET['act']) && $_GET['act'] == "hapus"){
                $controller = new Buku();
                $controller->hapus();
            }else if(isset($_GET['act']) && $_GET['act'] == "list"){
                $controller = new Pengaju();
                $controller->viewListBuku();
            }
            else if(isset($_GET['act']) && $_GET['act'] == "tambahData"){
                $controller = new Pengaju();
                $controller->ViewTambahBukuPengaju();
            }else if(isset($_GET['act']) && $_GET['act'] == "insertDataBuku"){
                $controller = new Buku();
                $controller->tambahData();
            }else if(isset($_GET['act']) && $_GET['act'] =='updateDataBuku'){
                $controller = new Buku();
                $controller->updateData();
            }else if(isset($_GET['act']) && $_GET['act'] =='preview'){
                $controller = new Buku();
                $controller->previewBuku($_GET['docs']);
            }else if(isset($_GET['act']) && $_GET['act'] == 'listTerbit'){
                $controller = new Pengaju();
                $controller->viewBukuSelesai();
            }else{
                include 'Views/505.php';
            }
        }else if(isset($_GET['page']) && $_GET['page'] == "auth"){
            require_once 'Controllers/Auth.php';
            if(isset($_GET['act']) && $_GET['act'] == "logout"){
                $controller = new Auth();
                $controller->logout("pengaju");
            }else{
                include 'Views/505.php';
            }
        }else{
            include 'Views/505.php';
        }
    }else if($_SESSION['role'] == "Staf"){
        require_once 'Core/config.php';
        if (!isset($_GET['page'])){
            require_once 'Controllers/Staf.php';
            $controller = new Staf();
            $controller->viewDashboardStaf();
            if(isset($_GET['act']) && $_GET['act'] == 'preview'){
                $controllerB = new Buku();
                $controllerB->previewBuku($_GET['docs']);
            }
        }else if (isset($_GET['page']) && $_GET['page'] == "listBuku"){
            require_once 'Controllers/Staf.php';
            require_once 'Controllers/Buku.php';
            if(!isset($_GET['act'])){
                $controllerS = new Staf();
                $controllerS->viewBuku();
            }else if(isset($_GET['act']) && $_GET['act'] == "proses"){
                $controllerB = new Buku();
                $controllerB->updateStatus("Sedang Diproses", $mail);
            }else if(isset($_GET['act']) && $_GET['act'] == "aju"){
                $controllerB = new Buku();
                $controllerB->updateStatus("Sedang Diajukan", $mail);
            }else if(isset($_GET['act']) && $_GET['act'] == "selesai"){
                $controllerB = new Buku();
                $controllerB->updateStatus("Selesai", $mail);
            }else if(isset($_GET['act']) && $_GET['act'] == "tolak" && isset($_GET['id'])){
                $controllerB = new Buku();
                $controllerB->updateStatus("Ditolak", $mail);
            }else if(isset($_GET['act']) && $_GET['act'] == 'preview'){
                $controllerB = new Buku();
                $controllerB->previewBuku($_GET['docs']);
            }else{
                include 'Views/505.php';
            }
        }else if (isset($_GET['page']) && $_GET['page'] == "listEditor"){
            require_once 'Controllers/Staf.php';
            require_once 'Controllers/Editor.php';
            $controller = new Staf();
            $controller->viewEditor();
        }else if(isset($_GET['page']) && $_GET['page'] == "auth"){
            require_once 'Controllers/Auth.php';
            if(isset($_GET['act']) && $_GET['act'] == "logout"){
                $controller = new Auth();
                $controller->logout("staf");
            }else{
                include 'Views/505.php';
            }
        }else{
            include 'Views/505.php';
        }
    }
}
else{
    // header('location:index.php?page=login');
    // die();
    require_once 'Controllers/Auth.php';
    require_once 'Core/config.php';
    // var_dump($authUrl);

    if(isset($_GET['act']) && $_GET['act'] == "login"){
        $controller = new Auth();
        $controller->login();
    }else if(isset($_GET['act']) && $_GET['act'] == "daftar"){
        $controller = new Auth();
        $controller->register();
    }else if(isset($_GET['page']) && $_GET['page'] == "googleAuth"){ 
        header("location:".$authUrl); 
    }else if(isset($_GET['page']) && $_GET['page'] == "pilihJenisPengaju"){ 
        $controller = new Auth();
        $controller->viewPilihJenis();
    }else if(isset($_GET['code'])){ 
        $controller = new Auth();
        $controller->gLogin($client);
    }else{
        $controller = new Auth();
        $controller->viewAuth();
    }
}
?>