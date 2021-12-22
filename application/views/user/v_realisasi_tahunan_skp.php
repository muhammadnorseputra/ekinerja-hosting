<style>
    .dataTables_length{
        color:#0000C0 !important;
    }.breadcrumb a{
        color:#285e8e !important;font-size:12px !important;
    }
</style>
<ol class="breadcrumb bc-3">
    <li>
        <a href="javascript:void(0)">
            <i class="glyphicon glyphicon-home"></i>
            SKP
        </a>
    </li>
    <li><a href="javascript:void(0)">Tahunan</a></li>
    <li><a href="javascript:void(0)">Realisasi </a></li>
</ol>
<div style="padding:10px;">
    <div class="row">
        <div class="col-lg-12" style="text-align:center;font-weight:bold;font-size:14px;">
            <span>REALISASI SKP TAHUNAN <?= date('Y', strtotime($periode['awal_periode_skp'])) ?></span>
        </div>
    </div>

    <table class="table table-bordered" id="tbl_realisasi">
        <thead class="sorting_disabled ui-state-default">
            <tr style="text-align:center;">
                <td rowspan="2" style="vertical-align:middle;">No</td>
                <td rowspan="2" style="vertical-align:middle;">Kegiatan</td>
                <td colspan="4">Target</td>
                <td colspan="4">Realisasi</td>
                <td colspan="2">Penilaian</td>
                <td rowspan="2" style="vertical-align:middle;">Input Waktu & Revisi Target</td></tr>
            <tr style="text-align:center;"><td>Kuantitas</td><td>Kualitas</td><td>Waktu</td><td>Biaya</td><td>Kuantitas</td><td>Kualitas</td><td>Waktu</td><td>Biaya</td><td>Perhitungan</td><td>Nilai</td></tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($real as $real_arr) {
                if($real_arr['target_kuantitas_revisi']>0){
                    $target_kuantitas="<p style='text-decoration:line-through'>".$real_arr['target_kuantitas']."</p> ".$real_arr['target_kuantitas_revisi']." ". $real_arr['satuan_kuantitas'];
                    $target_kuantitas_nilai=$real_arr['target_kuantitas_revisi'];
                }else{
                    $target_kuantitas=$real_arr['target_kuantitas'] ." ". $real_arr['satuan_kuantitas'];
                    $target_kuantitas_nilai=$real_arr['target_kuantitas'];
                    
                }
                if($real_arr['target_waktu_revisi']>0){
                    $target_waktu="<p style='text-decoration:line-through'>".$real_arr['target_waktu']."</p> ".$real_arr['target_waktu_revisi'];
                    $target_waktu_nilai=$real_arr['target_waktu_revisi'];
                }else{
                    $target_waktu=$real_arr['target_waktu'];
                    $target_waktu_nilai=$real_arr['target_waktu'];
                    
                }
                if($real_arr['biaya_revisi']>0){
                    $target_biaya="<p style='text-decoration:line-through'>".$real_arr['target_biaya']."</p> ".$real_arr['target_biaya_revisi'];
                    $target_biaya_nilai=$real_arr['biaya_revisi'];
                }else{
                    $target_biaya=$real_arr['biaya'];
                    $target_biaya_nilai=$real_arr['biaya'];
                    
                }

                $real_kuantitas = $real_arr['realisasi_kuantitas'];
                $target_kualitas = 100;
                $real_kualitas = $real_arr['realisasi_kualitas'];
                $real_waktu = $real_arr['waktu_realisasi'];
                $real_biaya = $real_arr['biaya_realisasi'];
                $nilai_kuantitas = ($real_kuantitas / $target_kuantitas_nilai) * 100;
                $nilai_kualitas = ($real_kualitas / $target_kualitas) * 100;
                $persentase_waktu = $target_waktu==0?0:100 - ($real_waktu / $target_waktu_nilai * 100);
                if ($persentase_waktu <= 24) {
                    $nilai_waktu = $target_waktu_nilai==0?0:((1.76 * $target_waktu_nilai - $real_waktu) / $target_waktu_nilai) * 100;
                } else {
                    $nilai_waktu = $target_waktu_nilai==0?0:76 - ((((1.76 * $target_waktu_nilai - $real_waktu) / $target_waktu_nilai) * 100) - 100);
                }
                $persentase_biaya = $target_biaya_nilai == 0 ? 0 : 100 - ($real_biaya / $target_biaya_nilai * 100);
                if ($persentase_biaya <= 24) {
                    $nilai_biaya = $target_biaya_nilai == 0 ? 0 : ((1.76 * $target_biaya_nilai - $real_biaya) / $target_biaya_nilai) * 100;
                } else {
                    $nilai_biaya = $target_biaya_nilai == 0 ? 0 : 76 - ((((1.76 * $target_biaya_nilai - $real_biaya) / $target_biaya_nilaia) * 100) - 100);
                }

                $perhitungan = $nilai_biaya + $nilai_waktu + $nilai_kualitas + $nilai_kuantitas;
                if ($target_biaya_nilai > 0) {
                    $nilai = $perhitungan / 4;
                } else {
                    $nilai = $perhitungan / 3;
                }
   
   ?>
                <tr>
                    <td align="center"><?= $no ?></td>
                    <td align="left"><?= $real_arr['kegiatan_tahunan'] ?>
                        <?php
                            $thn = date('Y', strtotime($periode['awal_periode_skp']));
                            $bln = date('M', strtotime($periode['awal_periode_skp']));                            
                            echo "<br/>";
                            echo "<small class='text-primary'>Non Tahapan : ";                                
                            for ($i=1; $i <= 12 ; $i++) { 
                                $id_user = $this->session->userdata('id_user');
                                if ($i<=9) {
                                    $period = $thn.'-0'.$i;
                                } else {
                                    $period = $thn.'-'.$i;
                                }

                                $jmlharian = $this->M_database->getjmlhariannonproses_perbulan($id_user, $real_arr['id_opmt_target_skp'], $period);
                                if ($jmlharian) {
                                    echo bulan_indo($i)." : ".$jmlharian;
                                    
                                    if ($i-1 != $bln) {
                                        echo "/ ";
                                    }       
                                }        
                            }
                            echo "</small>";
                            echo "<br/><small class='text-warning'>Tahapan : ";                                
                            for ($i=1; $i <= 12 ; $i++) { 
                                if ($i<=9) {
                                    $period = $thn.'-0'.$i;
                                } else {
                                    $period = $thn.'-'.$i;
                                }

                                $jmlharianturunan = $this->M_database->getjmlharianproses_perbulan($id_user, $real_arr['id_opmt_target_skp'], $period);
                                if ($jmlharianturunan) {
                                    echo bulan_indo($i)." : ".$jmlharianturunan;
                                    
                                    if ($i-1 != $bln) {
                                        echo "/ ";
                                    }       
                                }        
                            }
                            echo "</small>";
                        ?>
                    </td>
                    <td align="center"><?= $target_kuantitas ?></td>
                    <td align="center">100</td>
                    <td align="center"><?= $target_waktu . ' bulan' ?></td>
                    <td align="center"><?= number_format($target_biaya) ?></td>
                    <td align="center"><?= $real_arr['realisasi_kuantitas'] . ' ' . $real_arr['satuan_kuantitas'] ?></td>
                    <td align="center"><?= number_format($real_arr['realisasi_kualitas'], 2) ?></td>
                    <td align="center"><?= $real_arr['waktu_realisasi'] ?></td>
                    <td align="center"><?= number_format($real_arr['biaya_realisasi']) ?></td>
                    <td align="center"><?= number_format($perhitungan) ?></td>
                    <td align="center"><?= number_format($ttl_nilai[] = $nilai, 2) ?></td>
                    <td align="center"><a href="javascript:void(0)" onclick="input_biaya('<?= $id ?>', '<?= $real_arr['id_opmt_target_skp'] ?>')"><i class="fa fa-file-o text-primary"></i></a></td>
                </tr>
                <?php
                $no++;
            }
            ?>
            <tr style="background:#dff0d8;font-weight:bold;">
                <td colspan="11" align="center">Nilai SKP</td>
                <td><?= !isset($ttl_nilai) ? $total_nilai = 0 : number_format($total_nilai = array_sum($ttl_nilai) / count($ttl_nilai), 2) ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="11" align="left" style="font-weight: bold;">Tugas Tambahan</td>
                <td></td>
                <td></td>
            </tr>
            <?php
            $ttl_tgs = count($tugas_tambahan);
            if ($ttl_tgs == 0) {
                $nilai_tgs = 0;
            } else if ($ttl_tgs < 4) {
                $nilai_tgs = 1;
            } else if ($ttl_tgs < 7) {
                $nilai_tgs = 2;
            } else {
                $nilai_tgs = 3;
            }$i = 0;
            foreach ($tugas_tambahan as $arr2) {
                ?>
                <tr>
                    <td colspan="11" align="left" ><?= $arr2['nama_tugas_tambahan'] ?></td>
                    <?php if ($i == 0) { ?>
                        <td rowspan="<?= $ttl_tgs ?>" style="vertical-align: middle;text-align: center;"><?= $nilai_tgs; ?></td>
                    <?php } ?>
                    <td></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr>
                <td colspan="11" align="left" style="font-weight: bold;">Kreatifitas</td>
                <td></td>
                <td></td>
            </tr>
            <?php
            $ttl_kreatif = count($kreatifitas);
            $nilai_kreatif = 0;
            $j = 0;
            foreach ($kreatifitas as $arr3) {
                ?>
                <tr>
                    <td colspan="11" align="left" ><?= $arr3['kreatifitas'] ?></td>
                    <?php if ($j == 0) { ?>
                        <td rowspan="<?= $ttl_kreatif ?>" style="text-align: center;vertical-align: middle;"><?= $nilai_kreatif = isset($nilai_kreatifitas2['nilai_kreatifitas']) ? $nilai_kreatifitas2['nilai_kreatifitas'] : 0 ?></td>
                        <?php
                        $j++;
                    }
                    ?>
                    <td></td>
                </tr>
                <?php
            }
            ?>
            <tr style="background:#dff0d8;font-weight:bold;">
                <td colspan="11" align="center">Total Nilai SKP</td>
                <td><?= number_format($nilai_tgs + $nilai_kreatif + $total_nilai, 2) ?>
<input type="hidden" id="id_opmt_tahunan_skp" value="<?=$id?>">
				<input type="hidden" id="id_user" value="<?=$id_user?>">
				<input type="hidden" id="nilai" value="<?=$nilai_tgs + $nilai_kreatif + $total_nilai?>">
				
</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-primary pull-right fa fa-print" onclick="cetak_realisasi()">Cetak</button>
</div>
<script>


    function input_biaya(id_tahun, id) {
        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/tambah_realisasi_tahunan_skp' + '/' + id_tahun + '/' + id);
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

    function ubah_realisasi_tahunan_skp(id) {

        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/ubah_realisasi_tahunan_skp' + '/' + id);
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

    function hapus_realisasi_tahunan_skp(id) {
        var r = confirm("Yakin ingin menghapus realisasi_tahunan_skp ini ?");
        if (r) {
            $.post('c_user/hapus_realisasi_tahunan_skp', {id: id}, function (data) {
                if (data.status == 1) {
                    alert(data.ket);
                    refresh_realisasi_tahunan_skp();
                }
            });


        }
    }
    function cetak_realisasi() {
        BootstrapDialog.show({
            title: 'Pilih Lokasi Anda',
            //message: '<table class="table"><tr><td><select class="form-control" id="lokasi"><?= pilihan_list($spesimen, "lokasi_spesimen", "id_dd_spesimen", "") ?></select></td><td><button class="btn ui-state-default" onclick="cetak_realisasi_tahunan_skp()">Cetak</button></td></tr></table>'
            message: '<div class="row"><div class="col-md-3"><select class="form-control" id="lokasi"><?= pilihan_list($spesimen, "lokasi_spesimen", "id_dd_spesimen", "") ?></select></div><div class="col-md-3"><input class="form-control" placeholder="Tanggal Cetak" size="10" maxlength="10" type="text" name="tanggal" id="tanggal"></div><div class="col-md-3"><button class="btn ui-state-default" onclick="cetak_realisasi_tahunan_skp()">Cetak</button></div></div>'
        });
    }

    function cetak_realisasi_tahunan_skp() {
        var id = '<?= $id ?>';
        var lokasi = $('#lokasi').val();
        var tanggal = document.getElementById("tanggal").value;
        var dialog = new BootstrapDialog({
            title: '<div style="font-size:12px;">Cetak Realisasi Tahunan SKP</div>',
            message: function () {
//                var $message = $('<div></div>').load('c_pdf/cetak_jfk/' + jenis );
                //var $message = $('<iframe src=c_pdf/cetak_realisasi_tahunan_skp/' + id + '/' + lokasi + ' style="width:100%;height:300px;"></iframe>');
                var $message = $('<iframe src=c_pdf/cetak_realisasi_tahunan_skp/' + id + '/' + lokasi + '/' + tanggal + ' style="width:100%;height:300px;"></iframe>');
                return $message;
            }
        });
        dialog.realize();

        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_WIDE);
        dialog.open();
    }
function simpan(){
		var id=$('#id_opmt_tahunan_skp').val();
		var id_user=$('#id_user').val();
		var nilai=$('#nilai').val();
		$.post('c_user/simpan_realisasi_tahunan',{id_opmt_tahunan_skp:id,id_dd_user:id_user,nilai:nilai},function(hasil){
			
		});
	}
simpan();
</script>