
<table class="table table-bordered">
<tr style="font-weight:bold;background:blue;color:white;text-align:center;">
    <td>No</td>
    <td>Jabatan JFT</td>
    <td>Nomor Kelompok</td>
    <td>Input / Edit Nomor</td>
</tr>
<?php $no=1; foreach($jabatan as $dt){?>
<tr>
    <td align="middle" width="40"><?=$no?></td>
    <td><?=$dt->jabatan?></td>
    <td align="middle" width="100"><?=$dt->kelas?>
    <input type="hidden" id="kls_<?=$dt->kodejab?>" value="<?=$dt->kelas?>">
    </td>
    <td align="middle" width="100"><button class="btn btn-primary" onclick="edit(<?=$dt->kodejab?>)"><i class="fa fa-pencil"></i> Edit</button></td>
</tr>
<?php $no++;}?>
</table>

<script>
 function edit(id){
     var kelas=$('#kls_'+id).val();
    var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<table class="table"><tr><td style="vertical-align:middle"><b>No Kelompok</b></td><td><input type="text" id="nilai_kelas" class="form-control" value="'+kelas+'"></td><td style="vertical-align:middle"><button class="btn btn-primary fa fa-save" onclick="simpan_kelas(&#39;'+id+'&#39;)"> Simpan</button></td></tr>');
                return $message;
            }
        });
        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_SMALL);
        dialog.open();
 }

 function simpan_kelas(id){
     var kelas=$('#nilai_kelas').val();
     var kodejab=id;
     $.post('admin/c_kelompok/simpan_kelas',{kodejab:kodejab,kelas:kelas},function(hasil){
        if(hasil=='ok'){
           alert('Kelas berhasil diupdate');
           refresh_kelompok();
           $('.close').click();
    }
     });
 }
</script>