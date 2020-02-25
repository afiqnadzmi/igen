<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style>
    td{
        vertical-align: top;
    }
</style>

<?php
include_once 'widget/report_css.php';
$emp_id = isset($_GET["emp_id"]) ? $_GET["emp_id"] : '';
$sql = "select * from employee where id in (" . $emp_id . ")";
$rs = mysql_query($sql);
while ($row = mysql_fetch_array($rs)) {
    ?>
    <div class="main_content" style='width:800px;min-height:100px'>
        <div style="text-align:right" class='font_size10px'>BORANG PCB/TP2 (1/2011)</div>
        <div style="text-align:center;font-weight:bold">LEMBAGA HASIL DALAM NEGERI MALAYSIA<br/>
            BORANG TUNTUTAN MANFAAT BERUPA BARANGAN DAN<br/>
            NILAI TEMPAT KEDIAMAN YANG DISEDIAKAN OLEH MAJIKAN<br/>
            BAGI TUJUAN POTONGAN CUKAI BULANAN (PCB)</div>

        <div style="text-align:center;">(KAEDAH-KAEDAH CUKAI PENDAPATAN (POTONGAN DARIPADA SARAAN) 1994)<br/>
            BORANG DITETAPKAN DI BAWAH SEKSYEN 152, AKTA CUKAI PENDAPATAN 1967<br/>
        </div>


        <table border="0" width="100%">
            <?php
            $rs1 = mysql_fetch_array(mysql_query("select * from company where id=" . $row['company_id']));
            ?>
            <tr><td>Nama Majikan</td><td>:</td><td><input type="text" class="text_width" value="<?php echo $rs1['name']; ?>"/></td></tr>
            <tr><td>No Rujukan Majikan</td><td>:</td><td><input type="text" style="width:500px" value="<?php echo $rs1['income_tax_no']; ?>"/></td></tr>
            <tr><td colspan="3" class="header">BAHAGIAN A : MAKLUMAT INDIVIDU</td></tr>
            <tr><td>A1 Nama</td><td>:</td><td><input type="text" class="text_width" value="<?php echo $row["full_name"] ?>" /></td></tr>
            <tr><td>A2 No KP Baru</td><td>:</td><td><input type="text" value="<?php echo $row["ic"] ?>"  /></td></tr>
            <tr><td>A3 No KP Lama</td><td>:</td><td><input type="text" /></td></tr>
            <tr><td>A4 No Tentera/Polis</td><td>:</td><td><input type="text" /></td></tr>
            <tr><td>A5 No Pasport</td><td>:</td><td><input type="text" /></td></tr>
            <tr><td>A6 No Rujukan Cukai SG/OG</td><td>:</td><td><input type="text" value="<?php echo $row['income_tax_num']; ?>"/></td></tr>
            <tr><td>A7 No Pekerja/No Gaji</td><td>:</td><td><input type="text" /></td></tr>
        </table>

        <table border="0" width="100%">
            <tr><td colspan="2" class="header">BAHAGIAN B : MAKLUMAT MANFAAT BERUPA BARANGAN (MBB)</td></tr>
            <tr><td></td><td style="text-align:right">Amaun Bulanan</td></tr>
            <tr><td width="60%">B1 Kereta :</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
            <tr><td width="60%">B2 Pemandu :</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
            <tr><td width="60%">B3 Kelengkapan Rumah, Perkakas dan Perlengkapan :</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
            <tr><td width="60%">B4 Hiburan dan Rekreasi :</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
            <tr><td width="60%">B5 Tukang Kebun :</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
            <tr><td width="60%">B6 Pembantu Rumah :</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
            <tr><td width="60%">B7 Manfaat Percutian :</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
            <tr><td width="60%">B8 Keahlian dalam Kelab Rekreasi :</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
            <tr><td width="60%">B9* Jumlah lain-lain manfaat yang diterima :</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
            <tr><td colspan="2">*(Sila nyatakan jenis lain-lain manfaat yang diterima dalam lampiran yang berasingan)</td></tr>
            <tr><td colspan="2"  class="header">BAHAGIAN C : MAKLUMAT NILAI TEMPAT KEDIAMAN (NTK) YANG DISEDIAKAN OLEH MAJIKAN</td></tr>
            <tr><td width="60%">C1 Nilai tempat kediaman yang disediakan oleh majikan</td><td style="text-align:right">RM<input type="text" class="text_width1" /></td></tr>
        </table>

        <table border="0" width="100%">
            <tr><td colspan="2" class="header">BAHAGIAN D : AKUAN PEKERJA</td></tr>
            <tr><td colspan="2">Saya bersetuju MBB dan NTK dimasukkan sebagai sebahagian daripada saraan saya mulai</td></tr>
            <tr><td colspan="2">bulan<input type="text"/> tahun potongan<input type="text"/></td></tr>
            <tr><td colspan="2"><br/>Saya mengaku bahawa semua maklumat yang dinyatakan dalam borang ini adalah benar, betul dan lengkap. Sekiranya maklumat yang diberikan tidak benar, tindakan mahkamah boleh diambil ke atas saya di bawah perenggan 113(1)(b) Akta Cukai Pendapatan 1967.<br/><br/></td></tr>
            <tr><td cellpadding="40px	">
                    <table cellspacing="0" cellpadding="0">
                        <tr>
                            <td> <input style='width:40px'></td>
                            <td><input style='width:10px' value="-" readonly></td>
                            <td><input style='width:40px'></td>
                            <td><input style='width:10px' value="-" readonly></td>
                            <td><input style='width:50px'></td>
                        </tr>
                        <tr>
                            <td>Hari</td>
                            <td></td>
                            <td>Bulan</td>
                            <td></td>
                            <td>Tahun</td>
                        </tr>
                    </table>

                </td>
                <td>
                    -------------------------------<br/>
                    Tandatangan
                </td></tr>
        </table>



        <table border="0" width="100%">
            <tr><td colspan="2" class="header">BAHAGIAN E : PERSETUJUAN MAJIKAN</td></tr>
            <tr>
                <td width="380px">
                    Permohonan pekerja di atas dipersetujui mulai bulan potongan
                </td>
                <td>
                    <input type="text" style="width:40px"/> tahun potongan<input type="text" style="width:40px"/></td></tr>
            <tr><td cellpadding="40px	">
                    <table cellspacing="0" cellpadding="0">
                        <tr>
                            <td> <input style='width:40px'></td>
                            <td><input style='width:10px' value="-" readonly></td>
                            <td><input style='width:40px'></td>
                            <td><input style='width:10px' value="-" readonly></td>
                            <td><input style='width:50px'></td>
                        </tr>
                        <tr>
                            <td>Hari</td>
                            <td></td>
                            <td>Bulan</td>
                            <td></td>
                            <td>Tahun</td>
                        </tr>
                    </table>

                </td>
                <td>
                    Name:<br/>
                    Jawatan:<br/>
                    Alamat majikan:<br/>
                </td></tr>
        </table>
        <div class="header">
            NOTA PENERANGAN
        </div>
        <ol style="font-size: 12px;">
            <li>Pemohonan memasukkan nilai MBB dan NTK sebagai sebahagian daripada saraan bulanan dalam menentukan amaun PCB tertakluk kepada persetujuan majikan.Pekerja tidak boleh membatalkan pilihan bagi memasukkan MBB dan NTK sebagai sebahagian daripada saraan yang tertakluk kepada PCB pada tahun semasa dengan majikan yang sama.</li>
            <li>Borang ini hendaklah diisi oleh pekerja setiap tahun dan satu salinan diserahkan kepada majikan untuk tujuan pelarasan pengiraan PCB.</li>
            <li>Pindaan hanya boleh dilakukan sekiranya terdapat perubahan nilai MBB dan NTK yang diberikan oleh majikan dalam tahun semasa.</li>
            <li>MBB adalah manfaat-manfaat berupa barangan yang tidak boleh ditukarkan kepada wang. Manfaat ini dikategorikan sebagai pendapat ankasar daripada penggajian dibawah perenggan 13(1)(b) Akta Cukai Pendapatan 1967. Sila rujuk Ketetapan Umum No. 2/2004 dan Tambahan - Manfaat Berupa Barangan untuk keterangan lanjut.</li>
            <li>NTK merupakan tempat kediaman yang disediakan oleh majikan kepada pekerjanya. Manfaat ini dikategorikan sebagai pendapatan kasar daripada penggajian dibawah perenggan 13(1)(c) Akta Cukai Pendapatan 1967. Sila rujuk Ketetapan Umum No.3/2005 dan Tambahan - Manfaat Tempat Kediaman Yang Disediakan Oleh Majikan Kepada Pekerjanya untuk keterangan lanjut.</li>
            <li>Kaedah pengiraan MBB dan NTK untuk mendapatkan amaun bulanan adalah seperti berikut:</li>
        </ol>
        <center><img src="images/tp2_formula.jpg" width="40%"/></center>
    </div>
    <div class="divBreak"><table></table></div>
    <?php
}
?>
<style type="text/css">
    .header{
        background-color:black;
        color:white;
        font-weight:bold;
        -webkit-print-color-adjust: exact;
    }
    .text_width
    {
        width:500px
    }
    ul li{
        font-size:11px;
    }
    
    @media print{
        .divBreak table{
            page-break-after:always;
        }
    }
</style>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>