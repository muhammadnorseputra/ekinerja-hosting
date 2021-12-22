<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_tugas_tambahan3 extends CI_Model {

    var $table = 'opmt_tugas_tambahan2_harian a';
    var $column_order = array(null, 'tahun', 'nama_tugas_tambahan'); //set column field database for datatable orderable
    var $column_search = array('tahun', 'nama_tugas_tambahan', 'laporan_harian_tugas_tambahan'); //set column field database for datatable searchable 
    var $order = array('tanggal' => 'desc'); // default order 

    public function __construct() {
        parent::__construct();
        $this->db->_protect_identifiers = false;
        $this->load->database();
    }

    private function _get_datatables_query($tanggal, $bulan) {
        $id_user = $this->session->userdata('id_user');
			
        if ($tanggal>0) {
            $this->db->where("tanggal", $tanggal);
        }
        $this->db->where('month(tanggal)', $bulan);
        $this->db->where('a.id_dd_user', $id_user);
        $this->db->from($this->table);
        $this->db->join("opmt_tugas_tambahan2 b", "a.id_opmt_tugas_tambahan2=b.id_opmt_tugas_tambahan2", "INNER");
        $i = 0;

        foreach ($this->column_search as $item) { // loop column 
            if (!empty($_POST['search']['value'])) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($tanggal,$bulan) {
        $this->_get_datatables_query($tanggal,$bulan);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($tanggal,$bulan) {
        $this->_get_datatables_query($tanggal,$bulan);
        $query = $this->db->count_all_results();
        return $query;
    }

    public function count_all($tanggal,$bulan) {
        $id_user = $this->session->userdata('id_user');
        $tahun = $this->input->get('tahun');

        $this->db->where('month(tanggal)', $bulan);
        if ($tanggal !== "") {
            $this->db->where("tanggal", $tanggal);
        }
        $this->db->where('a.id_dd_user', $id_user);

        $this->db->from($this->table);
        $this->db->join("opmt_tugas_tambahan2 b", "a.id_opmt_tugas_tambahan2=b.id_opmt_tugas_tambahan2", "INNER");
        return $this->db->count_all_results();
    }

}
