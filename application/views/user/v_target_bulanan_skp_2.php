<style>
    .table,btn{font-size:12px !important;}.fixed-table-body{height: 200px !important;}
    #tbl_realisasi thead{
        background-color:#006e2e;text-align:center;font-weight:bold;color:white;border:solid 1px black;
    }.angka{text-align: right;}.tengah{text-align: center;}
    #tbl_realisasi td{
        border:solid 1px black;
    }.kiri{float:left;}
</style>
<div style="padding:0px;">
    <div class="row">
        <div class="col-lg-12" style="text-align:center;font-weight:bold;font-size:14px;">
            <span style="text-transform: capitalize;">TARGET SKP BULAN <?= strtoupper(bulan($periode['bulan'])) ?><?php $periode['bulan'] ?> TAHUN <?= $periode['tahun'] ?></span>
        </div>
    </div>

    <div style="float:left;">
        <table>
            <tr>
                <td>
                    <button class="btn btn-success btn-sm" onclick="tambah_target_bulanan_skp('<?= $id ?>')"><i class="fa fa-plus"></i> Tambah Target Bulanan</button>
                </td>
		<?php //var_dump($id);?>
            </tr>
        </table>
    </div>
    <br/><br/>
    <table class="table table-bordered" id="1tbl_realisasi">
        <thead class=" ui-state-default ">
            <tr>
                <td class="tengah">No</td>             
                <td class="tengah">Tgl. Entri</td>
                <td>Kegiatan Bulanan</td>
                <td>Tahapan</td>
                <td class="tengah">Target Kuantitas</td>
                <td class="tengah">Target Kualitas</td>
                <td class="tengah">Target Waktu</td>
                <td>Biaya</td>
                <td>Edit</td>
                <td>Hapus</td>
                <!--<td>Drop Target</td>
                <td>Status Drop</td>-->
            </tr>
	</thead>
        <tbody>
            <?php
            $no = 1;
            $no_2 = 'a';
            $par = '';
            $par_id = '';
            $i = 0; $cek=0;

            foreach ($turunan as $real_arr) {
                // tambahan jika terdapat yg salah entri
                //if ($real_arr['target_kuantitas'] == 0) {$cek++;}
                

                if ($real_arr['id_dd_user_bawahan'] > 0 && $i > 0 && $real_arr['id_dd_user'] !== $this->session->userdata('id_user')) {
                    $no++;
                } elseif ($par_id !== "" && $par_id !== $real_arr['id_opmt_target_bulanan_skp']) {
                    $no++;
                    $no_2 = 'a';
                }

                if ($real_arr['id_dd_user_bawahan'] == 0 || empty($real_arr['id_dd_user_bawahan'])) {
                    $id_opmt_bulanan_skp = $real_arr['id_opmt_bulanan_skp'];
                } else {
                    $id_opmt_bulanan_skp = $id;
                }
                if ($real_arr['ket'] == 'utama' && $par == "turunan") {
                    //$no++;
                    $no_2 = 'a';
                }

                $link_turunan = '<a href="javascript:void(0)" onclick="lihat_turunan(' . $real_arr['id_opmt_target_skp'] . ',' . $real_arr['id'] . ',' . $real_arr['id_opmt_bulanan_skp'] . ')"><i class="fa fa-pencil text-success"/></a>';
                ?>
                <tr>
                    <td align="center">
                        <?php
                        if ($real_arr['id_dd_user_bawahan'] > 0&&$real_arr['id_dd_user']!==$this->session->userdata('id_user')) {
                            echo $no;
                        } elseif ($par_id !== $real_arr['id_opmt_target_bulanan_skp']) {
                            echo $no;
                        } else {
                            echo $no . '.' . $no_2;
                        }
                        ?>                
                    </td>
                    <td class="tengah">                    
                        <?php
                        
                            if ($real_arr['tgl_entri'] == NULL) {
                                $tglentri = '';
                            } else {
                                $tglentri = date('D, d F Y h:i:s',strToTime($real_arr['tgl_entri']));
                            } 
                           echo '<small>'.$tglentri.'</small>';
                        ?>
                    </td>

                    <td><?= $real_arr['kegiatan'] ?></td>
                    <!-- <td><?= $real_arr['kegiatan']." ".$real_arr['id_opmt_target_bulanan_skp'] ?></td>-->
                    <td class="tengah"><?= $real_arr['turunan'] == 1 ? $link_turunan : '' ?></td>
                    <td class="tengah"><?= $real_arr['ket'] == 'turunan' || $real_arr['turunan'] == 0 ? $real_arr['target_kuantitas'] . ' ' . $real_arr['satuan_kuantitas'] : "" ?></td>
                    <td class="tengah"><?= $real_arr['ket'] == 'turunan' || $real_arr['turunan'] == 0 ? $real_arr['kualitas'] : "" ?></td>
                    <td class="tengah"><?= $real_arr['ket'] == 'turunan' || $real_arr['turunan'] == 0 ? $real_arr['target_waktu'] . " Hari" : "" ?></td>
                    <td class="angka"><?= $real_arr['ket'] == 'turunan' || $real_arr['turunan'] == 0 ? number_format($real_arr['biaya']) : "" ?>
                    </td>
                    <?php
                    // TAMBAHAN
                    // Ttampilkan tombol edit dan hapus jika tidak ada laporan kegiatan harian yang terkait dengan bulanan ini
                    //
                   
                    //if ((($real_arr['ket'] == 'utama') AND ($cekharian == 0))
                    //    || (($real_arr['ket'] == 'turunan') AND ($cekturunan == 0))) {
                    //if (($real_arr['turunan'] == 0) AND
                    
                    // UNTUK TOMBOL EDIT
                    // hidden tombol edit jika kegiatan bulanan ini sudah di-Confirm (sudah bernilai kualitas)
                    // $realisasi_kualitas = $this->M_database->get_realisasi_kualitas($real_arr['id_dd_user'], $real_arr['id_opmt_target_bulanan_skp']);
                    
                    //if (($realisasi_kualitas == 0) || ($realisasi_kualitas == NULL))                     
                    //{
                    
                    ?>
                    <td align="center">
                        <?php

                        if ($real_arr['id_dd_user'] == $id_user) {
                            if ($real_arr['ket'] == 'utama') {
                                ?>
                                <a href="javascript:void(0)" onclick="ubah_target_bulanan_skp('<?= $real_arr['id_opmt_target_bulanan_skp'] ?>', '<?= $real_arr['id_opmt_bulanan_skp'] ?>')"><i class="fa fa-pencil-square-o fa-2x text-success"></i></a>
                                <?php
                            } else if ($real_arr['ket'] == 'turunan') {
                                $no_2++;
                                ?>
                                <a href="javascript:void(0)" onclick="ubah_turunan('<?= $real_arr['id_opmt_target_skp'] ?>', '<?= $real_arr['id'] ?>', '<?= $real_arr['id_opmt_bulanan_skp'] ?>')"><i class="fa fa-pencil-square-o fa-2x text-success"></i></a>
                                <?php
                            }
                        }
                        ?>
                    </td>
                    <?php
                    //} else {
                    //    echo "<td class='danger'></td>";
                    //}
                    
                    // UNTUK TOMBOL HAPUS
                    // hidden tombol HAPUS jika kegiatan bulanan ini memiliki realisasi_kualitas harian
                    $cekharian = $this->M_database->getjmlharian($real_arr['id_dd_user'], $real_arr['id_opmt_target_bulanan_skp']);
                    
                    $getopmt_turunan_skp = $this->M_database->get_opmt_turunan_skp($real_arr['kegiatan'], $real_arr['id_dd_user'], $real_arr['id_opmt_target_bulanan_skp']);
                    $cekturunan = $this->M_database->getjmlharian($real_arr['id_dd_user'], $getopmt_turunan_skp);
                    
                    //if ((($real_arr['ket'] == 'utama') AND ($cekharian == 0)) ||
                    //    (($real_arr['ket'] == 'turunan') AND ($cekturunan == 0)))
                    //{
                    ?>
                    <td align="center">
                        <?php 
                            if ($real_arr['id_dd_user'] == $id_user) {
                                //if (($cekharian == 0) OR ($cekturunan == 0)) {
                                if (($real_arr['ket'] == 'utama') AND ($cekharian == 0)) {
                                    ?>
                                    <a href="javascript:void(0)" onclick="hapus_target_bulanan_skp('<?= $real_arr['id'] ?>', '<?= $real_arr['ket'] ?>', '<?= $real_arr['id_opmt_bulanan_skp'] ?>')"><i class="fa fa-trash-o fa-2x text-danger"></i></a>
                                    <?php
                                } else if (($real_arr['ket'] == 'turunan') AND ($cekturunan == 0)) {
                                    ?>
                                    <a href="javascript:void(0)" onclick="hapus_target_bulanan_skp('<?= $real_arr['id'] ?>', '<?= $real_arr['ket'] ?>', '<?= $real_arr['id_opmt_bulanan_skp'] ?>')"><i class="fa fa-trash-o fa-2x text-danger"></i></a>
                                    <?php
                                } else {
                                    echo "<i class='fa fa-ban fa-2x text-muted'></i>";
                                }
                            }
                        ?>
                    </td>
                    <?php
                    //} else {
                    //    echo "<td class='danger'></td>";
                    //}
                    ?>
		    <!--
                    <td align="center" style="background: <?php
                        if ($real_arr['id_dd_user'] !== $id_user) {
                            echo 'white';
                        } elseif ($real_arr['id_dd_user_bawahan'] > 0) {
                            echo 'green';
                        } else {
                            echo 'yellow1';
                        }
                        ?>;"><?php if (($real_arr['id_dd_user'] == $id_user && $real_arr['turunan'] == 0)) { ?><a href="javascript:void(0)" onclick="drop('<?= $real_arr['id'] ?>', '<?= $real_arr['ket'] ?>', '<?= $real_arr['id_opmt_bulanan_skp'] ?>')"><i class="fa fa-dropbox text-primary"></i></a><?php } ?>
		    </td>
		    
                    <td align="center" style="background: <?= $real_arr['id_dd_user_bawahan'] == $id_user ? 'pink' : 'white' ?>;"><?php if ($real_arr['id_dd_user_bawahan'] == $id_user) { ?><a href="javascript:void(0)" onclick="lihat_atasan('<?= $real_arr['id_dd_user'] ?>')"><i class="fa fa-user text-light-blue"></i></a><?php } ?></td>
		    -->                
		</tr>
                        <?php
                        $par = $real_arr['ket'];
                        $i++;
                        $par_id = $real_arr['id_opmt_target_bulanan_skp'];
                    }
                    ?>

        </tbody>
    </table>
    <button class="btn btn-primary btn-lg pull-right fa fa-2x fa-print" onclick="cetak()"> Cetak</button>
</div>
<script>
    /*
    function alert() {
        var cek=<?=$cek?>;
        if(cek>0){
            BootstrapDialog.show({
                title: 'INFORMASI',
                message: '<b><center>Terdapat Kegiatan Bulanan yang Membutuhkan Penyesuaian Kuantitas</b>,<br> Silahkan Cek Kembali Kuantitas Target dan Realisasi Kegiatan Anda</center>'
            });
        }
    }
    alert();
    */
    function tambah_target_bulanan_skp(id) {
    console.log(id);
        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/tambah_target_bulanan_skp' + '/' + id);
                return $message;
            }
        });
        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_NORMAL);
        dialog.open();
    }

    function lihat_atasan(id) {
        $.post('c_user/get_nama', {bawahan: id}, function (data) {
            alert('Nama Atasan : ' + data);
        });
    }

    function ubah_target_bulanan_skp(id, id_bulanan) {
        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/ubah_target_bulanan_skp' + '/' + id + '/' + id_bulanan);
                return $message;
            }
        });
        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_NORMAL);
        dialog.open();
    }

    function lihat_turunan(id, id_tahunan, id_bulanan) {
        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/turunan' + '/' + id + '/' + id_tahunan + '/' + id_bulanan);
                return $message;
            }
        });
        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_NORMAL);
        dialog.open();
    }
    function ubah_turunan(id, id_tahunan, id_bulanan) {
        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/ubah_turunan' + '/' + id + '/' + id_tahunan + '/' + id_bulanan);
                return $message;
            }
        });
        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_NORMAL);
        dialog.open();
    }

    function hapus_target_bulanan_skp(id, ket, id2) {
        var r = confirm("Yakin ingin menghapus Data ini ?");
        if (r) {
            $.post('c_user/hapus_target_bulanan_skp', {id: id, ket: ket}, function (data) {
                if (data.status == 1) {
                    alert(data.ket);
                    menu('c_user/target_bulanan_skp' + '/' + id2);
                }
            });
        }
    }

    function drop(id, ket, id_opmt_bulanan_skp) {
    var par="<?=$parameter->drop?>";
	if(par==="1"){
		alert("Fitur Belum Dapat Diimplementasikan, Silahkan hubungi Petugas DES untuk Penjelasan lebih lanjut mengenai Fitur ini");
	}else{
        $.get('c_user/get_user_bulanan_skp/' + id + '/' + ket, function (data) {
            $("#bawahan").val(data);
        });
        BootstrapDialog.show({
            title: 'Pilih Bawahan',
            message: `<table class="table"><tr><td><select class="form-control" id="bawahan"><?= count($bawahan) == 0 ? "" : pilihan_list($bawahan, "nama", "id_dd_user", "") ?></select></td></tr></table>`
            ,
            buttons: [{
                    label: 'Batalkan Drop', cssClass: 'btn-danger kiri',
                    action: function (dialog) {
                        var bawahan = $('#bawahan').val();
                        $.post('c_user/get_nama/', {bawahan: bawahan}, function (data) {
                            var nama = data;
                            var r = confirm("Apakah anda yakin akan membatalkan Drop kegiatan ini pada : " + nama);
                            if (r) {
                                drop_target(id, ket, id_opmt_bulanan_skp, 0);
                                $(".close").click();
                                menu('c_user/target_bulanan_skp' + '/' + id_opmt_bulanan_skp);
                            } else {
                                return false;
                            }
                        });
                    }
                }, {
                    label: 'Simpan', cssClass: 'btn-primary ',
                    action: function (dialog) {
                        var bawahan = $('#bawahan').val();
                        $.post('c_user/get_nama/', {bawahan: bawahan}, function (data) {
                            var nama = data;
                            var r = confirm("Apakah anda yakin akan melakukan Drop kegiatan ini pada : " + nama);
                            if (r) {
                                drop_target(id, ket, id_opmt_bulanan_skp, 1);
                                $(".close").click();
                                menu('c_user/target_bulanan_skp' + '/' + id_opmt_bulanan_skp);
                            } else {
                                return false;
                            }
                        });
                    }
                }]
        });
}
    }

    function drop_target(id, ket, id_opmt_bulanan_skp, flag) {
        $.post('c_user/drop_target', {id: id, bawahan: $('#bawahan').val(), ket: ket, id_opmt_bulanan_skp: id_opmt_bulanan_skp, flag: flag}, function (data) {
            if (data == 'ok') {
                menu('c_user/target_bulanan_skp/' +<?= $id ?>);
            }
        });
    }

    function cetak() {
        BootstrapDialog.show({
            title: 'Pilih Lokasi Anda',
            message: '<table class="table"><tr><td><select class="form-control" id="lokasi"><?= pilihan_list($spesimen, "lokasi_spesimen", "id_dd_spesimen", "") ?></select></td><td><button class="btn ui-state-default" onclick="cetak_target_bulanan_skp()">Cetak</button></td></tr></table>'
        });
    }

    function cetak_target_bulanan_skp() {
        var id =<?= $id ?>;
        var lokasi = $('#lokasi').val();
        var dialog = new BootstrapDialog({
            title: '<div style="font-size:12px;">Laporan Target Bulanan SKP</div>',
            message: function () {
//                var $message = $('<div></div>').load('c_pdf/cetak_jfk/' + jenis );
                var $message = $('<iframe src=c_pdf/cetak_target_bulanan_skp/' + id + '/' + lokasi + ' style="width:100%;height:300px;"></iframe>');
                return $message;
            }
        });
        dialog.realize();
        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_WIDE);
        dialog.open();
    }
    function refresh_target_bulanan_skp() {
        $('#tbl_target_bulanan_skp').bootstrapTable('refresh');
    }
</script>
