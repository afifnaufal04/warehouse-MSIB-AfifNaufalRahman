<?php
require_once 'database.php';
require_once 'gudang.php';

session_start();

$database = new Database();
$db = $database->getConnection();
$gudang = new Gudang($db);
$stmt= $gudang->tampildata();

$pesan = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$tipe = isset($_SESSION['type']) ? $_SESSION['type'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>List Gudang</h2>
            </div>
            <div class="mt-3 mx-3">
                    <?php

                        if (isset($pesan)) {
                            echo '<div class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert">';
                            echo $pesan;
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                            unset($pesan);
                            unset($tipe);
                        }
                    ?>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead text-center">
                        <tr>
                             <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Capacity</th>
                            <th>Status</th>
                            <th>Opening Hour</th>
                            <th>Closing Hour</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody text-center">
                        <?php
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row);
                                echo "<tr>";
                                echo "<td>{$id}</td>";
                                echo "<td>{$name}</td>";
                                echo "<td>{$location}</td>";
                                echo "<td>{$capacity}</td>";
                                echo "<td>{$status}</td>";
                                echo "<td>{$opening_hour}</td>";
                                echo "<td>{$closing_hour}</td>";
                                echo "<td class='ms-5'>";
                                echo "<a href='edit.php?id={$id}' class='btn btn-warning mx-1 w-25'>Edit</a>";
                                echo "<a href='hapus.php?id={$id}' class='btn btn-danger mx-1 w-25' >Hapus</a>";
                                if(strtolower($row['status']) == "aktif"){
                                    echo "<a href='nonaktif.php?id={$id}' class='btn btn-primary mx-1'>Nonaktifkan</a>";
                                }else{
                                    echo "<a href='aktifkan.php?id={$id}' class='btn btn-secondary mx-1 w-25'>Aktifkan</a>";
                                }
            
                                echo "</td>";
                                echo "<tr>";
                            }
                            ?>
                    </tbody>
                </table>
                <div class="my-3">
                    <a href="tambah.php" class="btn btn-primary w-100">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>