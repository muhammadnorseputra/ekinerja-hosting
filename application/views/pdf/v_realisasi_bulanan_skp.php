<style>
    .table,btn{font-size:12px !important;}.fixed-table-body{height: 200px !important;}
    #tbl_realisasi thead{
        background-color:#006e2e;text-align:center;font-weight:bold;color:black;border:solid 1px black;
    }
    #tbl_realisasi td{
        border:solid 1px black;
    }
</style>
<div class="row">
    <div class="col-lg-12" style="text-align:center;font-weight:bold;font-size:14px;">
        <span>REALISASI SKP BULAN <?= date('M Y', strtotime($periode['tahun'].'-'.$periode['bulan'].'-01')) ?></span>
    </div>
</div>
<div class="row">
    <div class="col-lg-12" style="text-align:center;font-weight:bold;font-size:14px;">
        <span><?= strtoupper($user['nama']) ?></span>
    </div>
</div>
<br>
<table class="table" id="tbl_realisasi">
    <thead class=" ui-state-default ">
        <tr>
            <td class="tengah" rowspan="2" width="50" style="vertical-align: middle;">No</td>
            <td class="tengah" rowspan="2" width="470" style="vertical-align: middle;">Kegiatan Bulanan</td>
            <td colspan="4"width="240">Target</td>
            <td colspan="4"width="240">Realisasi</td>
            <td class="tengah" rowspan="2" width="80" style="vertical-align: middle;">Perhitungan</td>
            <td class="tengah" rowspan="2" width="110" style="vertical-align: middle;">Nilai</td>
            <!--<td class="tengah" rowspan="2" style="vertical-align: middle;">Input Waktu dan Biaya</td>-->
        </tr>
        <tr>
            <td>Kuantitas</td>
            <td>Kualitas</td>
            <td>Waktu</td>
            <td>Biaya</td>
            <td>Kuantitas</td>
            <td>Kualitas</td>
            <td>Waktu</td>
            <td>Biaya</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $no_2 = 'a';
        $par = '';
        $par_id = '';
        $i = 0;
        $k = 0;
        foreach ($realisasi as $real_arr) {
            if ($real_arr['id_dd_user_bawahan'] > 0 && $i > 0 && $real_arr['id_dd_user'] !== $this->session->userdata('id_user')) {
                $no++;
            } elseif ($par_id !== "" && $par_id !== $real_arr['id_opmt_target_bulanan_skp']) {
                $no++;
                $no_2 = 'a';
            }

            if ($real_arr['id_dd_user_bawahan'] == 0 || empty($real_arr['id_dd_user_bawahan'])) {
                $id_opmt_bulanan_skp = $real_arr['id_opmt_bulanan_skp'];
            } else {
                $id_opmt_bulanan_skp = $id;
            }
            if ($real_arr['ket'] == 'utama' && $par == "turunan") {
                //$no++;
                $no_2 = 'a';
            }

            $target_waktu = $real_arr['target_waktu'];
            $real_waktu = $real_arr['realisasi_waktu'];
            $target_kuantitas = $real_arr['target_kuantitas'];
            $realisasi_kuantitas = empty($real_arr['realisasi_kuantitas']) ? '' : $real_arr['realisasi_kuantitas'];
            $target_kualitas = 100;
            $realisasi_kualitas = $real_arr['realisasi_kualitas'];
            $target_waktu = $real_arr['target_waktu'];
            $realisasi_waktu = empty($real_arr['realisasi_waktu']) ? '' : $real_arr['realisasi_waktu'];
            $target_biaya = $real_arr['biaya'];
            $realisasi_biaya = $real_arr['realisasi_biaya'];
            $nilai_kuantitas = ($realisasi_kuantitas==""||$target_kuantitas == 0) ? 0 : ($realisasi_kuantitas / $target_kuantitas) * 100;
            $nilai_kualitas = ($realisasi_kualitas / $target_kualitas) * 100;
            $persentase_waktu = $target_waktu == 0 ? 0 : 100 - ($real_waktu / $target_waktu * 100);
            if ($persentase_waktu <= 24) {
                $nilai_waktu = $target_waktu == 0 ? 0 : ((1.76 * $target_waktu - $real_waktu) / $target_waktu) * 100;
            } else {
                $nilai_waktu = $target_waktu == 0 ? 0 : 76 - ((((1.76 * $target_waktu - $real_waktu) / $target_waktu) * 100) - 100);
            }
            $efisiensi_biaya = $target_biaya == 0 ? 0 : 100 - ($realisasi_biaya / $target_biaya * 100);
            if ($efisiensi_biaya <= 24) {
                $nilai_biaya = $target_biaya == 0 ? 0 : ((1.76 * $target_biaya - $realisasi_biaya) / $target_biaya) * 100;
            } else {
                $nilai_biaya = $target_biaya == 0 ? 0 : 76 - ((((1.76 * $target_biaya - $realisasi_biaya) / $target_biaya) * 100) - 100);
            }
            $perhitungan = $realisasi_kuantitas == "" ? "" : $nilai_biaya + $nilai_waktu + $nilai_kualitas + $nilai_kuantitas;
            if ($target_biaya > 0) {
                $nilai = $perhitungan == "" ? "" : $perhitungan / 4;
            } else {
                $nilai = $perhitungan == "" ? "" : $perhitungan / 3;
            }
            if ($real_arr['target_kuantitas'] > 0) {
                $k++;
            }
            $link_turunan = '<a href="javascript:void(0)" onclick="lihat_turunan(' . $real_arr['id_opmt_target_skp'] . ',' . $real_arr['id'] . ',' . $real_arr['id_opmt_bulanan_skp'] . ')">
<i class="fa fa-pencil text-success"/>
</a>';
            if ($real_arr['realisasi_kuantitas'] > 0) {
                $satuan = $real_arr['satuan_kuantitas'];
            } else {
                $satuan = "";
            }
            ?>
            <tr class="<?= $real_arr['ket'] == 'utama' ? 'judul' : '' ?>">
                <td align="center"> <?php
                    if ($real_arr['id_dd_user_bawahan'] > 0 && $real_arr['id_dd_user'] !== $this->session->userdata('id_user')) {
                        echo $no;
                    } elseif ($par_id !== $real_arr['id_opmt_target_bulanan_skp']) {
                        echo $no;
                    } else {
                        echo $no . '.' . $no_2;
                    }
                    ?>    </td>
                <td><?= $real_arr['kegiatan'] ?></td>
                <td class="tengah"><?= $real_arr['turunan'] == 1 ? "" : $real_arr['target_kuantitas'] . ' ' . $real_arr['satuan_kuantitas'] ?></td>
                <td class="tengah"><?= $real_arr['turunan'] == 1 ? "" : 100 ?></td>
                <td class="tengah"><?= $real_arr['turunan'] == 1 ? "" : $real_arr['target_waktu'] . ' Hari' ?></td>
                <td class="angka"><?= $real_arr['turunan'] == 1 ? "" : number_format($real_arr['biaya']) ?></td>
                <td class="tengah"><?= $real_arr['turunan'] == 1 ? "" : $real_arr['realisasi_kuantitas'] . ' ' . $satuan ?></td>
                <td class="tengah"><?= $real_arr['turunan'] == 1 ? "" : $real_arr['realisasi_kualitas'] ?></td>
                <td class="tengah"><?= $real_arr['turunan'] == 1 ? "" : $real_arr['realisasi_waktu'] . ' Hari' ?></td>
                <td class = "angka"><?= $real_arr['turunan'] == 1 ? "" : number_format($real_arr['realisasi_biaya'])
                    ?></td>
                <td align="center"><?= $perhitungan == "" ? "" : number_format($perhitungan, 2) ?></td>
                <td align="center"><?= $nilai == "" ? "" : number_format($ttl_nilai[] = $nilai, 2) ?></td>
                
            </tr>
            <?php
            if ($real_arr['ket'] == 'turunan') {
                $no_2++;
            }
            $par = $real_arr['ket'];
            $i++;
            $par_id = $real_arr['id_opmt_target_bulanan_skp'];
        }
        ?>
        <tr style="background-color:#dff0d8;text-align: center;font-weight: bold;">
            <td colspan="11">Nilai SKP</td>
            <td><?= ($i == 0 || empty($ttl_nilai)) ? $total_nilai = 0 : number_format($total_nilai = array_sum($ttl_nilai) / $k, 2) ?></td>
            <!--<td></td>-->
        </tr>
        <tr>
            <td colspan="11" style="font-weight:bold;">Disposisi Tugas ( Status : Selesai Dilaksanakan dari Atasan )</td>
            <td></td>
            <!--<td></td>-->
        </tr>
        <?php
        $ttl_tgs = count($disposisi);
        $i = 0;
        $nilai_dsp = 0;
        foreach ($disposisi as $arr2) {
            ?>
            <tr>
                <td colspan="11" align="left" ><?= $arr2['kegiatan'] ?></td>
    <?php if ($i == 0) { ?>
                    <td rowspan="<?= $ttl_tgs ?>" style="vertical-align: middle;text-align: center;"><?= $nilai_dsp = $arr2['status_disposisi_atasan'] == 1 ? 3 : 0; ?></td>
            <?php } ?>
                <!--<td></td>-->
            </tr>
            <?php
            $i++;
        }
        ?>
        <tr style="background-color:#dff0d8;text-align: center;font-weight: bold;">
            <td colspan="11">Total Nilai SKP</td>
            <td><?= number_format($total_nilai + $nilai_dsp, 2) ?></td>
            <!--<td></td>-->
        </tr>
    </tbody>
</table>
<br>
<br>
<table style="width:100%;" style="text-align: center;color:black;font-size: 12px;font-weight:bold;">
    <tr>
        <td width="400"></td>
        <td width="400"></td>
        <td align="center" width="600"><?= $lokasi['lokasi_spesimen'] ?>, <?= date('d M Y') ?></td>
    </tr>
    <tr>
        <td width="400"></td>
        <td width="400"></td>
        <td align="center" width="600">Pejabat Penilai</td>
    </tr>
    <tr style="font-size:58px;"><td>&nbsp;</td><td></td></tr>

    <tr><td></td><td width="300"></td><td><?= $atasan['nama'] ?></td></tr>

    <tr><td></td><td width="300"></td><td><?= $atasan['nip'] ?></td></tr>
</table>