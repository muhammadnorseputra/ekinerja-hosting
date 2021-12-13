
<style>
    #tbl_rekap td{
        font-size: 12px;
    }
</style>

<div style="font-weight:bold;font-size:18px;text-align:center;">
    <?= $judul1 ?>
</div><br>
<div style="font-weight:bold;font-size:18px;text-align:center;">
    <?= $judul2 ?>
</div><br>
<hr>

<table cellpadding="1" border="0.5" style="border:1px;" id="tbl_rekap" class="table table-bordered" style="width:800px;">
    <thead>
        <tr style="text-align: center;border:1px;background-color:grey;color:black;font-size: 14px;font-weight:bold;">
            <td width="35">No</td>
            <td width="490" colspan="2">I. PEJABAT PENILAI</td>
            <td width="35">No</td>
            <td width="490"colspan="2">II. PNS YANG DINILAI</td>
        </tr>

    </thead>
    <tbody style="font-size: 12px;vertical-align: top;">
        <tr>
            <td align="center">1</td>
            <td>Nama</td>
            <td><?= $atasan['nama'] ?></td>
            <td align="center">1</td>
            <td>Nama</td>
            <td><?= $user['nama'] ?></td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td>NIP</td>
            <td><?= $atasan['nip'] ?></td>
            <td align="center">2</td>
            <td>NIP</td>
            <td><?= $user['nip'] ?></td>
        </tr>
        <tr>
            <td align="center">3</td>
            <td>Pangkat/Gol.Ruang</td>
            <td><?= $atasan['pangkat'] ?></td>
            <td align="center">3</td>
            <td>Pangkat/Gol.Ruang</td>
            <td><?= $user['pangkat'] ?></td>
        </tr>
        <tr height="40">
            <td align="center">4</td>
            <td>Jabatan</td>
            <td width="200" valign="top"><?= $atasan['nama_jabatan'] ?></td>
            <td align="center">4</td>
            <td>Jabatan</td>
            <td width="200"  valign="top"><?= $user['nama_jabatan'] ?></td>
        </tr>
        <tr>
            <td align="center">5</td>
            <td>Unit Kerja</td>
            <td width="200" height="50"><?= $atasan['nama_uker'] ?></td>
            <td align="center">5</td>
            <td>Unit Kerja</td>
            <td width="200" height="50"><?= $user['nama_uker'] ?></td>
        </tr> 
    </tbody>
</table>

<table cellpadding="1" border="0.5" style="border:1px;" id="tbl_rekap" class="table table-bordered">
    <thead>
        <tr style="text-align: center;border:1px;background-color:grey;color:black;font-size: 14px;font-weight:bold;">
            <td width="35" rowspan="2">No</td>
            <td rowspan="2">KEGIATAN TUGAS JABATAN</td>
            <td width="35" rowspan="2">AK</td>
            <td width="490"colspan="4">TARGET</td>
        </tr>
        <tr style="text-align: center;border:1px;background-color:grey;color:black;font-size: 14px;font-weight:bold;">
            <td>KUANTITAS / OUTPUT</td>
            <td>KUALITAS / MUTU</td>
            <td>WAKTU</td>
            <td>BIAYA (Rp.)</td>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($target as $arr) {
            ?>
            <tr>
                <td align="center"><?= $no ?></td>
                <td width="490" ><?= $arr['kegiatan_tahunan'] ?></td>
                <td align="center"><?= round($arr['angka_kredit_total'],4) ?></td>
                <td align="center"><?= $arr['target_kuantitas'] . ' ' . $arr['kuantitas'] ?></td>
                <td align="center"><?= $arr['kualitas'] ?></td>
                <td align="center"><?= $arr['target_waktu'] . ' Bulan' ?></td>
                <td align="right"><?= number_format($arr['biaya']) ?></td>
            </tr>
<?php $no++;} ?>
    </tbody>
</table>
<br>
<table style="width:100%;" style="text-align: center;color:black;font-size: 12px;font-weight:bold;">
    <tr>
        <td width="300"></td>
        <td width="300"></td>
        <td align="center" width="600"><?= $lokasi['lokasi_spesimen'] ?>, <?= hanya_tgl_indo($tanggal) ?></td>
    </tr>
    <tr>
        <td width="300">Pejabat Penilai</td>
        <td width="300"></td>
        <td align="center" width="600">Pegawai Negeri Sipil Yang Dinilai</td>
    </tr>
    <tr style="font-size:40px;"><td>&nbsp;</td><td></td></tr>
    <tr><td><?= strtoupper($atasan['nama']) ?></td><td width="300"></td><td><?= strtoupper($user['nama']) ?></td></tr>

    <tr><td>NIP. <?= $atasan['nip'] ?></td><td width="300"></td><td>NIP. <?= $user['nip'] ?></td></tr>
</table>