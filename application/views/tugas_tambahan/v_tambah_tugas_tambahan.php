<?php
if (isset($tugas)) {
    $id_opmt_tugas_tambahan2 = $tugas['id_opmt_tugas_tambahan2'];
    $tahun = $tugas['tahun'];
    $nama_tugas_tambahan = $tugas['nama_tugas_tambahan'];
    $no_sk = $tugas['no_sk'];
} else {
    $id_opmt_tugas_tambahan2 = "";
    $tahun = date('Y');
    $nama_tugas_tambahan = "";
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
<div style="text-align: center;font-weight: bold;">Tugas Tambahan</div>
<hr />
<form id="frm_tugas_tambahan" method="post">
    <table class="table">
        <tr>
            <td style="width:150px !important;">Tahun</td>
            <td> : </td> 
            <td colspan="3">
                <input type="hidden" name="id_opmt_tugas_tambahan2" value="<?= $id_opmt_tugas_tambahan2 ?>">
                <input type="text" class="form-control " name="tahun" value="<?= $tahun ?>" style="width: 100px;">
            </td>
        </tr>
        <tr>
            <td>Nama Tugas Tambahan</td>
            <td> : </td> 
            <td colspan="3">
                <textarea class="form-control" name="nama_tugas_tambahan"><?= $nama_tugas_tambahan ?></textarea>
            </td>
        </tr>
        <tr>
            <td>No SK</td>
            <td>:</td>
            <td colspan="3">
                <input type="text" class="form-control" name="no_sk" value="<?= $no_sk ?>">
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
            url: "c_tugas_tambahan2/aksi_tugas_tambahan",
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
</script>