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

$sql = "DELETE FROM mahasiswa WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['message'] = "Data berhasil dihapus!";
} else {
    $_SESSION['message'] = "Gagal menghapus data!";
}

$stmt->close();
header("Location: dashboard.php");
exit;
?>