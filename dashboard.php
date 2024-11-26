<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM mahasiswa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="tambah_mahasiswa.php">Tambah Mahasiswa</a> | <a href="logout.php">Logout</a>
    <h3>Daftar Mahasiswa</h3>
    <table border="1">
        <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Prodi</th>
            <th colspan="2">Modifikasi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['jurusan']; ?></td>
            <td><?php echo $row['prodi']; ?></td>
            <td><center><a href="edit_mahasiswa.php?id=<?php echo $row['id']; ?>">Edit</a>
            </center></td>
            <td><center><a href="hapus_mahasiswa.php?id=<?php echo $row['id']; ?>
            " onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
            </center></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>