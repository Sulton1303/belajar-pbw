<?php
session_start();

if (!isset($_SESSION['data'])) {
    header("Location: index.php");
    exit();
}

$data = $_SESSION['data'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penerbangan</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Data Penerbangan Anda</h1>

    <div class="card">
        <p><strong>Nama Maskapai:</strong> <?= htmlspecialchars($data['maskapai']) ?></p>
        <p><strong>Asal Penerbangan:</strong> <?= htmlspecialchars($data['asal']) ?></p>
        <p><strong>Tujuan Penerbangan:</strong> <?= htmlspecialchars($data['tujuan']) ?></p>
        <p><strong>Harga Tiket:</strong> Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>
        <p><strong>Pajak:</strong> Rp <?= number_format($data['pajak'], 0, ',', '.') ?></p>
        <p><strong>Total Harga Tiket:</strong> Rp <?= number_format($data['total_harga'], 0, ',', '.') ?></p>

        <a class="btn" href="exit.php">Kembali ke Pendaftaran Penerbangan</a>
    </div>
</body>
</html>
