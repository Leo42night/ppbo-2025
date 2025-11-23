<?PhP
class Hewan {
    public $nama ;
}

class Anjing extends Hewan {
    public function JenisHewan() {
        return " nama hewan : $this-> nama, warnanya : $this->warna" ;
    }
}
    
$Anjing = new Anjing ();

$Anjing->nama="Anjing";
$Anjing->warna="Hitam";

echo $Anjing->JenisHewan();
?>