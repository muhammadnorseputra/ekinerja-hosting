<style>
    .judul th {
        text-align: center !important;
    }.tengah{text-align: center;}
    .SB{
        background:blue !important;color:white;font-weight:bold;text-align:center;
    }.Baik{
        background:green !important;color:white;font-weight:bold;text-align:center;
    }.Cukup{
        background:purple !important;color:white;font-weight:bold;text-align:center;
    }.Kurang{
        background:orange !important;color:white;font-weight:bold;text-align:center;
    }.Buruk{
        background:red !important;color:white;font-weight:bold;text-align:center;
    }.BV{
        background:black !important;color:white;font-weight:bold;text-align:center;
    }
</style>
<div class="table-responsive">
<table id="table" class="table table-striped table-bordered" cellspacing="0">
    <thead class="ui-state-default">
        <tr class="judul">
            <th width='25'>No</th>
            <th width='200'>Tgl. Kegiatan Harian<br/>Tgl. Entri Laporan</th>
            <th>Kegiatan Harian SKP<br/><u>SKP Bulanan</u></th>
            <th width='100'>Kuantitas</th>
            <th width='150'>Durasi</th>
            <th width='100'>Proses</th>
            <th width='120'>Verifikasi</th>
            <th width='50'>Edit</th>
            <th width='50'>Hapus</th>
        </tr>
    </thead>
    <tbody>
        <?php
        function ket_verifikasi($nilai){
            switch($nilai){
                case 100:
                return 'Sangat Baik';
                break;
                case 90:
                return 'Baik';
                break;
                case 75:
                return 'Cukup';
                break;
                case 60:
                return 'Kurang';
                break;
                case 50:
                return 'Buruk';
                break;
                default:
                return 'Belum Verifikasi';
                break;
            }
        }
        function class_verifikasi($nilai){
            switch($nilai){
                case 100:
                return 'SB';
                break;
                case 90:
                return 'Baik';
                break;
                case 75:
                return 'Cukup';
                break;
                case 60:
                return 'Kurang';
                break;
                case 50:
                return 'Buruk';
                break;
                default:
                return 'BV';
                break;
            }
        }
        $no = 1;
        $ttl_sesuai = 0;
        foreach ($dt_harian as $dt) {
            if ($dt['verifikasi'] > 0) {
                $ttl_sesuai++;
            }
            $link_edit = '<a href="javascript:void(0)" onclick="ubah_harian(' . $dt['id_opmt_realisasi_harian_skp'] . ')">
<i class="fa fa-2x fa-pencil text-success"/>
</a>';
            $link_hapus = '<a href="javascript:void(0)" onclick="hapus_harian(' . $dt['id_opmt_realisasi_harian_skp'] . ')">
<i class="fa fa-2x fa-trash text-danger"/>
</a>';
            ?>
            <tr>
                <td class="tengah"><?= $no; ?></td>
                <td align='left' width='150'>
                    <?php
                    //echo date('d M Y', strtotime($dt['tanggal']));
                    echo tgl_indo($dt['tanggal']);
                    
                    if ($dt['tgl_entri_laporan'] != NULL) {
                        echo "<br/><small><span class='text-success'>Dilaporkan pada ".
                                tglwaktu_indo($dt['tgl_entri_laporan'])."
                                </span></small>";     
                    }
                    ?>
                </td>

                <td><?= "<b>".$dt['kegiatan_harian_skp']."</b><br/><u>".$dt['kegiatan_bulanan']."</u>"; ?></td>
                <td><?= $dt['kuantitas'] . ' ' . $dt['satuan_kuantitas']; ?></td>
                <?php                    
                    $awal = new DateTime($dt['jam_mulai']);
                    $akhir = new DateTime($dt['jam_selesai']);
                    if ($akhir > $awal) {
                        $diff = $awal->diff($akhir);                        
                        echo "<td>".$dt['jam_mulai']." s/d ".$dt['jam_selesai'];
                        echo "<br/><span class='text-primary'>".$diff->h." Jam, ".$diff->i." Menit</span></td>";
                    } else {
                        echo "<td class='danger'>".$dt['jam_mulai']." s/d ".$dt['jam_selesai'];
                        //echo "<br/><span class='text-danger'><b>Koreksi Waktu</b></span></td>";  
                    }
                                        
                ?>
                
                <td style="text-align: center;font-weight: bold;"><?= $dt['proses'] == 1 ? "Proses" : ""; ?></td>
                <td class='<?= class_verifikasi($dt['verifikasi']);?>'><?=ket_verifikasi($dt['verifikasi']);?></td>
                <td class="tengah"><?= $link_edit; ?></td>
                <td class="tengah"><?= $link_hapus; ?></td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
    <tfoot class="ui-state-default">
    <tr>
            <td colspan="3" class="ui-state-default">
            Jumlah Kegiatan Harian SKP <?= count($dt_harian) . ' Kegiatan' ?></td>
            <td colspan="6" class="ui-state-default">Jumlah Diverifikasi <?= $ttl_sesuai ?> Kegiatan</td>
        </tr>
        <!-- <tr>
            <td colspan="6" class="ui-state-default">Persentase</td>
            <td colspan="3" class="ui-state-default"><?= count($dt_harian) == 0 ? 0 : $ttl_sesuai / count($dt_harian) * 100 ?> %</td>
        </tr> -->
    </tfoot>
</table>
</div>