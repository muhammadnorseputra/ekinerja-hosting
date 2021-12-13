<?php
if (isset($tugas)) {
    $id_opmt_tugas_tambahan2_harian = $tugas['id_opmt_tugas_tambahan2_harian'];
    $id_opmt_tugas_tambahan2 = $tugas['id_opmt_tugas_tambahan2'];
    $tanggal = $tugas['tanggal'];
    $laporan_harian_tugas_tambahan = $tugas['laporan_harian_tugas_tambahan'];
    $no_sk = $tugas['no_sk'];
} else {
    $id_opmt_tugas_tambahan2_harian = "";
    $id_opmt_tugas_tambahan2 = "";
    $tanggal = date('Y-m-d');
    $laporan_harian_tugas_tambahan = "";
    $no_sk = "";

//    $periode_awal = $periode['awal_periode_skp'];
//    $periode_akhir = $periode['akhir_periode_skp'];
}
?>
<style>
    .ui-state-default{
        color:black !important;
        background:blue;
    }td{vertical-align:middle;}
</style>
<div style="text-align: center;font-weight: bold;">Tugas Tambahan Harian</div>
<hr />
<form id="frm_tugas_tambahan" method="post">
    <table class="table">
        <tr>
            <td style="width:150px !important;">Tanggal</td>
            <td> : </td> 
            <td colspan="3">
                <input type="hidden" name="id_opmt_tugas_tambahan2_harian" value="<?= $id_opmt_tugas_tambahan2_harian ?>">
                <input type="text" class="form-control tanggal " value="<?=$tanggal?>" name="tanggal" style="width: 100px;">
            </td>
        </tr>
        <tr>
            <td>Klasifikasi Nama Tugas Tambahan</td>
            <td> : </td> 
            <td colspan="3">
                <select class="form-control" id="id_opmt_tugas_tambahan2" name="id_opmt_tugas_tambahan2">
                    <?php foreach ($tugas_tambahan as $dt) { ?>
                        <option value="<?= $dt->id_opmt_tugas_tambahan2 ?>" <?= $id_opmt_tugas_tambahan2 == $dt->id_opmt_tugas_tambahan2 ? 'selected' : '' ?>><?= $dt->nama_tugas_tambahan ?></option>
                    <?php } ?>
                </select>               

            </td>
        </tr>
        <tr>
            <td>No SK Tugas Tambahan</td>
            <td>:</td>
            <td colspan="3">
                <div id="no_sk"><?=$no_sk?></div>
            </td>
        </tr>
        <tr>
            <td>Lap. Harian Tugas Tambahan</td>
            <td>:</td>
            <td colspan="3">
                <textarea class="form-control" name="laporan_harian_tugas_tambahan"><?= $laporan_harian_tugas_tambahan ?></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td> </td>
            <td><button class="btn btn-primary" >Simpan</button></td>
        </tr>

    </table>
</form>

<script>

    $("#frm_tugas_tambahan").submit(function (e) {
        e.preventDefault();
        var frm_tugas_tambahan = $("#frm_tugas_tambahan");
        var form = getFormData(frm_tugas_tambahan);
        $.ajax({
            type: "POST",
            url: "c_tugas_tambahan2/aksi_tugas_tambahan_harian",
            data: JSON.stringify(form),
            dataType: 'json'
        }).done(function (response) {
            if (response.status === 1) {
                alert(response.ket);
                $('.close').click();
                refresh_tugas_tambahan();
            } else {
                alert(response.ket);
            }
        });

    });
    $('.tanggal').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true
    });

    $('#id_opmt_tugas_tambahan2').on('click', function () {
        $.post('c_tugas_tambahan2/getNoSK', {id: $(this).val()}, function (hasil) {
            $('#no_sk').html(hasil);
        });
    });
</script>