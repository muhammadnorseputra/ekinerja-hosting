<?php
switch ($id) {
    case 1:
        ?>
        <div style="width:100%;margin:auto;text-align: left;padding-left:20px;">
            <h2>DES (DAILY EVALUATION SYSTEM)</h2>
        </div>
<div style="width:100%;margin:auto;padding:20px;font-size:24px;text-align: left;" class="sub-judul">
            Aplikasi DES adalah Sistem Informasi untuk menyusun SKP ( Sasaran Kinerja Pegawai ) sesuai
            PP 46 Tahun 2011, serta mengukur Kinerja Individu secara periode Bulanan dan Tahunan
        </div>
        <a href="<?= base_url('../semangat') ?>"><button class="button"><span>MASUK KE APLIKASI DES </span></button></a>
        <?php
        break;
    case 2:
        ?>
        <div style="width:100%;margin:auto;text-align: left;padding-left:20px;">
            <h2>E-PERILAKU 360</h2>
        </div>
        <div style="width:100%;margin:auto;padding:20px;font-size:22px;text-align: left;" class="sub-judul">
            <p>Aplikasi E-Perilaku 360 adalah Sistem informasi untuk melakukan Penilaian Perilaku Pegawai . Sistem Penilaian dilakukan secara tertutup dan Penilai dipilih secara acak.  Penilaian dilakukan Oleh :
            <ul>
                <li>Atasan Langsung</li>
                <li>Rekan / Peer</li>
                <li>Bawahan</li>
            </ul>
            
        </p>
        </div>
        <a href="<?= base_url('../360') ?>"><button class="button"><span>MASUK KE APLIKASI E-PERILAKU 360 </span></button></a>
        <?php
        break;
    case 3:
        ?>
        <div style="width:100%;margin:auto;text-align: left;padding-left:20px;">
            <h2>FORM PRESTASI KINERJA</h2>
        </div>
        <div style="width:100%;margin:auto;padding:20px;font-size:22px;text-align: left;" class="sub-judul">
            <p>Form Prestasi Kerja adalah Menu untuk mencetak Prestasi Kerja PNS. Form Prestasi Kerja merupakan Form yang memuat Nilai SKP (60%) dan Perilaku (40%). 
            </p>
        </div>
        <a href="<?=base_url('c_prestasi')?>"><button class="button"><span>MASUK KE MENU PRESTASI KERJA </span></button></a>

        <?php
        break;
}
?>