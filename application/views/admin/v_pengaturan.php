<?php
if ($atur) {
    $atur['parameter_bulan'] == "0" ? $param = "" : $param = "checked";
    $atur['parameter_approve'] == "0" ? $param2 = "" : $param2 = "checked";
    $atur['parameter_drop'] == "0" ? $param3 = "" : $param3 = "checked";
} else {
    $param = "";
    $param2 = "";
    $param3 = "";
}
?>
<table class="table" style="font-size:14px;">
    <tr><td style="vertical-align: middle;">Disable Bulan dan Tahun</td><td> <input type="checkbox" id="cek_pengaturan" class="form-control" <?= $param ?>></td></tr>
    <tr><td style="vertical-align: middle;">Disable Approval</td><td> <input type="checkbox" id="cek_pengaturan2" class="form-control" <?= $param2 ?>></td></tr>
   <tr><td style="vertical-align: middle;">Disable Drop Target</td><td> <input type="checkbox" id="cek_pengaturan3" class="form-control" <?= $param3 ?>></td></tr>
    <tr><td colspan="2" style="text-align: center;"><button class="btn btn-primary" onclick="$('.close').click();">TUTUP</button></td></tr>
</table>
<script>
    $('#cek_pengaturan,#cek_pengaturan2,#cek_pengaturan3').on('click', function () {
        var cek = $("#cek_pengaturan").is(':checked') ? 1 : 0;
        var cek2 = $("#cek_pengaturan2").is(':checked') ? 1 : 0;
        var cek3 = $("#cek_pengaturan3").is(':checked') ? 1 : 0;
        $.post('c_admin/aksi_pengaturan', {cek: cek, cek2: cek2, cek3: cek3}, function (hasil) {
            if (hasil.status == 1) {
                alert(hasil.ket);
            }
        });
    });
    
</script>