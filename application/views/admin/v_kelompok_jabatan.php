<div style="margin-top:-50px;">
<table class="table" style="width:800px;">
    <tr>
        <td style="vertical-align:middle;">Jabatan</td>
        <td>
        <select class="form-control" id="jabatan" style="width:300px;">
        <option value="all">- Semua - </option>
<?php foreach($jabatan as $dt){?>
<option value="<?=$dt->kodejab?>"><?=$dt->jabatan?></option>
<?php }?>
</select>
        </td>
        <td style="vertical-align:middle;">
No Kelompok
        </td>
        <td>
    <input type="text" class="form-control" id="no" >
        </td>
        <td>
<button class="btn btn-primary" onclick="refresh_kelompok()">Cari</button>
        </td>
    </tr>
</table>
<br>
<div id="divKelompok"></div>
</div>
<script>
function refresh_kelompok(){
    var no=$('#no').val();
    var jabatan=$('#jabatan').val();
    $.post('admin/c_kelompok/list_jabatan',{no:no,jabatan:jabatan},function(result){
$('#divKelompok').html(result);
    });
}
</script>