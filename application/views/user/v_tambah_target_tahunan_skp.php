<?php
if (isset($target_tahunan_skp)) {
//var_dump($target_tahunan_skp);
    $id_opmt_target_skp = $target_tahunan_skp['id_opmt_target_skp'];
    $kegiatan_tahunan = $target_tahunan_skp['kegiatan_tahunan'];
    $target_kuantitas = $target_tahunan_skp['target_kuantitas'];
    $target_waktu = $target_tahunan_skp['target_waktu'];
    $biaya = $target_tahunan_skp['biaya'];
    $satuan_kuantitas = $target_tahunan_skp['satuan_kuantitas'];
    $id_opmt_tahunan_skp = $target_tahunan_skp['id_opmt_tahunan_skp'];
    $periode_awal = $target_tahunan_skp['awal_periode_skp'];
    $periode_akhir = $target_tahunan_skp['akhir_periode_skp'];
    $id_opmt_target_skp_atasan = $target_tahunan_skp['id_opmt_target_skp_atasan'];
    $cek_80 = $target_tahunan_skp['cek_80'];

 $angka_kredit_total = $target_tahunan_skp['angka_kredit_total'];
$angka_kredit =$angka_kredit_total /$target_kuantitas;
} else {
    $id_opmt_target_skp = "";
    $awal_periode_skp = "";
    $kegiatan_tahunan = "";
    $target_kuantitas = "";
    $target_waktu = "";
    $biaya = "";
    $satuan_kuantitas = "";
    $id_opmt_tahunan_skp = $id;
    $periode_awal = $periode['awal_periode_skp'];
    $periode_akhir = $periode['akhir_periode_skp'];
    $id_opmt_target_skp_atasan = "";
$angka_kredit = "";
$angka_kredit_total="";
$cek_80 ="";
}
?>
<style>
    .ui-state-default{
        color:black !important;
        background:blue;
    }td{vertical-align:middle !important;}
</style>
<div class="row">
    <div class="col-lg-5">
        <form id="frm_target_tahunan_skp" method="post">
            <table class="table">
                <tr>
                    <td>Periode</td>
                    <td> : </td> 
                    <td style="width: 150px;">
                        <input type="hidden" name="id_opmt_tahunan_skp" value="<?= $id_opmt_tahunan_skp ?>">
                        <?= date('d M', strtotime($periode_awal)) . ' - ' . date('d M Y', strtotime($periode_akhir)) ?>
                </tr>
                <tr>
                    <td>SKP Tahunan Atasan</td>
                    <td> : </td>
                    <td colspan="2">
                        <select class="form-control" name="id_opmt_target_skp_atasan">
                            <option value="">Belum Cascading</option>
                            <?php
                            foreach ($dt_skp_tahunan_atasan as $dt) {
                                ?>   
                                <option value="<?= $dt['id_opmt_target_skp'] ?>" <?= $dt['id_opmt_target_skp'] == $id_opmt_target_skp_atasan ? 'selected' : '' ?>><?= $dt['kegiatan_tahunan'] ?></option>
                            <?php }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Kegiatan Tahunan</td>
                    <td> : </td> 
                    <td colspan="3">
                        <input type="hidden" name="id_opmt_target_skp" value="<?= $id_opmt_target_skp ?>">
                        <textarea class="form-control" name="kegiatan_tahunan" id="kegiatan_tahunan"><?= $kegiatan_tahunan ?></textarea></td>
                </tr>
                <tr>
                    <td>Target Kuantitas</td>
                    <td> : </td> 
                    <td style="width: 50px;">
                        <input type="text" class="form-control" onchange="hitung_ak()" name="target_kuantitas" id="target_kuantitas" value="<?= $target_kuantitas ?>"></td>
                    <td>
                        <select class="form-control" name="satuan_kuantitas" id="satuan_kuantitas" style="font-size: 12px;">
                            <?= pilihan_list($dt_kuantitas, 'satuan_kuantitas', 'id_dd_kuantitas', $satuan_kuantitas) ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Angka Kredit</td>
                    <td> : </td> 
                    <td>
                        <input type="text" class="form-control" id="angka_kredit" value="<?=$angka_kredit?>" readonly></td>
                        <td><input type="checkbox" id="cek80" name="cek_80" <?=$cek_80==1?'checked':''?>> 80 %
                        </td>
                </tr>
                <tr>
                    <td>Angka Kredit Total</td>
                    <td> : </td> 
                    <td>
                        <input type="text" class="form-control" name="angka_kredit_total" id="angka_kredit_total" value="<?=$angka_kredit_total?>" readonly>
                        </td>
                </tr>
                <tr>
                    <td>Target Waktu</td>
                    <td> : </td> 
                    <td>

                        <input type="text" class="form-control" name="target_waktu" value="<?= $target_waktu ?>"></td>
                </tr>
                <tr>
                    <td>Biaya</td>
                    <td> : </td> 
                    <td>

                        <input type="text" class="form-control" name="biaya" value="<?= $biaya ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td> </td>
                    <td><button class="btn btn-primary" >Simpan</button></td>
                </tr>

            </table>
        </form>
    </div>
    <div class="col-lg-7" id="tbl_kegiatan">

    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div style="text-align: center;font-weight: bold;font-size: 18px;">RENCANA KERJA TAHUNAN</div>
        <div style="text-align: center;font-weight: bold;font-size: 18px;"><?= $direktorat . ' ' . date('Y', strtotime($periode_awal)) ?></div><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="input-group"><div class="input-group-addon"><b>Rencana Strategis</b></div><select class="form-control" id="rencana_strategis"><?= pilihan_list($rencana, 'sasaran_strategis', 'id_opmt_sasaran_strategis', $default = "") ?></select>

        </div>

    </div>
</div>
<div class="row">
    <div id="div_indikator"></div>
</div>
<script>

    $("#frm_target_tahunan_skp").submit(function (e) {
        e.preventDefault();
        var frm_target_tahunan_skp = $("#frm_target_tahunan_skp");
        var form = getFormData(frm_target_tahunan_skp);
        $.ajax({
            type: "POST",
            url: "c_user/aksi_target_tahunan_skp",
            data: JSON.stringify(form),
            dataType: 'json'
        }).done(function (response) {
            if (response.status === 1) {
                alert(response.ket);
                $('.close').click();
                refreshTarget();
            } else {
                alert(response.ket);
            }
        });

    });
    $('.tanggal').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true
    });

    $.get('admin/c_kegiatan_jabatan/detail2', {}, function (data) {
        $('#tbl_kegiatan').html(data);
    });
    $('#rencana_strategis').on('click change', function () {
        refresh_indikator();

    });
    refresh_indikator();
    function refresh_indikator() {
        var id = $('#rencana_strategis').val();
        $.post('c_user/indikator_kinerja', {id: id}, function (data) {
            $('#div_indikator').html(data);
        });
    }

    function hitung_ak() {
        var ak = $('#angka_kredit').val();
        var tk = $('#target_kuantitas').val();
        var akt = ak * tk;
        $('#angka_kredit_total').val(akt);
    }
    $('#cek80').on('click',function(hasil){
       var cek=$(this).is(":checked");
       var akt=$('#angka_kredit').val();
       var akt2=$('#angka_kredit_total').val();
       if(cek==true){
           var akt_hit=akt*0.8;
           var akt_hit2=akt2*0.8;
       }else{
           var akt_hit=akt*1/0.8;
           var akt_hit2=akt2*1/0.8;
       }
       $('#angka_kredit').val(akt_hit);
       $('#angka_kredit_total').val(akt_hit2);
    });
</script>