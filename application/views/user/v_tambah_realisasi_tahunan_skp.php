<?php
if (isset($realisasi_skp)) {
    $id_opmt_realisasi_skp = isset($realisasi_skp['id_opmt_realisasi_skp'])?$realisasi_skp['id_opmt_realisasi_skp']:0;
    $biaya = isset($realisasi_skp['biaya'])?$realisasi_skp['biaya']:0;
    $waktu = isset($realisasi_skp['waktu'])?$realisasi_skp['waktu']:0;
    $biaya_revisi = isset($target->biaya_revisi)?$target->biaya_revisi:0;
    $kuantitas_revisi = isset($target->target_kuantitas_revisi)?$target->target_kuantitas_revisi:0;
    $waktu_revisi = isset($target->target_waktu_revisi)?$target->target_waktu_revisi:0;
} else {
    $id_opmt_realisasi_skp = "";
    $biaya = "";
    $waktu = "";
    $biaya_revisi = "";
    $kuantitas_revisi = "";
    $waktu_revisi = "";
}
?>
<style>
.ui-state-default {
    color: black !important;
    background: blue;
}td{
    vertical-align:middle !important;
}
</style>
<form id="frm_realisasi_skp" method="post">
    <table class="table">
        <input type="hidden" name="id_opmt_target_skp" id="id_opmt_target_skp" value="<?= $id ?>">
        <input type="hidden" name="id_opmt_realisasi_skp" value="<?= $id_opmt_realisasi_skp ?>">
        <!--
        <tr>
            <td>Realisasi Biaya</td>
            <td> : </td> 
            <td>
                <input type="text" class="form-control" name="biaya" value="<?= $biaya ?>"></td>
        </tr>
        -->
        <tr>
            <td>Realisasi Waktu</td>
            <td> : </td>
            <td>

                <input type="text" class="form-control" name="waktu" value="<?= $waktu ?>"></td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>

        <tr>
            <td>Target Kuantitas</td>
            <td> : </td>
            <td>
                <p id="p_1" style="text-decoration: <?=$target->target_kuantitas_revisi>0?'line-through;':'none'?>"><?=$target->target_kuantitas?></p>
            </td>
        </tr>
        <tr>
            <td>Revisi Kuantitas</td>
            <td> : </td>
            <td>
               <input type="text" class="form-control input-sm" style="width:200px;float:left;" name="target_kuantitas_revisi" <?=$kuantitas_revisi>0?'disabled':''?> value="<?=$kuantitas_revisi?>" >
            <button class="btn btn-danger btn-sm" type='button' onclick="batal(1)">Batal</button>
            </td>
        </tr>
        <tr>
            <td>Target Waktu</td>
            <td> : </td>
            <td>
            <p id="p_2" style="text-decoration: <?=$target->target_waktu_revisi>0?'line-through;':'none'?>"><?=$target->target_waktu?></p>
            </td>
        </tr>
        <tr>
            <td>Revisi Waktu</td>
            <td> : </td>
            <td>
               <input type="text" class="form-control input-sm" style="width:200px;float:left;" name="target_waktu_revisi" value="<?=$waktu_revisi?>" <?=$waktu_revisi>0?'disabled':''?> >
               <button class="btn btn-danger btn-sm" type='button' onclick="batal(2)">Batal</button>
            </td>
        </tr>
        <tr>
            <td>Target Biaya</td>
            <td> : </td>
            <td>
            <p id="p_3" style="text-decoration: <?=$target->biaya_revisi>0?'line-through;':'none'?>"> <?=$target->biaya?></p>
            </td>
        </tr>
        <tr>
            <td>Revisi Biaya</td>
            <td> : </td>
            <td>
               <input type="text" class="form-control input-sm" style="width:200px;float:left;" name="biaya_revisi" value="<?=$biaya_revisi?>" <?=$biaya_revisi>0?'disabled':''?> >
               <button class="btn btn-danger btn-sm" type='button' onclick="batal(3)">Batal</button>
          
            </td>
        </tr>
        <tr>
            <td></td>
            <td> </td>
            <td><button class="btn btn-primary">Simpan</button></td>
        </tr>
    </table>
</form>
<script>
$("#frm_realisasi_skp").submit(function(e) {
    e.preventDefault();
    var frm_realisasi_skp = $("#frm_realisasi_skp");
    var form = getFormData(frm_realisasi_skp);
var r=confirm("Yakin ingin mengupdate realisasi dan revisi target ?");
if(r){
    $.ajax({
        type: "POST",
        url: "c_user/aksi_realisasi_skp",
        data: JSON.stringify(form),
        dataType: 'json'
    }).done(function(response) {
        if (response.status === 1) {
            alert(response.ket);
            $('.close').click();
            menu('c_user/realisasi_tahunan_skp' + '/' + <?= $id_tahun ?>);
        } else {
            alert(response.ket);
        }
    });
}
});

function batal(id){
if(id==1){
    var ket="Revisi Kuantitas";
}if(id==2){
    var ket="Revisi Waktu";
}if(id==3){
    var ket="Revisi Biaya";
}
var dialogId = 'dlgBatal';
    var dialog = new BootstrapDialog({
        id:dialogId,
        type: BootstrapDialog.TYPE_DANGER,
            title: '<div style="font-size:12px;margin:0 auto !important;font-weight:bold;text-align:center !important; ">KONFIRMASI</div>',
            message: function () {
//                var $message = $('<div></div>').load('c_pdf/cetak_jfk/' + jenis );
                var $message = $('<div style="font-weight:bold;text-align:center;">Batal '+ket+'</div><br><button class="btn btn-success" onclick="$(&#39;#dlgBatal&#39;).modal(&#39;hide&#39;)">Cancel</button><button class="btn btn-primary pull-right" onclick="proses_batal('+id+')">Ok</button>');
                return $message;
            }
        });
        dialog.realize();

        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_SMALL);
        dialog.open();
   
    //1 kuantitas 2 waktu 3 <i class="fa fa-birthday-cake" aria-hidden="true"></i>
}

function proses_batal(id){
    var id_opmt_target_skp=$('#id_opmt_target_skp').val();
    $.post('<?=base_url('c_user/batal_revisi_target')?>',{id_opmt_target_skp:id_opmt_target_skp,id:id},function(res){
        if(res=='update'){
            $('#dlgBatal').modal('hide');
            $('.close').click();
            $('p_'+id).css('text-decoration','none');
            menu('c_user/realisasi_tahunan_skp' + '/' + <?= $id_tahun ?>);
        
        }
            });
        }
</script>