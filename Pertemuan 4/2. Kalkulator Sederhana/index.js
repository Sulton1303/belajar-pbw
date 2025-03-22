// Arrow function kalkulator dengan spread operator untuk banyak operasi
const kalkulator = (operator, ...angka) => {
  let hasil = angka[0]; // mulai dari angka pertama

  // Loop mulai dari index ke-1
  for (let i = 1; i < angka.length; i++) {
    if (operator === "+") {
      hasil += angka[i];
    } else if (operator === "-") {
      hasil -= angka[i];
    } else if (operator === "*") {
      hasil *= angka[i];
    } else if (operator === "/") {
      hasil /= angka[i];
    } else if (operator === "%") {
      hasil %= angka[i];
    } else {
      console.log("Operator tidak valid");
      return "Operator tidak valid";
    }
  }

  return hasil;
};

// Event ketika tombol 'Hitung' ditekan
document.getElementById("hitungBtn").addEventListener("click", () => {
  const angkaInput = document.getElementById("inputAngka").value;
  const operator = document.getElementById("operator").value;
  const angkaArray = angkaInput.split(",").map((num) => parseFloat(num.trim()));

  if (angkaArray.some(isNaN)) {
    document.getElementById("hasil").textContent = "Hasil: Input tidak valid";
    return;
  }

  const hasil = kalkulator(operator, ...angkaArray);
  document.getElementById("hasil").textContent = `Hasil: ${hasil}`;
});
