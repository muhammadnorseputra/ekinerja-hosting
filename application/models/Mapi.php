<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapi extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /*
    public function get_skpbulan_bynip($nip, $thn, $bln)
    {
        $q = $this->db->query("select nip, tahun, bulan, nilai_skp from opmt_bulanan_skp where nip='".$nip."' and tahun='".$thn."' and bulan='".$bln."'");

        if ($q->num_rows()>0)
        {
            return $q->result();
        } else {
            return 'Data tidak ditemukan';    
        }     

        

        //$query = $this->db->get("opmt_bulanan_skp");
        //return $query->result();
    }
    */

    public function get_skp_tahunan($nip, $thn)
    {
        $q = $this->db->query("select nip, tahun, bulan, nilai_skp from opmt_bulanan_skp where nip='".$nip."' and tahun='".$thn."'");

        if ($q->num_rows()>0)
        {
            return $q->result();
        } else {
            return false;
        }     

        

        //$query = $this->db->get("opmt_bulanan_skp");
        //return $query->result();
    }

    /*
    // Tanpa PDO
    public function get_skp_blnunker($thn, $bln, $uk)
    {
         $q = $this->db->query("select du.nip, j.jabatan, ob.tahun, ob.bulan, ob.nilai_skp from tbljabatan as j, dd_user as du left join opmt_bulanan_skp as ob on ob.nip=du.nip and ob.tahun='".$thn."' and ob.bulan='".$bln."' where du.unit_kerja='".$uk."' and du.jabatan=j.kodejab and ob.nilai_skp != 0 order by ob.nilai_skp desc");

        if ($q->num_rows()>0)
        {
            return $q->result();
        } else {
            return "Data tidak ditemukan";    
        }     
    }
    */

    // dengan PDO
    public function get_skp_blnunker($thn, $bln, $uk)
    {
        //$q = $this->db->query("select ob.nip, ob.tahun, ob.bulan, ob.nilai_skp from opmt_bulanan_skp as ob, dd_user as du where ob.nip=du.nip and du.unit_kerja='".$uk."' and ob.tahun='".$thn."' and ob.bulan='".$bln."'");

        $query = $this->db->query("select du.nip, j.jabatan, ob.tahun, ob.bulan, ob.nilai_skp from tbljabatan as j, dd_user as du left join opmt_bulanan_skp as ob on ob.nip=du.nip and ob.tahun='".$thn."' and ob.bulan='".$bln."' where du.unit_kerja='".$uk."' and du.jabatan=j.kodejab order by ob.nilai_skp desc");

        /*
        $this->db->from("dd_user as du");
        $this->db->from("tbljabatan as j");
        $this->db->select("du.nip, du.nama, j.jabatan, ob.tahun, ob.bulan, ob.nilai_skp");
        $this->db->join("opmt_bulanan_skp as ob", "ob.nip=du.nip AND ob.tahun={$thn} AND ob.bulan={$bln}", "LEFT");
        $this->db->where("du.jabatan=j.kodejab");
        $this->db->where("du.unit_kerja={$uk}");
        $this->db->where("ob.nilai_skp != 0");
        */      

        /*
        $this->db->from($this->table);
        $this->db->select("a.nama,a.nip,b.unitkerja,d.Lokasi");
        $this->db->join('tblstruktural b', 'a.unit_kerja=b.kodeunit', 'INNER');
        $this->db->join("tblrekaptk c", 'c.nip=a.nip', 'LEFT');
        $this->db->join("tbllokasikerja d", 'c.kodelokasi=d.KodeLokasi', 'LEFT');
        $this->db->join("opmt_bulanan_skp e", "e.id_dd_user=a.id_dd_user AND nilai_skp is NULL AND e.bulan={$bulan} AND e.tahun={$tahun}", 'LEFT');
        $this->db->where("e.id_opmt_bulanan_skp is null");
        */

        //$query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return "Data tidak ditemukan";    
        }     
    }

    public function get_skp_blnnip($thn, $bln, $nip)
    {
        $query = $this->db->query("select bs.nip, du.nama, tj.jabatan, ts.unitkerja,
                                    (select nip from dd_user where id_dd_user = du.atasan_langsung) as nip_atasan,
                                    (select nama from dd_user where id_dd_user = du.atasan_langsung) as nama_atasan,
                                    bs.tahun, bs.bulan, bs.nilai_skp, du.login_terakhir
                                    from opmt_bulanan_skp as bs, dd_user as du, tbljabatan as tj, tblstruktural as ts
                                    where 
                                    bs.id_dd_user = du.id_dd_user
                                    and du.jabatan = tj.kodejab
                                    and du.unit_kerja = ts.kodeunit
                                    and bs.nip='".$nip."' 
                                    and bs.tahun = '".$thn."'
                                    and bs.bulan = '".$bln."'");

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return "Data tidak ditemukan";    
        }     
    }

    public function get_skp_thnnip($thn, $nip)
    {
        $query = $this->db->query("select u.nip, avg(rt.nilai) as nilai from opmt_realisasi_tahunan_skp as rt, opmt_tahunan_skp as t, dd_user as u where rt.id_opmt_tahunan_skp = t.id_opmt_tahunan_skp and t.awal_periode_skp like '".$thn."%' and t.akhir_periode_skp like '".$thn."%' and u.id_dd_user = rt.id_dd_user and u.id_dd_user = t.id_dd_user and u.nip='".$nip."'");

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return "Data tidak ditemukan";    
        }     
    }

    public function get_skp_periodenip($thn, $nip)
    {
        $query = $this->db->query("select u.nip, t.awal_periode_skp, t.akhir_periode_skp, rt.nilai, tj.jabatan, ts.unitkerja,
                                    (select nip from dd_user where id_dd_user = u.atasan_langsung) as nip_atasan,
                                    (select nama from dd_user where id_dd_user = u.atasan_langsung) as nama_atasan
                                    from opmt_realisasi_tahunan_skp as rt, opmt_tahunan_skp as t, dd_user as u, tbljabatan as tj, tblstruktural as ts
                                    where rt.id_opmt_tahunan_skp = t.id_opmt_tahunan_skp and t.awal_periode_skp like '".$thn."%' and t.akhir_periode_skp like '".$thn."%' and u.id_dd_user = rt.id_dd_user and u.id_dd_user = t.id_dd_user and u.nip='".$nip."' and u.jabatan = tj.kodejab and u.unit_kerja = ts.kodeunit");

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return "Data tidak ditemukan";    
        }     
    }


}
