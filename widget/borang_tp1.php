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
        <div style="text-align:right" class='font_size10px'>BORANG PCB/TP1 (1/2011)</div>
        <div style="text-align:center;font-weight:bold">LEMBAGA HASIL DALAM NEGERI MALAYSIA<br/>
            BORANG TUNTUTAN POTONGAN DAN REBAT INDIVIDU<br/>
            BAGI TUJUAN POTONGAN CUKAI BULANAN (PCB)</div>

        <div style="text-align:center;">(KAEDAH-KAEDAH CUKAI PENDAPATAN (POTONGAN DARIPADA SARAAN) 1994)<br/>
            BORANG DITETAPKAN DI BAWAH SEKSYEN 152, AKTA CUKAI PENDAPATAN 1967<br/>
            Bulan Potongan :<input type="text" />
            Tahun Potongan : <input type="text" />
        </div>

        <?php
        $rs1 = mysql_fetch_array(mysql_query("select * from company where id=" . $row['company_id']));
        ?>
        <table border="0" width="100%">
            <tr><td colspan="3" class="header">BAHAGIAN A : MAKLUMAT MAJIKAN</td></tr>
            <tr><td>A1 Nama Majikan</td><td>:</td><td><input type="text" style='width:100%' value="<?php echo $rs1['name']; ?>"/></td></tr>
            <tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="text" style='width:100%' /></td></tr>
            <tr><td>A2 No Rujukan Majikan</td><td>:</td><td><input type="text" style='width:95%' value="<?php echo $rs1['income_tax_no']; ?>"/></td></tr>
            <tr><td colspan="3" class="header">BAHAGIAN B : MAKLUMAT INDIVIDU</td></tr>
            <tr><td>B1 Nama</td><td>:</td><td><input type="text" value="<?php echo $row["full_name"] ?>" style='width:100%' /></td></tr>
            <tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="text" value="" style='width:100%' /></td></tr>
            <tr><td>B2 No KP Baru</td><td>:</td><td><input type="text" value="<?php echo $row["ic"] ?>"  /></td></tr>
            <tr><td>B3 No KP Lama</td><td>:</td><td><input type="text" /></td></tr>
            <tr><td>B4 No Tentera/Polis</td><td>:</td><td><input type="text" /></td></tr>
            <tr><td>B5 No Pasport</td><td>:</td><td><input type="text" /></td></tr>
            <tr><td>B6 No Rujukan Cukai SG/OG</td><td>:</td><td><input type="text" value="<?php echo $row['income_tax_num']; ?>"/></td></tr>
            <tr><td>B7 No Pekerja/No Gaji</td><td>:</td><td><input type="text" /></td></tr>
        </table>

        <table border="0" width="100%" style='border-collapse:collapse;'>
            <tr><td colspan="5" class="header">BAHAGIAN C : MAKLUMAT POTONGAN</td></tr>
            <tr><td colspan="5" class="">&nbsp;</td></tr>
            <tr>
                <td width="10%"></td>
                <td width="60%">&nbsp;</td>
                <td width="10%"><b>HAD</b></td>
                <td colspan='2' align='center' style='border:1px solid black;'>POTONGAN</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>TAHUNAN</b></td>
                <td style='border-left:1px solid black;border-bottom:1px solid black;'>BULAN SEMASA</td>
                <td style='border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;'>TERKUMPUL</td>
            </tr>
            <tr>
                <td>C1</td>
                <td>Perbelanjaan perubatan ibu bapa sendiri ke atas penyakit yang disahkan oleh pengamal perubatan, keperluan khas dan penjaga ibu bapa</td>
                <td><b>TERHAD RM5,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C2</td>
                <td>
                    Peralatan sokongan asas untuk kegunaan sendiri,
                    suami/isteri, anak atau ibu bapa yang kurang upaya
                </td>
                <td><b>TERHAD RM5,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C3</td>
                <td>
                    Yuran pendidikan (sendiri):<br />
                    (i) peringkat selain Sarjana dan Doktor Falsafah – bidang 
                    undang-undang, perakaunan, kewangan Islam, teknikal, 
                    vokasional, industri, saintifik atau teknologi maklumat; 
                    atau<br />
                    (ii) peringkat Sarjana dan Doktor Falsafah – sebarang 
                    bidang atau kursus pengajian
                </td>
                <td><b>TERHAD RM5,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C4</td>
                <td>
                    <div style='width:300px;float:left;min-height:20px;'>
                        Perbelanjaan perubatan bagi penyakit
                        yang sukar diubati atas diri sendiri,suami /isteri atau anak 	
                    </div>
                    RM <input type='text' />
                </td>
                <td rowspan='2'><b>TERHAD<br />RM5000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C5</td>
                <td>
                    <div style='width:300px;float:left;min-height:20px;'>
                        Pemeriksaan perubatan penuh atas
                        diri sendiri, suami/isteri atau anak
                    </div>
                    RM <input type='text' />
                </td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C6</td>
                <td>
                    Pembelian buku/majalah/jurnal/penerbitan ilmiah (selain 
                    suratkhabar atau bahan bacaan terlarang) untuk diri sendiri, suami/isteri atau anak 
                </td>
                <td><b>TERHAD RM1,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C7</td>
                <td>
                    Pembelian komputer peribadi untuk individu (potongan
                    dibenarkan sekali dalam setiap tiga tahun) 
                </td>
                <td><b>TERHAD RM3,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C8</td>
                <td>
                    Tabungan bersih dalam Skim Simpanan Pendidikan 
                    Nasional (jumlah simpanan dalam tahun semasa tolak 
                </td>
                <td><b>TERHAD RM3,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C9</td>
                <td>
                    Pembelian peralatan sukan untuk aktiviti sukan mengikut
                    Akta Pembangunan Sukan 1997
                </td>
                <td><b>TERHAD RM3,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C10</td>
                <td>
                    Bayaran alimoni kepada bekas isteri (jumlah potongan
                    untuk isteri dan bayaran alimoni kepada bekas isteri)
                </td>
                <td><b>TERHAD RM3,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C11</td>
                <td>
                    Premium insurans nyawa
                </td>
                <td><b>TERHAD<br />RM6,000<br />(termasuk KWSP)</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C12</td>
                <td>
                    Premium insurans pendidikan dan perubatan
                </td>
                <td><b>TERHAD RM3,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C13</td>
                <td>
                    Caruman kepada Skim Persaraan Swasta dan bayaran
                    anuiti tertangguh
                </td>
                <td><b>TERHAD RM3,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C14</td>
                <td>
                    Yuran langganan perkhidmatan internet jalur lebar
                </td>
                <td>T<b>ERHAD RM500</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
            <tr>
                <td>C15</td>
                <td>
                    Faedah pinjaman perumahan (mesti memenuhi syaratsyarat kelayakan)  
                </td>
                <td><b>TERHAD RM10,000</b></td>
                <td>RM <input type='text' /></td>
                <td>RM <input type='text' /></td>
            </tr>
        </table>
        <div class="divBreak"><table></table></div>
        <table border="0">
            <tr><td colspan="3" class="header">BAHAGIAN D : REBAT</td></tr>
            <tr><td>D1 Zakat selain yang dibayar melalui potongan daripada gaji bulanan</td><td>:</td><td>RM<input type="text" /></td></tr>
            <tr><td>D2 Fi / Levi yang dibayar oleh pemegang pas penggajian, pas lawatan (kerja sementara) atau pas kerja di bawah seksyen 3, Akta Fi 1951</td><td>:</td><td>RM<input type="text" /></td></tr>
            <tr><td colspan="3" class="header">BAHAGIAN E : AKUAN PEKERJA</td></tr>
            <tr><td colspan="3">Saya mengakui bahawa semua maklumat yang dinyatakan dalam borang ini adalah benar, betul dan lengkap. Sekiranya maklumat yang diberikan tidak benar, tindakan mahkamah boleh diambil ke atas saya di bawah perenggan 113(1)(b)Akta Cukai Pendapatan 1967</td></tr>
            <tr><td>Tarikh: <table>
                        <tr>
                            <td><input type="text" style='width:50px' /></td>
                            <td>-</td>
                            <td><input type="text" style='width:50px' /></td>
                            <td>-</td>
                            <td><input type="text" style='width:50px' /></td>
                        </tr>
                        <tr>
                            <td>Hari</td>
                            <td></td>
                            <td>Bulan</td>
                            <td></td>
                            <td>Tahun</td>
                        </tr>
                    </table></td></td>
                <td><br/><br/><br/>
                    ---------------------------------------------------------<br/>
                    Tandatangan</td></tr>
            <tr><td colspan="3" class="header">BAHAGIAN F : PERSETUJUAN MAJIKAN</td></tr>
            <tr><td>Permohonan tuntutan pekerja di atas adalah dipersetujui bagi bulan potongan<input type="text"/><td>Tahun potongan<input type="text"/></td></tr>
            <tr>
                <td>Tarikh: 
                    <table>
                        <tr>
                            <td><input type="text" style='width:50px' /></td>
                            <td>-</td>
                            <td><input type="text" style='width:50px' /></td>
                            <td>-</td>
                            <td><input type="text" style='width:50px' /></td>
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
                <td><br/><br/><br/>
                    Nama:<br/>
                    Jawatan:
                    <div style="border:1px solid white;width:300px;height:80px">
                        Alamat majikan :
                    </div>
                </td>
            </tr>
            <tr><td></td><td></td></tr>
        </table>
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