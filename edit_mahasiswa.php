<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM mahasiswa WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: dashboard.php");
    exit;
}

$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $prodi = $_POST['prodi'];

    $sql = "UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan', prodi='$prodi' WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: dashboard.php");
    } else {
        $error = "Gagal mengedit data mahasiswa!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Edit Mahasiswa</title>
</head>
<body>
    <h2>Edit Mahasiswa</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Name :</label>
        <input type="text" name="nama" value="<?php echo $student['nama']; ?>" required><br>
        <label>Jurusan :</label>
        <input type="text" name="jurusan" value="<?php echo $student['jurusan']; ?>" required><br>
        <label>Prodi :</label>
        <input type="text" name="prodi" value="<?php echo $student['prodi']; ?>" required><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>