
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
    <li><a href="javascript:void(0)">Bulanan</a></li>
</ol>
<div style="padding:10px;margin-top:-30px;">
   
    <?php
    //$tglini = date('d');
    //if ($tglini <= 10) {
        ?>
        <div style="float:left;">
            <button onclick="tambah_periode_bulanini()" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Periode Bulan Ini</button>
        </div>
        <?php
    //}
    ?>
    
    <div style="float: right;">
        <table>
            <tr>
                <td><input type="text" id="bulanan_skp" class="form-control" placeholder="Tahun" value="<?=date('Y')?>"></td>
                <td> <button onclick="refreshBulanan()" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>Cari</button></td>
            </tr>
        </table>

    </div>
    <table id="table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl. Entri</th>
                <th>Periode</th>
                <th>Nilai SKP</th>
                <th>Hapus</th>
                <th>Target SKP Bulanan</th>
                <th>Realisasi SKP Bulanan</th>
                <th>Status Approve</th>
                <th>Approval Terakhir</th>
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
        "paging":   false,
        // "ordering": false,
        // "info":     false,
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('c_bulanan_skp/ajax_list') ?>",
            "type": "POST",
            "data": function (d) {
                d.status = $('#bulanan_skp').val();
            }
        }, scrollY: 430, "scrollX": true,

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "width": "3%", className: "dt-center",
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, {
                "width": "8%", className: "dt-center",
                "targets": [1]
            }, {
                "width": "8%", className: "dt-center", "orderable": false,
                "targets": [2]
            }, {
                "width": "8%", className: "dt-center", "orderable": false,
                "targets": [3]
            }, {
                "width": "5%", className: "dt-center", "orderable": false,
                "targets": [4]
            }, {
                "width": "13%", className: "dt-center", "orderable": false,
                "targets": [5]
            }, {
                "width": "13%", className: "dt-center", "orderable": false,
                "targets": [6]
            }, {
               className: "dt-center", "orderable": false,
                "targets": [7],
                "createdCell": function (td, cellData, rowData, row, col) {
                    if (cellData == "DISETUJUI") {
                        $(td).css('background', 'LimeGreen');
                        $(td).css('color', 'white');
                    } else {
                        $(td).css('background', 'Tomato');
                        $(td).css('color', 'white');
                    }
                }
            }, {
                "width": "13%", className: "dt-center", "orderable": false,
                "targets": [8]
            },
        ],

    });

    function refreshBulanan() {
        table.ajax.reload();
    }

    function tambah_bulanan_skp() {
        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/tambah_bulanan_skp');
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

    function tambah_periode_bulanini(id) {
        menu('c_user/aksi_tambah_periode_bulanini');
    }

    function target_bulanan_skp(id) {
        menu('c_user/target_bulanan_skp' + '/' + id);
    }

    function realisasi_bulanan_skp(id) {
        menu('c_user/realisasi_bulanan_skp' + '/' + id);
    }

    function ubah_bulanan_skp(id) {

        var dialog = new BootstrapDialog({
            message: function () {
                var $message = $('<div></div>').load('c_user/ubah_bulanan_skp' + '/' + id);
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

    function hapus_bulanan_skp(id) {
        var r = confirm("Yakin ingin menghapus Bulanan SKP ini ?");
        if (r) {
            $.post('c_user/hapus_bulanan_skp', {id: id}, function (data) {
                if (data.status == 1) {
                alert(data.ket);
                    refreshBulanan();
                }
            });
        }
    }
</script>