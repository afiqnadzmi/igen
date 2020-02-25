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
    if ($_GET["status"] == "Active") {
        $result = mysql_query("select e.*,p.socso from employee e,payroll_report p where e.id in (" . $_GET['emp_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=" . $fid_result . " and e.emp_status='Active'");
    } elseif ($_GET["status"] == "Inactive") {
        $result = mysql_query("select e.*,p.socso from employee e,payroll_report p where e.id in (" . $_GET['emp_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=" . $fid_result . " and e.emp_status='Inactive'");
    } else {
        $result = mysql_query("select e.*,p.socso from employee e,payroll_report p where e.id in (" . $_GET['emp_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=" . $fid_result);
    }
} else {
    if ($_GET["dep_id"] == "0") {
        if ($_GET["status"] == "Active") {
            $result = mysql_query("select e.*,p.socso from employee e,payroll_report p where branch_id= (" . $_GET['branch_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=" . $fid_result . " and e.emp_status='Active'");
        } else if ($_GET["status"] == "Inactive") {
            $result = mysql_query("select e.*,p.socso from employee e,payroll_report p where branch_id= (" . $_GET['branch_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=" . $fid_result . " and e.emp_status='Inactive'");
        } else {
            $result = mysql_query("select e.*,p.socso from employee e,payroll_report p where branch_id= (" . $_GET['branch_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=" . $fid_result);
        }
    } else {
        if ($_GET["status"] == "Active") {
            $result = mysql_query("select e.*,p.socso from employee e,payroll_report p where e.dep_id= (" . $_GET['dep_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=" . $fid_result . " and e.emp_status='Active'");
        } else if ($_GET["status"] == "Inactive") {
            $result = mysql_query("select e.*,p.socso from employee e,payroll_report p where e.dep_id= (" . $_GET['dep_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=" . $fid_result . " and e.emp_status='Inactive'");
        } else {
            $result = mysql_query("select e.*,p.socso from employee e,payroll_report p where e.dep_id= (" . $_GET['dep_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=" . $fid_result);
        }
    }
}
//$result = mysql_query("select * from employee where id in (".$_GET['emp_id'].")");
//$result = mysql_query("select e.*,p.socso from employee e,payroll_report p where e.id in (" . $_GET['emp_id'] . ") and e.id=p.emp_id and p.payroll_finalised_id=".$_GET['fid']);
$rs1 = mysql_fetch_array(mysql_query("select * from branch where id in (select branch_id from employee where id in (" . $_GET['emp_id'] . "))"));
$no = mysql_num_rows($result);
$page = $no / 12;
if ($no % 12)
    $page++;
for ($j = 1; $j <= $page; $j++) {
    ?>
    <!--        <table style='width:600px;margin:auto;' border="1">-->
    <table>
        <tr>
            <td>
                <table valign="top">
                    <tr>
    <!--                            <td style='width:100px'>-->
                        <td>
                            <span style='font-weight:bold;font-size:20px;'>BORANG</span><br />
                            <span style='font-weight:bold;font-size:40px;'>&nbsp;&nbsp;8A</span><br />
                            <img src='images/perkeso_logo.png' style='width:100px'/><br />
                            <span style='font-weight:bold;font-size:12px;'>No. Kod Majikan</span><br /><br />
                            <span style='font-weight:bold;font-size:12px;'>Nama dan Alamat<br /> Majikan</span><br />
                        </td>
    <!--                            <td style='width:700px'>-->
                        <td>
    <!--                                <table style='width:100%'>-->
                            <table>

                                <tr>
                                    <td>
                                        <span style='font-size:25px'>PERTUBUHAN KESELAMATAN SOSIAL</span>
                                        <div style='font-size:13px;width:300px;margin:auto;'>JADUAL CARUMAN BULANAN</div>
    <?php
    $rsa = mysql_fetch_array(mysql_query("select * from payroll_finalised where id=" . $fid_result));
    ?>
                                        <div style='font-size:13px;width:350px;margin:auto;'>UNTUK CARUMAN BULAN <input type='text' style='width:100px' value="<?php $timestamp = mktime(0, 0, 0, $rsa['finalise_month'], 1, $rsa['finalise_year']);
                                    echo date("M Y", $timestamp); ?>"/></div>
                                        <span style='font-size:10px'>Jumlah caruman untuk bulan di atas hendaklah dibayar <br />tidak lewat daripada <input type='text' style='width:60px' /></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
    <!--											<table style='border:10px solid #000000;border-collapse:collapse;width:100%;font-size:10px'>-->
                                        <table border="1" style="border-collapse:collapse;font-size:10px;">
                                            <tr>
    <!--													<td style='width:400px' colspan='2'>-->
    <!--                                                                                                    <td colspan='2'>-->
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td><div style="width:10px;height:10px;border:1px solid black"/></td>
                                                            <td>Bayaran Tunai.</td>
                                                        </tr>
                                                        <tr>
                                                            <td><div style="width:10px;height:10px;border:1px solid black"/></td>
                                                            <td> Bayaran cek. No. cek<input type="text" style='width:60px'/></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td align="center" valign="middle">
                                                    Amaun<br />
                                                    RM <input type='text' style='width:60px' />
                                                </td>
                                                <td align="center" valign="middle">
                                                    Bilangan Pekerja
                                                </td>
                                                <td align="center" valign="middle">
                                                    Lembaran
                                                </td>
                                            </tr>
                                            <tr valign='top'><td colspan="4">
                                                    <table style="border-collapse:collapse;padding:-2 0 0 0"><tr>
                                                            <td style="border-right:1;width:325px">
        <!--                                                    <td colspan='2' style='width:400px' >-->
                                                                <br />
                                                                <input type='text' value="<?php echo $rs1['branch_code']; ?>"/>
                                                                <br/><br/><br/><br/>
                                                                <?php echo $rs1['branch_name']; ?><br/>
                                                                <?php echo $rs1['address1'] . $rs1['address2'] . $rs1['postal_code']; ?>
                                                            </td>
        <!--                                                    <td colspan='3'>-->
                                                            <td>
                                                                <ol style="width:300px;">
                                                                    <li>NO. PENDAFTARAN KESELAMATAN SOSIAL ADALAH <br />NOMBOR KAD PENGENALAN PENDAFTARAN NEGARA.</li>
                                                                    <li>Tandakan Tandakan XX di di ruangan ruangan<br /> (2) jika jika pekerja pekerja telah telah berhenti <br />berhentikerja dan masukkan tarikh berhenti kerja di ruangan (3).</li>
                                                                    <li>Isikan tarikh mula kerja untuk pekerja yang tidak<br /> tersenarai sahaja di ruangan (3). Pendaftaran pekerja   <br />sedemikian hendaklah juga dibuat dalam borang 2.</li>
                                                                    <li>Jika tiada caruman sebab cuti tanpa gaji masukkan <br />angka 00.00 di ruangan (6).</li>
                                                                    <li>Jika ada butir-butir yang didapati tidak betul, jangan <br />buat pindaan di borang ini, sila beritahu PERKESO secara bertulis.</li>
                                                                    <li>Sila pastikan tulisan/angka/cap tidak menyentuh<br /> mana-mana garisan/kotak/barcode yang disediakan</li>
                                                                    <li>Format untuk tkh. mula/tkh. berhenti kerja adalah hhbbtttt<br /> contoh 01072000.</li>
                                                                </ol>
                                                            </td>
                                                        </tr></table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border style='border-collapse:collapse;' border="2">
                    <tr valign="middle" align="center">
                        <td style='width:120px'>
    <!--                                        <td style='width:150px'>-->
                            <span style='font-size:10px'>NO. KAD PENGENALAN
                                PENDAFTARAN NEGARA
                                Lihat Catatan (1)</span>
                        </td>
                        <td> <span style='font-size:10px'>(2)</span></td>
                        <td style='width:100px'>
    <!--                                        <td style='width:100px'>-->
                            <span style='font-size:10px'>TKH. MULA/TKH.
                                BERHENTI KERJA
                                (3)</span>
                        </td>
                        <td style='width:60px'>
    <!--                                        <td style='width:100px'>-->
                            <span style='font-size:10px'>KEGUNAAN PERKESO (4)</span>
                        </td>
                        <td style='width:300px'>
                            <span style='font-size:10px'>NAMA PEKERJA (MENGIKUT KAD PENGENALAN) (5)</span>
                        </td>
                        <td style='width:105px'>
    <!--                                        <td style='width:105px'>-->
                            <span style='font-size:10px'>
                                CARUMAN (6)
                                <!--                                <div style='clear:both'></div>
                                                                <div style='float:left;width:20px;height:20px;'>RM</div>
                                                                <div style='float:left;width:20px;height:20px;'></div>
                                                                <div style='float:left;width:20px;height:20px;'>SEN</div>
                                                                <div style='clear:both'></div></span>-->
                                <br /> RM &nbsp;&nbsp;&nbsp;&nbsp;SEN
                            </span>
                        </td>
                    </tr>
                    <?php
//                        $result2 = mysql_query("select * from employee where id in (".$_GET['emp_id'].")");
                    $jumlah = 0;
                    for ($i = 0; $i < 20; $i++) {
                        if ($rs = mysql_fetch_array($result)) {
                            $jumlah+=$rs['socso'];
							if($rs['ic']!=""){
								$ic_pass=$rs['ic'];
							}else{
								$ic_pass=$rs['passport'];
							}
                            ?>
                            <tr>
                                <td><?php echo $ic_pass; ?></td>
                                <td><input type="text" style="width:20px"/></td>
                                <td><?php echo $rs['join_date']; ?></td>
                                <td><input type="text" style="width:80px"/></td>
                                <td><?php echo $rs['full_name']; ?></td>
                                <td><input type="text" style="width:110px" value="<?php echo $rs['socso']; ?>"/></td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <tr>
                        <td colspan='6' align="right">&nbsp;
    <!--                                <div style='float:right;width:220px;height:25px'>Jumlah muka surat ini <input type='text' style='width:100px' /></div>-->
                            Jumlah muka surat ini <input type='text' style='width:150px' value="<?php echo $j; ?>"/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <!--                    <div style='float:right;width:250px;height:25px'>Jumlah Besar <input type='text' style='width:150px' /></div>-->
                Jumlah Besar <input type='text' style='width:150px' value="<?php echo number_format($jumlah, 2) ?>"/>&nbsp;&nbsp;


            </td>
        </tr>
        <tr>
            <td>

                <!--                    <div style='font-size:12px'>-->
                PERHATIAN: <br />
                1.  Sila fotostat Borang 8A untuk rekod tuan.<br />
                2.  Untuk mendapatkan khidmat penceramah PERKESO, sila mohon di alamat e-mel berikut :- perkeso@perkeso.gov.my.
                <!--                    </div>-->
            </td>
        </tr>
        <tr>
            <td>
                <table style='font-size:12px;width:100%'>
                    <tr>
                        <td>Tandatangan</td>
                        <td>:</td>
                        <td><input type='text' /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Nama Penuh</td>
                        <td>:</td>
                        <td><input type='text' /></td>
                        <td>No. Tel & Cap Majikan</td>
                        <td>:</td>
                        <td><input type='text' /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php } ?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>