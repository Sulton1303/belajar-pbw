<?php

// Membuat class book
class Book {
    // Membuat properti yang bersifat private
    private $code_book;
    private $name;
    private $qty;
    
    // Membuat konstruktor
    public function __construct($code_book, $name, $qty) {
        $this->setCodeBook($code_book);
        $this->name = $name;
        $this->setQty($qty);
    }
    
    // Method private untuk validasi dan set kode buku
    private function setCodeBook($code_book) {
        if (preg_match('/^[A-Z]{2}[0-9]{2}$/', $code_book)) {
            $this->code_book = $code_book;
        } else {
            echo "Error: Format kode buku tidak valid. Harus dalam format BB00 (2 huruf besar diikuti 2 angka).\n";
        }
    }
    
    // Method private untuk validasi dan set jumlah buku
    private function setQty($qty) {
        if (is_int($qty) && $qty > 0) {
            $this->qty = $qty;
        } else {
            echo "Error: Jumlah buku harus berupa integer positif.\n";
        }
    }
    
    // Method untuk menambahkan kode buku
    public function getCodeBook() {
        return $this->code_book;
    }
    
    // Method untuk mendapatkan nama buku
    public function getName() {
        return $this->name;
    }
    
    // Method untuk mendapatkan jumlah buku
    public function getQty() {
        return $this->qty;
    }
}

// Kondisi jika objek valid dan betul seutuhnya
$book1 = new Book("AB12", "PHP Programming", 5);
echo "Kode Buku: " . $book1->getCodeBook() . "\n";
echo "Nama Buku: " . $book1->getName() . "\n";
echo "Jumlah: " . $book1->getQty() . "\n";

// Objek dengan kode buku tidak valid (huruf kecil)
$book2 = new Book("ab12", "Invalid Book", 3);
echo "Kode Buku: " . $book2->getCodeBook() . "\n";

// Objek dengan kode buku tidak valid (format salah)
$book3 = new Book("A123", "Invalid Book", 3);
echo "Kode Buku: " . $book3->getCodeBook() . "\n";

// Objek dengan jumlah buku negatif
$book4 = new Book("CD34", "Another Book", -5);
echo "Jumlah: " . $book4->getQty() . "\n";

// Objek dengan jumlah buku nol
$book5 = new Book("EF56", "Zero Book", 0);
echo "Jumlah: " . $book5->getQty() . "\n";

?>