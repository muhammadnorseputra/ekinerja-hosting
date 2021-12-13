
<style>
    .dataTables_length{
        color:#0000C0 !important;
    }.breadcrumb a{
        color:#285e8e !important;font-size:12px !important;
    }.modal-dialog{
        min-width: 90%;
    }
</style>
<ol class="breadcrumb bc-3" style="margin-top:-30px;">
    <li>
        <a href="javascript:void(0)">
            <i class="glyphicon glyphicon-home"></i>
            SKP
        </a>
    </li>
    <li><a href="javascript:void(0)">Tahunan</a></li>
    <li><a href="javascript:void(0)">Target </a></li>
</ol>
<div style="padding:10px;margin-top:-30px;">
    <div style="float:left;">
        <button class="btn btn-primary" onclick="tambah_target_tahunan_skp('<?= $id ?>')"><i class="fa fa-plus"></i> Tambah</button>
    </div>
    <div style="float: right;">
        <table>
            <tr>
                <td><input type="hidden" id="id_target" class="form-control" value="<?= $id ?>"></td>
                <td><input type="text" id="tahunan_skp" class="form-control" placeholder="Tahun" value="<?=$tahun?>"?></td>
                <td> <button onclick="refreshTarget()" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>Cari</button></td>
                <td> <button class="btn ui-state-focus" onclick="cetak()"><i class=" fa fa-print"></i> Cetak</button></td>
            </tr>
        </table>

    </div>
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Kegiatan Tahunan1</th>
                <th>AK</th>
                <th>Target Kuantitas</th>
                <th>Target Kualitas</th>
                <th>Target Waktu</th>
                <th>Biaya</th>
                <th>Edit</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

</div>
<script type="text/javascript">
    var table;
    table = $('#table').DataTable({
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('c_tahunan_skp/ajax_list_target') ?>",
            "type": "POST",
            "data": function (d) {
                d.status = $('#tahunan_skp').val();
                d.id = $('#id_target').val();
            }
        }, scrollY: 230, "scrollX": true,
        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "width": "3%", className: "dt-center",
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, {
                "width": "3%",
                className: "dt-center",
                "targets": [1]
            }, {
                className: "dt-center", "orderable": true,
                "targets": [2]
            }, {
                "width": "10%", className: "dt-center", "orderable": false,
                "targets": [3]
            }, {
                "width": "10%", className: "dt-center", "orderable": false,
                "targets": [4]
            }, {
                "width": "10%", className: "dt-center", "orderable": false,
                "targets": [5]
            }
            , {
                "width": "10%", className: "dt-center", "orderable": false,
                "targets": [6]
            }
            , {
                "width": "10%", className: "dt-center", "orderable": false,
                "targets": [7]
            }
            , {
                "width": "10%", className: "dt-center", "orderable": false,
                "targets": [8]
            }
        ],
    });
    function refreshTarget() {
        table.ajax.reload();
    }

    function tambah_target_tahunan_skp(id) {
        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/tambah_target_tahunan_skp' + '/' + id);
                return $message;
            }
        });
        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_WIDE);
        dialog.open();
    }

    function ubah_target_tahunan_skp(id) {

        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/ubah_target_tahunan_skp' + '/' + id);
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

    function hapus_target_tahunan_skp(id) {
        var r = confirm("Yakin ingin menghapus target_tahunan_skp ini ?");
        if (r) {
            $.post('c_user/hapus_target_tahunan_skp', {id: id}, function (data) {
                if (data.status == 1) {
                    alert(data.ket);
                    refreshTarget();
                }
            });
        }
    }
    function cetak() {
        BootstrapDialog.show({
            //title: 'Pilih Lokasi Anda',
            //message: '<table class="table"><tr><td><select class="form-control" id="lokasi"><?= pilihan_list($spesimen, "lokasi_spesimen", "id_dd_spesimen", "") ?></select></td><td><button class="btn ui-state-default" onclick="cetak_target_tahunan_skp()">Cetak</button></td></tr></table>'
            title: 'Cetak Target Tahunan',
            //message: '<div class="row"><div class="col-md-3"><select class="form-control" id="lokasi"><?= pilihan_list($spesimen, "lokasi_spesimen", "id_dd_spesimen", "1") ?></select></div><div class="col-md-3"><input class="form-control" placeholder="Tanggal Cetak (dd-mm-yyyy)" size="10" maxlength="10" type="text" name="tanggal" id="tanggal"></div><div class="col-md-3"><button class="btn ui-state-default" onclick="cetak_target_tahunan_skp()"><i class=" fa fa-print"></i> Cetak</button></div></div>'
            message: '<div class="row"><div class="col-md-3"><select class="form-control" id="lokasi">><option value="1">Balangan</option></select></div><div class="col-md-3"><input class="form-control" placeholder="Tanggal Cetak (dd-mm-yyyy)" size="10" maxlength="10" type="text" name="tanggal" id="tanggal"></div><div class="col-md-3"><button class="btn ui-state-default" onclick="cetak_target_tahunan_skp()"><i class=" fa fa-print"></i> Cetak</button></div></div>'
        });
    }
    function cetak_target_tahunan_skp() {
        var id = <?= $id ?>;
        var lokasi = $('#lokasi').val();
        var tanggal = document.getElementById("tanggal").value;
        var dialog = new BootstrapDialog({
            title: '<div style="font-size:12px;">Laporan Data Target Tahunan SKP</div>',
            message: function () {
//                var $message = $('<div></div>').load('c_pdf/cetak_jfk/' + jenis );
                //var $message = $('<iframe src=c_pdf/cetak_target_tahunan_skp/' + id + '/' + lokasi + ' style="width:100%;height:300px;"></iframe>');
                var $message = $('<iframe src=c_pdf/cetak_target_tahunan_skp/' + id + '/' + lokasi + '/' + tanggal + ' style="width:100%;height:300px;"></iframe>');
                return $message;
            }
        });
        dialog.realize();
        dialog.getModalBody().css('background-color', 'lightblue');
        dialog.getModalBody().css('color', '#000');
        dialog.setSize(BootstrapDialog.SIZE_WIDE);
        dialog.open();
    }
</script>