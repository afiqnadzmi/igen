<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$rs1 = mysql_fetch_array(mysql_query("select * from branch where id in (select branch_id from employee where branch_id in (" . $_GET['branch_id'] . "))"));
?>
<!--         <table border style='width:800px;margin:auto;'>-->
<table border style='width:800px;margin:0 0 0 40'>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <span style='font-size:10px'>Borang ini boleh difotokopi</span>
                        <table border style='border-collapse:collapse;font-size:11px;border: solid 1px #55DD44'>
                            <tr>
<!--										<td style='border: solid 1px black' width="500px">-->
                                <td>
                                    <div style="border:1;width:280px">
                                        <b>
                                            KETUA PENGARAH HASIL DALAM NEGERI<br /><br />
                                            LEMBAGA HASIL DALAM NEGERI<br /><br />
                                        </b>
                                        Cawangan Pungutan Kuala Lumpur<br /><br />
                                        Kaunter Bayaran  Dan Tingkat 1, Blok 8A<br /><br />
                                        Kompleks Bangunan Kerajaan, Jalan Duta<br /><br />
                                        50600 KUALA LUMPUR
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style='width:250px'>
                        <table style='font-size:11px;'>
                            <tr>
                                <td>
                                    <img style='width:60px;border:0' src='images/logoLHDN.gif' />
                                </td>
                                <td style='width:400px;' align="center">
                                    <b>CUKAI PENDAPATAN MALAYSIA</b><br /><br />
                                    PENYATA POTONGAN CUKAI OLEH MAJIKAN<br /><br />
                                    <span style='color:red;'>[SEKSYEN 107 AKTA CUKAI PENDAPATAN, 1967</span><br /><br />
                                    <span style='color:red;'>KAEDAH CUKAI PENDAPATAN (POTONGAN DARIPADA SARAAN), 1994]</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2' align="center">
                                    <br />
                                    <b>POTONGAN BAGI BULAN &nbsp;&nbsp;<input type='text' style='width:50px' value="<?php echo $_GET['month'] ?>"/>&nbsp;&nbsp;&nbsp;&nbsp; 
                                        Tahun &nbsp;&nbsp;<input type='text' style='width:50px' value="<?php echo $_GET['year'] ?>"/> </b>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td align="right">
<!--								<span style='width:100px;font-size:10px;height:20px;'>CP39 Pin. 2011</span><br />-->
                        <span style='font-size:10px;'>CP39 Pin. 2011</span><br />                                                                
                        <table border style='border-collapse:collapse;font-size:11px;'>
                            <tr>
                                <td style='border:1px solid black;' align="center">
                                    <span style='font-weight:bold;'>
                                        UNTUK KEGUNAAN PEJABAT</span><br /><br />
                                    No. Kelompok <input type='text' />&nbsp;&nbsp;<br /><br />

                                    No. Resit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' />&nbsp;&nbsp;<br /><br />
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
            <table>
                <tr valign='top'>
                    <td style="width:330px">

                        <table style='font-size:11px;border-collapse:collapse;'>
                            <tr>
                                <td align="center" style='width:331px;border:1px solid black;background-color:#D8D8D8;' colspan='2'>BUTIR-BUTIR MAJIKAN</td>
                            </tr>
                            <tr>
                                <td style='border:1px solid black' >
                                    <b>No. Rujukan Majikan E</b> 
                                </td>
                                <td style='border:1px solid black' >
                                    <input type='text' style='width:70px' /> - <input type='text' style='width:20px' /> 
                                </td>
                            </tr>
                            <tr>
                                <td style='border:1px solid black' >
                                    Nama Syarikat/<br />No. K/P Perniagaan
                                </td>
                                <td style='border:1px solid black' >
                                    <input type='text' style='width:100px' value="<?php echo $rs1['branch_name']; ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td style='border:1px solid black' >
                                    Nama Syarikat/Perniagaan
                                </td>
                                <td style='border:1px solid black' >
                                    <input type='text' style='width:100px' value="<?php echo $rs1['branch_name']; ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td style='border:1px solid black' >
                                    Alamat Syarikat/ Perniagaan
                                </td>
                                <td style='border:1px solid black' >
                                    <textarea><?php echo $rs1['address1'] . $rs1['address2'] . $rs1['postal_code']; ?></textarea>
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td style="width:380px;">
                        <table style='font-size:11px;border-collapse:collapse;width:500px' border>
                            <tr>
                                <td align="center" style='width:379px;border:1px solid black;background-color:#D8D8D8;'  colspan='3'>BUTIR-BUTIR PEMBAYARAN</td>
                            </tr>
                            <tr>
                                <td style='width:85px;border:1px solid black'>&nbsp;</td>
                                <td style='width:100px;border:1px solid black'>PCB</td>
                                <td style='width:100px;border:1px solid black'>CP38</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black'>Jumlah Potongan</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black'>Bilangan Pekerja</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black' rowspan='4'>Butir-butir / Cek /<br />Bank / Deraf<br />/ Kiriman Wang /<br />Wang Pos</td>
                                <td style='width:100px;border:1px solid black'>Amaun</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black'>Nombor</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black'>Cawangan</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black'>Tarikh</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:268px;">
                        <table border style='font-size:11px;border-collapse:collapse;width:263px;'>

                            <tr>
                                <td align="center" colspan='2' style='width:260px;border:1px solid black;background-color:#D8D8D8;'>PEGAWAI YANG MENYEDIAKAN MAKLUMAT</td>
                            </tr>
                            <tr>
                                <td style='width:60px;border:1px solid black'>Tandatangan</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black'>Nama Penuh</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black'>No. K/P</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black'>Jawatan</td>
                                <td style='width:100px;border:1px solid black'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='width:100px;border:1px solid black'>No. Telefon</td>
                                <td style='width:100px;border:1px solid black'><div style="height:45px"></div></td> 
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr valign='top'>
                    <td style="width:530px">
                        <table style='width:400px'>
                            <tr>
                                <td>
                                    <table style='border-collapse:collapse;font-size:11px' border>
                                        <tr style="background-color:#D8D8D8;">
                                            <td style='border:1px solid black'>A</td>
                                            <td style='border:1px solid black'>BORANG CP 39</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='font-size:11px'>

                                    <ol>
                                        <li>Borang ini mesti diisi dengan lengkap dan betul.</li>
                                        <li>Majikan digalakkan menghantar maklumat potongan dalam bentuk disket/cakera padat/pemacu flash  lewatnya pada hari kesepuluh bulan berikutnya.
                                            mengikut format dan spesifikasi yang ditentukan oleh LHDN bagi menggantikan Borang CP39</li>
                                        <li>
                                            No. Rujukan Cukai Pendapatan:
                                            <ol style="list-style:none">
                                                <li>3.1 Isikan nombor rujukan cukai pendapatan dalam ruangan yang telah disediakan.<br />
                                                    Contoh: SG 2506203-00(0) boleh diisi sebagai SG 02506203000
                                                </li>
                                                <li>3.2 Bagi pekerja yang layak dikenakan PCB tetapi tiada nombor rujukan fail cukai pendapatan, pendaftaran boleh dibuat melalui :
                                                    <ol style="list-style:none">
                                                        <li>i. majikan atau pekerja boleh mendaftar secara atas talian melalui e-Daftar di www.hasil.gov.my, atau</li>
                                                        <li>ii. Borang CP22 atau borang in lieu of CP39 dikemukakan ke cawangan LHDNM yang berdekatan.</li>
                                                    </ol>
                                                </li>
                                            </ol>
                                        </li>
                                        <li>Nama pekerja : <br />
                                            Isikan nama penuh pekerja seperti di kad pengenalan/pasport <b>(Jangan senaraikan pekerja yang
                                                tidak layak dikenakan potongan bagi bulan berkenaan).</b>
                                        </li>
                                        <li>Nombor Kad Pengenalan : Isikan kedua-dua nombor kad pengenalan baru dan lama (sekiranya ada).
                                            <b>Contoh: 720403065235 atau A2172122</b>
                                        </li>
                                        <li>
                                            Jumlah Potongan Cukai:<br />
                                            PCB  - Isikan amaun cukai mengikut Potongan Cukai Bulanan.<br />
                                            CP38 - Isikan amaun potongan cukai mengikut arahan Borang CP38 (jika ada).
                                        </li>
                                    </ol>
                                    <!--<div style="width:500px">
                                                                                    1. Borang ini mesti diisi dengan lengkap dan betul.<br />
                                                                                <br/>    2. Majikan digalakkan menghantar maklumat potongan dalam bentuk disket/cakera padat/pemacu flash  lewatnya pada hari kesepuluh bulan berikutnya.
                                                                                        mengikut format dan spesifikasi yang ditentukan oleh LHDN bagi menggantikan Borang CP39
                                                                                    
                                                                             <br />           3. No. Rujukan Cukai Pendapatan:
                                                                                       
                                                                                      <br />      &nbsp;&nbsp;&nbsp;&nbsp; 3.1 Isikan nombor rujukan cukai pendapatan dalam ruangan yang telah disediakan.<br />
                                                                                                Contoh: SG 2506203-00(0) boleh diisi sebagai SG 02506203000
                                                                                            
                                                                                   <br />         &nbsp;&nbsp;&nbsp;&nbsp; 3.2 Bagi pekerja yang layak dikenakan PCB tetapi tiada nombor rujukan fail cukai pendapatan, pendaftaran boleh dibuat melalui :
                                                                                                
                                                                                    <br />      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; i. majikan atau pekerja boleh mendaftar secara atas talian melalui e-Daftar di www.hasil.gov.my, atau
                                                                                     <br />     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ii. Borang CP22 atau borang in lieu of CP39 dikemukakan ke cawangan LHDNM yang berdekatan.
                                                                                                
                                                                                     
                                                                              <br />      4. Nama pekerja : 
                                                                                        Isikan nama penuh pekerja seperti di kad pengenalan/pasport <b>(Jangan senaraikan pekerja yang
                                                                                            tidak layak dikenakan potongan bagi bulan berkenaan).</b>
                                                                                    
                                                                                <br />    5. Nombor Kad Pengenalan : Isikan kedua-dua nombor kad pengenalan baru dan lama (sekiranya ada).
                                                                                        <b>Contoh: 720403065235 atau A2172122</b>
                                                                              
                                                                             <br />       6. Jumlah Potongan Cukai:<br />
                                                                                        PCB  - Isikan amaun cukai mengikut Potongan Cukai Bulanan.<br />
                                                                                        CP38 - Isikan amaun potongan cukai mengikut arahan Borang CP38 (jika ada).
                                    </div>-->
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style='width:485px'>
                        <table style='width:400px'>
                            <tr>
                                <td>
                                    <table style='border-collapse:collapse;font-size:11px' border>
                                        <tr style="background-color:#D8D8D8;">
                                            <td style='border:1px solid black'>B</td>
                                            <td style='border:1px solid black'>PEMBAYARAN</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='font-size:11px'>
                                    <ol>
                                        <li>
                                            Bayaran dan Borang CP39 yang telah lengkap diisi  mestilah sampai ke Cawangan Pungutan LHDN selewat-lewatnya pada hari kesepuluh bulan berikutnya.<br />
                                            Contoh: <b>PCB/CP38 bagi bulan April 2010, tarikh akhirnya ialah pada 10 Mei 2010.</b>
                                        </li>
                                        <li>
                                            Sediakan borang CP39 beserta cek/bank draf/kiriman wang/wang pos (instrumen bayaran) yang berasingan untuk bulan atau tahun berlainan.
                                        </li>
                                        <li>
                                            Pastikan jumlah potongan PCB/CP38 adalah betul dan sama dengan nilai instrumen bayaran.
                                        </li>
                                        <li>
                                            Instrumen bayaran hendaklah dibayar kepada Ketua Pengarah Hasil Dalam Negeri. Catatkan no rujukan majikan E,Nama Syarikat/Perniagaan dan alamat majikan di belakang instrumen bayaran.
                                        </li>
                                        <li>
                                            Bayaran untuk Cukai Syarikat, Skim Ansurans (CP500), Penyelesaian Cukai (Pemberhentian Kerja) dan Cukai. Keuntungan Harta Tanah tidak boleh dibayar bersama dengan bayaran yang menggunakan borang ini.
                                        </li>
                                        <li>
                                            Untuk bayaran bagi Negeri Sabah, sila alamatkan ke : 7. Untuk bayaran bagi Negeri Sarawak, sila alamatkan ke :

                                            <table style='font-size:11px'>
                                                <tr>
                                                    <td>Cawangan Pungutan Kota Kinabalu</td>
                                                    <td>Cawangan Pungutan Kuching,</td>
                                                </tr>
                                                <tr>
                                                    <td>Wisma Hasil</td>
                                                    <td>Aras 1, Wisma Hasil,</td>
                                                </tr>
                                                <tr>
                                                    <td>Jalan Tunku Abdul Rahman</td>
                                                    <td>No. 1, Jalan Padungan, </td>
                                                </tr>
                                                <tr>
                                                    <td>88600 Kota Kinabalu, Sabah</td>
                                                    <td>93100 Kuching, Sarawak</td>
                                                </tr>
                                            </table>
                                        </li>
                                    </ol>
                                    <div style='margin-left:25px'>8. Sila hubungi talian 1-300-88-3010 untuk sebarang pertanyaan lanjut.</div>
                                </td>
                            </tr>
                        </table>
                        <table style='width:400px'>
                            <tr>
                                <td>
                                    <table style='border-collapse:collapse;font-size:11px' border>
                                        <tr style="background-color:#D8D8D8;">
                                            <td style='border:1px solid black'>C</td>
                                            <td style='border:1px solid black'>PERINGATAN</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='font-size:11px'>
                                    <ol>
                                        <li>
                                            Jika jumlah instrumen bayaran tidak sama dengan jumlah potongan, bayaran akan ditolak.
                                        </li>
                                        <li>
                                            Sekiranya maklumat tidak lengkap dan tidak betul, majikan akan dikenakan kompaun.
                                        </li>
                                    </ol>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
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
            $result = mysql_query("select * from employee where id in (" . $_GET['emp_id'] . ") and emp_status='Active' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . " AND pcb <> 0.00)");
        } else if ($_GET["status"] == "Inactive") {
            $result = mysql_query("select * from employee where id in (" . $_GET['emp_id'] . ") and emp_status='Inactive' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . " AND pcb <> 0.00)");
        } else {
            $result = mysql_query("select * from employee where id in (" . $_GET['emp_id'] . ") and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . " AND pcb <> 0.00)");
        }
    } else {
        if ($_GET["dep_id"] == "0") {
            if ($_GET["status"] == "Active") {
                $result = mysql_query("select * from employee where branch_id= (" . $_GET['branch_id'] . ") and emp_status='Active' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . " AND pcb <> 0.00)");
            } else if ($_GET["status"] == "Inactive") {
                $result = mysql_query("select * from employee where branch_id= (" . $_GET['branch_id'] . ") and emp_status='Inactive' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . " AND pcb <> 0.00)");
            } else {
                $result = mysql_query("select * from employee where branch_id= (" . $_GET['branch_id'] . ")and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . " AND pcb <> 0.00)");
            }
        } else {
            if ($_GET["status"] == "Active") {
                $result = mysql_query("select * from employee where dep_id= (" . $_GET['dep_id'] . ") and emp_status='Active' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . " AND pcb <> 0.00)");
            } else if ($_GET["status"] == "Inactive") {
                $result = mysql_query("select * from employee where dep_id= (" . $_GET['dep_id'] . ") and emp_status='Inactive' and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . " AND pcb <> 0.00)");
            } else {
                $result = mysql_query("select * from employee where dep_id= (" . $_GET['dep_id'] . ")and id in (select emp_id from payroll_report where payroll_finalised_id=" . $fid_result . " AND pcb <> 0.00)");
            }
        }
    }

    //$result = mysql_query("select * from employee where id in (" . $_GET['emp_id'] . ") and id in (select emp_id from payroll_report where payroll_finalised_id=" . $_GET['fid'] . ")");
    $no = mysql_num_rows($result);
    $page = $no / 12;
	
    if ($no % 12)
        $page++;
    for ($j = 1; $j <= $page; $j++) {

        ?>
        <tr>
            <td style='font-size:11px'>
                <div style="page-break-after:always;"></div>
                <table>
                    <tr>
                        <td style='width:490px'>
                            No. Rujukan Majikan E <input type='text' /> - <input type='text' style='width:50px' />&nbsp;
                        </td>
                        <td style='width:500px;' align="right">
                            Muka Surat <?php echo $j; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border style='font-size:10px;border-collapse:collapse;'>
                    <tr align="center" style="background-color:#D8D8D8;">
                        <td style='border:1px solid #000000' rowspan='2'>BIL.</td>
                        <td style='border:1px solid #000000;width:120px;' rowspan='2'>NO. RUJUKAN CUKAI<br />PENDAPATAN</td>
                        <td style='border:1px solid #000000;width:300px;' rowspan='2'>
                            NAMA PENUH PEKERJA<br />(SEPERTI DI KAD PENGENALAN ATAU PASPORT)
                        </td>
                        <td style='border:1px solid #000000;width:100px;' rowspan='2'>
                            NO. K/P LAMA
                        </td>
                        <td style='border:1px solid #000000;width:100px;' rowspan='2'>
                            NO. K/P BARU
                        </td>
                        <td style='border:1px solid #000000;width:50px;' rowspan='2'>
                            NO. PEKERJA
                        </td>
                        <td style='border:1px solid #000000;width:120px' colspan='2'>
                            BAGI PEKERJA ASING
                        </td>
                        <td style='border:1px solid #000000;width:140px' colspan='2'>
                            JUMLAH POTONGAN CUKAI
                        </td>
                    </tr>
                    <tr align="center" style="background-color:#D8D8D8;">
                        <td style='border:1px solid #000000'>NO. PASPORT</td>
                        <td style='border:1px solid #000000'>KOD NEGARA</td>
                        <td style='border:1px solid #000000'>PCB (RM)</td>
                        <td style='border:1px solid #000000'>CP38 (RM)</td>
                    </tr>
                    <?php
                    $total_pcb = 0;
                    for ($i = 0; $i < 24; $i++) {
                        if ($rs = mysql_fetch_array($result)) {
                            ${"rs" . $i} = mysql_fetch_array(mysql_query("select * from payroll_report where payroll_finalised_id=" . $fid_result . " and  emp_id=" . $rs['id']));
                            ?>
                            <tr>
                                <td style='border:1px solid #000000'><?php echo $number_of_ppl++; ?></td>
                                <td style='border:1px solid #000000'><?php echo $rs['epf_num']; ?></td>
                                <td style='border:1px solid #000000'><?php echo $rs['full_name']; ?></td>
                                <td style='border:1px solid #000000'><input type="text" style="width:80px"/></td>
                                <td style='border:1px solid #000000'><?php echo $rs['ic']; ?></td>
                                <td style='border:1px solid #000000'><?php echo 'EMP' . str_pad($rs['id'], 6, "0", STR_PAD_LEFT); ?></td>
                                <td style='border:1px solid #000000'><input type="text" style="width:40px"/ value="<?php echo $rs['passport']; ?>"></td>
                                <td style='border:1px solid #000000'><input type="text" style="width:40px"/></td>
                                <td style='border:1px solid #000000'><input type="text" style="width:80px" value="<?php
                echo ${"rs" . $i}['pcb'];
                $total_pcb +=${"rs" . $i}['pcb'];
                            ?>"/></td>
                                <td style='border:1px solid #000000'><input type="text" style="width:80px" value=""/></td>
                            </tr>
                            <?php
                        } else {
                            ?>

                            <tr>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                                <td style='border:1px solid #000000'>&nbsp;</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style='width:100%;font-size:11px'>
                    <tr>
                        <td style='width:760px'>Borang CP39 boleh diperolehi di laman web : http://www.hasil.gov.my</td>
                        <td style="align:right;">

                            <table border style='border-collapse:collapse;'>
                                <tr>
                                    <td style='width:110px;font-size:12px;border:1px solid #000000'>Jumlah&nbsp;</td>
                                    <td style='width:58px;border:1px solid #000000'><?php echo number_format($total_pcb, 2); ?></td>
                                    <td style='width:58px;border:1px solid #000000'>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style='width:110px;font-size:12px;border:1px solid #000000'>Jumlah Besar&nbsp;</td>
                                    <td colspan='2' style='width:108px;border:1px solid #000000'>&nbsp;</td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    <?php } ?>
</table>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>