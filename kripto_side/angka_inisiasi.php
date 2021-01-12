<?php


class angka_inisiasi
{
    private function find_p(){
        $start_nya = 80515;
        $kira_akhir = 81000;
        $angka_p = 0;
        $statusnya = 1;

        for($i=$start_nya; $i<=$kira_akhir; $i++){
            for ($j = 2; $j <= sqrt($i); $j++){
                if ($i % $j == 0){
                    $statusnya = 0;
                    break;
                }
            }
            if($statusnya){
                $angka_p = $i;
                break;
            }
            $statusnya = 1;
        }
        return $angka_p;
    }

    private function find_q(){
        $start_nya = 550725;
        $kira_akhir = 600280;
        $angka_q = 0;
        $statusnya = 1;

        for($i=$start_nya; $i<=$kira_akhir; $i++){
            for ($j = 2; $j <= sqrt($i); $j++){
                if ($i % $j == 0){
                    $statusnya = 0;
                    break;
                }
            }
            if($statusnya){
                $angka_q = $i;
                break;
            }
            $statusnya = 1;
        }
        return $angka_q;
    }
    public function find_n(){
        $n = $this->find_p() * $this->find_q();
        return $n;
    }
    public function o_n(){
        $O_n =  ($this->find_p() - 1 ) * ($this->find_q() - 1);
        return $O_n;
    }
    public function find_e(){
        $start_nya = 80;
        $kira_akhir = 85;
        $angka_e = 0;
        $O_n = $this->o_n();

        for($i=$start_nya; $i<=$kira_akhir; $i++){
            $gcd = gmp_gcd($O_n, $i);
            if(gmp_strval($gcd)==1){
                $angka_e = $i;
                break;
            }
        }
        return $angka_e;
    }
    private function find_d(){
        $angka_d = array();
        for($i=1;$i<950;$i++){
            $d = (1 + ($i * $this->o_n())) / $this->find_e();
            if(is_int($d)){
                array_push($angka_d,$d);
            }
        }
        return $angka_d;
    }
    private function find_jabatan($no){
        $hasil = (int) substr($no,0,3);
        return $hasil;
    }
    private function rombak($ascii){
        $ascii_awal = str_split($ascii,7);
        return $ascii_awal;
    }
    public function enkrip($pesan){
        $ascii_nya = implode(unpack("C*",$pesan)); //C* berarti ke unsigned char
        echo "ascii = ".$ascii_nya."<br>";
        $cipher = array();
        $pecahan = $this->rombak($ascii_nya);
        foreach($pecahan as $value){
            echo $value."<br>";
            $hasil = bcpowmod($value,$this->find_e(),$this->find_n()) ;
            echo $hasil."<br>";
            array_push($cipher,$hasil);
        }
        return implode("|",$cipher);
    }
     public function for_dekrip($jabatan,$cipher){
        $plainteks = array();
        $daftar_kunci = $this->find_d();
        $no_jab = $this->find_jabatan($jabatan);
        $kuncinya = $daftar_kunci[$no_jab];
        $array_cipher = explode("|", $cipher);

        // pecah dan hitung agar kembali ke plainteks
        foreach ($array_cipher as $value){
            $hasil = bcpowmod($value,$kuncinya,$this->find_n());
            array_push($plainteks,$hasil);
        }
//        print_r($plainteks);
//        echo "<br>";
        for($i=0;$i<sizeof($plainteks);$i++){
            if(($i+1) == sizeof($plainteks)){
                if(strlen($plainteks[$i]) == 6){
                    $plainteks[$i] = "0".$plainteks[$i];
                }
                break;
            }
            else{
                if(strlen($plainteks[$i])<7){
                    $plainteks[$i] = "0".$plainteks[$i];
                }
            }
        }
//        print_r($plainteks);
//        echo "<br>";
        $plainteks = str_split(implode($plainteks),2);
        $plainteks = pack("C*",...$plainteks);
        return $plainteks;
     }

}