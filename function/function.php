<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

function get_emp_name_code($emp_id) {
    $sql = 'SELECT full_name FROM employee e where id=' . $emp_id;
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    return $row['full_name'];
}

function image_resize($location, $width, $height) {
    $image_size = getImageSize($location);
    $ratio = $image_size[0] / $image_size[1];
    if ($image_size[0] > $width) {
        $image_size[0] = $width;
        $image_size[1] = $width / $ratio;
    }
    if ($image_size[1] > $height) {
        $image_size[1] = $height;
        $image_size[0] = $height * $ratio;
    }
    return $image_size;
}

function rand_string($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
}

function get_emp_email($emp_id) {
    $sql = "SELECT email FROM employee where id='" . $emp_id . "' limit 1";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    return $row['email'];
}

function get_leave($applied_id, $app_status) {
    $subject = 'Leave application has ' . $app_status;

    $sql = "SELECT * FROM employee_leave el
			left join employee e on el.emp_id=e.id
			left join leave_type l on el.leave_type_id=l.id
			where el.id=" . $applied_id;
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);

    $msg = 'Employee Name:' . $row["full_name"] . '<br />';
    $msg.='Leave Type:' . $row["type_name"] . '<br />';
    $msg.='From Date:' . $row["from_date"] . '<br />';
    $msg.='To Date:' . $row["to_date"] . '<br />';
    $msg.='Number of Days:' . $row["num_days"] . '<br />';
    $msg.='Reason:' . $row["reason"] . '<br />';
    $msg.='Request Date:' . $row["leave_date"] . '<br />';

    $result[] = $subject;
    $result[] = $msg;
    return $result;
}

function get_loan($applied_id, $app_status) {
    $sql = "SELECT * FROM employee_loan el
			left join employee e on el.emp_id=e.id
			where el.id=" . $applied_id;
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);

    $subject = 'Loan application has ' . $app_status;
    $msg = 'Employee Name:' . $row["full_name"] . '<br />';
    $msg.='Type of Loan:' . $row["type_of_loan"] . '<br />';
    $msg.='Loan Amount:' . $row["loan_amount"] . '<br />';
    $msg.='Installment:' . $row["installment"] . '<br />';
    $msg.='Reason:' . $row["reason_for_loan"] . '<br />';

    $result[] = $subject;
    $result[] = $msg;
    return $result;
}

function get_ovetime($applied_id, $app_status) {
    $sql = "SELECT * FROM employee_overtime eo
			left join employee e on eo.emp_id=e.id
			where eo.id=" . $applied_id;
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);

    $subject = 'Overtime application has ' . $app_status;
    $msg = 'Employee Name:' . $row["full_name"] . '<br />';
    $msg.='Overtime Date:' . $row["ot_date"] . '<br />';
    $msg.='From Time:' . $row["from_time"] . '<br />';
    $msg.='To Time:' . $row["to_time"] . '<br />';
    $msg.='Request Date:' . $row["request_date"] . '<br />';

    $result[] = $subject;
    $result[] = $msg;
    return $result;
}

function get_replacement($applied_id, $app_status) {
    $sql = "SELECT * FROM holiday_replacement h
			left join employee e on h.emp_id=e.id
			left join public_holiday p on h.pub_holiday_id=p.id
			where h.id=" . $applied_id;
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);

    $subject = 'Replacement application has ' . $app_status;
    $msg = 'Employee Name:' . $row["full_name"] . '<br />';
    $msg.='Public Holiday:' . $row["occasion_name"] . '<br />';
    $msg.='Replace By:' . $row["replace_date"] . '<br />';

    $result[] = $subject;
    $result[] = $msg;
    return $result;
}

function get_training($applied_id, $app_status) {
    $sql = "SELECT et.id,e.full_name,t.training_name,et.request_date
			FROM employee_training et
			join employee e on et.employee_id=e.id
			join training t on et.training_id=t.id where et.id=" . $applied_id;
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);

    $subject = 'Training application has ' . $app_status;
    $msg = 'Employee Name:' . $row["full_name"] . '<br />';
    $msg.='Training Name:' . $row["training_name"] . '<br />';
    $msg.='Request Date:' . $row["request_date"] . '<br />';

    $result[] = $subject;
    $result[] = $msg;
    return $result;
}

function get_claim($applied_id, $app_status) {
    $sql = "SELECT *
			FROM employee_claim ec join employee e
			on ec.emp_id=e.id where ec.id=" . $_GET["id"];
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);

    $subject = 'Claim application has ' . $app_status;
    $msg = 'Employee Name:' . $row["full_name"] . '<br />';
    $msg.='Claim Item Title:' . $row["claim_item_title"] . '<br />';
    $msg.='Claim No:' . $row["claim_no"] . '<br />';
    $msg.='Claim Date:' . $row["claim_date"] . '<br />';
    $msg.='Remark:' . $row["remark"] . '<br />';

    $result[] = $subject;
    $result[] = $msg;
    return $result;
}

function app_mail_process($emp_id, $app_option, $applied_id, $app_status) {
    $email = get_emp_email($emp_id);

    if ($app_option == 'leave') {
        list($subject, $msg) = get_leave($applied_id, $app_status);
    } elseif ($app_option == 'loan') {
        list($subject, $msg) = get_loan($applied_id, $app_status);
    } elseif ($app_option == 'overtime') {
        list($subject, $msg) = get_ovetime($applied_id, $app_status);
    } elseif ($app_option == 'replacement') {
        list($subject, $msg) = get_replacement($applied_id, $app_status);
    } elseif ($app_option == 'training') {
        list($subject, $msg) = get_training($applied_id, $app_status);
    } elseif ($app_option == 'claim') {
        list($subject, $msg) = get_claim($applied_id, $app_status);
    }
    mailto($email, $subject, $msg);
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>