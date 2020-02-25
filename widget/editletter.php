<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$letter_id = $_GET["id"];
$sql2 = 'SELECT letter_name, letter_content FROM predefined_letter WHERE id =' . $letter_id;
$query2 = mysql_query($sql2);
$row2 = mysql_fetch_array($query2);

$queryCompany = mysql_query('SELECT name FROM company WHERE id=' . $_GET["company"]);
$rowCompany = mysql_fetch_array($queryCompany);
$companyname = $rowCompany["name"];

$content = $row2["letter_content"];
$today = date("ymd_His");

if ($_GET["doc"] == "" || $_GET["doc"] == " ") {
    $lettername = $row2["letter_name"];
} else {
    $lettername = $_GET["doc"];
}

require_once('plugins/tcpdf/config/lang/eng.php');
require_once('plugins/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set font
$pdf->SetFont('dejavusans', '', 10);

if ($letter_id == 1) {
// add a page
    $pdf->AddPage();

    $replace1 = array('<span id="date"></span>', '<span id="name"></span>', '<span id="address"></span>', '<span id="salutation"></span>', '<span id="position"></span>', '<span id="company"></span>', '<span id="datecommencement"></span>', '<span id="salary"></span>', '<span id="annualleave"></span>', '<span id="byname"></span>', '<span id="byposition"></span>', '<span id="transport"></span>','<span id="telephone"></span>','<span id="overtime"></span>',);
    $replace2 = array('<span id="date">' . $_GET["entry"] . '</span>', '<span id="name">' . $_GET["name"] . '</span>', '<span id="address">' . $_GET["add"] . '</span>', '<span id="salutation">' . $_GET["sal"] . '</span>', '<span id="position">' . $_GET["pos"] . '</span>', '<span id="company">' . $companyname . '</span>', '<span id="datecommencement">' . $_GET["date"] . '</span>', '<span id="salary">' . $_GET["salary"] . '</span>', '<span id="annualleave">' . $_GET["ann"] . '</span>', '<span id="byname">' . $_GET["byname"] . '</span>', '<span id="byposition">' . $_GET["bypos"] . '</span>' , '<span id="transport">' . $_GET["tr"] . '</span>', '<span id="telephone">' . $_GET["ta"] . '</span>', '<span id="overtime">' . $_GET["ot"] . '</span>');

    $newcontent = str_replace($replace1, $replace2, $content);

    // output the HTML content
    $pdf->writeHTML($newcontent, true, false, true, false, '');
} elseif ($letter_id == 2) {
// add a page
    $pdf->AddPage();

    $replace1 = array('<span id="date"></span>', '<span id="name"></span>', '<span id="address"></span>', '<span id="salutation"></span>', '<span id="position"></span>', '<span id="company"></span>', '<span id="effdate"></span>', '<span id="salary"></span>', '<span id="month"></span>', '<span id="byname"></span>', '<span id="byposition"></span>');
    $replace2 = array('<span id="date">' . $_GET["entry"] . '</span>', '<span id="name">' . $_GET["name"] . '</span>', '<span id="address">' . $_GET["add"] . '</span>', '<span id="salutation">' . $_GET["sal"] . '</span>', '<span id="position">' . $_GET["pos"] . '</span>', '<span id="company">' . $companyname . '</span>', '<span id="effdate">' . $_GET["date"] . '</span>', '<span id="salary">' . $_GET["salary"] . '</span>', '<span id="month">' . $_GET["prob"] . '</span>', '<span id="byname">' . $_GET["byname"] . '</span>', '<span id="byposition">' . $_GET["bypos"] . '</span>');

    $newcontent = str_replace($replace1, $replace2, $content);

    // output the HTML content
    $pdf->writeHTML($newcontent, true, false, true, false, '');
} elseif ($letter_id == 3) {
// add a page
    $pdf->AddPage();

    $replace1 = array('<span id="date"></span>', '<span id="name"></span>', '<span id="address"></span>', '<span id="salutation"></span>', '<span id="company"></span>', '<span id="effdate"></span>', '<span id="salary"></span>', '<span id="iamount"></span>', '<span id="byname"></span>', '<span id="byposition"></span>');
    $replace2 = array('<span id="date">' . $_GET["entry"] . '</span>', '<span id="name">' . $_GET["name"] . '</span>', '<span id="address">' . $_GET["add"] . '</span>', '<span id="salutation">' . $_GET["sal"] . '</span>', '<span id="company">' . $companyname . '</span>', '<span id="effdate">' . $_GET["date"] . '</span>', '<span id="salary">' . $_GET["salary"] . '</span>', '<span id="iamount">' . $_GET["iamount"] . '</span>', '<span id="byname">' . $_GET["byname"] . '</span>', '<span id="byposition">' . $_GET["bypos"] . '</span>');

    $newcontent = str_replace($replace1, $replace2, $content);

    // output the HTML content
    $pdf->writeHTML($newcontent, true, false, true, false, '');
} elseif ($letter_id == 4) {
// add a page
    $pdf->AddPage();

    $replace1 = array('<span id="date"></span>', '<span id="name"></span>', '<span id="address"></span>', '<span id="salutation"></span>', '<span id="position"></span>', '<span id="company"></span>', '<span id="effdate"></span>', '<span id="salary"></span>', '<span id="byname"></span>', '<span id="byposition"></span>');
    $replace2 = array('<span id="date">' . $_GET["entry"] . '</span>', '<span id="name">' . $_GET["name"] . '</span>', '<span id="address">' . $_GET["add"] . '</span>', '<span id="salutation">' . $_GET["sal"] . '</span>', '<span id="position">' . $_GET["pos"] . '</span>', '<span id="company">' . $companyname . '</span>', '<span id="effdate">' . $_GET["date"] . '</span>', '<span id="salary">' . $_GET["salary"] . '</span>', '<span id="byname">' . $_GET["byname"] . '</span>', '<span id="byposition">' . $_GET["bypos"] . '</span>');

    $newcontent = str_replace($replace1, $replace2, $content);

    // output the HTML content
    $pdf->writeHTML($newcontent, true, false, true, false, '');
} elseif ($letter_id == 5) {
// add a page
    $pdf->AddPage();

    $replace1 = array('<span id="date"></span>', '<span id="name"></span>', '<span id="address"></span>', '<span id="salutation"></span>', '<span id="company"></span>', '<span id="effdate"></span>', '<span id="month"></span>', '<span id="byname"></span>', '<span id="byposition"></span>', '<span id="reason"></span>');
    $replace2 = array('<span id="date">' . $_GET["entry"] . '</span>', '<span id="name">' . $_GET["name"] . '</span>', '<span id="address">' . $_GET["add"] . '</span>', '<span id="salutation">' . $_GET["sal"] . '</span>', '<span id="company">' . $companyname . '</span>', '<span id="effdate">' . $_GET["date"] . '</span>', '<span id="month">' . $_GET["prob"] . '</span>', '<span id="byname">' . $_GET["byname"] . '</span>', '<span id="byposition">' . $_GET["bypos"] . '</span>', '<span id="reason"><table style="padding-left: 20px; padding-top: 5px;"><tr><td>' . $_GET["reason"] . '</td></tr></table></span>');

    $newcontent = str_replace($replace1, $replace2, $content);

    // output the HTML content
    $pdf->writeHTML($newcontent, true, false, true, false, '');
} elseif ($letter_id == 6) {
// add a page
    $pdf->AddPage();

    $replace1 = array('<span id="date"></span>', '<span id="name"></span>', '<span id="address"></span>', '<span id="salutation"></span>', '<span id="company"></span>', '<span id="effdate"></span>', '<span id="wtitle"></span>', '<span id="byname"></span>', '<span id="byposition"></span>', '<span id="reason"></span>');
    $replace2 = array('<span id="date">' . $_GET["entry"] . '</span>', '<span id="name">' . $_GET["name"] . '</span>', '<span id="address">' . $_GET["add"] . '</span>', '<span id="salutation">' . $_GET["sal"] . '</span>', '<span id="company">' . $companyname . '</span>', '<span id="effdate">' . $_GET["date"] . '</span>', '<span id="wtitle">' . $_GET["wtitle"] . '</span>', '<span id="byname">' . $_GET["byname"] . '</span>', '<span id="byposition">' . $_GET["bypos"] . '</span>', '<span id="reason"><table style="padding-left: 20px; padding-top: 5px;"><tr><td>' . $_GET["reason"] . '</td></tr></table></span>');

    $newcontent = str_replace($replace1, $replace2, $content);

    // output the HTML content
    $pdf->writeHTML($newcontent, true, false, true, false, '');
}

//Close and output PDF document
$pdf->Output($lettername . '_' . $today . '.pdf', 'I');

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>