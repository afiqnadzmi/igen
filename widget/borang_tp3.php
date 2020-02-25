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

    @media print{
        .divBreak table{
            page-break-after:always;
        }
    }
</style>

<?php
include_once 'widget/report_css.php';
$emp_id = isset($_GET["emp_id"]) ? $_GET["emp_id"] : '';
$sql = "select * from employee where id in (" . $emp_id . ")";
$rs = mysql_query($sql);
while ($row = mysql_fetch_array($rs)) {
    ?>
    <table class="main_content" style="width:800px;">
        <tr>
            <td>
                <table style="width:100%">
                    <tr>
                        <td>
                            <span class="font_size10px" style="float:right;">BORANG PCB/TP3 (1/2011)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class='h_title'>
                            LEMBAGA HASIL DALAM NEGERI MALAYSIA
                        </td>
                    </tr>
                    <tr>
                        <td class='h_title'>
                            BORANG MAKLUMAT BERKAITAN PENGGAJIAN DENGAN MAJIKAN-MAJIKAN TERDAHULU
                        </td>
                    </tr>
                    <tr>
                        <td class='h_title'>
                            DALAM TAHUN SEMASA BAGI TUJUAN POTONGAN CUKAI BULANAN (PCB)
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class='h_title font_size10px'>
                            (KAEDAH-KAEDAH CUKAI PENDAPATAN (POTONGAN DARIPADA SARAAN) 1994)
                        </td>
                    </tr>
                    <tr>
                        <td class='h_title font_size10px'>
                            BORANG DITETAPKAN DI BAWAH SEKSYEN 152, AKTA CUKAI PENDAPATAN 1967
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="width100">
                    <tr>
                        <td class='section_header' colspan="4">BAHAGIAN A : MAKLUMAT MAJIKAN </td>
                    </tr>
                    <tr>
                        <td>A1</td>
                        <td>Nama Majikan Terdahulu 1</td>
                        <td>:</td>
                        <td><input class='text_width'></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input class='text_width'></td>
                    </tr>
                    <tr>
                        <td>A2</td>
                        <td>No Rujukan Majikan</td>
                        <td>:</td>
                        <td><input class='text_width'></td>
                    </tr>
                    <tr>
                        <td>A3</td>
                        <td>Nama Majikan Terdahulu 2</td>
                        <td>:</td>
                        <td><input class='text_width'></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input class='text_width'></td>
                    </tr>
                    <tr>
                        <td>A4</td>
                        <td>No Rujukan Majikan</td>
                        <td>:</td>
                        <td><input class='text_width'></td>
                    </tr>
                    <tr>
                        <td colspan="4" class='font_size10px'>*(Sila gunakan lampiran tambahan bagi majikan ketiga dan seterusnya)</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="width100">
                    <tr>
                        <td class='section_header' colspan="4">BAHAGIAN B : MAKLUMAT INDIVIDU</td>
                    </tr>
                    <tr>
                        <td>B1</td>
                        <td>Nama</td>
                        <td>:</td>
                        <td><input class='text_width' value="<?php echo $row["full_name"] ?>" ></td>
                    </tr>
                    <tr>
                        <td>B2</td>
                        <td>No KP Baru</td>
                        <td>:</td>
                        <td><input class='text_width' value="<?php echo $row["ic"] ?>" ></td>
                    </tr>
                    <tr>
                        <td>B3</td>
                        <td>No KP Lama</td>
                        <td>:</td>
                        <td><input class='text_width'></td>
                    </tr>

                    <tr>
                        <td>B4</td>
                        <td>No Tentera/Polis</td>
                        <td>:</td>
                        <td><input class='text_width'></td>
                    </tr>
                    <tr>
                        <td>B5</td>
                        <td>No Pasport</td>
                        <td>:</td>
                        <td><input class='text_width'></td>
                    </tr>
                    <tr>
                        <td>B6</td>
                        <td>No Rujukan Cukai SG/OG</td>
                        <td>:</td>
                        <td><input class='text_width' value="<?php echo $row['income_tax_num']; ?>"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="width100">
                    <tr>
                        <td class='section_header' colspan="4">BAHAGIAN C : MAKLUMAT SARAAN, KWSP, FI/ZAKAT DAN PCB (sila nyatakan jumlah keseluruhan daripada majikan-majikan terdahulu)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span class="boldit">AMAUN TERKUMPUL</span></td>
                    </tr>
                    <tr>
                        <td>C1</td>
                        <td>Jumlah saraan kasar bulanan dan saraan tambahan termasuk elaun/perkuisit/pemberian/manfaat yang dikenakan cukai</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>C2</td>
                        <td>Jumlah elaun/perkuisit/pemberian/manfaat yang dikecualikan cukai</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>i. Elaun perjalanan, kad petrol atau elaun petrol antara rumah ke pejabat (sehingga tahun taksiran 2010 sahaja)</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>ii. Elaun perjalanan, kad petrol atau elaun petrol dan fi tol atas urusan rasmi</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>iii. Elaun penjagaan anak</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>iv. Produk yang dikeluarkan oleh perniagaan majikan yang diberi secara percuma 
                            atau diberi pada harga diskaun</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>v. Perkuisit dalam bentuk tunai/barangan berkaitan dengan pencapaian
                            perkhidmatan lalu, anugerah khidmat cemerlang, anugerah inovasi atau anugerah produktiviti atau perkhidmatan lama dengan syarat pekerja tersebut 
                            telah berkhidmat lebih daripada 10 tahun</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>vi. Lain - lain elaun/perkuisit/pemberian/manfaat yang dikecualikan cukai. Sila 
                            rujuk nota penerangan Borang BE untuk keterangan lanjut</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="width100">
                    <tr>
                        <td class='section_header' colspan="5">BAHAGIAN D : MAKLUMAT POTONGAN  (sila nyatakan jumlah keseluruhan daripada majikan-majikan terdahulu) </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span class='boldit'>HAD TAHUNAN</span></td>
                        <td><span class='boldit'>POTONGAN TERKUMPUL</span></td>
                    </tr>
                    <tr>
                        <td>D1</td>
                        <td style="width: 500px;">Perbelanjaan perubatan ibu bapa sendiri ke atas penyakit yang disahkan oleh pengamal 
                            perubatan</td>
                        <td class='boldit'>TERHAD RM5,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D2</td>
                        <td>Peralatan sokongan asas untuk kegunaan sendiri, suami/isteri, anak atau ibu bapa yang 
                            kurang upaya</td>
                        <td class='boldit'>TERHAD RM5,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D3</td>
                        <td>Individu yang kurang upaya</td>
                        <td class='boldit'>RM6,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D4</td>
                        <td>Yuran pendidikan (sendiri):
                            (i) peringkat selain Sarjana dan Doktor Falsafah - bidang undang-undang, 
                            perakaunan, kewangan Islam, teknikal, vokasional, industri, saintifik atau teknologi 
                            maklumat; atau
                            (ii) peringkat Sarjana dan Doktor Falsafah - sebarang bidang atau kursus pengajian</td>
                        <td class='boldit'>TERHAD RM5,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D5</td>
                        <td>
                            <table>
                                <tr>
                                    <td>Perbelanjaan perubatan bagi penyakit yang sukar 
                                        diubati atas diri sendiri, suami/isteri atau anak</td>
                                    <td>RM</td>
                                    <td><input></td>
                                </tr>
                            </table>
                        </td>
                        <td class='boldit'>TERHAD RM5,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D6</td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        Pemeriksaan perubatan penuh atas diri sendiri, suami/isteri atau anak
                                    </td>
                                    <td class='boldit'>TERHAD RM500</td>
                                    <td><input></td>
                                </tr>
                            </table>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>D7</td>
                        <td>Pembelian buku/majalah/jurnal/penerbitan ilmiah (selain suratkhabar atau bahan 
                            bacaan terlarang) untuk diri sendiri, suami/isteri atau anak</td>
                        <td class='boldit'>TERHAD RM1,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D8</td>
                        <td>Pembelian komputer peribadi untuk individu (potongan dibenarkan sekali dalam setiap 
                            tiga tahun) </td>
                        <td class='boldit'>TERHAD RM3,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D9</td>
                        <td>Tabungan bersih dalam Skim Simpanan Pendidikan Nasional (jumlah simpanan dalam 
                            tahun semasa tolak jumlah pengeluaran dalam tahun semasa)</td>
                        <td class='boldit'>TERHAD RM3,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D10</td>
                        <td>Pembelian peralatan sukan untuk aktiviti sukan mengikut Akta Pembangunan Sukan 
                            1997</td>
                        <td class='boldit'>TERHAD RM300</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D11</td>
                        <td style="width: 500px;">Bayaran alimoni kepada bekas isteri (jumlah potongan untuk isteri dan bayaran alimoni 
                            kepada bekas isteri)</td>
                        <td class='boldit'>TERHAD RM3,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D12</td>
                        <td>Suami atau isteri yang kurang upaya</td>
                        <td class='boldit'>RM3,500</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D13</td>
                        <td>(i) Premium insurans nyawa; dan<br />
                            (ii) Apa-apa lebihan daripada premium anuiti tertangguh yang melebihi RM1,000</td>
                        <td class='boldit'>TERHAD RM6,000 
                            (termasuk KWSP)</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D14</td>
                        <td>Premium insurans pendidikan dan perubatan </td>
                        <td class='boldit'>TERHAD RM3,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D15</td>
                        <td>Premium anuiti tertangguh (apa-apa lebihan daripada premium anuiti tertangguh yang 
                            melebihi RM1,000 boleh dituntut dan diambil kira bersama-sama jumlah<br />premium insurans nyawa (C13))</td>
                        <td class='boldit'>TERHAD RM1,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D16</td>
                        <td>Yuran langganan perkhidmatan internet jalur lebar</td>
                        <td class='boldit'>TERHAD RM500</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                    <tr>
                        <td>D17</td>
                        <td>Faedah pinjaman perumahan (mesti memenuhi syarat-syarat kelayakan)</td>
                        <td class='boldit'>TERHAD RM10,000</td>
                        <td>RM</td>
                        <td><input></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="width100">
                    <tr>
                        <td class='section_header' colspan="3">BAHAGIAN E : AKUAN PEKERJA</td>
                    </tr>
                    <tr>
                        <td colspan="3">Saya mengakui bahawa semua maklumat yang dinyatakan dalam borang ini adalah benar, betul dan lengkap. Sekiranya maklumat yang diberikan
                            tidak benar, tindakan mahkamah boleh diambil ke atas saya di bawah perenggan 113(1)(b ) Akta Cukai Pendapatan 1967.</td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr style='vertical-align:top'>
                                    <td><div style='margin-top:7px;'>Tarikh</div></td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td> <input style='width:40px'></td>
                                                <td>-</td>
                                                <td><input style='width:40px'></td>
                                                <td>-</td>
                                                <td><input style='width:40px'></td>
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
                                </tr>
                            </table>
                        </td>
                        <td></td>
                        <td style="width:300px">
                            ------------------------------------------------<br />Tandatangan	
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="width100">
                    <tr>
                        <td class='section_header' colspan="3">NOTA</td>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td></td>
                        <td>Borang ini hendaklah diisi oleh pekerja dan satu salinan diserahkan kepada majikan tanpa resit atau dokumen
                            sokongan untuk tujuan pelarasan pengiraan PCB.</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td></td>
                        <td>Majikan hendaklah meminta pekerja mengemukakan borang ini sekiranya pekerja pernah bekerja dengan majikanmajikan lain dalam tahun semasa.</td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td></td>
                        <td>Majikan hanya perlu menyimpan borang ini untuk tempoh 7 tahun. Borang ini perlu dikemukakan sekiranya diminta
                            oleh LHDNM.</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="divBreak"><table></table></div>
    <?php
}
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>