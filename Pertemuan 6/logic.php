<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maskapai = $_POST['maskapai'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $harga = (int) $_POST['harga'];

    $bandara_asal = [
        "Soekarno Hatta" => 65000,
        "Husein Sastranegara" => 50000,
        "Abdul Rachman Saleh" => 40000,
        "Juanda" => 30000
    ];

    $bandara_tujuan = [
        "Ngurah Rai" => 85000,
        "Hasanuddin" => 70000,
        "Inanwatan" => 90000,
        "Sultan Iskandar Muda" => 60000
    ];

    // Hitung pajak
    $pajak_asal = isset($bandara_asal[$asal]) ? $bandara_asal[$asal] : 0;
    $pajak_tujuan = isset($bandara_tujuan[$tujuan]) ? $bandara_tujuan[$tujuan] : 0;
    $total_pajak = $pajak_asal + $pajak_tujuan;

    // Hitung total harga
    $total_harga = $harga + $total_pajak;

    // Simpan ke session
    $_SESSION['data'] = [
        'maskapai' => $maskapai,
        'asal' => $asal,
        'tujuan' => $tujuan,
        'harga' => $harga,
        'pajak' => $total_pajak,
        'total_harga' => $total_harga
    ];

    // Pindah ke output
    header("Location: output.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
