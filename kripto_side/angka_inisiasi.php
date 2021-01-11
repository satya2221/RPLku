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
        $start_nya = 75;
        $kira_akhir = 80;
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
        for($i=1;$i<800;$i++){
            $d = (1 + ($i * $this->o_n())) / $this->find_e();
            if(is_int($d)){
                array_push($angka_d,$d);
            }
        }
        return $angka_d;
    }
//     public function for_dekrip($jabatan){
//        $daftar_kunci = $this->find_d();
//        $kuncinya = $daftar_kunci[$jabatan];
//        return $kuncinya;
//     }

}