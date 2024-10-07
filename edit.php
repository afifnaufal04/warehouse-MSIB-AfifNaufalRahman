<?php
require_once 'database.php';
require_once 'gudang.php';

session_start();

$database = new Database();
$db= $database->getConnection();

$gudang = new Gudang($db);

if(isset($_GET['id'])){
    $gudang->id= $_GET['id'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    
    var_dump($gudang->status);  // Untuk melihat nilai status
    

    if($gudang->update()){
        $_SESSION['message'] = "Data berhasil Diupdate.";
        $_SESSION['type'] = "success";
        header("Location: index.php");
        exit;
    }else{
        $_SESSION['message'] = "Data gagal Diupdate.";
        $_SESSION['type'] = "danger";
       
    }
}else{
    $stmt = $gudang->ambildata($gudang->id);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $gudang->name = $data['name'];
    $gudang->location = $data['location'];
    $gudang->capacity= $data['capacity'];
    $gudang->opening_hour = $data['opening_hour'];
    $gudang->closing_hour = $data['closing_hour'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Form Edit Gudang</h2>
            </div>
            <div class="card-body">
                <?php echo 'Current Status: ' . $gudang->status; ?>

                <form action="edit.php?id=<?= $gudang->id?>" method="POST">
                    <div class="mt-3">
                        <label for="name" class="form-label">Nama Gudang</label><br>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $gudang->name;?>" required>
                    </div>
                    <div class="mt-3">
                        <label for="location" class="form-label">Lokasi Gudang</label><br>
                        <input type="text" name="location" id="location" class="form-control" value="<?php echo $gudang->location;?>" required>
                    </div>
                    <div class="mt-3">
                        <label for="capacity" class="form-label">Kapasitas Gudang</label><br>
                        <input type="number" name="capacity" id="capacity" class="form-control" value="<?php echo $gudang->capacity;?>" required>
                    </div>
                    <div class="mt-3">
                        <label for="opening_hour" class="form-label">Jam Buka Gudang</label><br>
                        <input type="time" name="opening_hour" id="opening_hour" class="form-control" value="<?php echo $gudang->opening_hour;?>" required>
                    </div>
                    <div class="mt-3">
                        <label for="closing_hour" class="form-label" >Jam Tutup Gudang</label><br>
                        <input type="time" name="closing_hour" id="closing_hour" class="form-control" value="<?php echo $gudang->closing_hour;?>" required>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-warning w-100">Update</button>
                    </div>
                    <div class="mt-3">
                        <a href="index.php" class="btn btn-primary w-25">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>