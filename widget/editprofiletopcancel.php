<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$getID = $_POST['userID'];
$query = mysql_query('SELECT * FROM employee WHERE id=' . $getID . ';');
$row = mysql_fetch_array($query);
$queryDept = mysql_query('SELECT d.dep_name FROM department AS d INNER JOIN emp_group AS eg JOIN employee AS e ON d.id=eg.dep_id AND e.group_id = eg.id WHERE e.id = ' . $getID . ';');
$rowDept = mysql_fetch_array($queryDept);

$queryCompany = mysql_query('SELECT c.code FROM company AS c INNER JOIN employee AS e ON c.id = e.company_id WHERE e.id = ' . $getID . ';');
$rowCompany = mysql_fetch_array($queryCompany);

$queryGroup = mysql_query('SELECT g.group_name FROM emp_group AS g INNER JOIN employee AS e ON g.id = e.group_id WHERE e.id=' . $getID . ';');
$rowGroup = mysql_fetch_array($queryGroup);

//       $queryLevel = mysql_query('SELECT l.name FROM level AS l INNER JOIN employee AS e ON l.id = e.level_id WHERE e.id = '.$getID.';');
//       $rowLevel = mysql_fetch_array($queryLevel);

$queryPos = mysql_query('SELECT p.position_name FROM position AS p INNER JOIN employee AS e ON p.id = e.position_id WHERE e.id = ' . $getID . ';');
$rowPos = mysql_fetch_array($queryPos);

$queryBranch = mysql_query('SELECT b.branch_code FROM branch AS b INNER JOIN employee AS e ON b.id = e.branch_id WHERE e.id = ' . $getID . ';');
$rowBranch = mysql_fetch_array($queryBranch);

$sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $getID);
$rowGetNew = mysql_fetch_array($sqlGetNew);
$rowCount = mysql_num_rows($sqlGetNew);

$sqlShift = "SELECT s.name as name FROM employee e
					left join shift s
					on e.shift_id=s.id where e.id=" . $getID . " limit 1";
$rsShift = mysql_query($sqlShift);
$rowShift = mysql_fetch_array($rsShift);

if ($rowCount > 0) {
    if ($rowGetNew['full_name'] != $row['full_name']) {
        $fontColorName = 'red';
        $imgName = 'block';
        $name = $rowGetNew['full_name'];
    } else {
        $fontColorName = null;
        $imgName = 'none';
        $name = $row['full_name'];
    }
} else {
    $fontColorName = null;
    $name = $row['full_name'];
}
if ($query) {
    echo '<div style="padding-top:20px">
                        <table id="titlebar" class="titleBarTo" style="width:98%; padding-right: 5px;">
                            <tr>
                                <td style="font-size:large;font-weight: bold;">
                                    &nbsp;&nbsp;&nbsp;Employee Details
                                </td>
                                <td onclick="editTop()" id="editBut">Edit</td>
                                <td onclick="back()" id="editBut">Back</td>
                            </tr>
                        </table>
                    </div>';
    $new_id = 'EMP' . str_pad($getID, 6, "0", STR_PAD_LEFT);

    echo '<table style="padding-top:20px;padding-left:20px;">
              <tr>
                  <td style="padding-top:5px;width:200px;">Employee ID</td>
                  <td style="padding-top:5px">' . $new_id . '</td>
              </tr>
              <tr>
                  <td style="padding-top:5px;width:200px;">Full Name</td>
                  <td style="padding-top:5px;color:' . $fontColorName . '">' . $name . '</td>
              </tr>
              <tr>
                  <td style="padding-top:5px;width:200px;">Status</td>
                  <td style="padding-top:5px;">' . $row["emp_status"] . '</td>
              </tr>
              <tr>
                  <td style="padding-top:5px;width:200px;">Company</td>
                  <td style="padding-top:5px">' . $rowCompany['code'] . '</td>
              </tr>
              <tr>
                  <td style="padding-top:5px;width:200px;">Branch</td>
                  <td style="padding-top:5px">' . $rowBranch['branch_code'] . '</td>
              </tr>
              <tr>
                  <td style="padding-top:5px;width:200px;">Department </td>
                  <td style="padding-top:5px">' . $rowDept['dep_name'] . '</td>
              </tr>
              <tr>
                  <td style="padding-top:5px;width:200px;">Section/Unit</td>
                  <td style="padding-top:5px">' . $rowGroup['group_name'] . '</td>
              </tr>
              <tr>
                  <td style="padding-top:5px;width:200px;">Position </td>
                  <td style="padding-top:5px"><input type="hidden" id="droppos" value="' . $rowPos['position_name'] . '" />' . $rowPos['position_name'] . '</td>
              </tr>
              <tr>
                  <td style="padding-top:5px;width:200px;">Shift </td>
                  <td style="padding-top:5px">' . $rowShift['name'] . '</td>
              </tr>
              <tr>
                  <td style="padding-top:5px;width:200px;">User Permission</td>
                  <td style="padding-top:5px">';
    $sql_up = 'SELECT name FROM user_permission WHERE id = ' . $row['level_id'];
    $query_up = mysql_query($sql_up);
    $row_up = mysql_fetch_array($query_up);
    echo $row_up['name'];
    echo '</td>
              </tr>
          </table>';
} else {
    print false;
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