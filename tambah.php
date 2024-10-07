<?php
require_once 'database.php';
require_once 'gudang.php';
session_start();

$database = new Database();
$db= $database->getConnection();

$gudang = new Gudang($db);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if($gudang->tambah()){
        $_SESSION['message'] = "Data berhasil Ditambahkan.";
        $_SESSION['type']= "success";
        header("Location: index.php");
        exit;
    }else{
        $_SESSION['message'] = "Data gagal Ditambahkan.";
        $_SESSION['type']= "danger";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Form Input Gudang</h2>
            </div>
            <div class="card-body">
                <form action="tambah.php" method="POST">
                    <div class="mt-3">
                        <label for="name" class="form-label">Nama Gudang</label><br>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="location" class="form-label">Lokasi Gudang</label><br>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="capacity" class="form-label">Kapasitas Gudang</label><br>
                        <input type="number" name="capacity" id="capacity" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="status" class="form-label">Status Gudang</label><br>
                        <select name="status" id="status" class="form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="Tidak_Aktif">Tidak Aktif</option>
                        </select><br>
                    </div>
                    <div class="mt-3">
                        <label for="opening_hour" class="form-label">Jam Buka Gudang</label><br>
                        <input type="time" name="opening_hour" id="opening_hour" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="closing_hour" class="form-label" >Jam Tutup Gudang</label><br>
                        <input type="time" name="closing_hour" id="closing_hour" class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-100">Tambah</button>
                    </div>
                    <div class="mt-3">
                        <a href="index.php" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>