<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function pilihan_list($db, $text, $value, $default) {
    foreach ($db as $data) {
        if ($data[$value] == $default) {
            $par_sel = 'selected';
        } else {
            $par_sel = '';
        }
        $option[] = '<option value="' . $data[$value] . '" ' . $par_sel . '>' . $data[$text] . '</option>';
    }
    return implode(' ', $option);
}

function bulan_indo($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Januari"; break;
            case 2:
                return "Februari"; break;
            case 3:
                return "Maret"; break;
            case 4:
                return "April"; break;
            case 5:
                return "Mei"; break;
            case 6:
                return "Juni"; break;
            case 7:
                return "Juli"; break;
            case 8:
                return "Agustus"; break;
            case 9:
                return "September"; break;
            case 10:
                return "Oktober"; break;
            case 11:
                return "November"; break;
            case 12:
                return "Desember"; break;
        }
    }

function tglwaktu_indo($tglwaktu)
{
    $hari = array ( 1 =>    'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            );
    $num = date('N', strtotime($tglwaktu));

    $tglBaru=explode(" ",$tglwaktu); //memecah berdasarkan spaasi
     
    $tglBaru1=$tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
    $tglBaru2=$tglBaru[1]; //mendapatkan fotmat hh:ii:ss
    $tglBarua=explode("-",$tglBaru1); //lalu memecah variabel berdasarkan -
 
    $tgl=$tglBarua[2];
    $bln=$tglBarua[1];
    $thn=$tglBarua[0];
 
    $bln=bulan_indo($bln); //mengganti bulan angka menjadi text dari fungsi bulan
    $ubahTanggal="$hari[$num], $tgl $bln $thn jam $tglBaru2 "; //hasil akhir tanggal
 
    return $ubahTanggal;
}

function tgl_indo($tgl)
    {
        $hari = array ( 1 =>    'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            );
        $num = date('N', strtotime($tgl));

        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);  //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = bulan_indo($pecah[1]); // cari nama bulan dari fungsi bulan diatas
        $tahun = $pecah[0];
        return $hari[$num].', '.$tanggal.' '.$bulan.' '.$tahun; //hasil akhir
    }

function hanya_tgl_indo($tgl)
    {        
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$tgl);  //memecah variabel berdasarkan -
        $tanggal = $pecah[0];
        $bulan = bulan_indo($pecah[1]); // cari nama bulan dari fungsi bulan diatas
        $tahun = $pecah[2];
        return $tanggal.' '.$bulan.' '.$tahun; //hasil akhir
    }

function bulan($bln) {
    $bulan = array(
        '1' => 'JANUARI',
        '2' => 'FEBRUARI',
        '3' => 'MARET',
        '4' => 'APRIL',
        '5' => 'MEI',
        '6' => 'JUNI',
        '7' => 'JULI',
        '8' => 'AGUSTUS',
        '9' => 'SEPTEMBER',
        '10' => 'OKTOBER',
        '11' => 'NOVEMBER',
        '12' => 'DESEMBER',
    );
    return $bulan[$bln];
}

function ket_nilai($nilai) {
    if ($nilai <= 50) {
        return "Buruk-0-50";
    } elseif ($nilai <= 60) {
        return "Kurang-51-60";
    } elseif ($nilai <= 75) {
        return "Cukup-61-75";
    } elseif ($nilai <= 90) {
        return "Baik-76-90";
    } else {
        return "Sangat Baik-91-100";
    }
}

function ket_range($nilai) {
    switch ($nilai) {
        case "Buruk":
            return "50 Kebawah";
            break;
        case "Kurang":
            return "51 - 60";
            break;
        case "Cukup":
            return "61 - 75";
            break;
        case "Baik":
            return "76 - 90";
            break;
        default:
            return "91 - 100";
            break;
    }
}

// MODEL 1
    function encrypt($s) {
        $cryptKey = 'da1243ty';
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $s, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        //$qEncoded = base64_encode($s);
        return urlencode($qEncoded);
    }

    function decrypt($s) {
        $cryptKey = 'da1243ty';
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($s), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return urldecode($qDecoded);   
    }

    // END MODEL 1

// MODEL 2
    function encryptnew($str) {
        $kunci = 'da1243ty';
        $hasil = '';
        for ($i=0; $i <= strlen($str); $i++) {
            $karakter = substr($str, $i,1);
            $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1,1);
            $karakter = chr(ord($karakter)+ord($kuncikarakter));
            $hasil .= $karakter;
        }
        return urlencode(base64_encode($hasil));
    }

    function decryptnew($str) {
        $str = base64_decode(urldecode($str));
        $hasil = '';
        $kunci = 'da1243ty';
        for ($i=0; $i <= strlen($str); $i++) {
            $karakter = substr($str, $i,1);
            $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1,1);
            $karakter = chr(ord($karakter)+ord($kuncikarakter));
            $hasil .= $karakter;
        }
        return $hasil;
    }

    // END MODEL 2
