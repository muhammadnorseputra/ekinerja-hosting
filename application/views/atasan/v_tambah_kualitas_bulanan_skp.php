<style>
    td{
        vertical-align: middle !important;
    }    .SB{
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
<div style="text-align: center;font-weight: bold;">Kegiatan <?= $nama ?> Bulan <?= bulan($data_periode['bulan']) ?> Tahun <?= $data_periode['tahun'] ?></div>
<bold>Kegiatan Bulanan :  <?= $bulanan['kegiatan'] ?></bold>
<br/><br/>
<?php
$ttl_kegiatan = $harian['ttl_all'];
// $ttl_sesuai = $harian['ttl_sesuai'];
$kegiatan = $harian['kegiatan'];
$kegiatan_sb = $harian['kegiatan_sb'];
$kegiatan_baik = $harian['kegiatan_baik'];
$kegiatan_cukup = $harian['kegiatan_cukup'];
$kegiatan_kurang = $harian['kegiatan_kurang'];
$kegiatan_buruk = $harian['kegiatan_buruk'];
$kegiatan_bv = $harian['kegiatan_bv'];
$prod = $prod['ttl'];
$nilai_1 = (($kegiatan_sb*100)+($kegiatan_baik*90)+($kegiatan_cukup*75)+($kegiatan_kurang*60)+($kegiatan_buruk*50))/$kegiatan;
//$nilai_2 = ($ttl_kegiatan + $prod) == 0 ? 0 : $ttl_kegiatan / ($ttl_kegiatan + $prod) * 100;
$nilai_3 = ($ttl_kegiatan / 26.3 * 100) > 100 ? 100 : $ttl_kegiatan / 26.3 * 100;
$nilai_bulanan = ($nilai_1 + $nilai_3) / 2;
$ket = explode("-", ket_nilai($nilai_bulanan));
?>
<input type="hidden" id="bawah" value="<?= $ket[1] ?>">
<input type="hidden" id="atas" value="<?= $ket[2] ?>">
<table class="table table-bordered">
    <thead class=" ui-state-default" style="text-align: center;">
        <tr>
            <td colspan="2">Persentase Kesesuaian Laporan Kinerja SKP</td>
           
            <td colspan="2">Jumlah Kegiatan Laporan Kinerja SKP</td>
        </tr>
    </thead>
    <tbody style="background: white;">
        <tr>
            <td>Jumlah Kegiatan</td>
            <td><?= $kegiatan ?> Kegiatan</td>
          
            <td rowspan="7">Jml Kegiatan Harian SKP</td>
            <td rowspan="7"><?= $ttl_kegiatan ?> Kegiatan</td>

        </tr>
        <tr>
            <td class="SB">Sangat Baik</td>
            <td><?= $kegiatan_sb ?>  Kegiatan</td>
        </tr>
        <tr>
            <td class="Baik">Baik</td>
            <td><?= $kegiatan_baik ?>  Kegiatan</td>
        </tr>
        <tr>
            <td class="Cukup">Cukup</td>
            <td><?= $kegiatan_cukup ?>  Kegiatan</td>
        </tr>
        <tr>
            <td class="Kurang">Kurang</td>
            <td><?= $kegiatan_kurang ?>  Kegiatan</td>
        </tr>
        <tr>
            <td class="Buruk">Buruk</td>
            <td><?= $kegiatan_buruk ?>  Kegiatan</td>
        </tr>
        <tr>
            <td class="BV">Belum Verifikasi</td>
            <td><?= $kegiatan_bv ?>  Kegiatan</td>
        </tr>
        <tr>
            <td><bold>Nilai Verifikasi</bold></td>
<td><bold> <?= number_format($nilai_1, 2) ?>   %</bold></td>

<td><bold>Nilai</bold></td>
<td><bold>  <?= number_format($nilai_3, 2) ?>  %</bold></td>
</tr>

</tbody>
<tfoot class="ui-state-default">
    <tr>
        <td colspan="2">Nilai Kinerja Bulanan</td>
        <td><?= number_format($nilai_bulanan, 2) ?></td>
        <td colspan="2">(<?= $ket[0] ?>)</td>
    </tr>
    <tr>
        <td colspan="2">Range Penilaian Anda</td>
        <td colspan="2" ><?= ket_range($ket[0]) ?></td>

    </tr>
</tfoot>
</table>
<form method="post" id="frmKualitas">
    <input type="hidden" id="id2" name="id" value="<?= $id ?>"/>
    <input type="hidden" id="id"  value="<?= $id2 ?>"/>
    <input type="hidden" name="keterangan"  value="<?= $keterangan ?>"/>
    <table style="width: 100%">
        <tr>
            <td>
                Nilai
            </td>
            <td colspan="2"><input type="text" class="form-control" maxlength="3" id="nilai" name="realisasi_kualitas" style="width: 100px;" value="<?= $bulanan['realisasi_kualitas'] ?>"></td>
        </tr>
        <tr>
            <td>
                Catatan
            </td>
            <td colspan="2">
                <textarea class="form-control" name="catatan" style="width:300px;"><?= $bulanan['catatan'] ?></textarea></td>
        </tr>
    </table>
</form>
<button class="btn btn-danger" onclick="$('.close').click()">Batal</button>
<button class="btn btn-primary btn-simpan" onclick="$('#frmKualitas').submit()" disabled>Simpan</button>
<script>
    $("#frmKualitas").submit(function (e) {
        e.preventDefault();
        var id = $("#id").val();
        var frm_kualitas = $("#frmKualitas");
        var form = getFormData(frm_kualitas);
        $.ajax({
            type: "POST",
            url: "c_atasan/aksi_kualitas_bulanan",
            data: JSON.stringify(form),
            dataType: 'json'
        }).done(function (response) {
            if (response.status === 1) {
                alert(response.ket);
                $('.close').click();
                menu('c_atasan/realisasi_bulanan_bawahan' + '/' + id);
            } else {
                alert(response.ket);
            }
        });
    });

    $('#nilai').on('change', function () {
        var atas = parseInt($('#atas').val());
        var bawah = parseInt($('#bawah').val());
        var nilai = parseInt($(this).val());

        if (nilai < bawah) {
            alert("Silahkan Nilai dengan Rentang Nilai " + bawah + " - " + atas);
            $(this).val(bawah);
            $('.btn-simpan').attr('disabled', false);
        } else if (nilai > atas) {
            alert("Silahkan Nilai dengan Rentang Nilai " + bawah + " - " + atas);
            $(this).val(atas);
            $('.btn-simpan').attr('disabled', false);
        } else {
            $('.btn-simpan').attr('disabled', false);
        }
    });
</script>