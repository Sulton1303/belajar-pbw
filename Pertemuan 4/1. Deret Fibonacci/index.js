// Membuat fungsi untuk mencetak deret fibonacci sebanyak n kali
function deretFibonacci(n) {
  let a = 0; // Nilai awal dari deret fibonacci
  let b = 1; // Nilai kedua dari deret fibonacci
  let hasil = "";

  // Membuat perulangan sebanyak n kli
  for (let i = 0; i < n; i++) {
    hasil += a + " ";
    // Menghitung angka selanjutnya dalam deret fibonacci
    let next = a + b;
    a = b; // Mengubah nilai a menjadi b
    b = next; // Mengubah nilai b menjadi next
  }

  console.log("Deret Fibonacci:");
  console.log(hasil);
}

// Memanggil fungsi deretFibonacci dengan parameter n = 10
deretFibonacci(10);
