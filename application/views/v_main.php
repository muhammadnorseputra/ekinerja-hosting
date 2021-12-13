
<html>
    <head>
        <title>EKINERJA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="EKINERJA" />
        <link href="_images/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <meta name="google-site-verification" content="685uuxqu76JDgkvpNNj0Ojz9AhpNUylPgXLLt7vbgdI" />
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-199508931-3"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-199508931-3');
        </script>
        <style>
            .badge {
                -webkit-animation-name: blinker;
                -webkit-animation-duration: 1s;
                -webkit-animation-timing-function: linear;
                -webkit-animation-iteration-count: infinite;

                -moz-animation-name: blinker;
                -moz-animation-duration: 1s;
                -moz-animation-timing-function: linear;
                -moz-animation-iteration-count: infinite;

                animation-name: blinker;
                animation-duration: 1s;
                animation-timing-function: linear;
                animation-iteration-count: infinite;
            }
            .badge:hover {
                color: #ffffff;
                text-decoration: none;
                cursor: pointer;
            }
            .badge-error {
                background-color: #b94a48;
            }
            .badge-error:hover {
                background-color: #953b39;
            }
            .badge-warning {
                background-color: #f89406;
            }
            .badge-warning:hover {
                background-color: #c67605;
            }
            .badge-success {
                background-color: #E13300 !important;
            }
            @-moz-keyframes blinker {  
                0% { opacity: 1.0; }
                50% { opacity: 0.0; }
                100% { opacity: 1.0; }
            }

            @-webkit-keyframes blinker {  
                0% { opacity: 1.0; }
                50% { opacity: 0.0; }
                100% { opacity: 1.0; }
            }

            @keyframes blinker {  
                0% { opacity: 1.0; }
                50% { opacity: 0.0; }
                100% { opacity: 1.0; }
            }
            @font-face {
                font-family: "lobster";
                src: url("_fonts/LobsterTwo-Regular.otf");
            }
            @font-face {
                font-family: "gotham";
                src: url("_fonts/Gotham Bold Regular.ttf");
            }
            html,body
            {
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
                overflow-x: hidden; 
                font-family: "Arial", sans-serif;
				
            }

            .dropdown ul li:hover{
                background: none !important;
            }
            
            .dropdown ul li{
                border-radius:0px;
                border-bottom:1px solid #ccc;
                padding:5px;
            }
            #header{
                padding-top:5px;
                padding-left:20px;
                color:#fff;
                margin-bottom:20px; 
                height:56px;
                box-shadow:0 3px 5px #eee;
                background: #fff;
            }
            #footer{
                padding:5px;font-size:10px; font-family: "Arial";
                text-align: center;color:black;
                background:#E6E6FA;
                padding:10px;
            }
            #header a{
                font-family: "arial";
            }
            .wrap{
                white-space:normal; word-wrap: break-word; height: 50px !important;text-align: center;
            }
            .wrap2{
                white-space:normal; word-wrap: break-word;width: 140px;vertical-align: middle;
            }.select2-search__field{
                z-index: 99999;
            }
            #profile{
                width: 150px;text-align: center;padding:10px;font-family: 'gotham';color:#002166;font-size:11px;
            }
            #footer2{
                text-align: center;
            }a{
                color: #666 !important;border-radius:0px;text-decoration: none;  font-family: "gotham";font-weight:bold; transition:all .3s ease;
            }a:hover{cursor:pointer;color:blue !important; } 
			.table{
                border-bottom: 3px solid #666 !important;border-radius:0px;font-size: 12px;
            }
			.angka{text-align: right;}
			.dropdown-menu a {color:#000 !important;font-size:11px;font-weight: bold;}
			ul a{font-size:11px !important;font-weight: bold;}
			button{font-size:12px !important;}
        </style>
        <link href="_css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
        <!--<link href="_css/bootstrap-table.min.css" type="text/css" rel="stylesheet" media="all">-->
        <link href="_css/bootstrap-dialog.min.css" type="text/css" rel="stylesheet" media="all">
        <link href="_css/nprogress.css" type="text/css" rel="stylesheet" media="all">
        <link href="_css/font-awesome.min.css" type="text/css" rel="stylesheet" media="all">
        <!--        <link href="_plugins/jqueryui/jquery-ui.min.css" type="text/css" rel="stylesheet" media="all">-->
        <link href="<?= base_url() ?>_css/datepicker3.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="_plugins/jQueryUI-1.11.4/jquery-ui.min.css"/>
        <link rel="stylesheet" type="text/css" href="_plugins/DataTables-1.10.15/css/dataTables.jqueryui.min.css"/>
        <link rel="stylesheet" type="text/css" href="_plugins/Responsive-2.1.1/css/responsive.jqueryui.min.css"/>
        
        <!-- Start waktu mulai dan selesai -->
        <link rel="stylesheet" type="text/css" href="_css/bootstrap-clockpicker.min.css">
        <!-- End waktu mulai dan selesai -->
    
    </head>
    <body>
        <div style="min-width:100% !important;">
            <div style="margin-bottom:0px;padding-left:30px;padding-right:30px;">
                <div class="col-md-12">
                    <div style="margin-top:15px;">
                        <div style="float:left">
                            <img src="_images/icon_dialScore.png" style="width:100px;">
                        </div>
                        <div style="float:left;">
                            <div style="width: 200px;text-align: left;padding:10px;">
                                <img src="_images/logo.png" style="width:200px;">
                            </div>
                        </div>
                    </div>
                    <div style="float:right;">
                        <div id="profile">
                            <span style="position:absolute;text-align: left;top:10px;right:5px;font-weight: bold;">Hai, Selamat Datang</span> <br>
                            <span style="position:absolute;text-align: left;top:30px;right:5px;"><?= $nama . " / " . $nip ?></span>
                            <span style="position:absolute;top:50px;right:5px;"><?= $jabatan . " / " . $nama_uker ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="row" style="margin-top:5px;">
                <div class="col-md-12" id="menu_atas">
                    <div id="header" style="padding:1px;font-size:10px !important;">
                        <!--<div style="position:absolute;right:140px;top:-75px;"><a href="javascript:void(0)" onclick="menu('c_disposisi/bawahan');" ><span class="badge badge-success"><?= $ttl_dsp['ttl'] ?></span></a></div>-->
                        <div style="float:left;margin: 0 auto; text-align:center;">
                            <?php if ($jabatan == 'Admin') { ?>
                                <ul class="nav nav-tabs">
                                    <li><a href="./" class="wrap" style="width: 79px;line-height: 30px;">Beranda</a></li>
                                    <li class="dropdown">
                                        <a class="wrap dropdown-toggle" data-toggle="dropdown" style="width: 90px;line-height: 30px;">Data 
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)" onclick="menu('admin/c_jabatan')">Jabatan & Tunjangan</a></li>
                                            <li><a href="javascript:void(0)" onclick="menu('admin/c_uker')">Unit Kerja</a></li>
                                            <li><a href="javascript:void(0)" onclick="menu('admin/c_pangkat')">Gol. Ruang dan Pangkat</a></li>
                                            <li><a href="javascript:void(0)" onclick="menu('admin/c_user')">User</a></li>
                                            <li><a href="javascript:void(0)" onclick="menu('admin/c_admin')">Admin</a></li>
                                            <li><a href="javascript:void(0)" onclick="menu('admin/c_kuantitas')">Satuan Kuantitas</a></li>
                                            <li><a href="javascript:void(0)" onclick="menu('admin/c_rkt')">Rencana Kerja Tahunan</a></li>
                                            <li><a href="javascript:void(0)" onclick="menu('admin/c_kelompok')">Kelompok Jabatan</a></li>
                                            <li><a href="javascript:void(0)" onclick="sync_user()">Sync User</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:void(0)" style="width: 130px;line-height: 30px;" onclick="pengaturan()" class="wrap">Pengaturan</a></li>
                                    <li><a href="javascript:void(0)" style="width: 230px;line-height: 30px;" onclick="menu('admin/c_rekap_skp')" class="wrap">Rekap (Berdasarkan SKP Bulanan)</a></li>
                                    <li><a href="javascript:void(0)" style="width: 130px;line-height: 30px;" onclick="menu('admin/c_pegawai_terbaik')" class="wrap">Pegawai Terbaik</a></li>
                                    <li><a href="javascript:void(0)" style="width: 130px;line-height: 30px;" onclick="menu('admin/c_spesimen')" class="wrap">Spesimen Lokasi</a></li>
                                    <li><a href="javascript:void(0)" style="width: 130px;line-height: 30px;" onclick="menu('admin/c_fitur')" class="wrap">Fitur View Rekap</a></li>
                                    <li><a href="javascript:void(0)" style="width: 230px;line-height: 30px;" onclick="menu('admin/c_kegiatan_jabatan')" class="wrap">Data Kegiatan Jabatan</a></li>
                                    <li>  
                                        <a href="c_main/logout" class="wrap" style="width: 80px;line-height: 30px;">Logout</a> 
                                    </li>
                                </ul>

                            </div>
                        <?php } elseif ($jabatan == 'Operator') { ?>
                            <a href="./" class="wrap">Beranda</a>
                            <a href="javascript:void(0)" onclick="menu('c_operator/absensi')" class="wrap">Absensi Manual</a>
                            <a href="javascript:void(0)" onclick="menu('c_operator/faktor_pengurang')" class="wrap">Faktor Pengurang</a>
                            <a href="c_main/logout" class="wrap">Logout</a>

                        <?php } else { ?>
                            <style>
                                .nav-tabs li:hover{
                                    background-color: none !important;color:red;
                                }
                            </style>
                            <ul class="nav nav-tabs">
                                <li><a href="./" class="wrap" style="width: 79px;line-height: 30px;">Beranda</a></li>
                                <li class="dropdown">
                                    <a class="wrap dropdown-toggle" data-toggle="dropdown" style="background:lavender; width: 90px;line-height: 30px;">SKP 
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li style="background:lavender; color:#fff;"><a href="javascript:void(0)" onclick="menu('c_tahunan_skp')">Target dan Realisasi Tahunan</a></li>
                                        <li><a href="javascript:void(0)" onclick="menu('c_tahunan_skp/bawahan')">SKP Tahunan Staf </a></li>
                                        <li style="background:lavender; color:#fff;"><a href="javascript:void(0)" onclick="menu('c_bulanan_skp')">Target dan Realisasi Bulanan</a></li>
                                        <li><a href="javascript:void(0)" onclick="menu('c_bulanan_skp/bawahan')">SKP Bulanan Staf</a></li>
                                    </ul>
                                </li>
                                <!--
                                <li class="dropdown">
                                    <a class="wrap dropdown-toggle" data-toggle="dropdown" style="width: 140px;line-height: 30px;">Perilaku Bulanan
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)" onclick="menu('c_atasan/nilai_perilaku')">Nilai Perilaku Bulanan Bawahan</a></li>
                                    </ul>
                                </li>
                                -->
                                <li class="dropdown">
                                    <a class="wrap dropdown-toggle" data-toggle="dropdown" style="background:lavender; width: 120px;">Lap. Harian Kinerja 
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li style="background:lavender;"><a href="javascript:void(0)" onclick="menu('c_harian_skp')">Lap. Harian Kinerja SKP</a></li>
                                        <li><a href="javascript:void(0)" onclick="menu('c_harian_skp/bawahan')">Lap. Harian Kinerja SKP Staf</a></li>
                                        <li><a href="javascript:void(0)" onclick="menu('c_produktivitas')">Lap. Harian Non SKP</a></li>
                                        <li><a href="javascript:void(0)" onclick="menu('c_produktivitas/bawahan')">Lap. Harian Non SKP Staf</a></li>
                                    </ul>
                                </li>
                                <!--
                                <li class="dropdown">
                                    <a class="wrap dropdown-toggle" data-toggle="dropdown" style="width: 240px;line-height: 30px;">Lap. Harian Tugas Tambahan 
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)" onclick="menu('c_tugas_tambahan2')">Tugas Tambahan</a></li>
                                        <li><a href="javascript:void(0)" onclick="menu('c_tugas_tambahan2/harian')">Lap. Harian Tugas Tambahan Detail</a></li>

                                    </ul>
                                </li>
                                -->
                                <!--                            <li class="dropdown">
                                                                <a class="wrap dropdown-toggle" data-toggle="dropdown" style="width: 130px;line-height: 30px;">Non SKP
                                                                    <span class="caret"></span>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="javascript:void(0)" onclick="menu('c_produktivitas')">Lap. Harian Non SKP</a></li>
                                                                    <li><a href="javascript:void(0)" onclick="menu('c_produktivitas/bawahan')">Lap. Harian Non SKP Bawahan</a></li>
                                                                </ul>
                                                            </li>-->
                                <!--
                                <li><a href="javascript:void(0)" onclick="menu('c_kreatifitas')" class="wrap" style="width: 100px;line-height: 30px;">Kreatifitas</a></li>
                                <li class="dropdown">
                                    <a class="wrap dropdown-toggle" data-toggle="dropdown" style="width: 130px;line-height: 30px;">Disposisi 
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)" onclick="menu('c_disposisi')">Disposisi</a></li>

                                        <li><a href="javascript:void(0)" onclick="menu('c_disposisi/bawahan')">Tindak Lanjut</a></li>
                                    </ul>
                                </li>
                                -->
                                <li class="dropdown">
                                    <a class="wrap dropdown-toggle" data-toggle="dropdown" style="background:lavender; width: 130px;line-height: 30px;">Lain-lain 
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)" onclick="menu('c_staff_bawahan')">Edit Data Staf</a></li>
                                        <li style="background:lavender;"><a href="javascript:void(0)" onclick="profile()" >Edit Profile</a></li>
                                    </ul>
                                </li>
                                <!--
                                <li class="dropdown">
                                    <a class="wrap dropdown-toggle" data-toggle="dropdown" style="width: 145px;line-height: 30px;margin-right:-20px;">Detail SKP Tahunan 
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)" onclick="menu('c_detail_skp_tahunan/user')">User</a></li>
                                        <li><a href="javascript:void(0)" onclick="menu('c_detail_skp_tahunan')">Bawahan</a></li>
                                    </ul>
                                </li>
                                -->
                                <li>  
                                    <a href="c_main/logout" class="wrap" style="width: 80px;line-height: 30px;">Logout</a> 
                                </li>
                            </ul>
                        </div> 
                    </div>


                <?php } ?>
            </div>

            <div class="row" style="min-height: 400px;padding:15px;">
                <div class="col-md-12" id="tengah" style="padding:30px;">
                </div>
            </div>
            <!--
            <div class="row">
                <div class="col-md-12">
                    <div id="footer">
                        BADAN KEPEGAWAIAN, PENDIDIKAN DAN PELATIHAN DAERAH</br>
                        KABUPATEN BALANGAN</br>
                        http://ekinerja.bkppd-balangankab.info
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="footer2" style="font-size: 10px;">
                        Hak Cipta &copy 2017 Badan Kepegawaian Negara
                    </div>
                </div>
            </div>
            -->
        </div>
        <script src="_js/jQuery-2.1.4.min.js"></script>
        <!--<script type="text/javascript" src="_plugins/DataTables/js/jquery.dataTables.min.js"></script>-->
        <script type="text/javascript" src="_js/jquery.dataTables.min.js"></script>
        <script src="_js/bootstrap.min.js"></script>
        <script src="_js/bootstrap-dialog.min.js"></script>
        <script src="_js/nprogress.js"></script>
        <script src="_js/highcharts.js"></script>
        <script src="_js/highcharts-more.js"></script>
        <script src="_js/numeral.min.js"></script>
        <!--<script src="_js/jquery-migrate-3.0.0.js"></script>-->
        <script src="<?= base_url() ?>_js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="_plugins/jQueryUI-1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="_plugins/DataTables-1.10.15/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="_plugins/DataTables-1.10.15/js/dataTables.jqueryui.min.js"></script>
        <script type="text/javascript" src="_plugins/Responsive-2.1.1/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="_js/jquery.scrollTo.min.js"></script>
        <script type="text/javascript" src="_js/dataTables.scrollResize.js"></script>
        <script type="text/javascript" src="_plugins/Responsive-2.1.1/js/responsive.jqueryui.min.js"></script>
        <script type="text/javascript" src="_js/bootstrap-timepicker.js"></script>
        
        <!-- Start Jam mulai selesai -->
        <script type="text/javascript" src="_js/bootstrap-clockpicker.min.js"></script>
        <!-- End Jam mulai selesai -->
        
        <script>
                                            function menu(link) {
                                                $.ajax({
                                                    url: link,
                                                    type: 'get',
                                                    dataType: "html",
                                                    beforeSend: function () {
                                                        NProgress.start();
                                                        $('#tengah').hide();
                                                        $('#tengah').empty();
                                                    },
                                                    success: function (data) {
                                                        NProgress.done();
                                                        $('#tengah').show();
                                                        $('#tengah').html(data);
                                                    }
                                                });
                                            }

                                            function getFormData($form) {
                                                var unindexed_array = $form.serializeArray();
                                                var indexed_array = {};

                                                $.map(unindexed_array, function (n, i) {
                                                    indexed_array[n['name']] = n['value'];
                                                });

                                                return indexed_array;
                                            }
                                            function pengaturan() {

                                                var dialog = new BootstrapDialog({
                                                    message: function () {
                                                        var $message = $('<div></div>').load('c_admin/pengaturan');
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
                                            function profile() {
                                                var dialog = new BootstrapDialog({
                                                    title: 'Ubah Profile',
                                                    message: function () {
                                                        var $message = $('<div></div>').load('c_user/profile');
                                                        return $message;
                                                    }
                                                });
                                                dialog.realize();
                                                //                                        dialog.getModalHeader().hide();
                                                dialog.getModalBody().css('background-color', 'lightblue');
                                                dialog.getModalBody().css('color', '#000');
                                                dialog.setSize(BootstrapDialog.SIZE_NORMAL);
                                                dialog.open();

                                            }

                                            menu('c_dashboard');

                                            function sync_user() {
                                                var r = confirm("Yakin ingin Sync Data User ???");
                                                if (r) {
                                                    $.post("c_main/sync_user", {}, function (hasil) {
                                                        alert(hasil.ket);
                                                    });
                                                }
                                            }
        </script>

    </body>
</html>