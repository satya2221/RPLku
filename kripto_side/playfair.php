<?php


class playfair
{
    public $spasi = array();
    private function BuatKunci(){
        $kunci = "SATYAADHIWICAKSANA";
        $kunci = str_split($kunci);  // string dipecah ke dalam sebuah array
        $matrix_awal = array(); // inisiasi array awal yang berupa array 1 dimensi
        $matrix_jadi = array(); // inisiasi array yang sudah berbentuk 2 dimensi
        $alphabet = str_split("ABCDEFGHIKLMNOPQRSTUVWXYZ"); // daftar alfabet untuk mengisi seluruh tabel

        //memecah kunci untuk dimasukkan kedalam array
        foreach($kunci as $e){
            // mengabaikan huruf J
            if($e == "J"){
                continue;
            }
            // jika huruf belum ada pada array maka masuk kedalam array, mencegah ada huruf yang terulang
            elseif (!in_array($e,$matrix_awal)){
                array_push($matrix_awal, $e);
            }
        }

        //memasukkan huruf alfabet sisa selain yang ada di kunci
        foreach($alphabet as $e){
            if(!in_array($e,$matrix_awal)){
                array_push($matrix_awal, $e);
            }
        }

        // agar menjadi matrix 2 dimensi tiap 5 elemen dipecah dimasukkan kedalam array matrix_jadi
        $ngitung_posisi = 0;
        for($i=0;$i<5;$i++){
            $matrix_jadi[$i] = array_slice($matrix_awal,$ngitung_posisi,5);
            $ngitung_posisi+=5;
        }
        return $matrix_jadi;
    }
    private function simpan_spasi($no,$pesan){
        if(strpos($pesan," ")!==false){
            $pesan = str_split($pesan);
            $posisi_spasi = array_keys($pesan, " ");
            $this->spasi[$no] = $posisi_spasi;
        }
        else{
            $this->spasi[$no] = -1;
        }
        return $this->spasi;
    }
    private function rombak_pesan($pesan){
        $hasil_rombak = array();
        $pesannya = strtoupper($pesan);
        // hapus spasi didalam array
        $pesannya = str_replace(' ', '', $pesannya);
        // masukkan pesan kedalam sebuah array
        $pesannya = str_split($pesannya);

        // Memisahkan 2 huruf berpasangan, dengan menyisipkan huruf Z diantaranya
        // Jika yang paling belakang belum berpasangana maka diberikan Z sebagai pasangan
        for ($i=0; $i<sizeof($pesannya);$i+=2){
            if($i+1 >= sizeof($pesannya)){
                array_push($pesannya,'Z');
                break;
            }
            if($pesannya[$i] == $pesannya[$i+1]){
                array_splice($pesannya,$i + 1,0, 'Z');
            }
        }
        // buat pasangan huruf menjadi array tersendiri
        for ($j=0; $j< sizeof($pesannya); $j += 2){
            array_push($hasil_rombak, array_slice($pesannya,$j,2));
        }
        return $hasil_rombak;
    }

    // Untuk mencari posisi huruf didalam matrix kunci
    private function cari_posisi($hurufnya){
        $x = 0;
        $y = 0;
        $kuncinya = $this ->BuatKunci();
        for ($baris=0; $baris<5;$baris++){
            for ($kolom=0; $kolom<5;$kolom++){
                if($kuncinya[$baris][$kolom] == $hurufnya){
                    $x = $baris;
                    $y = $kolom;
                }
            }
        }
        return array($x,$y);
    }
    public function enkripsi($no,$pesan){
        $pesannya = $this->rombak_pesan($pesan);
        $this->simpan_spasi($no,$pesan);
        $kunci = $this->BuatKunci();
        $teks_cipher = array();

        foreach($pesannya as $e){
            // untuk mengetahui baris dan kolomnya dipecah seperti ini
            list($b1, $k1) = $this->cari_posisi($e[0]);
            list($b2, $k2) = $this->cari_posisi($e[1]);

            // jikalau huruf ada pada 1 baris yang sama didalam kunci
            if($b1 == $b2){
                // kalau salah satu ada di ujung kanan (kolom ke lima) maka digeser ke kolom ke 1
                // maka diberi nilai negatif 1
                if ($k1 == 4){
                    $k1 = -1;
                }
                if ($k2 == 4){
                    $k2 = -1;
                }
                array_push($teks_cipher,$kunci[$b1][$k1+1]);
                array_push($teks_cipher, $kunci[$b1][$k2+1]);
            }
            // Jikalau huruf ada pada 1 kolom yang sama didalam kunci
            elseif ($k1==$k2){
                // kalau salah satu ada di paling bawah (baris ke lima) maka digeser ke baris ke 1
                // maka diberi nilai negatif 1
                if ($b1 == 4){
                    $b1 = -1;
                }
                if ($b2 == 4){
                    $b2 = -1;
                }
                array_push($teks_cipher,$kunci[$b1+1][$k1]);
                array_push($teks_cipher, $kunci[$b2+1][$k2]);
            }
            else{
                array_push($teks_cipher,$kunci[$b1][$k2]);
                array_push($teks_cipher, $kunci[$b2][$k1]);
            }
        }
        if (is_array($this->spasi[$no])){
            for($i=0;$i<sizeof($this->spasi[$no]);$i++){
                array_splice($teks_cipher,$this->spasi[$no][$i],0," ");
            }
        }
        return implode($teks_cipher);
    }
    public function dekripsi($no,$message){
        $cipher = $this->rombak_pesan($message);
        $this->simpan_spasi($no,$message);
//        print_r($this->spasi);
//        echo "<br>";
        $kunci = $this->BuatKunci();
        $plainteks = array();

        foreach($cipher as $e){
            list($b1, $k1) = $this->cari_posisi($e[0]);
            list($b2, $k2) = $this->cari_posisi($e[1]);

            // jikalau huruf ada pada 1 baris yang sama didalam kunci
            if($b1 == $b2){
                // kalau salah satu ada di ujung kiri (kolom pertama) maka digeser ke kolom ke 5
                // maka diberi nilai 5
                if ($k1 == 0){
                    $k1 = 5;
                }
                if ($k2 == 0){
                    $k2 = 5;
                }
                array_push($plainteks,$kunci[$b1][$k1-1]);
                array_push($plainteks, $kunci[$b1][$k2-1]);
            }
            // Jikalau huruf ada pada 1 kolom yang sama didalam kunci
            elseif ($k1==$k2){
                // kalau salah satu ada di paling atas (baris pertama) maka digeser ke baris ke 5
                // maka diberi nilai 5
                if ($b1 == 0){
                    $b1 = 5;
                }
                if ($b2 == 0){
                    $b2 = 5;
                }
                array_push($plainteks,$kunci[$b1-1][$k1]);
                array_push($plainteks, $kunci[$b2-1][$k2]);
            }

            else{
                array_push($plainteks,$kunci[$b1][$k2]);
                array_push($plainteks, $kunci[$b2][$k1]);
            }
        }
        foreach($plainteks as $key => $val){
            if ($val=="Z"){
                unset($plainteks[$key]);
            }
        }
        $plainteks = array_values($plainteks);
        if (is_array($this->spasi[$no])){
            for($i=0;$i<sizeof($this->spasi[$no]);$i++){
                array_splice($plainteks,$this->spasi[$no][$i],0," ");
            }
        }
        elseif ($this->spasi[$no]>=0){
            array_splice($plainteks,$this->spasi[$no],0," ");
        }
        return implode($plainteks);
    }
}