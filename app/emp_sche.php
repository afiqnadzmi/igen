<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    /* popup_box DIV-Styles*/
    #popup_box { 
        display:none; /* Hide the DIV */
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:300px;  
        width:600px;  
        background:#FFFFFF;  
        left: 300px;
        top: 150px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        /*        margin-left: 15px;  	*/
        /* additional features, can be omitted */
        border:2px solid #ff0000;  	
        padding:15px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #ff0000;
        -webkit-box-shadow: 0 0 5px #ff0000;
        box-shadow: 0 0 5px #ff0000;

    }

    #container {

        width:100%;
        height:100%;
    }

    /* This is for the positioning of the Close Link */
    #popupBoxClose {
        font-size:20px;  
        line-height:15px;  
        right:5px;  
        top:5px;  
        position:absolute;  
        color:#6fa5e2;  
        font-weight:500;  	
    }
    .selection_box{
        background-color: lavender; 
        border-radius:6px;
        -moz-border-radius: 6px;
    }
</style>
<style>

.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

</style>
<?php
if (isset($_GET["b"]) == true && $_GET["b"] != "") {
    $branch = $_GET["b"];
} else {
    $branch = "0";
}
?>

<div class="main_div" style="margin-left:0px">
<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Transfer</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p> 
<div class="modal"><!-- Place at bottom of page --></div>	
    <div class="header_text">
        <span>Employee Transfer</span>
        <span style="float: right;">
            <table>
                <tr>
                    <td><input type="button" id="editBut"  value="Search" onclick="search();" style="width:100px"/></td>
                    <td><input type="button" id="editBut"  value="Transfer" onclick="getid('emp', <?php echo $branch; ?>);" style="width:100px" /></td>
                </tr>
            </table>
        </span>
    </div>
    <div id="search_box" style="margin-top: 10px; display:none;">
        <div class="main_content">
            <table>
                <tr>
                    <td style="padding:20px;">By Name :</td>
                    <td><input id="search_name" type="text"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><a href="javascript:search_func()">Search</a></td>
                </tr>
            </table>
            <div id="divappend"></div>
        </div>
    </div>
    <div  class="main_content">
        <div id="container" class="tablediv" style="width:70%">
            <table style="padding-bottom: 20px;">
                <tr>
                    <td style="width: 200px;">Company</td>
                    <td>
                        <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                            <option value="">--Please Select--</option>
                            <?php
                            if ($igen_companylist != "") {
                                $queryCompany = mysql_query('SELECT * FROM company WHERE id IN (' . $igen_companylist . ')');
                            } else {
                                $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                            }
                            while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                if ($igen_companylist != "") {
                                    if (isset($_GET["c"]) == true && $_GET["c"] == $rowCompany["id"]) {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    }
                                } else {
                                    if ($rowCompany["is_default"] == "1") {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } elseif (isset($_GET["c"]) == true && $_GET["c"] == $rowCompany["id"]) {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Branch</td>
                    <td>
                        <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
                            <option value="">--Please Select--</option>
                            <?php
                            if ($igen_companylist == "") {
                                if (isset($_GET["b"]) == true && $_GET["b"] != "") {
                                    $queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $_GET["c"] . '" ORDER BY branch_code');
                                } else {
                                    $queryCompany = mysql_query('SELECT * FROM company WHERE is_default=1 LIMIT 1');
                                    $rowCompany = mysql_fetch_array($queryCompany);
                                    $queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowCompany["id"] . '" ORDER BY branch_code');
                                }
                            } elseif ($igen_branchlist != "") {
                                if (isset($_GET["c"]) == true && $_GET["c"] != "") {
                                    $queryBranch = mysql_query('SELECT * FROM branch WHERE id IN (' . $igen_branchlist . ') AND company_id = ' . $_GET["c"] . ' ORDER BY branch_code');
                                }
                            }
                            while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                if (isset($_GET["b"]) == true && $_GET["b"] == $rowBranch["id"]) {
                                    echo '<option value="' . $rowBranch["id"] . '" selected="true">' . $rowBranch["branch_code"] . '</option>';
                                } else {
                                    echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>
                        <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                            <option value="">--Please Select--</option>
                            <?php
                            if ($igen_companylist != "") {
                                $queryCompany = mysql_query('SELECT * FROM department WHERE branch_id IN (' . $igen_companylist . ')');
                            } else {
                                $queryCompany = mysql_query('SELECT * FROM department ORDER BY code');
                            }
                            while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                if ($igen_companylist != "") {
                                    if (isset($_GET["c"]) == true && $_GET["c"] == $rowCompany["id"]) {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    }
                                } else {
                                    if ($rowCompany["is_default"] == "1") {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } elseif (isset($_GET["c"]) == true && $_GET["c"] == $rowCompany["id"]) {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <?php
            $sql = 'SELECT * FROM department WHERE branch_id = ' . $_GET["b"] . ' AND is_active=1 ORDER BY dep_name';
            $sql1 = 'SELECT * FROM department WHERE branch_id = ' . $_GET["b"] . ' AND is_active=0 ORDER BY dep_name';
            $rs = mysql_query($sql);
            $rs1 = mysql_query($sql1);
            $numrow1 = mysql_num_rows($rs);
            $numrow2 = mysql_num_rows($rs1);
 
            if (isset($_GET["show"]) == true && $_GET["show"] == "true") {
                echo '<table id="showDepTable" style="width: 95%;">';
                if ($numrow1 > 0) {
                    echo '<tr><td style="border-bottom: 1px solid black; font-weight: bold; font-size: 16px;">Active Department(s)</td></tr>';
                    echo '<tr><td>';
                    while ($row = mysql_fetch_array($rs)) {
                        $dep_name = $row['dep_name'];
                        $dep_id = $row['id'];

                        $sql2 = 'SELECT * FROM emp_group where dep_id = ' . $dep_id . ' ';
                        $rs2 = mysql_query($sql2);

                        echo '<table>
                        <tr class="cursor_pointer" onclick="expand(this,\'g' . $dep_id . '\',' . $dep_id . ')">
                        <td><img id="' . $dep_id . '" src="images/But_DrillIn.png" /></td><td style="padding-left:5px; font-weight: bold;">' . $dep_name . '</td>   
                        </tr>    
                    </table>';

                        echo '<div id="g' . $dep_id . '"class="selection_box" style="border:0; width: 550px;display:none; padding: 10px;margin-left:30px;">
                    <table style="padding-left:20px;">';
                    echo '<tr>
                        <td><input type="hidden" id="dep" value=""/></td> 
                       
                        </tr>';
                        while ($row2 = mysql_fetch_array($rs2)) {
                            $groupname = $row2['group_name'];
                            $groupid = $row2['id'];

                            $sql3 = 'SELECT * FROM employee where group_id = ' . $groupid . ' ';
                            $rs3 = mysql_query($sql3);
                            if (mysql_num_rows($rs3) == 0 || !$rs3) {
                                $disabled = "disabled";
                            } else {
                                $disabled = "";
                            }
                            echo '<tr>
                        <td><input ' . $disabled . ' type="checkbox" id="chkall' . $groupid . '" "' . $checkbox . '"  onclick="checkall(\'emp' . $groupid . '\',\'' . $groupid . '\')"/></td>
                        <td style="padding-left: 5px; font-weight: bold;">' . $groupname . '</td>
                        </tr>';

                            while ($row3 = mysql_fetch_array($rs3)) {
                                $fullname = $row3['full_name'];
                                $empid = $row3['id'];
                                $dep_id = $row3["dep_id"];

                                echo '<tr>
                            <td></td>
                            <td><table><tr><td><input type="checkbox" id="checkid' . $empid . '-' . $dep_id . '"  alt="'.$dep_id.'" value=' . $empid . ' name="emp' . $groupid . '" " />
                            ID : ' . $empid . ' ' . $fullname . '</td></tr></table></td>
                            </tr>';
                            }
                        }
                        echo '</table>
                    </div>';
                    }
                    echo '</td></tr>';
                }

                if ($numrow2 > 0) {
                    echo '<tr><td style="padding-top: 30px; font-weight: bold; font-size: 16px; border-bottom: 1px solid black;">Inactive Department(s)</td></tr>';
                    echo '<tr><td>';
                    while ($row1 = mysql_fetch_array($rs1)) {
                        $dep_name = $row1['dep_name'];
                        $dep_id = $row1['id'];

                        $sql2 = 'SELECT * FROM emp_group where dep_id = ' . $dep_id . ' ';
                        $rs12 = mysql_query($sql2);

                        echo '<table>
                        <tr class="cursor_pointer" onclick="expand(this,\'g' . $dep_id . '\',' . $dep_id . ')">
                        <td><img id="' . $dep_id . '" src="images/But_DrillIn.png" /></td><td style="padding-left:5px; font-weight: bold;">' . $dep_name . '</td>   
                        </tr>    
                    </table>';

                        echo '<div id="g' . $dep_id . '"class="selection_box" style="border:0; width: 550px;display:none; padding: 10px;margin-left:30px;">
                    <table style="padding-left:20px;">';

                        while ($row12 = mysql_fetch_array($rs12)) {
                            $groupname = $row12['group_name'];
                            $groupid = $row12['id'];

                            $sql3 = 'SELECT * FROM employee where group_id = ' . $groupid . ' ';
                            $rs13 = mysql_query($sql3);
                            if (mysql_num_rows($rs13) == 0 || !$rs13) {
                                $disabled = "disabled";
                            } else {
                                $disabled = "";
                            }
                            echo '<tr>
                        <td><input ' . $disabled . ' type="checkbox" id="chkall' . $groupid . '" "' . $checkbox . '"  onclick="checkall(\'emp' . $groupid . '\',\'' . $groupid . '\')"/></td>
                        <td style="padding-left: 5px; font-weight: bold;">' . $groupname . '</td>
                        </tr>';

                            while ($row13 = mysql_fetch_array($rs13)) {
                                $fullname = $row13['full_name'];
                                $empid = $row13['id'];
                                $dep_id = $row13["dep_id"];

                                echo '<tr>
                            <td></td>
                            <td><table><tr><td><input type="checkbox" id="checkid' . $empid . '-' . $dep_id . '" value=' . $empid . ' name="emp' . $groupid . '" " />
                            ID : ' . $empid . ' ' . $fullname . '</td></tr></table></td>
                            </tr>';
                            }
                        }
                        echo '</table>
                    </div>';
                    }
                    echo '</td></tr>';
                }
                echo '</table>';
            }
            ?>

            <table><tr id="month_picker">
                    <td colspan="2" style="width: 200px;">Month Range</td>
                    <td>
                        <select id="month" style="width: 259px;" onchange="time_att()">
                            <option value="">--Please Select--</option>
                            <?php
                            for ($i = 1; $i < 13; $i++) {
                                $selected = "";
                                if ($i == $_GET["month"]) {
                                    $selected = "selected";
                                }
                                echo "<option " . $selected . " value='" . $i . "'>" . date("F", mktime(0, 0, 0, $i, 1, date('Y'))) . "</option>";
                            }
                            ?>
                        </select>
                    </td>
            </tr></table>  
        </div>
    </div>
    <div id="c"></div>
</p></div></div></div>

<span id="branchSpan" style="display: none;"><?php echo $igen_branchlist; ?></span>

   

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>