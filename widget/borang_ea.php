<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
include_once 'widget/report_css.php';
$emp_id = isset($_GET["emp_id"]) ? $_GET["emp_id"] : '';
$sql = "select *,e.id as eid from employee e left join `position` p on e.position_id=p.id where e.id in (" . $emp_id . ")";
$rs = mysql_query($sql);
while ($row = mysql_fetch_array($rs)) {
    ?>
    <table class='width800px main_content'>
        <tr>
            <td>
                <table class='width100'>
                    <tr>
                        <td>
                            <table class='width100'>
                                <tr>
                                    <td colspan='3'>(C.P. 8A - Pin. 2010)</td>
                                </tr>
                                <tr>
                                    <td>No. Siri</td>
                                    <td></td>
                                    <td><input class='text_width50px'></td>
                                </tr>
                                <tr>
                                    <td>No. Majikan</td>
                                    <td></td>
                                    <?php
                                    $rs1 = mysql_fetch_array(mysql_query("select * from company where id=" . $row['eid']));
                                    ?>
                                    <td><input class='text_width50px'  value="<?php echo $rs1['income_tax_no']; ?>"></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class='width100'>
                                <tr>
                                    <td style='text-align:center'>MALAYSIA</td>
                                </tr>
                                <tr>
                                    <td style='text-align:center' class='boldit2'>CUKAI PENDAPATAN </td>
                                </tr>
                                <tr>
                                    <td>PENYATA SARAAN DARIPADA PENGGAJIAN</td>
                                </tr>
                                <tr>
                                    <td>BAGI TAHUN BERAKHIR 31 DISEMBER <input class='text_width60px'></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class='width100'>
                                <tr>
                                    <td class='section_header'>Penyata Gaji Pekerja SWASTA</td>
                                    <td rowspan='2'><h1>EA</h1></td>
                                </tr>
                                <tr>
                                    <td colspan='2'>No. Cukai Pendapatan Pekerja</td>
                                </tr>
                                <tr>
                                    <td colspan='2'><input class='width100'></td>
                                </tr>
                                <tr>
                                    <td>Cawangan LHDNM</td>
                                    <td><input class='text_width60px'></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class='section_header center'>
                BORANG EA INI PERLU DISEDIAKAN UNTUK DISERAHKAN KEPADA PEKERJA <br />
                BAGI TUJUAN CUKAI PENDAPATANNYA 
            </td>
        </tr>
        <tr>
            <td>
                <table class='width100'>
                    <tr>
                        <td class='section_header widthq100px'>A</td>
                        <td class='boldit' colspan='6'>BUTIRAN PEKERJA</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1. </td>
                        <td colspan='5'>Nama Penuh Pekerja/Pesara (En./Cik/Puan)<input type='text' class='width100' value=" <?php echo $row["full_name"] ;?>" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2. </td>
                        <td>Jawatan</td>
                        <td><input type='text'  value=" <?php  echo  $row["position_name"] ;?>"></td>
                        <td>3.</td>
                        <td>No. Kakitangan/No. Gaji</td>
                        <td><input type="text" value=" EMP<?php echo str_pad($row['eid'], 6, "0", STR_PAD_LEFT) ?>" ></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>4.  </td>
                        <td>No. K.P. Baru</td>
                        <td><input type='text'  value=" <?php   echo  $row["ic"] ?>"></td>					
                        <td>5.</td>
                        <td>No. Pasport</td>
                        <td><input type='text'  value=" <?php   echo  $row["passport"] ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>6.</td>
                        <td>No. KWSP</td>
                        <td><input type="text" value=" <?php   echo  $row["epf_num"] ?>"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>7.</td>
                        <td colspan='2'>Jika bekerja tidak genap setahun, nyatakan:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>(a)  Tarikh mula bekerja </td>
                        <td><input type='text'  value=" <?php   echo  $row["join_date"] ?>"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>(b)  Tarikh berhenti kerja</td>
                        <td><input></td>	
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 100%;">
                    <tr>
                        <td class='section_header width30px'>B</td>
                        <td class='boldit' colspan='6'>PENDAPATAN PENGGAJIAN, MANFAAT DAN TEMPAT KEDIAMAN (Tidak Termasuk Elaun/Perkuisit/ 
                            Pemberian/Manfaat Yang Dikecualikan Cukai)</td>
                    </tr>
                    <tr>
                        <td colspan='6'></td>
                        <td style='width:100px'>RM</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan='6'>						
                            <table class='width100'>
                                <tr>
                                    <td>1.</td>
                                    <td colspan='3'>
                                        <table class='width100'>
                                            <tr>
                                                <?php
                                                $result1 = mysql_query("SELECT * FROM `payroll_report` a left join payroll_finalised b on a.payroll_finalised_id=b.id where b.finalise_year=Year(Now()) and a.emp_id=" . $row['eid']);
                                                $total_pay_in_Year = 0;
												$total_pay_in_epf = 0;
												$total_pay_in_tax = 0;
                                                while ($rs1 = mysql_fetch_array($result1)) {
                                                    $total_pay_in_Year += $rs1['netpaid'];
													$total_pay_in_epf +=$rs1['epf'];
													$total_pay_in_tax += $rs1['pcb'];
                                                    print $total_pay_in_Year . "@";
                                                }
                                                ?>
                                                <td>Gaji kasar, upah atau gaji cuti (termasuk gaji lebih masa)<br /></td>
                                                <td style='width:160px'><input type="text" value="<?php echo number_format($total_pay_in_Year, 2); ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>Fi (termasuk fi pengarah), komisen atau bonus<br /></td>
                                                <td style='width:160px'><input></td>
                                            </tr>
                                            <tr>
                                                <td>Tip kasar, perkuisit, penerimaan sagu hati atau elaun-elaun lain (Perihal pembayaran <input class='text_width60px'>)</td>
                                                <td style='width:160px'><input></td>
                                            </tr>
                                            <tr>
                                                <td>Cukai Pendapatan yang dibayar oleh Majikan bagi pihak Pekerja </td>
                                                <td style='width:160px'><input></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td colspan='3'>Nilai Manfaat atau kemudahan berupa barangan:</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>(a)</td>
                                    <td colspan='2'>
                                        <table class='width100'>
                                            <tr>
                                                <td>Kereta (Tarikh sebenar diperuntukkan <input class='text_width60px'>)</td>
                                                <td>(i)</td>
                                                <td>Nilai kereta dan petrol </td>
                                                <td style='width:160px'><input></td>
                                            </tr>
                                            <tr>
                                                <td>(Jenis <input class='text_width60px'> Tahun <input class='text_width60px'> Model <input class='text_width60px'>)</td>
                                                <td>(ii)</td>
                                                <td>Nilai pemandu </td>
                                                <td style='width:160px'><input></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>(b)</td>
                                    <td>Elektrik, air, telefon dan kemudahan lain </td>
                                    <td style='width:160px'><input></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>(c)</td>
                                    <td colspan='2'> Nilai manfaat rumah tangga:    <span class='font-style:italic'>( *Potong yang tidak berkenaan )</span>
                                        <table class='width100'>
                                            <tr>
                                                <td>(i)</td>
                                                <td>Separuh lengkap dengan perabot*/penyaman udara*/langsir*/permaidani*, atau</td>
                                                <td style='width:160px'><input></td>
                                            </tr>
                                            <tr>
                                                <td>(ii)</td>
                                                <td>Lengkap dengan perkakas dapur, pinggan mangkuk, peralatan atau perkakas, atau</td>
                                                <td style='width:160px'><input></td>
                                            </tr>
                                            <tr>
                                                <td>(iii)</td>
                                                <td colspan='2'>
                                                    <table class='width100'>
                                                        <tr>
                                                            <td>Butiran berasingan:</td>
                                                            <td>Perabot dan kelengkapan</td>
                                                            <td style='width:160px'><input></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>Perkakas dapur</td>
                                                            <td style='width:160px'><input></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>Hiburan dan rekreasi</td>
                                                            <td style='width:160px'><input></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>(d)</td>
                                    <td>Pembantu rumah dan tukang kebun</td>
                                    <td><input></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>(e)</td>
                                    <td>Manfaat tambang percutian</td>
                                    <td><input></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>(f)</td>
                                    <td>Lain-lain (misalnya makanan dan pakaian)</td>
                                    <td><input></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td colspan='2'>Nilai tempat kediaman (Alamat <input />)</td>
                                    <td><input></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td colspan='2'>Bayaran balik daripada Kumpulan Wang Simpanan/Pencen yang tidak diluluskan</td>
                                    <td><input></td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td colspan='2'>Pampasan kerana kehilangan pekerjaan</td>
                                    <td><input></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class='width100'>
                    <tr>
                        <td class='section_header width30px'>C</td>
                        <td class='boldit' colspan='3'>PENCEN DAN LAIN-LAIN </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan='2' style='width:20px'>1. Pencen</td>
                        <td style='width:160px'><input type="text" value="<?php echo number_format($total_pay_in_epf, 2); ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan='2' style='width:20px'>2. Anuiti atau Bayaran Berkala yang lain</td>
                        <td style='width:160px'><input></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class='boldit'>JUMLAH</td>
                        <td></td>
                        <td style='border-top:1px solid #000000;border-bottom:1px solid #000000;width:160px'><input type="text" value="<?php echo number_format($total_pay_in_epf, 2);  ?>"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class='width100'>
                    <tr>
                        <td class='section_header width30px'>D</td>
                        <td class='boldit' colspan='3'>JUMLAH POTONGAN </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1.</td>
                        <td>Potongan Cukai Bulanan (PCB) Tahun Semasa yang dibayar kepada LHDNM</td>
                        <td style='width:160px'><input type="text" value="<?php echo number_format($total_pay_in_tax, 2); ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2.</td>
                        <td>Arahan Potongan CP 38</td>
                        <td style='width:160px'><input></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3.</td>
                        <td>Potongan zakat yang dibayar kepada pihak berkuasa pemungut zakat</td>
                        <td style='width:160px'><input></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class='width100'>
                    <tr>
                        <td class='section_header width30px'>E</td>
                        <td colspan='4' class='boldit'>CARUMAN YANG WAJIB DIBAYAR OLEH PEKERJA KEPADA KUMPULAN WANG PENCEN ATAU SIMPANAN YANG DILULUSKAN</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nama Kumpulan Wang</td>
                        <td colspan='3'><input class='text_width'></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan='2'>Amaun caruman yang wajib dibayar (nyatakan bahagian pekerja sahaja)</td>
                        <td style='width:20px'>RM</td>
                        <td style='width:160px'><input></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class='width100'>
                    <tr>
                        <td class='section_header width30px'>F</td>
                        <td class='boldit' colspan='5'>BUTIRAN PEMBAYARAN TUNGGAKAN DAN LAIN-LAIN BAGI TAHUN-TAHUN TERDAHULU (SEBELUM TAHUN SEMASA)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class='underline'>Bayaran Bagi Tahun</td>
                        <td class='underline'>Jenis Pendapatan</td>
                        <td class='underline'>Jumlah Bayaran (RM) </td>
                        <td class='underline'>Caruman KWSP (RM)</td>
                        <td class='underline'>Potongan Cukai Bulanan (PCB) (RM)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input class='text_width50px'></td>
                        <td><input class='text_width50px'></td>
                        <td><input class='text_width50px'></td>
                        <td><input class='text_width50px'></td>
                        <td><input class='text_width50px'></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input class='text_width50px'></td>
                        <td><input class='text_width50px'></td>
                        <td><input class='text_width50px'></td>
                        <td><input class='text_width50px'></td>
                        <td><input class='text_width50px'></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class='width100'>
                    <tr>
                        <td class='section_header width30px'>G</td>
                        <td class='boldit'>JUMLAH ELAUN / PERKUISIT / PEMBERIAN / MANFAAT YANG DIKECUALIKAN CUKAI</td>
                        <td>RM <input></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class='width100'>
                    <tr>
                        <td>
                            <table class='width100'>
                                <tr>
                                    <td>Tarikh</td>
                                    <td><input></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style='border:1px solid #000000;' class='width100'>
                                <tr>
                                    <td>Nama Pegawai</td>
                                    <td><input class='width100'></td>
                                </tr>
                                <tr>
                                    <td>Jawatan</td>
                                    <td><input class='width100'></td>
                                </tr>
                                <tr>
                                    <td>Nama dan Alamat Majikan</td>
                                    <td><input class='width100'></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input class='width100'></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="divBreak"><table></table></div>
    <?php
}
?>
<style type="text/css">
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