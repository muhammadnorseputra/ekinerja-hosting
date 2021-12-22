
<style>
    .dataTables_length{
        color:#0000C0 !important;
    }.breadcrumb a{
        color:#285e8e !important;font-size:12px !important;
    }
</style>
<ol class="breadcrumb bc-3" style="margin-top:-30px;">
    <li>
        <a href="javascript:void(0)">
            <i class="glyphicon glyphicon-home"></i>
            SKP
        </a>
    </li>
    <li><a href="javascript:void(0)">Tugas Tambahan Detail</a></li>
</ol>
<div style="padding:10px;margin-top:-30px;">
    <div style="float:left;">
        <button class="btn btn-info btn-lg fa fa-plus" onclick="tambah_tugas_tambahan_harian()">Tambah</button>
    </div>
    <div style="float: right;">
        <table style="font-size: 12px;">
            <tr>
                <td>Bulan</td>
                <td>
                    <select class="form-control" id="bulan">
                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                            <option value="<?= $i ?>" <?= $i == date('n') ? 'selected' : '' ?> ><?= bulan($i) ?></option>
                        <?php } ?>
                    </select>
                </td></td>
                <td>Tanggal</td>
                <td>
                    <input type="text" class="form-control tanggal" id="tanggal" />
                </td>
                <td><button class="btn btn-primary btn-lg fa fa-search-plus" onclick="refresh_tugas_tambahan()" >Cari</button></td>
            </tr>
        </table>
    </div>
    <br>
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Tugas Tambahan</th>
                <th>No SK </th>
                <th>Lap. Harian Tugas Tambahan</th>
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
            "url": "<?php echo site_url('c_tugas_tambahan2/ajax_list2') ?>",
            "type": "POST",
            "data": function (d) {
                d.tanggal = $('#tanggal').val();
                d.bulan = $('#bulan').val();

            }
        }, scrollY: 230, "scrollX": true,

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "width": "3%", className: "dt-center",
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, {
                "width": "10%", className: "dt-center",
                "targets": [1]
            }, {
                "width": "20%", className: "dt-center", "orderable": false,
                "targets": [2]
            }, {
                "width": "20%", className: "dt-center", "orderable": false,
                "targets": [3]
            }, {
                "width": "20%", className: "dt-center", "orderable": false,
                "targets": [4]
            }, {
                "width": "10%", className: "dt-center", "orderable": false,
                "targets": [5]
            }, {
                "width": "10%", className: "dt-center", "orderable": false,
                "targets": [6]
            },
        ],

    });

    function refresh_tugas_tambahan() {
        table.ajax.reload();
    }

    $('.tanggal').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true
    });

    function tambah_tugas_tambahan_harian() {
        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_tugas_tambahan2/tambah_tugas_tambahan_harian');
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

    function hapus_tugas_tambahan_harian(id) {
        var r = confirm("Yakin ingin menghapus tugas tambahan ini ?");
        if (r) {
            $.post('c_tugas_tambahan2/hapus_tugas_tambahan_harian', {id: id}, function (hasil) {
                if (hasil.status == 1) {
                    refresh_tugas_tambahan();
                }
            });
        }
    }

    function ubah_tugas_tambahan_harian(id) {
        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_tugas_tambahan2/ubah_tugas_tambahan_harian' + '/' + id);
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