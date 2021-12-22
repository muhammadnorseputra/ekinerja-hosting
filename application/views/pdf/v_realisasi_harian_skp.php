<style>
   thead th {
        text-align: center !important;
    }.tengah{text-align: center;}
    #table{
         font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  width: 100%;
    }
</style>
<div style="text-align:center;font-weight:bold;font-size:18px;">
LAPORAN HARIAN KINERJA SKP<br>
<?=$nama?> / <?=$nip?> <br>
BULAN <?=bulan($bulan)?> TAHUN <?=$tahun?>
<hr>
</div>
<table id="table" cellpadding="3" border="1" id="tbl_rekap" style="width:800px; border-collapse: collapse;">
    <thead>
        <tr class="judul" style="text-align:center;font-weight:bold;">
            <th style="text-align:center;font-weight:bold;background:blue;color:white;width:40px;">No</th>
            <th style="text-align:center;font-weight:bold;background:blue;color:white;width:100px;">Tanggal</th>
            <th style="text-align:center;font-weight:bold;background:blue;color:white;width:420px;">Kegiatan Harian SKP</th>
            <th style="text-align:center;font-weight:bold;background:blue;color:white;width:420px;">SKP Bulanan</th>
            <th style="text-align:center;font-weight:bold;background:blue;color:white;width:110px;">Kuantitas</th>
            <th style="text-align:center;font-weight:bold;background:blue;color:white;width:70px;">Status Proses</th>
            <th style="text-align:center;font-weight:bold;background:blue;color:white;width:70px;">Status Kesesuaian</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $ttl_sesuai = 0;
        foreach ($dt_harian as $dt) {
            if ($dt['sesuai'] == 1) {
                $ttl_sesuai++;
            }
          
            ?>
            <tr>
                <td class="tengah"><?= $no; ?></td>
                <td class="tengah"><?= date('d M Y', strtotime($dt['tanggal'])); ?></td>
                <td><?= $dt['kegiatan_harian_skp']; ?></td>
                <td><?= $dt['kegiatan_bulanan']; ?></td>
                <td style="text-align: center;"><?= $dt['kuantitas'] . ' ' . $dt['satuan_kuantitas']; ?></td>
                <td style="text-align: center;"><?= $dt['proses'] == 1 ? "Proses" : ""; ?></td>
                <td style="text-align: center;"><?=
                    $dt['sesuai'] == 1 ? "Sesuai" : "";
                    ;
                    ?></td>
          
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>