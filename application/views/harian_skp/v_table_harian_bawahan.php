<style>
.judul th {
    text-align: center !important;
}

.tengah {
    text-align: center;
}

th {
    vertical-align: middle !important;
}

#tblCek td {
    vertical-align: middle;
}
</style>

<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead class="ui-state-default judul dataTables_scrollHead">
        <tr class="judul">
            <th class="ui-state-default">No</th>
            <th class="ui-state-default">Nama Bawahan</th>
            <th class="ui-state-default">Tgl. Kegiatan Harian<br/>Tgl. Entri Laporan</th>
            <th class="ui-state-default">Keg. Harian SKP<br/><u>SKP Bulanan</u></th>
            <!--<th class="ui-state-default">SKP Bulanan</th>-->
            <th class="ui-state-default">Kuantitas</th>
            <th class="ui-state-default">Status</th>
            <th class="ui-state-default">View Detail</th>
            <th class="ui-state-default">Verifikasi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $ttl_sesuai = 0;
        foreach ($dt_harian as $dt) {

            if ($dt['verifikasi'] >0) {
                $ttl_sesuai++;
            }
            $link_detail = '<a href="javascript:void(0)" onclick="detail_harian(' . $dt['id_opmt_realisasi_harian_skp'] . ')">
<i class="fa fa-pencil text-success"/>
</a>';
            ?>
        <tr>
            <td class="tengah"><?= $no; ?></td>
            <td><?= $dt['nama']; ?></td>

            <td class="tengah" width='150'>
                <?php
                    //echo date('d M Y', strtotime($dt['tanggal']));
                echo tgl_indo($dt['tanggal']);

                if ($dt['tgl_entri_laporan'] != NULL) {
                        echo "<br/><small><span class='text-success'>Dilaporkan pada ".
                        tglwaktu_indo($dt['tgl_entri_laporan'])."
                    </span></small>";     
                }
            ?>
            </td>

            <td><?= $dt['kegiatan_harian_skp']; ?><br/><u><?= $dt['kegiatan_bulanan']; ?></u></td>
            <!--<td><?= $dt['kegiatan_bulanan']; ?></td>-->
            <td><?= $dt['kuantitas'] . ' ' . $dt['satuan_kuantitas']; ?></td>
            <td style="background: <?= $dt['proses'] == 1 ? 'green' : '' ?>;text-align: center;font-weight: bold;">
                <?= $dt['proses'] == 1 ? "Proses" : ""; ?></td>
            <td class="tengah"><?= $link_detail; ?></td>
            <td class="tengah">

                <!--<input type="checkbox" class="form-control check" id="<?= $dt['id_opmt_realisasi_harian_skp'] ?>" <?= $dt['sesuai'] == 1 ? 'checked' : '' ?>>
                -->

                <?php
                //$selisih = date('Y-m-d', strtotime('+2 month', strtotime($dt['tanggal'])));
                //$hariini = date('Y-m-d');
                //if ($selisih >= $hariini) {
                ?>
                <select class="form-control cekVerifikasi" class="cboVerifikasi"
                    id="<?= $dt['id_opmt_realisasi_harian_skp'] ?>">
                    <option value="">Belum Verifikasi </option>
                    <option value="100" <?= $dt['verifikasi']==100?'selected':'' ?>>Sangat Baik</option>
                    <option value="90" <?= $dt['verifikasi']==90?'selected':'' ?>>Baik</option>
                    <option value="75" <?= $dt['verifikasi']==75?'selected':'' ?>>Cukup</option>
                    <option value="60" <?= $dt['verifikasi']==60?'selected':'' ?>>Kurang</option>
                    <option value="50" <?= $dt['verifikasi']==50?'selected':'' ?>>Buruk</option>
                </select>
                <?php
                //} else {

                    //echo "<div style='font-size:12px;font-weight:normal;float:center;color:red;'>Melewati batas waktu <br/> yang diizinkan</div>";
                //}
                ?>
            </td>
        </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
    <tfoot class="ui-state-default">
        <tr>
            <td colspan="3" class="ui-state-default">Jumlah Kegiatan Harian SKP</td>
            <td class="ui-state-default"><?= count($dt_harian) . ' Kegiatan' ?></td>
            <td colspan="3" class="ui-state-default">Jumlah Diverifikasi</td>
            <td colspan="2" class="ui-state-default"><?= $ttl_sesuai ?> Kegiatan</td>
        </tr>
        <!-- <tr>
            <td colspan="6" class="ui-state-default">Persentase</td>
            <td colspan="3" class="ui-state-default" ><?=count($dt_harian)==0?0: number_format($ttl_sesuai / count($dt_harian) * 100,2) ?> %</td>
        </tr> -->
    </tfoot>
</table>
<div style="float:left;margin-top:-20px;">
    <div class="col-md-12">
        <table class="table" id="tblCek" >
            <tr>
                <td><input type="checkbox" class=" check-all" title="100" style='white-space: nowrap;'></td>
                <td>All Sangat Baik</td>
                <td><input type="checkbox" class=" check-all" title="90" style='white-space: nowrap;'></td>
                <td>All Baik</td>
                <td><input type="checkbox" class="  check-all" title="75" style='white-space: nowrap;'></td>
                <td>All Cukup</td>
                <td><input type="checkbox" class=" check-all" title="60" style='white-space: nowrap;'></td>
                <td>All Kurang</td>
                <td><input type="checkbox" class=" check-all" title="50" style='white-space: nowrap;'></td>
                <td>All Buruk</td>
            </tr>
        </table>

    </div>

</div>
<div style="clear:both"></div>
<div style="font-size:10px;font-weight:bold;float:right;">loaded in {elapsed_time} seconds</div>
<script>
$('.cekVerifikasi').on('change', function() {
    var cek = $(this).val();
    var id = $(this).attr('id');
    $.post('<?=base_url()?>c_harian_skp/update_verifikasi', {id:id,cek:cek}, function(res) {
        refresh_harian_skp();
    });
});
$('.check-all').on('change', function() {
    var cek = $(this).is(":checked");
    var nilai = $(this).attr('title');
    if(cek){
        $('.check-all').prop('checked', false);
        $(this).prop('checked', true);
    }
    $('.cekVerifikasi').each(function() {
        if (cek) {
            $(this).val(nilai);
            var id = $(this).attr('id');
            $.post('c_harian_skp/update_verifikasi', {
        id: id,
        cek: nilai
    }, function(x) {
       console.log(x);
    });
        } else {
            $(this).val('');
        }
    });
    if(cek){
       refresh_harian_skp();
    }
});


function detail_harian(id) {
    var dialog = new BootstrapDialog({
        message: function() {
            var $message = $('<div></div>').load('c_harian_skp/detail' + '/' + id);
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
</script>