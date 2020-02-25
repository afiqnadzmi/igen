<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$number_of_ppl = 1;
$month = $_GET['month'];
$year = $_GET['year'];
$chk_sql = 'SELECT id FROM payroll_finalised WHERE finalise_month=' . $month . ' AND finalise_year=' . $year;
$chk_sql_result = mysql_query($chk_sql);
$chk_row = mysql_fetch_array($chk_sql_result);
$fid_result = $chk_row["id"];

if (!empty($_GET["emp_id"])) {
    if ($_GET['status'] == "Active") {
        $result = mysql_query("select * from employee where id in (" . $_GET['emp_id'] . ") and emp_status='Active' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . ")");
        $result_epf = mysql_query("select sum(epf + employer_epf)as sum_epf from payroll_report where emp_id in(" . $_GET['emp_id'] . ") and payroll_finalised_id=" . $fid_result);
    } else if ($_GET['status'] == "Inactive") {
        $result = mysql_query("select * from employee where id in (" . $_GET['emp_id'] . ") and emp_status='Inactive' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . ")");
        $result_epf = mysql_query("select sum(epf + employer_epf)as sum_epf from payroll_report where emp_id in(" . $_GET['emp_id'] . ") and payroll_finalised_id=" . $fid_result);
    } else {
        $result = mysql_query("select * from employee where id in (" . $_GET['emp_id'] . ") and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . ")");
        $result_epf = mysql_query("select sum(epf + employer_epf)as sum_epf from payroll_report where emp_id in(" . $_GET['emp_id'] . ") and payroll_finalised_id=" . $fid_result);
    }
} else {
    if ($_GET["dep_id"] == "0") {
        if ($_GET['status'] == "Active") {
            $result = mysql_query("select * from employee where branch_id= (" . $_GET['branch_id'] . ") and emp_status='Active' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . ")");
            $result_epf = mysql_query("select sum(epf + employer_epf)as sum_epf from payroll_report where payroll_finalised_id=" . $fid_result . " and dep_id in (select id from department where branch_id =" . $_GET['branch_id'] . ") and emp_id in(select id from employee where emp_status='Active')");
        } else if ($_GET['status'] == "Inactive") {
            $result = mysql_query("select * from employee where branch_id= (" . $_GET['branch_id'] . ") and emp_status='Inactive' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . ")");
            $result_epf = mysql_query("select sum(epf + employer_epf)as sum_epf from payroll_report where payroll_finalised_id=" . $fid_result . " and dep_id in (select id from department where branch_id =" . $_GET['branch_id'] . ") and emp_id in(select id from employee where emp_status='Inactive')");
        } else {
            $result = mysql_query("select * from employee where branch_id= (" . $_GET['branch_id'] . ") and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . ")");
            $result_epf = mysql_query("select sum(epf + employer_epf)as sum_epf from payroll_report where payroll_finalised_id=" . $fid_result . " and dep_id in (select id from department where branch_id =" . $_GET['branch_id'] . ")");
        }
    } else {
        if ($_GET['status'] == "Active") {
            $result = mysql_query("select * from employee where dep_id= (" . $_GET['dep_id'] . ") and emp_status='Active' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . ")");
            $result_epf = mysql_query("select sum(epf + employer_epf)as sum_epf from payroll_report where dep_id= (" . $_GET['dep_id'] . ")and payroll_finalised_id=" . $fid_result . " and emp_id in(select id from employee where emp_status='Active')");
        } else if ($_GET['status'] == "Inactive") {
            $result = mysql_query("select * from employee where dep_id= (" . $_GET['dep_id'] . ") and emp_status='Inactive' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . ")");
            $result_epf = mysql_query("select sum(epf + employer_epf)as sum_epf from payroll_report where dep_id= (" . $_GET['dep_id'] . ")and payroll_finalised_id=" . $fid_result . " and emp_id in(select id from employee where emp_status='Inactive')");
        } else {
            $result = mysql_query("select * from employee where dep_id= (" . $_GET['dep_id'] . ") and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . ")");
            $result_epf = mysql_query("select sum(epf + employer_epf)as sum_epf from payroll_report where dep_id= (" . $_GET['dep_id'] . ")and payroll_finalised_id=" . $fid_result);
        }
    }
}
$row_epf = mysql_fetch_array($result_epf);

/* $result = mysql_query("select * from employee where id in (" . $_GET['emp_id'] . ") and id in (select emp_id from payroll_report where payroll_finalised_id=" . $_GET['fid'] . ")"); */
$rs1 = mysql_fetch_array(mysql_query("select * from branch where id in (select branch_id from employee where branch_id in (" . $_GET['branch_id'] . "))"));
$no = mysql_num_rows($result);
$page = $no / 12;
if ($no % 12)
    $page++;
for ($j = 1; $j <= $page; $j++) {
    ?>
    <table style="width:500px">
        <tr>
            <td width="150px" rowspan="2" valign="top" align="right"><img src="images/KWS.png" style="width:100;height:100px">
                <?php
                for ($i = 0; $i < 14; $i++) {
                    print "<br/>";
                }
                ?>Nama Majikan:<br />Alamat:
            </td>
            <td width="300px"><h1><br/>KUMPULAN WANG SIMPANAN PEKERJA</h1>
                PERATURAN-PERATURAN DAN KEADAH-KEADAH KWSP 1991 KAEDAH 11(1)</td>
            <td valign="top" width="200px"><b>KWSP 6</b></td>
        </tr>
        <tr>
            <td>
                <table border="1" cellspacing="0" width="800px">
                    <tr><th>No Rujukan Majikan</th><th>Bulan <br />Caruman</th><th>Amaun Caruman<br />(RM)</th><th>No Rujukan<br />Borang A</th></tr>
                    <tr height="30"><td style="height:30px"><input type="text"/></td><td><input type="text" value="<?php echo $month . '-' . $year ?>"/></td><td><input type="text" value="<?php echo number_format($row_epf['sum_epf'], 2); ?>"/></td><td><input type="text" style="width:80px"/></td></tr>
                    <tr><td colspan="4">
                            Jumlah caruman untuk bulan di atas hendaklah dibayar kepada KWSP/Agen Kutipan<br />KWSP sebelum/pada 15hb setiap bulan<br />
                            <table cellspacing="0">
                                <tr>
                                    <td width="150px"><div style="width:20px;height:20px;border:1px solid black"></div></td><td>Wang Tunai</td>
                                    <td width="600px" ><div style="width:20px;height:20px;border:1px solid black;float:left"></div></td><td>
                                        Cek/Kiriman Wang/Wang Pos /<br/>Draf Bank*No/EFT/TT.:<input type="text"value=""/></td>
                                </tr></table>
                        </td></tr>
                    <tr height="200px" border="1" rules="rows"><td style="border-right:0" colspan="2" align="left" valign="top">
                            <input type="text" value="<?php echo $rs1['branch_name']; ?>"/><br />
                            <textarea><?php echo $rs1['address1'] . $rs1['address2'] ." ". $rs1['postal_code']; ?></textarea>
                        </td><td colspan="2" valign="top" style="border-left:0" align="right">
                            Tarikh DiCetak :<input type="text" class="date" value="<?php echo date("j- n- Y"); ?>"/><br />
                            Bil Pekerja :<input type="text" value="<?php echo $no; ?>"/>
                        </td></tr>
                </table></td>

            <td>    <h1>Borang <br /><br />A</h1>
                <p>Mukasurat:</p>
                <div style="border-radius:35px;width:70px;height:70px;border:1px solid black"></div>
                <p> Cop Agen Kutipan</p>
            </td>
        </tr>
    </table>




    <!--style="border:1px solid red"-->
    <table border="1" cellspacing="0">
        <tbody>
            <tr style="height:200px">
                <td width="20" height="50">
                    <strong>BIL</strong>
                </td>
                <td width="94" align="center" height="50">
                    <strong>NO AHLI</strong>
                </td>
                <td width="15" height="50" align="center">
                    <strong>N<br/> K</strong>
                </td>
                <td width="100" height="50" align="center">
                    <strong>NO KAD PENGENALAN</strong>
                </td>
                <td width="243" align="center" height="50">

                    <strong>NAMA PEKERJA / AHLI</strong>
                    <br/>
                    (Seperti yang terdapat di dalam Kad Pengenalan)

                </td>
                <td width="87" height="50" align="center">
                    <strong>UPAH (RM)</strong>
                </td>
                <td width="50" height="50" valign="bottom" colspan="2" align="center">

                    <strong>CARUMAN (RM)</strong>
                    <br/><br/>
                                    <!--<table border="1"  cellspacing="0"><tr>
                                            <td width="67">
                                                <strong>MAJIKAN</strong>
                                            </td>
                                            <td width="66" valign="bottom">
                                                <strong>PEKERJA</strong>
                                            </td>
                                        </tr></table>-->
                </td>
            </tr>
            <tr>
                <td width="508" colspan="6" height="20" align="right"><strong>Jumlah yang dibawa dari mukasurat terdahulu (jika ada) </strong></td>
                <td width="71" height="20"> <strong>MAJIKAN</strong></td>
                <td width="68" height="20"> <strong>PEKERJA</strong></td>
            </tr>

            <?php
            $total_epf = 0;
            for ($i = 0; $i < 12; $i++) {
                if ($rs = mysql_fetch_array($result)) {
                    ?>
                    <tr>
                        <td width="20" height="20"><?php echo $number_of_ppl++; ?>
                        </td>
                        <td width="94" height="20"><?php echo $rs['epf_num'];?>
                        </td>
                        <td width="15" height="20"><input type="text" value="" style="width:20px"/>
                        </td>
                        <td width="100" height="20"><?php echo $rs['ic']; ?>
                        </td>
                        <td width="243" height="20"><?php echo $rs['full_name']; ?>
                        </td>
                        <?php
                        ${"rs" . $i} = mysql_fetch_array(mysql_query("select * from payroll_report where payroll_finalised_id=" . $fid_result . " and  emp_id=" . $rs['id']));
//                        $total_epf+=${"rs" . $i}['epf'];
//                        $total_epf+=${"rs" . $i}['employer_epf'];
                        $total_epf+=${"rs" . $i}['employer_epf']+${"rs" . $i}['epf'];
                        ?>
                        <td width="87" height="20"><input type="text" style="width:80px" value="<?php echo ${"rs" . $i}['gross_pay']; ?>"/>
                        </td>
                        <td width="68" height="20"><input type="text" style="width:80px" value="<?php echo ${"rs" . $i}['employer_epf']; ?>"/>
                        </td>
                        <td width="5" height="20"><input type="text" style="width:80px" value="<?php echo ${"rs" . $i}['epf']; ?>"/>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td width="20" height="20">
                        </td>
                        <td width="94" height="20">
                        </td>
                        <td width="15" height="20">
                        </td>
                        <td width="100" height="20">
                        </td>
                        <td width="243" height="20">
                        </td>
                        <td width="87" height="20">
                        </td>
                        <td width="68" height="20">
                        </td>
                        <td width="5" height="20">
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>

            <tr>
                <td width="208" colspan="6" height="20" align="right"><strong>Jumlah yang dibawa ke mukasurat seterusnya (jika ada) </strong></td>
                <td width="71" height="20"></td>
                <td width="68" height="20"></td>
            </tr>
            <tr>
                <td width="208" colspan="7" height="20" align="right">JUMLAH (RM)</td>
                <td width="10" colspan="2" height="20"><input type="text" style="width:80px;" value="<?php echo number_format($total_epf, 2); ?>"/>
                </td>
            </tr>

        </tbody>
    </table>
    <br clear="all"/>

    <table>
        <tr><td width="380px">
                Tandatangan Wakil Majikan
                <table>
                    <tr><td>Nama</td><td><input type="text" id=""/></td></tr>

                    <tr><td>No. Kad Pengenalan</td><td><input type="text" id=""/></td></tr>

                    <tr><td>Jawatan</td><td><input type="text" id=""/></td></tr>

                    <tr><td>No. Tel / <strong>Bimbit</strong></td><td><input type="text" id=""/></td></tr>

                    <tr><td><strong>E-Mel</strong></td><td><input type="text" id=""/></td></tr>

                    <tr><td>Tarikh</td><td><input type="text" id=""/></td></tr>

                </table>
            </td>
            <td>
                <table border="1" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td width="130" valign="top">
                                <br clear="all"/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <p align="center">
                                    Cop Rasmi Majikan
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br clear="all"/>
            </td>
            <td>

                CATATAN

                <p>
                <table>

                    <tr><td>1</td><td> Nombor Majikan mesti ditulis di belakang cek.</td></tr>

                    <tr><td>2</td><td> Jumlah bayaran mesti sama dengan jumlah di Borang A.</td></tr>

                    <tr><td>3</td><td> Potong maklumat ahli yang telah berhenti kerja.</td></tr>

                    <tr><td valign="top">4</td><td> Jika ada butir-butir pekerja yang tidak disenaraikan, sila catatkan semua<br/> butirnya dan masukkan pekerja baru dalam ruangan kosong (jika ada).</td></tr>

                    <tr><td>5</td><td> Ruang ketiga (NK) hanya diisi oleh KWSP sahaja.</td></tr>

                    <tr><td>6</td><td> Bulan caruman bersamaan Bulan Upah + 1</td></tr>

                    <tr><td valign="top">7</td><td> Upah termasuklah gaji pokok, komisyen, bonus, elaun dan bayaran<br/> yang dikenakan caruman KWSP.</td></tr>

                    <tr><td>8</td><td> Sila rujuk panduan mengisi Borang A di buku Panduan Majikan.</td></tr>
                </table>
                </p>
            </td>
        </tr>
    </table>
    <b>PERINGATAN: </b>Berdasarkan Akta KWSP 1991, kesilapan membekalkan maklumat ahli boleh menyebabkan tuan dikenakan caj atau tindakan undang-undang.
<?php } ?>
<div style="page-break-after:always;"></div>
<style type="text/css">
    p{font-size:10px;}
</style>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>