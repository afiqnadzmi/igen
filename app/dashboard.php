<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
 
?>

<div class="main_div" style="margin-left:10px" >
 <h3 class="dashboard_title">Dashboard <hr></h2>
    <div>
	<?php 
	
		if ($igen_a_hr == "a_hr_edit"){
	?>
	<div class="tabs">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">HR Report</a></li>
    <li><a data-toggle="tab" href="#menu1">Wages Stat</a></li>
    <li><a data-toggle="tab" href="#menu2">Sick Leave Stat</a></li>
    <li><a data-toggle="tab" href="#menu3">Sick Leave List</a></li>
	<li><a data-toggle="tab" href="#menu4">AWOL List</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div id="monthly_report_dep">
		<h4 class="panel-title"><span class="company">Baiduri Dimensi </span> HR Monthly Report & Analysis by Dept <?php echo date('m Y') ?></h4><br>
		<input type="hidden" id="comp_id" value="<?php echo $igen_companylist; ?>">
		
		<div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="widget-simple first">
					<div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
					<i class="fa fa-users"></i>
					</div>
					<h3 class="widget-content text-right animation-pullDown">
					<span class='total_e count'></span><br><span>Total Employee</span>
				
					</h3>
				</div>

			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="widget-simple second">
					<div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
					<i class="fas fa-check-square"></i>
					</div>
					<h3 class="widget-content text-right animation-pullDown">
					<span class='active_e count'></span> <br><span>Active Employee</span>
					</h3>
				</div>

			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="widget-simple third">
					<div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
					<i class="fas fa-times-circle"></i>
					</div>
					<h3 class="widget-content text-right animation-pullDown">
					<span class='inactive_e count'></span> <br><span>Inactive Employee</span>
					</h3>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="widget-simple fourth">
					<div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
					<i class="fas fa-user-times"></i>
					</div>
					<h3 class="widget-content text-right animation-pullDown">
					<span class='resigned_e count'></span> <br><span>Resigned Employee</span>
					</h3>
				</div>
			</div>

		</div>
		  <div class="row" >
		  <h3 class='top_title'>Employee Data of <span class="company">Baiduri Dimensi</span> (By Department)</h3>
			<div class="col-sm-6" id="chart1">

			</div>
			
		  </div>
		  <div class="row chart2">
		     <h3 class='top_title'>Employee Data of <span class="company">Baiduri Dimensi</span> (By Company)</h3>
			<div class="col-sm-6" id="chart2">

			</div>
			
		  </div>
		</div>


		<div class="table">
			<!--<table class="dashboard" border="1">
			  <thead>
			  <tr>

			  </tr>
			  <tbody>
			  <tr>

			  </tr>
			  </tbody>
			</table>-->
		
			<!--<h4 class="panel-title">Salary Employee Report by Dept <?php echo date('m Y') ?></h4><br><br>-->
			<div class="container">
			  <div class="row chart3">
			  <h3 class='top_title'>Employee Cost of <span class="company">Baiduri Dimensi</span> (By Department)</h3>
				<div class="col-sm-6" id="chart3">

				</div>
			  </div>
			  <div class="row chart4">
			  <h3 class='top_title'>Employee Cost of <span class="company">Baiduri Dimensi</span> (By Company)</h3>
				<div class="col-sm-6" id="chart4">

				</div>
				
			  </div>
			</div><br><br>
			<!--<table class="dashboard1" border="1">
			  <thead>
			  <tr>

			  </tr>
			  <tbody>
			  <tr>

			  </tr>
			  </tbody>
			</table>-->
			
		</div>
	</div>
    </div>
    <div id="menu1" class="tab-pane fade">
	
      <div class="table">
	  <br>
	  <h4 class="panel-title" style="margin-top: -9px;    margin-bottom: -17px;"><span class="company">Baiduri Dimensi Group</span> Employee Cost Statistic of <?php echo date('m Y') ?></h4>
			<table class="wages-stat" border="1">
			  <thead>
			  </thead>
			  <tbody>
			  </tbody>
			</table>
			
			  <br>
	  <h4 class="panel-title" style="margin-top: -3px;  margin-bottom: -17px;"><span class="company">Baiduri Dimensi Group</span> Employee Other Cost Statistic of <?php echo date('m Y') ?></h4>
			<table class="other-cost-stat" border="1">
			  <thead>
			  </thead>
			  <tbody>
			  </tbody>
			</table>
	</div>
    </div>
    <div id="menu2" class="tab-pane fade">
		<p>Coming Soon</p>
	</div>
    <div id="menu3" class="tab-pane fade">
      <p>Coming Soon</p>
    </div>
	<div id="menu4" class="tab-pane fade">
      <p>Coming Soon</p>
    </div>
  </div>
</div>
<?php
	}
?>

<?php 
		if ($igen_a_hr == "a_hr_view"){
?>
        <table id="dash_table" >
            <tr>
                <td style="padding-right: 20px;">
                    <table>
                        <tr>
                            <td>
                                <div class="dash_main_content" style="width: 500px; padding: 10px 10px 20px 10px;">
                                    <div class="margincenter">
                                        <div class="margincenter dash_header_text">
                                            <span>Modified Employee Profile</span>
                                        </div>
                                        <div style="padding-top: 10px;">

                                            <?php
												$sqlGetdep = mysql_query('SELECT dep_id FROM employee WHERE id ="'.$user_id.'"');
												$rowGetdep = mysql_fetch_array($sqlGetdep);
												$numRow = mysql_num_rows($sqlGetdep);
												$get_dep=$rowGetdep['dep_id'];
                                            if ($_COOKIE["igen_user_id"] == true) {
                                                $maxheight = '150px';
                                            } else {
                                                $maxheight = '400px';
                                            
											}
											$user_id=$_COOKIE["igen_user_id"];
											$sql2 = "SELECT * FROM approval WHERE
                            (superior_1=" . $user_id
                            . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . ")";
                    $rs2 = mysql_query($sql2);
					$count_approval= mysql_num_rows( $rs2);
					$query_a ="SELECT * FROM approval_m  WHERE  emp_id='".$user_id."';";
               $level_a = mysql_query($query_a);
               $row_a = mysql_fetch_assoc($level_a);
               $totalRows_a = mysql_num_rows($level_a);
                                            ?>
                                            <div style="max-height: <?php echo $maxheight; ?>; overflow: auto;">
                                                <?php
                                                $i = 0;
												if($igen_a_hr == "a_hr_edit"){ 
                                                if ($igen_companylist != "") {
                                                    $sqlCheckApproval = 'SELECT ee.emp_id, e.full_name FROM employee_edit AS ee 
                                                                         INNER JOIN employee AS e ON e.id=ee.emp_id
                                                                         WHERE e.company_id IN (' . $igen_companylist . ')';
                                                } else {
                                                    $sqlCheckApproval = 'SELECT ee.emp_id, e.full_name FROM employee_edit AS ee 
                                                                         INNER JOIN employee AS e ON e.id=ee.emp_id';
                                                }
												}else{
												if ($igen_companylist != "") {
                                                    $sqlCheckApproval = 'SELECT ee.emp_id, e.full_name FROM employee_edit AS ee 
                                                                         INNER JOIN employee AS e ON e.id=ee.emp_id
                                                                         WHERE e.company_id IN (' . $igen_companylist . ') AND e.dep_id="'.$get_dep.'"';
                                                } else {
                                                    $sqlCheckApproval = 'SELECT ee.emp_id, e.full_name FROM employee_edit AS ee 
                                                                         INNER JOIN employee AS e ON e.id=ee.emp_id AND e.dep_id="'.$get_dep.'"';
                                                }
												
												}

                                                $queryCheckApproval = mysql_query($sqlCheckApproval);
                                                $rowcount = mysql_num_rows($queryCheckApproval);
                                                if ($rowcount > 0) {
                                                    //echo "Approval Pending";
                                                    echo '<table>';
                                                    while ($row = mysql_fetch_array($queryCheckApproval)) {
                                                        $i = $i + 1;
                                                        $id = $row['emp_id'];
                                                        $emp_name = $row['full_name'];
                                                        echo '<tr><td style="width: 30px; padding-left: 10px;">' . $i . '.</td><td><a href="?loc=view_profile_new&viewId=' . $id . '">EMP' . str_pad($id, 6, "0", STR_PAD_LEFT) . '&nbsp;&nbsp;' . $emp_name . '</a></td></tr>';
                                                    }
                                                    echo '</table>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                        <?php
					
                        if($igen_a_hr == "a_hr_edit"){
				
						if ($_COOKIE["igen_user_id"] == true  AND ($count_approval>0 ||    $totalRows_a>0)) { ?>
                            <tr>
                                <td>
                                    <div class="dash_main_content" style="width: 500px; height:auto; padding: 10px 10px 20px 10px;">
                                        <div class="margincenter">
                                            <div class="margincenter dash_header_text">
                                                <span>E-Application Requests</span>
                                            </div>
                                            <div style="padding-top: 10px; padding-left: 10px;">
                                                <div style="max-height: 150px; overflow: auto;">
                                                    <?php include_once "app/e_application_request.php"; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                        <?php }
						}else{
							if ($_COOKIE["igen_user_id"] == true  AND $igen_a_hr != "a_hr_edit") { ?>
                            <tr>
                                <td>
                                    <div class="dash_main_content" style="width: 500px; padding: 10px 10px 20px 10px;">
                                        <div class="margincenter">
                                            <div class="margincenter dash_header_text">
                                                <span>E-Application Requests</span>
                                            </div>
                                            <div style="padding-top: 10px; padding-left: 10px;">
                                                <div style="max-height: 150px; overflow: auto;">
                                                    <?php include_once "app/e_application_request.php"; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                        <?php
						}
						}
						?>
                    </table>
                </td>
                <td>
                  <div class="dash_main_content" style="width: 97%; padding: 10px 10px 20px 10px;">
		
                        <div class="margincenter" style="width: 97%;">
                            <div class="margincenter dash_header_text">
                                <span>Employee Transfer</span>
                            </div>
                            <div style="padding-top: 10px;">
                                <div style="max-height: 400px; overflow: auto;">
                                    <table style="border-collapse:collapse; width: 100%;">
                                        <tr class="dash_tableth">
                                            <th style="width: 30px;">No.</th>
                                            <th>Employee</th>
											<th>Original Department</th>
											<th>New Department</th>
                                            <th style="width: 80px;">Due Date</th>
                                            <th style="width: 80px; padding-right: 10px; text-align: center;">Action</th>
                                        </tr>
                                        <?php
                                        $i = 0;
                                        if ($igen_companylist != "") {
                                            $sql = 'SELECT e.id, e.full_name, et.ori_dep, et.to_date,et.transfer_dep, et.id AS et_id, et.temp_show, et.ori_dep, et.ori_dep_id,et.ori_group_id, et.is_transfer_back 
                                                    FROM employee AS e INNER JOIN employee_transfer AS et ON et.emp_id = e.id
                                                    WHERE et.to_date >= "'.date("Y-m-d").'"
                                                    AND e.company_id IN (' . $igen_companylist . ')
                                                    ORDER BY et.id DESC, et.to_date DESC ';
                                        } else {
										
                                            $sql = 'SELECT e.id, e.full_name, et.ori_dep,et.transfer_dep, et.to_date, et.id  AS et_id,  et.ori_dep,et.ori_dep_id, et.ori_group_id, et.is_transfer_back, et.temp_show
                                                    FROM employee AS e INNER JOIN employee_transfer AS et ON et.emp_id = e.id
                                                    WHERE et.to_date >= "'.date("Y-m-d").'"
                                                    ORDER BY et.id DESC, et.to_date DESC ';
                                        }
                                        $query = mysql_query($sql);
										 if ($igen_companylist != "") {
                                            $sql1 = 'SELECT e.id, e.full_name, et.ori_dep, et.to_date,et.transfer_dep, et.id AS et_id, et.temp_show,  et.ori_dep_id, et.ori_group_id,et.is_transfer_back 
                                                    FROM employee AS e INNER JOIN employee_transfer AS et ON et.emp_id = e.id
                                                    WHERE et.temp_show="N"
                                                    AND e.company_id IN (' . $igen_companylist . ')
                                                    ORDER BY et.id DESC ';
                                        } else {
										
                                            $sql1 = 'SELECT e.id, e.full_name, et.ori_dep,et.transfer_dep, et.to_date, et.id  AS et_id,  et.ori_dep_id, et.ori_group_id,et.is_transfer_back, et.temp_show
                                                    FROM employee AS e INNER JOIN employee_transfer AS et ON et.emp_id = e.id
                                                    WHERE et.temp_show="N"
                                                    ORDER BY et.id DESC';
                                        }
                                        $query1 = mysql_query($sql1);
										 $query = mysql_query($sql);
										$count=mysql_num_rows($query);
										
										$count=mysql_num_rows($query1);
									
                                        while ($row = mysql_fetch_array($query)) {
										
                                            if ($row["temp_show"] == "Y" && $row["is_transfer_back"] == "0") {
											
                                                $i = $i + 1;
                                                echo '<tr class="dash_tabletr cursor_pointer" id="trans_' . $row["et_id"] . '" style="color: black;" onMouseover="this.bgColor=\'lightblue\';" onMouseout="this.bgColor=\'\';">
                                                          <td >' . $i . '</td>
														  <td >'. $row["full_name"] . '</td>
                                                          
														  <td>' . $row["ori_dep"] . '</td>
														  <td>' . $row["transfer_dep"] . '</td>
                                                          <td>' . date('d-m-Y',strtotime($row["to_date"] )). '</td>
                                                          <td class="aligncentertable"><a onclick="emp_transfer('.$row["et_id"] .",".$row["ori_dep_id"].",".$row["id"].",".$row["ori_group_id"].')">Transfer</a></td>
                                                          </tr>';
                                            }
                                        }
										
									/*
										 while ($row1 = mysql_fetch_array($query1)) {
										
										
                                            if ($row1["temp_show"] == "N" && $row1["is_transfer_back"] == "0") {
											
                                                $i = $i + 1;
                                                echo '<tr class="dash_tabletr cursor_pointer" id="trans_' . $row1["et_id"] . '" style="color: black;" onMouseover="this.bgColor=\'lightblue\';" onMouseout="this.bgColor=\'\';">
                                                          <td>' . $i . '</td>
                                                          <td >' . $row1["full_name"] . '</td>
														  <td>' . $row1["ori_dep"] . '</td>
														  <td>' . $row1["transfer_dep"] . '</td>
                                                          <td>--</td>
                                                          <td class="aligncentertable"><a onclick="emp_transfer(' . $row1["et_id"] . ',' . $row1["ori_dep_id"]. ', ' . $row1["id"] . ', ' . $row1["ori_group_id"] . ')">Delete</a></td>
                                                          </tr>';
                                            }
                                        }
										*/
										
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>     
					
                </td>
            </tr>
        </table>
		<?php
		}
		?>
</div>
<div id="popup" style=""></div>
<style type="text/css">
    #popup{
        position: absolute; 
        float: left; 
        display: none; 
        width: 300px; 
        border: 1px solid mistyrose;
        background-color: mistyrose;
        padding: 15px 20px 10px 20px;
        -moz-box-shadow: 0 0 5px #mistyrose;
        -webkit-box-shadow: 0 0 5px #mistyrose;
        box-shadow: 0 0 5px #mistyrose;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }
    #dash_table td{
        vertical-align: top;
    }
    .dash_tabletr td{
        padding-top: 5px; 
        padding-bottom: 5px; 
        padding-left: 10px;
    }
    .dash_tabletr a{
        color: blue;
    }
    .dash_tableth th{
        background-color: #969595;
        color: #f9f7f7;
        padding: 5px 0 5px 10px;
        text-align: left;
    }
table.dashboard tr td {
		padding: 3px;
		text-align: center;
	}
	table.dashboard thead tr {
		background: #272525;
		color: #fff;
		padding: 10px;
	}
.tab-content h4.panel-title {
    font-weight: bold;
    font-size: 18px;
    padding-bottom: 14px;
    text-decoration: underline;
	text-align: center;
}
div#monthly_report_dep table th {
    font-size: 13px;
    padding: 6px;
    background: rgb(38,38,38);
	background: #033a5d;
    color: #fff;
}
div#monthly_report_dep {
	width: 100%;
    margin: auto;
    border: 7px solid #fff;
    padding: 1px;
    border-radius: 4px;
}
#monthly_report_dep table {
    width: 100%;
}
text.highcharts-credits {
    display: none;
}
tr.close_headcount {
    background: #e4de0b !important;
    font-weight: bold;
}
#monthly_report_dep #chart1, 
#monthly_report_dep #chart2 , 
#monthly_report_dep #chart3, 
#monthly_report_dep #chart4{
    border: 4px solid #eee;
    box-shadow: 0 4px 8px 0 #dddddd6b, 0 6px 20px 0 #dddddd6b;
}
#monthly_report_dep table tr:nth-child(even) {background: #CCC}
#monthly_report_dep table tr:nth-child(odd) {background: #FFF}


.tabs ul.nav.nav-tabs a {
    color: #fff ;
    font-weight: bold;
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #555 !important;
	border: 1px solid #6d3106;
	border-bottom-color: transparent;
}
.tabs .nav.nav-tabs {
    background: #022840 !important;
}

.widget-simple:after, .widget-simple:before {
    content: " ";
    display: table;
}
.widget-simple:after {
    clear: both;
}
.text-primary, .text-primary:hover, a, a.text-primary, a.text-primary:focus, a.text-primary:hover, a:focus, a:hover {
    color: #1bbae1;
}
.widget-simple .widget-icon, .widget-simple .widget-image {
    margin: 0 15px;
}
.widget .widget-icon {
    display: inline-block;
    line-height: 64px;
    text-align: center;
    font-size: 28px;
    color: #fff;
    border-radius: 32px;
}
.widget-simple .widget-icon.pull-left, .widget-simple .widget-image.pull-left {
    margin-left: 0;
}
.widget .widget-icon, .widget .widget-image {
    width: 64px;
    height: 64px;
}
.themed-background-autumn {
    background-color: #e67e22!important;
}
.animation-fadeIn {
    animation-name: fadeIn;
    -webkit-animation-name: fadeIn;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    animation-timing-function: ease-in-out;
    -webkit-animation-timing-function: ease-in-out;
    visibility: visible!important;
}
.widget-simple {
    padding: 15px;
}
a.widget {
    display: block;
    -webkit-transition: all .2s ease-out;
    transition: all .2s ease-out;
}
@media screen and (min-width: 768px)
.block, .draggable-placeholder, .widget {
    margin-bottom: 20px;
}
.widget {
    background-color: #fff;
    margin-bottom: 10px;
}
.themed-background-autumn {
    background-color: #e67e22!important;
}

.widget-icon{
    width: 64px;
    height: 64px;
}
.widget-icon {
    display: inline-block;
    line-height: 64px;
    text-align: center;
    font-size: 28px;
    color: #fff;
    border-radius: 32px;
}
.widget-simple {
    border-radius: 4px;
    height: 133px
}
text.highcharts-title,
caption.highcharts-table-caption {
    display: none;
}
h3.top_title {
    background: #021c2b;
    padding: 7px;
    text-align: center;
    font-size: 19px;
    position: relative;
    top: 11px;
    color: #fff;
}
.widget-simple.first {
    background: #033d63;
    color: #fff;
}
.widget-simple.second {
    background: #4c4603;
    color: #fff;
}
.widget-simple.third {
    background: #7d1605;
    color: #fff;
}
.widget-simple.fourth {
    background: #005959;
    color: #fff;
}
.h3, h3 {
    font-size: 21px;
}
h3.dashboard_title {
    /* position: relative; */
    /* top: -24px; */
    margin-top: -10px;
}
h3 hr {
    color: #000;
    margin-top: 3px;
}
.row.chart2, .row.chart3, .row.chart4 {
    margin-top: -30px;
}
i.fas, i.far {
	font-size: inherit !important;
    padding-right: inherit !important;
}
.widget-content .total_e {
    color: #1af51e;
}
.widget-content .active_e {
    color: darkturquoise;
}
.widget-content .inactive_e {
    color: yellow;
}
.widget-content .resigned_e {
    color: #fd9f69;
}	
</style>
<script type="text/javascript">
	$(document).ready(function() {
		var company_id=$("#comp_id").val();
		if(company_id==""){
		  $("#dropView option[value=1]").attr('selected', 'selected');
		  company_id=1;
		}
		$.ajax({
            dataType:'json',
            url:"?widget=totalemployee_department",
            data:{
					company_id:company_id
				},
            success:function(data){
				var local =data.local.split(',');
				var foreign =data.foreign.split(',');
				var mc =data.mc.split(',');
				var new_hired =data.new_hired.split(',');
				var resign =data.resign.split(',');
				$(".company").empty().html(data.company);
			    $("#comp_id").val(data.local.split(',').slice(0, -1));
				//var departments=data.department.split(",")
				
				$(".dashboard thead tr").empty().html(data.data1);
				$(".dashboard tbody").empty().html(data.data2);
				$(".dashboard1 thead tr").empty().html(data.data1);
				$(".dashboard1 tbody").empty().html(data.salary);
				$(".wages-stat thead ").empty().html(data.wages_stat_th);
				$(".wages-stat tbody").empty().html(data.wages_stat_td);
				$(".other-cost-stat thead ").empty().html(data.table_other_cost_th);
				$(".other-cost-stat tbody").empty().html(data.table_other_cost_td);
				$(".widget-content .total_e").empty().text(data.total_employee);
				$(".widget-content .active_e").empty().text(data.active);
				$(".widget-content .inactive_e").empty().text(data.inactive);
				$(".widget-content .resigned_e").empty().text(data.resigned_company);
				
				//$("th.text[scope='col']:first-child").html("department");
				$("#highcharts-data-table-0 th:first-child").text("ssss");
				//alert($("#highcharts-data-table-0 th:first-child").text("ssss"));
				var test_dat=30;
				//exit();
				//Column chart
				Highcharts.chart('chart1', {
					chart: {
						type: 'column',
						options: {
							enabled: true,
							alpha: 15,
							beta: 15,
							viewDistance: 25,
							depth: 40
						}
					},

					title: {
						text: 'Total Employee of '+data.company+' (By Department)'
					},

					xAxis: {
						categories:data.department.split(","),
						labels: {
							skew3d: true,
							style: {
								fontSize: '16px'
							}
						}
					},

					yAxis: {
						allowDecimals: false,
						min: 0,
						title: {
							text: 'Number of Employee',
							skew3d: true
						}
					},

					tooltip: {
						headerFormat: '<b>{point.key}</b><br>',
						pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y}'
					},

					plotOptions: {
						column: {
							dataLabels: {
							//enabled: true,
							//color:"#000"
							},
							stacking: 'normal',
							depth: 40
						}
					},
					series: [{
						name: 'Local Employee',
						data: getlocal(),
						color: '#0b560c',
						stack: 'male'
					}, {
						name: 'Foreign Employee',
						data: getforeign(),
						color:'#831CA4',
						stack: 'male'
					}, {
						name: 'Sick Leave',
						data: getmc(),
						color:'#955D0C',
						stack: 'female'
					}, {
						name: 'New Hired',
						data: gethired(),
						color:'#720A79',
						stack: 'female'
					}, {
						name: 'Resigned',
						data: getresigned(),
						color:'#C70039',
						stack: 'female'
					}],
					exporting: {
						showTable: true
					}
			});
			//Pie Chart
			$('#chart2').highcharts({
				chart: {
				  type: 'pie',
				  options3d: {
					enabled: true,
					alpha: 15,
					beta: 15,
					viewDistance: 25,
					depth: 40
				  }
				},
				title: {
				  text: 'Total Employee of '+data.company
				},
				tooltip: {
				  pointFormat: '{series.name}: <b>{point.y}</b>'
				},
				plotOptions: {
				  pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					//depth: 35,
					/*dataLabels: {
					  //enabled: true,
					//  distance: 10,
					 // format: '{point.y}'
					},*/
					showInLegend: true
				  }
				},
				series: [{
				  type: 'pie',
				  name: data.company,
				  /*data: [
					['Local Employee', parseInt(data.local_company) , '#831CA4'],
					['Foreign Employee',parseInt(data.foreign_company), '#831CA4'],
					['Sick Leave', parseInt(data.mc_company)],
					['New Hiring', parseInt(data.new_hired_company)],
					['Resigned', parseInt(data.resigned_company)]
				  ]*/
				  data: [{
                    name: 'Local Employee',
                    y: parseInt(data.local_company),
					color:'#C75A00'
                }, {
                    name: 'Foreign Employee',
                    y: parseInt(data.foreign_company),
					color:'#520505'
                }, {
                    name: 'Sick Leave',
                    y: parseInt(data.mc_company),
					color:'#e67e22'
                }, {
                    name: 'New Hiring',
                    y: parseInt(data.new_hired_company),
					color:'#616E05'
                }, {
                    name: 'Resigned',
                    y:  parseInt(data.resigned_company)
                }]
				}],
				exporting: {
					showTable: true
				}
			  });
			  

		var chartype = {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            }
            var chartitle = {
                text: 'Employee Salary of '+data.company
            }
            var chartooltip = {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            }
            var chartplotoptions = {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                   /* dataLabels: {
					  enabled: true,
					  distance: 10,
					  color: '#333333',
					 
					  formatter: function() {
						return '<b>' + this.point.y + '</b>' ;//+ this.point.y;
					  }
					},*/
                    showInLegend: true
                }
            }
			
            var chartseries = [{
                name: data.company,
                colorByPoint: true,
                data: [{
                    name: 'Local Staff Cost(RM)',
                    y: data.local_staff_cost_com,
					sliced: true,
                    selected: true,
					color:'#831CA4'
                }, {
                    name: 'Foreign Staff Cost(RM)',
                    y: data.foreign_staff_cost_com,
					color:'#005959'
                    /*sliced: true,
                    selected: true*/
                }, {
                    name: 'Overtime Hrs Clocked',
                    y: data.ot_hours_clocked_com
                }, {
                    name: 'Overtime Cost(RM)',
                    y: data.ot_cost_com
                }, {
                    name: 'Allowance Cost(RM)',
                    y: data.allowance_cost_com
                }]
            }]
			var showtable ={
						showTable: true
					}
            $('#chart4').highcharts({
                chart:chartype,
                title: chartitle,
                tooltip: chartooltip,
                plotOptions: chartplotoptions,
                series: chartseries,
				exporting:showtable
            });
						
		Highcharts.chart('chart3', {
		   title: {
				text: 'Employee Salary of '+data.company+' 	(By Department)'
			},

			/*subtitle: {
				text: 'Source: thesolarfoundation.com'
			},*/
			 xAxis: {
				categories: data.department.split(","),
			},
			yAxis: {
				title: {
					text: 'Number of Employees'
				}
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'bottom'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					}
				}
				/*line: {
					dataLabels: {
						enabled: true
					}
				}*/
			},
			// 'local_staff_cost'=>$local_staff_cost,'foreign_staff_cost'=>$foreign_staff_cost,'ot_hours_clocked'=>$ot_hours_clocked,'ot_cost'=>$ot_cost,'allowance_cost'=>$allowance_cost
			series: [{
				name: 'Local Staff Cost(RM)',
				data:  getlocalStaff(data.local_staff_cost.split(","))
			}, {
				name: 'Foreign Staff Cost(RM)',
				data: getlocalForeign(data.foreign_staff_cost.split(",")),
				color:"#a94442"
			}, {
				name: 'Overtime Hrs Clocked',
				data: getlocalOtHour(data.ot_hours_clocked.split(","))
			}, {
				name: 'Overtime Cost(RM)',
				data: getlocalOtCost(data.ot_cost.split(","))
			}, {
				name: 'Allowance Cost(RM)',
				data: getlocalAllowance(data.allowance_cost.split(","))
			}],
			responsive: {
				rules: [{
					condition: {
						maxWidth: "100%"
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
						   align: 'bottom',
						   verticalAlign: 'bottom'
						}
					}
				}]
			},
			exporting: {
				showTable: true
			}
		});

			
				/*Function to get local employee data*/
				function getlocal() {
					var data = [];
					var i ;
					for (i = 0; i <local.length; i += 1) {
						data.push(parseInt(local[i]));
					}
					return data;
				}
				
				/*Function to get local employee data*/
				function getforeign() {
					var data = [];
					var i ;
					for (i = 0; i <foreign.length; i += 1) {
						data.push(parseInt(foreign[i]));
					}
					return data;
				}
				
				/*Function to get local employee data*/
				function getmc() {
					var data = [];
					var i ;
					for (i = 0; i <mc.length; i += 1) {
						data.push(parseInt(mc[i]));
					}
					return data;
				}
				
				/*Function to get local employee data*/
				function gethired() {
					var data = [];
					var i ;
					for (i = 0; i <new_hired.length; i += 1) {
						data.push(parseInt(new_hired[i]));
					}
					return data;
				}
				
				/*Function to get local employee data*/
				function getresigned() {
					var data = [];
					var i ;
					for (i = 0; i <resign.length; i += 1) {
						data.push(parseInt(resign[i]));
					}
					return data;
				}
				
				function getlocalStaff(ouput) {
					var data = [];
					var i ;
					for (i = 0; i <ouput.length; i += 1) {
						data.push(parseInt(ouput[i]));
					}
					return data;
				}
				function getlocalForeign(ouput) {
					var data = [];
					var i ;
					for (i = 0; i <ouput.length; i += 1) {
						data.push(parseInt(ouput[i]));
					}
					return data;
				}
				function getlocalOtHour(ouput) {
					var data = [];
					var i ;
					for (i = 0; i <ouput.length; i += 1) {
						data.push(parseInt(ouput[i]));
					}
					return data;
				}
				function getlocalOtCost(ouput) {
					var data = [];
					var i ;
					for (i = 0; i <ouput.length; i += 1) {
						data.push(parseInt(ouput[i]));
					}
					return data;
				}
				function getlocalAllowance(ouput) {
					var data = [];
					var i ;
					for (i = 0; i <ouput.length; i += 1) {
						data.push(parseInt(ouput[i]));
					}
					return data;
				}
				

			}
		//$("#charts").highcharts(json);
		});
	   //Count Animation
		setTimeout(function () { 
			$('.count').each(function() {
				  var $this = $(this),
					  countTo = $(this).text();
				  //alert(countTo)
				  $({ countNum:0}).animate({
					countNum: countTo
				  },

				  {

					duration: 2000,
					easing:'linear',
					step: function() {
					  $this.text(Math.floor(this.countNum));
					},
					complete: function() {
					  $this.text(addCommas(this.countNum));
					  //alert('finished');
					}

				  });  

			});
		 }, 500);

 

	
});

//location.reload();

/*$(window).on('load', function() {
	setTimeout(function () { 
	$('.count').each(function() {
		  var $this = $(this),
			  countTo = $(this).text();
		  //alert(countTo)
		  $({ countNum:0}).animate({
			countNum: countTo
		  },

		  {

			duration: 2000,
			easing:'linear',
			step: function() {
			  $this.text(Math.floor(this.countNum));
			},
			complete: function() {
			  $this.text(addCommas(this.countNum));
			  //alert('finished');
			}

		  });  

	});
 }, 300);
 // code here
});*/

	function addCommas(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
	
    function emp_trans(trans_id){ 
        $.ajax({
            type:'POST',
            url:'?widget=emp_trans_info',
            data:{
                trans_id:trans_id
            },
            success:function(data){ 
                $("#popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('#popup').show();
            $('#popup').css({
                left:  e.pageX + 20,
                top:   e.pageY
            });
        });
    }
            
    function emp_trans_hide(){
        $(document).mousemove(function(){
            $('#popup').hide();
        });
    }
	 
            
    function emp_transfer(et_id, dep_id, emp_id, ori_group){
	
	   
        var result = confirm("Are you sure you want to transfer back to original department?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?widget=transferback_emp',
                data:{
                    et_id:et_id,
                    emp_id:emp_id,
					dep_id:dep_id,
                    ori_group:ori_group
                },
                success:function(data){ 
                    window.location='?loc=dashboard';
                }  
            })   
        }
    }
	
	
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
