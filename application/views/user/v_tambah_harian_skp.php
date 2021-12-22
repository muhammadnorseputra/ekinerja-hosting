<?php
if (isset($harian_skp)) {
    $id_opmt_realisasi_harian_skp = $harian_skp['id_opmt_realisasi_harian_skp'];
    $tanggal = $harian_skp['tanggal'];
    $proses = $harian_skp['proses'];
    $kegiatan_harian_skp = $harian_skp['kegiatan_harian_skp'];
    $kuantitas = $harian_skp['kuantitas'];
    $satuan_kuantitas = $harian_skp['satuan_kuantitas'];
    $id_opmt_target_skp = $harian_skp['id_opmt_target_skp'];
    $id_opmt_target_bulanan_skp = $harian_skp['id_opmt_target_bulanan_skp'];
    $turunan = $harian_skp['turunan'];

    // Untuk jam mulai jam selesai
    $jam_mulai = $harian_skp['jam_mulai'];
    $jam_selesai = $harian_skp['jam_selesai'];
} else {
    $id_opmt_realisasi_harian_skp = "";
    $tanggal = "";
    $proses = "";
    $kegiatan_harian_skp = "";
    $kuantitas = "";
    $satuan_kuantitas = "";
    $id_opmt_target_skp = "";
    $id_opmt_target_bulanan_skp = "";
    $turunan = '';

    // Untuk jam mulai jam selesai
    $jam_mulai = '';
    $jam_selesai = '';
//    $periode_awal = $periode['awal_periode_skp'];
//    $periode_akhir = $periode['akhir_periode_skp'];
}
?>
<style>
    .ui-state-default{
        color:black !important;
        background:blue;
    }td{vertical-align:middle !important;}
</style>
<form id="frm_harian_skp" method="post">
    <table class="table">           
        <tr>
	    <td>Tanggal</td>
	    <td>:</td>
            <td style="width:150px !important;" colspan='5'>
                
                <input type="text" class="form-control tanggal" name="tanggal" value="<?= $tanggal == "" ? date('Y-m-d') : $tanggal ?>" style="width: 200px;" readonly>
                
		<!-- <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>" readonly> -->
            </td>
        </tr>
	<!--
        <tr>
            <td></td>
            <td></td>
            <td colspan='3'> 
                <?php
                    $hariini = date('d-m-Y');
                    echo "<code>HARI INI ".$hariini."</code>";
                ?>
            </td>
        </tr>
	-->        
	<!--
        <tr>
            <td>Tanggal Pelaksanaan</td>
            <td></td>
            <td colspan='3'>
                <?php
                $hari_ini = date_create();
                $tanggalkeg = date_create($tanggal);
                $diff  = date_diff($tanggalkeg, $hari_ini);

                // Mendapatkan bulan
                $bulan_ini = $hari_ini->format('n'); // get bulan hari_ini
                $bulankeg = $tanggalkeg->format('n'); // get bulan tanggalkeg
                //echo $diff->d;   
                  
                if (($diff->d <= 2) AND ($bulan_ini == $bulankeg)) {
                //if ($diff->d <= 2) {      
                    echo "<select class='form-control' name='tanggal' id='tanggal' style='width:150px'>";
                    if ($tanggal == '') {
                        echo "<option value='1' selected>Hari Ini | H</option>";
                        echo "<option value='2' >Kemaren | H-1</option>";
                        echo "<option value='3' >Selumbari | H-2</option>";
                    } else { 
                        if ($diff->d == 0) {
                            echo "<option value='1' selected>Hari Ini | H</option>";
                            echo "<option value='2' >Kemaren | H-1</option>";
                            echo "<option value='3' >Selumbari | H-2</option>";
                        } else if ($diff->d == 1) {
                            echo "<option value='1' >Hari Ini | H</option>";
                            echo "<option value='2' selected>Kemaren | H-1</option>";
                            echo "<option value='3' >Selumbari | H-2</option>";
                        } else if ($diff->d == 2) {
                            echo "<option value='1' >Hari Ini | H</option>";
                            echo "<option value='2' >Kemaren | H-1</option>";
                            echo "<option value='3' selected>Selumbari | H-2</option>";
                        }
                    }
                    echo "</select>";
                } else {
                    echo $tanggal;
                }
                ?>
            </td>
        </tr>
	-->
        <tr>
            <td>Proses</td>
            <td> : </td> 
            <td colspan="3">
                <input type="hidden" name="id_opmt_realisasi_harian_skp" value="<?= $id_opmt_realisasi_harian_skp ?>">

                <input type="checkbox" name="proses" id="proses" <?= $proses == 1 ? 'checked' : '' ?> class="form-control" style="width: 30px;">
            </td>
        </tr>

        <tr>
            <td>Kegiatan Harian SKP</td>
            <td> : </td> 
            <td colspan="3">
                <textarea class="form-control" name="kegiatan_harian_skp"><?= $kegiatan_harian_skp ?></textarea>
            </td>
        </tr>
        <tr>

            <td>Kuantitas</td>
            <td>:</td>
            <td>
                <input type="text" class="form-control" name="kuantitas" style="width:50px;" value="<?= $kuantitas ?>">
            </td>

            <td>Satuan Kuantitas</td>
            <td>
                <select class="form-control isi" name="satuan_kuantitas">
                    <?= pilihan_list($dt_kuantitas, 'satuan_kuantitas', 'id_dd_kuantitas', $satuan_kuantitas) ?>
                </select>
            </td>
        </tr>
        <!-- Start Jam Mulai Selesai -->
        <tr>
            <td>Jam Mulai</td>
            <td>:</td>
            <td>
            <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                <input type="text" class="form-control jam" name="jam_mulai" 
                    value="<?= $jam_mulai ?>">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
            </td>

            <td>Jam Selesai</td>
            <td>
            <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                <input type="text" class="form-control jam" name="jam_selesai" value="<?= $jam_selesai ?>">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
            </td>
        </tr>
        <!-- End Jam Mulai Selesai -->
        <tr>
            <td>Klasifikasi SKP Bulanan</td>
            <td> : </td> 
            <td colspan="3">
                <select class="form-control" name="id_opmt_target_bulanan_skp" id="id_opmt_target_bulanan_skp" onchange="cekTargetTahunan();">
                    <?php
                    $ket2 = $turunan == 1 ? "turunan" : "utama";
                    foreach ($skp_bulanan as $arr) {
                        ?>    
                        <option value="<?= $arr['id'] . '-' . $arr['ket'] ?>" <?= !isset($harian_skp) ? '' : $arr['id'] . '-' . $arr['ket'] == $harian_skp['id_opmt_target_bulanan_skp'] . '-' . $ket2 ? 'selected' : '' ?> title="<?=$arr['id_opmt_target_skp']?>"><?= $arr['kegiatan'] ?></option>
                    <?php }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Klasifikasi SKP Tahunan</td>
            <td> : </td> 
            <td colspan="3">
                <select class="form-control" name="id_opmt_target_skp" id="id_opmt_target_skp">
                    <?php
                    foreach ($skp_tahunan as $arr) {
                        ?>    
                        <option value="<?= $arr['id_opmt_target_skp'] ?>" <?= !isset($harian_skp) ? '' : $arr['id_opmt_target_skp'] == $harian_skp['id_opmt_target_skp'] ? 'selected' : '' ?>><?= $arr['kegiatan_tahunan'] ?></option>
                    <?php }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td></td>
            <td> </td>
            <td><button class="btn btn-warning" ><span class='fa fa-plus-square'></span> Tambah Laporan Harian</button></td>
        </tr>

    </table>
</form>

<script>
    /* Untuk jam mulai selesai */
    $('.jam').clockpicker({
        autoclose: true
    });
    /* End jam mulai selesai */

    $("#frm_harian_skp").submit(function (e) {
    e.preventDefault();
    var frm_harian_skp = $("#frm_harian_skp");
    var form = getFormData(frm_harian_skp);
    var target_bulanan = document.getElementById("id_opmt_target_bulanan_skp").options.length;
    var target_tahunan = document.getElementById("id_opmt_target_skp").options.length;
    if (target_tahunan == '') {
    alert('Target Tahunan Tidak Ada');
    } else if (target_bulanan == '') {
    alert('Target Bulanan Tidak Ada');
    } else {
    $.ajax({
    type: "POST",
            url: "c_user/aksi_harian_skp",
            data: JSON.stringify(form),
            dataType: 'json'
    }).done(function (response) {
    if (response.status === 1) {
    alert(response.ket);
    $('.close').click();
    refresh_harian_skp();
    } else {
    alert(response.ket);
    }
    });
    }
    });
    $('.tanggal').datepicker({
    dateFormat: 'yy-mm-dd',
            autoclose: true,
<?php if ($parameter['parameter_bulan'] == 1) { ?>
        minDate: "-1m -1w -2d", // pengaturan minimal hari (kalender) pengentrian aktivitas harian (misal -3 : unt 3 hri yg lalu)
        maxDate: 0,
<?php } ?>
    onSelect: function (dateText, inst) {
    var date = $(this).val();
    var id_opmt_target_skp=$('#id_opmt_target_skp option:selected').val();
    var id_opmt_target_bulanan_skp=$('#id_opmt_target_bulanan_skp option:selected').val();
    document.getElementById("id_opmt_target_skp").options.length = 0;
    document.getElementById("id_opmt_target_bulanan_skp").options.length = 0;
   
   
    $.post('c_user/get_target_tahun', {tanggal: date}, function (data) {
    var x = JSON.parse(data);

    for (i = 0; i < x.length; i++) {
	if(x[i].id_opmt_target_skp==id_opmt_target_skp){
            $('#id_opmt_target_skp').append('<option value="' + x[i].id_opmt_target_skp+ '" selected>' + x[i].kegiatan_tahunan + '</option>');
	
	}else{
       $('#id_opmt_target_skp').append('<option value="' + x[i].id_opmt_target_skp+ '">' + x[i].kegiatan_tahunan + '</option>');
	
	}
 
    }
    });
    $.post('c_user/get_target_bulan', {tanggal: date}, function (data) {
    var x = JSON.parse(data);
//                alert(x.length);
//                alert(x[0].kegiatan_tahunan);
    for (i = 0; i < x.length; i++) {
if(x[i].id + '-' + x[i].ket==id_opmt_target_bulanan_skp){
            $('#id_opmt_target_bulanan_skp').append('<option value="' +  x[i].id + '-' + x[i].ket+ '" selected title="'+x[i].id_opmt_target_skp+'">' + x[i].kegiatan + '</option>');
	
	}else{
       $('#id_opmt_target_bulanan_skp').append('<option value="' +  x[i].id + '-' + x[i].ket+ '" title="'+x[i].id_opmt_target_skp+'">' + x[i].kegiatan + '</option>');
	
	}


   
    }
    $('#id_opmt_target_bulanan_skp').on('change',function(){
        cekTargetTahunan();
});
cekTargetTahunan();
    });




    }
    });
    $('input[name=proses]').on("change", function(){
    var cek = $(this).prop('checked');
    if (cek == true){
    var r = confirm("Apakah Anda Yakin Kegiatan yang diinput merupakan Proses?");
    if (!r){
        $(this).attr('checked', false);
    }
    }
    else{
    var r2 = confirm("Apakah Anda Yakin Kegiatan yang diinput Bukan merupakan Proses?");
    if (!r2){
        $(this).prop('checked', true);
    }
    }

    });
    cekTargetTahunan();
    function cekTargetTahunan(){
        var thn=$('#id_opmt_target_bulanan_skp option:selected').attr('title');
        $('#id_opmt_target_skp').val(thn);
    }


</script>
