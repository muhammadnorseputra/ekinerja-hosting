<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_bulanan_skp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_bulanan_skp', 'skp');
        $this->load->model('M_bulanan_skp_bawahan', 'skp_bawahan');
    }

    public function index() {
        $this->load->helper('url');
        $this->load->view('bulanan_skp/v_table_skp');
    }

    public function target($id) {
        $data['id'] = $id;
        $this->load->view('bulanan_skp/v_table_target_skp', $data);
    }

    public function bawahan() {
        $this->load->helper('url');
        $id_user = $this->session->userdata('id_user');
        $data['bawahan_cat'] = $this->db->query("SELECT * FROM dd_user WHERE atasan_langsung='{$id_user}'")->result_array();
        $data['tahun_cat'] = $this->db->query("SELECT distinct tahun FROM opmt_bulanan_skp")->result_array();
        $this->load->view('bulanan_skp/v_table_skp_bawahan',$data);
    }

    public function tambah_catatan($id) {
        $data['id'] = $id;
        $data['catatan'] = $this->db->where('id_opmt_bulanan_skp', $id)->get('opmt_bulanan_skp')->row_array();
        $this->load->view('bulanan_skp/v_catatan', $data);
    }

    public function aksi_ubah_catatan() {
        $this->load->model("M_database");
        $p = json_decode(file_get_contents('php://input'));
        $cek = $this->M_database->ubah_data('opmt_bulanan_skp', 'id_opmt_bulanan_skp', $p->id_opmt_bulanan_skp, $p);
        if ($cek) {
            $a['status'] = 1;
            $a['ket'] = 'Catatan berhasil diubah';
            $this->j($a);
        } else {
            $a['status'] = 0;
            $a['ket'] = 'Catatan gagal diubah';
            $this->j($a);
        }
    }

    public function ajax_list() {
        $this->load->model('M_database');
        $status = $this->input->post('status');
        //'kode_bank','nomor_rekening','nomor_akad','tgl_akad','nama','nik','nomor_sp','tgl_terbit_sp','nilai_dijamin','waktu_kirim','log_message'
        $list = $this->skp->get_datatables($status);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dt) {
            $no++;
            $link_edit = '<a href="javascript:void(0)" onclick="ubah_bulanan_skp(' . $dt->id_opmt_bulanan_skp . ')">
<i class="fa fa-pencil fa-2x text-success"/></a>';
            $link_hapus = '<a href="javascript:void(0)" onclick="hapus_bulanan_skp(' . $dt->id_opmt_bulanan_skp . ')">
<i class="fa fa-trash fa-2x text-danger"/></a>';
            $link_target_skp = '<a href="javascript:void(0)" onclick="target_bulanan_skp(' . $dt->id_opmt_bulanan_skp . ')">
<i class="fa fa-crosshairs fa-2x text-danger"/></a>';
            $link_realisasi = '<a href="javascript:void(0)" onclick="realisasi_bulanan_skp(' . $dt->id_opmt_bulanan_skp . ')">
<i class="fa fa-dashboard fa-2x text-success"/></a>';
            $row = array();
            $row[] = $no;
            //$row[] = $dt->tahun;
            //$row[] = bulan($dt->bulan);
            
            if ($dt->tgl_entri == NULL) {
                $tglentri = '';
            } else {
                $tglentri = tglwaktu_indo($dt->tgl_entri);
            } 
            $row[] = '<small>'.$tglentri.'</small>';
            
            $row[] = bulan($dt->bulan)." ".$dt->tahun;
                
            $row[] = number_format($dt->nilai_skp, 2);
            //$row[] = $link_hapus;
            
            // START untuk tombol HAPUS
            $jmlbulanan = $this->M_database->getjmlbulanan($dt->id_dd_user, $dt->id_opmt_bulanan_skp);
            if ($jmlbulanan == 0) { 
                $row[] = $link_hapus;
            } else {
                $row[] = "<i class='fa fa-ban fa-2x text-muted' />";
            }
            // END untuk tombol HAPUS
            
            $row[] = $link_target_skp;
            $row[] = $link_realisasi;
            $row[] = $dt->nilai_skp > 0 ? 'DISETUJUI' : 'BELUM DISETUJUI';
            
            // START di-approve oleh
            if ($dt->tgl_approve == NULL) {
                $tglapprove = '';
            } else {
                $tglapprove = tglwaktu_indo($dt->tgl_approve);
            }

            if ($dt->nip_atasan_approve == NULL) {
                $atasan = '';
            } else {
                $atasan = $this->M_database->get_nama($dt->nip_atasan_approve);
            }

            $row[] = '<small>'.$atasan.'<br/>'.$tglapprove.'</small>';
            // END di-approve oleh
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->skp->count_all($status),
            "recordsFiltered" => $this->skp->count_filtered($status),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_target() {
        $this->load->model('M_bulanan_target_skp', 'skp_target');
        $nama = $this->input->post('nama');
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $list = $this->skp_target->get_datatables($id, $status);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dt) {
            $no++;
            $link_edit = '<a href="javascript:void(0)" onclick="ubah_target_bulanan_skp(' . $dt->id_opmt_target_skp . ')">
<i class="fa fa-pencil text-success"/>
</a>';
            $link_hapus = '<a href="javascript:void(0)" onclick="hapus_target_bulanan_skp(' . $dt->id_opmt_target_skp . ')">
<i class="fa fa-trash text-danger"/></a>';

            $row = array();
            $row[] = $no;
            $row[] = $dt->tahun;
            $row[] = $dt->kegiatan_bulanan;
            $row[] = $dt->target_kuantitas . " " . $dt->satuan_kuantitas;
            $row[] = 100;
            $row[] = $dt->target_waktu . " bulan";
            $row[] = number_format($dt->biaya);
            $row[] = $link_edit;
            $row[] = $link_hapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->skp_target->count_all($id, $status),
            "recordsFiltered" => $this->skp_target->count_filtered($id, $status),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_bawahan() {
        $nama = $this->input->post('nama');
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        //'kode_bank','nomor_rekening','nomor_akad','tgl_akad','nama','nik','nomor_sp','tgl_terbit_sp','nilai_dijamin','waktu_kirim','log_message'
        $list = $this->skp_bawahan->get_datatables($nama, $tahun, $bulan);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dt) {
            $no++;
            $link_catatan = '<a href="javascript:void(0)" onclick="catatan_bulanan(' . $dt->id_opmt_bulanan_skp . ')">
<i class="fa fa-pencil text-success"/></a>';
            $link_kualitas = '<a href="javascript:void(0)" onclick="realisasi_bulanan(' . $dt->id_opmt_bulanan_skp . ')">
<i class="fa fa-pencil text-success"/></a>';
            $row = array();
            $row[] = $no;
            //$row[] = bulan($dt->bulan);
            //$row[] = $dt->tahun;
            
            $row[] = bulan($dt->bulan)." ".$dt->tahun;
            if ($dt->tgl_entri == NULL) {
                $tglentri = '';
            } else {
                $tglentri = tglwaktu_indo($dt->tgl_entri);
            } 
            $row[] = '<small>'.$tglentri.'</small>';
            
            $row[] = $dt->nilai_skp > 0 ? 'Disetujui' : 'Belum Disetujui';
            $row[] = $dt->nama.' - NIP. '.$dt->nip;
            $row[] = $link_catatan;
            $row[] = $link_kualitas;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->skp_bawahan->count_all($nama, $tahun, $bulan),
            "recordsFiltered" => $this->skp_bawahan->count_filtered($nama, $tahun, $bulan),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function update_bulanan_skp() {
        $this->load->model('M_database');
        $id = $this->input->post('id');
        $nilai = $this->input->post('nilai');
        
        // START untuk Approval
        $nipatasan = $this->session->userdata('nip');
        $tglapproval = $this->M_database->datetime_saatini();
        // END Approval
        
        /*
        // Code lama tidak integrasi simpan ke SILKa
        $this->db->where('id_opmt_bulanan_skp', $id);
        
        //$data = array('nilai_skp' => $nilai);
        $data = array('nilai_skp' => $nilai, 'tgl_approve' => $tglapproval, 'nip_atasan_approve' => $nipatasan);
        
        $update = $this->db->update('opmt_bulanan_skp', $data);
        if ($update) {
            $a['status'] = 1;
            $a['ket'] = "Realisasi SKP Bulanan Berhasil Diupdate";
        }
        $this->j($a);
        */
        
        $this->db->where('id_opmt_bulanan_skp', $id);
        //$data = array('nilai_skp' => $nilai);
        $data = array('nilai_skp' => $nilai, 'tgl_approve' => $tglapproval, 'nip_atasan_approve' => $nipatasan);

        $update = $this->db->update('opmt_bulanan_skp', $data);        
        if ($update) {  
            $a['status'] = 1;
            $data1 = $this->M_database->get_opmtbulanan($id)->result_array();
            //var_dump($data1);
            foreach($data1 as $v):
                $jabatan = str_replace(" ","%20",$v['jabatan']);
                $unitkerja = str_replace(" ","%20",$v['unitkerja']);
                $login_terakhir = str_replace(" ","%20",$v['login_terakhir']);
                $atasan = str_replace(" ","%20",$v['atasan']);
                
                //$url = "http://localhost/silka/index.php/api/save_skpbln?nip=".$v['nip']."&th=".$v['tahun']."&bl=".$v['bulan']."&nil=".$v['nilai_skp']."&jab=".$v['jabatan']."&uk=".$v['unitkerja']."&lo=".$v['login_terakhir']."&at=".$v['atasan'];
                $url = "http://silka.bkppd-balangankab.info/api/save_skpbln?nip=".$v['nip']."&th=".$v['tahun']."&bl=".$v['bulan']."&nil=".$v['nilai_skp']."&jab=".$jabatan."&uk=".$unitkerja."&lo=".$login_terakhir."&at=".$atasan;
                
                //http://localhost/silka/index.php/api/save_skpbln?nip=198104072009041002&th=2021&bl=1&nil=92&jab=jabatan&uk=bkppd&lo=2021-01-01&at=atasan
            endforeach;
            $konten = file_get_contents($url);
            $api = json_decode($konten);
            if ($api) {
                foreach($api->hasil as $d) :
                    // Cek apakah simpan ke SILKa berhasil
                    $nama = $this->M_database->get_nama($v['nip']);
                    if ($d->res == "1") {
                        $a['ket'] = 'Realisasi Bulanan <span class=text-danger>'.$nama.'</span> berhasil di-Approve dan disimpan pada SILKa';
                        $this->j($a);
                    } else {
                        $a['ket'] = 'Realisasi Bulanan <span class=text-danger>'.$nama.'</span> berhasil di-Approve tapi <b>GAGAL</b> disimpan pada SILKa';
                        $this->j($a);
                    }
                endforeach;
            }    
            
        } else {
            $a['status'] = 0;
            $a['ket'] = 'Data Realisasi Bulanan GAGAL di-Approve';
            $this->j($a);
        }
    }

    public function realisasi_bulanan_bawahan($id) {
        $data["id"] = $id;
        $periode = $this->db->query("SELECT * FROM opmt_bulanan_skp a LEFT JOIN dd_user b on a.id_dd_user=b.id_dd_user WHERE id_opmt_bulanan_skp={$id}")->row_array();
        $data['periode'] = $periode;
        $data['disposisi'] = $this->db->query("SELECT * FROM opmt_disposisi WHERE month(tanggal_disposisi)={$periode['bulan']} AND id_dd_user={$periode['id_dd_user']}")->result_array();
        $q = "SELECT * FROM(
SELECT a.id_opmt_target_bulanan_skp id,a.id_opmt_target_bulanan_skp,b.id_opmt_bulanan_skp,a.id_opmt_target_skp,b.tahun,d.kegiatan_tahunan kegiatan,a.turunan,a.target_kuantitas,a.realisasi_biaya,c.satuan_kuantitas,a.realisasi_kualitas,a.target_waktu,a.biaya,'utama' ket,a.realisasi_waktu,a.catatan
FROM (`opmt_target_bulanan_skp` a) 
INNER JOIN `opmt_bulanan_skp` b ON `b`.`id_opmt_bulanan_skp`=`a`.`id_opmt_bulanan_skp` AND b.id_opmt_bulanan_skp={$id}
INNER JOIN `opmt_target_skp` d ON `d`.`id_opmt_target_skp`=`a`.`id_opmt_target_skp` 
LEFT JOIN `dd_kuantitas` c ON `c`.`id_dd_kuantitas`=`a`.`satuan_kuantitas` 
 UNION ALL
 SELECT d.id_opmt_turunan_skp,e.id_opmt_target_bulanan_skp,f.id_opmt_bulanan_skp,e.id_opmt_target_skp,f.tahun,d.kegiatan_turunan,' ',d.target_kuantitas,d.realisasi_biaya,g.satuan_kuantitas,d.realisasi_kualitas,d.target_waktu,d.biaya,'turunan' ket,d.realisasi_waktu,d.catatan
 FROM opmt_turunan_skp d
 INNER JOIN opmt_target_bulanan_skp e on e.id_opmt_target_bulanan_skp =d.id_opmt_target_bulanan_skp
 INNER JOIN opmt_bulanan_skp f on f.id_opmt_bulanan_skp=e.id_opmt_bulanan_skp AND e.id_opmt_bulanan_skp={$id}
 INNER JOIN `dd_kuantitas` g ON `g`.`id_dd_kuantitas`=`d`.`satuan_kuantitas` 
 ) a LEFT JOIN(
SELECT a.id_opmt_target_bulanan_skp,sum(kuantitas) realisasi_kuantitas
FROM opmt_realisasi_harian_skp a
	WHERE month(a.tanggal)={$periode['bulan']}
	 GROUP BY a.id_opmt_target_bulanan_skp
)b on a.id=b.id_opmt_target_bulanan_skp order by a.id_opmt_target_bulanan_skp";
        $data['realisasi'] = $this->db->query($q)->result_array();
        $this->load->view("atasan/v_realisasi_bulanan", $data);
    }

    public function dt_bulanan_bawahan() {
        $this->benchmark->mark('a');
        $limit = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $nama = $this->input->get('nama');
        $par_sql = " WHERE a.tahun={$tahun} AND a.bulan={$bulan}";
        if ($nama !== "") {
            $par_sql .= " AND b.nama LIKE '%" . $nama . "%'";
        }
        $id_user = $this->session->userdata('id_user');
        $bulanan = $this->db->query("SELECT * FROM opmt_bulanan_skp a INNER JOIN dd_user b on a.id_dd_user=b.id_dd_user AND b.atasan_langsung={$id_user} {$par_sql} LIMIT {$offset},{$limit}")->result_array();
        $ttl_data = $this->db->query("SELECT count(*) ttl FROM opmt_bulanan_skp a INNER JOIN dd_user b on a.id_dd_user=b.id_dd_user AND b.atasan_langsung={$id_user} {$par_sql}")->row_array();
        $ttl = $ttl_data['ttl'];
        $no = $offset + 1;
        foreach ($bulanan as $hsl) {
            $link_kualitas = '<a href="javascript:void(0)" onclick="realisasi_bulanan(' . $hsl['id_opmt_bulanan_skp'] . ')">
<i class="fa fa-pencil text-success"/></a>';
            $status_approve = $hsl['nilai_skp'] > 0 ? 'Disetujui' : 'Belum Disetujui';
            $cek[] = array(
                'no' => $no,
                'link_kualitas' => $link_kualitas,
                'bulan' => $hsl['bulan'],
                'tahun' => $hsl['tahun'],
                'nama' => $hsl['nama'],
                'status_approve' => $status_approve,
            );

            $no++;
        }

        if (empty($cek)) {
            $this->benchmark->mark('b');
            $lama = $this->benchmark->elapsed_time('a', 'b');
            $output = array('total' => 0, 'rows' => array(), 'lama' => $lama);
        } else {
            $this->benchmark->mark('b');
            $lama = $this->benchmark->elapsed_time('a', 'b');
            $output = array('total' => $ttl, 'lama' => $lama, 'rows' => $cek);
        }
        echo json_encode($output);
    }

    public function j($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}
