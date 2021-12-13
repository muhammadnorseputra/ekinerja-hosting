<?php

class C_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $jabatan = $this->session->userdata('jabatan');
        $tahun = date('Y');
		
        switch ($jabatan) {
            case 'Staff':
                $id_user = $this->session->userdata('id_user');
                $qSKP = $this->db->query("SELECT month(tanggal)bulan,count(*)total FROm opmt_realisasi_harian_skp a 
		WHERE year(tanggal)={$tahun} AND a.id_dd_user={$id_user} GROUP BY month(tanggal)");
                $qTugas = $this->db->query("SELECT month(a.tanggal) bulan,count(*) total FROM opmt_tugas_tambahan a
WHERE year(tanggal)={$tahun} AND id_dd_user={$id_user} GROUP BY month(a.tanggal)");
                $j = 0;
                $k = 0;
                for ($i = 1; $i <= 12; $i++) {
                    $arrSKP = $qSKP->row_array($j);
                    $arrTugas = $qTugas->row_array($k);
                    if (isset($arrSKP['bulan'])) {
                        if ($i == $arrSKP['bulan']) {
                            $skp[] = $arrSKP['total'];
                        } else {
                            $skp[] = 0;
                        }
                    } else {
                        $skp[] = 0;
                    }
                    if (isset($arrTugas['bulan'])) {
                        if ($i == $arrTugas['bulan']) {
                            $tgs[] = $arrTugas['total'];
                        } else {
                            $tgs[] = 0;
                        }
                    } else {
                        $tgs[] = 0;
                    }

                    $j++;
                    $k++;
                }
                $x['rataSKP'] = $this->db->query("SELECT avg(a.nilai_skp)rata from opmt_bulanan_skp a WHERE a.tahun={$tahun} AND id_dd_user={$id_user} AND a.nilai_skp>0")->row_array();
                $x['data_skp'] = implode(",", $skp);
                $x['data_tugas'] = implode(",", $tgs);
                $this->load->view('dashboard/v_staff', $x);
                break;
            case 'Admin':

                $qSKP = $this->db->query("SELECT month(tanggal)bulan,count(*)total FROm opmt_realisasi_harian_skp a 
				 WHERE year(tanggal)={$tahun}  GROUP BY month(tanggal)");
                $qTugas = $this->db->query("SELECT month(a.tanggal) bulan,count(*) total FROM opmt_tugas_tambahan a
WHERE year(tanggal)={$tahun} GROUP BY month(a.tanggal)");
                $qProd = $this->db->query("SELECT month(a.tanggal) bulan,count(*) total FROM opmt_produktivitas_skp a
WHERE year(tanggal)={$tahun} GROUP BY month(a.tanggal)");
                $j = 0;
                $k = 0;
                $l = 0;
                for ($i = 1; $i <= 12; $i++) {
                    $arrSKP = $qSKP->row_array($j);
                    $arrTugas = $qTugas->row_array($k);
                    $arrProd = $qProd->row_array($l);
                    if (isset($arrSKP['bulan'])) {
                        if ($i == $arrSKP['bulan']) {
                            $skp[] = $arrSKP['total'];
                        } else {
                            $skp[] = 0;
                        }
                    } else {
                        $skp[] = 0;
                    }
                    if (isset($arrTugas['bulan'])) {
                        if ($i == $arrTugas['bulan']) {
                            $tgs[] = $arrTugas['total'];
                        } else {
                            $tgs[] = 0;
                        }
                    } else {
                        $tgs[] = 0;
                    }
                    if (isset($arrProd['bulan'])) {
                        if ($i == $arrProd['bulan']) {
                            $prod[] = $arrProd['total'];
                        } else {
                            $prod[] = 0;
                        }
                    } else {
                        $prod[] = 0;
                    }

                    $j++;
                    $k++;
                    $l++;
                }
                $x['total_skp'] = array_sum($skp);
                $x['total_tgs'] = array_sum($tgs);
                $x['total_prod'] = array_sum($prod);
                $x['rataSKP'] = $this->db->query("SELECT avg(a.nilai_skp)rata from opmt_bulanan_skp a WHERE a.tahun={$tahun} AND a.nilai_skp>0")->row_array();
                $x['data_skp'] = implode(",", $skp);
                $x['data_tugas'] = implode(",", $tgs);
                $x['data_prod'] = implode(",", $prod);
                $this->load->view('dashboard/v_admin', $x);
                break;
            case 'Operator':
                $this->load->view('dashboard/v_operator');
                break;
            default:
                $id_user = $this->session->userdata('id_user');
                $qSKP = $this->db->query("SELECT month(tanggal)bulan,count(*)total FROm opmt_realisasi_harian_skp a 				
 WHERE year(tanggal)={$tahun} AND a.id_dd_user={$id_user}  GROUP BY month(tanggal)");
                $qTugas = $this->db->query("SELECT month(a.tanggal) bulan,count(*) total FROM opmt_tugas_tambahan2_harian a INNER JOIN  opmt_tugas_tambahan2 b ON a.id_opmt_tugas_tambahan2=b.id_opmt_tugas_tambahan2
WHERE year(tanggal)={$tahun} AND a.id_dd_user={$id_user} GROUP BY month(a.tanggal)");
                $qProd = $this->db->query("SELECT month(a.tanggal) bulan,count(*) total FROM opmt_produktivitas_skp a
WHERE year(tanggal)={$tahun} AND id_dd_user={$id_user} GROUP BY month(a.tanggal)");
                $j = 0;
                $k = 0;
                $l = 0;
//die(var_dump($qSKP->row_array(1)));
                for ($i = 1; $i <= 12; $i++) {
                    $arrSKP = $qSKP->row_array($j);
                    $arrTugas = $qTugas->row_array($k);
                    $arrProd = $qProd->row_array($l);
                    if (isset($arrSKP['bulan'])) {
                        if ($i == $arrSKP['bulan']) {
                            $skp[] = $arrSKP['total'];
                            $j++;
                        } else {
                            $skp[] = 0;
                        }
                    } else {
                        $skp[] = 0;
                    }
                    if (isset($arrTugas['bulan'])) {
                        if ($i == $arrTugas['bulan']) {
                            $tgs[] = $arrTugas['total'];
                            $k++;
                        } else {
                            $tgs[] = 0;
                        }
                    } else {
                        $tgs[] = 0;
                    }
                    if (isset($arrProd['bulan'])) {
                        if ($i == $arrProd['bulan']) {
                            $prod[] = $arrProd['total'];
                            $l++;
                        } else {
                            $prod[] = 0;
                        }
                    } else {
                        $prod[] = 0;
                    }
                }
//die(var_dump($skp));
                $x['rataSKP'] = $this->db->query("SELECT avg(a.nilai_skp)rata from opmt_bulanan_skp a WHERE a.tahun={$tahun} AND id_dd_user={$id_user} AND a.nilai_skp>0")->row_array();
                $x['data_skp'] = implode(",", $skp);
                $x['data_tugas'] = implode(",", $tgs);
                $x['data_prod'] = implode(",", $prod);
                $this->load->view('dashboard/v_staff', $x);

                break;
        }
    }

}

?>