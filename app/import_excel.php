<?php

?>

<div class="main_div">
    <br/>
    <div class="header_text">
        <span>Import Employee Data</span>
        <span style="float: right;">
            <table>
                <tr>
                    <td><input type="button" value="Back" id="editBut" onclick="back()" style="width: 70px;" /></td>
                </tr>
            </table>
        </span>
    </div>
    <div style="margin-top: 10px;" class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                    <td style="font-weight: bold;">
                        Import member's data via upload excel file 
                        <?php
                        if (isset($_GET["m"]) && ($_GET["m"] == "done")) {
                            print "<span style='color:#D10202'>Upload successful.</span>";
                        } else if (isset($_GET["m"]) && ($_GET["m"] == "ept")) {
                            print "<span style='color:#D10202'>Empty field is not allowed.</span>";
                        } else if (isset($_GET["m"]) && ($_GET["m"] == "error")) {
                            ?>
                            <span style='color:#D10202'>Upload failure.</span>
                            <?php
                            if (isset($_GET['e'])) {
                                $e_l = explode(",", $_GET['e']);
                                //print_r($e_l);
                                print (count($e_l) > 0) ? "<div style='color:#D10202'><span style='color:#D10202'>Existed username is listed as below:</span>" : "";
                                foreach ($e_l as $e) {
                                    if ($e != "")
                                        print "<li>" . $e . "</li>";
                                }
                                print (count($e_l) > 0) ? "</div>" : "";
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 10px;">
                        <form action="?widget=importexcel" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td style="width: 100px;">Excel file</td>
                                    <td>
                                        <input type="file" name="excel_file" />
                                    </td>
                                    <td><input id="editBut" type="submit" value="Import" style="width: 70px; position: relative; top: -1px;" />&nbsp;</td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
    <br/>
    <div class="header_text">
        <span>Download Excel File Template</span>
    </div>
    <div style="margin-top:10px" class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                    <td>
                        <form action="?widget=importexcel" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td style="width: 100px;">Excel file</td>
                                    <td>
                                        <a href="file/Import Template.xls">
                                            <img src='images/excel_icon.png' style="border:0" />
                                        </a>
                                    </td>
                                    <td style="padding-left: 5px;">
                                        <a href="file/Import Template.xls">Download Here&nbsp;</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
    <br/>
    <div class="header_text">
        <span>Guideline of Fill In Excel File</span>
    </div>
    <div style="margin-top:10px" class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                    <td style="font-weight: bold;">
                        There are 22 mandatory fields that are need to fill-in in the excel file:
                    </td>
                </tr>
                <tr>
                    <td>	
                        <table style='margin-left:10px' class="verticaltop">
                            <tr>
                                <td>1.</td>
                                <td style="width: 130px;">Full Name</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Full Name of Employee</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>IC</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Identity Card No.</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Mobile</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Mobile Phone No.</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Email Address</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Email Address</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>Gender</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>M -> Male, F -> Female</td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>Race</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Malay, Chinese, Indian, Others</td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td>Religion</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Buddhist, Catholic, Christian, Hindu, Muslim, Others</td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>Marital Status</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>M -> Married, S -> Single</td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td>Spouse Work</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Y -> Yes, N -> No</td>
                            </tr>
                            <tr>
                                <td>10.</td>
                                <td>Date of birth</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>YYYY-MM-DD, eg : 1970-06-01</td>
                            </tr>
                            <tr>
                                <td>11.</td>
                                <td>Join Date</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>(YYYY-MM-DD)</td>
                            </tr>
                            <tr>
                                <td>12.</td>
                                <td>Username</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Username</td>
                            </tr>
                            <tr>
                                <td>13.</td>
                                <td>Employee Status</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Active or Inactive</td>
                            </tr>
							<tr>
                                <td>14.</td>
                                <td>Company ID</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td> 
                                    <?php
                                    $str1 = '';
                                    $sqlcomp = mysql_query('SELECT * FROM company');
                                    while ($rowcomp = mysql_fetch_array($sqlcomp)) {
                                        $str1.=$rowcomp["id"] . "->" . $rowcomp["name"] . ", ";
                                    }
                                    echo substr($str1, 0, -2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>15.</td>
                                <td>Branch ID</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td> 
                                    <?php
                                    $str = '';
                                    $sqlBranch = mysql_query('SELECT * FROM branch;');
                                    while ($rowBranch = mysql_fetch_array($sqlBranch)) {
                                        $str.=$rowBranch["id"] . "->" . $rowBranch["branch_code"] . ", ";
                                    }
                                    echo substr($str, 0, -2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>16.</td>
                                <td>Department ID</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>
                                    <?php
                                    $sql = "SELECT * FROM department WHERE is_active='1' GROUP BY dep_name";
                                    $rs = mysql_query($sql);
                                    $str = "";
                                    while ($row = mysql_fetch_array($rs)) {
                                        $str.=$row["id"] . "->" . $row["dep_name"] . ", ";
                                    }
                                    echo substr($str, 0, -2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>17.</td>
                                <td>Section/Unit ID</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>
                                    <?php
                                    $sql = "SELECT * FROM emp_group WHERE is_active='1' GROUP BY group_name";
                                    $rs = mysql_query($sql);
                                    $str = "";
                                    while ($row = mysql_fetch_array($rs)) {
                                        $str.=$row["id"] . "->" . $row["group_name"] . ", ";
                                    }
                                    echo substr($str, 0, -2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>18.</td>
                                <td>Position ID</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>
                                    <?php
                                    $sql = "SELECT * FROM `position`";
                                    $rs = mysql_query($sql);
                                    $str = "";
                                    while ($row = mysql_fetch_array($rs)) {
                                        $str.=$row["id"] . "->" . $row["position_name"] . ", ";
                                    }
                                    echo substr($str, 0, -2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>19.</td>
                                <td>Shift ID</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>
                                    <?php
                                    $str = '';
                                    $sql = 'SELECT * FROM shift';
                                    $sqlLeave = mysql_query($sql);
                                    while ($rowLeave = mysql_fetch_array($sqlLeave)) {
                                        $str.=$rowLeave["id"] . "->" . $rowLeave["name"] . ", ";
                                    }
                                    echo substr($str, 0, -2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>20.</td>
                                <td>User Permission ID</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>
                                    <?php
                                    $sql = "SELECT * FROM user_permission";
                                    $rs = mysql_query($sql);
                                    $str = "";
                                    while ($row = mysql_fetch_array($rs)) {
                                        $str.=$row["id"] . "->" . $row["name"] . ", ";
                                    }
                                    echo substr($str, 0, -2);
                                    ?>
                                </td>
                            </tr>
							 <tr>
                                <td>20.</td>
                                <td>Leave Group</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>
                                    <?php
                                    $sql = "SELECT * FROM group_for_leave";
                                    $rs = mysql_query($sql);
                                    $str = "";
                                    while ($row = mysql_fetch_array($rs)) {
                                        $str.=$row["id"] . "->" . $row["group_name"] . ", ";
                                    }
                                    echo substr($str, 0, -2);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>20.</td>
                                <td>Under Contract</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>permanent -> Permanent, contract worker -> Contract Worker,intern -> Intern</td>
                            </tr>
                            <tr>
                                <td>21.</td>
                                <td>Salary Type</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>bs -> Basic Salary, hr -> hourly, dy -> daily, wk -> weekly, mn -> Monthly</td>
                            </tr>
                            <tr>
                                <td>22.</td>
                                <td>Salary Amount</td>
                                <td style="padding-left: 20px; padding-right: 5px;">:</td>
                                <td>Salary Amount</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    function back(){
        window.location='?loc=home';
    }
</script>
<style>
    .verticaltop td{
        vertical-align: top;
    }
</style>

<?php

?>