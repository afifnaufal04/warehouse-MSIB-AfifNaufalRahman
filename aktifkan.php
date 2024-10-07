<?php
require_once 'database.php';
require_once 'gudang.php';

session_start();

$database = new Database();
$db= $database->getConnection();

$gudang = new Gudang($db);

if(isset($_GET['id'])){
    $gudang->id = $_GET['id'];
    if($gudang->aktifkan()){
        $_SESSION['message'] = "Gudang berhasil Di Aktifkan.";
        $_SESSION['type']= "success";
        header("Location: index.php");
        exit;
    }else{
        $_SESSION['message'] = "Gudang gagal Di Aktifkan.";
        $_SESSION['type']= "danger";
    }
}
?>