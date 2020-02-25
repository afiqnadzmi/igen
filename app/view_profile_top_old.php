<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div style="padding-left:20px;padding-top:10px;">
    <table style="width:100%">
        <tr>
            <td style="padding-left:20px;width:15%;height:320px; vertical-align: top; padding-top: 20px;">
                <!-- profile picture-->
                <table>
                    <tr style="height:255px;">
                        <td>
                            <?php
                            if (substr($row['image_src'], 0, 5) != 'image') {
                                echo '<img id="profileIMG" onmouseover="uploadImage()" onmouseout="noUploadImage()"  style="width:180px;height:250px;" src="images/profilePic/Gra_ProfilePhoto.png" />
                                            </td>
                                        </tr>
                                        <tr style="height:20px;">
                                            <td style="color: white;">
                                                <a id="uploadImage" onmouseover="uploadImage()" onmouseout="noUploadImage()" style="background-color:#007DC5; display:none;position: relative;top: -20px;cursor:pointer;z-index: 10;text-align: center;"  onclick="uploadPic(' . $row['id'] . ')" >Upload a new photo</a>
                                            </td>
                                        </tr>';
                            } else {
                                echo '<img id="profileIMG" onmouseover="uploadImage()" onmouseout="noUploadImage()"  style="width:180px;height:250px" src="' . $row["image_src"] . '" />
                                            </td>
                                        </tr>
                                        <tr style="height:20px;">
                                            <td style="color: white;">
                                                <a id="uploadImage" onmouseover="uploadImage()" onmouseout="noUploadImage()" style="background-color:#007DC5; display:none;position: relative;top: -20px;cursor:pointer;z-index: 10;text-align: center;"  onclick="deletePic(\'' . $row['image_src'] . '\',' . $row['id'] . ')">Change photo</a>
                                            </td>
                                        </tr>';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="padding-left: 20px;vertical-align: top;width:85%;">
                <div id="topDetails">
                    <div style="padding-top:20px">
                        <table id ="titlebar" style="width:98%; padding-right: 5px;">
                            <tr>
                                <td style="font-size:large;font-weight: bold;">
                                    &nbsp;&nbsp;&nbsp;Employee Details
                                </td>
                                <?php if ($igen_a_hr == "a_hr_edit") { ?>
                                    <td onclick="editTop()" id="editBut">Edit</td>
                                    <td onclick="back()" id="editBut">Back</td>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>
                    <?php
                    $idGet = $_GET['viewId'];
                    $new_id = 'EMP' . str_pad($idGet, 6, "0", STR_PAD_LEFT);
                    ?>

                    <table style="padding-top:20px;padding-left:20px;">
                        <tr>
                            <td style="padding-top:5px;width:200px;">Employee ID</td>
                            <td style="padding-top:5px;"><?php print $new_id; ?></td>
                        </tr>
                        <?php
                        $sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $getID);
                        $rowGetNew = mysql_fetch_array($sqlGetNew);
                        $rowCount = mysql_num_rows($sqlGetNew);

                        $sqlGetOld = mysql_query('SELECT * FROM employee WHERE id =' . $getID);
                        $rowGetOld = mysql_fetch_array($sqlGetOld);

                        if ($rowCount > 0) {
                            if ($rowGetNew['full_name'] != $rowGetOld['full_name']) {
                                $fontColorName = 'red';
                                $imgName = 'block';
                                $full_name = $rowGetNew['full_name'];
                            } else {
                                $fontColorName = null;
                                $imgName = 'none';
                                $full_name = $rowGetOld['full_name'];
                            }
                        } else {
                            $fontColorName = null;
                            $full_name = $rowGetOld['full_name'];
                        }
                        ?>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Full Name</td>
                            <td style="padding-top:5px;color:<?php echo $fontColorName ?>;"><?php print $full_name; ?></td>
                        </tr>
						<tr>
                            <td style="padding-top:5px;width:200px;">Employee type</td>
                            <td style="padding-top:5px;color:<?php echo $fontColorName ?>;"><?php print $rowGetOld['is_contract']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Status</td>
                            <td style="padding-top:5px;"><?php print $row['emp_status']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Company</td>
                            <td style="padding-top:5px"><?php print $rowCompany['code']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Branch</td>
                            <td style="padding-top:5px"><?php print $rowBranch['branch_code']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Department</td>
                            <td style="padding-top:5px;"><?php print $rowDept['dep_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Section/Unit</td>
                            <td style="padding-top:5px"><?php print $rowGroup['group_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Position</td>
                            <td style="padding-top:5px;"><input type="hidden" id="droppos" value="<?php echo $rowPos['position_name'] ?>"><?php print $rowPos['position_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Shift</td>
                            <td style="padding-top:5px"><?php print $rowShift['name']; ?></td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">User Permission</td>
                            <td style="padding-top:5px;"><?php
                        $sql_up = 'SELECT name FROM user_permission WHERE id = ' . $row['level_id'];
                        $query_up = mysql_query($sql_up);
                        $row_up = mysql_fetch_array($query_up);
                        echo $row_up['name'];
                        ?></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>