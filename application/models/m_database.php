<?php
class M_database extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Ambil 1 Data biasanya digunakan untuk edit
    public function get_single_data_q($q) {
        return $this->db->query($q)->row_array();
    }

    public function get_data_q($q) {

        return $this->db->query($q)->result_array();
    }

    public function get_data_list($table, $sort, $order) {

        return $this->db->from($table)->order_by($sort, $order)->get()->result_array();
    }

    public function get_single_data($table, $where, $id) {

        return $this->db->from($table)->where($where, $id)->get()->row_array();
    }

    public function get_data($table, $where, $id) {
        return $this->db->from($table)->where($where, $id)->get()->result_array();
    }

    public function get_data2($select, $table, $par_where, $par_join) {
        $this->db->select($select);
        $this->db->from($table);
        $cek_where = count($par_where);
        if ($cek_where > 0) {
            for ($i = 0; $i < $cek_where; $i++) {
                $this->db->where($par_where[$i]['where'], $par_where[$i]['value']);
            }
        }
        $cek_join = count($par_join);
        if ($cek_join > 0) {
            for ($i = 0; $i < $cek_join; $i++) {
                $this->db->join($par_join[$i]['table'], $par_join[$i]['on'], $par_join[$i]['type']);
            }
        }
        return $this->db->get()->result_array();
    }

    public function tambah_data($table, $data) {
        $tambah = $this->db->insert($table, $data);
        if ($tambah) {
            return $this->db->insert_id();
        }
    }

    public function ubah_data($table, $where, $id, $data) {

        $this->db->where($where, $id);
        return $this->db->update($table, $data);
    }

    public function hapus_data($table, $where, $id) {

        $this->db->where($where, $id);
        return $this->db->delete($table);
    }

    public function query_no_return($q) {

        return $this->db->query($q);
    }

    public function list_data($select, $table, $par_join, $par_where, $cari, $txt, $limit, $offset, $sort, $order, $group_by) {

        // Periksa apa ada select per kolom
        if ($select !== '') {
            $this->db->select($select);
        }
        $this->db->from($table);
        // Cek ada data yang dijoin atau tidak ?
        $cek_join = count($par_join);
        if ($cek_join > 0) {
            for ($i = 0; $i < $cek_join; $i++) {
                $this->db->join($par_join[$i]['table'], $par_join[$i]['on'], $par_join[$i]['type']);
            }
        }
        // Cek ada kondisi atau tidak ?
        $cek_where = count($par_where);
        if ($cek_where > 0) {
            for ($i = 0; $i < $cek_where; $i++) {
                $this->db->where($par_where[$i]['where'], $par_where[$i]['value']);
            }
        }

        if ($txt !== "") {
            $this->db->LIKE('upper(' . $cari . ')', strtoupper($txt));
        }

        if ($group_by !== "") {
            $this->db->group_by($group_by);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($sort, $order);
        return $this->db->get()->result_array();
    }

    public function ttl_data($table, $par_join, $par_where, $cari, $txt, $group_by) {
//	$par_join=array();
        $group_by = '';
        $this->db->from($table);
        // Cek ada data yang dijoin atau tidak ?
        $cek_join = count($par_join);
        if ($cek_join > 0) {
            for ($i = 0; $i < $cek_join; $i++) {
                $this->db->join($par_join[$i]['table'], $par_join[$i]['on'], $par_join[$i]['type']);
            }
        }
        $cek_where = count($par_where);
        if ($cek_where > 0) {
            for ($i = 0; $i < $cek_where; $i++) {
                $this->db->where($par_where[$i]['where'], $par_where[$i]['value']);
            }
        }
        if ($txt !== "") {
            $this->db->LIKE('upper(' . $cari . ')', strtoupper($txt));
        }
        if ($group_by !== "") {
            $this->db->group_by($group_by);
        }
        return $this->db->count_all_results();
    }

    public function list_data_2($select, $table, $par_join, $par_where, $cari, $txt, $cari2, $txt2, $limit, $offset, $sort, $order, $group_by) {

        // Periksa apa ada select per kolom
        if ($select !== '') {
            $this->db->select($select);
        }
        $this->db->from($table);
        // Cek ada data yang dijoin atau tidak ?
        $cek_join = count($par_join);
        if ($cek_join > 0) {
            for ($i = 0; $i < $cek_join; $i++) {
                $this->db->join($par_join[$i]['table'], $par_join[$i]['on'], $par_join[$i]['type']);
            }
        }
        // Cek ada kondisi atau tidak ?
        $cek_where = count($par_where);
        if ($cek_where > 0) {
            for ($i = 0; $i < $cek_where; $i++) {
                $this->db->where($par_where[$i]['where'], $par_where[$i]['value']);
            }
        }

        if ($txt !== "") {
            $this->db->LIKE('upper(' . $cari . ')', strtoupper($txt));
        }
        if ($txt2 !== "") {
            $this->db->LIKE('upper(' . $cari2 . ')', strtoupper($txt2));
        }

        if ($group_by !== "") {
            $this->db->group_by($group_by);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by($sort, $order);
        return $this->db->get()->result_array();
    }

    public function ttl_data_2($table, $par_join, $par_where, $cari, $txt, $cari2, $txt2, $group_by) {
        $par_join = array();
        $group_by = '';
        $this->db->from($table);
        // Cek ada data yang dijoin atau tidak ?
        $cek_join = count($par_join);
        if ($cek_join > 0) {
            for ($i = 0; $i < $cek_join; $i++) {
                $this->db->join($par_join[$i]['table'], $par_join[$i]['on'], $par_join[$i]['type']);
            }
        }
        $cek_where = count($par_where);
        if ($cek_where > 0) {
            for ($i = 0; $i < $cek_where; $i++) {
                $this->db->where($par_where[$i]['where'], $par_where[$i]['value']);
            }
        }
        if ($txt !== "") {
            $this->db->LIKE('upper(' . $cari . ')', strtoupper($txt));
        }
        if ($txt2 !== "") {
            $this->db->LIKE('upper(' . $cari2 . ')', strtoupper($txt2));
        }
        if ($group_by !== "") {
            $this->db->group_by($group_by);
        }
        return $this->db->count_all_results();
    }

    public function ttl_data2($table, $par_join, $par_where, $cari, $txt, $group_by) {

        $group_by = '';
        $this->db->from($table);
        // Cek ada data yang dijoin atau tidak ?
        $cek_join = count($par_join);
        if ($cek_join > 0) {
            for ($i = 0; $i < $cek_join; $i++) {
                $this->db->join($par_join[$i]['table'], $par_join[$i]['on'], $par_join[$i]['type']);
            }
        }
        $cek_where = count($par_where);
        if ($cek_where > 0) {
            for ($i = 0; $i < $cek_where; $i++) {
                $this->db->where($par_where[$i]['where'], $par_where[$i]['value']);
            }
        }
        if ($txt !== "") {
            $this->db->LIKE('upper(' . $cari . ')', strtoupper($txt));
        }
        if ($group_by !== "") {
            $this->db->group_by($group_by);
        }
        return $this->db->count_all_results();
    }

    public function get_sertifikat($nama, $jabatan) {
        $this->db->select("id_dd_sertifikat as id,nip,nama,concat(no_sertifikat,'-',keterangan) as label,rtrim(nama) as value");
        $this->db->from('dd_sertifikat');
        $this->db->where('id_dd_jabatan', $jabatan);
        $this->db->like('no_sertifikat', $nama);
        $this->db->order_by('value', 'ASC');
        $get = $this->db->get();
        return $get->result();
    }

    public function get_nip($nip) {

        $get = $this->db->query("SELECT `id_dd_user` AS id, `nip`, `nama`, CONCAT(nip, '-', nama) AS label, RTRIM(nama) AS value
FROM (`dd_user`)
WHERE unit_kerja >0 AND `nip` LIKE '%{$nip}%'
ORDER BY `value` ASC");
        return $get->result();
    }
    
    // TAMBAHAN PERBAIKAN
    
    // untuk menyesuaikan realisasi waktu bulanan sesuai jumlah entri harian
    function getjmlharian($id_dd_user, $id_opmt_target_bulanan_skp)
      {
        //$sess_nip = $this->session->userdata('nip');
        $q = $this->db->query("select tanggal as jml from opmt_realisasi_harian_skp where id_dd_user = '$id_dd_user' and id_opmt_target_bulanan_skp = '$id_opmt_target_bulanan_skp' GROUP BY tanggal");
        
        return $q->num_rows;
      }
      
    // untuk mendapatkan jumlah laporan harian per tanggal
    function getjmllaporanpertanggal($id_dd_user, $tanggal)
      {
        $q = $this->db->query("select count(tanggal) as jml from opmt_realisasi_harian_skp where id_dd_user = '$id_dd_user' and tanggal = '$tanggal' group by tanggal");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->jml;
        }
      } 

    function get_dduser($id_opmt_realisasi_harian_skp)
      {
        //$sess_nip = $this->session->userdata('nip');
        $q = $this->db->query("select id_dd_user from opmt_realisasi_harian_skp where id_opmt_realisasi_harian_skp = '$id_opmt_realisasi_harian_skp'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->id_dd_user;
        }
      } 

    function get_opmt_target_bulanan_skp($id_opmt_realisasi_harian_skp)
      {
        //$sess_nip = $this->session->userdata('nip');
        $q = $this->db->query("select id_opmt_target_bulanan_skp from opmt_realisasi_harian_skp where id_opmt_realisasi_harian_skp = '$id_opmt_realisasi_harian_skp'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->id_opmt_target_bulanan_skp;
        }
      } 

    function edit_opmt_target_bulanan_skp($where, $data){
        $this->db->where($where);
        $this->db->update('opmt_target_bulanan_skp',$data);
        return true;
    }

    function get_opmt_turunan_skp($kegiatan, $id_dd_user, $id_opmt_target_bulanan_skp)
      {
        //$sess_nip = $this->session->userdata('nip');
        $q = $this->db->query("select id_opmt_turunan_skp from opmt_turunan_skp where kegiatan_turunan = '$kegiatan' and id_dd_user = '$id_dd_user' and id_opmt_target_bulanan_skp = '$id_opmt_target_bulanan_skp'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->id_opmt_turunan_skp;
        }
      } 

    function get_turunan($id_opmt_realisasi_harian_skp)
      {
        //$sess_nip = $this->session->userdata('nip');
        $q = $this->db->query("select turunan from opmt_realisasi_harian_skp where id_opmt_realisasi_harian_skp = '$id_opmt_realisasi_harian_skp'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->turunan;
        }
      } 

    function edit_opmt_turunan_skp($where, $data){
        $this->db->where($where);
        $this->db->update('opmt_turunan_skp',$data);
        return true;
    }

    function get_realisasi_kualitas($id_dd_user, $id_opmt_target_bulanan_skp)
      {
        //$sess_nip = $this->session->userdata('nip');
        $q = $this->db->query("select realisasi_kualitas from opmt_target_bulanan_skp where id_dd_user = '$id_dd_user' and id_opmt_target_bulanan_skp = '$id_opmt_target_bulanan_skp'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->realisasi_kualitas;
        }
      } 
    
    // END TAMBAHAN PERBAIKAN

    
    // Untuk entri waktu H, H-1, H-2
    function get_tgllapharian($id_dd_user, $id)
      {
        $q = $this->db->query("select tanggal from opmt_realisasi_harian_skp where id_dd_user = '$id_dd_user' and id_opmt_realisasi_harian_skp = '$id'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->tanggal;
        }
      } 
      
    function datetime_saatini()
      {
        $q = $this->db->query("select now() as saatini");
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->saatini; 
        }        
      }

    // get jumlah SKP target bulanan berdasarkan id_opmt_bulanan_skp
    function getjmlbulanan($id_dd_user, $id_opmt_bulanan_skp)
      {
        //$sess_nip = $this->session->userdata('nip');
        $q = $this->db->query("select target_kuantitas from opmt_target_bulanan_skp where id_opmt_bulanan_skp = '$id_opmt_bulanan_skp' and id_dd_user = '$id_dd_user'");
        
        return $q->num_rows;
      }
    
    // get jumlah SKP target bulanan berdasarkan opmt_target_bulanan_skp
    function getjmlbulanan_pertahunan($id_dd_user, $id_opmt_target_skp)
      {
        //$sess_nip = $this->session->userdata('nip');
        $q = $this->db->query("select target_kuantitas from opmt_target_bulanan_skp where id_opmt_target_skp = '$id_opmt_target_skp' and id_dd_user = '$id_dd_user'");
        
        return $q->num_rows;
      }
      
    // get jumlah SKP target tahunan berdasarkan id_opmt_tahunan_skp
    function getjmltahunan($id_dd_user, $id_opmt_tahunan_skp)
      {
        //$sess_nip = $this->session->userdata('nip');
        $q = $this->db->query("select target_kuantitas from opmt_target_skp where id_opmt_tahunan_skp = '$id_opmt_tahunan_skp' and id_dd_user = '$id_dd_user'");
        
        return $q->num_rows;
      }
      
    // Get nama dari tabel dd_user
    function get_nama($nip)
      {
        $q = $this->db->query("select nama from dd_user where nip='$nip'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->nama;
        }
      } 
      
    function getjmlhariannonproses_perbulan($id_dd_user, $id_opmt_target_skp, $tanggal)
      {
        $q = $this->db->query("select sum(kuantitas) as jml from opmt_realisasi_harian_skp where id_opmt_target_skp = '$id_opmt_target_skp' and id_dd_user = '$id_dd_user' and tanggal like '$tanggal%' and proses='0' and turunan='0'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->jml;
        }
      } 

    function getjmlharianproses_perbulan($id_dd_user, $id_opmt_target_skp, $tanggal)
      {
        $q = $this->db->query("select sum(kuantitas) as jml from opmt_realisasi_harian_skp where id_opmt_target_skp = '$id_opmt_target_skp' and id_dd_user = '$id_dd_user' and tanggal like '$tanggal%' and proses='0' and turunan='1'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->jml;
        }
      }
      
    function get_kodejabatan($jnsjabsilka, $jabsilka)
      {
        $q = $this->db->query("select kodejab from tbljabatan where id_jnsjabsilka='".$jnsjabsilka."' and id_jabsilka='".$jabsilka."'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->kodejab;
        }
      }

    function get_kodeunit($idsilka)
      {
        $q = $this->db->query("select kodeunit from tblstruktural where id_silka='".$idsilka."'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->kodeunit;
        }
      } 


    function get_autosilka($nip)
      {
        $q = $this->db->query("select autosilka from dd_user where nip='".$nip."'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->autosilka;
        }
      } 


    function get_tglentribulanan($id_opmt_target_bulanan_skp)
      {
        $q = $this->db->query("select tgl_entri from opmt_target_bulanan_skp where id_opmt_target_bulanan_skp = '$id_opmt_target_bulanan_skp'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->tgl_entri;
        }
      }
      
    function get_tglentrilapharian($id_dd_user, $id)
      {
        $q = $this->db->query("select tgl_entri_laporan from opmt_realisasi_harian_skp where id_dd_user = '$id_dd_user' and id_opmt_realisasi_harian_skp = '$id'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->tgl_entri_laporan;
        }
      }
      
    function get_opmtbulanan($id)
    { 
        //$q = $this->db->query("select * from opmt_bulanan_skp where id_opmt_bulanan_skp='".$id."'");  
        $q = $this->db->query("select u.nip, o.tahun, o.bulan, o.nilai_skp, j.jabatan, s.unitkerja, u.login_terakhir, (select nama from dd_user where id_dd_user = u.atasan_langsung) as atasan
            from dd_user as u, opmt_bulanan_skp as o, tbljabatan as j, tblstruktural as s
            where o.id_opmt_bulanan_skp='".$id."' and u.jabatan = j.kodejab and u.unit_kerja = s.kodeunit and u.id_dd_user = o.id_dd_user");  
        return $q;
    }

    function get_jab($nip)
      {
        $q = $this->db->query("select j.jabatan from dd_user as d, tbljabatan as j where d.jabatan = j.kodejab and d.nip='".$nip."'");
        
        if ($q->num_rows()>0)
        {
          $row=$q->row();
          return $row->jabatan;
        }
      }
    
}
