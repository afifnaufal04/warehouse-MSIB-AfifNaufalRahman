<?php
    require_once 'database.php';
    require_once 'gudang.php';

    session_start();

    $database = new Database();
    $db = $database->getConnection();

    $gudang = new Gudang($db);

    if(isset($_GET['id'])){
        $gudang->id = $_GET['id'];
        if($gudang->hapus()){
            $_SESSION['message'] = "Data berhasil Dihapus.";
            $_SESSION['type'] = "success";
            header("Location: index.php");
            exit;
        }else{
            $_SESSION['message']= "Data gagal Dihapus.";
            $_SESSION['type'] = "danger";
        }
    }

?>