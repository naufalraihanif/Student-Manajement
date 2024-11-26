<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $prodi = $_POST['prodi'];

    $sql = "INSERT INTO mahasiswa (id, nama, jurusan, prodi) VALUES ('$id', '$nama', '$jurusan', '$prodi')";
    if ($conn->query($sql)) {
        header("Location: dashboard.php");
    } else {
        $error = "Failed to add student!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Tambah Mahasiswa</title>
</head>
<body>
    <h2>Tambah Mahasiswa</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>NPM :</label>
        <input type="text" name="id" required><br>
        <label>Nama :</label>
        <input type="text" name="nama" required><br>
        <label>Jurusan :</label>
        <input type="text" name="jurusan" required><br>
        <label>Prodi :</label>
        <input type="text" name="prodi" required><br>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>