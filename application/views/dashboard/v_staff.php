<?php
if ($rataSKP['rata'] >= 91) {
    $ket = 'Sangat Baik';
} elseif ($rataSKP['rata'] >= 76) {
    $ket = 'Baik';
} elseif ($rataSKP['rata'] >= 61) {
    $ket = 'Cukup';
} elseif ($rataSKP['rata'] >= 51) {
    $ket = 'Kurang';
} else {
    $ket = 'Buruk';
}
?>
<style>
    .breadcrumb a {
        color:#002a80 !important;
    }
    
    .modal.fade .modal-dialog {
     -webkit-transform: scale(0.1);
     -moz-transform: scale(0.1);
     -ms-transform: scale(0.1);
     transform: scale(0.1);
     top: 300px;
     opacity: 0;
     -webkit-transition: all 0.3s;
     -moz-transition: all 0.3s;
     transition: all 0.3s;
    }
    
    .modal.fade.in .modal-dialog {
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
        -webkit-transform: translate3d(0, -300px, 0);
        transform: translate3d(0, -300px, 0);
        opacity: 1;
    }
</style>
<script type="text/javascript">
    $(function () {
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },

            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            }, dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#000000',
                backgroundColor: '#FFFFFF',
                align: 'center',
                x: 4,
                y: 0,
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            }, credits: {
                enabled: false
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0, dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [{
                    name: 'SKP', color: '#0066FF',
                    data: [<?= $data_skp ?>]

                }, {
                    name: 'Tugas Tambahan', color: '#FF0000',
                    data: [<?= $data_tugas ?>]

                }, {
                    name: 'Non SKP', color: '#007d3d',
                    data: [<?= $data_prod ?>]

                }]
        });
    });

    Highcharts.chart('container2', {

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: ''
        }, credits: {
            enabled: false
        },

        pane: {
            startAngle: -90,
            endAngle: 90,
            background: [{
                    backgroundColor: {
                        linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, '#FFF'],
                            [1, '#333']
                        ]
                    },
                    borderWidth: 0, shape: 'arc',
                    outerRadius: '109%'
                }, {
                    backgroundColor: {
                        linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, '#333'],
                            [1, '#FFF']
                        ]
                    },
                    borderWidth: 1, shape: 'arc',
                    outerRadius: '107%'
                }, {
                    shape: 'arc', borderWidth: 1
                }, {
                    backgroundColor: '#DDD',
                    borderWidth: 0, shape: 'arc',
                    outerRadius: '105%',
                    innerRadius: '103%'
                }]
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 100,
            innerRadius: '75%',
            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 5,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: '<?= $ket ?>'
            },
            plotBands: [{
                    from: 0,
                    to: 50,
                    color: '#b70100', text: "tes" // green
                }, {
                    from: 51,
                    to: 60,
                    color: '#e3861c' // yellow
                }, {
                    from: 61,
                    to: 75,
                    color: '#fcf157' // red
                }, {
                    from: 76,
                    to: 90,
                    color: '#49c259' // red
                }, {
                    from: 91,
                    to: 100,
                    color: '#007237' // red
                }]
        },

        series: [{
                name: 'Nilai',
                data: [<?= number_format($rataSKP['rata'], 2) ?>],
                tooltip: {
                    valueSuffix: ''
                }
            }]

    },
// Add some life
            );
            
            $(document).ready(function() {
                $("#myModal").modal('show');
            });
</script>
<div style="width: 100% !important;">
    <div style="height:200px;">
        <ol class="breadcrumb bc-2" style="margin-top:-30px;">
            <li>
                <a href="javascript:void(0">
                    <i class="glyphicon glyphicon-home"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="javascript:void(0)">User</a></li>
        </ol>
        <div class="row" style="padding-bottom:-200px;">
            <div style="text-align: center;font-weight: bold;float:left;margin-left:100px;">
                JANUARI - DESEMBER <?= date('Y') ?>
                <div id="container" style="min-width: 600px;height:300px;  margin: 0 auto;"></div>
            </div>
            <div style="text-align: center;font-weight: bold;margin-bottom: -200px;float:right;">
                RATA-RATA KINERJA BULANAN TAHUN <?= date('Y') ?>
                <div id="container2" style="min-width: 600px; height:480px; margin: 0 auto"></div>
            </div>
            <div class="col-md-12">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--<div class="modal-header">-->
      <!--  <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>-->
      <!--</div>-->
      <div class="modal-body text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="glyphicon glyphicon-remove"></i></button>
        <h3>Pengumuman Terbaru</h3>
        <h4>Daily Evaluation System (E-Kinerja)</h4>
        <div class="well danger well-sm" align="left">
            <small><h4 class='text-danger'>Perhatian</h4>
            <p>Pastikan seluruh laporan harian anda telah sesuai (masuk dalam) kegiatan SKP Bulanan yang seharusnya.
            Laporan harian yang tidak memiliki kegiatan SKP Bulanan atau masuk dalam kegiatan SKP lain, akan menyebabkan kesalahan pada proses perhitungan realisasi bulanan
            sehingga tombol Approve (pada sisi Atasan Langsung) tidak akan tampil.</p>
            </small>
        </div>
        <div align='left'>
            <b><div class='text-info'>Catatan versi terbaru</div></b>
            <blockquote>
                <small>Pada kondisi awal suatu target bulanan baru ditambahkan, realisasi waktu akan bernilai 0 (NOL) hari.</small>
            </blockquote>
            <blockquote>
                <small>Jumlah realisasi waktu untuk suatu kegiatan bulanan, disesuaikan dengan jumlah hari pada laporan harian yang terkait dengan kegiatan tersebut.</small>
            </blockquote>
            <blockquote>
                <small>Perubahan jumlah target waktu, tidak boleh melebihi jumlah realisasi waktu.</small>
            </blockquote>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>