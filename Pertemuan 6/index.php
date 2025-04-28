<?php
session_start();
// Halaman Utama
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Penerbangan</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Form Pendaftaran Penerbangan</h1>
    <form action="logic.php" method="post">
        <label>Nama Maskapai:</label><br>
        <input type="text" name="maskapai" required><br><br>

        <label>Bandara Asal:</label><br>
        <select name="asal" required>
            <?php
            $bandara_asal = [
                "Soekarno Hatta" => 65000,
                "Husein Sastranegara" => 50000,
                "Abdul Rachman Saleh" => 40000,
                "Juanda" => 30000
            ];
            ksort($bandara_asal);
            foreach ($bandara_asal as $asal => $pajak) {
                echo "<option value=\"$asal\">$asal</option>";
            }
            ?>
        </select><br><br>

        <label>Bandara Tujuan:</label><br>
        <select name="tujuan" required>
            <?php
            $bandara_tujuan = [
                "Ngurah Rai" => 85000,
                "Hasanuddin" => 70000,
                "Inanwatan" => 90000,
                "Sultan Iskandar Muda" => 60000
            ];
            ksort($bandara_tujuan);
            foreach ($bandara_tujuan as $tujuan => $pajak) {
                echo "<option value=\"$tujuan\">$tujuan</option>";
            }
            ?>
        </select><br><br>

        <label>Harga Tiket:</label><br>
        <input type="number" name="harga" required><br><br>

        <input type="submit" value="Daftar">
    </form>
</body>
</html>
