<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

if(isset($_GET["eid"])){
 $sql2 = 'SELECT e.full_name, a.emp_id FROM employee e, approval_m a  WHERE e.id=a.emp_id AND  a.app_id="'.$_GET["eid"].'"';
                $sql_result2 = mysql_query($sql2);
                $newArray2 = mysql_fetch_array($sql_result2);
		$head_app_name=$newArray2['full_name'];
        $head_app_id=$newArray2['emp_id'];
}


$eid = isset($_GET["eid"]) ? $_GET["eid"] : "";
$depid=$_GET['dep'];
if ($eid != "") {
    $style = "block";
    $asql = "SELECT * FROM approval where id='" . $eid . "' limit 1";
    $ars = mysql_query($asql);
    $arow = mysql_fetch_array($ars);
    $queryGetComp = mysql_query('SELECT d.branch_id, b.company_id 
                               FROM department AS d 
                               INNER JOIN branch AS b 
                               ON b.id = d.branch_id
                               WHERE d.id = ' .$depid);
    $rowGetComp = mysql_fetch_array($queryGetComp);
} else {
    $style = "none"; 
}
?>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
	
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        }); 
		
    });
</script>
 

<div class="main_div">
     	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Approval WorkFlow</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Approval WorkFlow </span>
    </div>
    <div class="main_content" id ="addnewbox">
        <div class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?>
			<?php if ($eid == "") { ?>
                                <input type="button" class="button" value="Add" onclick="add()" style="width: 70px; margin-left:6px" />
                            <?php } else { ?>
                                <input type="button" class="button" value="Save" onclick="update(<?php echo $eid ?>)" style="width: 70px;margin-left:6px" />
                            <?php } ?>
                            <input type="button" class="button" value="Clear" onclick="window.location='?loc=approval_mgnt'" style="width: 70px; margin-left:6px" />
                <table>
                     
                    <tr>
                        <td>Company</td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if (isset($_GET["eid"]) == true && $rowGetComp["company_id"] == $rowCompany["id"]) {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px;">Branch</td>
                        <td>
                            <select id="branch" onchange="showDep()" style="width: 250px;">
                                <option value=''>--Please Select--</option>
                                <?php
                                if ($eid != "") {
                                    $sql = "SELECT * FROM branch WHERE company_id = " . $rowGetComp["company_id"] . " ORDER BY branch_code";
                                    $rs = mysql_query($sql);
                                    $selected = "";
                                    while ($row = mysql_fetch_array($rs)) {
                                        if ($rowGetComp["branch_id"] == $row["id"]) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        ?>
                                        <option <?php echo $selected ?> value="<?php echo $row["id"] ?>"><?php echo $row["branch_code"] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px;">Department</td>
                        <td>
                            <select id="dep" onchange="showGroup()" style="width: 250px;">
                                <option value=''>--Please Select--</option>
                                <?php
                                if ($eid != "") {
                                    $sql = "SELECT * FROM department WHERE branch_id=" . $rowGetComp["branch_id"] . ' ORDER BY dep_name';
                                    $rs = mysql_query($sql);
                                    $selected = "";
                                    while ($row = mysql_fetch_array($rs)) {
                                        if ($arow["dep_id"] == $row["id"]) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        ?>
                                        <option <?php echo $selected ?> value="<?php echo $row["id"] ?>"><?php echo $row["dep_name"] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Group</td>
                        <td>
                            <select id="group" onchange="show_pos()" style="width: 250px;">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    $deptId = $arow["dep_id"];
                                    $gsql = 'SELECT * FROM emp_group WHERE dep_id=' . $deptId . ' ORDER BY group_name';
                                    $grs = mysql_query($gsql);
                                    while ($grow = mysql_fetch_array($grs)) {
                                        if ($grow["id"] == $arow["group_id"]) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option " . $selected . " value='" . $grow["id"] . "'>" . $grow["group_name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
					    <!-- <tr> 
                        <td style="vertical-align:top">Notify <span class="red"> *</span></td>
                        <td>
						<a  class="inline" style="text-decoration:none" href="#inline_content"> 
                            <select multiple size="10" class="input_text" name="employee_list_view" id="employee_list_view" style="width: 250px;">
							  <?php
                                if ($eid != "") {
                                    $sql = "SELECT e.full_name, n.id, n.emp_id from employee e, notify n  WHERE n.dep_id='" . $_GET['dep'] . "'AND n.emp_id=e.id";
                                    $rs = mysql_query($sql);
                                    $selected = "";
                                    while ($row = mysql_fetch_array($rs)) {
                                       
                                        ?>
                                        <option  value="<?php echo $row["emp_id"] ?>"><?php echo $row["full_name"] ?></option>
                                        <?php
                                    }
                                }
                                ?>
							
							</select> </a>
                        </td>
                    </tr>-->
						

                </table> 
				<table style="position:absolute; top:286px; left:721px">
				<tr>
                        <td>Level 1</td>
                        <td style="display:none">
                            <select id="level1" style="width: 250px;">
                                <?php 
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_pos($arow["group_id"], $arow["level_pos_1"]); //
                                }
                                ?>
                            </select>
                        </td>
                        <td style="display:none">&nbsp;&nbsp;OR&nbsp;&nbsp;</td>
                        <td>
                            <select id="emp1" style="width: 250px;">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_emp($arow["group_id"], $arow["superior_1"]);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Level 2</td>
                        <td style="display:none">
                            <select id="level2" style="width: 250px;">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_pos($arow["group_id"], $arow["level_pos_2"]);
                                }
                                ?>
                            </select>
                        </td>
                        <td style="display:none">&nbsp;&nbsp;OR&nbsp;&nbsp;</td>
                        <td>
                            <select id="emp2" style="width: 250px;">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_emp($arow["group_id"], $arow["superior_2"]);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Level 3</td>
                        <td style="display:none">
                            <select id="level3" style="width: 250px;">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_pos($arow["group_id"], $arow["level_pos_3"]);
                                }
                                ?>
                            </select>
                        </td>
                        <td style="display:none">&nbsp;&nbsp;OR&nbsp;&nbsp;</td>
                        <td>
                            <select id="emp3" style="width: 250px;">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_emp($arow["group_id"], $arow["superior_3"]);
                               }
                                ?>
                            </select>
                        </td>
                    </tr>
					 <tr>
                                <td style="width:200px;">HOD Approver </td>
                                <td><input type="text" class="input_text" readonly id="e_head_name" value="<?php echo $head_app_name ?>" style="width: 250px;"/>
                                    <input type="hidden" style="padding-top:10px;" id="e_head_id" value="<?php echo $head_app_id ?>"/>
									<input type="hidden" style="padding-top:10px;" id="e_head_id2" value="<?php echo $head_app_id ?>"/>
									</td>
                                <td style="padding-left:10px;"><a  class="inline" style="text-decoration:none" href="#inline_content1">Search</a></td>
                            </tr> 
				 
				
				</table>
            <?php } elseif ($igen_a_m == "a_m_view") { ?>
                <table>
                    <tr>
                        <td>Company</td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" disabled="disabled">
                                <option value="">--Please Select--</option>
                                <?php
                                $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if (isset($_GET["eid"]) == true && $rowGetComp["company_id"] == $rowCompany["id"]) {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px;">Branch</td>
                        <td>
                            <select id="branch" style="width: 250px;" disabled="disabled">
                                <option value=''>--Please Select--</option>
                                <?php
                                if ($eid != "") {
                                    $sql = "SELECT * FROM branch WHERE company_id = " . $rowGetComp["company_id"] . " ORDER BY branch_code";
                                    $rs = mysql_query($sql);
                                    $selected = "";
                                    while ($row = mysql_fetch_array($rs)) {
                                        if ($rowGetComp["branch_id"] == $row["id"]) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        ?>
                                        <option <?php echo $selected ?> value="<?php echo $row["id"] ?>"><?php echo $row["branch_code"] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px;">Department</td>
                        <td>
                            <select id="dep" onchange="showGroup()" style="width: 250px;" disabled="disabled">
                                <option value=''>--Please Select--</option>
                                <?php
                                $sql = "SELECT * FROM department";
                                $rs = mysql_query($sql);
                                $selected = "";
                                while ($row = mysql_fetch_array($rs)) {
                                    if ($arow["dep_id"] == $row["id"]) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    ?>
                                    <option <?php echo $selected ?> value="<?php echo $row["id"] ?>"><?php echo $row["dep_name"] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Group</td>
                        <td>
                            <select id="group" onchange="show_pos()" style="width: 250px;" disabled="disabled">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    $deptId = $arow["dep_id"];
                                    $gsql = 'SELECT * FROM emp_group WHERE dep_id=' . $deptId;
                                    $grs = mysql_query($gsql);
                                    while ($grow = mysql_fetch_array($grs)) {
                                        if ($grow["id"] == $arow["group_id"]) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option " . $selected . " value='" . $grow["id"] . "'>" . $grow["group_name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Level 1</td>
                        <td>
                            <select id="level1" style="width: 250px;" disabled="disabled">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_pos($arow["group_id"], $arow["level_pos_1"]); //
                                }
                                ?>
                            </select>
                        </td>
                        <td>&nbsp;&nbsp;OR&nbsp;&nbsp;</td>
                        <td>
                            <select id="emp1" style="width: 250px;" disabled="disabled">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_emp($arow["group_id"], $arow["superior_1"]);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Level 2</td>
                        <td>
                            <select id="level2" style="width: 250px;" disabled="disabled">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_pos($arow["group_id"], $arow["level_pos_2"]);
                                }
                                ?>
                            </select>
                        </td>
                        <td>&nbsp;&nbsp;OR&nbsp;&nbsp;</td>
                        <td>
                            <select id="emp2" style="width: 250px;" disabled="disabled">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_emp($arow["group_id"], $arow["superior_2"]);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Level 3</td>
                        <td>
                            <select id="level3" style="width: 250px;" disabled="disabled">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_pos($arow["group_id"], $arow["level_pos_3"]);
                                }
                                ?>
                            </select>
                        </td>
                        <td>&nbsp;&nbsp;OR&nbsp;&nbsp;</td>
                        <td>
                            <select id="emp3" style="width: 250px;" disabled="disabled">
                                <?php
                                echo "<option value=''>--Please Select--</option>";
                                if ($eid != "") {
                                    echo g_emp($arow["group_id"], $arow["superior_3"]);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            <?php } ?>
        </div>  
    </div>
	<!-- This contains the hidden content for Adding education background -->
	<div style='display:none;'>
		<div id='inline_content1' style='padding:10px; height:300px;  background-color:#E5E5E5;'>
			<span style="padding:10px">Searh by Employee Name: <input type="text" style="margin-left:50px" id="search1" placeholder="Search By Employee Name"></input></span>
			<div  style="width: 95%; margin-top:0px">
					<div style="padding: 20px 15px;">
					  
					
						<table  style="width:98%;" id="tab1" cellpadding="2px" border="1px solid #000" class="TFtable"> 
							<thead><tr style="background:#000; color:#fff; height:30px">
								<th >Name</th>
								<th >Action</th>
							</tr></thead><tbody> 
							<?php
							
							//$sql2 = 'SELECT e.full_name, e.id as eid, d.dep_name, d.head_emp_id FROM employee e, department d WHERE e.id=d.head_emp_id';
							$sql2 = 'SELECT e.full_name, p.id as p_id,e.id as eid, p.position_name, e.level_id,e.position_id, u.a_ea, u.id FROM position p, employee e, user_permission u WHERE (e.level_id=u.id AND p.id=e.position_id )AND u.a_ea="a_ea_edit"  ORDER BY position_name';
							$sql_result2 = mysql_query($sql2);
							while ($newArray2 = mysql_fetch_array($sql_result2)) {
								echo "<tr>";
								echo "<td style='text-align:left; padding:10px'>" . $newArray2['full_name'] . "</td><td style='text-align:left; padding:10px'>";
								echo "<a style='font-size: 10pt;color:blue;cursor:pointer;'  onclick='e_select(\"" . $newArray2['eid'] . "\",\"" . $newArray2['full_name'] . "\")'>Select</a></td></tr>";
							}
							?>
						</tbody></table>
						<script type="text/javascript">
							function e_select(id,full_name){
					  
								document.getElementById("e_head_name").value=full_name;
								document.getElementById("e_head_id").value=id;
								 $('#e_popup_box').fadeOut("slow");
								  parent.jQuery.colorbox.close(); 
								//e_unloadPopupBox();
							   
							}
						</script>
					</div>
				</div>
		</div>
	</div>
	 
    <br/><br/>
	
    <div class="header_text">
        <span>Approval WorkFlow List </span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead> 
                    <tr class="pluginth"> 
                        <th style="width: 30px;">No.</th>
                        <th>Company</th>
                        <th>Branch</th>
                        <th>Department</th>
                        <th style="width:300px">Group Name</th>
                        <th class="aligncentertable" style="width:150px">Action</th>  
                    </tr>
                </thead>
                <?php
                $sql3 = 'SELECT a.id as aid,dep_name, d.id as did ,group_name, c.name AS company, b.branch_code AS branch FROM approval a 
                        left join department d on a.dep_id=d.id left join emp_group g on a.group_id=g.id
                        JOIN branch AS b
                        ON b.id=d.branch_id
                        JOIN company AS c
                        ON c.id=b.company_id';
                $rs3 = mysql_query($sql3);

                while ($row3 = mysql_fetch_array($rs3)) {
                    $i = $i + 1;
                    $gname = $row3['group_name'];
                    $dep_name = $row3['dep_name'];
                    $branch = $row3['branch'];
                    $company = $row3['company'];
					$dep_id = $row3['did'];
                    $id = $row3['aid'];

                    echo '<tr class="plugintr">
                        <td>' . $i . '</td>
                        <td>' . $company . '</td>
                        <td>' . $branch . '</td>
                        <td>' . $dep_name . '</td>
			<td>' . $gname . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a href="javascript:void()" title="Edit" onclick="edit(' . $id . ', ' .$dep_id. ')"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title="Delete" href="javascript:void()" onclick="delete_group(' . $id . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a href="javascript:void()" onclick="view(' . $id . ')">View</a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table> 
			
        </div>
    </div>
</p></div></div></div>
<!-- This contains the hidden content for Adding education background -->
		<div style='display:none;'>
			<div id='inline_content' style='padding:10px; height:550px;  background-color:#E5E5E5;'>
			

<div style="padding: 5px 0px 5px 5px;">
    <input type="button"  class="button" value="Select All" onclick="select_all()" style="width: 100px;margin-left:10px"/>
    <input type="button" class="button" value="Deselect All" onclick="deselect_all()" style="width: 100px; margin-left:10px"/>
    <input type="button" class="button" value="Done" onclick="done()" style="width: 100px; margin-left:10px"/>
	
	
</div>
<span style="padding:10px">Searh by Employee Name: <input type="text" style="margin-left:50px" id="search" placeholder="Search By Employee Name"></input></span>
<div  style="width: 95%; background-color:#D0D7F3; margin-top:20px">

    <table  border="1px solid #000" id="tab" cellpadding="2px" class="TFtable">
        <thead><tr style="background:#000; color:#fff">
            <th style="width:50px; padding:10px">ID</th>
            <th style="padding:10px">Employee Name</th>
            <th style="width: 70px;padding:10px">Select</th>
        </tr></thead>
		
		
        <?php
        $confirmed = explode(",", $_GET['c']);
        $confirmedemp = "";
		$dep_id=$_GET['d'];
        for ($i = 0; $i <= count($confirmed); $i++) {
            if ($confirmed[$i] != "") {
                $data = " AND id <> " . $confirmed[$i];
                $confirmedemp = $confirmedemp . $data;
            }
        }
		

        $sql = "select * from employee where emp_status = 'Active'";
        
        if ($_GET['list'] != "")
            $idss = explode(",", $_GET['list']);

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
            foreach ($idss as $id) {
                if ($id == $rs['id'])
                    $checked = "checked";
            }
           echo "<tr class='tabletr'><td style='padding:10px'>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT). "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
            $checked = "";
        }
    echo'   
    </table>
</div>';
?>
</div>
</div>
</div>
<style>
  #e_popup_box { 
        display:none; /* Hide the DIV */
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:500px;  
        width:600px;  
        background:#FFFFFF;  
        left: 300px;
        top: 100px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */	
        /* additional features, can be omitted */
        border:10px solid #C4C4C7;  	
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;

    }

  #e_popup_box { 
        display:none; /* Hide the DIV */
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:auto;  
        width:600px;  
        background:#FFFFFF;  
        left: 300px;
        top: 100px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */	
        /* additional features, can be omitted */
        border:10px solid #C4C4C7;  	
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;

    }
	table#tab1 tr th {
		padding-left: 4px;
		color: #fff;
	}
	div#cboxContent {
		height: auto !important;
		background: #E5E5E5 !important;
	}
</style>
<link rel="stylesheet" type="text/css" href="css/jAlert-v2.css">

      <link rel="stylesheet" href="css/colorbox.css" />
	
		<script src="js/jquery.colorbox.js"></script>
	
	<script src='https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'></script>
	<script src='js/jAlert-v2.js'></script>
<script type="text/javascript">
    function view(id){
        window.location="?loc=approval_mgnt&eid=" + id;
    }
    function addnewbox(){
        $("#addnewbox").slideToggle(); 
    }
    function showGroup(){
        var dept_id = $("#dep").val();
        $.ajax({
            type:'POST',
            url:'?widget=getgroup',
            data:{
                dept_id:dept_id
            },
            success:function(data){
                $("#group").empty().append(data);
            }
        })
    }
    
    function showBranch(company_id){
        $.ajax({
            type:"POST",
            url:"?widget=showcompany",
            data:{
                company_id:company_id
            },
            success:function(data){
                $("#branch").empty().append(data);
            }
        });
    }
    
    function showDep(){
        var branch_id = $("#branch").val();
		
        $.ajax({
            type:'POST',
            url:'?widget=getdep',
            data:{
                branch_id:branch_id
            },
            success:function(data){
                //alert(data);
                if(data!=false){
                    $("#dep").empty().append(data);
                }
            }
        })
    }
	 function add_emp_list(){


    
       
           $.ajax({ 
            type:"POST",
            url:"?widget=notify_popup",
            data:{
                id:"action"
                
            },
            success:function(data){ 
			
			succ(data);
              
				
            }
        });  
        
    }
	
	function succ(id){
		
		$.fn.jAlert({
			'title':'List Of Staff',
			
			'message': id,
			'theme': 'info',
			'btn': [
		{
		'label':'Close', 'cssClass': '#0B61A4', 'closeOnClick': true, 'onClick': function(){
			
		} 
		}
	]
	
		});
		
	}; 
	
	
    function show_pos(){ 
        var group_id = $("#group").val();
		 var dept_id = $("#dep").val();
		
        $.ajax({
            type:'POST',
            url:'?widget=getpos',
            data:{
                group_id:group_id
            },
            success:function(data){
                if(data!=false){
                    $("#level1").empty().append(data);
                    $("#level2").empty().append(data);
                    $("#level3").empty().append(data);
                }
            }
        })
        $.ajax({
            type:'POST',
            url:'?widget=getemp',
            data:{
                group_id:group_id,
				dept_id:dept_id 
            },
            success:function(data){
                if(data!=false){
                    $("#emp1").empty().append(data);
                    $("#emp2").empty().append(data);
                    $("#emp3").empty().append(data);
                }
            }
        })
    }
    function add(){
	
	   var all_id="";
        var branch = $("#branch").val();
        var dep=$("#dep").val();
        var group=$("#group").val();
        var level1=$("#level1").val();
        var level2=$("#level2").val();
        var level3=$("#level3").val();
        var emp1=$("#emp1").val();
        var emp2=$("#emp2").val();
        var emp3=$("#emp3").val(); 
		var e_head_id =$("#e_head_id").val();
		   $("#employee_list_view option").each(function()
        {
            all_id += jQuery(this).val()+",";
        });
      
        var error3 = [];
        
        if(branch == ''){
            error3.push("Branch");
        }
        if(dep == ''){
            error3.push("Department");
        }
        if(group == ''){
            error3.push("Group");
        }
        if(level1 == "" && emp1 == ""){
            error3.push("Approval Level 1");
        }
		 if(level1 == "" && emp1 == ""){
            error3.push("Approval Level 1");
        }
        if(e_head_id == ""){
            error3.push("Approver for Head Department");
        }
        if(level3 == "" && emp3 == ""){
            error3.push("Approval Level 3");
        }

        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data3 = "";
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error3.length > 0){
            alert(data3);
        }else{
            $.ajax({ 
                url:"?widget=add_approval",
                data:{
                    dep:dep,
                    group:group,
                    level1:level1,
                    level2:level2,
                    level3:level3,
					e_head_id:e_head_id,
                    emp1:emp1,
                    emp2:emp2,
					s:all_id,
                    emp3:emp3
                },
                success:function(data){
                    if(data==true){
                        alert('Approval Added');
                        window.location = '?loc=approval_mgnt';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
    function delete_group(id){
        var r=confirm("Are you sure you want to delete this record?");
        if(r){
            $.ajax({
                type:"POST",
                url:"?widget=delete_group",
                data:{
                    gid:id
                },
                success:function(data){
                    if(data==true){
                        alert('Approval Deleted');
                        window.location = '?loc=approval_mgnt';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
    function edit(id, dep){
        window.location="?loc=approval_mgnt&eid="+id +"&dep="+dep;
    }
	  function done(){
    
        var ids = new Array();
        var names = new Array();
        $("input:checkbox:checked").each(function(i,dom){
            ids[i] = $(dom).val();
            names[i] = "<option>" + $(dom).attr("name") + "</option>";
        });
        var newStr = ids.toString();
       
        $.ajax({
            type:"POST",
            url:"?widget=append_emp",
            data:{
                newStr:newStr
            },
            success:function(data){
		
                if(data != false){ 
				
                    $("#employee_ids").html(newStr);
                    $("#employee_list_view").empty().append(data);
                    parent.jQuery.colorbox.close(); 
					 
                }else{
                   
                }
            }
        });
    }
	function close(){ 
	 parent.jQuery.colorbox.close();
	}
	
	   function select_all(){
	
        $("input").attr("checked",true);
    }
    function deselect_all(){
        $("input").attr("checked",false);
    }
    function update(id){
	   var all_id="";
        var branch = $("#branch").val();
        var dep=$("#dep").val();
        var group=$("#group").val();
        var level1=$("#level1").val();
        var level2=$("#level2").val();
        var level3=$("#level3").val();
        var emp1=$("#emp1").val();
        var emp2=$("#emp2").val();
        var emp3=$("#emp3").val();
		var e_head_id=$("#e_head_id").val();
		var e_head_id2=$("#e_head_id2").val();
           $("#employee_list_view option").each(function()
        {
            all_id += jQuery(this).val()+",";
        });
		
        var error3 = [];
        
        if(branch == ''){
            error3.push("Branch");
        }
        if(dep == ''){
            error3.push("Department");
        }
        if(group == ''){
            error3.push("Group");
        }
        if(level1 == "" && emp1 == ""){
            error3.push("Approval Level 1");
        }
		if(e_head_id == ""){
            error3.push("Approver for head of department");
        }
        if(level2 == "" && emp2 == ""){
            error3.push("Approval Level 2");
        }
        if(level3 == "" && emp3 == ""){
            error3.push("Approval Level 3");
        }

        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data3 = "";
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error3.length > 0){
            alert(data3);
        }else{
		
            $.ajax({
                url:"?widget=update_approval",
                data:{
                    id:id,
                    dep:dep,
                    group:group,
                    level1:level1,
                    level2:level2,
                    level3:level3,
					e_head_id:e_head_id,
					e_head_id:e_head_id,
                    emp1:emp1,
                    emp2:emp2,
					s:all_id,
                    emp3:emp3
                },
                success:function(data){
				
                    if(data == true){
                        alert('Approval Updated');
                        window.location = '?loc=approval_mgnt';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
		$("#search").on("keyup", function() {
    var value = $(this).val().toUpperCase();
    
    $("#tab tr").each(function(index) {
        if (index !== 0) {
 
            $row = $(this);

            var id = $row.find("td:nth-child(2)").text();

            if (id.indexOf(value) !== 0) {
                $row.hide();
            }
            else {
                $row.show();
            }
        }
    });
});
$("#search1").on("keyup", function() {
    var value = $(this).val().toUpperCase();
    
    $("#tab1 tr").each(function(index) {
        if (index !== 0) {

            $row = $(this);

            var id = $row.find("td:nth-child(1)").text();

            if (id.indexOf(value) !== 0) {
                $row.hide();
            }
            else {
                $row.show();
            }
        }
    });
});
	   function searchHead_func(){
	

        
        // When site loaded, load the Popupbox First
        e_loadPopupBox();
	
        $('#e_popupBoxClose').click( function() {			
            e_unloadPopupBox();
        });
		
		
 
    function unloadPopupBox() {	// TO Unload the Popupbox
        $('#popup_box').fadeOut("slow");
        $("#container").css({ // this is just for style		
            "opacity": "1"  
        }); 
    }	
        
    function e_unloadPopupBox() {	// TO Unload the Popupbox
        $('#e_popup_box').fadeOut("slow");
        $("#container").css({ // this is just for style		
            "opacity": "1"  
        }); 
    }
        
		
        function e_loadPopupBox() {	// To Load the Popupbox
            $('#e_popup_box').fadeIn("slow");
            $("#container").css({ // this is just for style
                "opacity": "0.6"
            });
        }
        /**********************************************************/
		
    };
	 $(document).ready(function() {
        oTable = $('#tableth').dataTable({
            "bJQueryUI": true, 
            "sPaginationType": "full_numbers"
        });
		
		
			 $(".inline").click(function(){
		
		 
		 })
		
		 	//$(".inline").colorbox({inline:true, width:"50%"
		
			//});
				//alert(1)
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				}); 

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
    } );
</script>
<?php

function g_pos($group_id, $pos_id) {
    $sql = 'SELECT * FROM `position` p where id in (SELECT distinct(position_id) as id FROM employee e where group_id=' . $group_id . ')';
    $rs = mysql_query($sql);
    $g = "";
    while ($row = mysql_fetch_array($rs)) {
        if ($pos_id == $row["id"]) {
            $selected = "selected";
        } else {
            $selected = "";
        }
        $g.="<option " . $selected . " value='" . $row["id"] . "'>" . $row["position_name"] . "</option>";
    }
    return $g;
}

function g_emp($group_id, $emp_id) {
    $e = "";
	$name="";
    $sql = 'SELECT * FROM employee e where id=' . $emp_id;
    $rs = mysql_query($sql);
    while ($row = mysql_fetch_array($rs)) {
        if ($emp_id == $row["id"]) {
            $selected = "selected";
        } else {
            $selected = "";
        }
		$name=$row["full_name"];
		$eb_id=$row["id"];
       
    }
	$sql1 = 'SELECT p.id as p_id, p.position_name, e.level_id,e.position_id, e.id as e_id, e.full_name as fullname, u.a_ea, u.id FROM position p, employee e, user_permission u WHERE (e.level_id=u.id AND p.id=e.position_id )AND u.a_ea="a_ea_edit"';
$rs1 = mysql_query($sql1);
while ($row1 = mysql_fetch_array($rs1)) {
if($name!=$row1["fullname"]){
 
$e.="<option " . $selected . " value='" . $row1["e_id"] . "'>" . $row1["fullname"] . "</option>";
}
    
}
$e.="<option " . $selected . " value='" .$eb_id . "'>" . $name . "</option>";
    return $e;
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