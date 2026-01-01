<?php

	trait Pesan {
 public function tampilPesan() {
        echo "Halo, ini pesan dari trait!\n";
    }
}

	trait Logger {
	    public function log($pesan) {
	        echo "[LOG]: " . $pesan . "\n";
	    }
	}
	
	// 3. Class User menggunakan trait Pesan dan Logger
	class User {
	   use Pesan, Logger;

	    private $nama;
	
	    public function __construct($nama) {
	        $this->nama = $nama;
	    }
	
	    public function getNama() {
	        return $this->nama;
	    }
		}
	
	// 4. Class Admin mewarisi User dan hanya menggunakan Logger
	class Admin extends User {
	    use Logger;
	}
// MAIN PROGRAM
$user1 = new User("Budi");
$admin1 = new Admin("Andi");
// Panggil method dari trait
$user1->tampilPesan();
$user1->log("User " . $user1->getNama() . " berhasil login.");
$admin1->log("Admin " . $admin1->getNama() . " menghapus data.");
?>
