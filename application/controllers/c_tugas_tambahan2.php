<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_tugas_tambahan2 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("M_database");
    }

    public function index() {
        $x['tahun'] = $this->db->query("SELECT DISTINCT YEAR(tanggal) tahun FROM opmt_tugas_tambahan")->result_array();
        $this->load->view('tugas_tambahan/v_table_skp2', $x);
    }

    public function tambah_tugas_tambahan() {
        $x['dt_kuantitas'] = $this->db->order_by('satuan_kuantitas', 'ASC')->get('dd_kuantitas')->result_array();
        $this->load->view('tugas_tambahan/v_tambah_tugas_tambahan', $x);
    }

    public function tambah_tugas_tambahan_harian() {
        $id_user = $this->session->userdata('id_user');
        $x['tugas_tambahan'] = $this->db->order_by('nama_tugas_tambahan', 'ASC')->where('id_dd_user', $id_user)->get('opmt_tugas_tambahan2')->result();
        $this->load->view('tugas_tambahan/v_tambah_tugas_tambahan_harian', $x);
    }

    public function getNoSK() {
        $id = $this->input->post('id');
        $get = $this->db->where("id_opmt_tugas_tambahan2", $id)->get("opmt_tugas_tambahan2")->row();
        echo $get->no_sk;
    }

    public function ubah_tugas_tambahan($id) {
        $x['tugas'] = $this->db->query("SELECT * FROM opmt_tugas_tambahan2 WHERE id_opmt_tugas_tambahan2={$id}")->row_array();
        $this->load->view('tugas_tambahan/v_tambah_tugas_tambahan', $x);
    }

    public function ubah_tugas_tambahan_harian($id) {
        $x['tugas_tambahan'] = $this->db->order_by('nama_tugas_tambahan', 'ASC')->get('opmt_tugas_tambahan2')->result();
        $x['tugas'] = $this->db->query("SELECT * FROM opmt_tugas_tambahan2_harian a inner join opmt_tugas_tambahan2 b on a.id_opmt_tugas_tambahan2=b.id_opmt_tugas_tambahan2 WHERE id_opmt_tugas_tambahan2_harian={$id}")->row_array();
        $this->load->view('tugas_tambahan/v_tambah_tugas_tambahan_harian', $x);
    }

    public function hapus_tugas_tambahan() {
        $id = $this->input->post('id');
        $hapus = $this->M_database->hapus_data('opmt_tugas_tambahan2', 'id_opmt_tugas_tambahan2', $id);
        if ($hapus) {
            $a ['status'] = 1;
            $a['ket'] = "Data Berhasil Dihapus";
        }
        $this->j($a);
    }

    public function hapus_tugas_tambahan_harian() {
        $id = $this->input->post('id');
        $hapus = $this->M_database->hapus_data('opmt_tugas_tambahan2_harian', 'id_opmt_tugas_tambahan2_harian', $id);
        if ($hapus) {
            $a ['status'] = 1;
            $a['ket'] = "Data Berhasil Dihapus";
        }
        $this->j($a);
    }

    public function aksi_tugas_tambahan() {
        $p = json_decode(file_get_contents('php://input'));
        $p->id_dd_user = $this->session->userdata('id_user');
        if ($p->id_opmt_tugas_tambahan2 == '') {
            unset($p->id_opmt_tugas_tambahan2);
            $cek = $this->M_database->tambah_data('opmt_tugas_tambahan2', $p);
        } else {
            $cek = $this->M_database->ubah_data('opmt_tugas_tambahan2', 'id_opmt_tugas_tambahan2', $p->id_opmt_tugas_tambahan2, $p);
        }
        if ($cek) {
            $a['status'] = 1;
            $a['ket'] = 'Tugas Tambahan berhasil diubah';
            $this->j($a);
        } else {
            $a['status'] = 0;
            $a['ket'] = 'Tugas Tambahan gagal diubah';
            $this->j($a);
        }
    }

    public function aksi_tugas_tambahan_harian() {
        $p = json_decode(file_get_contents('php://input'));
        $p->id_dd_user = $this->session->userdata('id_user');
        if ($p->id_opmt_tugas_tambahan2_harian == '') {
            unset($p->id_opmt_tugas_tambahan2_harian);
            $cek = $this->M_database->tambah_data('opmt_tugas_tambahan2_harian', $p);
        } else {
            $cek = $this->M_database->ubah_data('opmt_tugas_tambahan2_harian', 'id_opmt_tugas_tambahan2_harian', $p->id_opmt_tugas_tambahan2_harian, $p);
        }
        if ($cek) {
            $a['status'] = 1;
            $a['ket'] = 'Tugas Tambahan Harian berhasil diubah';
            $this->j($a);
        } else {
            $a['status'] = 0;
            $a['ket'] = 'Tugas Tambahan Harian gagal diubah';
            $this->j($a);
        }
    }

    public function harian() {
        $x['tahun'] = $this->db->query("SELECT DISTINCT YEAR(tanggal) tahun FROM opmt_tugas_tambahan")->result_array();
        $this->load->view('tugas_tambahan/v_table_skp3', $x);
    }

    public function bawahan() {
        $x['tahun'] = $this->db->query("SELECT distinct year(tanggal) tahun FROM opmt_realisasi_tugas_tambahan")->result_array();
        $this->load->view('tugas_tambahan/v_table_skp_bawahan', $x);
    }

    public function ajax_list() {
        $this->load->model('M_tugas_tambahan2', 'tugas_tambahan');
        $tahun = $this->input->post('tahun');
        //'kode_bank','nomor_rekening','nomor_akad','tgl_akad','nama','nik','nomor_sp','tgl_terbit_sp','nilai_dijamin','waktu_kirim','log_message'
        $list = $this->tugas_tambahan->get_datatables($tahun);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dt) {
            $no++;

            $link_edit = '<a href="javascript:void(0)" onclick="ubah_tugas_tambahan(' . $dt->id_opmt_tugas_tambahan2 . ')">
<i class="fa fa-pencil text-success"/>
</a>';
            $link_hapus = '<a href="javascript:void(0)" onclick="hapus_tugas_tambahan(' . $dt->id_opmt_tugas_tambahan2 . ')">
<i class="fa fa-trash text-danger"/>
</a>';
            $row = array();
            $row[] = $no;
            $row[] = $dt->tahun;
            $row[] = $dt->nama_tugas_tambahan;
            $row[] = $dt->no_sk;
            $row[] = $link_edit;
            $row[] = $link_hapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tugas_tambahan->count_all($tahun),
            "recordsFiltered" => $this->tugas_tambahan->count_filtered($tahun),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list2() {
        $this->load->model('M_tugas_tambahan3', 'tugas_tambahan');
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        //'kode_bank','nomor_rekening','nomor_akad','tgl_akad','nama','nik','nomor_sp','tgl_terbit_sp','nilai_dijamin','waktu_kirim','log_message'
        $list = $this->tugas_tambahan->get_datatables($tanggal,$bulan);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dt) {
            $no++;

            $link_edit = '<a href="javascript:void(0)" onclick="ubah_tugas_tambahan_harian(' . $dt->id_opmt_tugas_tambahan2_harian . ')">
<i class="fa fa-pencil text-success"/>
</a>';
            $link_hapus = '<a href="javascript:void(0)" onclick="hapus_tugas_tambahan_harian(' . $dt->id_opmt_tugas_tambahan2_harian . ')">
<i class="fa fa-trash text-danger"/>
</a>';
            $row = array();
            $row[] = $no;
            $row[] = date('d M Y', strtotime($dt->tanggal));
            $row[] = $dt->nama_tugas_tambahan;
            $row[] = $dt->no_sk;
            $row[] = $dt->laporan_harian_tugas_tambahan;
            $row[] = $link_edit;
            $row[] = $link_hapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tugas_tambahan->count_all($tanggal,$bulan),
            "recordsFiltered" => $this->tugas_tambahan->count_filtered($tanggal,$bulan),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function j($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}
