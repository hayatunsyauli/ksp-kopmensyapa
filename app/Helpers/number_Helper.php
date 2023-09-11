<?php

if (!function_exists("numberToWord")) {

    function numberToWord($nilai) {
        $nilai = (int)$nilai;
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = numberToWord($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = numberToWord($nilai/10)." puluh". numberToWord($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . numberToWord($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = numberToWord($nilai/100) . " ratus" . numberToWord($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . numberToWord($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = numberToWord($nilai/1000) . " ribu" . numberToWord($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = numberToWord($nilai/1000000) . " juta" . numberToWord($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = numberToWord($nilai/1000000000) . " milyar" . numberToWord(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = numberToWord($nilai/1000000000000) . " trilyun" . numberToWord(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
 
    function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim(numberToWord($nilai));
        } else {
            $hasil = trim(numberToWord($nilai) ) ;
        }           
        return $hasil . ' Rupiah';
    }
}

?>