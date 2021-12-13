<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class C_api extends CI_Controller {

    function __construct() {

        parent::__construct();
        //load model web
        $this->load->model('M_api');
    }

    public function index()
    {
    
    }
    
    
    function bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
            case 13: //khusus untuk menampilkan info BUP bulan 12 (desemeber) dgn TMT bulan 1 (januari) tahun berikutnya
                return "Januari";
                break;
        }
    }

    public function get_skpbulan()
    {
        $query = $this->db->get("opmt_bulanan_skp");
        return $query->result();
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

    //http://localhost/expneo-baru/index.php/c_api/get_nilaiskp_bulan?nip=198104072009041002&thn=2019&bln=4
    /*
    function get_nilaiskp_bulan() {        
        $nip = $this->input->get('nip');
        $thn = $this->input->get('thn');
        $bln = $this->input->get('bln');
        $sql = "select nip, tahun, bulan, nilai_skp from opmt_bulanan_skp where nip='$nip' and tahun='$thn' and bulan='$bln'";
        $hasil = $this->db->query($sql)->result();
        $response['hasil'] = $hasil;
        header('Content-Type: application/json');
        echo json_encode($response,TRUE);   
    }
    */

    // menghasilkan json dengan banyak hasil dalam bentuk array
    //http://localhost/expneo-baru/index.php/c_api/get_skpbulan?nip=198104072009041002&thn=2019&bln=4
    /*
    function get_skp_bulan() {
        $nip = htmlspecialchars($this->input->get('n'));
        $nipd = $this->decrypt($nip); // decrypt nip
    
        $thn = htmlspecialchars($this->input->get('t'));
        $bln = htmlspecialchars($this->input->get('b'));

        //get data dari model
        $nilai = $this->M_api->get_skpbulan_bynip($nipd, $thn, $bln);
        //masukkan data kedalam variabel
        $data['nilai'] = $nilai;
        //deklarasi variabel array
        $response = array();
        $posts = array();
        //lopping data dari database
        foreach ($nilai as $hasil)
        {
            $posts[] = array(
                //"nip"       =>  $hasil->nip,
                //"tahun"     =>  $hasil->tahun,
                //"bulan"     =>  $hasil->bulan,
                "nilai_skp" =>  $hasil->nilai_skp
            );
        }
        $response['hasil'] = $posts;
        header('Content-Type: application/json');
        echo json_encode($response,TRUE);
    }
    */

    //http://localhost/expneo-baru/index.php/c_api/get_skp_tahunan?nip=198104072009041002&thn=2019
    /*
    function get_skp_tahunan() {
        $nip = htmlspecialchars($this->input->get('nip'));
        $thn = htmlspecialchars($this->input->get('thn'));

        //get data dari model
        $nilai = $this->M_api->get_skp_tahunan($nip, $thn);
        if ($nilai) {
            //masukkan data kedalam variabel
            $data['nilai'] = $nilai;
            //deklarasi variabel array
            //$response = array();
            $posts = array();
            //lopping data dari database
            foreach ($nilai as $hasil)
            {
                // jika di-enkripsi
                //$enkrip = $this->encrypt($hasil->nilai_skp);    
                //$dekrip = $this->decryptnew($enkrip);
    
                $posts[] = array(
                    "nip"                 =>  $nip,
                    "tahun"               =>  $hasil->tahun,
                    "bulan"               =>  bulan($hasil->bulan),
                    "nilai_skp"           =>  strval(round($hasil->nilai_skp,2))
                );
            }
            //$response['hasil'] = $posts;
            header('Content-Type: application/json');
            echo json_encode($posts,TRUE);
        } else {
            $posts[] = array();
        
            header('Content-Type: application/json');
            echo json_encode($posts,TRUE);
        }
    }
    */

    // untuk webservice hasilnya json dengan ARRAY 1 LAPIS
    
    /*function get_skp_blnunker() {
        $thn = htmlspecialchars($this->input->get('thn'));
        $bln = htmlspecialchars($this->input->get('bln'));
        $unker = htmlspecialchars($this->input->get('uk'));

        //get data dari model
        $nilai = $this->M_api->get_skp_blnunker($thn, $bln, $unker);
        //masukkan data kedalam variabel
        $data['nilai'] = $nilai;
        //deklarasi variabel array
        //$response = array(); // jika mneggunakan nested array (array 2 lapis)
        $posts = array();
        //lopping data dari database
        foreach ($nilai as $hasil)
        {
            //$enk_nip = $this->encrypt($hasil->nip);    
            //$enk_skp = $this->encrypt($hasil->nilai_skp);

            $posts[] = array(
                //"nip"                 =>  $enk_nip,
                "nip"                 =>  $hasil->nip,
                "nama"                 =>  $hasil->nama,
                "jabatan"                 =>  $hasil->jabatan,
                "tahun"               =>  $hasil->tahun,
                "bulan"               =>  $hasil->bulan,
                //"nilai_skp"           =>  $enk_skp
                "nilai_skp"           =>  strval(round($hasil->nilai_skp,2))
            );
        }
        //$response['hasil'] = $posts;
        $response = $posts;
        header('Content-Type: application/json');
        echo json_encode($response,TRUE);
    }
    */
    
    // untuk webservice ke SILKA, hasilnya json dengan ARRAY 2 LAPIS
    function get_skp_blnunker_silka() {
        $thn = $this->input->get('thn');
        $bln = $this->input->get('bln');
        $unker = $this->input->get('uk');

        //get data dari model
        $nilai = $this->M_api->get_skp_blnunker($thn, $bln, $unker);
        //masukkan data kedalam variabel
        $data['nilai'] = $nilai;
        //deklarasi variabel array
        $response = array();
        $posts = array();
        //lopping data dari database
        if ($nilai != "Data tidak ditemukan") {
            foreach ($nilai as $hasil)
            {
                //$enk_nip = $this->encrypt($hasil->nip);    
                //$enk_skp = $this->encrypt($hasil->nilai_skp);

                $posts[] = array(
                    //"nip"                 =>  $enk_nip,
                    "nip"                 =>  $hasil->nip,
                    "jabatan"                 =>  $hasil->jabatan,
                    "tahun"               =>  $hasil->tahun,
                    "bulan"               =>  $hasil->bulan,
                    //"nilai_skp"           =>  $enk_skp
                    "nilai_skp"           =>  $hasil->nilai_skp
                );
            }
        
        $response['hasil'] = $posts;
        header('Content-Type: application/json');
        echo json_encode($response,TRUE);
        }        
    }
    
    
    function get_skp_blnnip_silka() {
        $thn = $this->input->get('thn');
        $bln = $this->input->get('bln');
        $nip = $this->input->get('nip');

        $nilai = $this->M_api->get_skp_blnnip($thn, $bln, $nip);
        $data['nilai'] = $nilai;
        $response = array();
        $posts = array();
        //lopping data dari database
        if ($nilai != "Data tidak ditemukan") {
            foreach ($nilai as $hasil)
            {
                $posts[] = array(
                    "nip"           => $hasil->nip,
                    "nama"          => $hasil->nama,
                    "jabatan"       => $hasil->jabatan,
                    "unit_kerja"    => $hasil->unitkerja,
                    "nip_atasan"    => $hasil->nip_atasan,
                    "nama_atasan"   => $hasil->nama_atasan,
                    "tahun"         => $hasil->tahun,
                    "bulan"         => $hasil->bulan,
                    "nilai_skp"     => $hasil->nilai_skp,
                    "login_terakhir"=> $hasil->login_terakhir
                );
            }
        
        $response['hasil'] = $posts;
        header('Content-Type: application/json');
        echo json_encode($response,TRUE);
        }        
    }
    
    function get_skp_thnnip_silka() {
        //http://localhost/expneo-baru/index.php/c_api/get_skp_thnnip_silka?thn='.$thn.'&nip='.$nip
        $thn = $this->input->get('thn');
        $nip = $this->input->get('nip');

        $nilai = $this->M_api->get_skp_thnnip($thn, $nip);
        $data['nilai'] = $nilai;
        $response = array();
        $posts = array();
        //lopping data dari database
        if ($nilai != "Data tidak ditemukan") {
            foreach ($nilai as $hasil)
            {
                $posts[] = array(
                    "nip"           => $hasil->nip,
                    "nilai"     => $hasil->nilai
                );
            }
        
        $response['hasil'] = $posts;
        header('Content-Type: application/json');
        echo json_encode($response,TRUE);
        }        
    }
    
}

/* End of file admin.php */
/* Location: ./application/controllers/C_api.php */